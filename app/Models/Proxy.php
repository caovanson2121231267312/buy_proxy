<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proxy extends Model
{
    use HasFactory;

    protected $fillable = [
        'proxy_type',
        'proxy_type_name',
        'package_code',
        'package_name',
        'price',
        'expiry_time',
        'use_time_min',
        'status',
        'api_id',
        'user_id',
        'content',
    ];

    public function api_call()
    {
        return $this->belongsTo(CallApi::class, 'api_id');
    }
}
