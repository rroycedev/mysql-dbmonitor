<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::view('/', 'monitor');
Route::get('/monitor', 'MonitorController@index');


Route::view('/reports/dataintegrity', 'reports.dataintegrity');
Route::view('/reports/dbcompare', 'reports.dbcompare');

// Server Admin

Route::get('/admin/server', 'ServerAdminController@servers');

Route::get('/admin/server/add', 'ServerAdminController@addServer');
Route::get('/admin/server/edit/{server_id}', 'ServerAdminController@updateServer');
Route::get('/admin/server/delete/{server_id}', 'ServerAdminController@deleteServer');

Route::post('/admin/server/performaddserver', 'ServerAdminController@performAddServer');
Route::post('/admin/server/performupdateserver', 'ServerAdminController@performUpdateServer');
Route::post('/admin/server/performdeleteserver', 'ServerAdminController@performDeleteServer');

//  Environment Admin

Route::get('/admin/environment', 'EnvironmentAdminController@environments');

Route::get('/admin/environment/add', 'EnvironmentAdminController@addEnvironment');
Route::get('/admin/environment/edit/{environment_id}', 'EnvironmentAdminController@updateEnvironment');
Route::get('/admin/environment/delete/{environment_id}', 'EnvironmentAdminController@deleteEnvironment');

Route::post('/admin/environment/performaddenvironment', 'EnvironmentAdminController@performAddEnvironment');
Route::post('/admin/environment/performupdateenvironment', 'EnvironmentAdminController@performUpdateEnvironment');
Route::post('/admin/environment/performdeleteenvironment', 'EnvironmentAdminController@performDeleteEnvironment');

//  Datacenter Admin

Route::get('/admin/datacenter', 'DatacenterAdminController@datacenters');

Route::get('/admin/datacenter/add', 'DatacenterAdminController@addDatacenter');
Route::get('/admin/datacenter/edit/{datacenter_id}', 'DatacenterAdminController@updateDatacenter');
Route::get('/admin/datacenter/delete/{datacenter_id}', 'DatacenterAdminController@deleteDatacenter');

Route::post('/admin/datacenter/performadddatacenter', 'DatacenterAdminController@performAddDatacenter');
Route::post('/admin/datacenter/performupdatedatacenter', 'DatacenterAdminController@performUpdateDatacenter');
Route::post('/admin/datacenter/performdeletedatacenter', 'DatacenterAdminController@performDeleteDatacenter');

//  Cluster Admin

Route::get('/admin/cluster', 'ClusterAdminController@clusters');

Route::get('/admin/cluster/add', 'ClusterAdminController@addCluster');
Route::get('/admin/cluster/edit/{cluster_id}', 'ClusterAdminController@updateCluster');
Route::get('/admin/cluster/delete/{cluster_id}', 'ClusterAdminController@deleteCluster');

Route::post('/admin/cluster/performaddcluster', 'ClusterAdminController@performAddCluster');
Route::post('/admin/cluster/performupdatecluster', 'ClusterAdminController@performUpdateCluster');
Route::post('/admin/cluster/performdeletecluster', 'ClusterAdminController@performDeleteCluster');

//  DNS Aliases Admin

Route::get('/admin/dnsalias', 'DNSAliasAdminController@dnsaliases');

Route::get('/admin/dnsalias/add', 'DNSAliasAdminController@addDNSAlias');
Route::get('/admin/dnsalias/edit/{alias_id}', 'DNSAliasAdminController@updateDNSAlias');
Route::get('/admin/dnsalias/delete/{alias_id}', 'DNSAliasAdminController@deleteDNSAlias');

Route::post('/admin/dnsalias/performadddnsalias', 'DNSAliasAdminController@performAddDNSAlias');
Route::post('/admin/dnsalias/performupdatednsalias', 'DNSAliasAdminController@performUpdateDNSAlias');
Route::post('/admin/dnsalias/performdeletednsalias', 'DNSAliasAdminController@performDeleteDNSAlias');

Route::get('/admin/alert/repllag', 'ReplicationLagAlertAdminController@alerts');
Route::get('/admin/alert/repllag/add', 'ReplicationLagAlertAdminController@add');
Route::get('/admin/alert/repllag/edit/{server_id}', 'ReplicationLagAlertAdminController@update');
Route::get('/admin/alert/repllag/delete/{server_id}', 'ReplicationLagAlertAdminController@delete');

Route::post('/admin/alert/repllag/performadd', 'ReplicationLagAlertAdminController@performAdd');
Route::post('/admin/alert/repllag/performupdate', 'ReplicationLagAlertAdminController@performUpdate');
Route::post('/admin/alert/repllag/performdelete', 'ReplicationLagAlertAdminController@performDelete');


Route::get('/admin/alert/disk', 'DiskAlertAdminController@alerts');
Route::get('/admin/alert/disk/add', 'DiskAlertAdminController@add');
Route::get('/admin/alert/disk/edit/{server_id}', 'DiskAlertAdminController@update');
Route::get('/admin/alert/disk/delete/{server_id}', 'DiskAlertAdminController@delete');

Route::post('/admin/alert/disk/performadd', 'DiskAlertAdminController@performAdd');
Route::post('/admin/alert/disk/performupdate', 'DiskAlertAdminController@performUpdate');
Route::post('/admin/alert/disk/performdelete', 'DiskAlertAdminController@performDelete');