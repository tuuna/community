CREATE TABLE `dh_user` (
`id` int(11) NOT NULL AUTO_INCREMENT COMMENT "自增ID",
`username` varchar(255) NOT NULL COMMENT "用户名",
`password` varchar(255) NOT NULL COMMENT "加密密码",
`studnetid` varchar(60) NOT NULL default '' COMMENT "学生证号",
`officialphone` varchar(60) NOT NULL default '' COMMENT "电话号码",
`idpic` varchar(255) COMMENT "身份证或学生证图片存储路径",
`email` varchar(255) NOT NULL COMMENT "邮箱",
`officialemail` varchar(60) NOT NULL DEFAULT '' COMMENT "活动号邮件",
`principal` varchar(40) NOT NULL DEFAULT '' COMMENT "活动负责人",
`role` smallint(6) NOT NULL DEFAULT "10" COMMENT "角色等级",
`status` tinyint(1) NOT NULL DEFAULT "1" COMMENT "状态",
`created_at` int(11) NOT NULL COMMENT "创建时间",
`updated_at` int(11) NOT NULL COMMENT "更新时间",
UNIQUE dh_user_username_password(`username`,`password`),
UNIQUE dh_user_email_password(`email`,`password`),
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT="用户表";