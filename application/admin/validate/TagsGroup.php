<?php
namespace app\admin\validate;
use think\Validate;

/**
* 
*/
class TagsGroup extends Validate
{
	protected $rule = [
		['id','number'],
		['name|分组名称','require|max:20|token'],
		['status|状态','number|in:-1,0,1','状态必须是数字|状态码不合法'],
	];

	protected $scene = [
		'add' => ['name','parent_id','id'],
		'listorder' => ['id','listorder'],
		'status' => ['id','status'],
	];
}