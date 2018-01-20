<?php
namespace app\index\controller;

use think\Loader;
use think\Controller;
use think\Request;
use think\Route;
use app\dedecms\controller\ApiController;

class IndexController extends BaseController
{
	protected $obj;
    function __construct(ApiController $api){
        parent::__construct();
        $this->obj = $api;
        if ($this->request->isMobile() && strpos($this->request->host(),'m.') === false) {
        	$mwebUrl = (strpos($this->request->url(true),'www.') !== false) ? str_replace('http://www.','http://m.',$this->request->url(true)) : str_replace('http://','http://m.',$this->request->url(true));
            header('Location: '.$mwebUrl);exit();
        }
    }

    public function index(){
    	$tempSuffix = (strpos($this->request->host(),'m.') === false) ? '.php' : '_m.php';
        $data = $this->request->param();
        // dump($data);

        if (count($data) == 0) {    //首页
            $result['fakefeedback'] = $this->obj->getFakefeedback('首页');
            $result['list'] = $this->obj->getArticleClassify();
            // dump($result);
        	return $this->fetch($this->template.'index'.$tempSuffix,['data' => $result]);
        }elseif (!empty($data['dir']) && isset($data['id']) && $data['id'] > 0) {	//内容页
            $result = $this->obj->getContent($data['dir'],$data['id']);
            // dump($result);
            if ($result == null || $result['addon'] == null || $result['arctype'] == null) {
            	return $this->fetch($this->template.'404.html');
            }elseif (strpos($result['arctype']['arcurl'],$data['dir']) === false) {
            	return $this->fetch($this->template.'404.html');
            }else{
                $result['mallList'] = $this->obj->getMallList(22);
            	return $this->fetch($this->template.$result['arctype']['temparticle'].$tempSuffix,['data' => $result]);
            }
        }elseif (!isset($data['id']) && isset($data['dir1'])) {	//栏目页
            $dir = '';
            $page = 1;
            $mun = count($data);
            if (isset($data['page'])) {
            	$page = str_replace('p','',$data['page']);
            	$mun = $mun-1;
            }
            for ($i=0; $i < $mun; $i++) {
                $a = 'dir'.($i+1);
                $dir .= $data["$a"].'/';
            }
            $dir = substr($dir,0,-1);
            $result = $this->obj->getArctypeToDir($dir,$page);
            // dump($this->obj->getArctype());
            // dump($this->obj->getTypeidList(12));
            // dump($dir);
            // dump($result);
            if ($result == null || $result == false) {
            	return $this->fetch($this->template.'404.html');
            }else{
                $result['mallList'] = $this->obj->getMallList(22);
            	if ($result['channeltype'] == -1) {
            		$result['tempindex'] = ($result['color'] == '') ? 'index_'.str_replace('/','',$result['arctype']['typeurl']) : 'index_'.$result['color'].'_'.str_replace('/','',$result['arctype']['typeurl']);
            	}
            	switch ($result['ispart']) {
            		case '0':
            			$temp = $result['templist'];
            			break;
            		case '1':
            			$temp = $result['tempindex'];
            			break;
            	}
            	return $this->fetch($this->template.$temp.$tempSuffix,['data' => $result]);
            }
        }
    }

    public function sgpage(){
        $data = $this->request->url();
        $tempSuffix = (strpos($this->request->host(),'m.') === false) ? '.php' : '_m.php';
        $dir = ($data == '/map/') ? 'map/index.html' : substr($data,1);
        dump($dir);
        $result = $this->obj->getSgpage($dir);
        // dump($result);
        if ($result == null || $result == false) {
            return $this->fetch($this->template.'404.html');
        }else{
            return $this->fetch($this->template.$result['template'].$tempSuffix,['data' => $result]);
        }
    }

    public function sitemap(){
        $result['arctype'] = $this->obj->getArctype();
        $result['areatype'] = $this->obj->getAreaType();
        $result['list'] = $this->obj->getArticleClassify();
        return $this->fetch($this->template.'sitemap.xml',['data' => $result]);
    }
}
