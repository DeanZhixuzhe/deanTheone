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

return [
    // 生成应用公共文件
    '__file__' => ['common.php', 'config.php', 'database.php'],
    // 后台模块，不需要model，控制器根据实际需要功能添加调用
    'admin' => [
        '__file__' => ['common.php','config.php'],
        '__dir__' => ['behavior','controller','view'],
        'controller' => ['BaseController','IndexController','LoginController','ArticleController','CategoryController'],
        'view' => ['index_index','login_index'],
    ],
    // 前台模块，不需要model，控制器根据实际需要功能添加调用
    'index' => [
        '__file__' => ['common.php','config.php'],
        '__dir__' => ['behavior','controller','view'],
        'controller' => ['BaseController','IndexController','LoginController'],
        'view' => ['index_index','login_index'],
    ],
    // 其他所有功能模块不需要view视图层，只需要用model和controller做接口返回数据
    'content' => [
        '__file__' => ['common.php','config.php'],
        '__dir__' => ['behavior','controller','model'],
        'controller' => ['BaseController','ArticleController','AreaController','CategoryController','CaseController','VideoController'],
        'model' => ['Base','Article','Area','Category','Case','Video'],
    ],
];
