<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting\Setting;
use App\Models\Setting\Section;

class SettingController extends Controller
{
    public function setting()
    {
        return view('admin.setting.setting-data', [
            'setting' => Setting::class
        ]);
    }

    public function section()
    {
        return view('admin.setting.section-data', [
            'section' => Section::class
        ]);
    }

}
