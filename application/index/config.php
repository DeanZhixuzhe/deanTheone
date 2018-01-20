<?php
//配置文件
return [
	'template'               => [
        // 模板引擎类型 支持 php think 支持扩展
        'type'         => 'Think',
        // 模板路径
        'view_path'    => './theme/tot/',
        // 模板后缀
        'view_suffix'  => 'php',
        // 模板文件名分隔符
        'view_depr'    => '_',
        // 模板引擎普通标签开始标记
        'tpl_begin'    => '{',
        // 模板引擎普通标签结束标记
        'tpl_end'      => '}',
        // 标签库标签开始标记
        'taglib_begin' => '{',
        // 标签库标签结束标记
        'taglib_end'   => '}',
        'path' => './theme/',
        'style' => 'tot',
        'webname'       => 'TheOne浪漫策划公司',
        'domain_root'   => 'theone.me',
        //'beian'         => '渝ICP备17003306号',
    ],
    'website'               => [
        'webname'       => 'TheOne浪漫策划公司',
        'domain'   => 'http://theone.me',
        'beian'         => '渝ICP备17003306号',
        'view_path'     => './theme/',
        'view_style'    => 'tot',
    ]
];