<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DNSAlias extends Model
{
    protected $table = "dns_aliases";
    protected $primaryKey = "alias_id";

    public $timestamps = false;

    protected $attributes = [
    ];

    protected $fillable = ['name', 'is_vip', 'vip_port', 'active'];
}
