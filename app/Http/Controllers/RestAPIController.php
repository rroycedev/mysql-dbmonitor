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
use App\Models\ServerSlavesStatus;
use App\Models\ServerStatus;
use Illuminate\Support\Facades\DB;

class RestAPIController extends Controller
{
    public function getMonitoringFilters()
    {
        $envs = Environment::orderBy('view_order')->get();
        $dcs = Datacenter::orderBy('view_order')->get();
        $clusters = Cluster::orderBy('view_order')->get();

        echo json_encode(array("environments" => $envs, "datacenters" => $dcs, "clusters" => $clusters));
    }

    public function getServerStatus()
    {
        $servers = Server::with('cluster')->with('datacenter')->with('environment')->orderBy('hostname')->get();

        for ($i = 0; $i < count($servers); $i++) {
            $serverStatus = ServerStatus::where("server_id", $servers[$i]->server_id)->get();

            $slaves = ServerSlavesStatus::where("server_id", $servers[$i]->server_id)->orderBy("connection_name")->get();

            $servers[$i]->expanded = false;

            if (count($serverStatus) > 0) {
                $servers[$i]->status_class = 'status-green';
                $servers[$i]->is_healthy = true;

                $diskInfo = json_decode($serverStatus[0]->disk_info, true);
                $diskUsed = "";
                $diskUsedTitle = '<table class="table table-bordered"><thead><th>Volume</th><th>Used Percent</th></thead><tbody>';

                foreach ($diskInfo as $info) {
                    if ($diskUsed != "") {
                        $diskUsed .= ",";
                    }
                    $diskUsed .= $info["percent_used"] . "%";

                    $diskUsedTitle .= "<tr><td>" . $info["volume"] . "</td><td>" . $info["percent_used"] . "</td></tr>";
                }

                $diskUsedTitle .= "</tbody></table>";

                $servers[$i]->disk_info = $diskInfo;
                $servers[$i]->disk_used = $diskUsed;
                $servers[$i]->disk_used_title = $diskUsedTitle;
                $servers[$i]->connection_count = $serverStatus[0]->connection_count;
                $servers[$i]->cpu_load = $serverStatus[0]->cpu_load;
            } else {
                $servers[$i]->is_healthy = false;
                $servers[$i]->status_class = 'status-red';

                $servers[$i]->disk_info = array();
                $servers[$i]->disk_used = "";
                $servers[$i]->connection_count = -1;
                $servers[$i]->cpu_load = -1;
            }

            $servers[$i]->slaves = $slaves;
        }

        echo json_encode(array("last_updated" => date("Y-m-d H:i:s"), "status" => $servers));
    }

    public function turnOffMaintenance($server_id) {
        $server = Server::find($server_id);

        $server->status = 1;

        try {
            $server->save();

            echo json_encode(array("success" => true, "msg" => ""));
        } catch (Illuminate\Database\QueryException $ex) {
            echo json_encode(array("success" => false, "msg" => $ex->getMessage()));
        } catch (\PDOException $pdoEx) {
            echo json_encode(array("success" => false, "msg" => $pdoEx->getMessage()));
        }

    }

    public function turnOnMaintenance($server_id) {
        $server = Server::find($server_id);

        $server->status = 2;

        try {
            $server->save();

            echo json_encode(array("success" => true, "msg" => ""));
        } catch (Illuminate\Database\QueryException $ex) {
            echo json_encode(array("success" => false, "msg" => $ex->getMessage()));
        } catch (\PDOException $pdoEx) {
            echo json_encode(array("success" => false, "msg" => $pdoEx->getMessage()));
        }

    }
}
