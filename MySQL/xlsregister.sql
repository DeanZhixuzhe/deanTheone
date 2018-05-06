DROP TABLE IF EXISTS `xlsregister`;
CREATE TABLE `xlsregister` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `username` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `terminal` varchar(20) NOT NULL DEFAULT '' COMMENT '注册终端',
  `user_agent` varchar(255) NOT NULL DEFAULT '' COMMENT 'UA信息',
  `ip` varchar(20) NOT NULL DEFAULT '' COMMENT 'IP地址',
  `create_time` int(10) DEFAULT '0' COMMENT '注册时间',
  `update_time` int(10) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1028 DEFAULT CHARSET=utf8 COMMENT='后台管理员表';