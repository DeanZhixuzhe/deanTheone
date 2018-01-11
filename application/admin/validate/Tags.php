<?php
namespace app\admin\validate;
use think\Validate;

/**
* 
*/
class Tags extends Validate
{
	protected $rule = [
		['id','number'],
		['name|标签名称','require|max:50|token'],
		['usname|英文名称','alpha'],
		['dir|标签地址','require|alpha'],
		['status|状态','number|in:-1,0,1','状态必须是数字|状态码不合法'],
		['listorder|排序','number'],
		['visible','require|number'],
	];

	protected $scene = [
		'add' => ['name','parent_id','id'],
		'listorder' => ['id','listorder'],
		'status' => ['id','status'],
	];
}