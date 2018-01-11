<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Url;
use QL\QueryList;

/**
* 
*/

class GatherController extends BaseController
{
	public function add(){
		return $this->fetch();
	}
	public function index(){
		$list = $this->gather->all();
		return $this->fetch('',['list' => $list,]);
		// $this->gather('http://www.tell520.com/langman/qiuhunch?page={?}',1);
	}

	public function edit($id){
		$me = $this->gather->get($id);
		return $this->fetch('',['me' => $me,]);
	}
	public function update(){
		$data = $this->request->param();
		$result = $this->gather->allowField(true)->save($data,['id' => $data['id']]);
		if ($result) {
			$this->success('更新成功');
		}else{
			$this->error('更新失败');
		}
	}
	public function save(){
		$data = $this->request->param();
		
		$result = $this->gather->allowField(true)->save($data);
		if ($result) {
			$this->success('添加成功');
		}else{
			$this->error('添加失败');
		}
	}

	public function pages(){
		$data = $this->request->param();
		$result = $this->gather->allowField(true)->save(['pages' => $data['pages']],['id' => $data['id']]);
		if ($result) {
			$this->result($_SERVER['HTTP_REFERER'],1,'成功');
		}else{
			$this->result($_SERVER['HTTP_REFERER'],0,'失败');
		}
	}

	public function gather($id){
		$gatherList = $this->gather->get($id)->toArray();
		$outCoding = empty($gatherList['coding']) ? null : 'utf-8';
		$inputCoding = empty($gatherList['coding']) ? null : $gatherList['coding'];
		$urlNoHttp = str_replace('http://','',$gatherList['listurl']);
		$domain = substr($urlNoHttp,0,strpos($urlNoHttp,'/'));	//根据URL获取域名
		$listRules = ['title'=>[$gatherList['listlink'],'text'],'link'=>[$gatherList['listlink'],'href']];
		$contentRules = ['title'=>[$gatherList['titlerule'],'text'],'content'=>[$gatherList['contentrule'],'html',$gatherList['contentfilter']]];
		$curl = QueryList::getInstance('QL\Ext\Lib\CurlMulti');
		//100个线程
		$curl->maxThread = 100;
		$result = array();
		//循环列表页采集内容
		$num = $gatherList['pages'];
		for($i=1;$i<=$num;$i++){
			$urlStr = str_replace('{?}',$i,$gatherList['listurl']);
			$data = QueryList::run('Request',array(
			    'http' =>array(
			        'target' => $urlStr,
			        'referrer'=>$urlStr,
			        'user_agent'=>'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/535.11 (KHTML, like Gecko) Ubuntu/11.10 Chromium/27.0.1453.93 Chrome/27.0.1453.93 Safari/537.36',
			        'cookiePath' => './cookie.txt'
			    ),
			    'callback' => function($html){
			        return preg_replace('/<head.+?>.+<\/head>/is','<head></head>',$html);
			    }
			))->setQuery($listRules,'',$outCoding,$inputCoding)->getData(function($item) use($curl,$domain,$contentRules,$result,$outCoding,$inputCoding){
			    //判断数据库中是否存在数据
			    if(!$this->checkArticleRepeat($item['link'],$item['title'],$domain)){
			        $curl->add(['url' => $domain.$item['link']],function($a) use($contentRules,$result,$outCoding,$inputCoding){
			            $html = preg_replace('/<head.+?>.+<\/head>/is','<head></head>',$a['content']);
			            $data = QueryList::Query($html,$contentRules,'',$outCoding,$inputCoding)->getData();
			            //插入数据库
			            $art['source'] = $a['info']['url'];
			            $art['title'] = $data[0]['title'];
			            $art['content'] = $this->deleteHtml(htmlentities($data[0]['content']));
			            $art['category_id'] = 1;
			            $art['area_id'] = 0;
			            $art['click'] = mt_rand(200,500);
			            $art['status'] = 0;
			            $this->article->allowField(true)->create($art);
			            
			        });
			    }
			});
			$curl->start();
		}
	}

	public function gatherOld($url,$num=1,$listRules=null,$contentRules=null){
		// $jieguo = $this->checkArticleRepeat('lsdkjfkl','sdfa','23654');
		// dump($jieguo);
		// dump($this->article->getLastSql());exit;
		$urlNoHttp = str_replace('http://','',$url);
		$domain = substr($urlNoHttp,0,strpos($urlNoHttp,'/'));	//根据URL获取域名
		$listRules = ['title'=>['h4 a','text'],'link'=>['h4 a','href']];
		$contentRules = ['title'=>['h1','text'],'content'=>['.article-content','html','-#headline -script -h3.post_tags -.copyright -.wumii-hook a']];
		$curl = QueryList::getInstance('QL\Ext\Lib\CurlMulti');
		//100个线程
		$curl->maxThread = 100;
		$result = array();
		//循环列表页采集内容
		for($i=1;$i<=$num;$i++){
			$urlStr = str_replace('{?}',$i,$url);
			$data = QueryList::run('Request',array(
			    'http' =>array(
			        'target' => $urlStr,
			        'referrer'=>$urlStr,
			        'user_agent'=>'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/535.11 (KHTML, like Gecko) Ubuntu/11.10 Chromium/27.0.1453.93 Chrome/27.0.1453.93 Safari/537.36',
			        'cookiePath' => './cookie.txt'
			    ),
			    'callback' => function($html){
			        return preg_replace('/<head.+?>.+<\/head>/is','<head></head>',$html);
			    }
			))->setQuery($listRules)->getData(function($item) use($curl,$domain,$contentRules,$result){
			    //判断数据库中是否存在数据
			    if(!$this->checkArticleRepeat($item['link'],$item['title'],$domain)){
			        $curl->add(['url' => $domain.$item['link']],function($a) use($contentRules,$result){
			            $html = preg_replace('/<head.+?>.+<\/head>/is','<head></head>',$a['content']);
			            $data = QueryList::Query($html,$contentRules)->getData();
			            //插入数据库
			            $art['source'] = $a['info']['url'];
			            $art['title'] = $data[0]['title'];
			            $art['content'] = $data[0]['content'];
			            $art['category_id'] = 1;
			            $art['area_id'] = 0;
			            $art['click'] = mt_rand(200,500);
			            $art['status'] = 0;
			            
			            $this->article->allowField(true)->create($art);
			            // if($aid){
			            	
			            // }
			        });
			    }
			});
			$curl->start();
		}
	}

	public function checkArticleRepeat($url,$title,$domain){
		return $this->article->field('title,source')->where('title',$title)->whereOr('source',$domain.$url)->find();
		if ($result) {
			return true;
		}else{
			return false;
		}
	}

	function deleteHtml($str) { 
		$str = trim($str); //清除字符串两边的空格
		$str = preg_replace("/\t/","",$str); //使用正则表达式替换内容，如：空格，换行，并将替换为空。
		$str = preg_replace("/\r\n/","",$str); 
		$str = preg_replace("/\r/","",$str); 
		$str = preg_replace("/\n/","",$str); 
		$str = preg_replace("/ /","",$str);
		$str = preg_replace("/  /","",$str);  //匹配html中的空格
		$str = preg_replace("/ /","",$str);
		$str = preg_replace("/　/","",$str);
	    return trim($str); //返回字符串
	}
}