<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $table = "servers";
    protected $primaryKey = "server_id";

    public $timestamps = false;

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
}
