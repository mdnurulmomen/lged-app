<?php

namespace App\Http\Controllers\AuditPlan\Plan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlanEditorController extends Controller
{

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function loadOfficeEmployeeModal(Request $request)
    {
        $officer_lists = $this->cagDoptorOfficeUnitDesignationEmployees($request->office_id);
        return view('modules.modal.load_team_modal', compact('officer_lists'));
    }
}
