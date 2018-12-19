DROP TABLE IF EXISTS `clusters`;

CREATE TABLE `clusters` (
  `cluster_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `parent_cluster_id` bigint(20) unsigned NOT NULL,
  `view_order` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`cluster_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPRESSED;

INSERT INTO `clusters` VALUES (31,'XP',0,1),(131,'Infrastructure',0,3),(231,'Person Monitor',0,4),(331,'Tools',0,6),(431,'Reporting',0,5),(531,'Database Admin',31,7),(731,'Transaction',31,2),(820,'Galera',0,9),(910,'Monitoring',0,8);

--
-- Table structure for table `cpu_load_alerts`
--

DROP TABLE IF EXISTS `cpu_load_alerts`;

CREATE TABLE `cpu_load_alerts` (
  `server_id` bigint(20) unsigned NOT NULL,
  `warning_level` decimal(10,2) NOT NULL,
  `error_level` decimal(10,2) NOT NULL,
  PRIMARY KEY (`server_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `cpu_load_alerts` VALUES (31,1.00,5.00);

--
-- Table structure for table `datacenters`
--

DROP TABLE IF EXISTS `datacenters`;

CREATE TABLE `datacenters` (
  `datacenter_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `view_order` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`datacenter_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPRESSED;

INSERT INTO `datacenters` VALUES (31,'D0',1),(131,'D1',2),(231,'D2',3);

--
-- Table structure for table `disk_alerts`
--

DROP TABLE IF EXISTS `disk_alerts`;

CREATE TABLE `disk_alerts` (
  `alert_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `server_id` bigint(20) unsigned NOT NULL,
  `volume` varchar(100) NOT NULL,
  `warning_level_pct` int(10) unsigned NOT NULL,
  `error_level_pct` int(10) unsigned NOT NULL,
  PRIMARY KEY (`alert_id`),
  UNIQUE KEY `server_id_volumne` (`server_id`,`volume`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `disk_alerts` VALUES (1,31,'/opt/mysql/data',60,70),(2,31,'/opt/logs',40,60),(3,7810,'/opt',22,33);

--
-- Table structure for table `dns_aliases`
--

DROP TABLE IF EXISTS `dns_aliases`;

CREATE TABLE `dns_aliases` (
  `alias_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `is_vip` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `vip_port` int(10) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`alias_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `dns_aliases` VALUES (3,'d0dbrep-sq01.trads.us',1,1234,1),(4,'d0dbinfra-sq01.trads.us',0,0,0),(5,'d0dbinfra-sq01.trads.usasfafafafafafaf.fsfsf.dsdssds',0,0,1);

--
-- Table structure for table `environments`
--

DROP TABLE IF EXISTS `environments`;

CREATE TABLE `environments` (
  `environment_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `view_order` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`environment_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPRESSED;

INSERT INTO `environments` VALUES (31,'Production',1),(131,'QA',2),(231,'Development',3),(411,'Backup',5);

--
-- Table structure for table `replication_lag_alerts`
--

DROP TABLE IF EXISTS `replication_lag_alerts`;

CREATE TABLE `replication_lag_alerts` (
  `server_id` bigint(20) unsigned NOT NULL,
  `warning_level_secs` int(10) unsigned NOT NULL,
  `error_level_secs` int(10) unsigned NOT NULL,
  PRIMARY KEY (`server_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `replication_lag_alerts` VALUES (331,60,80),(6911,75,80),(9010,55,66);

--
-- Table structure for table `servers`
--

DROP TABLE IF EXISTS `servers`;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPRESSED;

INSERT INTO `servers` VALUES (9711,'dbserver1','','10.0.0.29',31,31,31,1,0,0,0,0,NULL),(9712,'dbserver2','','10.0.0.31',31,31,31,1,1,0,0,0,NULL),(9713,'dbserver3','','10.0.0.31:3307',31,31,31,1,1,0,0,0,NULL),(9714,'dbserver4','','10.0.0.4',31,31,31,1,0,0,0,0,NULL),(9715,'dbserver5','','10.0.0.5',31,31,31,1,1,0,0,0,NULL),(9716,'dbserver6','','10.0.0.6',31,31,31,1,1,0,0,0,NULL),(9717,'dbserver7','','10.0.0.7',31,31,31,1,2,0,0,0,NULL),(9718,'dbserver8','','10.0.0.8',31,31,31,1,2,0,0,0,NULL),(9719,'dbserver9','','10.0.0.9',31,31,31,1,2,0,0,0,NULL);


--
-- Table structure for table `server_slaves_status`
--

DROP TABLE IF EXISTS `server_slaves_status`;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `server_slaves_status` VALUES (1,9711,'dbserver2',21747,'dbserver2-bin.000003',5,'2018-12-06 17:24:08'),(2,9712,'dbserver1',21717,'dbserver1-bin.000008',5,'2018-12-06 17:24:56'),(3,9711,'dbserver3',3333,'dbserver3-bin.000004',0,'2018-12-07 08:42:34');

--
-- Table structure for table `server_status`
--

DROP TABLE IF EXISTS `server_status`;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `server_status` VALUES (1,9711,39,3.45,'[{\"volume\":\"/opt/mysql/data\",\"space_used\":\"600GB\",\"space_available\":\"424GB\",\"total_space\":\"1024GB\",\"percent_used\":66,\"percent_free\":34},{\"volume\":\"/opt/mysql/tmp\",\"space_used\":\"10GB\",\"space_available\":\"20GB\",\"total_space\":\"30GB\",\"percent_used\":34,\"percent_free\":66}]','2018-12-08 09:24:50'),(2,9712,39,3.45,'[{\"volume\":\"/opt/mysql/data\",\"space_used\":\"600GB\",\"space_available\":\"424GB\",\"total_space\":\"1024GB\",\"percent_used\":66,\"percent_free\":34},{\"volume\":\"/opt/mysql/tmp\",\"space_used\":\"10GB\",\"space_available\":\"20GB\",\"total_space\":\"30GB\",\"percent_used\":34,\"percent_free\":66}]','2018-12-08 09:25:18');



