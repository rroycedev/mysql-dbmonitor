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

use App\Models\CPULoadAlert;
use App\Models\Server;
use Illuminate\Http\Request;

class CPULoadAlertAdminController extends Controller
{
    public function alerts()
    {
        $rows = CPULoadAlert::join(
            'servers',
            'cpu_load_alerts.server_id',
            '=',
            'servers.server_id')->orderBy('servers.hostname')->get();

        return view('admin.alert.cpuload', array("alerts" => $rows));
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

        return view('admin.alert.cpuload.add', array("servers" => json_encode($servers)));
    }

    public function update($server_id)
    {
        $rows = CPULoadAlert::join(
            'servers',
            'cpu_load_alerts.server_id',
            '=',
            'servers.server_id')->where("cpu_load_alerts.server_id", "=", $server_id)->orderBy('servers.hostname')->get();

        return view('admin.alert.cpuload.edit', array("alert" => $rows[0]));
    }

    public function delete($server_id)
    {
        $alerts = CPULoadAlert::where("server_id", $server_id)->get();

        return view('admin.alert.cpuload.delete', array("alert" => $alerts[0]));
    }

    public function performAdd(Request $request)
    {
        $serverId = $request->input('server');

        $warningLevel = $request->input('warning_level');
        $errorLevel = $request->input('error_level');

        $alert = new CPULoadAlert();

        $alert->server_id = $serverId;
        $alert->warning_level = $warningLevel;
        $alert->error_level = $errorLevel;

        try {
            $alert->save();

            return redirect('/admin/alert/cpuload')->with('msg', 'Alert has been saved successfully');
        } catch (Illuminate\Database\QueryException $ex) {
            return back()->withInput()->with('error', $ex->getMessage());
        } catch (\PDOException $pdoEx) {
            return back()->withInput()->with('error', $pdoEx->getMessage());
        }

    }

    public function performUpdate(Request $request)
    {
        $serverId = $request->input('server_id');

        $warningLevel = $request->input('warning_level');
        $errorLevel = $request->input('error_level');

        $alert = CPULoadAlert::find($serverId);

        $alert->warning_level = $warningLevel;
        $alert->error_level = $errorLevel;

        try {
            $alert->save();

            return redirect('/admin/alert/cpuload')->with('msg', 'Alert has been saved successfully');
        } catch (Illuminate\Database\QueryException $ex) {
            return back()->withInput()->with('error', $ex->getMessage());
        } catch (\PDOException $pdoEx) {
            return back()->withInput()->with('error', $pdoEx->getMessage());
        }

    }

    public function performDelete(Request $request)
    {
        $serverId = $request->input('server_id');

        $alert = CPULoadAlert::find($serverId);

        try {
            $alert->delete();

            return redirect('/admin/alert/cpuload')->with('msg', 'Alert has been deleted successfully');
        } catch (Illuminate\Database\QueryException $ex) {
            return back()->withInput()->with('error', $ex->getMessage());
        } catch (\PDOException $pdoEx) {
            return back()->withInput()->with('error', $pdoEx->getMessage());
        }

    }
}
