-- MySQL dump 10.15  Distrib 10.0.36-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: mdbadmin
-- ------------------------------------------------------
-- Server version	10.0.36-MariaDB-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clusters`
--

DROP TABLE IF EXISTS `clusters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clusters` (
  `cluster_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `parent_cluster_id` bigint(20) unsigned NOT NULL,
  `view_order` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`cluster_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=1420 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPRESSED;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clusters`
--

LOCK TABLES `clusters` WRITE;
/*!40000 ALTER TABLE `clusters` DISABLE KEYS */;
INSERT INTO `clusters` VALUES (31,'XP',0,1),(131,'Infrastructure',0,3),(231,'Person Monitor',0,4),(331,'Tools',0,6),(431,'Reporting',0,5),(531,'Database Admin',31,7),(731,'Transaction',31,2),(820,'Galera',0,9),(910,'Monitoring',0,8);
/*!40000 ALTER TABLE `clusters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cpu_load_alerts`
--

DROP TABLE IF EXISTS `cpu_load_alerts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cpu_load_alerts` (
  `server_id` bigint(20) unsigned NOT NULL,
  `warning_level` decimal(10,2) NOT NULL,
  `error_level` decimal(10,2) NOT NULL,
  PRIMARY KEY (`server_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cpu_load_alerts`
--

LOCK TABLES `cpu_load_alerts` WRITE;
/*!40000 ALTER TABLE `cpu_load_alerts` DISABLE KEYS */;
/*!40000 ALTER TABLE `cpu_load_alerts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `datacenters`
--

DROP TABLE IF EXISTS `datacenters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `datacenters` (
  `datacenter_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `view_order` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`datacenter_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=232 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPRESSED;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datacenters`
--

LOCK TABLES `datacenters` WRITE;
/*!40000 ALTER TABLE `datacenters` DISABLE KEYS */;
INSERT INTO `datacenters` VALUES (31,'D0',1),(131,'D1',2),(231,'D2',3);
/*!40000 ALTER TABLE `datacenters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disk_alerts`
--

DROP TABLE IF EXISTS `disk_alerts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disk_alerts` (
  `alert_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `server_id` bigint(20) unsigned NOT NULL,
  `volume` varchar(100) NOT NULL,
  `warning_level_pct` int(10) unsigned NOT NULL,
  `error_level_pct` int(10) unsigned NOT NULL,
  PRIMARY KEY (`alert_id`),
  UNIQUE KEY `server_id_volumne` (`server_id`,`volume`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disk_alerts`
--

LOCK TABLES `disk_alerts` WRITE;
/*!40000 ALTER TABLE `disk_alerts` DISABLE KEYS */;
INSERT INTO `disk_alerts` VALUES (1,31,'/opt/mysql/data',60,70),(2,31,'/opt/logs',40,60),(3,7810,'/opt',22,33);
/*!40000 ALTER TABLE `disk_alerts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dns_aliases`
--

DROP TABLE IF EXISTS `dns_aliases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dns_aliases` (
  `alias_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `is_vip` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `vip_port` int(10) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`alias_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dns_aliases`
--

LOCK TABLES `dns_aliases` WRITE;
/*!40000 ALTER TABLE `dns_aliases` DISABLE KEYS */;
INSERT INTO `dns_aliases` VALUES (3,'d0dbrep-sq01.trads.us',1,1234,1),(4,'d0dbinfra-sq01.trads.us',0,0,0),(5,'d0dbinfra-sq01.trads.usasfafafafafafaf.fsfsf.dsdssds',0,0,1);
/*!40000 ALTER TABLE `dns_aliases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `environments`
--

DROP TABLE IF EXISTS `environments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `environments` (
  `environment_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `view_order` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`environment_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=412 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPRESSED;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `environments`
--

LOCK TABLES `environments` WRITE;
/*!40000 ALTER TABLE `environments` DISABLE KEYS */;
INSERT INTO `environments` VALUES (31,'Production',1),(131,'QA',2),(231,'Development',3),(411,'Backup',5);
/*!40000 ALTER TABLE `environments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `replication_lag_alerts`
--

DROP TABLE IF EXISTS `replication_lag_alerts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `replication_lag_alerts` (
  `server_id` bigint(20) unsigned NOT NULL,
  `warning_level_secs` int(10) unsigned NOT NULL,
  `error_level_secs` int(10) unsigned NOT NULL,
  PRIMARY KEY (`server_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `replication_lag_alerts`
--

LOCK TABLES `replication_lag_alerts` WRITE;
/*!40000 ALTER TABLE `replication_lag_alerts` DISABLE KEYS */;
INSERT INTO `replication_lag_alerts` VALUES (331,60,80),(6911,75,80),(9010,55,66);
/*!40000 ALTER TABLE `replication_lag_alerts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servers`
--

DROP TABLE IF EXISTS `servers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servers` (
  `server_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `hostname` varchar(67) NOT NULL,
  `port_name` varchar(20) NOT NULL DEFAULT '',
  `srv_id` varchar(64) DEFAULT NULL,
  `environment_id` bigint(20) unsigned NOT NULL,
  `datacenter_id` bigint(20) unsigned NOT NULL,
  `cluster_id` bigint(20) unsigned NOT NULL,
  `view_order` int(11) NOT NULL DEFAULT '1' COMMENT 'Order to display in front-end.  Values start at 1',
  `active` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Values are 0 or 1',
  `exclude_noc` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT 'Values are 0 or 1',
  `exclude_disk_check` tinyint(4) NOT NULL DEFAULT '0',
  `maint_mode` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT 'Values are 0 or 1',
  `maint_mode_start_date` datetime DEFAULT NULL,
  `transaction_server` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_master_trans_server` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` varchar(80) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(80) DEFAULT NULL,
  `modified_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`server_id`),
  UNIQUE KEY `hostname_port_name` (`hostname`,`port_name`),
  UNIQUE KEY `srv_id` (`srv_id`),
  KEY `fk_environment_id` (`environment_id`),
  KEY `fk_datacenter_id` (`datacenter_id`),
  KEY `fk_cluster_id` (`cluster_id`),
  CONSTRAINT `fk_cluster_id` FOREIGN KEY (`cluster_id`) REFERENCES `clusters` (`cluster_id`),
  CONSTRAINT `fk_datacenter_id` FOREIGN KEY (`datacenter_id`) REFERENCES `datacenters` (`datacenter_id`),
  CONSTRAINT `fk_environment_id` FOREIGN KEY (`environment_id`) REFERENCES `environments` (`environment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9711 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPRESSED;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servers`
--

LOCK TABLES `servers` WRITE;
/*!40000 ALTER TABLE `servers` DISABLE KEYS */;
INSERT INTO `servers` VALUES (31,'d1dbadminp01','','10.218.175.234',31,131,531,5,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(131,'d0dbadminp01','','10.218.154.214',31,31,531,5,2,1,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(231,'d0dbxpp04','','10.218.154.213',31,31,31,4,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','','2018-09-25 14:14:46'),(331,'d1dbxpp04','','10.218.175.231',31,131,31,4,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(431,'d1dbtransp01','','10.218.175.244',31,131,731,8,2,0,0,0,NULL,1,1,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(531,'d0dbrepd01','','10.218.154.230',231,31,431,4,2,1,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(631,'d1dbxpp03','','10.218.175.248',31,131,31,3,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(731,'d1dbxpp02','','10.218.175.247',31,131,31,2,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(831,'d1dbxpp01','','10.218.175.246',31,131,31,1,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(1331,'d0dbxpd01','','10.218.154.234',231,31,31,1,2,1,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(1431,'d0dbrepp01','','10.218.154.228',31,31,431,1,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(1531,'d0dbpmp02','','10.218.154.232',31,31,231,2,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(1631,'d1dbpmp01','','10.218.175.242',31,131,231,1,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(1731,'d0dbpmp01','','10.218.154.231',31,31,231,1,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(1831,'d0dbinfrad01','','10.218.154.236',231,31,131,3,2,1,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(1931,'d0dbinfrap03','','10.218.154.224',31,31,131,5,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(2031,'d1dbinfrap03','','10.218.175.251',31,131,131,5,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(2131,'d1dbinfrap02','','10.218.175.250',31,131,131,4,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(2231,'d1dbinfrap01','','10.218.175.249',31,131,131,3,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(2331,'d0dbxpp03','','10.218.154.212',31,31,31,3,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','','2018-09-25 14:14:39'),(2431,'d0dbrepq01','','10.218.154.238',131,31,431,7,2,1,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(2531,'d0dbxpp02','','10.218.154.211',31,31,31,2,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(2631,'d0dbtransd01','','10.218.154.235',231,31,731,2,2,1,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(2731,'d0dbxpp01','','10.218.154.210',31,31,31,2,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(2831,'d0dbxpq01','','10.218.154.237',131,31,31,5,2,1,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(2931,'d0dbtransq01','','10.218.154.243',131,31,731,6,2,1,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(3031,'d0dbinfrap02','','10.218.154.223',31,31,131,4,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(3131,'d0dbinfrap01','','10.218.154.222',31,31,131,3,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(3431,'d2dbxpp01','','10.220.239.201',31,231,31,1,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(3531,'d2dbxpp02','','10.220.239.202',31,231,31,2,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(3631,'d2dbxpp03','','10.220.239.203',31,231,31,3,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(3731,'d2dbxpp04','','10.220.239.204',31,231,31,4,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(3931,'d2dbinfrap02','','10.220.239.207',31,231,131,2,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(4131,'d0dbpmp03','','10.218.154.215',31,31,231,3,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(4231,'d2dbpmp01','','10.220.239.211',31,231,231,2,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(4331,'d2dbpmp02','','10.220.239.212',31,231,231,3,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(4431,'d2dbpmp03','','10.220.239.213',31,231,231,4,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(4531,'d2dbadminp01','','10.220.239.200',31,231,531,1,2,1,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(4631,'d1dbpmp02','','10.218.175.241',31,131,231,2,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(4731,'d2dbtransp01','','10.220.239.214',31,231,731,8,2,0,0,0,NULL,1,1,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(4931,'d1dbpmp03','','10.218.175.243',31,131,231,3,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(5031,'d1dbbackupp01','xp','10.218.175.235:3306',411,131,31,1,2,1,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(5131,'d1dbbackupp01','infra','10.218.175.235:3307',411,131,131,1,2,1,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(5231,'d1dbbackupp01','pm','10.218.175.235:3308',411,131,231,1,2,1,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(5311,'d1dbrepp01','','10.218.175.232',31,131,431,1,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(5411,'d2dbrepp01','','10.220.239.209',31,231,431,1,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(5511,'d2dbtoolsp01','','10.220.239.210',31,231,331,1,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(5611,'d0dbinfraq01','','10.218.154.244',131,31,131,8,2,1,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(5811,'d0dbtoolsp01','','10.218.154.208',31,31,331,1,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(5911,'d1dbtoolsp01','','10.218.175.208',31,131,331,1,2,0,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(5920,'d0dbinfraq02','','10.218.153.238',131,31,131,9,2,1,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(5950,'d1dbbackupp01','tools','10.218.175.235:3309',411,131,331,4,2,1,0,0,NULL,0,0,'ron','2017-02-13 15:10:34','dbadmin','2017-02-13 15:11:38'),(6620,'d0dbtransp01','','10.218.154.240',31,31,731,1,2,0,0,0,NULL,1,1,'dbadmin','2017-07-07 10:37:41','dbadmin','2017-07-19 08:31:31'),(6711,'d0dbadmind01','','10.218.155.47',231,31,531,1,2,1,0,0,NULL,0,0,'dbadmin','2017-09-29 13:13:43',NULL,NULL),(7130,'d2dbinfrap01','','10.220.239.205',31,231,131,1,2,0,0,0,NULL,0,0,'dbadmin','2018-02-12 08:32:09','dbadmin','2018-02-12 08:35:44'),(7330,'d2dbinfrap03','','10.220.239.208',31,231,131,3,2,0,0,0,NULL,0,0,'dbadmin','2018-02-12 08:33:06','dbadmin','2018-03-08 18:32:08'),(7430,'d2dbxpp05','','10.220.239.216',31,231,31,5,2,0,0,0,NULL,0,0,'dbadmin','2018-03-06 08:38:24','dbadmin','2018-03-06 09:23:07'),(7530,'d2dbxpp06','','10.220.239.217',31,231,31,6,2,0,0,0,NULL,0,0,'dbadmin','2018-03-06 08:38:46','dbadmin','2018-03-06 09:23:09'),(7630,'d0dbxpp05','','10.218.154.246',31,31,31,5,2,0,0,0,NULL,0,0,'dbadmin','2018-03-08 18:35:50','','2018-09-25 14:14:51'),(7730,'d0dbxpp06','','10.218.154.247',31,31,31,6,2,0,0,0,NULL,0,0,'dbadmin','2018-03-08 18:36:13','dbadmin','2018-03-08 18:36:54'),(7810,'d0dbadminp01','Monitoring','10.218.154.214:3307',31,31,910,1,2,0,0,0,NULL,0,0,'dbadmin','2018-03-13 10:09:01',NULL,NULL),(7910,'d1dbadminp01','Monitoring','10.218.175.234:3307',31,131,910,1,2,0,0,0,NULL,0,0,'dbadmin','2018-03-13 10:09:45','dbadmin','2018-03-14 10:49:05'),(8010,'d2dbadminp01','Monitoring','10.220.239.200:3307',31,231,910,1,2,0,0,0,NULL,0,0,'dbadmin','2018-03-13 10:10:09','dbadmin','2018-03-14 10:49:08'),(8110,'d0gcxpd01','','10.218.155.76',231,31,820,4,2,1,0,0,NULL,0,0,'dbadmin','2018-03-22 10:07:57',NULL,NULL),(8210,'d0gcxpd02','','10.218.155.77',231,31,820,5,2,1,0,0,NULL,0,0,'dbadmin','2018-03-22 10:08:21',NULL,NULL),(8310,'d0gcxpd03','','10.218.155.73',231,31,820,6,2,1,0,0,NULL,0,0,'dbadmin','2018-03-22 10:08:46',NULL,NULL),(8410,'d0gcmyd01','','10.218.155.74',231,31,820,1,2,1,0,0,NULL,0,0,'dbadmin','2018-03-22 10:38:13',NULL,NULL),(8610,'d1dbxpp05','','10.218.175.230',31,131,31,5,2,0,0,0,NULL,0,0,'dbadmin','2018-04-16 14:53:51','dbadmin','2018-04-16 14:54:53'),(8710,'d1dbxpp06','','10.218.175.233',31,131,31,6,2,0,0,0,NULL,0,0,'dbadmin','2018-04-16 14:54:20','dbadmin','2018-04-16 14:54:54'),(9311,'d0dbadminq01','','10.218.153.237',131,31,531,1,2,1,0,0,NULL,0,0,'dbadmin','2018-08-15 07:36:00','dbadmin','2018-08-15 07:56:50'),(9511,'d0dbadminq01','dbmonitor','10.218.153.237:3307',131,31,910,1,2,0,0,0,NULL,0,0,'dbadmin','2018-08-15 13:32:58',NULL,NULL),(9610,'d0dbpatchq01','','10.218.153.234',131,31,531,1,2,1,0,0,NULL,0,0,'dbadmin','2018-09-11 09:26:41','dbadmin','2018-09-13 12:20:05'),(9710,'d0dbpatchq02','','10.218.153.235',131,31,531,2,2,1,0,0,NULL,0,0,'dbadmin','2018-09-11 09:27:23',NULL,NULL);
/*!40000 ALTER TABLE `servers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-06  6:11:11
