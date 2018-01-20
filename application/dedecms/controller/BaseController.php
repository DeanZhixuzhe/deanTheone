<?php
namespace app\dedecms\controller;

use think\Controller;
use think\Request;
use think\Loader;
use app\dedecms\model\Archives;
use app\dedecms\model\Arctype;
use app\dedecms\model\Addonarticle;
use app\dedecms\model\Addoncase;
use app\dedecms\model\Addonfakecomment;
use app\dedecms\model\Addonfakefeedback;
use app\dedecms\model\Addonshop;
use app\dedecms\model\Addonvideo;
use app\dedecms\model\Channeltype;
use app\dedecms\model\Keywords;
use app\dedecms\model\Sgpage;
/**
* 
*/
class BaseController extends Controller
{
	protected $archives;
	protected $arctype;
	protected $article;
	protected $case;
	protected $fakecomment;
	protected $fakefeedback;
	protected $shop;
	protected $video;
	protected $channeltype;
	protected $keywords;
	protected $sgpage;
	function __construct(Archives $archives = null,Arctype $arctype = null,Addonarticle $article = null,Addoncase $case = null,Addonfakecomment $fakecomment = null,Addonfakefeedback $fakefeedback = null,Addonshop $shop = null,Addonvideo $video = null,Channeltype $channeltype = null,Keywords $keywords = null,$sgpage = null){
		parent::__construct();
		if (is_null($archives)) {
			$archives = new Archives;
		}
		if (is_null($arctype)) {
			$arctype = new Arctype;
		}
		if (is_null($article)) {
			$article = new Addonarticle;
		}
		if (is_null($case)) {
			$case = new Addoncase;
		}
		if (is_null($fakecomment)) {
			$fakecomment = new Addonfakecomment;
		}
		if (is_null($fakefeedback)) {
			$fakefeedback = new Addonfakefeedback;
		}
		if (is_null($shop)) {
			$shop = new Addonshop;
		}
		if (is_null($video)) {
			$video = new Addonvideo;
		}
		if (is_null($channeltype)) {
			$channeltype = new Channeltype;
		}
		if (is_null($keywords)) {
			$keywords = new Keywords;
		}
		if (is_null($sgpage)) {
			$sgpage = new Sgpage;
		}
		$this->archives = $archives;
		$this->arctype = $arctype;
		$this->article = $article;
		$this->case = $case;
		$this->fakecomment = $fakecomment;
		$this->fakefeedback = $fakefeedback;
		$this->shop = $shop;
		$this->video = $video;
		$this->channeltype = $channeltype;
		$this->keywords = $keywords;
		$this->sgpage = $sgpage;
	}

}
?>