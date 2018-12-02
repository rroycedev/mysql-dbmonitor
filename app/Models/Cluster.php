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

    protected $fillable = ['name', 'parent_cluster_id', 'view_order'];

    public function parent_cluster()
    {
        return $this->hasOne('App\Models\Cluster', 'cluster_id', 'parent_cluster_id');
    }
}
