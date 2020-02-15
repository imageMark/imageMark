/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : ailablecopy

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2020-02-15 16:23:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cnpo_admin
-- ----------------------------
DROP TABLE IF EXISTS `cnpo_admin`;
CREATE TABLE `cnpo_admin` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(20) NOT NULL COMMENT '用户名',
  `password` varchar(100) NOT NULL COMMENT '密码',
  `auth_key` varchar(50) DEFAULT NULL COMMENT 'KEY',
  `password_reset_token` varchar(50) DEFAULT NULL COMMENT '密码重置',
  `thumb_key` varchar(50) DEFAULT NULL COMMENT '头像key',
  `thumb_url` varchar(100) DEFAULT NULL COMMENT '头像url',
  `nickname` varchar(20) DEFAULT NULL COMMENT '别名',
  `role_id` int(5) NOT NULL DEFAULT '0' COMMENT '关联角色',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` int(11) NOT NULL COMMENT '添加时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cnpo_admin
-- ----------------------------
INSERT INTO `cnpo_admin` VALUES ('2', 'admin', '$2y$13$M.ge95mq/7rCDIGa0CDbcuX.nT7vL9FHfvQ9zMlONm7eWpi2djxZG', 'WUJWw4T2XiM8jsKJaRT7fUoXaQGNnA9C', null, '', null, '', '0', '1', '1526615081', '1575461792');

-- ----------------------------
-- Table structure for cnpo_permission
-- ----------------------------
DROP TABLE IF EXISTS `cnpo_permission`;
CREATE TABLE `cnpo_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `permission` varchar(50) NOT NULL COMMENT '权限规则',
  `name` varchar(50) NOT NULL COMMENT '权限名称',
  `permission_level` int(3) NOT NULL COMMENT '权限等级',
  `parent_id` int(8) NOT NULL DEFAULT '0' COMMENT '上级权限',
  `sort` int(5) DEFAULT NULL COMMENT '排序',
  `icon` varchar(255) DEFAULT NULL COMMENT '图标',
  `status` int(3) NOT NULL DEFAULT '1' COMMENT '状态 1有效 5无效',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COMMENT='权限表';

-- ----------------------------
-- Records of cnpo_permission
-- ----------------------------
INSERT INTO `cnpo_permission` VALUES ('6', 'admin', '管理员管理', '1', '0', '6', ' fa-hand-peace-o', '1', '1531639957', '1575426917');
INSERT INTO `cnpo_permission` VALUES ('7', 'admin/admin/index', '管理员列表', '2', '6', '1', null, '1', '1531639993', '1531639993');
INSERT INTO `cnpo_permission` VALUES ('8', 'admin/permission/index', '权限管理', '2', '6', '2', null, '1', '1531640071', '1531640071');
INSERT INTO `cnpo_permission` VALUES ('9', 'admin/role/index', '角色管理', '2', '6', '3', ' fa-bars', '1', '1531640116', '1531719595');
INSERT INTO `cnpo_permission` VALUES ('28', 'system', '系统管理', '1', '0', '5', '', '1', '1531725690', '1531725690');
INSERT INTO `cnpo_permission` VALUES ('47', 'project', '项目管理', '1', '0', '1', '', '1', '1572266588', '1580889154');
INSERT INTO `cnpo_permission` VALUES ('48', 'project/project/index', '项目管理', '2', '47', '1', '', '1', '1572266646', '1580889184');
INSERT INTO `cnpo_permission` VALUES ('49', 'work', '我的工作区', '1', '0', '1', '', '1', '1580611455', '1581249749');
INSERT INTO `cnpo_permission` VALUES ('50', 'work/work/index', '数据标注', '2', '49', '1', '', '1', '1580611486', '1581249779');
INSERT INTO `cnpo_permission` VALUES ('51', 'image/image/index', '数据管理', '2', '47', '2', '', '1', '1581247542', '1581247542');

-- ----------------------------
-- Table structure for cnpo_permission_role
-- ----------------------------
DROP TABLE IF EXISTS `cnpo_permission_role`;
CREATE TABLE `cnpo_permission_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `role_id` int(6) NOT NULL COMMENT '角色ID',
  `permission_id` int(6) NOT NULL COMMENT '权限ID',
  `status` int(3) NOT NULL DEFAULT '1' COMMENT '状态 1有效 5无效',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='角色权限表';

-- ----------------------------
-- Records of cnpo_permission_role
-- ----------------------------

-- ----------------------------
-- Table structure for cnpo_system_role
-- ----------------------------
DROP TABLE IF EXISTS `cnpo_system_role`;
CREATE TABLE `cnpo_system_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(50) NOT NULL COMMENT '角色名称',
  `remark` varchar(100) NOT NULL DEFAULT '' COMMENT '角色说明',
  `status` int(3) NOT NULL DEFAULT '1' COMMENT '状态 1有效 5无效',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of cnpo_system_role
-- ----------------------------

-- ----------------------------
-- Table structure for project
-- ----------------------------
DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `project_name` varchar(100) NOT NULL COMMENT '项目名称',
  `description` varchar(100) NOT NULL COMMENT '项目介绍',
  `operator_id` int(5) NOT NULL DEFAULT '0' COMMENT '操作人员',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` int(11) NOT NULL COMMENT '添加时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of project
-- ----------------------------

-- ----------------------------
-- Table structure for project_admin
-- ----------------------------
DROP TABLE IF EXISTS `project_admin`;
CREATE TABLE `project_admin` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `project_id` varchar(100) NOT NULL COMMENT '项目ID',
  `admin_id` varchar(100) NOT NULL COMMENT '项目成员ID',
  `operator_id` int(5) NOT NULL DEFAULT '0' COMMENT '操作人员',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` int(11) NOT NULL COMMENT '添加时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of project_admin
-- ----------------------------
INSERT INTO `project_admin` VALUES ('6', '4', '6', '2', '1', '1581169995', '1581169995');
INSERT INTO `project_admin` VALUES ('7', '5', '4', '2', '1', '1581573084', '1581573084');
INSERT INTO `project_admin` VALUES ('8', '5', '5', '2', '1', '1581573084', '1581573084');
INSERT INTO `project_admin` VALUES ('9', '5', '6', '2', '1', '1581573084', '1581573084');
INSERT INTO `project_admin` VALUES ('10', '4', '5', '2', '1', '1581592501', '1581592501');
INSERT INTO `project_admin` VALUES ('11', '4', '7', '2', '1', '1581592501', '1581592501');

-- ----------------------------
-- Table structure for project_files
-- ----------------------------
DROP TABLE IF EXISTS `project_files`;
CREATE TABLE `project_files` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `project_id` varchar(100) NOT NULL COMMENT '项目ID',
  `file_name` varchar(100) NOT NULL COMMENT '项目成员ID',
  `operator_id` int(5) NOT NULL DEFAULT '0' COMMENT '操作人员',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` int(11) NOT NULL COMMENT '添加时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of project_files
-- ----------------------------

-- ----------------------------
-- Table structure for project_image
-- ----------------------------
DROP TABLE IF EXISTS `project_image`;
CREATE TABLE `project_image` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `project_id` varchar(100) NOT NULL COMMENT '项目ID',
  `file_id` int(5) NOT NULL COMMENT '文件ID',
  `image_name` varchar(100) NOT NULL COMMENT '图片名称',
  `image_url` varchar(100) NOT NULL COMMENT '图片地址',
  `image_annotation` varchar(500) NOT NULL DEFAULT '' COMMENT '图片标注信息',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1未标注  5标注  8 审核',
  `operator_id` int(5) NOT NULL DEFAULT '0' COMMENT '上传人员',
  `label_user` int(5) NOT NULL DEFAULT '0' COMMENT '标注人员',
  `created_at` int(11) NOT NULL COMMENT '添加时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of project_image
-- ----------------------------

-- ----------------------------
-- Table structure for project_label
-- ----------------------------
DROP TABLE IF EXISTS `project_label`;
CREATE TABLE `project_label` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `project_id` varchar(100) NOT NULL COMMENT '项目ID',
  `label_name` varchar(100) NOT NULL COMMENT '项目成员ID',
  `operator_id` int(5) NOT NULL DEFAULT '0' COMMENT '操作人员',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` int(11) NOT NULL COMMENT '添加时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of project_label
-- ----------------------------
