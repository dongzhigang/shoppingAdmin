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

 Date: 27/09/2018 18:37:18
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for address
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address`  (
  `address_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '地址id',
  `user_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '用户id',
  `name` varchar(10) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '收货人',
  `phone` varchar(11) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '固定电话',
  `mobile` varchar(11) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '移动电话',
  `provinceName` varchar(10) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '省份',
  `cityName` varchar(10) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '城市',
  `areaName` varchar(10) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '区/县',
  `address` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '详细地址',
  `code` varchar(6) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '邮政编码',
  `Default` int(1) NULL DEFAULT NULL COMMENT '是否默认,1是默认，0不是',
  `time_create` datetime NULL DEFAULT NULL COMMENT '创建时间',
  `time_update` datetime NULL DEFAULT NULL COMMENT '更新时间'
) ENGINE = MyISAM CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '收货地址表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of address
-- ----------------------------
INSERT INTO `address` VALUES ('b86f3286e5ead46b638e72812d85d5fa', '3e5f208baaa6b3a370aaade99c1cb88b', 'hh', '', '13512345678', '北京市', '北京市', '东城区', '222', '000000', 0, '2018-09-27 15:13:10', NULL);
INSERT INTO `address` VALUES ('9d12b61f10f5834529505a66084ad519', '25e1ee5c5bde4bb8a2f791d3393b2fdf', '董先生', '', '13632482567', '北京市', '北京市', '东城区', '壬丰大夏', '000000', 0, NULL, NULL);
INSERT INTO `address` VALUES ('24df3abe23ee61ec65eac21e489b0723', '3e5f208baaa6b3a370aaade99c1cb88b', '董先生', '', '13612345678', '北京市', '北京市', '东城区', '1111', '000000', 0, '2018-09-27 15:08:13', '2018-09-27 15:13:27');

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
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '关键词 自增id',
  `keyword` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '关键词',
  `isHot` int(1) NULL DEFAULT NULL COMMENT '是否推荐，0不推荐，1推荐',
  `isDefault` int(1) NULL DEFAULT NULL COMMENT '是否默认，0不默认，1默认',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '关键词表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of antistop
-- ----------------------------
INSERT INTO `antistop` VALUES (1, '墨镜', 1, 1);
INSERT INTO `antistop` VALUES (2, '520元大礼包', 1, 0);
INSERT INTO `antistop` VALUES (3, '女装', 1, 0);

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
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '品牌表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of brand
-- ----------------------------
INSERT INTO `brand` VALUES (1, 'iPhone', '苹果手机苹果手机苹果手机苹果手机', 'public/images/brand/5b8cf767186b5.jpg', 32.00);
INSERT INTO `brand` VALUES (2, '小米', '小米手机小米手机小米手机小米手机小米手机小米手机', 'public/images/brand/7c918f37de108f3687d69b39daab34eb.png', 25.00);
INSERT INTO `brand` VALUES (3, '华为', '华为华为华为', 'public/images/brand/5b8cf767186b5.jpg', 15.00);

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
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id自增',
  `content` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '评论内容',
  `add_date` date NULL DEFAULT NULL COMMENT '评论时间',
  `user_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '用户id',
  `product_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '商品id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '评论表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of comment
-- ----------------------------
INSERT INTO `comment` VALUES (1, '更加的了解更多了解', '2018-12-01', '1', '1');
INSERT INTO `comment` VALUES (2, '更加的了解更多了解更加的了解更多了解', '2015-05-01', '2', '1');

-- ----------------------------
-- Table structure for comment_img
-- ----------------------------
DROP TABLE IF EXISTS `comment_img`;
CREATE TABLE `comment_img`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '评论id',
  `pathUrl` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '评论图片',
  `add_date` date NULL DEFAULT NULL COMMENT '添加时间',
  `comment_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '评论id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '评论图片' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of comment_img
-- ----------------------------
INSERT INTO `comment_img` VALUES (1, 'public/images/comment/a8b0a5def7d64e411dd98bdfb1fc989b.png', '2014-12-11', '1');
INSERT INTO `comment_img` VALUES (2, 'public/images/comment/a8b0a5def7d64e411dd98bdfb1fc989b.png', '2015-12-12', '2');

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
-- Table structure for goods_car
-- ----------------------------
DROP TABLE IF EXISTS `goods_car`;
CREATE TABLE `goods_car`  (
  `cart_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '购物车id',
  `product_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '商品id',
  `user_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '用户id',
  `num` int(10) NULL DEFAULT NULL COMMENT '商品数量',
  `property_val` varchar(50) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '属性值',
  `time_create` datetime NULL DEFAULT NULL COMMENT '创建时间',
  `time_update` datetime NULL DEFAULT NULL COMMENT '更新时间'
) ENGINE = MyISAM CHARACTER SET = gbk COLLATE = gbk_chinese_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of goods_car
-- ----------------------------
INSERT INTO `goods_car` VALUES ('96df92077a0794533bb424a3b960c019', '4', '25e1ee5c5bde4bb8a2f791d3393b2fdf', 9, '标准', '2018-09-18 18:31:47', '2018-09-27 14:50:10');
INSERT INTO `goods_car` VALUES ('0ecf0000542133155c0ef848e4d18d07', '1', '25e1ee5c5bde4bb8a2f791d3393b2fdf', 1, '28,红色', '2018-09-18 18:33:38', '2018-09-18 18:33:38');

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order`  (
  `order_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '订单id',
  `order_number` varchar(100) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '订单编号',
  `payment` int(1) NULL DEFAULT NULL COMMENT '支付类型，1在线支付、2货到付款',
  `post_fee` varchar(50) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '邮费',
  `status` int(1) NULL DEFAULT NULL COMMENT '订单状态，1未付款，2待发货，3待收货，4待评价，5已付款，6已发货，7交易成功，8交易关闭',
  `add_time` datetime NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime NULL DEFAULT NULL COMMENT '更新时间',
  `payment_time` datetime NULL DEFAULT NULL COMMENT '付款时间',
  `consign_time` datetime NULL DEFAULT NULL COMMENT '发货时间',
  `shipping_name` varchar(20) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '物流名称',
  `shipping_code` varchar(20) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '物流单号',
  `user_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '用户id',
  `buyer_message` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '买家留言',
  `buyer_nick` varchar(10) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '买家昵称',
  `buyer_raqte` int(1) NULL DEFAULT NULL COMMENT '买家是否评价',
  `goodsPrice` decimal(10, 2) NULL DEFAULT NULL COMMENT '商品合计',
  `actualPrice` decimal(10, 2) NULL DEFAULT NULL COMMENT '商品实付'
) ENGINE = MyISAM CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '订单表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES ('fe158d92700f0b144ae86173c3b591af', '201809181754165723846408', NULL, '0', 1, '2018-09-18 17:54:16', NULL, NULL, NULL, NULL, NULL, '25e1ee5c5bde4bb8a2f791d3393b2fdf', NULL, NULL, NULL, 100.00, 100.00);
INSERT INTO `order` VALUES ('73abb27ff87d167143f53caa122822a8', '201809181754183055541913', NULL, '0', 1, '2018-09-18 17:54:18', NULL, NULL, NULL, NULL, NULL, '25e1ee5c5bde4bb8a2f791d3393b2fdf', NULL, NULL, NULL, 100.00, 100.00);
INSERT INTO `order` VALUES ('d8db3e9159661c3635f18fce44106072', '201809181754248507232615', NULL, '0', 1, '2018-09-18 17:54:24', NULL, NULL, NULL, NULL, NULL, '25e1ee5c5bde4bb8a2f791d3393b2fdf', NULL, NULL, NULL, 100.00, 100.00);
INSERT INTO `order` VALUES ('b9fdbb5b122470d9dc25eb03790c7480', '201809181757246972442605', NULL, '0', 1, '2018-09-18 17:57:24', NULL, NULL, NULL, NULL, NULL, '25e1ee5c5bde4bb8a2f791d3393b2fdf', NULL, NULL, NULL, 100.00, 100.00);
INSERT INTO `order` VALUES ('57056af55197db94f793eeb06d6672a7', '201809181757536121276810', NULL, '0', 1, '2018-09-18 17:57:53', NULL, NULL, NULL, NULL, NULL, '25e1ee5c5bde4bb8a2f791d3393b2fdf', NULL, NULL, NULL, 100.00, 100.00);
INSERT INTO `order` VALUES ('68dbc558661151ab149de00b365601e0', '201809181759004100891125', NULL, '0', 1, '2018-09-18 17:59:00', NULL, NULL, NULL, NULL, NULL, '25e1ee5c5bde4bb8a2f791d3393b2fdf', NULL, NULL, NULL, 100.00, 100.00);
INSERT INTO `order` VALUES ('3f66b85c73d7a25cc08d6dc3af090279', '201809181759578266082798', NULL, '0', 1, '2018-09-18 17:59:57', NULL, NULL, NULL, NULL, NULL, '25e1ee5c5bde4bb8a2f791d3393b2fdf', NULL, NULL, NULL, 16.00, 16.00);
INSERT INTO `order` VALUES ('e110f5f3d744e42097f34190e50f701b', '201809181801197981536804', NULL, '0', 1, '2018-09-18 18:01:19', NULL, NULL, NULL, NULL, NULL, '25e1ee5c5bde4bb8a2f791d3393b2fdf', NULL, NULL, NULL, 466.00, 466.00);
INSERT INTO `order` VALUES ('28d12adbb5dbb7daeca8c9423ec395f5', '201809271453252712219225', NULL, '0', 1, '2018-09-27 14:53:25', NULL, NULL, NULL, NULL, NULL, '3e5f208baaa6b3a370aaade99c1cb88b', NULL, NULL, NULL, 100.00, 100.00);

-- ----------------------------
-- Table structure for order_item
-- ----------------------------
DROP TABLE IF EXISTS `order_item`;
CREATE TABLE `order_item`  (
  `product_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '商品id',
  `order_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '订单id',
  `num` int(10) NULL DEFAULT NULL COMMENT '商品购物数量',
  `title` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '商品标题',
  `price` decimal(50, 2) NULL DEFAULT NULL COMMENT '商品单价',
  `total_fee` decimal(50, 2) NULL DEFAULT NULL COMMENT '商品总金额',
  `pic_path` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '商品图片地址',
  `property_val` varchar(50) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '属性值'
) ENGINE = MyISAM CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '订单商品表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_item
-- ----------------------------
INSERT INTO `order_item` VALUES ('4', 'fe158d92700f0b144ae86173c3b591af', 1, '宠物', 100.00, 100.00, 'shoppingAdmin/public/images/thumbnail/5b8cf75d2583d.jpg', '标准');
INSERT INTO `order_item` VALUES ('4', '73abb27ff87d167143f53caa122822a8', 1, '宠物', 100.00, 100.00, 'shoppingAdmin/public/images/thumbnail/5b8cf75d2583d.jpg', '标准');
INSERT INTO `order_item` VALUES ('4', 'd8db3e9159661c3635f18fce44106072', 1, '宠物', 100.00, 100.00, 'shoppingAdmin/public/images/thumbnail/5b8cf75d2583d.jpg', '标准');
INSERT INTO `order_item` VALUES ('4', 'b9fdbb5b122470d9dc25eb03790c7480', 1, '宠物', 100.00, 100.00, 'shoppingAdmin/public/images/thumbnail/5b8cf75d2583d.jpg', '标准');
INSERT INTO `order_item` VALUES ('4', '57056af55197db94f793eeb06d6672a7', 1, '宠物', 100.00, 100.00, 'shoppingAdmin/public/images/thumbnail/5b8cf75d2583d.jpg', '标准');
INSERT INTO `order_item` VALUES ('4', '68dbc558661151ab149de00b365601e0', 1, '宠物', 100.00, 100.00, 'shoppingAdmin/public/images/thumbnail/5b8cf75d2583d.jpg', '标准');
INSERT INTO `order_item` VALUES ('1', '3f66b85c73d7a25cc08d6dc3af090279', 1, '苹果', 16.00, 16.00, 'shoppingAdmin/public/images/thumbnail/5b8cf75d2583d.jpg', '28,红色');
INSERT INTO `order_item` VALUES ('4', 'e110f5f3d744e42097f34190e50f701b', 3, '宠物', 100.00, 300.00, 'shoppingAdmin/public/images/thumbnail/5b8cf75d2583d.jpg', '标准');
INSERT INTO `order_item` VALUES ('2', 'e110f5f3d744e42097f34190e50f701b', 1, '手机', 120.00, 120.00, 'shoppingAdmin/public/images/thumbnail/a8b0a5def7d64e411dd98bdfb1fc989b.png', '标准');
INSERT INTO `order_item` VALUES ('3', 'e110f5f3d744e42097f34190e50f701b', 1, '女装', 46.00, 46.00, 'shoppingAdmin/public/images/thumbnail/a8b0a5def7d64e411dd98bdfb1fc989b.png', '标准');
INSERT INTO `order_item` VALUES ('4', '28d12adbb5dbb7daeca8c9423ec395f5', 1, '宠物', 100.00, 100.00, 'shoppingAdmin/public/images/thumbnail/5b8cf75d2583d.jpg', '标准');

-- ----------------------------
-- Table structure for order_shipping
-- ----------------------------
DROP TABLE IF EXISTS `order_shipping`;
CREATE TABLE `order_shipping`  (
  `order_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '订单id',
  `name` varchar(20) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '收货人全名',
  `phone` varchar(20) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '固定电话',
  `mobile` varchar(30) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '移动电话',
  `address` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '收货地址',
  `code` varchar(6) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '邮政编码'
) ENGINE = MyISAM CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '物流表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_shipping
-- ----------------------------
INSERT INTO `order_shipping` VALUES ('fe158d92700f0b144ae86173c3b591af', '董先生', '', '13632482567', '北京市北京市东城区壬丰大夏', '000000');
INSERT INTO `order_shipping` VALUES ('73abb27ff87d167143f53caa122822a8', '董先生', '', '13632482567', '北京市北京市东城区壬丰大夏', '000000');
INSERT INTO `order_shipping` VALUES ('d8db3e9159661c3635f18fce44106072', '董先生', '', '13632482567', '北京市北京市东城区壬丰大夏', '000000');
INSERT INTO `order_shipping` VALUES ('b9fdbb5b122470d9dc25eb03790c7480', '董先生', '', '13632482567', '北京市北京市东城区壬丰大夏', '000000');
INSERT INTO `order_shipping` VALUES ('57056af55197db94f793eeb06d6672a7', '董先生', '', '13632482567', '北京市北京市东城区壬丰大夏', '000000');
INSERT INTO `order_shipping` VALUES ('68dbc558661151ab149de00b365601e0', '董先生', '', '13632482567', '北京市北京市东城区壬丰大夏', '000000');
INSERT INTO `order_shipping` VALUES ('3f66b85c73d7a25cc08d6dc3af090279', '董先生', '', '13632482567', '北京市北京市东城区壬丰大夏', '000000');
INSERT INTO `order_shipping` VALUES ('e110f5f3d744e42097f34190e50f701b', '董先生', '', '13632482567', '北京市北京市东城区壬丰大夏', '000000');
INSERT INTO `order_shipping` VALUES ('28d12adbb5dbb7daeca8c9423ec395f5', '董先生', '', '13612345678', '北京市北京市东城区1111', '000000');

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
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '商品参数表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of parameter
-- ----------------------------
INSERT INTO `parameter` VALUES (1, '产地', '中国广东', '1');
INSERT INTO `parameter` VALUES (2, '品牌', '华为', '1');

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
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '产品信息表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_msg
-- ----------------------------
INSERT INTO `product_msg` VALUES (1, '1', '苹果', '2001', '苹果苹果', 'public/images/thumbnail/5b8cf75d2583d.jpg', 25.00, 16.00, 1, 1, 1, '1', '1001000', '1001001', 1, 1, '2018-12-10 00:00:00');
INSERT INTO `product_msg` VALUES (2, '2', '手机', '2002', '手机手机手机手机', 'public/images/thumbnail/a8b0a5def7d64e411dd98bdfb1fc989b.png', 62.00, 120.00, 1, 1, 1, '1', '1001000', '1001001', 1, 1, '2019-11-05 00:00:00');
INSERT INTO `product_msg` VALUES (3, '3', '女装', '2003', '女装女装', 'public/images/thumbnail/a8b0a5def7d64e411dd98bdfb1fc989b.png', 78.00, 46.00, 1, 1, 1, '2', '1001000', '1001002', 2, 2, '2018-09-13 12:15:18');
INSERT INTO `product_msg` VALUES (4, '4', '宠物', '2001', '宠物宠物', 'public/images/thumbnail/5b8cf75d2583d.jpg', 104.00, 100.00, 1, 1, 1, '3', '1002000', '1002001', 3, 3, '2019-12-05 00:00:00');
INSERT INTO `product_msg` VALUES (5, '5', '苹果2', '20055', '苹果苹果333333', 'public/images/thumbnail/a8b0a5def7d64e411dd98bdfb1fc989b.png', 210.00, 185.00, 1, 1, 1, '1', '1001000', '1001002', 3, 3, '2017-12-02 00:00:00');

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
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '商品库存表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_sku
-- ----------------------------
INSERT INTO `product_sku` VALUES (1, 12.00, 56, NULL, '1', 1);
INSERT INTO `product_sku` VALUES (2, 15.00, 12, NULL, '2', 2);
INSERT INTO `product_sku` VALUES (3, 15.00, 24, NULL, '3', 3);
INSERT INTO `product_sku` VALUES (4, 15.00, 28, NULL, '4', 4);
INSERT INTO `product_sku` VALUES (5, 15.00, 26, NULL, '5', 5);
INSERT INTO `product_sku` VALUES (6, 15.00, 26, NULL, '1', 6);

-- ----------------------------
-- Table structure for property
-- ----------------------------
DROP TABLE IF EXISTS `property`;
CREATE TABLE `property`  (
  `name_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '属性id',
  `value_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '属性值id',
  `product_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '商品id'
) ENGINE = MyISAM CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '属性、属性值、商品关联表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of property
-- ----------------------------
INSERT INTO `property` VALUES ('1', '1', '1');
INSERT INTO `property` VALUES ('2', '2', '2');
INSERT INTO `property` VALUES ('3', '3', '3');
INSERT INTO `property` VALUES ('4', '4', '4');
INSERT INTO `property` VALUES ('5', '5', '5');
INSERT INTO `property` VALUES ('6', '6', '1');
INSERT INTO `property` VALUES ('6', '7', '1');

-- ----------------------------
-- Table structure for property_name
-- ----------------------------
DROP TABLE IF EXISTS `property_name`;
CREATE TABLE `property_name`  (
  `name_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '属性id',
  `name` varchar(10) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '规格/属性名',
  `product_id` int(11) NULL DEFAULT NULL COMMENT '商品id'
) ENGINE = MyISAM CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '规格/属性值表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of property_name
-- ----------------------------
INSERT INTO `property_name` VALUES ('1', '规格', 1);
INSERT INTO `property_name` VALUES ('2', '规格', 2);
INSERT INTO `property_name` VALUES ('3', '规格', 3);
INSERT INTO `property_name` VALUES ('4', '规格', 4);
INSERT INTO `property_name` VALUES ('5', '规格', 5);
INSERT INTO `property_name` VALUES ('6', '颜色', 1);

-- ----------------------------
-- Table structure for property_value
-- ----------------------------
DROP TABLE IF EXISTS `property_value`;
CREATE TABLE `property_value`  (
  `value_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '属性值id',
  `value` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '属性值',
  `img` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '图片',
  `name_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '产品id'
) ENGINE = MyISAM CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '规格/属性名表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of property_value
-- ----------------------------
INSERT INTO `property_value` VALUES ('1', '28', NULL, '1');
INSERT INTO `property_value` VALUES ('2', '标准', NULL, '2');
INSERT INTO `property_value` VALUES ('3', '标准', NULL, '3');
INSERT INTO `property_value` VALUES ('4', '标准', NULL, '4');
INSERT INTO `property_value` VALUES ('5', '标准', NULL, '5');
INSERT INTO `property_value` VALUES ('6', '红色', NULL, '6');
INSERT INTO `property_value` VALUES ('7', '绿色', NULL, '6');

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

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `user_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '用户id',
  `nickName` varchar(10) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '呢称',
  `userName` varchar(10) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '用户名',
  `password` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '用户密码',
  `imgUrl` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '用户头像',
  `mobile` varchar(11) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '手机号码',
  `sex` int(1) NULL DEFAULT NULL COMMENT '性别。0是未知，1是女，2是男',
  `birthday` date NULL DEFAULT NULL COMMENT '出生日期',
  `userLevel` int(1) NULL DEFAULT NULL COMMENT '用户等级，0普通，1VIP，2高级VIP',
  `state` int(1) NULL DEFAULT NULL COMMENT '用户状态，0可用，1禁用，2注销',
  `time_create` datetime NULL DEFAULT NULL COMMENT '创建时间',
  `time_update` datetime NULL DEFAULT NULL COMMENT '更新时间'
) ENGINE = MyISAM CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '用户表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('25e1ee5c5bde4bb8a2f791d3393b2fdf', '张三', 'admin2', 'af26610db5e49dd014584b03cd4d3599', 'public/images/user/5b8cf75d2583d.jpg', '13632482567', 0, '1993-10-07', 0, 0, '2018-09-25 00:00:00', '2018-09-27 15:18:52');
INSERT INTO `user` VALUES ('7d4cf78869933b8484059aa73682c680', NULL, '123456', '9cbf8a4dcb8e30682b927f352d6559a0', NULL, '13632482567', 0, '2018-09-26', 0, 0, '2018-09-26 00:00:00', NULL);
INSERT INTO `user` VALUES ('4011ab3f72723a78129068a682820c7f', NULL, '444', '9cbf8a4dcb8e30682b927f352d6559a0', NULL, '13612345678', 0, '2018-09-26', 0, 0, '2018-09-26 00:00:00', NULL);
INSERT INTO `user` VALUES ('8cc54a6e17e5ade6748b1948934cf766', NULL, '666', '9cbf8a4dcb8e30682b927f352d6559a0', NULL, '13612345678', 0, '2018-09-05', 0, 0, '2018-09-26 00:00:00', NULL);
INSERT INTO `user` VALUES ('578c36da0b64aa4379927b04f235ee48', NULL, '777', '9cbf8a4dcb8e30682b927f352d6559a0', NULL, '13612345678', 0, '2018-09-05', 0, 0, '2018-09-26 00:00:00', NULL);
INSERT INTO `user` VALUES ('44d48c84bc1cfac6a9d3244f2d2899cb', NULL, '888', '9cbf8a4dcb8e30682b927f352d6559a0', NULL, '13612345678', 0, '2018-09-12', 0, 0, '2018-09-26 00:00:00', NULL);
INSERT INTO `user` VALUES ('d576faac06d4095ef9da98800d752809', NULL, '888', '9cbf8a4dcb8e30682b927f352d6559a0', NULL, '13612345678', 0, '2018-09-27', 0, 0, '2018-09-26 00:00:00', NULL);
INSERT INTO `user` VALUES ('e553a1ccddf5d4bfa90d82699219cd56', NULL, '刘德华', '9cbf8a4dcb8e30682b927f352d6559a0', NULL, '13612345678', 0, '2018-09-20', 0, 0, '2018-09-26 00:00:00', NULL);
INSERT INTO `user` VALUES ('a5f8389db9ea106858802ec8a56aad25', NULL, '11', '9cbf8a4dcb8e30682b927f352d6559a0', NULL, '13632482567', 0, '2018-09-19', 0, 0, '2018-09-26 12:09:46', NULL);
INSERT INTO `user` VALUES ('e83987810fbc2d97a26377b8167dcdfd', NULL, '11', '9cbf8a4dcb8e30682b927f352d6559a0', NULL, '13632482567', 0, '2018-09-19', 0, 0, '2018-09-26 12:22:09', NULL);
INSERT INTO `user` VALUES ('6b6a0475c80440dc39a4a23b867e5535', NULL, '1', '9cbf8a4dcb8e30682b927f352d6559a0', NULL, '13512345678', 0, '2018-09-20', 0, 0, '2018-09-26 12:24:23', NULL);
INSERT INTO `user` VALUES ('953afbe8692015be17c21657d0904f12', NULL, '1a', '9cbf8a4dcb8e30682b927f352d6559a0', NULL, '13612345678', 0, '2018-09-05', 0, 0, '2018-09-26 12:26:25', NULL);
INSERT INTO `user` VALUES ('3e5f208baaa6b3a370aaade99c1cb88b', NULL, 'admin', '9cbf8a4dcb8e30682b927f352d6559a0', NULL, '13632482567', 0, '1993-10-07', 0, 0, '2018-09-26 15:03:30', '2018-09-26 15:06:51');

SET FOREIGN_KEY_CHECKS = 1;
