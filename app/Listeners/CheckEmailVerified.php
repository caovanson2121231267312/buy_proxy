<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\Auth;

class CheckEmailVerified
{
    public function handle(Authenticated $event)
    {
        if (! $event->user->hasVerifiedEmail()) {
            Auth::logout();
            session()->flash('error', 'Bạn phải xác thực email trước khi đăng nhập.');
        }
    }
}
