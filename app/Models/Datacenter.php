<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Datacenter extends Model
{
    protected $table = "datacenters";
    protected $primaryKey = "datacenter_id";

    public $timestamps = false;

    protected $attributes = [
    ];

    protected $fillable = ['name', 'view_order'];

}
