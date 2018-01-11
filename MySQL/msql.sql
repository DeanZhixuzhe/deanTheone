#分类表
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`(
   `id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '分类名',
   `usname` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '分类英文名',
   `parent_id` INT(10) NOT NULL DEFAULT 0 COMMENT '上级ID',
   `dir` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '分类URL',
   `path` VARCHAR(80) NOT NULL DEFAULT '' COMMENT '层级路径',
   `type` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '分类类型',
   `listorder` INT(8) NOT NULL DEFAULT 0 COMMENT '排序',
   `status` SMALLINT(1) NOT NULL DEFAULT 1 COMMENT '状态：1正常 0待审 -1删除,或者其他',
   `thumb` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '缩略图',
   `visible` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '是否显示：1显示0隐藏',
   `title` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '标题',
   `keywords` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '关键词',
   `description` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '描述',
   `create_time` INT(10) NOT NULL DEFAULT 0 COMMENT '创建时间',
   `update_time` INT(10) NOT NULL DEFAULT 0 COMMENT '更新时间',
   PRIMARY KEY ( `id` ),
   KEY parent_id(`parent_id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

#标签表
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags`(
   `id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '标签名',
   `usname` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '标签英文名',
   `dir` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '标签URL',
   `listorder` INT(8) NOT NULL DEFAULT 0 COMMENT '排序',
   `status` SMALLINT(1) NOT NULL DEFAULT 1 COMMENT '状态：1正常 0待审 -1删除,或者其他',
   `thumb` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '缩略图',
   `visible` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '是否显示：1显示0隐藏',
   `title` VARCHAR(100) NOT NULL DEFAULT '' COMMENT 'SEO标题',
   `keywords` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '关键词',
   `description` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '描述',
   `create_time` INT(10) NOT NULL DEFAULT 0 COMMENT '创建时间',
   `update_time` INT(10) NOT NULL DEFAULT 0 COMMENT '更新时间',
   PRIMARY KEY ( `id` ),
   KEY dir(`dir`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

#组合栏目表
DROP TABLE IF EXISTS `column`;
CREATE TABLE `column`(
   `id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
   `category_id` INT(10) NOT NULL DEFAULT 0 COMMENT '分类ID',
   `area_group_id` INT(10) NOT NULL DEFAULT 0 COMMENT '地区分组',
   `tags_group_id` INT(10) NOT NULL DEFAULT 0 COMMENT '标签分组',
   `rule` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '栏目规则',
   `url` VARCHAR(50) NOT NULL DEFAULT '' COMMENT 'URL',
   `name` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '名字',
   `title` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '标题',
   `keywords` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '关键词',
   `description` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '描述',
   `position` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '当前位置',
   `status` SMALLINT(1) NOT NULL DEFAULT 1 COMMENT '状态：1正常 0待审 -1删除,或者其他',
   `create_time` INT(10) NOT NULL DEFAULT 0 COMMENT '创建时间',
   `update_time` INT(10) NOT NULL DEFAULT 0 COMMENT '更新时间',
   PRIMARY KEY ( `id` )
)ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

#标签分组关联表
DROP TABLE IF EXISTS `tags_group_relation`;
CREATE TABLE `tags_group_relation`(
   `tags_group_id` INT(10) NOT NULL DEFAULT 0 COMMENT '分组ID',
   `tags_id` INT(10) NOT NULL DEFAULT 0 COMMENT '关联ID'
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

#标签分组表
DROP TABLE IF EXISTS `tags_group`;
CREATE TABLE `tags_group`(
   `id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(30) NOT NULL DEFAULT '' COMMENT '分组名称',
   `status` SMALLINT(1) NOT NULL DEFAULT 1 COMMENT '状态：1正常 0待审 -1删除,或者其他',
   `create_time` INT(10) NOT NULL DEFAULT 0 COMMENT '创建时间',
   `update_time` INT(10) NOT NULL DEFAULT 0 COMMENT '更新时间',
   PRIMARY KEY ( `id` )
)ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

#地区分组关联表
DROP TABLE IF EXISTS `area_group_relation`;
CREATE TABLE `area_group_relation`(
   `area_group_id` INT(10) NOT NULL DEFAULT 0 COMMENT '分组ID',
   `area_id` INT(10) NOT NULL DEFAULT 0 COMMENT '关联ID'
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

#地区分组表
DROP TABLE IF EXISTS `area_group`;
CREATE TABLE `area_group`(
   `id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(30) NOT NULL DEFAULT '' COMMENT '分组名称',
   `showdown` SMALLINT(1) NOT NULL DEFAULT 0 COMMENT '显示子级：1显示 0隐藏',
   `status` SMALLINT(1) NOT NULL DEFAULT 1 COMMENT '状态：1正常 0待审 -1删除,或者其他',
   `create_time` INT(10) NOT NULL DEFAULT 0 COMMENT '创建时间',
   `update_time` INT(10) NOT NULL DEFAULT 0 COMMENT '更新时间',
   PRIMARY KEY ( `id` )
)ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

#友链表
DROP TABLE IF EXISTS `friendlink`;
CREATE TABLE `friendlink`(
   `id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(30) NOT NULL DEFAULT '' COMMENT '名称',
   `url` VARCHAR(100) NOT NULL DEFAULT '' COMMENT 'URL',
   `open` INT(1) NOT NULL DEFAULT 1 COMMENT '打开方式：1新窗口 2本窗口 3上级窗口',
   `show` INT(1) NOT NULL DEFAULT 1 COMMENT '显示方式：1文本 2图文',
   `thumb` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '缩略图',
   `column_rule` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '栏目规则',
   `status` SMALLINT(1) NOT NULL DEFAULT 1 COMMENT '状态：1正常 0待审 -1删除,或者其他',
   `create_time` INT(10) NOT NULL DEFAULT 0 COMMENT '创建时间',
   `update_time` INT(10) NOT NULL DEFAULT 0 COMMENT '更新时间',
   PRIMARY KEY ( `id` )
)ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

#内容关系表 - 分类、地区、标签的关联表
DROP TABLE IF EXISTS `content_relation`;
CREATE TABLE `content_relation`(
   `id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
   `content_id` INT(10) NOT NULL DEFAULT 0 COMMENT '内容ID',
   `category_id` INT(10) NOT NULL DEFAULT 0 COMMENT '分类ID',
   `area_id` INT(10) NOT NULL DEFAULT 0 COMMENT '地区ID',
   `tags_id` INT(10) NOT NULL DEFAULT 0 COMMENT '标签ID',
   PRIMARY KEY ( `id` ),
   KEY content_id(`content_id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

#文章表
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article`(
   `id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
   `title` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '标题',
   `shorttitle` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '短标题',
   `category_id` INT(10) NOT NULL DEFAULT 0 COMMENT '分类ID',
   `area_id` INT(10) NOT NULL DEFAULT 0 COMMENT '地区ID',
   `thumb` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '缩略图',
   `source` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '来源',
   `writer` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '作者',
   `keywords` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '关键词',
   `description` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '描述',
   `content` MEDIUMTEXT NOT NULL DEFAULT '' COMMENT '内容',
   `click` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '点击',
   `status` SMALLINT(1) NOT NULL DEFAULT 1 COMMENT '状态：1正常0待审-1删除,或者其他',
   `create_time` INT(10) NOT NULL DEFAULT 0 COMMENT '创建时间',
   `update_time` INT(10) NOT NULL DEFAULT 0 COMMENT '更新时间',
   PRIMARY KEY ( `id` ),
   KEY category_id(`category_id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=10001;

#视频表
DROP TABLE IF EXISTS `video`;
CREATE TABLE `video`(
   `id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
   `title` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '标题',
   `shorttitle` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '短标题',
   `category_id` INT(10) NOT NULL DEFAULT 0 COMMENT '分类ID',
   `area_id` INT(10) NOT NULL DEFAULT 0 COMMENT '地区ID',
   `thumb` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '缩略图',
   `source` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '来源',
   `writer` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '作者',
   `keywords` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '关键词',
   `description` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '描述',
   `click` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '点击',
   `status` SMALLINT(1) NOT NULL DEFAULT 1 COMMENT '状态：1正常0待审-1删除,或者其他',
   `create_time` INT(10) NOT NULL DEFAULT 0 COMMENT '创建时间',
   `update_time` INT(10) NOT NULL DEFAULT 0 COMMENT '更新时间',
   PRIMARY KEY ( `id` ),
   KEY category_id(`category_id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=10001;