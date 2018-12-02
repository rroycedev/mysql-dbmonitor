<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    protected $table = "clusters";
    protected $primaryKey = "cluster_id";

    public $timestamps = false;

    protected $attributes = [
    ];

    protected $fillable = ['name', 'view_order'];
}
