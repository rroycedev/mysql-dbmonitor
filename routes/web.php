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

// Example Routes
Route::view('/', 'monitor');
Route::get('/monitor', 'MonitorController@index');
Route::get('/admin/monitor', 'AdminController@monitor');
Route::get('/admin/server', 'AdminController@servers');
Route::get('/admin/server/add', 'AdminController@addserver');
Route::get('/admin/environments', 'AdminController@environments');
Route::get('/admin/clusters', 'AdminController@clusters');
Route::get('/admin/datacenters', 'AdminController@datacenters');
Route::view('/admin/aliases', 'admin.aliases');
Route::view('/admin/alerts', 'admin.alerts');
Route::view('/admin/dataintegrity', 'admin.dataintegrity');
Route::view('/admin/dbcompare', 'admin.dbcompare');

Route::post('/admin/server/performaddserver', 'AdminController@performAddServer');
