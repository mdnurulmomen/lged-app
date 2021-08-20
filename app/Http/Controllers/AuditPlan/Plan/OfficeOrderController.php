<?php

namespace App\Http\Controllers\AuditPlan\Plan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OfficeOrderController extends Controller
{
    public function index()
    {
        $fiscal_years = $this->allFiscalYears();
        return view('modules.audit_plan.audit_plan.office_order.office_orders', compact('fiscal_years'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function showOfficeOrderLists(Request $request)
    {
        $office_info = [
            'office_name_en' => $this->current_office()['office_name_en'],
            'office_name_bn' => $this->current_office()['office_name_bn'],
        ];
        return view('modules.audit_plan.audit_plan.office_order.load_office_orders', compact('office_info'));
    }
}
