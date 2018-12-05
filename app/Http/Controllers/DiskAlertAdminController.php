<?php

namespace App\Http\Controllers;

use App\Models\DiskAlert;
use App\Models\Server;
use Illuminate\Http\Request;

class DiskAlertAdminController extends Controller
{
    public function alerts()
    {
        $rows = DiskAlert::join(
                                        'servers',
                                        'disk_alerts.server_id',
                                        '=',
                                        'servers.server_id')->orderBy('servers.hostname')->get();


        $servers = array();
        $serversFound = array();

        foreach ($rows as $row) {
            if (!array_key_exists($row->hostname, $serversFound)) {
                $serversFound[$row->hostname] = 1;

                $servers[] = array("hostname" => $row->hostname);
            }
        }
        return view('admin.alert.disk', array("servers" => $servers));
    }

    public function add()
    {
        $rows = Server::with('cluster')->with('datacenter')->with('environment')->orderBy('hostname')->get();

        $servers = array();

        foreach ($rows as $row) {
            if ($row->port_name != "") {
                $servers[$row->server_id] = $row->hostname . ":" . $row->port_name;
            }
            else {
                $servers[$row->server_id] = $row->hostname;
            }
        }

        return view('admin.alert.repllag.add', array("servers" => json_encode($servers)));
    }

    public function update($server_id)
    {
        $rows = DiskAlert::join(
            'servers',
            'replication_lag_alerts.server_id',
            '=',
            'servers.server_id')->where("replication_lag_alerts.server_id", "=", $server_id)->orderBy('servers.hostname')->get();


        return view('admin.alert.repllag.edit', array("alert" => $rows[0]));
    }

    public function delete($server_id)
    {
        $alerts = DiskAlert::where("server_id", $server_id)->get();

        return view('admin.alert.repllag.delete', array("alert" => $alerts[0]));
    }

    public function performAdd(Request $request)
    {
        $serverId = $request->input('server');

        $warningLevel = $request->input('warning_level_secs');
        $errorLevel = $request->input('error_level_secs');

        $alert = new DiskAlert();

        $alert->server_id = $serverId;
        $alert->warning_level_secs = $warningLevel;
        $alert->error_level_secs = $errorLevel;        

        try {
            $alert->save();

            return redirect('/admin/alert/repllag')->with('msg', 'Alert has been saved successfully');
        } catch (Illuminate\Database\QueryException $ex) {
            return back()->withInput()->with('error', $ex->getMessage());
        } catch (\PDOException $pdoEx) {
            return back()->withInput()->with('error', $pdoEx->getMessage());
        }


    }

    public function performUpdate(Request $request)
    {
        $serverId = $request->input('server_id');

        $warningLevel = $request->input('warning_level_secs');
        $errorLevel = $request->input('error_level_secs');

        $alert = DiskAlert::find($serverId);

        $alert->warning_level_secs = $warningLevel;
        $alert->error_level_secs = $errorLevel;        

        try {
            $alert->save();

            return redirect('/admin/alert/repllag')->with('msg', 'Alert has been saved successfully');
        } catch (Illuminate\Database\QueryException $ex) {
            return back()->withInput()->with('error', $ex->getMessage());
        } catch (\PDOException $pdoEx) {
            return back()->withInput()->with('error', $pdoEx->getMessage());
        }

    }

    public function performDelete(Request $request)
    {
        $serverId = $request->input('server_id');

        $alert = DiskAlert::find($serverId);

        try {
            $alert->delete();

            return redirect('/admin/alert/repllag')->with('msg', 'Alert has been deleted successfully');
        } catch (Illuminate\Database\QueryException $ex) {
            return back()->withInput()->with('error', $ex->getMessage());
        } catch (\PDOException $pdoEx) {
            return back()->withInput()->with('error', $pdoEx->getMessage());
        }

    }
}
