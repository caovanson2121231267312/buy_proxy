<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'proxy_id',
        'ip',
        'name',
        'password',
        'type_sec',
        'end_date',
        'payload',
        'auto_payment',
        'price',
        'package_id',
        'quantity',
        'unit_price',
        'total_price',
        'auth_type',
        'ip_address',
        'username',
        'auto_renew',
    ];

    protected $casts = [
        'auto_renew' => 'boolean',
        'end_date'   => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function proxy()
    {
        return $this->belongsTo(Proxy::class);
    }
}
