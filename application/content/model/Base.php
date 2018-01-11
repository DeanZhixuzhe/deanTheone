<?php
namespace app\content\model;

use think\Model;

class Base extends Model
{
	// protected $insert = ['status' => 1];
	// protected $type = [
	// 	'relation_id' => 'integer',
	// 	'showdown' => 'integer',
	// ];

	public function getStatusAttr($value){
		$status = ['0' => '待审','1' => '正常','-1' => '删除','2' => '错误'];
		return $status[$value];
	}
}