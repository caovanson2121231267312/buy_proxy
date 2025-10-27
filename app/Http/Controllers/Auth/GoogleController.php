<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Exception;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirect()
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (Exception $e) {
            return redirect()->route('home_index')->with(['success' => 'Chức năng đang được xây dựng']);
        }
    }

    public function callback()
    {
        $google = Socialite::driver('google')->user();

        // Tìm user theo email
        $user = User::where('email', $google->getEmail())->first();

        // Nếu user đã tồn tại → Login luôn
        if ($user) {
            // Nếu chưa liên kết google thì cập nhật provider, id_google
            if (!$user->provider || !$user->id_google) {
                $user->update([
                    'provider' => 'google',
                    'id_google' => $google->getId(),
                    // Không thay đổi mật khẩu nếu user đăng ký thường
                ]);
            }

            Auth::login($user, true);
            return redirect()->intended('/dashboard');
        }

        // Nếu email chưa tồn tại → tạo mới
        $user = User::create([
            'name' => $google->getName(),
            'email' => $google->getEmail(),
            'password' => Str::random(32), // random để tránh tài khoản trống mật khẩu
            'provider' => 'google',
            'id_google' => $google->getId(),
            'email_verified_at' => now(), // Google mail đã xác thực → cho verified luôn
        ]);

        // Gửi email "đăng ký thành công" (optional)
        // $user->notify(new WelcomeEmailCustom()); // nếu bạn muốn

        Auth::login($user, true);
        return redirect('/dashboard');
    }
}
