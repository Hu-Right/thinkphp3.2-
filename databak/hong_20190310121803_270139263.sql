/* This file is created by MySQLReback 2019-03-10 12:18:03 */
 /* 创建表结构 `t_admin` */
 DROP TABLE IF EXISTS `t_admin`;/* MySQLReback Separation */ CREATE TABLE `t_admin` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` char(32) NOT NULL,
  `role_id` mediumint(9) NOT NULL,
  `time` datetime DEFAULT NULL,
  `ip` char(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `username_2` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `t_admin` */
 INSERT INTO `t_admin` VALUES ('1','admin','e10adc3949ba59abbe56e057f20f883e','1','2016-10-08 00:00:00',''),('24','caiwu','e10adc3949ba59abbe56e057f20f883e','3','2017-08-08 13:00:53','171.8.213.138'),('25','商城管理员','e10adc3949ba59abbe56e057f20f883e','1','2018-01-11 16:28:11','36.99.94.69');/* MySQLReback Separation */
 /* 创建表结构 `t_adminlog` */
 DROP TABLE IF EXISTS `t_adminlog`;/* MySQLReback Separation */ CREATE TABLE `t_adminlog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `admin_user` varchar(125) NOT NULL,
  `info` varchar(125) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `t_adminlog` */
 INSERT INTO `t_adminlog` VALUES ('16','admin','电子币利息','2017-07-29 18:22:04'),('40','admin','回报奖','2017-07-29 21:03:14'),('41','admin','回报奖','2017-07-29 21:04:00'),('42','admin','业绩分红','2017-08-02 19:04:42');/* MySQLReback Separation */
 /* 创建表结构 `t_api` */
 DROP TABLE IF EXISTS `t_api`;/* MySQLReback Separation */ CREATE TABLE `t_api` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `dkey` varchar(200) NOT NULL DEFAULT '0' COMMENT '短信key',
  `did` varchar(50) NOT NULL DEFAULT '0' COMMENT '短信模板id',
  `dvalue` varchar(250) DEFAULT '0' COMMENT '短信模板变量',
  `dname` varchar(50) DEFAULT '0' COMMENT '短信商名称',
  `is_hide` varchar(50) DEFAULT '0' COMMENT '是否禁用',
  `zkey` varchar(150) DEFAULT '0' COMMENT '支付宝秘钥',
  `zid` varchar(200) DEFAULT '0' COMMENT '支付宝id',
  `zname` varchar(200) DEFAULT '0' COMMENT '支付商名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='短信配置，支付宝配置';/* MySQLReback Separation */
 /* 插入数据 `t_api` */
 INSERT INTO `t_api` VALUES ('1','123456','110','0','聚合函数','否','0','0','0');/* MySQLReback Separation */
 /* 创建表结构 `t_center` */
 DROP TABLE IF EXISTS `t_center`;/* MySQLReback Separation */ CREATE TABLE `t_center` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `cname` varchar(255) NOT NULL COMMENT '任务名称',
  `content` text NOT NULL COMMENT '任务内容',
  `logo` varchar(255) DEFAULT '0' COMMENT '附件图片',
  `btime` int(11) DEFAULT NULL COMMENT '添加时间',
  `status` int(11) DEFAULT '0' COMMENT '0显示，1不显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='添加任务表';/* MySQLReback Separation */
 /* 插入数据 `t_center` */
 INSERT INTO `t_center` VALUES ('1','任务一','【微转达人】小个子大格局迷你身材，声音响量清晰炫彩彩灯，微转VIP特惠价48.8元                    【包邮】——限量100台！','/Public/Upload/logo/2018-09-07/5b91d19322e56.png','1536028341','0'),('2','任务二','【微转达人】小个子大格局迷你身材，声音响量清晰炫彩彩灯，微转VIP特惠价48.8元                    【包邮】——限量100台！','/Public/Upload/logo/2018-09-07/5b91d116c3db6.png','','0');/* MySQLReback Separation */
 /* 创建表结构 `t_daymoney_log` */
 DROP TABLE IF EXISTS `t_daymoney_log`;/* MySQLReback Separation */ CREATE TABLE `t_daymoney_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(20) NOT NULL COMMENT '用户ID',
  `totalmoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '总金额',
  `liang_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '奖金',
  `credit` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '复消积分',
  `time` varchar(20) NOT NULL COMMENT '时间',
  `tui_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '推荐奖',
  `ling_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '领导奖',
  `fen_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '分红奖',
  `center_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '保单中心提成',
  `fen_credit` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '分红奖积分',
  `expenses` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '税收',
  `manage` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '管理费',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `t_decgoods` */
 DROP TABLE IF EXISTS `t_decgoods`;/* MySQLReback Separation */ CREATE TABLE `t_decgoods` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `goods_name` varchar(60) NOT NULL,
  `market_price` decimal(10,2) NOT NULL,
  `shop_price` decimal(10,2) NOT NULL,
  `logo` varchar(150) NOT NULL,
  `is_on_sale` enum('是','否') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `t_decgoods` */
 INSERT INTO `t_decgoods` VALUES ('2','女装','100.00','99.00','/Public/Upload/logo/2017-08-01/598061d0a80b4.jpg','是'),('3','男装','100.00','99.00','/Public/Upload/logo/2017-08-01/598062411e192.jpg','是'),('4','时尚夏季女装','100.00','99.00','/Public/Upload/logo/2017-08-01/59806256cfa98.jpg','是'),('5','时尚夏季男装','100.00','99.00','/Public/Upload/logo/2017-08-01/59806271da411.jpg','是');/* MySQLReback Separation */
 /* 创建表结构 `t_decorder` */
 DROP TABLE IF EXISTS `t_decorder`;/* MySQLReback Separation */ CREATE TABLE `t_decorder` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` mediumint(8) NOT NULL,
  `email` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `address` varchar(200) NOT NULL,
  `mobile` int(11) NOT NULL,
  `shop_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `num` int(11) DEFAULT NULL,
  `payment` varchar(125) NOT NULL,
  `state` int(1) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `t_gonggao` */
 DROP TABLE IF EXISTS `t_gonggao`;/* MySQLReback Separation */ CREATE TABLE `t_gonggao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_out` varchar(255) NOT NULL DEFAULT '1' COMMENT '是否显示 1为显示  2为不显示',
  `content` varchar(2550) NOT NULL COMMENT '内容',
  `biaoti` varchar(255) NOT NULL COMMENT '标题',
  `addtime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `t_gonggao` */
 INSERT INTO `t_gonggao` VALUES ('3','1','对对对爱神的箭阿萨德加拉圣诞快乐奥斯卡电脑卡是多么快乐撒多米尼克卢卡斯的考拉什么都快拉上你的空间撒看来你是看得开拉SD卡类似的奇偶好看难看我好几年了可能埃里克速度快拉速度快看了看马尼拉柯玛妮克雷声大','栓子是笨蛋','2018-02-24 18:42:26'),('6','1','阿斯达四大所','打算','2018-02-24 18:42:26');/* MySQLReback Separation */
 /* 创建表结构 `t_goods` */
 DROP TABLE IF EXISTS `t_goods`;/* MySQLReback Separation */ CREATE TABLE `t_goods` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `goods_name` varchar(60) NOT NULL,
  `market_price` decimal(10,2) NOT NULL,
  `shop_price` decimal(10,2) NOT NULL,
  `logo` varchar(150) NOT NULL,
  `is_on_sale` enum('是','否') NOT NULL,
  `size` varchar(100) DEFAULT NULL COMMENT '商品大小',
  `color` varchar(150) DEFAULT NULL COMMENT '商品颜色',
  `spec_price` decimal(10,2) DEFAULT NULL COMMENT '规格价',
  `cate_id` int(11) NOT NULL COMMENT '分类id',
  `integral` decimal(8,0) NOT NULL DEFAULT '0' COMMENT '赠送积分',
  `amount` decimal(8,0) NOT NULL DEFAULT '0' COMMENT '库存',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `t_goods` */
 INSERT INTO `t_goods` VALUES ('4','泰国之旅','20000.00','11000.00','/Public/Upload/logo/2018-01-18/5a604fafdbaa4.png','是','','','0.00','1','50','6'),('7','测试1','180.00','160.00','/Public/Upload/logo/2018-01-30/5a702f77908f5.jpg','是','','','0.00','3','24','6'),('9','测试3.0','888.00','666.00','/Public/Upload/logo/2018-01-31/5a718ad6182e7.jpg','是','','','0.00','2','45','1000');/* MySQLReback Separation */
 /* 创建表结构 `t_goods_category` */
 DROP TABLE IF EXISTS `t_goods_category`;/* MySQLReback Separation */ CREATE TABLE `t_goods_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cg_name` varchar(50) NOT NULL COMMENT '分类名称',
  `p_id` int(5) NOT NULL DEFAULT '0' COMMENT '上级分类id',
  `is_show` varchar(2) NOT NULL COMMENT '是否显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `t_goods_category` */
 INSERT INTO `t_goods_category` VALUES ('1','食品','0','是'),('2','酒水','0','是'),('3','干果','0','是'),('4','饮料','0','是'),('5','服饰珠宝','0','是'),('6','精品手机','0','是'),('7','鞋帽箱包','0','是'),('8','家具家用','0','是'),('9','日用百货','0','是'),('10','家器家电','0','是');/* MySQLReback Separation */
 /* 创建表结构 `t_goods_spec` */
 DROP TABLE IF EXISTS `t_goods_spec`;/* MySQLReback Separation */ CREATE TABLE `t_goods_spec` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goodsid` int(10) DEFAULT NULL COMMENT '商品ID',
  `size` varchar(100) DEFAULT NULL COMMENT '商品大小',
  `color` varchar(255) DEFAULT NULL COMMENT '商品颜色',
  `goods_money` decimal(10,2) DEFAULT NULL COMMENT '商品价格',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `t_goods_spec` */
 INSERT INTO `t_goods_spec` VALUES ('10','5','xl','蓝','180.00'),('11','5','xxl','红','190.00');/* MySQLReback Separation */
 /* 创建表结构 `t_jiangli` */
 DROP TABLE IF EXISTS `t_jiangli`;/* MySQLReback Separation */ CREATE TABLE `t_jiangli` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id主键',
  `tuijian1` varchar(255) DEFAULT NULL COMMENT '报单金额',
  `tuijian2` varchar(255) DEFAULT NULL COMMENT '直推奖励金额',
  `tuijian3` varchar(255) DEFAULT NULL COMMENT '基金奖励金额',
  `pucard` varchar(255) NOT NULL COMMENT '普通会员金额',
  `vipcard` varchar(255) NOT NULL COMMENT 'vip会员金额',
  `goldcard` varchar(255) NOT NULL DEFAULT '0' COMMENT '黄金卡升级人数',
  `pumoney` varchar(255) NOT NULL COMMENT '普卡分享朋友圈金额',
  `vipmoney` varchar(255) NOT NULL COMMENT 'vip卡分享朋友圈的钱',
  `spukabaodan` varchar(255) DEFAULT NULL COMMENT '会员上限',
  `goldmemberone` varchar(255) NOT NULL COMMENT '黄金会员一代自身',
  `goldmemberones` varchar(255) NOT NULL COMMENT '黄金会员一代上级',
  `vipmembertwo` varchar(255) NOT NULL COMMENT '黄金vip会员二代自身',
  `vipmembertwos` varchar(255) NOT NULL COMMENT '黄金vip会员二代上级',
  `mspukabaodan` varchar(255) NOT NULL COMMENT '每日上限',
  `recommendpcard` varchar(255) NOT NULL COMMENT '推荐普通卡会员金额',
  `recommendptask` varchar(255) NOT NULL COMMENT '推荐普通会员任务金额',
  `twogeneration` varchar(255) NOT NULL DEFAULT '0' COMMENT '二代普通会员发圈',
  `twogenerations` varchar(255) NOT NULL COMMENT '二代vip会员发圈',
  `recommendvip` varchar(255) NOT NULL COMMENT '推荐vip会员金额',
  `recommendvtask` varchar(255) NOT NULL COMMENT '推荐vip会员任务金额',
  `tixian` varchar(255) NOT NULL COMMENT '提现手续费',
  `twogenerp` varchar(255) NOT NULL COMMENT '二代普通会员发圈',
  `guanli2` varchar(255) DEFAULT NULL COMMENT '管理奖二代',
  `guanli3` varchar(255) DEFAULT NULL COMMENT '管理奖三代',
  `twogenerv` varchar(255) NOT NULL COMMENT '二代vip会员发圈',
  `baodanfei` varchar(255) DEFAULT NULL COMMENT '报单费设置',
  `chongxiao` varchar(255) DEFAULT NULL COMMENT '重销奖励',
  `ppukabaodan` varchar(255) DEFAULT NULL COMMENT '普卡PV值',
  `pyinkabaodan` varchar(255) DEFAULT NULL COMMENT '银卡PV值',
  `pjinkabaodan` varchar(255) DEFAULT NULL COMMENT '金卡PV值',
  `pzuankabaodan` varchar(255) DEFAULT NULL COMMENT '钻卡PV值',
  `prongkabaodan` varchar(255) DEFAULT NULL COMMENT '荣卡PV值',
  `totalstar` varchar(255) DEFAULT NULL COMMENT '总需求星星数',
  `xpukabaodan` varchar(255) DEFAULT NULL COMMENT '各个等级所获得星星数',
  `xyinkabaodan` varchar(255) DEFAULT NULL,
  `xjinkabaodan` varchar(255) DEFAULT NULL,
  `xzuankabaodan` varchar(255) DEFAULT NULL,
  `xrongkabaodan` varchar(255) DEFAULT NULL,
  `xxjiangli` varchar(255) DEFAULT NULL COMMENT '每颗星星的奖励值',
  `grade_num` int(2) DEFAULT '0' COMMENT '会员升级次数限制',
  `expenses` decimal(4,2) DEFAULT '0.00' COMMENT '税收比例',
  `manage` decimal(4,2) DEFAULT '0.00' COMMENT '管理费比例',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `t_jiangli` */
 INSERT INTO `t_jiangli` VALUES ('1','','','','198','398','50','14','30','7800',' 6','12 ','3 ','3 ','','14','6','3','4',' 30','12','3','6','10','5','8','3','14','780','3600','11520','23040','46080','396','1','6','18','36','72','320','5','0.00','0.00');/* MySQLReback Separation */
 /* 创建表结构 `t_kzhi` */
 DROP TABLE IF EXISTS `t_kzhi`;/* MySQLReback Separation */ CREATE TABLE `t_kzhi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` varchar(255) NOT NULL,
  `zcmoney` int(20) NOT NULL COMMENT '支出金额',
  `srmoney` int(20) NOT NULL COMMENT '收入金额',
  `percentage` varchar(255) NOT NULL COMMENT '百分比',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `t_kzhi` */
 INSERT INTO `t_kzhi` VALUES ('1','2018-04-04','20723','86240','24.03'),('2','2018-04-20','2138','7840','27.27'),('3','2018-04-25','1121','3920','28.6'),('4','2018-04-27','842','3900','21.6');/* MySQLReback Separation */
 /* 创建表结构 `t_layer` */
 DROP TABLE IF EXISTS `t_layer`;/* MySQLReback Separation */ CREATE TABLE `t_layer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `layer` int(11) NOT NULL,
  `user_id` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `t_liangpeng` */
 DROP TABLE IF EXISTS `t_liangpeng`;/* MySQLReback Separation */ CREATE TABLE `t_liangpeng` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `user_id` int(5) NOT NULL COMMENT '会员ID',
  `l_money` decimal(10,0) NOT NULL DEFAULT '0' COMMENT '左区金额',
  `r_money` decimal(10,0) NOT NULL DEFAULT '0' COMMENT '右区金额',
  `gain_money` decimal(10,0) NOT NULL DEFAULT '0' COMMENT '获得量碰金额',
  `gain_time` int(15) NOT NULL COMMENT '返钱的时间',
  PRIMARY KEY (`id`,`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5762 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `t_liangpeng` */
 INSERT INTO `t_liangpeng` VALUES ('1','1','780','0','0','1518424001'),('5757','5652','0','0','0','1524840713'),('5758','5653','780','0','0','1524840733'),('5759','5654','0','0','0','1524841041'),('5760','5655','0','0','0','1524841115'),('5761','5656','0','0','0','1524841693');/* MySQLReback Separation */
 /* 创建表结构 `t_member` */
 DROP TABLE IF EXISTS `t_member`;/* MySQLReback Separation */ CREATE TABLE `t_member` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(15) DEFAULT NULL COMMENT '用户名',
  `email` varchar(150) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `type` char(1) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  `money` decimal(10,2) DEFAULT '0.00' COMMENT '购物币(购物币)',
  `currency` decimal(10,0) DEFAULT NULL COMMENT '电子币(现金币)',
  `reserve_currency` decimal(10,0) DEFAULT NULL COMMENT '订货币',
  `bonus` decimal(10,0) DEFAULT NULL COMMENT '奖金',
  `currency_interest` decimal(10,0) DEFAULT NULL COMMENT '电子币利息',
  `return_award` decimal(10,0) DEFAULT NULL COMMENT '回报奖',
  `shopping` decimal(10,0) DEFAULT NULL,
  `level` int(11) DEFAULT '0' COMMENT '会员级别',
  `layer` int(11) DEFAULT NULL,
  `region` int(11) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL COMMENT '会员注册时间',
  `gender` enum('') DEFAULT NULL COMMENT '性别',
  `parent_id` int(11) DEFAULT NULL COMMENT '父级id',
  `node_id` int(11) DEFAULT NULL COMMENT '节点id',
  `card` varchar(20) DEFAULT NULL,
  `zhifubao` varchar(100) DEFAULT NULL COMMENT '支付宝',
  `achievement` decimal(10,0) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL COMMENT '选择银行',
  `bank_account` varchar(255) DEFAULT NULL COMMENT '银行卡号',
  `open_bank` varchar(255) DEFAULT NULL COMMENT '开户行',
  `class_id` varchar(500) DEFAULT '0',
  `zhengsong` decimal(10,0) DEFAULT NULL,
  `is_decenter` int(11) DEFAULT NULL,
  `liangpengjl` int(11) DEFAULT NULL,
  `day_time` int(11) DEFAULT '0' COMMENT '每天获得的钱的时间',
  `day_money` decimal(10,2) DEFAULT '0.00' COMMENT '每天获得的钱',
  `activate_money` decimal(10,2) DEFAULT NULL COMMENT '激活币',
  `baodan_id` int(5) DEFAULT NULL COMMENT '保单id',
  `chongxiao_credit` decimal(8,2) DEFAULT NULL COMMENT '重销',
  `share_number` int(8) DEFAULT NULL COMMENT '分红值',
  `grade_num` int(2) DEFAULT NULL COMMENT '升级次数',
  `enter_credit` decimal(8,2) DEFAULT NULL COMMENT '出厂积分',
  `is_out` int(1) DEFAULT NULL COMMENT '是否出局',
  `share_num` int(11) DEFAULT NULL COMMENT '分红次数',
  `erpsd` varchar(255) DEFAULT NULL COMMENT '二级密码',
  `fuxiao_credit` decimal(8,2) DEFAULT NULL COMMENT '30%复效',
  `is_activate` int(1) DEFAULT NULL COMMENT '会员是否激活，0为未激活',
  `shifoliang` varchar(5) DEFAULT NULL,
  `weixin` varchar(50) DEFAULT NULL,
  `levels` int(11) DEFAULT NULL COMMENT '级别',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10001 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `t_member` */
 INSERT INTO `t_member` VALUES ('1','admin','','15824876380','','c4ca4238a0b923820dcc509a6f75849b','210.00','500','500','500','500','','','2','1','0','2018-09-13 09:38:10','','0','','','15824876380','','','','','','1','','','','24','0.00','','','','','','','','','','','','','','2'),('40','','','15824876381','','c4ca4238a0b923820dcc509a6f75849b','104.00','','','','','','','2','','1','2018-09-29 18:22:28','','1','','','','','','','','','1/1','','','','13','0.00','','','','','','','','','','','','','','2'),('41','','','15824876383','','c4ca4238a0b923820dcc509a6f75849b','0.00','','','','','','','1','','2','2018-09-29 18:58:17','','40','','','','','','','','','1/1/1','','','','0','85.00','','','','','','','','','','','','','','2');/* MySQLReback Separation */
 /* 创建表结构 `t_member_level` */
 DROP TABLE IF EXISTS `t_member_level`;/* MySQLReback Separation */ CREATE TABLE `t_member_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_level` int(255) NOT NULL COMMENT '会员级别',
  `level_name` varchar(255) NOT NULL COMMENT '级别名',
  `money` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '级别消费点位金额',
  `daymoney` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '收益日封顶',
  `totalmoney` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '会员总收益',
  `pvmoney` int(11) NOT NULL COMMENT 'PV值',
  `goldpe` varchar(11) NOT NULL COMMENT '黄金会员人数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='会员级别表';/* MySQLReback Separation */
 /* 插入数据 `t_member_level` */
 INSERT INTO `t_member_level` VALUES ('1','1','普通会员','198.00','0.00','7800.00','780','0'),('2','2','vip会员','398.00','0.00','36000.00','3600','0'),('3','3','黄金会员','0.00','0.00','0.00','0','50'),('4','0','免费会员','0.00','0.00','0.00','0','0');/* MySQLReback Separation */
 /* 创建表结构 `t_onorder` */
 DROP TABLE IF EXISTS `t_onorder`;/* MySQLReback Separation */ CREATE TABLE `t_onorder` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `orders` varchar(255) DEFAULT NULL COMMENT '支付宝订单号',
  `userid` int(11) DEFAULT NULL COMMENT '会员id',
  `otype` char(2) DEFAULT NULL COMMENT '级别类型',
  `ormoney` varchar(255) DEFAULT NULL COMMENT '订单金额',
  `orname` varchar(255) DEFAULT NULL COMMENT '订单名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `t_onorder` */
 INSERT INTO `t_onorder` VALUES ('3','11537321572','1','','198.00','会员升级');/* MySQLReback Separation */
 /* 创建表结构 `t_order` */
 DROP TABLE IF EXISTS `t_order`;/* MySQLReback Separation */ CREATE TABLE `t_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` mediumint(8) NOT NULL,
  `email` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `address` varchar(200) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `shop_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payment` varchar(125) NOT NULL,
  `state` int(1) NOT NULL,
  `time` datetime NOT NULL,
  `color` varchar(100) DEFAULT NULL,
  `size` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `t_privilege` */
 DROP TABLE IF EXISTS `t_privilege`;/* MySQLReback Separation */ CREATE TABLE `t_privilege` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `pri_name` varchar(30) NOT NULL,
  `module_name` varchar(30) NOT NULL,
  `controller_name` varchar(30) NOT NULL,
  `action_name` varchar(30) NOT NULL,
  `parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1039 DEFAULT CHARSET=utf8 COMMENT='分配权限表';/* MySQLReback Separation */
 /* 插入数据 `t_privilege` */
 INSERT INTO `t_privilege` VALUES ('12','系统管理','NULL','NULL','NULL','0'),('13','数据库备份','Admin','Bak','index','12'),('19','API配置','NULL','NULL','NULL','0'),('74','批量删除','Admin','Order','bdel','71'),('75','奖品赠送','Admin','usergive','lst','3000'),('76','奖品修改','Admin','usergive','save','75'),('71','支付配置','Admin','Order','lst','19'),('24','批量删除','Admin','Goods','bdle','20'),('23','删除短信','Admin','Goods','del','20'),('22','修改短信','Admin','Goods','save','20'),('21','添加短信','Admin','Goods','add','20'),('30','会员模块','NULL','NULL','NULL','0'),('31','添加会员','Admin','Member','add','33'),('32','修改会员','Admin','Member','save','33'),('33','会员列表','Admin','Member','lst','30'),('34','删除会员','Admin','Member','del','33'),('35','批量删除','Admin','Member','bdel','33'),('66','充值中心','Admin','Member','userrecharge','30'),('59','交易管理','NULL','NULL','NULL','0'),('60','充值列表','Admin','transaction','lst','59'),('61','充值修改','Admin','transaction','save','60'),('62','充值添加','Admin','transaction','add','60'),('67','提现列表','Admin','withdrawals','lst','59'),('72','支付修改','Admin','Order','save','71'),('63','充值删除','Admin','transaction','del','60'),('64','批量删除','Admin','transaction','bdel','60'),('65','公司账号','Admin','transaction','accounts','59'),('73','支付删除','Admin','Order','del','71'),('20','短信配置','Admin','Goods','lst','19'),('52','团队分布','Admin','Member','Genealogy','30'),('68','提现修改','Admin','withdrawals','save','67'),('69','充值删除','Admin','withdrawals','del','67'),('70','批量删除','Admin','withdrawals','bdel','67'),('77','充值删除','Admin','usergive','del','75'),('78','批量删除','Admin','usergive','bdel','75'),('79','提现规则','Admin','transaction','management','5900'),('80','奖金设置','NULL','NULL','NULL','0'),('81','制度设置','Admin','Bonus','Bonus','80'),('87','报单订单列表','Admin','Decorder','lst','1900'),('88','报单产品列表','Admin','Decgoods','lst','1900'),('89','财务记录','Admin','Member','accountlist','30'),('90','每日定时任务','NULL','NULL','NULL','1000'),('91','电子币利息','Admin','Timetask','lst','90'),('92','回报奖','Admin','Timetask','return_list','90'),('93','业绩分红','Admin','Timetask','dividends_list','90'),('94','二维码配置','Admin','Goods','spec','19'),('96','添加公告','Admin','Bak','gonggao','12'),('97','公告管理','Admin','Bak','gonggaogl','12'),('108','任务审核','Admin','Member','toexamine','30'),('107','任务奖记录','Admin','Member','taskaward','30'),('100','推荐奖记录','Admin','Member','tuijianjiang','30'),('109','任务中心','Admin','Member','taskcenter','30'),('110','增加','Admin','Member','tadds','109'),('102','增加二维码','Admin','Goods','adds','94'),('103','修改二维码','Admin','Goods','specsave','94'),('104','删除二维码','Admin','Goods','specdel','94'),('105','批量删除','Admin','Goods','sdel','94'),('106','支付增加','Admin','Order','add','71'),('111','删除','Admin','Member','tdel','109'),('112','修改','Admin','Member','tsave','109'),('113','批量','Admin','Member','bdels','109'),('114','批量','Admin','Member','tobdel','108'),('115','删除','Admin','Member','todel','108'),('116','审核','Admin','Member','tosave','108');/* MySQLReback Separation */
 /* 创建表结构 `t_qrcode` */
 DROP TABLE IF EXISTS `t_qrcode`;/* MySQLReback Separation */ CREATE TABLE `t_qrcode` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '二维码id编号',
  `name` varchar(100) NOT NULL COMMENT '二维码的名字',
  `logo` varchar(250) NOT NULL COMMENT '二维码图标',
  `is_show` varchar(50) DEFAULT NULL COMMENT '是否显示',
  `href` varchar(150) NOT NULL COMMENT '二维码跳转的网址',
  `size` char(50) NOT NULL COMMENT '二维码生成的大小',
  `uid` int(11) DEFAULT '0' COMMENT '用户id',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='二维码配置表';/* MySQLReback Separation */
 /* 插入数据 `t_qrcode` */
 INSERT INTO `t_qrcode` VALUES ('1','测试','/Public/Upload/logo/2018-09-04/5b8e502b44086.png','是','123','14','0');/* MySQLReback Separation */
 /* 创建表结构 `t_role` */
 DROP TABLE IF EXISTS `t_role`;/* MySQLReback Separation */ CREATE TABLE `t_role` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(30) NOT NULL,
  `pri_id_list` varchar(150) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `t_role` */
 INSERT INTO `t_role` VALUES ('1','超级管理员','*'),('3','财务','30,66,89,59,60,67'),('4','美工','1,2,3,4,5,6,7,8,9,10,11,14,15,16,12,13,96,97');/* MySQLReback Separation */
 /* 创建表结构 `t_spec` */
 DROP TABLE IF EXISTS `t_spec`;/* MySQLReback Separation */ CREATE TABLE `t_spec` (
  `id` int(10) NOT NULL,
  `goodsid` int(10) NOT NULL COMMENT '商品ID',
  `type` varchar(200) NOT NULL COMMENT '规格类型',
  `spec1` varchar(255) DEFAULT NULL,
  `spec2` varchar(255) DEFAULT NULL,
  `spec3` varchar(255) DEFAULT NULL,
  `spec4` varchar(255) DEFAULT NULL,
  `spec5` varchar(255) DEFAULT NULL,
  `spec6` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `t_star` */
 DROP TABLE IF EXISTS `t_star`;/* MySQLReback Separation */ CREATE TABLE `t_star` (
  `id` int(11) NOT NULL,
  `totalstar` varchar(255) NOT NULL,
  `havestar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `t_star` */
 INSERT INTO `t_star` VALUES ('1','198','0');/* MySQLReback Separation */
 /* 创建表结构 `t_statk` */
 DROP TABLE IF EXISTS `t_statk`;/* MySQLReback Separation */ CREATE TABLE `t_statk` (
  `id` int(12) NOT NULL AUTO_INCREMENT COMMENT 'id主键',
  `userid` varchar(150) DEFAULT '0' COMMENT '会员表中的id',
  `taskname` char(100) DEFAULT '0' COMMENT '任务名称',
  `taskstatus` tinyint(4) DEFAULT '0' COMMENT '任务状态,1，审核中，2未通过 ，3.审核通过',
  `stime` int(11) DEFAULT '0' COMMENT '提交时间',
  `remarks` text COMMENT '备注，说明',
  `logo` varchar(250) DEFAULT '0' COMMENT '提交上传图片',
  `btime` datetime DEFAULT '0000-00-00 00:00:00' COMMENT '开始时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COMMENT='提交任务表';/* MySQLReback Separation */
 /* 插入数据 `t_statk` */
 INSERT INTO `t_statk` VALUES ('34','40','任务一','3','1538217463','测试免费会员提交任务有没有奖励','/Public/Upload/logo/2018-09-29/5baf55f7ef1a0.jpg','0000-00-00 00:00:00'),('33','1','任务二','3','1538216933','vip 会员任务奖','/Public/Upload/logo/2018-09-29/5baf53e545240.png','0000-00-00 00:00:00'),('32','1','任务一','3','1538216760','测试','/Public/Upload/logo/2018-09-29/5baf53389f197.png','0000-00-00 00:00:00'),('35','40','任务二','3','1538218103','测试 vip 会员拿30任务奖，直推上级那12元','/Public/Upload/logo/2018-09-29/5baf5877e2768.png','0000-00-00 00:00:00'),('36','41','任务一','3','1538220277','二代会员4/8--上级12','/Public/Upload/logo/2018-09-29/5baf60f51c7e2.png','0000-00-00 00:00:00');/* MySQLReback Separation */
 /* 创建表结构 `t_systembonus` */
 DROP TABLE IF EXISTS `t_systembonus`;/* MySQLReback Separation */ CREATE TABLE `t_systembonus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cengpeng` decimal(10,2) NOT NULL,
  `liangpeng` decimal(10,2) NOT NULL,
  `jiandian` decimal(10,2) NOT NULL,
  `ganen` decimal(10,2) NOT NULL,
  `lingdao` decimal(10,2) NOT NULL,
  `baodan` decimal(10,2) NOT NULL,
  `chonzhi` decimal(10,2) NOT NULL,
  `tixian` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `t_systembonus` */
 INSERT INTO `t_systembonus` VALUES ('1','0.00','202.80','648.20','0.00','0.00','3900.00','0.00','970.00');/* MySQLReback Separation */
 /* 创建表结构 `t_team` */
 DROP TABLE IF EXISTS `t_team`;/* MySQLReback Separation */ CREATE TABLE `t_team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teamid` int(11) NOT NULL COMMENT '团队id',
  `level` int(11) NOT NULL COMMENT '团队中的等级',
  `userid` int(11) NOT NULL COMMENT '用户ID',
  `addtime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '团队创建时间',
  `isout` int(11) NOT NULL DEFAULT '1' COMMENT '是否出局(1为没出局,2为出局)',
  `zige1` varchar(255) DEFAULT NULL,
  `zige2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `t_transaction` */
 DROP TABLE IF EXISTS `t_transaction`;/* MySQLReback Separation */ CREATE TABLE `t_transaction` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `mode` varchar(150) NOT NULL,
  `accounts` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `money` decimal(10,2) NOT NULL,
  `type` int(2) NOT NULL DEFAULT '0',
  `info` text NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `t_usergive` */
 DROP TABLE IF EXISTS `t_usergive`;/* MySQLReback Separation */ CREATE TABLE `t_usergive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `mobile` int(11) NOT NULL,
  `xing` int(1) NOT NULL,
  `type` int(1) NOT NULL DEFAULT '0',
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `t_userrecord` */
 DROP TABLE IF EXISTS `t_userrecord`;/* MySQLReback Separation */ CREATE TABLE `t_userrecord` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `type` varchar(50) NOT NULL,
  `income` varchar(150) NOT NULL,
  `money` decimal(10,2) NOT NULL,
  `info` varchar(200) NOT NULL,
  `time` datetime NOT NULL,
  `xiaemail` varchar(255) DEFAULT NULL COMMENT '触发人的email',
  `totalmoney` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '总金额',
  `fuxiao_credit` decimal(8,2) DEFAULT '0.00' COMMENT '重销积分',
  `expenses` decimal(8,2) DEFAULT NULL COMMENT '税金',
  `manage` decimal(8,2) DEFAULT NULL COMMENT '管理费',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=433 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `t_userrecord` */
 INSERT INTO `t_userrecord` VALUES ('416','1','普通会员任务奖','增加','14.00','分享朋友圈','2018-09-29 18:27:07','1','14.00','','',''),('417','1','vip会员任务奖','增加','30.00','分享朋友圈','2018-09-29 18:29:36','1','30.00','','',''),('418','1','一代推荐普通会员奖','增加','14.00','动态奖励','2018-09-29 18:45:38','40','14.00','0.00','',''),('419','1','一代推荐vip会员奖','增加','30.00','动态奖励','2018-09-29 18:46:42','40','30.00','0.00','',''),('420','1','一代推荐vip会员任务奖','增加','12.00','任务奖励','2018-09-29 18:56:11','40','12.00','','',''),('421','40','vip会员任务奖','增加','30.00','分享朋友圈','2018-09-29 18:56:11','40','30.00','','',''),('422','40','一代推荐普通会员奖','增加','14.00','动态奖励','2018-09-29 19:01:25','41','14.00','0.00','',''),('423','40','一代推荐vip会员奖','增加','30.00','动态奖励','2018-09-29 19:02:36','41','30.00','0.00','',''),('424','40','一代推荐vip会员任务奖','增加','12.00','任务奖励','2018-09-29 19:35:34','41','12.00','','',''),('427','40','一代推荐vip会员任务奖','增加','12.00','任务奖励','2018-09-29 19:37:38','41','12.00','','',''),('428','41','二代vip会员任务奖','增加','4.00','分享朋友圈','2018-09-29 19:37:38','1','4.00','','',''),('429','41','vip会员任务奖','增加','30.00','分享朋友圈','2018-09-29 19:37:38','41','30.00','','',''),('430','40','一代推荐普通会员任务奖','增加','6.00','任务奖励','2018-09-29 19:41:53','41','6.00','','',''),('431','41','二代普通会员任务奖','增加','3.00','分享朋友圈','2018-09-29 19:41:53','1','3.00','','',''),('432','41','普通会员任务奖','增加','14.00','分享朋友圈','2018-09-29 19:41:53','41','14.00','','','');/* MySQLReback Separation */
 /* 创建表结构 `t_userregion` */
 DROP TABLE IF EXISTS `t_userregion`;/* MySQLReback Separation */ CREATE TABLE `t_userregion` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `region` int(1) NOT NULL,
  `layer` int(11) NOT NULL,
  `usernumber` int(11) NOT NULL,
  `type` int(1) NOT NULL DEFAULT '0',
  `liang` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `t_userregion` */
 INSERT INTO `t_userregion` VALUES ('1','admin','0','1','1','0','0'),('2','admin','1','1','1','0','0'),('3','1001','0','2','1','0','0'),('4','admin','0','2','2','0','0'),('5','1001','1','2','1','0','0'),('6','1002','0','2','1','0','0'),('7','admin','1','2','1','0','0');/* MySQLReback Separation */
 /* 创建表结构 `t_userstatistics` */
 DROP TABLE IF EXISTS `t_userstatistics`;/* MySQLReback Separation */ CREATE TABLE `t_userstatistics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `amount_money` decimal(10,2) NOT NULL,
  `time` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `t_withdrawals` */
 DROP TABLE IF EXISTS `t_withdrawals`;/* MySQLReback Separation */ CREATE TABLE `t_withdrawals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `mode` varchar(150) DEFAULT NULL,
  `accounts` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `money` decimal(10,2) NOT NULL,
  `type` int(2) NOT NULL DEFAULT '0',
  `info` text,
  `time` datetime NOT NULL,
  `khhxx` varchar(255) NOT NULL COMMENT '开户行信息',
  `shouxu` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '手续费',
  `tixian` decimal(10,2) DEFAULT '0.00' COMMENT '提现累计',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `t_withdrawals` */
 INSERT INTO `t_withdrawals` VALUES ('22','15824876380','建行','4115223565125542141','admin','97.00','1','提现','2018-09-14 09:40:51','郑州分行','3.00','97.00'),('28','15824876381','农行','9999999999','张三','97.00','0','提现','2018-09-15 09:21:49','珠海分行','3.00','0.00'),('29','15824876380','建行','4115223565125542141','admin','194.00','0','提现','2018-09-15 17:15:34','郑州分行','6.00','0.00'),('30','15036068240','工行','123456789','汪峰','97.00','0','提现','2018-09-17 16:49:59','123456','3.00','0.00'),('31','13223068164','农行','6222021702052488749','郭娅','97.00','0','提现','2018-09-18 15:59:45','经三路支行','3.00','0.00');/* MySQLReback Separation */
 /* 创建表结构 `t_zhifu` */
 DROP TABLE IF EXISTS `t_zhifu`;/* MySQLReback Separation */ CREATE TABLE `t_zhifu` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `aid` int(12) NOT NULL DEFAULT '0' COMMENT 'appid',
  `zkey` text NOT NULL COMMENT '支付公钥',
  `zh` varchar(200) NOT NULL DEFAULT '0' COMMENT '支付账户',
  `skey` text NOT NULL COMMENT '支付私钥',
  `zname` varchar(100) NOT NULL DEFAULT '0' COMMENT '支付商名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `t_zhifu` */
 INSERT INTO `t_zhifu` VALUES ('1','1323','12121121','1523561245456','23233232','支付宝');/* MySQLReback Separation */
 /* 创建表结构 `t_zige` */
 DROP TABLE IF EXISTS `t_zige`;/* MySQLReback Separation */ CREATE TABLE `t_zige` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL COMMENT '获得资格的用户id',
  `zgnum` int(11) NOT NULL COMMENT '资格数量',
  `tid` int(11) NOT NULL COMMENT '需升级团队id',
  `isout` varchar(255) NOT NULL DEFAULT '1' COMMENT '是否已返还(1为已返还,2为未返还)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;/* MySQLReback Separation */