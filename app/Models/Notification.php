<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'title',
        'content',
        'send_email',
        'user_ids',
        'user_id',
    ];

    protected $casts = [
        'user_ids' => 'array',
        'send_email' => 'boolean',
    ];
}
