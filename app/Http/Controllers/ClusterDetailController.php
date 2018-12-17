<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cluster;
use App\Models\Datacenter;
use App\Models\Environment;
use App\Models\Server;

class ClusterDetailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($environmentId, $datacenterId, $clusterId)
    {
        $env = Environment::find($environmentId);
        $dc = Datacenter::find($datacenterId);
        $cluster = Cluster::find($clusterId);

        $servers = Server::where("environment_id", "=", $environmentId, "and")->where("datacenter_id", "=", $datacenterId, "and")->where("cluster_id", "=", $clusterId)->orderBy("hostname")->orderBy("port_name")->get();

        return view('clusterdetail', array("environment" => $env, "datacenter" => $dc, "cluster" => $cluster, "servers" => $servers));
    }
}
