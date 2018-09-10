/*
 Navicat MySQL Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50547
 Source Host           : localhost:3306
 Source Schema         : storedata

 Target Server Type    : MySQL
 Target Server Version : 50547
 File Encoding         : 65001

 Date: 10/09/2018 18:13:46
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for advertis
-- ----------------------------
DROP TABLE IF EXISTS `advertis`;
CREATE TABLE `advertis`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '广告id',
  `title` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '广告标题',
  `content` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '广告内容',
  `img` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '广告图片',
  `path` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '活动链接',
  `start` int(1) NULL DEFAULT NULL COMMENT '广告状态，0不启用，1启用',
  `location` int(10) NULL DEFAULT NULL COMMENT '广告位置',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '广告表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of advertis
-- ----------------------------
INSERT INTO `advertis` VALUES (1, '广告', '廓房间里时间', 'public/images/advertis/5b8cf78baea5f.jpg', NULL, 1, 1);
INSERT INTO `advertis` VALUES (2, '开始', '离开国际化的', 'public/images/advertis/5b8cf7671801f.jpg', NULL, 1, 1);

-- ----------------------------
-- Table structure for antistop
-- ----------------------------
DROP TABLE IF EXISTS `antistop`;
CREATE TABLE `antistop`  (
  `id` int(10) NOT NULL COMMENT '关键词 自增id',
  `keyword` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '关键词',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '关键词表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for brand
-- ----------------------------
DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '(品牌id自增)',
  `brand_name` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '品牌名称',
  `docs` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '品牌介绍',
  `img` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '品牌图片',
  `bot_price` decimal(10, 2) NULL DEFAULT NULL COMMENT '最低价格',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '品牌表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of brand
-- ----------------------------
INSERT INTO `brand` VALUES (1, 'iPhone', '苹果手机苹果手机苹果手机苹果手机', 'public/images/brand/5b8cf767186b5.jpg', 32.00);
INSERT INTO `brand` VALUES (2, '小米', '小米手机小米手机小米手机小米手机小米手机小米手机', 'public/images/brand/7c918f37de108f3687d69b39daab34eb.png', 25.00);

-- ----------------------------
-- Table structure for cate
-- ----------------------------
DROP TABLE IF EXISTS `cate`;
CREATE TABLE `cate`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '一级分类id 自增',
  `Cate_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '分类id',
  `Cate_name` varchar(10) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '分类名称',
  `icon` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '分类图标',
  `img` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '分类图片',
  `docs` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '分类简介',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '一级分类表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cate
-- ----------------------------
INSERT INTO `cate` VALUES (1, '1001000', '居家', 'public/images/icon/44ad9a739380aa6b7cf956fb2a06e7a7.png', 'public/images/classify/7c918f37de108f3687d69b39daab34eb.png', '舒适亲肤');
INSERT INTO `cate` VALUES (2, '1002000', '服装', 'public/images/icon/243e5bf327a87217ad1f54592f0176ec.png', 'public/images/classify/7c918f37de108f3687d69b39daab34eb.png', '贴身的，要亲肤');

-- ----------------------------
-- Table structure for contents
-- ----------------------------
DROP TABLE IF EXISTS `contents`;
CREATE TABLE `contents`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id自增',
  `contents` text CHARACTER SET gbk COLLATE gbk_chinese_ci NULL COMMENT '内容',
  `product_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '产品id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '商品详情内容表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for general_issue
-- ----------------------------
DROP TABLE IF EXISTS `general_issue`;
CREATE TABLE `general_issue`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `question` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '问题',
  `answer` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '回答',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '常见问题表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of general_issue
-- ----------------------------
INSERT INTO `general_issue` VALUES (1, '购买运费如何收取？', '单笔订单金额（不含运费）满88元免邮费；不满88元，每单收取10元运费。');
INSERT INTO `general_issue` VALUES (2, '使用什么快递发货？', '严选默认使用顺丰快递发货（个别商品使用其他快递），配送范围覆盖全国大部分地区');

-- ----------------------------
-- Table structure for parameter
-- ----------------------------
DROP TABLE IF EXISTS `parameter`;
CREATE TABLE `parameter`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id自增',
  `name` varchar(10) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '参数名称',
  `value` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '参数值',
  `product_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '产品id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '商品参数表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of parameter
-- ----------------------------
INSERT INTO `parameter` VALUES (1, '产地', '中国广东', '1');

-- ----------------------------
-- Table structure for product_master
-- ----------------------------
DROP TABLE IF EXISTS `product_master`;
CREATE TABLE `product_master`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id自增',
  `product_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '产品id',
  `path_img` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '图片路径',
  `time` datetime NULL DEFAULT NULL COMMENT '上传时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '商品主图表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_master
-- ----------------------------
INSERT INTO `product_master` VALUES (1, '1', 'public/images/master/5b8cf78baea5f.jpg', '2019-12-01 00:00:00');
INSERT INTO `product_master` VALUES (2, '1', 'public/images/master/5b8cf7671801f.jpg', '2018-10-12 00:00:00');
INSERT INTO `product_master` VALUES (3, '2', 'public/images/master/5b8cf7671801f.jpg', '2018-12-05 00:00:00');
INSERT INTO `product_master` VALUES (4, '2', 'public/images/master/7c918f37de108f3687d69b39daab34eb.png', '2017-11-09 00:00:00');

-- ----------------------------
-- Table structure for product_msg
-- ----------------------------
DROP TABLE IF EXISTS `product_msg`;
CREATE TABLE `product_msg`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `product_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '产品id',
  `name` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '产品名称',
  `number` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '产品编号',
  `docs` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '产品简介',
  `img` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '产品缩略图',
  `shop_price` decimal(10, 2) NULL DEFAULT NULL COMMENT '专柜价格（原价）',
  `at_price` decimal(10, 2) NULL DEFAULT NULL COMMENT '当前价格',
  `new_product` int(1) NULL DEFAULT NULL COMMENT '新品，0不是，1是',
  `hot_sale` int(1) NULL DEFAULT NULL COMMENT '热卖，0不是，1是',
  `sell` int(1) NULL DEFAULT NULL COMMENT '在售，0不是，1是',
  `antistop_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '关键词id',
  `Cate_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '分类id',
  `Sort_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '子分类id',
  `brand_id` int(10) NULL DEFAULT NULL COMMENT '品牌id',
  `parameter_id` int(10) NULL DEFAULT NULL COMMENT '商品参数id',
  `time` datetime NULL DEFAULT NULL COMMENT '上架时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '产品信息表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_msg
-- ----------------------------
INSERT INTO `product_msg` VALUES (1, '1', '苹果', '2001', '苹果苹果', 'public/images/thumbnail/5b8cf75d2583d.jpg', 25.00, 16.00, 1, 1, 1, '1', '1001000', '1001001', 1, 1, '2018-12-10 00:00:00');
INSERT INTO `product_msg` VALUES (2, '2', '手机', '2002', '手机手机手机手机', 'public/images/thumbnail/a8b0a5def7d64e411dd98bdfb1fc989b.png', 62.00, 120.00, 1, 0, 1, '1', '1001000', '1001001', 1, 1, '2019-11-05 00:00:00');
INSERT INTO `product_msg` VALUES (3, '3', '女装', '2003', '女装女装', 'public/images/thumbnail/a8b0a5def7d64e411dd98bdfb1fc989b.png', 78.00, 46.00, 1, 1, 1, '2', '1001000', '1001002', 2, 2, '2018-09-13 12:15:18');
INSERT INTO `product_msg` VALUES (4, '4', '宠物', '2001', '宠物宠物', 'public/images/thumbnail/5b8cf75d2583d.jpg', 104.00, 100.00, 1, 0, 1, '3', '1002000', '1002001', 3, 3, '2019-12-05 00:00:00');

-- ----------------------------
-- Table structure for product_sku
-- ----------------------------
DROP TABLE IF EXISTS `product_sku`;
CREATE TABLE `product_sku`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id自增',
  `selling_price` decimal(10, 2) NULL DEFAULT NULL COMMENT '商品售价',
  `count` int(10) NULL DEFAULT NULL COMMENT '商品数量',
  `img` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '商品图片',
  `product_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '产品id',
  `property_id` int(10) NULL DEFAULT NULL COMMENT '规格/属性id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '商品库存表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for property
-- ----------------------------
DROP TABLE IF EXISTS `property`;
CREATE TABLE `property`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '属性id',
  `name` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '属性名',
  `value` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '属性值',
  `img` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '图片',
  `product_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '产品id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '规格/属性表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of property
-- ----------------------------
INSERT INTO `property` VALUES (1, '规格', '标准', NULL, '1');

-- ----------------------------
-- Table structure for sort
-- ----------------------------
DROP TABLE IF EXISTS `sort`;
CREATE TABLE `sort`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '二级分类id 自增',
  `Sort_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '子分类id',
  `Sort_name` varchar(10) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '分类名称',
  `icon` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '分类图标',
  `img` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '分类图片',
  `docs` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '分类简介',
  `Cate_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '分类id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '二级分类表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sort
-- ----------------------------
INSERT INTO `sort` VALUES (1, '1001001', '单肩包', NULL, 'public/images/classify/7c918f37de108f3687d69b39daab34eb.png', '单肩包单肩包', '1001000');
INSERT INTO `sort` VALUES (2, '1001002', '杯壶', NULL, 'public/images/classify/7c918f37de108f3687d69b39daab34eb.png', '杯壶杯壶', '1001000');
INSERT INTO `sort` VALUES (3, '1002001', '宠物', NULL, 'public/images/classify/7c918f37de108f3687d69b39daab34eb.png', '宠物宠物', '1002000');

SET FOREIGN_KEY_CHECKS = 1;
