-- MySQL dump 10.13  Distrib 5.5.29, for Linux (x86_64)
--
-- Host: localhost    Database: dedecms
-- ------------------------------------------------------
-- Server version	5.5.29

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
-- Table structure for table `tbl_audit`
--

DROP TABLE IF EXISTS `tbl_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_audit` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '所属类别 0-手续办理 1-团组出行 2-总结成果',
  `name` varchar(300) NOT NULL DEFAULT '' COMMENT '审核内容',
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_audit`
--

LOCK TABLES `tbl_audit` WRITE;
/*!40000 ALTER TABLE `tbl_audit` DISABLE KEYS */;
INSERT INTO `tbl_audit` VALUES (3,1,'测试一下'),(4,0,'手续');
/*!40000 ALTER TABLE `tbl_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_auditoption`
--

DROP TABLE IF EXISTS `tbl_auditoption`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_auditoption` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `audit` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '所对应的审核',
  `name` varchar(300) NOT NULL DEFAULT '' COMMENT '审核条目',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否分人 0-不分  1-分',
  PRIMARY KEY (`id`),
  KEY `audit` (`audit`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_auditoption`
--

LOCK TABLES `tbl_auditoption` WRITE;
/*!40000 ALTER TABLE `tbl_auditoption` DISABLE KEYS */;
INSERT INTO `tbl_auditoption` VALUES (1,0,'测试内容',0),(2,3,'测试内容',0),(3,3,'测试内容3',1);
/*!40000 ALTER TABLE `tbl_auditoption` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_field`
--

DROP TABLE IF EXISTS `tbl_field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_field` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `table` varchar(20) NOT NULL DEFAULT '' COMMENT 'æ‰€å±žè¡¨',
  `name` varchar(300) NOT NULL DEFAULT '' COMMENT 'å­—æ®µåç§°',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'å­—æ®µç±»åž‹ 0-éžå­—æ®µ 1-æ–‡æœ¬ 2-æ•°å€¼ 3-é€‰æ‹© 4-æ–‡ä»¶',
  `display` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'å¤–è§‚	0-éžå­—æ®µ 1-ä¸æ˜¾ç¤º 2-åŠè¡Œ 3-æ•´è¡Œ',
  `value` varchar(300) NOT NULL DEFAULT '' COMMENT 'å¦‚æžœæ˜¯é€‰æ‹©åž‹ï¼Œå¯¹åº”ç±»åž‹çš„åå­—;å¦‚æžœæ˜¯æ–‡æœ¬åž‹ï¼Œå¯¹åº”é•¿åº¦',
  `search` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'æ˜¯å¦æ˜¯æŸ¥è¯¢å­—æ®µ 0-ä¸æ˜¯æŸ¥è¯¢ éžé›¶-æŸ¥è¯¢ï¼Œä¸”æŒ‰ç…§æ•°å­—é¡ºåºå‡åºæŽ’åˆ—',
  `inlist` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'æ˜¯å¦å‡ºçŽ°åœ¨åˆ—è¡¨ä¸­ 0-ä¸å‡ºçŽ° éžé›¶-å‡ºçŽ°ï¼Œä¸”æŒ‰ç…§æ•°å­—é¡ºåºå‡åºæŽ’åˆ—',
  `order` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `table` (`table`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_field`
--

LOCK TABLES `tbl_field` WRITE;
/*!40000 ALTER TABLE `tbl_field` DISABLE KEYS */;
INSERT INTO `tbl_field` VALUES (2,'tbl_project','项目类别',3,2,'6',1,1,0),(3,'tbl_student','手机号',1,2,'20',1,1,0),(1,'tbl_project','计划人数',2,2,'0',0,0,0);
/*!40000 ALTER TABLE `tbl_field` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_options`
--

DROP TABLE IF EXISTS `tbl_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_options` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `type` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '类型',
  `name` varchar(300) NOT NULL DEFAULT '' COMMENT '选项名称',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否可用 0-不可用 1-可用',
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_options`
--

LOCK TABLES `tbl_options` WRITE;
/*!40000 ALTER TABLE `tbl_options` DISABLE KEYS */;
INSERT INTO `tbl_options` VALUES (3,6,'审批管理类',1),(4,9,'2015',1),(5,8,'英国高德英中培训有限公司',1),(6,7,'英国',1),(7,5,'监管三局',1);
/*!40000 ALTER TABLE `tbl_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_project`
--

DROP TABLE IF EXISTS `tbl_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_project` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL DEFAULT '',
  `adder` varchar(150) NOT NULL DEFAULT '',
  `auditer` varchar(150) NOT NULL DEFAULT '',
  `confirmer` varchar(150) NOT NULL DEFAULT '',
  `timecreated` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `f_1` int(10) unsigned NOT NULL DEFAULT '0',
  `f_2` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `adder` (`adder`),
  KEY `auditer` (`auditer`),
  KEY `checker` (`confirmer`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_project`
--

LOCK TABLES `tbl_project` WRITE;
/*!40000 ALTER TABLE `tbl_project` DISABLE KEYS */;
INSERT INTO `tbl_project` VALUES (1,'项目A','','','','1970-01-01 00:00:00',20,3),(2,'项目B','1','1','1','2015-10-30 00:13:38',100,3),(5,'项目100','1','1','3','2015-11-01 20:44:07',12,3),(4,'项目C2','1','3','3','2015-11-01 12:20:01',100,3),(6,'项目100','1','1','3','2015-11-01 20:44:50',12,3);
/*!40000 ALTER TABLE `tbl_project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_project_auditoption`
--

DROP TABLE IF EXISTS `tbl_project_auditoption`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_project_auditoption` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '对应的项目',
  `auditoption` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '审核条目',
  `value` varchar(4000) NOT NULL DEFAULT '' COMMENT '内容',
  `isAudit` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否已审核',
  `isConfirm` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否已复核',
  PRIMARY KEY (`id`),
  KEY `project` (`project`),
  KEY `auditoption` (`auditoption`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_project_auditoption`
--

LOCK TABLES `tbl_project_auditoption` WRITE;
/*!40000 ALTER TABLE `tbl_project_auditoption` DISABLE KEYS */;
INSERT INTO `tbl_project_auditoption` VALUES (4,6,2,'20151102/d135a9172fbfaea9Chrysanthemum.jpg',1,0),(5,6,3,'[[1,\'20151102/836a017f6a34bc19Desert.jpg\',1,1],[3,\'20151102/4a2d8eda93ea6739Hydrangeas.jpg\',1,0]]',0,0),(6,2,2,'20151102/bb9d964f95f35c82Desert.jpg',1,0),(7,2,3,'',0,0);
/*!40000 ALTER TABLE `tbl_project_auditoption` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_project_student`
--

DROP TABLE IF EXISTS `tbl_project_student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_project_student` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'é¡¹ç›®',
  `student` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'å­¦å‘˜',
  PRIMARY KEY (`id`),
  KEY `project` (`project`),
  KEY `student` (`student`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_project_student`
--

LOCK TABLES `tbl_project_student` WRITE;
/*!40000 ALTER TABLE `tbl_project_student` DISABLE KEYS */;
INSERT INTO `tbl_project_student` VALUES (1,5,1),(2,5,2),(6,6,1),(5,6,3);
/*!40000 ALTER TABLE `tbl_project_student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_student`
--

DROP TABLE IF EXISTS `tbl_student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_student` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `timecreated` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `f_3` varchar(60) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_student`
--

LOCK TABLES `tbl_student` WRITE;
/*!40000 ALTER TABLE `tbl_student` DISABLE KEYS */;
INSERT INTO `tbl_student` VALUES (1,'张三','2015-11-01 19:26:57',''),(2,'李四','2015-11-01 20:14:10',''),(3,'王五','2015-11-01 20:14:18',''),(4,'赵六','2015-11-01 20:14:24','');
/*!40000 ALTER TABLE `tbl_student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_table`
--

DROP TABLE IF EXISTS `tbl_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_table` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `tablename` varchar(20) NOT NULL DEFAULT '' COMMENT '表格英文名，用于创建表格用，只能用大小写字母',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '表格类型 0-A类表 1-B类表',
  `name` varchar(300) NOT NULL DEFAULT '' COMMENT '表格名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_table`
--

LOCK TABLES `tbl_table` WRITE;
/*!40000 ALTER TABLE `tbl_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_types`
--

DROP TABLE IF EXISTS `tbl_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_types` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL DEFAULT '' COMMENT '类型名称',
  `content` varchar(1000) NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_types`
--

LOCK TABLES `tbl_types` WRITE;
/*!40000 ALTER TABLE `tbl_types` DISABLE KEYS */;
INSERT INTO `tbl_types` VALUES (5,'业务司局','业务司局'),(6,'项目类别','项目类别'),(7,'前往国家','前往国家'),(8,'培训机构','培训机构'),(9,'项目年度','项目年度');
/*!40000 ALTER TABLE `tbl_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_userright`
--

DROP TABLE IF EXISTS `tbl_userright`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_userright` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '��Ա',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '���� 0-������ 1-����� 2-������',
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_userright`
--

LOCK TABLES `tbl_userright` WRITE;
/*!40000 ALTER TABLE `tbl_userright` DISABLE KEYS */;
INSERT INTO `tbl_userright` VALUES (18,1,0),(17,3,2),(16,3,1),(19,1,1);
/*!40000 ALTER TABLE `tbl_userright` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-11-04 13:27:14
