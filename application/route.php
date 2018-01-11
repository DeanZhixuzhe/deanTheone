<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
Route::miss('/theme/tot/404.html','get');
Route::get('/','index/index/index');

Route::pattern(['id' => '[0-9]+','area' => '[a-z]+','tags' => '[a-z]+','column' => '[a-z]+',]);
// Route::get('tags/:tags$','index/Content/listtags');
Route::get('admin','admin/Index/index');
// Route::get();

// Route::get(':column$','index/Content/columnone');
// Route::get(':column/:column$','index/Content/columntwo');
// Route::get(':column/:column/:column$','index/Content/columntwosan');
// Route::get(':category/:id$','index/Content/article');	//内容地址
// Route::rule(':dir','index/List/index?type=list','get',['param_depr' => '','ext' => 'html|']);

// Route::get('');
