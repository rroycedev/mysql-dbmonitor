<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cluster;
use App\Models\Datacenter;
use App\Models\Environment;
use App\Models\Server;

class EnvironmentDetailController extends Controller
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
    public function index($environmentId)
    {
        $env = Environment::find($environmentId);
        
        $dcs = Datacenter::orderBy('view_order')->get();
        $clusters = Cluster::orderBy('view_order')->get();

        return view('envdetail', array("environment" => $env, "datacenters" => $dcs, "clusters" => $clusters));
    }
}
