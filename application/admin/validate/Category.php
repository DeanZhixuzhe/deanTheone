<?php
namespace app\admin\validate;
use think\Validate;

/**
* 
*/
class Category extends Validate
{
	protected $rule = [
		['id','number'],
		['type|分类类型','require'],
		['name|分类名称','require|max:10'],
		['parent_id','number'],
		['dir|分类地址','require|alpha'],
		['status|状态','number|in:-1,0,1','状态必须是数字|状态码不合法'],
		['listorder|排序','number'],
		['visible','require'],
	];

	protected $scene = [
		'add' => ['name','parent_id','id'],
		'listorder' => ['id','listorder'],
		'status' => ['id','status'],
	];
}