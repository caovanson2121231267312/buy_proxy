<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConfigController extends Controller
{
    public function index()
    {
        // lấy tất cả config
        $configs = Config::whereNull('desc')->get()->pluck('value', 'key')->toArray();
        $configs2 = Config::whereNotNull('desc')->get()->pluck('desc', 'key')->toArray();
        // dd($configs, $configs2 );

        return view('admin.configs.index', compact('configs'), compact('configs2'));
    }

    public function update_web(Request $request)
    {
        $request->validate([
            'domain' => 'required|string|max:255',
        ]);

        if ($request->hasFile('icon')) {
            $path = $request->file('icon')->store('uploads/icons', 'public');
            Config::setValue('icon', $path);
        } else {
            // Config::setValue('icon', null);
        }

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('uploads/icons', 'public');
            Config::setValue('logo', $path);
        } else {
            // Config::setValue('logo', null);
        }

        Config::setValue('domain', $request->domain);
        Config::setValue('title', $request->title);
        Config::setValue('phone', $request->phone);
        Config::setValue('email', $request->email);
        Config::setValue('zalo', $request->zalo);
        Config::setValue('facebook', $request->facebook);
        Config::setValue('keywword', $request->keywword);
        Config::setValue('description', $request->description);

        return redirect()->back()->with('success', 'Cập nhật web thành công!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'bank_acc' => 'nullable|string|max:255',
            'bank_pass' => 'nullable|string|max:200',
        ]);

        Config::setValue('bank_name', $request->bank_name);
        Config::setValue('bank_acc', $request->bank_acc);
        Config::setValue('bank_pass', $request->bank_pass);

        return redirect()->back()->with('success', 'Cập nhật cấu hình thành công!');
    }

    public function update_note(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'note_1' => 'required|string',
            'note_2' => 'nullable|string',
        ]);


        Config::setDesc('note_1', $request->note_1);
        Config::setDesc('note_2', $request->note_2);

        return redirect()->back()->with('success', 'Cập nhật lưu ý thành công!');
    }
}
