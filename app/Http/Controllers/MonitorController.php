<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonitorController extends Controller
{
    public function index()
    {
        $rows = DB::table('database_server')->get();

        return view('monitor', array("servers" => $rows));
    }
}
