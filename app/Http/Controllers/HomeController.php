<?php

namespace App\Http\Controllers;

use App\Models\Cluster;
use App\Models\Datacenter;
use App\Models\Environment;
use App\Models\Server;

class HomeController extends Controller
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
    public function index()
    {
        $envs = Environment::orderBy('view_order')->get();
        $dcs = Datacenter::orderBy('view_order')->get();
        $clusters = Cluster::orderBy('view_order')->get();

        return view('home', array("environments" => json_encode($envs), "datacenters" => json_encode($dcs), "clusters" => json_encode($clusters)));
    }
}
