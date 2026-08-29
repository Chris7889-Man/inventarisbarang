<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function index()
    {
        return view('setting.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'bahasa' => 'nullable|in:id,ms,en,ja,zh,ar',
            'font_size' => 'nullable|in:xs,sm,md,lg,xl,xxl',
        ]);

        if ($request->filled('bahasa')) {
            Session::put('lang', $request->bahasa);
        }
        if ($request->filled('font_size')) {
            Session::put('font_size', $request->font_size);
        }

        return back();
    }
}
