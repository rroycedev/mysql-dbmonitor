<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Routes for this site
 *
 * PHP version 7
 *
 * @category  Database
 * @package   MySQLDbmonitor
 * @author    Ronald Royce <rroycedev@gmail.com>
 * @copyright 2018 Ronald Royce
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      http://www.rroycedev.com/
 **/

Route::view(
    '/',
    'monitor'
);

Route::get(
    '/monitor',
    'MonitorController@index'
);

Route::view(
    '/reports/dataintegrity',
    'reports.dataintegrity'
);

Route::view(
    '/reports/dbcompare',
    'reports.dbcompare'
);

// Server Admin

Route::get(
    '/admin/server',
    'ServerAdminController@servers'
);

Route::get(
    '/admin/server/add',
    'ServerAdminController@addServer'
);

Route::get(
    '/admin/server/edit/{server_id}',
    'ServerAdminController@updateServer'
);

Route::get(
    '/admin/server/delete/{server_id}',
    'ServerAdminController@deleteServer'
);

Route::post(
    '/admin/server/performaddserver',
    'ServerAdminController@performAddServer'
);

Route::post(
    '/admin/server/performupdateserver',
    'ServerAdminController@performUpdateServer'
);

Route::post(
    '/admin/server/performdeleteserver',
    'ServerAdminController@performDeleteServer'
);

//  Environment Admin

Route::get(
    '/admin/environment',
    'EnvironmentAdminController@environments'
);

Route::get(
    '/admin/environment/add',
    'EnvironmentAdminController@addEnvironment'
);

Route::get(
    '/admin/environment/edit/{environment_id}',
    'EnvironmentAdminController@updateEnvironment'
);

Route::get(
    '/admin/environment/delete/{environment_id}',
    'EnvironmentAdminController@deleteEnvironment'
);

Route::post(
    '/admin/environment/performaddenvironment',
    'EnvironmentAdminController@performAddEnvironment'
);

Route::post(
    '/admin/environment/performupdateenvironment',
    'EnvironmentAdminController@performUpdateEnvironment'
);

Route::post(
    '/admin/environment/performdeleteenvironment',
    'EnvironmentAdminController@performDeleteEnvironment'
);

//  Datacenter Admin

Route::get(
    '/admin/datacenter',
    'DatacenterAdminController@datacenters'
);

Route::get(
    '/admin/datacenter/add',
    'DatacenterAdminController@addDatacenter'
);

Route::get(
    '/admin/datacenter/edit/{datacenter_id}',
    'DatacenterAdminController@updateDatacenter'
);

Route::get(
    '/admin/datacenter/delete/{datacenter_id}',
    'DatacenterAdminController@deleteDatacenter'
);

Route::post(
    '/admin/datacenter/performadddatacenter',
    'DatacenterAdminController@performAddDatacenter'
);

Route::post(
    '/admin/datacenter/performupdatedatacenter',
    'DatacenterAdminController@performUpdateDatacenter'
);

Route::post(
    '/admin/datacenter/performdeletedatacenter',
    'DatacenterAdminController@performDeleteDatacenter'
);

//  Cluster Admin

Route::get(
    '/admin/cluster',
    'ClusterAdminController@clusters'
);

Route::get(
    '/admin/cluster/add',
    'ClusterAdminController@addCluster'
);

Route::get(
    '/admin/cluster/edit/{cluster_id}',
    'ClusterAdminController@updateCluster'
);

Route::get(
    '/admin/cluster/delete/{cluster_id}',
    'ClusterAdminController@deleteCluster'
);

Route::post(
    '/admin/cluster/performaddcluster',
    'ClusterAdminController@performAddCluster'
);

Route::post(
    '/admin/cluster/performupdatecluster',
    'ClusterAdminController@performUpdateCluster'
);

Route::post(
    '/admin/cluster/performdeletecluster',
    'ClusterAdminController@performDeleteCluster'
);

//  DNS Aliases Admin

Route::get(
    '/admin/dnsalias',
    'DNSAliasAdminController@dnsaliases'
);

Route::get(
    '/admin/dnsalias/add',
    'DNSAliasAdminController@addDNSAlias'
);

Route::get(
    '/admin/dnsalias/edit/{alias_id}',
    'DNSAliasAdminController@updateDNSAlias'
);

Route::get(
    '/admin/dnsalias/delete/{alias_id}',
    'DNSAliasAdminController@deleteDNSAlias'
);

Route::post(
    '/admin/dnsalias/performadddnsalias',
    'DNSAliasAdminController@performAddDNSAlias'
);

Route::post(
    '/admin/dnsalias/performupdatednsalias',
    'DNSAliasAdminController@performUpdateDNSAlias'
);

Route::post(
    '/admin/dnsalias/performdeletednsalias',
    'DNSAliasAdminController@performDeleteDNSAlias'
);

// Replication Lag Alerts Admin

Route::get(
    '/admin/alert/repllag',
    'ReplicationLagAlertAdminController@alerts'
);

Route::get(
    '/admin/alert/repllag/add',
    'ReplicationLagAlertAdminController@add'
);

Route::get(
    '/admin/alert/repllag/edit/{server_id}',
    'ReplicationLagAlertAdminController@update'
);

Route::get(
    '/admin/alert/repllag/delete/{server_id}',
    'ReplicationLagAlertAdminController@delete'
);

Route::post(
    '/admin/alert/repllag/performadd',
    'ReplicationLagAlertAdminController@performAdd'
);

Route::post(
    '/admin/alert/repllag/performupdate',
    'ReplicationLagAlertAdminController@performUpdate'
);

Route::post(
    '/admin/alert/repllag/performdelete',
    'ReplicationLagAlertAdminController@performDelete'
);

//  Disk Alerts Admin

Route::get(
    '/admin/alert/disk',
    'DiskAlertAdminController@alerts'
);

Route::get(
    '/admin/alert/disk/add',
    'DiskAlertAdminController@add'
);

Route::get(
    '/admin/alert/disk/edit/{alert_id}',
    'DiskAlertAdminController@update'
);

Route::get(
    '/admin/alert/disk/delete/{alert_id}',
    'DiskAlertAdminController@delete'
);

Route::post(
    '/admin/alert/disk/performadd',
    'DiskAlertAdminController@performAdd'
);

Route::post(
    '/admin/alert/disk/performupdate',
    'DiskAlertAdminController@performUpdate'
);

Route::post(
    '/admin/alert/disk/performdelete',
    'DiskAlertAdminController@performDelete'
);

//  CPU Load Alerts Admin

Route::get(
    '/admin/alert/cpuload',
    'CPULoadAlertAdminController@alerts'
);

Route::get(
    '/admin/alert/cpuload/add',
    'CPULoadAlertAdminController@add'
);

Route::get(
    '/admin/alert/cpuload/edit/{alert_id}',
    'CPULoadAlertAdminController@update'
);

Route::get(
    '/admin/alert/cpuload/delete/{alert_id}',
    'CPULoadAlertAdminController@delete'
);

Route::post(
    '/admin/alert/cpuload/performadd',
    'CPULoadAlertAdminController@performAdd'
);

Route::post(
    '/admin/alert/cpuload/performupdate',
    'CPULoadAlertAdminController@performUpdate'
);

Route::post(
    '/admin/alert/cpuload/performdelete',
    'CPULoadAlertAdminController@performDelete'
);

//  API Routes

Route::get(
    '/api/monitoringfilters',
    'RestAPIController@getMonitoringFilters'
);

Route::get(
    '/api/serverstatus',
    'RestAPIController@getServerStatus'
);

Route::get(
    '/api/turnoffmaintenance/{server_id}',
    'RestAPIController@turnOffMaintenance'
);

Route::get(
    '/api/turnonmaintenance/{server_id}',
    'RestAPIController@turnOnMaintenance'
);