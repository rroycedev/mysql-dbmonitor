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
INSERT INTO `cpu_load_alerts` VALUES (31,1.00,5.00);
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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('ruhruhroy@gmail.com','$2y$10$QbrXACAFDk9YbU4d6gTe6OGI.9WXcPYC3EIWCxL7Ik8oRzyUfHlqu','2018-12-13 02:28:42');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
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
-- Table structure for table `server_slaves_status`
--

DROP TABLE IF EXISTS `server_slaves_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `server_slaves_status` (
  `server_slave_status_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `server_id` bigint(20) unsigned NOT NULL,
  `connection_name` varchar(60) NOT NULL,
  `master_binlog_position` bigint(20) unsigned NOT NULL,
  `master_binlog_filename` varchar(100) NOT NULL,
  `lag_time_secs` bigint(20) unsigned NOT NULL DEFAULT '0',
  `check_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`server_slave_status_id`),
  UNIQUE KEY `idx_server_id_connection_name` (`server_id`,`connection_name`),
  CONSTRAINT `fk_server_id` FOREIGN KEY (`server_id`) REFERENCES `servers` (`server_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `server_slaves_status`
--

LOCK TABLES `server_slaves_status` WRITE;
/*!40000 ALTER TABLE `server_slaves_status` DISABLE KEYS */;
INSERT INTO `server_slaves_status` VALUES (1,9711,'dbserver2',21747,'dbserver2-bin.000003',5,'2018-12-06 17:24:08'),(2,9712,'dbserver1',21717,'dbserver1-bin.000008',5,'2018-12-06 17:24:56'),(3,9711,'dbserver3',3333,'dbserver3-bin.000004',0,'2018-12-07 08:42:34');
/*!40000 ALTER TABLE `server_slaves_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `server_status`
--

DROP TABLE IF EXISTS `server_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `server_status` (
  `server_status_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `server_id` bigint(20) unsigned NOT NULL,
  `connection_count` int(10) unsigned NOT NULL,
  `cpu_load` decimal(10,2) unsigned NOT NULL,
  `disk_info` text NOT NULL,
  `check_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`server_status_id`),
  UNIQUE KEY `server_id` (`server_id`),
  CONSTRAINT `fk_server_status_server_id` FOREIGN KEY (`server_id`) REFERENCES `servers` (`server_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `server_status`
--

LOCK TABLES `server_status` WRITE;
/*!40000 ALTER TABLE `server_status` DISABLE KEYS */;
INSERT INTO `server_status` VALUES (1,9711,39,3.45,'[{\"volume\":\"/opt/mysql/data\",\"space_used\":\"600GB\",\"space_available\":\"424GB\",\"total_space\":\"1024GB\",\"percent_used\":66,\"percent_free\":34},{\"volume\":\"/opt/mysql/tmp\",\"space_used\":\"10GB\",\"space_available\":\"20GB\",\"total_space\":\"30GB\",\"percent_used\":34,\"percent_free\":66}]','2018-12-08 09:24:50'),(2,9712,39,3.45,'[{\"volume\":\"/opt/mysql/data\",\"space_used\":\"600GB\",\"space_available\":\"424GB\",\"total_space\":\"1024GB\",\"percent_used\":66,\"percent_free\":34},{\"volume\":\"/opt/mysql/tmp\",\"space_used\":\"10GB\",\"space_available\":\"20GB\",\"total_space\":\"30GB\",\"percent_used\":34,\"percent_free\":66}]','2018-12-08 09:25:18');
/*!40000 ALTER TABLE `server_status` ENABLE KEYS */;
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
  `ipaddress` varchar(64) NOT NULL,
  `environment_id` bigint(20) unsigned NOT NULL,
  `datacenter_id` bigint(20) unsigned NOT NULL,
  `cluster_id` bigint(20) unsigned NOT NULL,
  `view_order` int(11) NOT NULL DEFAULT '1' COMMENT 'Order to display in front-end.  Values start at 1',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `exclude_noc` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT 'Values are 0 or 1',
  `exclude_disk_check` tinyint(4) NOT NULL DEFAULT '0',
  `maint_mode` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT 'Values are 0 or 1',
  `maint_mode_start_date` datetime DEFAULT NULL,
  PRIMARY KEY (`server_id`),
  UNIQUE KEY `hostname_port_name` (`hostname`,`port_name`),
  UNIQUE KEY `srv_id` (`ipaddress`),
  KEY `fk_environment_id` (`environment_id`),
  KEY `fk_datacenter_id` (`datacenter_id`),
  KEY `fk_cluster_id` (`cluster_id`),
  CONSTRAINT `fk_cluster_id` FOREIGN KEY (`cluster_id`) REFERENCES `clusters` (`cluster_id`),
  CONSTRAINT `fk_datacenter_id` FOREIGN KEY (`datacenter_id`) REFERENCES `datacenters` (`datacenter_id`),
  CONSTRAINT `fk_environment_id` FOREIGN KEY (`environment_id`) REFERENCES `environments` (`environment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9720 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPRESSED;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servers`
--

LOCK TABLES `servers` WRITE;
/*!40000 ALTER TABLE `servers` DISABLE KEYS */;
INSERT INTO `servers` VALUES (9711,'dbserver1','','10.0.0.29',31,31,31,1,0,0,0,0,NULL),(9712,'dbserver2','','10.0.0.31',31,31,31,1,1,0,0,0,NULL),(9713,'dbserver3','','10.0.0.31:3307',31,31,31,1,1,0,0,0,NULL),(9714,'dbserver4','','10.0.0.4',31,31,31,1,0,0,0,0,NULL),(9715,'dbserver5','','10.0.0.5',31,31,31,1,1,0,0,0,NULL),(9716,'dbserver6','','10.0.0.6',31,31,31,1,1,0,0,0,NULL),(9717,'dbserver7','','10.0.0.7',31,31,31,1,2,0,0,0,NULL),(9718,'dbserver8','','10.0.0.8',31,31,31,1,2,0,0,0,NULL),(9719,'dbserver9','','10.0.0.9',31,31,31,1,2,0,0,0,NULL);
/*!40000 ALTER TABLE `servers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Ron Royce','ruhruhroy@gmail.com','$2y$10$yCofxQ2Lh6z8mF.RIpkzMe2qpEwnX0okNJJw7sQW0okIwSTHf4zoa','NBvTgYVfv6FH1MS4WvlxswSc9oKzjzmgY9Sk7Wg6AHtKLtc9mAuXstYybtC4','2018-12-13 00:12:04','2018-12-13 00:12:04');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-12 16:50:38
