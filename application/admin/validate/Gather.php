<?php
namespace app\admin\validate;
use think\Validate;

/**
* 
*/
class Gather extends Validate
{
	protected $rule = [
		['id','number'],
		['name|规则名称','require|max:100|token'],
		
	];

	protected $scene = [
		'add' => ['name','parent_id','id'],
		'listorder' => ['id','listorder'],
		'status' => ['id','status'],
	];
}