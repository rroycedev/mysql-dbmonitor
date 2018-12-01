<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function servers()
    {
        $rows = DB::table('database_server')->select('database_server.hostname', 'database_server.srv_id', 
                                                    'database_server.port_name', 'environment_lookup.name as envname', 'datacenter_lookup.name as dcname',
                                                    'cluster_lookup.name as clustername')->join('environment_lookup', 
                                                    'environment_lookup.environment_id', '=', 'database_server.environment_id')->join(
                                                        'datacenter_lookup', 'datacenter_lookup.datacenter_id', '=', 'database_server.datacenter_id')->join(
                                                            'cluster_lookup', 'cluster_lookup.cluster_id', '=', 'database_server.cluster_id')->orderBy('environment_lookup.view_order')->orderBy('datacenter_lookup.view_order'
                                                            )->
                                                            orderBy('cluster_lookup.view_order')->orderBy('database_server.hostname')->get();

        return view('admin.server', array("servers" => $rows));
    }

    public function environments()
    {
        $rows = DB::table('environment_lookup')->orderBy('view_order')->get();

        return view('admin.environments', array("environments" => $rows));
    }

    public function datacenters()
    {
        $rows = DB::table('datacenter_lookup')->orderBy('view_order')->get();

        return view('admin.datacenters', array("datacenters" => $rows));
    }

    public function clusters()
    {
        $rows = DB::table('cluster_lookup')->orderBy('view_order')->get();

        return view('admin.clusters', array("clusters" => $rows));
    }

    public function addserver()
    {
        $rows = DB::table('environment_lookup')->orderBy('view_order')->get();

        $envs = array();

        foreach ($rows as $row) {
            $envs[$row->environment_id] = $row->name;
        }

        $rows = DB::table('datacenter_lookup')->orderBy('view_order')->get();

        $dcs = array();

        foreach ($rows as $row) {
            $dcs[$row->datacenter_id] = $row->name;
        }

        $rows = DB::table('cluster_lookup')->orderBy('view_order')->get();

        $clusters = array();

        foreach ($rows as $row) {
            $clusters[$row->cluster_id] = $row->name;
        }

        return view('admin.server.add', array("environments" => json_encode($envs), "datacenters" => json_encode($dcs), "clusters" => json_encode($clusters)));
    }    

    public function performAddServer(Request $request)  
    {

    }
}
