<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallApi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'link',
        'token',
        'price_type',
        'round_price',
        'price_increase',
        'content_type',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function proxy_0()
    {
        return $this->hasMany(Proxy::class, 'api_id')->where('status', 0);
    }

    public function proxy_1()
    {
        return $this->hasMany(Proxy::class, 'api_id')->where('status', 1);
    }
}
