<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CPULoadAlert extends Model
{
    protected $table = "cpu_load_alerts";
    protected $primaryKey = "server_id";

    public $timestamps = false;

    protected $attributes = [
    ];

    protected $fillable = ['warning_level', 'error_level'];

}
