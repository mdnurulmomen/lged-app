<?php

namespace App\Http\Controllers;

class SettingController extends Controller
{
    public function index()
    {
        return view('modules.settings.index');
    }

    public function showSettingsDashboard()
    {
        return view('modules.settings.dashboard.settings_dashboard');
    }
}
