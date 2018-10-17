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

 Date: 17/10/2018 18:26:57
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
  `keyword_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '关键词id',
  `user_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '用户id',
  `keyword` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '关键词',
  `isHot` int(1) NULL DEFAULT NULL COMMENT '是否推荐，0不推荐，1推荐',
  `isDefault` int(1) NULL DEFAULT NULL COMMENT '是否默认，0不默认，1默认',
  `genre` int(1) NULL DEFAULT NULL COMMENT '1是关键词，2是搜索历史',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '关键词表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of antistop
-- ----------------------------
INSERT INTO `antistop` VALUES (1, NULL, NULL, '墨镜', 1, 1, NULL);
INSERT INTO `antistop` VALUES (2, NULL, NULL, '520元大礼包', 1, 0, NULL);
INSERT INTO `antistop` VALUES (3, NULL, NULL, '女装', 1, 0, NULL);

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
  `Cate_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '分类id',
  `Cate_name` varchar(10) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '分类名称',
  `icon` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '分类图标',
  `img` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '分类图片',
  `docs` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '分类简介',
  `grade` varchar(1) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '1一级，2二级'
) ENGINE = MyISAM CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '一级分类表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cate
-- ----------------------------
INSERT INTO `cate` VALUES ('0cfafbd975407db31726ef3b249d1363', '手机数码', 'http://127.0.0.1/shoppingAdmin/public/images/classify/5bc69a63bf1b1.jpg', 'http://127.0.0.1/shoppingAdmin/public/images/classify/5bc69a65cc771.jpg', '手机数码手机数码手机数码手机数码1', '1');
INSERT INTO `cate` VALUES ('d75d2b8fbcc49c46f563e2ce25ad30dc', '服装', 'http://127.0.0.1/shoppingAdmin/public/images/classify/5bc6d2d57931a.png', 'http://127.0.0.1/shoppingAdmin/public/images/classify/5bc6d2d87ae27.jpg', '服装服装服装', '1');

-- ----------------------------
-- Table structure for collect
-- ----------------------------
DROP TABLE IF EXISTS `collect`;
CREATE TABLE `collect`  (
  `collect_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '收藏id',
  `user_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '用户id',
  `product_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '商品id',
  `add_time` datetime NULL DEFAULT NULL COMMENT '添加时间'
) ENGINE = MyISAM CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '收藏表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of collect
-- ----------------------------
INSERT INTO `collect` VALUES ('6d125bb612f66ea46c548fb6159b8888', '3e5f208baaa6b3a370aaade99c1cb88b', '1', '2018-09-28 17:47:33');
INSERT INTO `collect` VALUES ('f2c357219b26af8089eb18b15b6372b7', '3e5f208baaa6b3a370aaade99c1cb88b', '4', '2018-09-28 17:47:27');
INSERT INTO `collect` VALUES ('69c1ee1af014de98a9f92a4fa8622192', '3e5f208baaa6b3a370aaade99c1cb88b', '2', '2018-09-28 17:00:32');
INSERT INTO `collect` VALUES ('d567c3b94b3b20e327e5d927d345b341', '3e5f208baaa6b3a370aaade99c1cb88b', '3', '2018-09-28 17:47:37');
INSERT INTO `collect` VALUES ('ae3213e14596fbda92d0f49985962bcd', '3e5f208baaa6b3a370aaade99c1cb88b', '5', '2018-09-28 17:47:46');

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment`  (
  `comment_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '评论id',
  `content` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '评论内容',
  `user_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '用户id',
  `product_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '商品id',
  `grade` int(1) NULL DEFAULT NULL COMMENT '评分，1非常差，2差，3一般，4满意，5非常满意',
  `add_date` datetime NULL DEFAULT NULL COMMENT '评论时间'
) ENGINE = MyISAM CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '评论表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of comment
-- ----------------------------
INSERT INTO `comment` VALUES ('b44a72ebdb5427792e5a5011684c240a', '发发顺丰顺丰的', '3e5f208baaa6b3a370aaade99c1cb88b', '723a9946a3be9eddfceaaaf56de282f5', 5, '2018-10-16 15:02:29');

-- ----------------------------
-- Table structure for comment_img
-- ----------------------------
DROP TABLE IF EXISTS `comment_img`;
CREATE TABLE `comment_img`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '评论id',
  `comment_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '评论id',
  `pathUrl` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '评论图片',
  `add_date` datetime NULL DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '评论图片' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of comment_img
-- ----------------------------
INSERT INTO `comment_img` VALUES (2, 'b44a72ebdb5427792e5a5011684c240a', 'http://127.0.0.1/shoppingAdmin/public/images/comment/5bc58d03e0670.png', '2018-10-16 15:02:29');

-- ----------------------------
-- Table structure for contents
-- ----------------------------
DROP TABLE IF EXISTS `contents`;
CREATE TABLE `contents`  (
  `product_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '产品id',
  `contents` text CHARACTER SET gbk COLLATE gbk_chinese_ci NULL COMMENT '内容'
) ENGINE = MyISAM CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '商品详情内容表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of contents
-- ----------------------------
INSERT INTO `contents` VALUES ('5fe8fb25142297125fd6ef2a89437a52', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 的地方就搞定了翻跟斗翻跟斗就发路径<br></p><p><img src=\"http://127.0.0.1/shoppingAdmin/public/images/contents/5bc412a871a19.jpg\" style=\"max-width:100%;\"><img src=\"http://127.0.0.1/shoppingAdmin/public/images/contents/5bc41501e1e8f.jpg\" style=\"max-width: 100%;\">攻击对方立刻感觉到交流电经过的<br></p>');
INSERT INTO `contents` VALUES ('723a9946a3be9eddfceaaaf56de282f5', '<p><img src=\"http://127.0.0.1/shoppingAdmin/public/images/contents/5bc6b568be55c.jpg\" style=\"max-width:100%;\"><br></p>');

-- ----------------------------
-- Table structure for contents_img
-- ----------------------------
DROP TABLE IF EXISTS `contents_img`;
CREATE TABLE `contents_img`  (
  `product_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '商品id',
  `imgPath` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '图片路径',
  `time_create` datetime NULL DEFAULT NULL COMMENT '上传时间'
) ENGINE = MyISAM CHARACTER SET = gbk COLLATE = gbk_chinese_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of contents_img
-- ----------------------------
INSERT INTO `contents_img` VALUES ('5fe8fb25142297125fd6ef2a89437a52', 'http://127.0.0.1/shoppingAdmin/public/images/contents/5bc41501e1e8f.jpg', '2018-10-15 12:18:12');
INSERT INTO `contents_img` VALUES ('5fe8fb25142297125fd6ef2a89437a52', 'http://127.0.0.1/shoppingAdmin/public/images/contents/5bc412a871a19.jpg', '2018-10-15 12:08:11');
INSERT INTO `contents_img` VALUES ('723a9946a3be9eddfceaaaf56de282f5', 'http://127.0.0.1/shoppingAdmin/public/images/contents/5bc6b568be55c.jpg', '2018-10-17 12:07:06');

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
) ENGINE = MyISAM CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '购物车表' ROW_FORMAT = Dynamic;

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
INSERT INTO `order` VALUES ('c4482efcad36634ab467dd7b300f7322', '201810151614235381072930', NULL, '0', 7, '2018-10-15 16:14:23', NULL, NULL, NULL, NULL, NULL, '3e5f208baaa6b3a370aaade99c1cb88b', NULL, NULL, NULL, 105.00, 105.00);
INSERT INTO `order` VALUES ('bf28785745242f3e4a399c64ec350e9e', '201810161408217116088826', NULL, '0', 7, '2018-10-16 14:08:21', NULL, NULL, NULL, NULL, NULL, '3e5f208baaa6b3a370aaade99c1cb88b', NULL, NULL, NULL, 115.00, 115.00);
INSERT INTO `order` VALUES ('aacbddc62cf8f4d2ba85d79378b7d379', '201810161408509062042238', NULL, '0', 4, '2018-10-16 14:08:50', NULL, NULL, NULL, NULL, NULL, '3e5f208baaa6b3a370aaade99c1cb88b', NULL, NULL, NULL, 115.00, 115.00);

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
INSERT INTO `order_item` VALUES ('5fe8fb25142297125fd6ef2a89437a52', 'c4482efcad36634ab467dd7b300f7322', 1, '女装', 105.00, 105.00, 'http://127.0.0.1/shoppingAdmin/public/images/thumbnail/5bc3fadc3cda5.jpg', '标准,绿色');
INSERT INTO `order_item` VALUES ('723a9946a3be9eddfceaaaf56de282f5', 'bf28785745242f3e4a399c64ec350e9e', 1, '安徽卡号', 115.00, 115.00, 'http://127.0.0.1/shoppingAdmin/public/images/thumbnail/5bc57f3b92e98.jpg', '标准');
INSERT INTO `order_item` VALUES ('723a9946a3be9eddfceaaaf56de282f5', 'aacbddc62cf8f4d2ba85d79378b7d379', 1, '安徽卡号', 115.00, 115.00, 'http://127.0.0.1/shoppingAdmin/public/images/thumbnail/5bc57f3b92e98.jpg', '标准');

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
INSERT INTO `order_shipping` VALUES ('c4482efcad36634ab467dd7b300f7322', '董先生', '', '13612345678', '北京市北京市东城区1111', '000000');
INSERT INTO `order_shipping` VALUES ('bf28785745242f3e4a399c64ec350e9e', '董先生', '', '13612345678', '北京市北京市东城区1111', '000000');
INSERT INTO `order_shipping` VALUES ('aacbddc62cf8f4d2ba85d79378b7d379', '董先生', '', '13612345678', '北京市北京市东城区1111', '000000');

-- ----------------------------
-- Table structure for parameter
-- ----------------------------
DROP TABLE IF EXISTS `parameter`;
CREATE TABLE `parameter`  (
  `parameter_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '参数id',
  `product_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '产品id',
  `name` varchar(10) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '参数名称',
  `value` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '参数值'
) ENGINE = MyISAM CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '商品参数表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of parameter
-- ----------------------------
INSERT INTO `parameter` VALUES ('eabec3d9e00bd6132914c1705214256a', '5fe8fb25142297125fd6ef2a89437a52', '产地', '广州');

-- ----------------------------
-- Table structure for product_master
-- ----------------------------
DROP TABLE IF EXISTS `product_master`;
CREATE TABLE `product_master`  (
  `master_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '缩略图id',
  `product_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '产品id',
  `path_img` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '图片路径',
  `time_create` datetime NULL DEFAULT NULL COMMENT '上传时间'
) ENGINE = MyISAM CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '商品主图表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_master
-- ----------------------------
INSERT INTO `product_master` VALUES ('4187942ed09951734d1414fd7ef4d226', '5fe8fb25142297125fd6ef2a89437a52', 'http://127.0.0.1/shoppingAdmin/public/images/master/5bc40925b1c94.jpg', '2018-10-15 11:27:36');
INSERT INTO `product_master` VALUES ('0b41f5c32af28af6d54fddf69c0cf7fe', '5fe8fb25142297125fd6ef2a89437a52', 'http://127.0.0.1/shoppingAdmin/public/images/master/5bc409206886e.jpg', '2018-10-15 11:27:36');
INSERT INTO `product_master` VALUES ('b50aae0a5b21615e99c09cc010fe560e', '5fe8fb25142297125fd6ef2a89437a52', 'http://127.0.0.1/shoppingAdmin/public/images/master/5bc4091e2ce65.jpg', '2018-10-15 11:27:36');
INSERT INTO `product_master` VALUES ('9b6558e464a54a1890a83ab90b97a78a', '5fe8fb25142297125fd6ef2a89437a52', 'http://127.0.0.1/shoppingAdmin/public/images/master/5bc4091cb6504.jpg', '2018-10-15 11:27:36');
INSERT INTO `product_master` VALUES ('21c7be80cf45f6e6caccae6773d264a8', '723a9946a3be9eddfceaaaf56de282f5', 'http://127.0.0.1/shoppingAdmin/public/images/master/5bc6b55d0f983.jpg', '2018-10-17 12:07:06');
INSERT INTO `product_master` VALUES ('6d6ad65f974ced6efae1400d26f8602a', '723a9946a3be9eddfceaaaf56de282f5', 'http://127.0.0.1/shoppingAdmin/public/images/master/5bc6b55fda14f.jpg', '2018-10-17 12:07:06');

-- ----------------------------
-- Table structure for product_msg
-- ----------------------------
DROP TABLE IF EXISTS `product_msg`;
CREATE TABLE `product_msg`  (
  `product_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '商品id',
  `Cate_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '一类目id',
  `Sort_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '二类目id',
  `number` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '商品编号',
  `name` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '商品名称',
  `shop_price` float(10, 2) NULL DEFAULT NULL COMMENT '专柜价格（原价）',
  `at_price` float(10, 2) NULL DEFAULT NULL COMMENT '当前价格',
  `docs` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '商品简介',
  `unit` varchar(1) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '商品單位',
  `img` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '商品缩略图',
  `new_product` varchar(1) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '新品，0不是，1是',
  `hot_sale` varchar(1) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '热卖，0不是，1是',
  `sell` varchar(1) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '在售，0不是，1是',
  `antistop` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '关键词',
  `brand_id` int(10) NULL DEFAULT NULL COMMENT '品牌id',
  `time_create` datetime NULL DEFAULT NULL COMMENT '上架时间'
) ENGINE = MyISAM CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '产品信息表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_msg
-- ----------------------------
INSERT INTO `product_msg` VALUES ('723a9946a3be9eddfceaaaf56de282f5', '0cfafbd975407db31726ef3b249d1363', '26d626d358697668a4d537b762b0b944', '10026', '安徽卡号', 120.00, 115.00, '发生发生发射点风格', '件', 'http://127.0.0.1/shoppingAdmin/public/images/thumbnail/5bc57f3b92e98.jpg', '1', '1', '1', '具哎,是', 1, '2018-10-17 12:07:06');
INSERT INTO `product_msg` VALUES ('5fe8fb25142297125fd6ef2a89437a52', '1001000', '1001002', '10025', '女装', 120.00, 105.00, '女装女装女装女装', '件', 'http://127.0.0.1/shoppingAdmin/public/images/thumbnail/5bc3fadc3cda5.jpg', '1', '1', '1', '女装,围巾', 2, '2018-10-15 16:06:22');

-- ----------------------------
-- Table structure for product_sku
-- ----------------------------
DROP TABLE IF EXISTS `product_sku`;
CREATE TABLE `product_sku`  (
  `sku_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '库存id',
  `product_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '产品id',
  `property_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '规格/属性id',
  `selling_price` decimal(10, 2) NULL DEFAULT NULL COMMENT '商品售价',
  `count` int(10) NULL DEFAULT NULL COMMENT '商品数量',
  `img` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '商品图片',
  `name` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '规格值'
) ENGINE = MyISAM CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '商品库存表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_sku
-- ----------------------------
INSERT INTO `product_sku` VALUES ('b775a7699ad0d8bf16bc1deb6f87528c', '723a9946a3be9eddfceaaaf56de282f5', '5687b2a1c1ce3533be9659c6d068b858', 0.00, 0, '', '标准');
INSERT INTO `product_sku` VALUES ('3c1cb4a22a75549636cf9e1dfcee74c1', '5fe8fb25142297125fd6ef2a89437a52', '7d7c5f0a2d068b9a8d329ba6fa2e629d', 0.00, 0, '', '标准');
INSERT INTO `product_sku` VALUES ('8df9cd93676e177a11c1291d56d30960', '5fe8fb25142297125fd6ef2a89437a52', '5c4e3d87cba55cedc4e24ecea19dd65d', 0.00, 0, '', '红色');
INSERT INTO `product_sku` VALUES ('8d96d59c376cb389d45f55ecde870273', '5fe8fb25142297125fd6ef2a89437a52', 'feea114863278ff325b6eff44ff7a9e8', 0.00, 0, '', '绿色');

-- ----------------------------
-- Table structure for property
-- ----------------------------
DROP TABLE IF EXISTS `property`;
CREATE TABLE `property`  (
  `property_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '规格/属性id',
  `product_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '商品id',
  `name_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '属性id',
  `value_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '属性值id'
) ENGINE = MyISAM CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '属性、属性值、商品关联表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of property
-- ----------------------------
INSERT INTO `property` VALUES ('5687b2a1c1ce3533be9659c6d068b858', '723a9946a3be9eddfceaaaf56de282f5', '69c74ccd60eb5faa9dab9ce14584e967', '9c688f230426f1de2b4301d8af334615');
INSERT INTO `property` VALUES ('7d7c5f0a2d068b9a8d329ba6fa2e629d', '5fe8fb25142297125fd6ef2a89437a52', '17bb93615c8482d2a4155bb83275f03e', '7286d2154a00ec5573766549f837fcd2');
INSERT INTO `property` VALUES ('5c4e3d87cba55cedc4e24ecea19dd65d', '5fe8fb25142297125fd6ef2a89437a52', '1cee3d378731eee0caa4f5f6fad022da', '3ae3e9b4ae4cbab5d65396753f313bf4');
INSERT INTO `property` VALUES ('feea114863278ff325b6eff44ff7a9e8', '5fe8fb25142297125fd6ef2a89437a52', '99d1d39aa5230f53bfa2bdaaf6fc78b2', '45628f073fa667a8a0cfa9c4f1e5c10f');

-- ----------------------------
-- Table structure for property_name
-- ----------------------------
DROP TABLE IF EXISTS `property_name`;
CREATE TABLE `property_name`  (
  `name_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '属性id',
  `name` varchar(10) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '规格/属性名',
  `product_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '商品id',
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 38 CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '规格/属性表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of property_name
-- ----------------------------
INSERT INTO `property_name` VALUES ('69c74ccd60eb5faa9dab9ce14584e967', '规格', '723a9946a3be9eddfceaaaf56de282f5', 37);
INSERT INTO `property_name` VALUES ('17bb93615c8482d2a4155bb83275f03e', '规格', '5fe8fb25142297125fd6ef2a89437a52', 36);
INSERT INTO `property_name` VALUES ('1cee3d378731eee0caa4f5f6fad022da', '颜色', '5fe8fb25142297125fd6ef2a89437a52', 34);
INSERT INTO `property_name` VALUES ('99d1d39aa5230f53bfa2bdaaf6fc78b2', '颜色', '5fe8fb25142297125fd6ef2a89437a52', 35);

-- ----------------------------
-- Table structure for property_value
-- ----------------------------
DROP TABLE IF EXISTS `property_value`;
CREATE TABLE `property_value`  (
  `value_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '属性值id',
  `name_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '产品id',
  `value` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '属性值',
  `img` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '图片'
) ENGINE = MyISAM CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '规格/属性名表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of property_value
-- ----------------------------
INSERT INTO `property_value` VALUES ('45628f073fa667a8a0cfa9c4f1e5c10f', '99d1d39aa5230f53bfa2bdaaf6fc78b2', '绿色', '');
INSERT INTO `property_value` VALUES ('3ae3e9b4ae4cbab5d65396753f313bf4', '1cee3d378731eee0caa4f5f6fad022da', '红色', '');
INSERT INTO `property_value` VALUES ('7286d2154a00ec5573766549f837fcd2', '17bb93615c8482d2a4155bb83275f03e', '标准', '');
INSERT INTO `property_value` VALUES ('9c688f230426f1de2b4301d8af334615', '69c74ccd60eb5faa9dab9ce14584e967', '标准', '');

-- ----------------------------
-- Table structure for sort
-- ----------------------------
DROP TABLE IF EXISTS `sort`;
CREATE TABLE `sort`  (
  `Sort_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '子分类id',
  `Cate_id` varchar(32) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '分类id',
  `Sort_name` varchar(10) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '分类名称',
  `icon` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '分类图标',
  `img` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '分类图片',
  `docs` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '分类简介',
  `grade` varchar(1) CHARACTER SET gbk COLLATE gbk_chinese_ci NULL DEFAULT NULL COMMENT '1一级类目，2二级类目'
) ENGINE = MyISAM CHARACTER SET = gbk COLLATE = gbk_chinese_ci COMMENT = '二级分类表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sort
-- ----------------------------
INSERT INTO `sort` VALUES ('26d626d358697668a4d537b762b0b944', '0cfafbd975407db31726ef3b249d1363', '手机', 'http://127.0.0.1/shoppingAdmin/public/images/classify/5bc6b364611a5.jpg', 'http://127.0.0.1/shoppingAdmin/public/images/classify/5bc6b36620a1a.jpg', '手机手机手机手机', '2');

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
INSERT INTO `user` VALUES ('25e1ee5c5bde4bb8a2f791d3393b2fdf', '张三', 'admin2', '07c3bff8a42f8ea2c6493b4380a24251', 'public/images/user/5b8cf75d2583d.jpg', '13632482567', 2, '1993-10-07', 0, 0, '2018-09-25 00:00:00', '2018-10-17 14:41:36');
INSERT INTO `user` VALUES ('7d4cf78869933b8484059aa73682c680', '', '123456', '009590a4e9b7bf6402aabeb585bcf4c6', NULL, '13632482567', 1, '2018-09-26', 0, 0, '2018-09-26 00:00:00', '2018-10-17 14:41:43');
INSERT INTO `user` VALUES ('4011ab3f72723a78129068a682820c7f', '', '444', 'af26610db5e49dd014584b03cd4d3599', NULL, '13612345678', 2, '2018-09-26', 0, 0, '2018-09-26 00:00:00', '2018-10-17 14:41:49');
INSERT INTO `user` VALUES ('8cc54a6e17e5ade6748b1948934cf766', '', '666', 'af26610db5e49dd014584b03cd4d3599', NULL, '13612345678', 1, '2018-09-05', 0, 0, '2018-09-26 00:00:00', '2018-10-17 14:41:56');
INSERT INTO `user` VALUES ('578c36da0b64aa4379927b04f235ee48', '', '777', 'af26610db5e49dd014584b03cd4d3599', NULL, '13612345678', 2, '2018-09-05', 0, 0, '2018-09-26 00:00:00', '2018-10-17 14:42:02');
INSERT INTO `user` VALUES ('44d48c84bc1cfac6a9d3244f2d2899cb', '', '888', 'af26610db5e49dd014584b03cd4d3599', NULL, '13612345678', 1, '2018-09-12', 0, 0, '2018-09-26 00:00:00', '2018-10-17 14:42:09');
INSERT INTO `user` VALUES ('d576faac06d4095ef9da98800d752809', '', '888', 'af26610db5e49dd014584b03cd4d3599', NULL, '13612345678', 2, '2018-09-27', 0, 0, '2018-09-26 00:00:00', '2018-10-17 14:42:15');
INSERT INTO `user` VALUES ('e553a1ccddf5d4bfa90d82699219cd56', '', '刘德华', 'af26610db5e49dd014584b03cd4d3599', NULL, '13612345678', 2, '2018-09-20', 0, 0, '2018-09-26 00:00:00', '2018-10-17 14:42:22');
INSERT INTO `user` VALUES ('a5f8389db9ea106858802ec8a56aad25', '', '11', 'af26610db5e49dd014584b03cd4d3599', NULL, '13632482567', 1, '2018-09-19', 0, 0, '2018-09-26 12:09:46', '2018-10-17 14:42:37');
INSERT INTO `user` VALUES ('e83987810fbc2d97a26377b8167dcdfd', '', '11', 'af26610db5e49dd014584b03cd4d3599', NULL, '13632482567', 2, '2018-09-19', 0, 0, '2018-09-26 12:22:09', '2018-10-17 14:42:29');
INSERT INTO `user` VALUES ('6b6a0475c80440dc39a4a23b867e5535', '', '1', 'af26610db5e49dd014584b03cd4d3599', NULL, '13512345678', 2, '2018-09-20', 0, 0, '2018-09-26 12:24:23', '2018-10-17 14:43:32');
INSERT INTO `user` VALUES ('953afbe8692015be17c21657d0904f12', '', '1a', 'af26610db5e49dd014584b03cd4d3599', NULL, '13612345678', 2, '2018-09-05', 0, 0, '2018-09-26 12:26:25', '2018-10-17 14:43:24');
INSERT INTO `user` VALUES ('3e5f208baaa6b3a370aaade99c1cb88b', '', 'admin', 'af26610db5e49dd014584b03cd4d3599', NULL, '13632482567', 2, '1993-10-07', 0, 0, '2018-09-26 15:03:30', '2018-10-17 14:42:45');
INSERT INTO `user` VALUES ('fe8fe5d9896941894a31f9deeba1d2d2', 'nnn', 'admin2', '9cbf8a4dcb8e30682b927f352d6559a0', NULL, '13612345678', 1, '2018-10-08', 0, 0, '2018-10-08 15:27:45', NULL);

SET FOREIGN_KEY_CHECKS = 1;
