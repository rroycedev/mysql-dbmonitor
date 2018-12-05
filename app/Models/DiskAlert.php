<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiskAlert extends Model
{
    protected $table = "disk_alerts";
    protected $primaryKey = "alert_id";

    public $timestamps = false;

    protected $attributes = [
    ];

    protected $fillable = ['volume', 'warning_level_pct', 'error_level_pct'];

}
