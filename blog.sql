/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-12-23 11:55:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `dzy_admin`
-- ----------------------------
DROP TABLE IF EXISTS `dzy_admin`;
CREATE TABLE `dzy_admin` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `pwd` varchar(32) DEFAULT NULL,
  `salt` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dzy_admin
-- ----------------------------
INSERT INTO `dzy_admin` VALUES ('1', 'admin', '71b27f7b09b14cb0988257ab4b07520a', 'FFO18mfqy1TtQt3r');

-- ----------------------------
-- Table structure for `dzy_articles`
-- ----------------------------
DROP TABLE IF EXISTS `dzy_articles`;
CREATE TABLE `dzy_articles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL COMMENT '标题',
  `abstract` varchar(100) DEFAULT NULL COMMENT '摘要',
  `content` text COMMENT '正文',
  `createtime` int(10) DEFAULT NULL COMMENT '创建时间',
  `author` varchar(50) DEFAULT NULL COMMENT '文章作者',
  `category` int(10) DEFAULT NULL COMMENT '文章类别',
  `illustration` varchar(100) DEFAULT NULL COMMENT '插图',
  `is_hide` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dzy_articles
-- ----------------------------
INSERT INTO `dzy_articles` VALUES ('1', '这是测试文章sdf', '这里是描述sdf', '&lt;p&gt;这&lt;span style=&quot;color: rgb(255, 0, 0);&quot;&gt;里是内容sdf&lt;/span&gt;&lt;/p&gt;&lt;pre class=&quot;brush:php;toolbar:false&quot;&gt;&amp;lt;?php\r\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;echo&amp;nbsp;&amp;quot;hello&amp;nbsp;word!&amp;quot;;\r\n?&amp;gt;&lt;/pre&gt;&lt;p&gt;&lt;span style=&quot;color: rgb(255, 0, 0);&quot;&gt;&lt;/span&gt;&lt;br/&gt;&lt;/p&gt;', '1499443200', '碎念f', '1', '/uploads/article/20171221/b791af5ea57d2a3c9c1b97fda07e9c71.jpg', '0');
INSERT INTO `dzy_articles` VALUES ('7', 'ThinkPHP5部署到服务器上踩得坑', '策划四时间周', '&lt;p&gt;测试时间周的&lt;/p&gt;', '1513514776', '碎念', '3', '/uploads/article/20171221/528069d57bfc9096abe8ff004bf0c62d.jpg', '0');
INSERT INTO `dzy_articles` VALUES ('4', 'sql慢查询', 'ysql优化', '&lt;p&gt;内容是随意写的&lt;/p&gt;', '1513182724', '碎念', '2', '/uploads/article/20171221/9f90a259a6f849ebd76ecb3d7aa33329.jpg', '0');
INSERT INTO `dzy_articles` VALUES ('6', 'test', 'test', '&lt;p&gt;测试下这里是不是第一&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '1467907200', '碎念', '1', '/uploads/article/20171221/518db0653687a8fdc599ff2acb0c5b15.jpg', '0');

-- ----------------------------
-- Table structure for `dzy_articles_category`
-- ----------------------------
DROP TABLE IF EXISTS `dzy_articles_category`;
CREATE TABLE `dzy_articles_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `sort` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dzy_articles_category
-- ----------------------------
INSERT INTO `dzy_articles_category` VALUES ('1', 'PHP', '1000');
INSERT INTO `dzy_articles_category` VALUES ('2', 'MySQL', '999');
INSERT INTO `dzy_articles_category` VALUES ('3', 'Python', '888');
INSERT INTO `dzy_articles_category` VALUES ('4', '前端', '777');
INSERT INTO `dzy_articles_category` VALUES ('5', '杂谈', '666');

-- ----------------------------
-- Table structure for `dzy_sysset`
-- ----------------------------
DROP TABLE IF EXISTS `dzy_sysset`;
CREATE TABLE `dzy_sysset` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `blog_title` varchar(50) DEFAULT NULL COMMENT '前端博客名',
  `admin_title` varchar(50) DEFAULT NULL,
  `about_me` varchar(200) DEFAULT NULL,
  `footer` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=REDUNDANT;

-- ----------------------------
-- Records of dzy_sysset
-- ----------------------------
INSERT INTO `dzy_sysset` VALUES ('5', '碎念De博客', '碎念De博客后台', 'PHP程序猿一枚', '碎念De博客  Design by dzy');
