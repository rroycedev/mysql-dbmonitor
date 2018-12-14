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

use App\Models\DiskAlert;
use App\Models\Server;
use Illuminate\Http\Request;

/**
 * DiskAlertAdminController Class
 *
 * PHP version 7
 *
 * @category  Class
 * @package   MySQLDbmonitor
 * @author    Ronald Royce <rroycedev@gmail.com>
 * @copyright 2018 Ronald Royce
 * @license   GPL http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link      http://www.rroycedev.com/
 **/

class DiskAlertAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Method: alerts
     *
     * Return view to display all disk alerts
     *
     * @return View
     **/
    public function alerts()
    {
        $rows = DiskAlert::join(
            'servers',
            'disk_alerts.server_id',
            '=',
            'servers.server_id'
        )->orderBy('servers.hostname')->get();

        return view('admin.alert.disk', array("alerts" => $rows));
    }

    /**
     * Return the view for adding alert
     *
     * @return View
     **/
    public function add()
    {
        $rows = Server::with(
            'cluster'
        )->with('datacenter')->with('environment')->orderBy('hostname')->get();

        $servers = array();

        foreach ($rows as $row) {
            if ($row->port_name != "") {
                $servers[$row->server_id] = $row->hostname . ":" . $row->port_name;
            } else {
                $servers[$row->server_id] = $row->hostname;
            }
        }

        return view('admin.alert.disk.add', array("servers" => json_encode($servers)));
    }

    /**
     * Return the view for updating alert
     *
     * @param alert_id $alert_id The primary key for the alert
     *
     * @return View
     **/
    public function update($alert_id)
    {
        $rows = DiskAlert::join(
            'servers',
            'disk_alerts.server_id',
            '=',
            'servers.server_id'
        )->where("disk_alerts.alert_id", "=", $alert_id)->orderBy('servers.hostname')->get();

        return view('admin.alert.disk.edit', array("alert" => $rows[0]));
    }

    /**
     * Return the view for deleting alert
     *
     * @param alert_id $alert_id The primary key for the alert
     *
     * @return View
     **/
    public function delete($alert_id)
    {
        $alerts = DiskAlert::where("alert_id", $alert_id)->get();

        return view('admin.alert.disk.delete', array("alert" => $alerts[0]));
    }

    /**
     * Insert the alert and return back to alerts view
     *
     * @param request $request The web request object
     *
     * @return View
     **/
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

    /**
     * Update the alert and return back to alerts view
     *
     * @param request $request The web request object
     *
     * @return View
     **/
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

    /**
     * Delete the alert and return back to alerts view
     *
     * @param request $request The web request object
     *
     * @return View
     **/
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
