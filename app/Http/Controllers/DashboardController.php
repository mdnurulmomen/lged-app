<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index_referer($type = '')
    {
        Session::put('dashboard_audit_type', $type);
        return redirect()->route('dashboard.index');
    }

    public function index()
    {
        return view('modules.dashboard.index');
    }

    public function dashboard()
    {
        return view('modules.dashboard.dashboard');
    }

    public function getUserProfile(Request $request)
    {
        $user_data = [
            'username' => $this->getUsername(),
            'office_id' => $this->getOfficerId(),
            'office_name_en' => $this->current_desk()['officer_en'],
            'office_name_bn' => $this->current_desk()['officer_bn'],
            'father_name_bn' => $this->getEmployeeInfo()['father_name_bng'],
            'mother_name_bn' => $this->getEmployeeInfo()['mother_name_bng'],
            'date_of_birth' => $this->getEmployeeInfo()['date_of_birth'],
            'nid' => $this->getEmployeeInfo()['nid'],
            'personal_email' => $this->getEmployeeInfo()['personal_email'],
            'personal_mobile' => $this->getEmployeeInfo()['personal_mobile'],
            'joining_date' => $this->getEmployeeInfo()['joining_date'],
        ];
        $profile_pic = $this->profile_picture_url();
        return view('layouts.partials._quick_profile', compact('profile_pic', 'user_data'));
    }
}
