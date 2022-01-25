<?php

namespace App\Http\Controllers\AuditPlan\AuditAnnualPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PreliminarySurveyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */

    public function index()
    {
        $fiscal_years = $this->allFiscalYears();
        return view('modules.audit_plan.annual.psr.index', compact('fiscal_years'));
    }

    public function loadPsr(Request $request)
    {
        $psr_list = [];
        return view('modules.audit_plan.annual.psr.partial.load_psr_list',compact('psr_list'));

    }

    public function create(Request $request)
    {
        return view('modules.audit_plan.annual.psr.partial.create');
    }

    public function store(Request $request)
    {
        return view('modules.audit_plan.annual.psr.partial.create');
    }
}
