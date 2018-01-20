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

Route::get('/','index/index/index');
// Route::get('404','index/index/four',['ext' => 'html']);
Route::pattern(['id' => '[0-9]+','page' => 'p[0-9]+','area' => '[a-z]+','tags' => '[A-Za-z0-9]+','dir1' => '[A-Za-z0-9]+','dir2' => '[A-Za-z0-9]+','dir3' => '[A-Za-z0-9]+']);
Route::get('admin','admin/Index/index');
Route::get('about/:dir','index/Index/sgpage',['ext' => 'html',]);
Route::get('map','index/Index/sgpage');
Route::get('sitemap','index/Index/sitemap',['ext' => 'xml',]);

Route::get(':dir/:id','index/index/index',['ext' => 'html']);
Route::get(':dir1$','index/index/index',['ext' => '']);
Route::get(':dir1/:page$','index/index/index',['ext' => 'html']);
Route::get(':dir1/:dir2$','index/index/index',['ext' => '']);
Route::get(':dir1/:dir2/:page$','index/index/index',['ext' => 'html']);
Route::get(':dir1/:dir2/:dir3$','index/index/index',['ext' => '']);
Route::get(':dir1/:dir2/:dir3/:page$','index/index/index',['ext' => 'html']);


// Route::miss('/theme/tot/404.html','get');