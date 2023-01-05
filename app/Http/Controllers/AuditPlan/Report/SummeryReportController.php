<?php

namespace App\Http\Controllers\AuditPlan\Report;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SummeryReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.audit_plan.summery_reports.index');
    }

    public function getAuditPlanList()
    {
        $audit_plan_list = $this->initHttpWithToken()->get(config('amms_bee_routes.audit_plans'), [
            'all' => 1
        ])->json();

        // dd($audit_plan_list);

        if ($audit_plan_list['status'] == 'success') {
            $audit_plan_list = $audit_plan_list['data'];
            return view('modules.audit_plan.summery_reports.partials.list', compact('audit_plan_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $audit_plan_list]);
        }
    }

    public function getSummeryReport(Request $request)
    {
        $data = Validator::make($request->all(), [
            'audit_plan_id' => 'required|integer',
        ])->validate();

        $audit_plan_id = $request->audit_plan_id;
        $allMemos = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.list'),$data)->json()['data'];
        
        // dd($allMemos);

        if (is_array($allMemos)) {
            // $allMemos = $allMemos['data'];
            return view('modules.audit_plan.summery_reports.partials.summery', compact('allMemos', 'audit_plan_id'));
        } else {
            return response()->json(['status' => 'error', 'data' => []]);
        }
    }

    public function downloadSummeryReport(Request $request)
    {
        $data = Validator::make($request->all(), [
            'audit_plan_id' => 'required|integer',
        ])->validate();

        $allMemos = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.list'),$data)->json()['data'];
        
        // dd($allMemos);
        
        $pdf = Pdf::loadView('modules.audit_plan.summery_reports.partials.download-summery-report', ['allMemos' => $allMemos]);
        // dd($pdf->stream('document.pdf'));

        return $pdf->stream();
    }

    public function getMainBodyDocReport(Request $request)
    {
        $data = Validator::make($request->all(), [
            'audit_plan_id' => 'required|integer',
        ])->validate();

        $audit_plan_id = $request->audit_plan_id;
        $allMemos = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.list'),$data)->json()['data'];
        
        // dd($allMemos);

        if (is_array($allMemos)) {
            // $allMemos = $allMemos['data'];
            return view('modules.audit_plan.summery_reports.partials.main-body-doc', compact('allMemos', 'audit_plan_id'));
        } else {
            return response()->json(['status' => 'error', 'data' => []]);
        }
    }

    public function downloadMainBodyDocReport(Request $request)
    {
        $data = Validator::make($request->all(), [
            'audit_plan_id' => 'required|integer',
        ])->validate();

        $allMemos = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.list'),$data)->json()['data'];
        
        // dd($allMemos);
        
        $pdf = Pdf::loadView('modules.audit_plan.summery_reports.partials.download-main-body-doc-report', ['allMemos' => $allMemos]);
        // dd($pdf->stream('document.pdf'));

        return $pdf->stream();
    }
}
