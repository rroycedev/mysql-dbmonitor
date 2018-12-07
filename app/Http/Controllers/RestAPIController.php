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
}
