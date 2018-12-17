<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cluster;
use App\Models\Datacenter;
use App\Models\Environment;
use App\Models\Server;

class DatacenterDetailController extends Controller
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
    public function index($environmentId, $datacenterId)
    {
        $env = Environment::find($environmentId);
        $dc = Datacenter::find($datacenterId);
        
        $clusters = Cluster::orderBy('view_order')->get();

        return view('dcdetail', array("environment" => $env, "datacenter" => $dc, "clusters" => $clusters));
    }
}
