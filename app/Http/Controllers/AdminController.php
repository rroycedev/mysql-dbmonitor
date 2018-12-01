<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function servers()
    {
        $rows = DB::table('servers')->select('servers.hostname', 'servers.srv_id',
            'servers.port_name', 'environments.name as envname', 'datacenters.name as dcname',
            'clusters.name as clustername')->join('environments',
            'environments.environment_id', '=', 'servers.environment_id')->join(
            'datacenters', 'datacenters.datacenter_id', '=', 'servers.datacenter_id')->join(
            'clusters', 'clusters.cluster_id', '=', 'servers.cluster_id')->orderBy('environments.view_order')->orderBy('datacenters.view_order'
        )->
            orderBy('clusters.view_order')->orderBy('servers.hostname')->get();

        return view('admin.server', array("servers" => $rows));
    }

    public function environments()
    {
        $rows = DB::table('environments')->orderBy('view_order')->get();

        return view('admin.environments', array("environments" => $rows));
    }

    public function datacenters()
    {
        $rows = DB::table('datacenters')->orderBy('view_order')->get();

        return view('admin.datacenters', array("datacenters" => $rows));
    }

    public function clusters()
    {
        $rows = DB::table('clusters')->orderBy('view_order')->get();

        return view('admin.clusters', array("clusters" => $rows));
    }

    public function addserver()
    {
        $rows = DB::table('environments')->orderBy('view_order')->get();

        $envs = array();

        foreach ($rows as $row) {
            $envs[$row->environment_id] = $row->name;
        }

        $rows = DB::table('datacenters')->orderBy('view_order')->get();

        $dcs = array();

        foreach ($rows as $row) {
            $dcs[$row->datacenter_id] = $row->name;
        }

        $rows = DB::table('clusters')->orderBy('view_order')->get();

        $clusters = array();

        foreach ($rows as $row) {
            $clusters[$row->cluster_id] = $row->name;
        }

        return view('admin.server.add', array("environments" => json_encode($envs), "datacenters" => json_encode($dcs), "clusters" => json_encode($clusters)));
    }

    public function performAddServer(Request $request)
    {
        $hostname = $request->input('hostname');
        $ipAddress = $request->input('ipaddress');
        $portName = $request->input('portname');
        $environmentId = $request->input('environment');
        $datacenterId = $request->input('datacenter');
        $clusterId = $request->input('cluster');
        $active = $request->input('active');
        $excludeNoc = $request->input('excludenoc');
        $excludeDiskCheck = $request->input('excludediskcheck');

    }
}
