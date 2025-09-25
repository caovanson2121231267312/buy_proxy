<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $token = $request->token;

        if(empty($token)) {
            return response()->json([
                "message" => "Vui lòng truyền token user cho api",
            ],500);
        }
        
        $user = User::where('token', $token)->whereNotNull('email_verified_at')->first();

        if(empty($user)) {
            return response()->json([
                "message" => "token không tồn tại",
            ],401);
        }

        return $next($request);
    }
}
