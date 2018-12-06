<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Controller
 *
 * PHP version 7
 *
 * @category  File
 * @package   MySQLDbmonitor
 * @author    Ronald Royce <rroycedev@gmail.com>
 * @copyright 2018 Ronald Royce
 * @license   GPL http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link      http://www.rroycedev.com/
 **/

namespace App\Http\Controllers;

use App\Models\Cluster;
use App\Models\Datacenter;
use App\Models\Environment;
use App\Models\Server;
use Illuminate\Http\Request;

class ServerAdminController extends Controller
{
    public function servers()
    {
        $rows = Server::with('cluster')->with('datacenter')->with('environment')->orderBy('hostname')->get();

        return view('admin.server', array("servers" => $rows));
    }

    public function addServer()
    {
        $rows = Environment::orderBy('view_order')->get();

        $envs = array();

        foreach ($rows as $row) {
            $envs[$row->environment_id] = $row->name;
        }

        $rows = Datacenter::orderBy('view_order')->get();

        $dcs = array();

        foreach ($rows as $row) {
            $dcs[$row->datacenter_id] = $row->name;
        }

        $rows = Cluster::orderBy('view_order')->get();

        $clusters = array();

        foreach ($rows as $row) {
            $clusters[$row->cluster_id] = $row->name;
        }

        return view('admin.server.add', array("environments" => json_encode($envs), "datacenters" => json_encode($dcs), "clusters" => json_encode($clusters)));
    }

    public function updateServer($server_id)
    {
        $server = Server::where("server_id", $server_id)->get();

        $rows = Environment::orderBy('view_order')->get();

        $envs = array();

        foreach ($rows as $row) {
            $envs[$row->environment_id] = $row->name;
        }

        $rows = Datacenter::orderBy('view_order')->get();

        $dcs = array();

        foreach ($rows as $row) {
            $dcs[$row->datacenter_id] = $row->name;
        }

        $rows = Cluster::orderBy('view_order')->get();

        $clusters = array();

        foreach ($rows as $row) {
            $clusters[$row->cluster_id] = $row->name;
        }

        return view('admin.server.edit', array("server" => $server[0], "environments" => json_encode($envs), "datacenters" => json_encode($dcs), "clusters" => json_encode($clusters)));
    }

    public function deleteServer($server_id)
    {
        $server = Server::where("server_id", $server_id)->get();

        return view('admin.server.delete', array("server" => $server[0]));
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

        $server = new Server();

        $server->hostname = $hostname;
        $server->ipaddress = $ipAddress;
        $server->port_name = $portName;
        $server->environment_id = $environmentId;
        $server->datacenter_id = $datacenterId;
        $server->cluster_id = $clusterId;
        $server->active = $active;
        $server->exclude_noc = $excludeNoc;
        $server->exclude_disk_check = $excludeDiskCheck;

        try {
            $server->save();

            return redirect('/admin/server')->with('msg', 'Server has been saved successfully');
        } catch (Illuminate\Database\QueryException $ex) {
            return back()->withInput()->with('error', $ex->getMessage());
        } catch (\PDOException $pdoEx) {
            return back()->withInput()->with('error', $pdoEx->getMessage());
        }

    }

    public function performUpdateServer(Request $request)
    {
        $serverId = $request->input('server_id');

        $hostname = $request->input('hostname');
        $ipAddress = $request->input('ipaddress');
        $portName = $request->input('portname');
        $environmentId = $request->input('environment');
        $datacenterId = $request->input('datacenter');
        $clusterId = $request->input('cluster');
        $active = $request->input('active');
        $excludeNoc = $request->input('excludenoc');
        $excludeDiskCheck = $request->input('excludediskcheck');

        $server = Server::find($serverId);

        $server->hostname = $hostname;
        $server->ipaddress = $ipAddress;
        $server->port_name = $portName;
        $server->environment_id = $environmentId;
        $server->datacenter_id = $datacenterId;
        $server->cluster_id = $clusterId;
        $server->active = $active;
        $server->exclude_noc = $excludeNoc;
        $server->exclude_disk_check = $excludeDiskCheck;

        try {
            $server->save();

            return redirect('/admin/server')->with('msg', 'Server has been saved successfully');
        } catch (Illuminate\Database\QueryException $ex) {
            return back()->withInput()->with('error', $ex->getMessage());
        } catch (\PDOException $pdoEx) {
            return back()->withInput()->with('error', $pdoEx->getMessage());
        }

    }

    public function performDeleteServer(Request $request)
    {
        $serverId = $request->input('server_id');

        $server = Server::find($serverId);

        try {
            $server->delete();

            return redirect('/admin/server')->with('msg', 'Server has been deleted successfully');
        } catch (Illuminate\Database\QueryException $ex) {
            return back()->withInput()->with('error', $ex->getMessage());
        } catch (\PDOException $pdoEx) {
            return back()->withInput()->with('error', $pdoEx->getMessage());
        }

    }
}
