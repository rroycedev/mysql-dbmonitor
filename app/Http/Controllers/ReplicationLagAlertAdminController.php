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

use App\Models\ReplicationLagAlert;
use App\Models\Server;
use Auth;
use Illuminate\Http\Request;

class ReplicationLagAlertAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'acl:view_data']);
    }

    public function alerts()
    {
        $rows = ReplicationLagAlert::join(
            'servers',
            'replication_lag_alerts.server_id',
            '=',
            'servers.server_id')->orderBy('servers.hostname')->get();

        return view('admin.alert.repllag', array("alerts" => $rows));
    }

    public function add()
    {
        $rows = Server::with('cluster')->with('datacenter')->with('environment')->orderBy('hostname')->get();

        $servers = array();

        foreach ($rows as $row) {
            if ($row->port_name != "") {
                $servers[$row->server_id] = $row->hostname . ":" . $row->port_name;
            } else {
                $servers[$row->server_id] = $row->hostname;
            }
        }

        $canEdit = false;

        foreach (Auth::user()->roles[0]->permissions as $p) {
            if ($p["permission_slug"] == "manage_data") {
                $canEdit = true;
            }
        }

        return view('admin.alert.repllag.add', array("servers" => json_encode($servers), "canEdit" => $canEdit));
    }

    public function update($server_id)
    {
        $rows = ReplicationLagAlert::join(
            'servers',
            'replication_lag_alerts.server_id',
            '=',
            'servers.server_id')->where("replication_lag_alerts.server_id", "=", $server_id)->orderBy('servers.hostname')->get();

        $canEdit = false;

        foreach (Auth::user()->roles[0]->permissions as $p) {
            if ($p["permission_slug"] == "manage_data") {
                $canEdit = true;
            }
        }

        return view('admin.alert.repllag.edit', array("alert" => $rows[0], "canEdit" => $canEdit));
    }

    public function delete($server_id)
    {
        $alerts = ReplicationLagAlert::where("server_id", $server_id)->get();

        $canEdit = false;

        foreach (Auth::user()->roles[0]->permissions as $p) {
            if ($p["permission_slug"] == "manage_data") {
                $canEdit = true;
            }
        }

        return view('admin.alert.repllag.delete', array("alert" => $alerts[0], "canEdit" => $canEdit));
    }

    public function performAdd(Request $request)
    {
        $serverId = $request->input('server');

        $warningLevel = $request->input('warning_level_secs');
        $errorLevel = $request->input('error_level_secs');

        $alert = new ReplicationLagAlert();

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

        $alert = ReplicationLagAlert::find($serverId);

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

        $alert = ReplicationLagAlert::find($serverId);

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
