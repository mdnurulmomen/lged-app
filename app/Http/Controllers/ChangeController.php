<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class ChangeController extends Controller
{
    public function changeDesignation($id, $office_id, $office_unit_id, $designation_id): RedirectResponse
    {
        Session::put('_office_id', $office_id);
        Session::put('_office_unit_id', $office_unit_id);
        Session::put('_designation_id', $designation_id);
        foreach ($this->getUserOffices() as $office) {
            if ($office['office_id' == $office_id]) {
                Session::put('_current_office', $office);
            }
        }
        return redirect()->route('dashboard');
    }

    public function changeLocale($locale): RedirectResponse
    {
        App::setLocale($locale);
        Session::put('locale', $locale);
        return redirect()->back();
    }
}
