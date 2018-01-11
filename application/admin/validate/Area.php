<?php
namespace app\admin\validate;
use think\Validate;

/**
* 
*/
class Area extends Validate
{
	protected $rule = [
		['id','number'],
		['name|地区名称','require|max:20|token'],
		['usname|英文名称','alpha'],
		['abbr|英文缩写','alpha'],
		['parent_id','number'],
		['listorder|排序','number'],
	];

	protected $scene = [
		'add' => ['name','parent_id','id'],
		'listorder' => ['id','listorder'],
		'status' => ['id','status'],
	];
}