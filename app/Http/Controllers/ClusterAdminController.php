<?php

namespace App\Http\Controllers;

use App\Models\Cluster;
use Illuminate\Http\Request;

class ClusterAdminController extends Controller
{
    public function clusters()
    {
        $rows = Cluster::orderBy('view_order')->get();

        return view('admin.clusters', array("clusters" => $rows));
    }

    public function addCluster()
    {
        $rows = Cluster::orderBy('view_order')->get();

        $clusters = array("0" => "-- None --");

        foreach ($rows as $row) {
            $clusters[$row->cluster_id] = $row->name;
        }

        return view('admin.cluster.add', array("clusters" => json_encode($clusters)));
    }

    public function updateCluster($cluster_id)
    {
        $cluster = Cluster::where("cluster_id", $cluster_id)->get()[0];

        $clusters = array("0" => "-- None --");

        $rows = Cluster::orderBy('view_order')->get();

        foreach ($rows as $row) {
            $clusters[$row->cluster_id] = $row->name;
        }

        return view('admin.cluster.edit', array("cluster" => $cluster, "clusters" => json_encode($clusters)));
    }

    public function deleteCluster($cluster_id)
    {
        $cluster = Cluster::where("cluster_id", $cluster_id)->get()[0];

        return view('admin.cluster.delete', array("cluster" => $cluster));
    }

    public function performAddCluster(Request $request)
    {
        $name = $request->input('name');
        $viewOrder = $request->input('view_order');
        $parentClusterId = $request->input('parent_cluster');

        $cluster = new Cluster();

        $cluster->name = $name;
        $cluster->view_order = $viewOrder;
        $cluster->parent_cluster_id = $parentClusterId;

        try {
            $cluster->save();

            return redirect('/admin/cluster')->with('msg', 'Cluster has been saved successfully');
        } catch (Illuminate\Database\QueryException $ex) {
            return back()->withInput()->with('error', $ex->getMessage());
        } catch (\PDOException $pdoEx) {
            return back()->withInput()->with('error', $pdoEx->getMessage());
        }

    }

    public function performUpdateCluster(Request $request)
    {
        $cluster_id = $request->input('cluster_id');

        $name = $request->input('name');
        $viewOrder = $request->input('view_order');
        $parentClusterId = $request->input('parent_cluster');

        $cluster = Cluster::find($cluster_id);

        $cluster->name = $name;
        $cluster->view_order = $viewOrder;
        $cluster->parent_cluster_id = $parentClusterId;

        try {
            $cluster->save();

            return redirect('/admin/cluster')->with('msg', 'Cluster has been saved successfully');
        } catch (Illuminate\Database\QueryException $ex) {
            return back()->withInput()->with('error', $ex->getMessage());
        } catch (\PDOException $pdoEx) {
            return back()->withInput()->with('error', $pdoEx->getMessage());
        }

    }

    public function performDeleteCluster(Request $request)
    {
        $cluster_id = $request->input('cluster_id');

        $cluster = Cluster::find($cluster_id);

        try {
            $cluster->delete();

            return redirect('/admin/cluster')->with('msg', 'Cluster has been deleted successfully');
        } catch (Illuminate\Database\QueryException $ex) {
            return back()->withInput()->with('error', $ex->getMessage());
        } catch (\PDOException $pdoEx) {
            return back()->withInput()->with('error', $pdoEx->getMessage());
        }

    }
}
