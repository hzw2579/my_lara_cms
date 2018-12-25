/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50720
Source Host           : localhost:3306
Source Database       : cms

Target Server Type    : MYSQL
Target Server Version : 50720
File Encoding         : 65001

Date: 2018-12-25 09:23:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cms_article
-- ----------------------------
DROP TABLE IF EXISTS `cms_article`;
CREATE TABLE `cms_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文章标题',
  `type` tinyint(4) NOT NULL COMMENT '类型',
  `subtitle` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '副标题',
  `keyword` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '关键词',
  `description` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文章描述',
  `author` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '作者',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章内容',
  `thumb` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '封面',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `like` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点赞',
  `read` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '阅读',
  `dummy_like` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '虚拟点赞',
  `dummy_read` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '虚拟阅读',
  `status` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cms_article
-- ----------------------------

-- ----------------------------
-- Table structure for cms_banner
-- ----------------------------
DROP TABLE IF EXISTS `cms_banner`;
CREATE TABLE `cms_banner` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '标题',
  `place` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '位置',
  `image` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '图片',
  `url` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '跳转链接',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cms_banner
-- ----------------------------

-- ----------------------------
-- Table structure for cms_banner_place
-- ----------------------------
DROP TABLE IF EXISTS `cms_banner_place`;
CREATE TABLE `cms_banner_place` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `width` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '宽度',
  `height` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '高度',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cms_banner_place
-- ----------------------------
INSERT INTO `cms_banner_place` VALUES ('1', '1', '1', '1', '2018-12-17 15:20:25', '2018-12-17 15:20:25', null);

-- ----------------------------
-- Table structure for cms_category
-- ----------------------------
DROP TABLE IF EXISTS `cms_category`;
CREATE TABLE `cms_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '分类名称',
  `type` int(10) unsigned NOT NULL COMMENT '分类类别',
  `pid` int(10) unsigned NOT NULL COMMENT '上级菜单',
  `account` text CHARACTER SET utf8mb4 COMMENT '分类描述',
  `icon` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '分类图标',
  `sort` tinyint(3) DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cms_category
-- ----------------------------
INSERT INTO `cms_category` VALUES ('1', 'admin', '1', '0', '1', null, '1', '1', '2018-12-17 15:16:05', '2018-12-17 15:16:08', '2018-12-17 15:16:08');

-- ----------------------------
-- Table structure for cms_category_type
-- ----------------------------
DROP TABLE IF EXISTS `cms_category_type`;
CREATE TABLE `cms_category_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '类型名称',
  `sort` tinyint(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cms_category_type
-- ----------------------------
INSERT INTO `cms_category_type` VALUES ('1', '文章类型', '1', '2018-12-17 14:58:39', '2018-12-17 14:58:39', null);

-- ----------------------------
-- Table structure for cms_link
-- ----------------------------
DROP TABLE IF EXISTS `cms_link`;
CREATE TABLE `cms_link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `url` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '链接地址',
  `target` tinyint(4) NOT NULL DEFAULT '1' COMMENT '打开方式1:新开窗口，0：当前窗口',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '链接图标',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '描述',
  `sort` tinyint(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cms_link
-- ----------------------------

-- ----------------------------
-- Table structure for cms_log
-- ----------------------------
DROP TABLE IF EXISTS `cms_log`;
CREATE TABLE `cms_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `name` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '用户名称',
  `url` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '访问路径',
  `behavior` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '行为',
  `controller` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '访问控制器',
  `sql` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '执行记录的语句',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cms_log
-- ----------------------------
INSERT INTO `cms_log` VALUES ('1', '1', 'admin', 'admin/login_now', '用户登录', 'IndexController@login_now', null, '2018-12-17 14:40:22', '2018-12-17 14:40:22');
INSERT INTO `cms_log` VALUES ('2', '1', 'admin', 'admin/user_edit/1', '用户修改个人信息', 'IndexController@user_edit', null, '2018-12-17 14:54:40', '2018-12-17 14:54:40');
INSERT INTO `cms_log` VALUES ('3', '1', 'admin', 'admin/article', '用户新增文章', 'ArticleController@store', null, '2018-12-17 14:57:50', '2018-12-17 14:57:50');
INSERT INTO `cms_log` VALUES ('4', '1', 'admin', 'admin/article', '用户新增文章', 'ArticleController@store', null, '2018-12-17 14:57:58', '2018-12-17 14:57:58');
INSERT INTO `cms_log` VALUES ('5', '1', 'admin', 'admin/article', '用户新增文章', 'ArticleController@store', null, '2018-12-17 15:01:19', '2018-12-17 15:01:19');
INSERT INTO `cms_log` VALUES ('6', '1', 'admin', 'admin/login_out', '用户退出登录', 'IndexController@login_out', null, '2018-12-17 15:45:40', '2018-12-17 15:45:40');
INSERT INTO `cms_log` VALUES ('7', '1', 'admin', 'admin/login_now', '用户登录', 'IndexController@login_now', null, '2018-12-17 15:50:24', '2018-12-17 15:50:24');
INSERT INTO `cms_log` VALUES ('8', '1', 'admin', 'admin/login_out', '用户退出登录', 'IndexController@login_out', null, '2018-12-17 16:12:25', '2018-12-17 16:12:25');
INSERT INTO `cms_log` VALUES ('9', '1', 'admin', 'admin/login_now', '用户登录', 'IndexController@login_now', null, '2018-12-17 16:13:06', '2018-12-17 16:13:06');
INSERT INTO `cms_log` VALUES ('10', '1', 'admin', 'admin/login_out', '用户退出登录', 'IndexController@login_out', null, '2018-12-17 17:43:20', '2018-12-17 17:43:20');
INSERT INTO `cms_log` VALUES ('11', '1', 'admin', 'admin/login_now', '用户登录', 'IndexController@login_now', null, '2018-12-17 17:52:09', '2018-12-17 17:52:09');
INSERT INTO `cms_log` VALUES ('12', '1', 'admin', 'admin/login_out', '用户退出登录', 'IndexController@login_out', null, '2018-12-17 17:53:03', '2018-12-17 17:53:03');
INSERT INTO `cms_log` VALUES ('13', '1', 'admin', 'admin/login_out', '用户退出登录', 'IndexController@login_out', null, '2018-12-24 11:44:19', '2018-12-24 11:44:19');
INSERT INTO `cms_log` VALUES ('14', '1', 'admin', 'admin/login_now', '用户登录', 'IndexController@login_now', null, '2018-12-24 11:44:47', '2018-12-24 11:44:47');
INSERT INTO `cms_log` VALUES ('15', '1', 'admin', 'admin/login_out', '用户退出登录', 'IndexController@login_out', null, '2018-12-24 14:28:26', '2018-12-24 14:28:26');
INSERT INTO `cms_log` VALUES ('16', '1', 'admin', 'admin/login_now', '用户登录', 'IndexController@login_now', null, '2018-12-24 14:28:45', '2018-12-24 14:28:45');
INSERT INTO `cms_log` VALUES ('17', '1', 'admin', 'admin/login_now', '用户登录', 'IndexController@login_now', null, '2018-12-24 14:32:52', '2018-12-24 14:32:52');
INSERT INTO `cms_log` VALUES ('18', '1', 'admin', 'admin/login_out', '用户退出登录', 'IndexController@login_out', null, '2018-12-24 14:40:38', '2018-12-24 14:40:38');
INSERT INTO `cms_log` VALUES ('19', '2', 'admin2', 'admin/login_now', '用户登录', 'IndexController@login_now', null, '2018-12-24 14:41:18', '2018-12-24 14:41:18');

-- ----------------------------
-- Table structure for cms_media
-- ----------------------------
DROP TABLE IF EXISTS `cms_media`;
CREATE TABLE `cms_media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文件原始名称',
  `type` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '素材类型',
  `src` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '链接地址',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cms_media
-- ----------------------------
INSERT INTO `cms_media` VALUES ('1', '3.png', 'img', 'http://kccdn.ywhwl.com/cms/3oVajGGiVrALHJmLXNdmjiDPQyJ2h8pwCYgyhC03.png', '2018-12-17 15:16:17', '2018-12-17 15:16:17');

-- ----------------------------
-- Table structure for cms_member
-- ----------------------------
DROP TABLE IF EXISTS `cms_member`;
CREATE TABLE `cms_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '电话',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '昵称',
  `heading` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '头像',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cms_member
-- ----------------------------

-- ----------------------------
-- Table structure for cms_messages
-- ----------------------------
DROP TABLE IF EXISTS `cms_messages`;
CREATE TABLE `cms_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '留言',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '类型：1：邮箱2：手机3：QQ 4：微信',
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '联系方式',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '附件',
  `handling` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '处理结果',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '留言状态',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cms_messages
-- ----------------------------

-- ----------------------------
-- Table structure for cms_migrations
-- ----------------------------
DROP TABLE IF EXISTS `cms_migrations`;
CREATE TABLE `cms_migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cms_migrations
-- ----------------------------
INSERT INTO `cms_migrations` VALUES ('1', '2018_12_07_143525_create_site_table', '1');
INSERT INTO `cms_migrations` VALUES ('2', '2018_12_07_143612_create_category_table', '1');
INSERT INTO `cms_migrations` VALUES ('3', '2018_12_07_143626_create_category_type_table', '1');
INSERT INTO `cms_migrations` VALUES ('4', '2018_12_07_143659_create_media_table', '1');
INSERT INTO `cms_migrations` VALUES ('5', '2018_12_08_093638_create_permission_tables', '1');
INSERT INTO `cms_migrations` VALUES ('6', '2018_12_10_093019_edit_permissions_table', '1');
INSERT INTO `cms_migrations` VALUES ('7', '2018_12_10_154544_create_link_table', '1');
INSERT INTO `cms_migrations` VALUES ('8', '2018_12_10_171745_create_messages_table', '1');
INSERT INTO `cms_migrations` VALUES ('9', '2018_12_11_104327_edit_category_table', '1');
INSERT INTO `cms_migrations` VALUES ('10', '2018_12_11_104348_edit_category_type_table', '1');
INSERT INTO `cms_migrations` VALUES ('11', '2018_12_11_143130_create_article_table', '1');
INSERT INTO `cms_migrations` VALUES ('12', '2018_12_14_150058_create_log_table', '1');
INSERT INTO `cms_migrations` VALUES ('13', '2018_12_07_000000_create_users_table', '2');
INSERT INTO `cms_migrations` VALUES ('14', '2018_12_12_093849_create_page_table', '3');
INSERT INTO `cms_migrations` VALUES ('15', '2018_12_12_093904_create_member_table', '3');
INSERT INTO `cms_migrations` VALUES ('16', '2018_12_12_093937_create_banner_table', '3');
INSERT INTO `cms_migrations` VALUES ('17', '2018_12_12_102056_create_banner_place_table', '3');

-- ----------------------------
-- Table structure for cms_model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `cms_model_has_permissions`;
CREATE TABLE `cms_model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `cms_permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cms_model_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for cms_model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `cms_model_has_roles`;
CREATE TABLE `cms_model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `cms_roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cms_model_has_roles
-- ----------------------------
INSERT INTO `cms_model_has_roles` VALUES ('2', 'App\\User', '2');

-- ----------------------------
-- Table structure for cms_page
-- ----------------------------
DROP TABLE IF EXISTS `cms_page`;
CREATE TABLE `cms_page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '标题',
  `subtitle` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '副标题',
  `keyword` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '关键词',
  `description` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '描述',
  `author` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '作者',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '页面内容',
  `thumb` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '封面',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cms_page
-- ----------------------------

-- ----------------------------
-- Table structure for cms_permissions
-- ----------------------------
DROP TABLE IF EXISTS `cms_permissions`;
CREATE TABLE `cms_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '权限备注说明',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cms_permissions
-- ----------------------------
INSERT INTO `cms_permissions` VALUES ('11', 'auth_set', 'web', '2018-12-24 14:35:35', '2018-12-24 14:35:35', '权限配置');
INSERT INTO `cms_permissions` VALUES ('12', 'user_set', 'web', '2018-12-24 14:37:17', '2018-12-24 14:37:17', '用户管理');
INSERT INTO `cms_permissions` VALUES ('13', 'system_site', 'web', '2018-12-24 14:47:27', '2018-12-24 14:47:27', '基本信息配置');
INSERT INTO `cms_permissions` VALUES ('14', 'cate_set', 'web', '2018-12-24 14:47:48', '2018-12-24 14:47:48', '分类相关设置');
INSERT INTO `cms_permissions` VALUES ('15', 'attach_set', 'web', '2018-12-24 14:48:03', '2018-12-24 14:48:03', '附件管理');
INSERT INTO `cms_permissions` VALUES ('16', 'article_set', 'web', '2018-12-24 14:48:22', '2018-12-24 14:48:22', '文章管理');
INSERT INTO `cms_permissions` VALUES ('17', 'banner_set', 'web', '2018-12-24 14:48:36', '2018-12-24 14:48:36', '广告管理');
INSERT INTO `cms_permissions` VALUES ('18', 'friends_link_set', 'web', '2018-12-24 14:48:50', '2018-12-24 14:48:50', '友情链接管理');
INSERT INTO `cms_permissions` VALUES ('19', 'single_page_set', 'web', '2018-12-24 14:49:04', '2018-12-24 14:49:04', '单页管理');
INSERT INTO `cms_permissions` VALUES ('20', 'message_set', 'web', '2018-12-24 14:49:18', '2018-12-24 14:49:18', '留言管理');

-- ----------------------------
-- Table structure for cms_roles
-- ----------------------------
DROP TABLE IF EXISTS `cms_roles`;
CREATE TABLE `cms_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cms_roles
-- ----------------------------
INSERT INTO `cms_roles` VALUES ('2', 'admin', 'web', '2018-12-24 14:35:42', '2018-12-24 14:35:42');

-- ----------------------------
-- Table structure for cms_role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `cms_role_has_permissions`;
CREATE TABLE `cms_role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `cms_permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `cms_roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cms_role_has_permissions
-- ----------------------------
INSERT INTO `cms_role_has_permissions` VALUES ('11', '2');
INSERT INTO `cms_role_has_permissions` VALUES ('12', '2');
INSERT INTO `cms_role_has_permissions` VALUES ('13', '2');
INSERT INTO `cms_role_has_permissions` VALUES ('14', '2');
INSERT INTO `cms_role_has_permissions` VALUES ('15', '2');
INSERT INTO `cms_role_has_permissions` VALUES ('16', '2');
INSERT INTO `cms_role_has_permissions` VALUES ('17', '2');
INSERT INTO `cms_role_has_permissions` VALUES ('18', '2');
INSERT INTO `cms_role_has_permissions` VALUES ('19', '2');
INSERT INTO `cms_role_has_permissions` VALUES ('20', '2');

-- ----------------------------
-- Table structure for cms_site
-- ----------------------------
DROP TABLE IF EXISTS `cms_site`;
CREATE TABLE `cms_site` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '站点名称',
  `domain` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '域名',
  `records_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备案号',
  `statistical_code` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '统计代码',
  `copyright` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '版权',
  `title_keyword` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '标题关键字',
  `meta_keyword` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'MATA关键词',
  `meta_describe` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'META描述',
  `company_name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '公司名称',
  `company_intro` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '公司介绍',
  `linkman` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '联系人',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '联系电话',
  `mobile_phone` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '移动电话',
  `fax` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '传真',
  `location` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '地址',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '邮箱',
  `qq` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'qq',
  `coord` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '地图坐标',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cms_site
-- ----------------------------
INSERT INTO `cms_site` VALUES ('1', '测试站点', 'http://www.baidu.com', '1', '1', '1', '111', '111', '111', '212', '111', '1', '1', '1', '1', '1', 'fivetong@163.com', '1', '1-1', null, '2018-12-17 15:14:15');

-- ----------------------------
-- Table structure for cms_users
-- ----------------------------
DROP TABLE IF EXISTS `cms_users`;
CREATE TABLE `cms_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cms_users
-- ----------------------------
INSERT INTO `cms_users` VALUES ('2', 'admin2', '123@123.com', '$2y$10$cWxRdwh2X/L3tfcniwKx8eGM7wG6w4RJDpDnHhhc/13QLFnNZdIs6', null, '2018-12-24 14:39:41', '2018-12-24 14:39:41');
