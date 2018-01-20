<?php
namespace app\dedecms\model;

use think\Model;
// use think\Config;
class Base extends Model
{
	protected $connection = 'local_db';
    // protected $connection = 'hdm140015610_db';
	
	protected $type = [
		'pubdate' => 'timestamp:Y-m-d H:i',
	];
	// protected $insert = ['status' => 1];
	// protected $type = [
	// 	'relation_id' => 'integer',
	// 	'showdown' => 'integer',
	// ];

	// public function getStatusAttr($value){
	// 	$status = ['0' => '待审','1' => '正常','-1' => '删除','2' => '错误'];
	// 	return $status[$value];
	// }
}