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
Route::get('/admin/monitor', 'AdminController@monitor');

Route::get('/admin/clusters', 'AdminController@clusters');
Route::get('/admin/datacenters', 'AdminController@datacenters');
Route::view('/admin/aliases', 'admin.aliases');
Route::view('/admin/alerts', 'admin.alerts');
Route::view('/admin/dataintegrity', 'admin.dataintegrity');
Route::view('/admin/dbcompare', 'admin.dbcompare');

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
