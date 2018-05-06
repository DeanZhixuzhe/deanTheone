<?php
namespace app\newretail\controller;
use think\Controller;
/**
* 
*/
class Incomeassessment extends Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index($title){
		if (strlen($title) < 6) {
			return $this->error('商品名称错误');
		}else{
			$datetime = substr($title,-6);
		}
		if (is_numeric($datetime)) {
			$year = '20'.substr($datetime,0,2);
			$month = substr($datetime,2,2);
			$day = substr($datetime,-2);
			$earningsTime = date('Y-m-d',strtotime($year.$month.$day)+3600*24*61);
			// dump(date('Y-m-d',strtotime($year.$month.$day)+3600*24*61));
			// dump(strtotime($year.$month.$day));
			$this->assign('earningsTime',$earningsTime);
			$this->assign('earningsPeriod',60);
		}else{
			return $this->error('商品名称错误');
		}
		return $this->fetch();
	}
}