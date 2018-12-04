<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReplicationLagAlert extends Model
{
    protected $table = "replication_lag_alerts";
    protected $primaryKey = "server_id";

    public $timestamps = false;

    protected $attributes = [
    ];

    protected $fillable = ['warning_level_secs', 'error_level_secs'];

}
