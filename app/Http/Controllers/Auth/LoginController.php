<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected function redirectTo()
    {
        if (auth()->user()->role == 1) {
            return '/admin/dashboard';
        }

        return '/dashboard';
    }

    protected function authenticated($request, $user)
    {
        if (! $user->hasVerifiedEmail()) {
            Auth::logout();
            return redirect('/login')->with('error', 'Bạn cần xác thực email để đăng nhập.');
        }

        if ($user->role == 1) {
            return redirect('/admin/dashboard');
        }

        return redirect('/dashboard');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
