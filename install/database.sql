-- MySQL dump 10.13  Distrib 5.6.37, for Linux (x86_64)
--
-- Host: localhost    Database: test12
-- ------------------------------------------------------
-- Server version	5.6.37-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `oreo_ad`
--

DROP TABLE IF EXISTS `oreo_ad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_ad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(128) NOT NULL,
  `text` longtext NOT NULL,
  `ad_type` int(11) NOT NULL,
  `authid` varchar(128) NOT NULL,
  `authname` varchar(64) NOT NULL,
  `dtime` date NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_ad`
--

LOCK TABLES `oreo_ad` WRITE;
/*!40000 ALTER TABLE `oreo_ad` DISABLE KEYS */;
/*!40000 ALTER TABLE `oreo_ad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_authorize`
--

DROP TABLE IF EXISTS `oreo_authorize`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_authorize` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `web_name` varchar(255) NOT NULL,
  `qq` varchar(255) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `syskey` varchar(255) NOT NULL,
  `version` varchar(255) NOT NULL,
  `ip_qh` int(11) NOT NULL,
  `yumi` int(11) NOT NULL,
  `sjname` varchar(122) NOT NULL,
  `sjid` varchar(255) NOT NULL,
  `authname` varchar(64) NOT NULL,
  `authid` varchar(64) NOT NULL,
  `gh_code` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sjname` (`sjname`),
  KEY `gh_code` (`gh_code`),
  KEY `domain` (`domain`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=229 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_authorize`
--

LOCK TABLES `oreo_authorize` WRITE;
/*!40000 ALTER TABLE `oreo_authorize` DISABLE KEYS */;
/*!40000 ALTER TABLE `oreo_authorize` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_authsys`
--

DROP TABLE IF EXISTS `oreo_authsys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_authsys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `syskeys` varchar(255) NOT NULL,
  `money` varchar(10) NOT NULL,
  `type` int(11) NOT NULL,
  `sjzf` varchar(16) NOT NULL,
  `otable` varchar(32) NOT NULL,
  `user` text NOT NULL,
  `grade_code1` text NOT NULL,
  `grade_code2` text NOT NULL,
  `grade_code3` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_authsys`
--

LOCK TABLES `oreo_authsys` WRITE;
/*!40000 ALTER TABLE `oreo_authsys` DISABLE KEYS */;
/*!40000 ALTER TABLE `oreo_authsys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_daoban`
--

DROP TABLE IF EXISTS `oreo_daoban`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_daoban` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `domain` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `sql_host` varchar(255) NOT NULL COMMENT '数据库服务器',
  `sql_port` varchar(255) NOT NULL COMMENT '数据库端口',
  `sql_user` varchar(255) NOT NULL COMMENT '数据库用户名',
  `sql_pwd` varchar(255) NOT NULL COMMENT '数据库密码',
  `sql_dbname` varchar(255) NOT NULL COMMENT '数据库名',
  `beizhu` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=507 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_daoban`
--

LOCK TABLES `oreo_daoban` WRITE;
/*!40000 ALTER TABLE `oreo_daoban` DISABLE KEYS */;
/*!40000 ALTER TABLE `oreo_daoban` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_gonggao`
--

DROP TABLE IF EXISTS `oreo_gonggao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_gonggao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` longtext NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_gonggao`
--

LOCK TABLES `oreo_gonggao` WRITE;
/*!40000 ALTER TABLE `oreo_gonggao` DISABLE KEYS */;
/*!40000 ALTER TABLE `oreo_gonggao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_hmd`
--

DROP TABLE IF EXISTS `oreo_hmd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_hmd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(8) NOT NULL,
  `qq` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `url` varchar(16) NOT NULL,
  `jblx` varchar(18) NOT NULL,
  `hmdly` text NOT NULL,
  `time` varchar(256) NOT NULL,
  `type` int(11) NOT NULL,
  `jbzqq` varchar(22) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `qq` (`qq`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_hmd`
--

LOCK TABLES `oreo_hmd` WRITE;
/*!40000 ALTER TABLE `oreo_hmd` DISABLE KEYS */;
/*!40000 ALTER TABLE `oreo_hmd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_html`
--

DROP TABLE IF EXISTS `oreo_html`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_html` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_html`
--

LOCK TABLES `oreo_html` WRITE;
/*!40000 ALTER TABLE `oreo_html` DISABLE KEYS */;
/*!40000 ALTER TABLE `oreo_html` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_kami`
--

DROP TABLE IF EXISTS `oreo_kami`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_kami` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `kami` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `hddx` int(11) NOT NULL,
  `money` varchar(32) NOT NULL,
  `sysnum` varchar(255) NOT NULL,
  `sysname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_kami`
--

LOCK TABLES `oreo_kami` WRITE;
/*!40000 ALTER TABLE `oreo_kami` DISABLE KEYS */;
/*!40000 ALTER TABLE `oreo_kami` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_log`
--

DROP TABLE IF EXISTS `oreo_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `domain` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `version` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_log`
--

LOCK TABLES `oreo_log` WRITE;
/*!40000 ALTER TABLE `oreo_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `oreo_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_notice`
--

DROP TABLE IF EXISTS `oreo_notice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `text` longtext NOT NULL,
  `dtime` date NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_notice`
--


--
-- Table structure for table `oreo_order`
--

DROP TABLE IF EXISTS `oreo_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_order` (
  `trade_no` varchar(64) NOT NULL,
  `out_trade_no` varchar(64) NOT NULL,
  `type` varchar(20) NOT NULL,
  `pid` varchar(255) NOT NULL,
  `buyer` varchar(60) NOT NULL,
  `buyer_id` varchar(128) NOT NULL,
  `addtime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `name` varchar(64) NOT NULL,
  `money` varchar(32) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`trade_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_order`
--

LOCK TABLES `oreo_order` WRITE;
/*!40000 ALTER TABLE `oreo_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `oreo_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_powera`
--

DROP TABLE IF EXISTS `oreo_powera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_powera` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `glcx1` text NOT NULL,
  `money1` int(11) NOT NULL,
  `sqtj1` int(11) NOT NULL,
  `sqxg1` int(11) NOT NULL,
  `sqsc1` int(11) NOT NULL,
  `sqall1` int(11) NOT NULL,
  `cxall1` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_powera`
--

LOCK TABLES `oreo_powera` WRITE;
/*!40000 ALTER TABLE `oreo_powera` DISABLE KEYS */;
INSERT INTO `oreo_powera` VALUES (3,'a7ffd4cd36c81701',1,1,1,1,0,0);
/*!40000 ALTER TABLE `oreo_powera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_powerb`
--

DROP TABLE IF EXISTS `oreo_powerb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_powerb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `glcx2` text NOT NULL,
  `money2` int(11) NOT NULL,
  `sqtj2` int(11) NOT NULL,
  `sqxg2` int(11) NOT NULL,
  `sqsc2` int(11) NOT NULL,
  `sqall2` int(11) NOT NULL,
  `cxall2` int(11) NOT NULL,
  `tjsq2` int(11) NOT NULL,
  `tjsqxg2` int(11) NOT NULL,
  `tjsqsc2` int(11) NOT NULL,
  `tjsqall2` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_powerb`
--

LOCK TABLES `oreo_powerb` WRITE;
/*!40000 ALTER TABLE `oreo_powerb` DISABLE KEYS */;
INSERT INTO `oreo_powerb` VALUES (3,'a7ffd4cd36c81701',1,1,1,1,0,0,1,1,1,0);
/*!40000 ALTER TABLE `oreo_powerb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_powerc`
--

DROP TABLE IF EXISTS `oreo_powerc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_powerc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `glcx3` text NOT NULL,
  `glcx4` text NOT NULL,
  `money3` int(11) NOT NULL,
  `sqtj3` int(11) NOT NULL,
  `sqxg3` int(11) NOT NULL,
  `sqsc3` int(11) NOT NULL,
  `sqall3` int(11) NOT NULL,
  `cxall3` int(11) NOT NULL,
  `tjsq3` int(11) NOT NULL,
  `tjsqxg3` int(11) NOT NULL,
  `tjsqsc3` int(11) NOT NULL,
  `tjsqall3` int(11) NOT NULL,
  `tjsyall3` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_powerc`
--

LOCK TABLES `oreo_powerc` WRITE;
/*!40000 ALTER TABLE `oreo_powerc` DISABLE KEYS */;
INSERT INTO `oreo_powerc` VALUES (2,'','',0,1,1,1,1,1,1,1,1,1,1);
/*!40000 ALTER TABLE `oreo_powerc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_qcback`
--

DROP TABLE IF EXISTS `oreo_qcback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_qcback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `callback` varchar(255) NOT NULL,
  `addtime` datetime NOT NULL,
  `state` int(11) NOT NULL,
  `in_all` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_qcback`
--

LOCK TABLES `oreo_qcback` WRITE;
/*!40000 ALTER TABLE `oreo_qcback` DISABLE KEYS */;
/*!40000 ALTER TABLE `oreo_qcback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_regcode`
--

DROP TABLE IF EXISTS `oreo_regcode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_regcode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL DEFAULT '0',
  `code` varchar(32) NOT NULL,
  `email` varchar(32) DEFAULT NULL,
  `time` int(11) NOT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `trade_no` varchar(32) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=278 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_regcode`
--

LOCK TABLES `oreo_regcode` WRITE;
/*!40000 ALTER TABLE `oreo_regcode` DISABLE KEYS */;
INSERT INTO `oreo_regcode` VALUES (258,0,'1617870','482430025@qq.com',1612147402,'117.157.203.201',0,NULL,NULL),(259,0,'5845985','482430025@qq.com',1612147512,'117.157.203.201',1,NULL,NULL),(260,1,'577932','15293420572',1612162413,'117.157.203.201',0,NULL,NULL),(261,3,'597095','15293420572',1612179967,'117.157.203.201',1,NULL,NULL),(262,1,'696991','15293420572',1612278071,'117.157.203.201',0,NULL,NULL),(263,1,'853972','15293420572',1612279879,'117.157.203.201',0,NULL,NULL),(264,1,'581002','15811915817',1612327164,'223.104.56.26',0,NULL,NULL),(265,1,'675589','15811915817',1612327192,'113.83.69.45',0,NULL,NULL),(266,0,'3423323','482430025@qq.com',1612342696,'117.157.203.201',1,NULL,NULL),(267,2,'3768114','482430025@qq.com',1612342760,'117.157.203.201',0,NULL,NULL),(268,2,'9904260','482430025@qq.com',1612346387,'117.157.203.201',0,NULL,NULL),(269,3,'145394','15293420572',1612347514,'117.157.203.201',0,NULL,NULL),(270,3,'244074','15293420572',1612348241,'117.157.203.201',1,NULL,NULL),(271,3,'362252','15293420572',1612621068,'117.157.203.201',0,NULL,NULL),(272,3,'754766','15293420572',1612622124,'117.157.203.201',0,NULL,NULL),(273,2,'9842640','482430025@qq.com',1612622733,'117.157.203.201',1,NULL,NULL),(274,2,'7693930','482430025@qq.com',1612623523,'117.157.203.201',0,NULL,NULL),(275,3,'481956','15293420572',1612626489,'117.157.203.201',0,NULL,NULL),(276,3,'394199','15293420572',1612626669,'117.157.203.201',1,NULL,NULL),(277,3,'976857','15293420572',1612627072,'117.157.203.201',1,NULL,NULL);
/*!40000 ALTER TABLE `oreo_regcode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_safe`
--

DROP TABLE IF EXISTS `oreo_safe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_safe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` varchar(255) NOT NULL,
  `time` varchar(64) NOT NULL,
  `login` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_safe`
--

LOCK TABLES `oreo_safe` WRITE;
/*!40000 ALTER TABLE `oreo_safe` DISABLE KEYS */;
/*!40000 ALTER TABLE `oreo_safe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_shop_apply`
--

DROP TABLE IF EXISTS `oreo_shop_apply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_shop_apply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `odd_numbers` varchar(128) NOT NULL,
  `real_name` varchar(255) NOT NULL,
  `alipay_id` varchar(255) NOT NULL,
  `money` varchar(128) NOT NULL,
  `addtime` datetime DEFAULT NULL,
  `transfer_status` int(11) NOT NULL,
  `transfer_result` varchar(255) NOT NULL,
  `transfer_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=118 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_shop_apply`
--

LOCK TABLES `oreo_shop_apply` WRITE;
/*!40000 ALTER TABLE `oreo_shop_apply` DISABLE KEYS */;
/*!40000 ALTER TABLE `oreo_shop_apply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_shop_details`
--

DROP TABLE IF EXISTS `oreo_shop_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_shop_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_code` varchar(128) NOT NULL,
  `seller` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `money` varchar(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `payment_method` varchar(20) NOT NULL,
  `buyer` varchar(255) NOT NULL,
  `trade_no` varchar(255) NOT NULL,
  `out_trade_no` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `addtime` datetime NOT NULL,
  `endtime` datetime DEFAULT NULL,
  `seller_adtime` datetime DEFAULT NULL COMMENT '卖家确认订单时间',
  `seller_endtime` datetime DEFAULT NULL,
  `user_adtime` datetime DEFAULT NULL,
  `user_endtime` datetime DEFAULT NULL,
  `status` int(11) NOT NULL,
  `shop_type` int(11) NOT NULL,
  `order_text` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `out_trade_no` (`out_trade_no`)
) ENGINE=MyISAM AUTO_INCREMENT=131 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_shop_details`
--

LOCK TABLES `oreo_shop_details` WRITE;
/*!40000 ALTER TABLE `oreo_shop_details` DISABLE KEYS */;
INSERT INTO `oreo_shop_details` VALUES (130,'','','oreo实名认证','5',0,'','','2021020122115595684','20210201221155790','xiaoli','2021-02-01 22:11:55',NULL,NULL,NULL,NULL,NULL,0,0,'');
/*!40000 ALTER TABLE `oreo_shop_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_shop_guarantee`
--

DROP TABLE IF EXISTS `oreo_shop_guarantee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_shop_guarantee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller` varchar(32) NOT NULL,
  `seller_qq` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `text` text NOT NULL,
  `photo` text NOT NULL,
  `money` varchar(12) NOT NULL,
  `stock` int(11) NOT NULL COMMENT '库存',
  `evaluate_good` int(11) NOT NULL,
  `evaluate_bad` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `addtime` date NOT NULL,
  `unique_code` varchar(128) NOT NULL COMMENT '唯一识别码',
  PRIMARY KEY (`id`),
  KEY `seller` (`seller`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_shop_guarantee`
--

LOCK TABLES `oreo_shop_guarantee` WRITE;
/*!40000 ALTER TABLE `oreo_shop_guarantee` DISABLE KEYS */;
/*!40000 ALTER TABLE `oreo_shop_guarantee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_shop_notice`
--

DROP TABLE IF EXISTS `oreo_shop_notice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_shop_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `text` longtext NOT NULL,
  `dtime` date NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_shop_notice`
--

LOCK TABLES `oreo_shop_notice` WRITE;
/*!40000 ALTER TABLE `oreo_shop_notice` DISABLE KEYS */;
/*!40000 ALTER TABLE `oreo_shop_notice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_shop_real`
--

DROP TABLE IF EXISTS `oreo_shop_real`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_shop_real` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(128) NOT NULL,
  `sex` varchar(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `alipay_id` varchar(128) NOT NULL,
  `real_name` varchar(128) NOT NULL,
  `sfnumber` varchar(128) NOT NULL,
  `real_time` datetime NOT NULL,
  `activation` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_shop_real`
--

LOCK TABLES `oreo_shop_real` WRITE;
/*!40000 ALTER TABLE `oreo_shop_real` DISABLE KEYS */;
/*!40000 ALTER TABLE `oreo_shop_real` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_shop_site`
--

DROP TABLE IF EXISTS `oreo_shop_site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_shop_site` (
  `o` varchar(200) NOT NULL,
  `r` text,
  PRIMARY KEY (`o`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_shop_site`
--

LOCK TABLES `oreo_shop_site` WRITE;
/*!40000 ALTER TABLE `oreo_shop_site` DISABLE KEYS */;
INSERT INTO `oreo_shop_site` VALUES ('alipay_appid',''),('alipay_privatekey',''),('ali_api_partner',''),('ali_api_seller_email',''),('ali_close_info','0'),('payer_show_name','Oreo综合服务站退款服务'),('real_money','5');
/*!40000 ALTER TABLE `oreo_shop_site` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_shop_user`
--

DROP TABLE IF EXISTS `oreo_shop_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_shop_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `qq` varchar(32) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `money` varchar(32) NOT NULL,
  `frozen_balance` varchar(32) NOT NULL,
  `reg_time` date NOT NULL,
  `type` int(11) NOT NULL,
  `activation` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_shop_user`
--

LOCK TABLES `oreo_shop_user` WRITE;
/*!40000 ALTER TABLE `oreo_shop_user` DISABLE KEYS */;
INSERT INTO `oreo_shop_user` VALUES (26,'xiaoli','xiaoli','2498131909','15293420572','482430025@qq.com','0','0','2021-02-01',1,1);
/*!40000 ALTER TABLE `oreo_shop_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_shop_visitors`
--

DROP TABLE IF EXISTS `oreo_shop_visitors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_shop_visitors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `shop_id` int(11) NOT NULL,
  `ip` char(30) DEFAULT NULL COMMENT 'ip地址',
  `froms` char(100) DEFAULT NULL COMMENT '归属地',
  `add_time` datetime NOT NULL COMMENT '添加时间',
  `system` char(60) DEFAULT NULL COMMENT '操作系统',
  `browser` char(200) DEFAULT NULL COMMENT '浏览器',
  `pageview` char(200) DEFAULT NULL COMMENT '受访页面',
  `source_link` varchar(1000) DEFAULT NULL COMMENT '来源链接',
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`),
  KEY `add_time` (`add_time`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COMMENT='访客表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_shop_visitors`
--

LOCK TABLES `oreo_shop_visitors` WRITE;
/*!40000 ALTER TABLE `oreo_shop_visitors` DISABLE KEYS */;
/*!40000 ALTER TABLE `oreo_shop_visitors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_site`
--

DROP TABLE IF EXISTS `oreo_site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_site` (
  `o` varchar(200) NOT NULL,
  `r` text,
  PRIMARY KEY (`o`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_site`
--

LOCK TABLES `oreo_site` WRITE;
/*!40000 ALTER TABLE `oreo_site` DISABLE KEYS */;
INSERT INTO `oreo_site` VALUES ('admin_pwd','ecc0e3c226d4c56f38087a7fbff24833'),('admin_user','admin'),('alipay_mode','0'),('ali_api_key',''),('ali_api_partner',''),('ali_api_seller_email',''),('ali_close_info','0'),('ali_epay_api_id',''),('ali_epay_api_key',''),('ali_epay_api_url',''),('CAPTCHA_ID',''),('local_domain','test.xingxuanwangluo.cn'),('mail_cloud','0'),('mail_name',''),('mail_port',''),('mail_pwd',''),('mail_smtp',''),('message_1','<font color=red>未授权域名，授权请QQ：2498131909</font>'),('message_2','<font color=red>授权已经到期，授权请QQ：2498131909</font>'),('message_3','<font color=red>授权IP不正确，授权请QQ：2498131909</font>'),('message_4','<font color=red>授权程序不正确，授权请QQ：2498131909</font>'),('oreo_cdn','https://cdn.oreo.2free.cn/'),('oreo_codepay_api_id','0'),('oreo_codepay_api_key','0'),('oreo_dqsj','1'),('oreo_dtime','1640880000'),('oreo_gg1','【内容】 欢迎使用Oreo授权系统，使用过程中如有什么问题请联系QQ：2498131909'),('oreo_gg2','【内容】 Oreo支付系统目前单售价为30元/套.'),('oreo_gg3','【内容】 如果您想使用oreo支付系统请添加oreo官方群，通过群文件获取安装包。'),('oreo_gg4','【内容】 本系统逐渐完善和开发新功能中...'),('oreo_ipyz','1'),('oreo_ordername','oreo支付系统在线充值'),('oreo_scname1','普通授权商'),('oreo_scname2','平台副管理'),('oreo_scname3','合作伙伴'),('oreo_scyz','1'),('oreo_sqfs','1'),('oreo_tenmsg_appid',''),('oreo_tenmsg_key',''),('oreo_tenmsg_smsSign',''),('oreo_tenmsg_templateId',''),('oreo_yctype',''),('oreo_zfsm','<p class=\"mb-0\">关于在线充值的注意事项：<br/>\n1.请不要恶意提交充值订单，投诉订单，否则后果自负.<br/>\n2.请确保您所提交的账号为您本人，支付成功后资金错乱概不负责.<br/>\n3.请您一定要耐心等待付款返回跳转到本站的过程，若有问题请联系管理员.<br/>'),('oreo_zxcz','1'),('owrk_ask','<option value=\"充值没到账\" >充值没到账</option>\n<option value=\"授权有问题\" >授权有问题</option>\n<option value=\"授权有问题\" >关于Oreo支付系统</option>\n<option value=\"授权有问题\" >关于Oreo授权系统</option>\n<option value=\"其他问题\" >其他问题</option>'),('owrk_zt','1'),('PRIVATE_KEY',''),('qqpay_mode','0'),('qq_api_mchid',''),('qq_api_mchkey',''),('qq_close_info','暂时关闭'),('qq_epay_api_id',''),('qq_epay_api_key',''),('qq_epay_api_url',''),('rpassword','123456'),('shop_ad','0'),('web_beian','苏ICP备18068633号-1'),('web_copyright','Oreo授权系统 By Oreo原创'),('web_qq','2498131909'),('web_title','Oreo授权系统'),('wxpay_mode','0'),('wx_api_appid',''),('wx_api_appsecret',''),('wx_api_key',''),('wx_api_mchid',''),('wx_close_info','暂时关闭'),('wx_epay_api_id',''),('wx_epay_api_key',''),('wx_epay_api_url',''),('z_ad_money','20'),('z_ad_text','<li>Oreo站内广告</li>\n<li>位于首页授权栏顶级页面</li>\n<li>曝光率极高</li>\n<li>低价格，高曝光率</li>\n<li>一键式操作，快速便捷</li>');
/*!40000 ALTER TABLE `oreo_site` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_tensms`
--

DROP TABLE IF EXISTS `oreo_tensms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_tensms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` varchar(255) NOT NULL,
  `domain` varchar(64) NOT NULL,
  `token` varchar(32) NOT NULL,
  `surplus` varchar(12) NOT NULL,
  `addtime` datetime NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_tensms`
--

LOCK TABLES `oreo_tensms` WRITE;
/*!40000 ALTER TABLE `oreo_tensms` DISABLE KEYS */;
/*!40000 ALTER TABLE `oreo_tensms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_user`
--

DROP TABLE IF EXISTS `oreo_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_user` (
  `id` varchar(255) NOT NULL,
  `names` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `login_token` varchar(64) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `qq` varchar(14) NOT NULL,
  `qc_id` varchar(255) NOT NULL,
  `type` text NOT NULL,
  `sjname` varchar(255) NOT NULL,
  `sjid` varchar(255) NOT NULL,
  `action` int(11) NOT NULL,
  `money` float NOT NULL DEFAULT '0',
  `sysnum` text NOT NULL,
  `grade_code3` text NOT NULL,
  `grade_name` varchar(255) NOT NULL,
  `kami` int(11) NOT NULL,
  `beta` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_user`
--

LOCK TABLES `oreo_user` WRITE;
/*!40000 ALTER TABLE `oreo_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `oreo_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_version`
--

DROP TABLE IF EXISTS `oreo_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_version` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `file` varchar(255) NOT NULL,
  `authname` varchar(64) NOT NULL,
  `authid` varchar(64) NOT NULL,
  `beta` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_version`
--

LOCK TABLES `oreo_version` WRITE;
/*!40000 ALTER TABLE `oreo_version` DISABLE KEYS */;
/*!40000 ALTER TABLE `oreo_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_work`
--

DROP TABLE IF EXISTS `oreo_work`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_work` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) DEFAULT NULL,
  `num` varchar(16) NOT NULL,
  `types` varchar(16) NOT NULL,
  `biaoti` text,
  `text` text,
  `qq` varchar(16) NOT NULL,
  `edata` varchar(16) NOT NULL,
  `huifu` text,
  `wdata` varchar(16) NOT NULL,
  `active` varchar(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `num` (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_work`
--

LOCK TABLES `oreo_work` WRITE;
/*!40000 ALTER TABLE `oreo_work` DISABLE KEYS */;
INSERT INTO `oreo_work` VALUES (18,'xiaoli','367786497','授权有问题','1','1','2498131909','2021-02-01',NULL,' ','0');
/*!40000 ALTER TABLE `oreo_work` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oreo_wxback`
--

DROP TABLE IF EXISTS `oreo_wxback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oreo_wxback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `callback` varchar(255) NOT NULL,
  `addtime` datetime NOT NULL,
  `state` int(11) NOT NULL,
  `in_all` varchar(255) NOT NULL,
  `xieyi` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oreo_wxback`
--

LOCK TABLES `oreo_wxback` WRITE;
/*!40000 ALTER TABLE `oreo_wxback` DISABLE KEYS */;
/*!40000 ALTER TABLE `oreo_wxback` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-02-10 17:51:15
