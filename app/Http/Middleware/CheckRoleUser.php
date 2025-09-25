<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
         if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Nếu user có role khớp
        if (Auth::user()->role == $role) {
            return $next($request);
        }

        // Nếu không đúng role thì đá về trang chủ (hoặc 403)
        // return redirect('/')->with('error', 'Bạn không có quyền truy cập');
        return redirect()->back();
    }
}
