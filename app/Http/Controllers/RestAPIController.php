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

    public function getServerStatus($serverId = "")
    {
          if ($serverId == "") {
               $servers = Server::with('cluster')->with('datacenter')->with('environment')->orderBy('hostname')->get();
          }
          else {
               $servers = Server::with('cluster')->with('datacenter')->with('environment')->where('server_id', '=', $serverId)->orderBy('hostname')->get();
          }

        for ($i = 0; $i < count($servers); $i++) {
               $servers[$i]->server_name = $servers[$i]->hostname;
               if ($servers[$i]->port_name != "") {
                    $servers[$i]->server_name .= ":" . $servers[$i]->port_name;
               }

            $serverStatus = ServerStatus::where("server_id", $servers[$i]->server_id)->get();

            $slaves = ServerSlavesStatus::where("server_id", $servers[$i]->server_id)->orderBy("connection_name")->get();

            for ($slaveNum = 0; $slaveNum < count($slaves); $slaveNum++) {
                $slaves[$slaveNum]->last_error_msg = "This is error message. If this were an actual emergency";
            }

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

    public function turnOffMaintenance($server_id)
    {
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

    public function turnOnMaintenance($server_id)
    {
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

    public function makeServerActive($server_id)
    {
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
    public function makeServerInactive($server_id)
    {
        $server = Server::find($server_id);

        $server->status = 0;

        try {
            $server->save();

            echo json_encode(array("success" => true, "msg" => ""));
        } catch (Illuminate\Database\QueryException $ex) {
            echo json_encode(array("success" => false, "msg" => $ex->getMessage()));
        } catch (\PDOException $pdoEx) {
            echo json_encode(array("success" => false, "msg" => $pdoEx->getMessage()));
        }

    }

    public function getEnvironments()
    {
        $environments = Environment::all();
        echo json_encode(array("success" => true, "msg" => "", "environments" => $environments));
    }

    public function getDatacenters()
    {
        $datacenters = Datacenter::all();
        echo json_encode(array("success" => true, "msg" => "", "datacenters" => $datacenters));
    }

    public function getClusters()
    {
        $clusters = Cluster::all();
        echo json_encode(array("success" => true, "msg" => "", "clusters" => $clusters));
    }

    public function getServers($environmentId, $datacenterId, $clusterId)
    {
          $servers = Server::where("environment_id", "=", $environmentId, "and")->where("datacenter_id", "=", $datacenterId, "and")->where("cluster_id", "=", $clusterId)->orderBy("hostname")->orderBy("port_name")->get();

          for ($i = 0; $i < count($servers); $i++) {
               $servers[$i]->server_name = $servers[$i]->hostname;
               if ($servers[$i]->port_name != "") {
                    $servers[$i]->server_name .= ":" . $servers[$i]->port_name;
               }
          }

          echo json_encode(array("success" => true, "msg" => "", "servers" => $servers));
    }

    public function getServer($serverId)
    {
          $servers = Server::where("server_id", "=", $serverId)->get();
          
          $servers[0]->server_name = $servers[0]->hostname;

          if ($servers[0]->port_name != "") {
               $servers[0]->server_name .= ":" . $servers[0]->port_name;
          }
          
          echo json_encode(array("success" => true, "msg" => "", "servers" => $servers));
    }

}
