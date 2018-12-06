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

        return view('admin.alert.disk', array("alerts" => $rows));
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

        return view('admin.alert.disk.add', array("servers" => json_encode($servers)));
    }

    public function update($alert_id)
    {
        $rows = DiskAlert::join(
            'servers',
            'disk_alerts.server_id',
            '=',
            'servers.server_id')->where("disk_alerts.alert_id", "=", $alert_id)->orderBy('servers.hostname')->get();

        return view('admin.alert.disk.edit', array("alert" => $rows[0]));
    }

    public function delete($alert_id)
    {
        $alerts = DiskAlert::where("alert_id", $alert_id)->get();

        return view('admin.alert.disk.delete', array("alert" => $alerts[0]));
    }

    public function performAdd(Request $request)
    {
        $serverId = $request->input('server');

        $warningLevel = $request->input('warning_level_pct');
        $errorLevel = $request->input('error_level_pct');
        $volume = $request->input('volume');

        $alert = new DiskAlert();

        $alert->server_id = $serverId;
        $alert->volume = $volume;
        $alert->warning_level_pct = $warningLevel;
        $alert->error_level_pct = $errorLevel;

        try {
            $alert->save();

            return redirect('/admin/alert/disk')->with('msg', 'Alert has been saved successfully');
        } catch (Illuminate\Database\QueryException $ex) {
            return back()->withInput()->with('error', $ex->getMessage());
        } catch (\PDOException $pdoEx) {
            return back()->withInput()->with('error', $pdoEx->getMessage());
        }
    }

    public function performUpdate(Request $request)
    {
        $alertId = $request->input('alert_id');

        $warningLevel = $request->input('warning_level_pct');
        $errorLevel = $request->input('error_level_pct');
        $volume = $request->input('volume');

        $alert = DiskAlert::find($alertId);

        $alert->volume = $volume;
        $alert->warning_level_pct = $warningLevel;
        $alert->error_level_pct = $errorLevel;

        try {
            $alert->save();

            return redirect('/admin/alert/disk')->with('msg', 'Alert has been saved successfully');
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
