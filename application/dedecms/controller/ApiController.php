<?php
namespace app\dedecms\controller;

use think\controller;
use think\Request;
use think\Loader;
// use app\dedecms\model\Archives;
// use app\dedecms\model\Arctype;
// use app\dedecms\model\Addonarticle;
// use app\dedecms\model\Addoncase;
// use app\dedecms\model\Addonfakecomment;
// use app\dedecms\model\Addonfakefeedback;
// use app\dedecms\model\Addonshop;
// use app\dedecms\model\Addonvideo;
/**
* 
*/
class ApiController extends BaseController
{
	public function getlujin(){
		$controller = $this->request->controller();
		echo "slkdjfklsjflk";
		// return $controller;
	}

	public function getArctype($id='',$dir='',$typename='',$reid='',$topid='',$custom=''){
		$result = null;
		if (!empty($id)) {
			$where = "`id` = $id";
		}elseif (!empty($dir)) {
			$dir = '{cmspath}/'.$dir;
			$where = "`typedir` = '$dir'";
		}elseif (!empty($typename)) {
			$where = "`typename` = '$typename'";
		}elseif (!empty($reid)) {
			$where = "`reid` = $reid";
		}elseif (!empty($topid)) {
			$where = "`topid` = $topid";
		}else{
			$where = "`id` > 0";
		}
		if (!empty($custom)) {
			$where .= " AND $custom";
		}
		$arctype = $this->arctype
			->where($where)
			->field('id,reid,topid,sortrank,typename,typedir,isdefault,channeltype,ispart,tempindex,templist,temparticle,namerule,description,keywords,seotitle,content')
			->order('sortrank asc')
			->select();
		
		if ($arctype == null) {
			$area = $this->archives->where('arcrank',0)->where('channel',-1)->where('flag','like','%s%')->with('arctype')
				->field('id,typeid,typeid2,sortrank,flag,channel,arcrank,click,title,shorttitle,writer,source,litpic,pubdate,senddate,keywords,description,filename,color')
				->select();
			foreach ($area as $value) {
				$value['reid'] = $value['arctype']['id'];
				$value['topid'] = $value['arctype']['topid'];
				$value['typename'] = $value['title'];
				$value['typedir'] = '{cmspath}/'.str_replace('/index.html','',str_replace('{aid}',$value['filename'],$value['arctype']['namerule']));
				$value['channeltype'] = $value['channel'];
				$value['ispart'] = 1;
				$value['tempindex'] = $value['arctype']['tempindex'];
				$value['templist'] = $value['arctype']['templist'];
				$value['temparticle'] = $value['arctype']['temparticle'];
				$value['namerule'] = $value['arctype']['namerule'];
				$value['area'] = str_replace($value['arctype']['typename'],'',$value['title']);
				$value['areaus'] = ucfirst(str_replace('/index','',$value['filename']));
				if (!empty($id)) {
					if (strpos($value['id'],$id) !== false) {
						$result = $value;
					}
				}elseif (!empty($dir)) {
					if (strpos($value['typedir'],$dir) !== false) {
						$result = $value;
					}
				}elseif (!empty($typename)) {
					if (strpos($value['typename'],$typename) !== false) {
						$result = $value;
					}
				}elseif (!empty($reid)) {
					if (strpos($value['reid'],$reid) !== false) {
						$result = $value;
					}
				}elseif (!empty($topid)) {
					if (strpos($value['topid'],$topid) !== false) {
						$result = $value;
					}
				}else{
					$result = $value;
				}
			}
		}else{
			$result = $arctype;
		}
		if (empty($result) || $result == null) {
			return false;
		}else{
			$result = $this->arctypeConvert($result);
		}
		// $result = $this->arctypeConvert($result);
		if (count($result) == 1 && isset($result[0])) {
			$result = $result[0];
		}
		return $result;
	}
	
	public function getArticle($id=0,$typeid=0,$typeid2=0,$city=0,$flag='',$channel=0,$title='',$key='',$tk='',$order='pubdate desc',$page=1,$list_rows=15,$limit=false,$arcrank=0,$pubdate=0,$click=0){
		if ($typeid==0) {
			$tids = '0';
			foreach ($this->getArctype() as $value) {
				$tids .= ','.$value['id'];
			}
			$typeid = $tids;
		}
		$flag = '%'.$flag.'%';
		$title = '%'.$title.'%';
		$key = '%'.$key.'%';
		$tk = '%'.$tk.'%';
		$idWhere = ($id < 1) ? "`id` > 0" : "`id` = $id";
		$channelWhere = ($channel == 0) ? "`channel` > $channel" : "`channel` = $channel";
		$orderWhere = ($order == '') ? "pubdate desc" : $order;
		$data = $this->archives
			->field('id,typeid,typeid2,sortrank,flag,channel,arcrank,click,title,shorttitle,writer,source,litpic,pubdate,senddate,keywords,description,filename')
			->where('arcrank',$arcrank)
			->where($channelWhere)
			->where($idWhere)
			->where('typeid','in',$typeid)
			->where('flag','like',$flag)
			->where('title','like',$title)
			->where('keywords','like',$key)
			->order($orderWhere)
			->with('arctype')
			->paginate($list_rows,$limit,['page' => $page]);
		return $data;
	}
	public function getMallList($typeid=0){
		$where = "`id` > 0";
		if ($typeid > 0) {
			$where .= " AND `typeid` IN ($typeid)";
		}
		$data = $this->archives
			->field('id,typeid,typeid2,sortrank,flag,channel,arcrank,click,title,shorttitle,writer,source,litpic,pubdate,senddate,keywords,description,filename')
			->where('arcrank',0)
			->where('channel','>',0)
			->where($where)
			->order('pubdate desc')
			->with('arctype')
			->with('shop')
			->select();
		$result = $this->arctypeConvert($data);
		return $result;
	}
	public function getArticleClassify($typeid=0,$typeid2=0,$title='',$complement=0){
		$where = "`id` > 0";
		if ($typeid > 0) {
			$where .= " AND `typeid` IN ($typeid)";
		}
		$data = $this->archives
			->field('id,typeid,typeid2,sortrank,flag,channel,arcrank,click,title,shorttitle,writer,source,litpic,pubdate,senddate,keywords,description,filename')
			->where('arcrank',0)
			->where('channel','>',0)
			->where($where)
			->order('pubdate desc')
			->with('arctype')
			->select();
		$data = $this->arctypeConvert($data);
		if ($title != '') {
			foreach ($data as $value) {
				if (is_array($title)) {
					for ($i=0; $i < count($title); $i++) { 
						if(strpos($value['title'],$title[$i]) !== false){
							$where = true;break;
						}else{
							$where = false;
						}
					}
				}else{
					if (strpos($value['title'],$title) !== false) {
						$where = true;
					}else{
						$where = false;
					}
				}
				if ($where == true) {
					$result['t1'][$value['typeid']][] = $value;
					$result['t2'][$value['typeid']][] = $value;
					if ($value['typeid2'] != '' && $value['typeid2'] != '0' && strpos($value['typeid2'],',') !== false) {
						foreach (explode(',',$value['typeid2']) as $val) {
							$result['t2'][$val][] = $value;
						}
					}
					if ($value['typeid2'] != '' && $value['typeid2'] != '0' && strpos($value['typeid2'],',') === false) {
						$result['t2'][$value['typeid2']][] = $value;
					}
				}else{
					$result['nt1'][$value['typeid']][] = $value;
					$result['nt2'][$value['typeid']][] = $value;
					if ($value['typeid2'] != '' && $value['typeid2'] != '0' && strpos($value['typeid2'],',') !== false) {
						foreach (explode(',',$value['typeid2']) as $val) {
							$result['nt2'][$val][] = $value;
						}
					}
					if ($value['typeid2'] != '' && $value['typeid2'] != '0' && strpos($value['typeid2'],',') === false) {
						$result['nt2'][$value['typeid2']][] = $value;
					}
				}
			}
			if (isset($result['t1']['14']) && count($result['t1']['14']) < 3 && $complement == 1) {
				$result['t1']['14'] = array_merge($result['t1']['14'],$result['nt1']['14']);
			}
			if (!isset($result['t1']['14']) && $complement == 1) {
				$result['t1']['14'] = $result['nt1']['14'];
			}
		}else{
			foreach ($data as $value) {
				$result['t1'][$value['typeid']][] = $value;
				$result['t2'][$value['typeid']][] = $value;
				if ($value['typeid2'] != '' && $value['typeid2'] != '0' && strpos($value['typeid2'],',') !== false) {
					foreach (explode(',',$value['typeid2']) as $val) {
						$result['t2'][$val][] = $value;
					}
				}
				if ($value['typeid2'] != '' && $value['typeid2'] != '0' && strpos($value['typeid2'],',') === false) {
					$result['t2'][$value['typeid2']][] = $value;
				}
			}
		}
		return $result;
	}
	public function getArctypeToDir($dir,$page=1){
		$result = null;
		$result = $this->getArctype('',$dir);
		if ($result == null || $result == false) {
			return false;
		}
		if ($result['channeltype'] == -1 && $result['ispart'] == 1) {
			$result['typelist'] = $this->getTypeidList($result['arctype']['id'],$result['arctype']['reid'],$result['arctype']['topid']);
			$arclist = $this->getArticleClassify($result['typelist']['typeids'],0,$result['area'],1);
			$result['fakefeedback'] = $this->getFakefeedback($result['typename']);
			$result['position'] = $result['typelist']['position'];
			$result['list'] = $arclist;
		}elseif ($result['channeltype'] != -1 && $result['ispart'] == 1) {
			$result['typelist'] = $this->getTypeidList($result['id'],$result['reid'],$result['topid']);
			$arclist = $this->getArticleClassify($result['typelist']['typeids']);
			$result['position'] = $result['typelist']['position'];
			$result['list'] = $arclist;
		}else{
			$result['typelist'] = $this->getTypeidList($result['id'],$result['reid'],$result['topid']);
			$arclist = $this->getArticle(0,$result['typelist']['typeids'],0,0,'',0,'','','','',$page,15)->toArray();
			$pages['url'] = $result['typeurl'];
			$pages['total'] = $arclist['total'];
			$pages['per_page'] = $arclist['per_page'];
			$pages['current_page'] = $arclist['current_page'];
			$pages['last_page'] = $arclist['last_page'];
			$result['page'] = $this->getPageContent($pages);
			$result['position'] = $result['typelist']['position'];
			$result['list'] = $this->arctypeConvert($arclist['data']);
		}
		return $result;
	}
	
	public function getContent($dir,$id){
		$archives = $this->archives
			->where('arcrank',0)
			->field('id,typeid,typeid2,sortrank,flag,channel,arcrank,click,title,shorttitle,writer,source,litpic,pubdate,senddate,keywords,description,filename')
			->with('arctype')
			->find($id);
		if (empty($archives) || $archives == null) {
			return false;
		}
		$ctype = $this->channeltype->field('nid')->find($archives['channel']);	//获取模型名称
		$addon = $this->$ctype['nid']->find($id)->toArray();	//根据模型名称获取对应附加表内容
		foreach ($addon as &$value) {	//替换内容中的图片地址为七牛云地址
			$value = preg_replace("/(<img.+src=\")(.+\..+)(\".+>)/i","\${1}http://img1.1314theone.com\${2}/picture1\${3}",$value);
		}
		$result = $this->arctypeConvert($archives);
		if($archives['channel'] == 1){
			$result['body'] = $this->replaceKeyword($addon['body']);
		}
		$result['addon'] = $addon;
		$result['typelist'] = $this->getTypeidList($result['arctype']['id'],$result['arctype']['reid'],$result['arctype']['topid']);
		$arclist = $this->getArticleClassify($this->getTypeidList($result['arctype']['topid'],0,0)['typeids'],0,$this->getRelated($result['title']));
		$result['position'] = $result['typelist']['position'];
		$result['list'] = $arclist;
		$result['fakecomment'] = ($result['typeid'] == 22) ? $this->getFakecomment($result['id']) : null;
		return $result;
	}
	
	public function getFakecomment($shopid){
		return $this->fakecomment->where('shopid',$shopid)->limit(15)->select();
	}
	public function getFakefeedback($title='',$limit=5){
		$title = '%'.$title.'%';
		$data = $this->fakefeedback
			->field('aid,typeid,channel,title,litpic,body,username')
			->where('title','like',$title)
			->limit($limit)
			->order('senddate desc')
			->select();
		if (count($data) < $limit) {
			$limit = $limit-count($data);
			$data2 = $this->fakefeedback
			->field('aid,typeid,channel,title,litpic,body,username')
			->where('title','like','%首页求婚%')
			->limit($limit)
			->order('rand()')
			->select();
			$data = array_merge($data,$data2);
		}
		return $data;
	}

	public function getRelated($title){
		$arr = [
			'地区' => [
				'北京','上海','重庆','天津','成都','昆明','丽江','贵阳','广州','深圳','南宁','海口','三亚','杭州','南京','苏州','合肥','济南','青岛','福州','厦门','南昌','长沙','武汉','郑州','太原','石家庄','沈阳','大连','长春','哈尔滨','西安','香港','巴黎','马尔代夫','巴厘岛','苏梅岛','塞班岛','普吉岛'
			],
			'分类' => [
				'求婚策划','求婚方式','求婚创意','求婚戒','求婚钻戒','求婚词','求婚歌','求婚音乐'
			],
			'场景' => [
				'快闪','电影院','咖啡','KTV','酒吧','酒店','餐厅','商场','广场','海边','校园','公园','机场','地铁'
			],
			'节日' => [
				'情人节','国庆','圣诞','元旦','春节','光棍'
			],
		];
		$where = '';
		foreach ($arr as $key => $value) {
			foreach($value as $val){
				if (strpos($title,$val)) {
					$where[] = $val;
				}
			}
		}
		return $where;
	}

	public function getTypeidList($tid,$reid,$topid){
		$typeids = $tid;
		$str = '';
		$data = $this->arctypeConvert($this->getArctype());
		foreach ($data as $key => $value) {
			if ($topid == $value['id'] && $reid == $topid) {
				$str .= '<a href="'.$value['typeurl'].'" target="_self">'.$value['typename'].'</a> > ';
				$result['top'] = $value;
				$result['up'] = $value;
			}elseif ($topid == $value['id'] && $reid != $topid) {
				$str .= '<a href="'.$value['typeurl'].'" target="_self">'.$value['typename'].'</a> > ';
				$result['top'] = $value;
			}elseif ($reid == $value['id'] && $reid != $topid) {
				$str .= '<a href="'.$value['typeurl'].'" target="_self">'.$value['typename'].'</a> > ';
				$result['up'] = $value;
			}elseif ($tid == $value['id']) {	//判断目标栏目是不是自身
				$str .= '<a href="'.$value['typeurl'].'" target="_self">'.$value['typename'].'</a>';
			}elseif ($reid == $value['reid']) {	//判断目标栏目是不是同级的2级栏目
				if ($value['sortrank'] > 100) {
					$class = substr($value['sortrank'],0,1);
					$result['same'][$class][] = $value;
				}else{
					$result['same'][] = $value;
				}
			}elseif ($tid == $value['reid'] && $tid == $value['topid']) {
				$typeids .= ','.$value['id'];
				if ($value['sortrank'] > 100) {
					$class = substr($value['sortrank'],0,1);
					$result['child'][$class][] = $value;
					$result['child1'][$class][] = $value;
				}else{
					$result['child'][] = $value;
					$result['child1'][] = $value;
				}
			}elseif ($tid == $value['reid'] && $tid != $value['topid']) {
				$typeids .= ','.$value['id'];
				if ($value['sortrank'] > 100) {
					$class = substr($value['sortrank'],0,1);
					$result['child'][$class][] = $value;
					$result['child2'][$class][] = $value;
				}else{
					$result['child'][] = $value;
					$result['child2'][] = $value;
				}
			}
		}
		// foreach ($data as $val) {
		// 	$sort[] = $val['tier'].'-'.$val['id'];
		// }
		// array_multisort($sort,$data);
		$result['typeids'] = $typeids;
		$result['position'] = $str;
		// $result = array_merge($data,$data);
		return $result;
	}

	public function getSgpage($dir){
		$data = $this->sgpage
			->field('aid,title,filename,keywords,template,description,uptime,body')
			->where('filename','=',$dir)
			->find();
		$result = $this->arctypeConvert($data);
		return $result;
	}

	public function getAreaType(){
		$area = $this->archives->where('arcrank',0)->where('channel',-1)->where('color','area')->with('arctype')
				->field('id,typeid,typeid2,sortrank,flag,channel,arcrank,click,title,shorttitle,writer,source,litpic,pubdate,senddate,keywords,description,filename,color')
				->select();
		foreach ($area as $value) {
			$value['reid'] = $value['arctype']['id'];
			$value['topid'] = $value['arctype']['topid'];
			$value['typename'] = $value['title'];
			$value['typedir'] = '{cmspath}/'.str_replace('/index.html','',str_replace('{aid}',$value['filename'],$value['arctype']['namerule']));
			$value['channeltype'] = $value['channel'];
			$value['ispart'] = 1;
			$value['tempindex'] = $value['arctype']['tempindex'];
			$value['templist'] = $value['arctype']['templist'];
			$value['temparticle'] = $value['arctype']['temparticle'];
			$value['namerule'] = $value['arctype']['namerule'];
			$value['area'] = str_replace($value['arctype']['typename'],'',$value['title']);
			$value['areaus'] = ucfirst(str_replace('/index','',$value['filename']));
		}
		$result = $this->arctypeConvert($area);
		return $result;
	}
	/**
	 * 根据栏目内容转换URL和模板字段
	 * @author deanyan 2018-01-14T19:00:48+0800
	 * @copyright www.deanyan.com
	 * @param     [type]          $data [description]
	 * @param     integer         $aid  [description]
	 * @return    [type]                [description]
	 */
	public function arctypeConvert($data,$aid=0){
		if (is_null($data) || $data == null || $data == false) {
			return false;
		}elseif (is_array($data)) {
			$result = $data;
		}else{
			$result = $data->toArray();
		}

		if (isset($result['namerule'])) {
			$result['arcurl'] = '/'.str_replace('{aid}',$aid,$result['namerule']);
		}
		if (isset($result['typedir'])) {
			$result['typeurl'] = str_replace('{cmspath}','',$result['typedir']).'/';
		}
		if (isset($result['tempindex'])) {
			$result['tempindex'] = str_replace('.htm','',str_replace('{style}/','',$result['tempindex']));
		}
		if (isset($result['templist'])) {
			$result['templist'] = str_replace('.htm','',str_replace('{style}/','',$result['templist']));
		}
		if (isset($result['temparticle'])) {
			$result['temparticle'] = str_replace('.htm','',str_replace('{style}/','',$result['temparticle']));
		}
		if (isset($result['template'])) {
			$result['template'] = str_replace('.htm','',str_replace('{style}/','',$result['template']));
		}
		if (isset($result['arctype'])) {
			if (isset($result['id'])) {
				$aid = $result['id'];
			}
			if (isset($result['arctype']['namerule'])) {
				$result['arctype']['arcurl'] = '/'.str_replace('{aid}',$aid,$result['arctype']['namerule']);
			}
			if (isset($result['arctype']['typedir'])) {
				$result['arctype']['typeurl'] = str_replace('{cmspath}','',$result['arctype']['typedir']).'/';
			}
			if (isset($result['arctype']['tempindex'])) {
				$result['arctype']['tempindex'] = str_replace('.htm','',str_replace('{style}/','',$result['arctype']['tempindex']));
			}
			if (isset($result['arctype']['templist'])) {
				$result['arctype']['templist'] = str_replace('.htm','',str_replace('{style}/','',$result['arctype']['templist']));
			}
			if (isset($result['arctype']['temparticle'])) {
				$result['arctype']['temparticle'] = str_replace('.htm','',str_replace('{style}/','',$result['arctype']['temparticle']));
			}
		}
		foreach ($result as &$value) {
			if (is_object($value)) {
				$value = $value->toArray();
			}
			if (isset($value['namerule'])) {
				$value['arcurl'] = '/'.str_replace('{aid}',$aid,$value['namerule']);
			}
			if (isset($value['typedir'])) {
				$value['typeurl'] = str_replace('{cmspath}','',$value['typedir']).'/';
			}
			if (isset($value['tempindex'])) {
				$value['tempindex'] = str_replace('.htm','',str_replace('{style}/','',$value['tempindex']));
			}
			if (isset($value['templist'])) {
				$value['templist'] = str_replace('.htm','',str_replace('{style}/','',$value['templist']));
			}
			if (isset($value['temparticle'])) {
				$value['temparticle'] = str_replace('.htm','',str_replace('{style}/','',$value['temparticle']));
			}
			if (isset($value['arctype'])) {
				if (isset($value['id'])) {
					$aid = $value['id'];
				}
				if (isset($value['arctype']['namerule'])) {
					$value['arctype']['arcurl'] = '/'.str_replace('{aid}',$aid,$value['arctype']['namerule']);
				}
				if (isset($value['arctype']['typedir'])) {
					$value['arctype']['typeurl'] = str_replace('{cmspath}','',$value['arctype']['typedir']).'/';
				}
				if (isset($value['arctype']['tempindex'])) {
					$value['arctype']['tempindex'] = str_replace('.htm','',str_replace('{style}/','',$value['arctype']['tempindex']));
				}
				if (isset($value['arctype']['templist'])) {
					$value['arctype']['templist'] = str_replace('.htm','',str_replace('{style}/','',$value['arctype']['templist']));
				}
				if (isset($value['arctype']['temparticle'])) {
					$value['arctype']['temparticle'] = str_replace('.htm','',str_replace('{style}/','',$value['arctype']['temparticle']));
				}
			}
		}
		return $result;
	}

	/**
	 * 替换内容正文关键词链接
	 * @author deanyan 2018-01-14T18:59:05+0800
	 * @copyright www.deanyan.com
	 * @param     string         $body
	 * @return    [type]                
	 */
	private function replaceKeyword($body)
    {
    	$karr = $kaarr = array();
    	//屏蔽超链接初始化
    	$bodyUrl = [];
    	if(preg_match_all("/(\<a\s+.*?\>.+?\<\/a\s*\>)/i",$body,$matches)){
    		$bodyUrl['init'] = $matches[0];
    		for ($i=0; $i < count($bodyUrl['init']); $i++) { 
    			$body = preg_replace("/(\<a\s+.*?\>.+?\<\/a\s*\>)/i", "<init-$i>",$body,1);
    		}
    	}
    	$rs = $this->keywords
    		->where('rpurl','<>','')
    		->where('sta',1)
    		->order('length(keyword) desc')
    		->order('rank desc')
    		->select();
    	$m = (strpos($this->request->domain(),'http://m.') !== false) ? true : false;
    	foreach ($rs as $value) {
    		$key = trim($value['keyword']);
    		$key_url = ($m) ? str_replace('http://www.','http://m.',trim($value['rpurl'])) : trim($value['rpurl']);
    		$karr[] = $key;
    		$kaarr[] = "<a href=\"$key_url\" target=\"_blank\">$key</a>";
    	}
    	
    	foreach ($karr as $key => $word) {
    		$body = preg_replace("/$karr[$key]/U","$kaarr[$key]",$body,2);
    		//屏蔽超链接
    		if(preg_match_all("/(\<a\s+.*?\>.+?\<\/a\s*\>)/i",$body,$matches)){
	    		$bodyUrl['burl']["b$key"] = $matches[0][0];
	    		$body = preg_replace("/(\<a\s+.*?\>.+?\<\/a\s*\>)/i", "<burl-b$key>",$body,2);
	    	}
    	}
    	//恢复超链接
    	if (isset($bodyUrl['init']) && count($bodyUrl['init']) > 0) {
    		$row = $bodyUrl['init'];
    		for ($i=0; $i < count($row); $i++) { 
    			$body = preg_replace("/<init-$i>/i", "$row[$i]",$body,1);
    		}
    	}
    	if (isset($bodyUrl['burl']) && count($bodyUrl['burl']) > 0) {
    		foreach ($bodyUrl['burl'] as $key => $value) {
    			$body = preg_replace("/<burl-$key>/i", "$value",$body,2);
    		}
    	}
    	return $body;
    }

    /**
     * 根据页码信息获取分页内容
     * @author deanyan 2018-01-14T23:01:21+0800
     * @copyright www.deanyan.com
     * @param     array          $data  分页数组
     * @param     integer        $style 显示的样式
     * @return    string                 [description]
     */
    private function getPageContent($data,$style=1){
		if ($data['last_page'] <= 1) {
			return '';
		}
		$con = '';
		$munPage = '';
		$selectPage = '';
		$firstPage = '<li><a href="'.$data['url'].'">首页</a></li>';
		$lastPage = '<li><a href="p'.$data['last_page'].'.html">末页</a></li>';
		$prePage = '<li><a href="p'.($data['current_page']-1).'.html">上一页</a></li>';
		$nextPage = '<li><a href="p'.($data['current_page']+1).'.html">下一页</a></li>';
		if ($data['current_page'] == 1) {
			$firstPage = "";
			$prePage = "";
		}
		if ($data['current_page'] == $data['last_page']) {
			$lastPage = "";
			$nextPage = "";
		}
		for ($i=1; $i < $data['last_page']+1; $i++) {
			if ($data['current_page'] == $i) {
				$munPage .= '<li class="thisclass">'.$i.'</li>';
				if ($i == 2) {
					$prePage = '<li><a href="'.$data['url'].'">上一页</a></li>';
				}
			}else{
				if ($i == 1) {
					$munPage .= '<li><a href="'.$data['url'].'">'.$i.'</a></li>';
				}else{
					$munPage .= '<li><a href="p'.$i.'.html">'.$i.'</a></li>';
				}
			}
		}
		switch ($style) {
			case '1':
				$pageStyle = $firstPage.$prePage.$munPage.$nextPage.$lastPage;
				break;
			case '2':
				$pageStyle = $prePage.$munPage.$nextPage;
				break;
			case '3':
				$pageStyle = str_replace('上一页','<<',$prePage).$munPage.str_replace('下一页','>>',$nextPage);
				break;
			default:
				$pageStyle = $firstPage.$prePage.$munPage.$nextPage.$lastPage;
				break;
		}
		return $pageStyle;
	}
}
