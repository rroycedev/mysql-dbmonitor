<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Environment extends Model
{
    protected $table = "environments";
    protected $primaryKey = "environment_id";

    public $timestamps = false;

    protected $attributes = [
    ];

    protected $fillable = ['name', 'view_order'];

}
