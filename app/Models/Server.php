<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Model
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

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $table = "servers";
    protected $primaryKey = "server_id";

    public $timestamps = false;

    public $port_name = "";
    
    protected $attributes = [
    ];

    protected $fillable = ['hostname', 'ipaddress', 'port_name', 'environment_id', 'datacenter_id', 'cluster_id', 'active', 'exclude_noc', 'exclude_disk_check',
        'maint_mode', 'maint_mode_start_date'];

    public function cluster()
    {
        return $this->hasOne('App\Models\Cluster', 'cluster_id', 'cluster_id');
    }

    public function datacenter()
    {
        return $this->hasOne('App\Models\Datacenter', 'datacenter_id', 'datacenter_id');
    }

    public function environment()
    {
        return $this->hasOne('App\Models\Environment', 'environment_id', 'environment_id');
    }

    public function replication_lag_alerts()
    {
        return $this->hasOne('App\Models\ReplicationLagAlert', 'server_id', 'server_id');
    }
}
