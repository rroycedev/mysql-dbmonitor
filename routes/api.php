<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



//  API Routes

Route::get(
     '/monitoringfilters',
     'RestAPIController@getMonitoringFilters'
 );
 
 Route::get(
     '/serverstatus',
     'RestAPIController@getServerStatus'
 );
 
 Route::get(
      '/serverstatus/{serverId}',
      'RestAPIController@getServerStatus'
  );
 
  
 Route::get(
     '/turnoffmaintenance/{server_id}',
     'RestAPIController@turnOffMaintenance'
 );
 
 Route::get(
     '/turnonmaintenance/{server_id}',
     'RestAPIController@turnOnMaintenance'
 );
 
 Route::get(
     '/makeserveractive/{server_id}',
     'RestAPIController@makeServerActive'
 );
 
 Route::get(
     '/makeserverinactive/{server_id}',
     'RestAPIController@makeServerInactive'
 );
 
 Route::get(
      '/getenvironments',
      'RestAPIController@getEnvironments'
 );
 
 Route::get(
      '/getclusters',
      'RestAPIController@getClusters'
 );
 
 Route::get(
      '/getdatacenters',
      'RestAPIController@getDatacenters'
 );
 
 Route::get(
      '/getservers/{environmentId}/{datacenterId}/{clusterId}',
      'RestAPIController@getServers'
 );
 
 Route::get(
      '/getserver/{serverId}',
      'RestAPIController@getServer'
 );
 
 Route::get(
     '/getusers',
     'RestAPIController@getUsers'
);
