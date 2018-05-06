<?php
namespace app\newretail\controller;
use think\Controller;
use app\newretail\model\Xlsregister;
/**
* 
*/
class Register extends Controller
{
	protected $pcurl,$mobileurl;
	function __construct(){
		parent::__construct();
		$this->pcurl = 'http://oa.mccaee.com:16950/SelfOpenAccount/goIndex.action?brokerageId=6080888&name=yanky';
		$this->mobileurl = 'http://oa.mccaee.com:16950/SelfOpenAccount/goRegisterMobile.action?brokerageId=6080888&name=yanky';
	}
	
	public function index(){
		$register = new Xlsregister;
		$data['terminal'] = $this->request->isMobile() ? 'mobile' : 'pc';
		$data['user_agent'] = $this->request->header('user-agent');
		$data['ip'] = $this->request->ip();
		$result = $register->allowField(true)->save($data);
		dump($data);
		if ($result) {
			if ($this->request->isMobile()) {
				header('Location: '.$this->mobileurl);exit();
			}else{
				header('Location: '.$this->pcurl);exit();
			}
		}		
	}
}