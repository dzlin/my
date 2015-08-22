/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : iyouteam

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2015-08-22 19:32:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for iyou_operatioin
-- ----------------------------
DROP TABLE IF EXISTS `iyou_operatioin`;
CREATE TABLE `iyou_operatioin` (
  `oid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '操作ID',
  `operation` varchar(45) CHARACTER SET utf8 DEFAULT NULL COMMENT '操作名称',
  `code` varchar(45) CHARACTER SET utf8 DEFAULT NULL COMMENT '操作编码',
  `pid` int(11) unsigned DEFAULT NULL COMMENT '父操作ID',
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='操作表';

-- ----------------------------
-- Records of iyou_operatioin
-- ----------------------------

-- ----------------------------
-- Table structure for iyou_permission
-- ----------------------------
DROP TABLE IF EXISTS `iyou_permission`;
CREATE TABLE `iyou_permission` (
  `pid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '权限ID',
  `type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '权限类型',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='权限表';

-- ----------------------------
-- Records of iyou_permission
-- ----------------------------

-- ----------------------------
-- Table structure for iyou_permission_operation
-- ----------------------------
DROP TABLE IF EXISTS `iyou_permission_operation`;
CREATE TABLE `iyou_permission_operation` (
  `pid` int(11) unsigned DEFAULT NULL COMMENT '权限ID',
  `oid` int(11) unsigned DEFAULT NULL COMMENT '操作ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='权限操作关联表';

-- ----------------------------
-- Records of iyou_permission_operation
-- ----------------------------

-- ----------------------------
-- Table structure for iyou_role
-- ----------------------------
DROP TABLE IF EXISTS `iyou_role`;
CREATE TABLE `iyou_role` (
  `rid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `role` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '角色名称',
  PRIMARY KEY (`rid`),
  KEY `index_rid` (`rid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='角色表';

-- ----------------------------
-- Records of iyou_role
-- ----------------------------
INSERT INTO `iyou_role` VALUES ('1', '新注册用户');

-- ----------------------------
-- Table structure for iyou_role_permission
-- ----------------------------
DROP TABLE IF EXISTS `iyou_role_permission`;
CREATE TABLE `iyou_role_permission` (
  `rid` int(11) unsigned DEFAULT NULL COMMENT '角色ID',
  `pid` int(11) unsigned DEFAULT NULL COMMENT '权限ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='角色权限关联表';

-- ----------------------------
-- Records of iyou_role_permission
-- ----------------------------

-- ----------------------------
-- Table structure for iyou_user
-- ----------------------------
DROP TABLE IF EXISTS `iyou_user`;
CREATE TABLE `iyou_user` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键，用户ID',
  `email` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '用户邮箱，不可重复',
  `password` char(32) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '登陆密码',
  `salt` char(8) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '用户安全码',
  `username` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '用户名，昵称，对外显示',
  `registerTime` int(11) unsigned DEFAULT '0' COMMENT '用户注册时间戳',
  `lastLoginTime` int(11) unsigned DEFAULT '0' COMMENT '最后登录时间',
  `state` tinyint(1) unsigned DEFAULT '0' COMMENT '用户状态值，默认只有0时可用',
  `aid` int(11) unsigned DEFAULT '0' COMMENT '用户社团ID',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `index_unique_user_email` (`email`) COMMENT '邮箱唯一索引，提高登陆邮箱检索'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户表';

-- ----------------------------
-- Records of iyou_user
-- ----------------------------
INSERT INTO `iyou_user` VALUES ('1', 'zhangsan@163.com', null, null, null, '0', '0', '0', '0');
INSERT INTO `iyou_user` VALUES ('3', 'lisi@163.com', null, null, null, '0', '0', '0', '0');

-- ----------------------------
-- Table structure for iyou_user_group
-- ----------------------------
DROP TABLE IF EXISTS `iyou_user_group`;
CREATE TABLE `iyou_user_group` (
  `gid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组ID',
  `groupName` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '用户组名称',
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户组表';

-- ----------------------------
-- Records of iyou_user_group
-- ----------------------------
INSERT INTO `iyou_user_group` VALUES ('1', '新注册用户组');

-- ----------------------------
-- Table structure for iyou_user_group_role
-- ----------------------------
DROP TABLE IF EXISTS `iyou_user_group_role`;
CREATE TABLE `iyou_user_group_role` (
  `gid` int(11) unsigned DEFAULT NULL COMMENT '用户组ID',
  `rid` int(11) unsigned DEFAULT NULL COMMENT '角色ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户组角色关联表';

-- ----------------------------
-- Records of iyou_user_group_role
-- ----------------------------

-- ----------------------------
-- Table structure for iyou_user_role
-- ----------------------------
DROP TABLE IF EXISTS `iyou_user_role`;
CREATE TABLE `iyou_user_role` (
  `uid` int(11) unsigned DEFAULT NULL COMMENT '用户ID',
  `rid` int(11) unsigned DEFAULT NULL COMMENT '角色ID',
  KEY `fk_ref_role_rid_idx` (`rid`),
  KEY `fk_ref_user_uid` (`uid`),
  CONSTRAINT `fk_ref_role_rid` FOREIGN KEY (`rid`) REFERENCES `iyou_role` (`rid`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_ref_user_uid` FOREIGN KEY (`uid`) REFERENCES `iyou_user` (`uid`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户角色关联表';

-- ----------------------------
-- Records of iyou_user_role
-- ----------------------------
INSERT INTO `iyou_user_role` VALUES ('3', '1');

-- ----------------------------
-- Table structure for iyou_user_user_group
-- ----------------------------
DROP TABLE IF EXISTS `iyou_user_user_group`;
CREATE TABLE `iyou_user_user_group` (
  `uid` int(11) unsigned DEFAULT NULL COMMENT '用户ID',
  `gid` int(11) unsigned DEFAULT NULL COMMENT '用户组ID',
  KEY `fk_ref_user_uid_idx` (`uid`),
  KEY `fk_ref_user_group_gid_idx` (`gid`),
  CONSTRAINT `fk_ref_user_uid_2` FOREIGN KEY (`uid`) REFERENCES `iyou_user` (`uid`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_ref_user_group_gid_2` FOREIGN KEY (`gid`) REFERENCES `iyou_user_group` (`gid`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户用户组关联表';

-- ----------------------------
-- Records of iyou_user_user_group
-- ----------------------------
INSERT INTO `iyou_user_user_group` VALUES ('3', '1');
DROP TRIGGER IF EXISTS `iyou_user_AFTER_INSERT`;
DELIMITER ;;
CREATE TRIGGER `iyou_user_AFTER_INSERT` AFTER INSERT ON `iyou_user` FOR EACH ROW BEGIN
insert into `iyou_user_role`(`uid`,`rid`)values(new.uid, 1);
insert into `iyou_user_user_group`(`uid`,`gid`)values(new.uid,1);
END
;;
DELIMITER ;
