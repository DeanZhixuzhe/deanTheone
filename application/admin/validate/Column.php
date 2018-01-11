<?php
namespace app\admin\validate;
use think\Validate;

/**
* 
*/
class Column extends Validate
{
	protected $rule = [
		['id','number'],
		['name|栏目名称','require|max:30|token'],
		['status|状态','number|in:-1,0,1','状态必须是数字|状态码不合法'],
	];

	protected $scene = [
		'add' => ['name','parent_id','id'],
		'listorder' => ['id','listorder'],
		'status' => ['id','status'],
	];
}