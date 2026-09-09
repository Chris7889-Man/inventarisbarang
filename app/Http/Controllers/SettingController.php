<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('setting.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'bahasa' => 'nullable|in:id,ms,en,ja,zh,ar',
            'font_size' => 'nullable|in:xs,sm,md,lg,xl,xxl',
            'drive_root_folder_id' => 'nullable|string',
            'default_email' => 'nullable|email',
            'password_confirm' => 'nullable|string',
        ]);

        if ($request->filled('bahasa')) {
            Session::put('lang', $request->bahasa);
        }
        if ($request->filled('font_size')) {
            Session::put('font_size', $request->font_size);
        }
        
        if ($request->hasAny(['drive_root_folder_id', 'default_email'])) {
            if (!$request->filled('password_confirm')) {
                return back()->with('error', 'Verifikasi password diperlukan untuk mengubah pengaturan Drive.');
            }

            if (!Hash::check($request->password_confirm, auth()->user()->password)) {
                return back()->with('error', 'Verifikasi gagal: Password salah.');
            }

            $data = [];
            if ($request->has('drive_root_folder_id')) $data['drive_root_folder_id'] = $request->drive_root_folder_id;
            if ($request->has('default_email')) $data['default_email'] = $request->default_email;

            Setting::updateOrCreate(['id' => 1], $data);
        }

        return back()->with('success', 'Pengaturan berhasil disimpan');
    }
}
