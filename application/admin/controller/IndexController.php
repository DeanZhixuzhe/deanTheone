<?php
namespace app\admin\controller;

/**
* 
*/
class IndexController extends BaseController
{
	public function index(){
		return $this->fetch();
	}
	public function welcome(){
		return $this->fetch();
	}
}