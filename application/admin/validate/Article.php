<?php
namespace app\admin\validate;
use think\Validate;

/**
* 
*/
class Article extends Validate
{
	protected $rule = [
		['id','number'],
		['title|标题','require|max:80|token'],
		['category_id|分类','require|number'],
		['area_id|地区','number'],
		// ['thumb|缩略图','require'],
		['source|来源','max:100'],
		['writer|作者','max:20'],
		['keywords|关键词','max:100'],
		['description|描述','require|max:250'],
		['content|内容','require'],
		['click|浏览','number'],
		['status|状态','number|in:-1,0,1','状态必须是数字|状态码不合法'],
	];

	protected $scene = [
		'add' => ['name','parent_id','id'],
		'listorder' => ['id','listorder'],
		'status' => ['id','status'],
	];
}