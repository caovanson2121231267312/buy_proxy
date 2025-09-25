<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('shop.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            // 'email' => [
            //     'required',
            //     'email',
            //     'max:255',
            //     Rule::unique('users')->ignore($user->id),
            // ],
            'phone' => [
                'nullable',
                'string',
                'regex:/^(0[0-9]{9})$/',
                Rule::unique('users')->ignore($user->id),
            ],
            // 'price' => ['nullable', 'numeric', 'min:0'],
        ], [
            'name.required'  => 'Tên không được để trống',
            // 'email.required' => 'Email không được để trống',
            // 'email.email'    => 'Email không hợp lệ',
            'phone.regex'    => 'Số điện thoại phải có 10 số và bắt đầu bằng 0',
            // 'price.numeric'  => 'Giá trị price phải là số',
        ]);

        $user->update($validated);

        return redirect()->route('profile.edit')->with('success', 'Cập nhật hồ sơ thành công!');
    }
}
