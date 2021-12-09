<?php

namespace App\Http\Controllers\AuditReport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuditQCReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fiscal_years = $this->allFiscalYears();
        return view('modules.audit_report.qc.index', compact('fiscal_years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $data['template_type'] = 'air';
        $data['cdesk'] = $this->current_desk_json();

        $auditReport = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.qc.create_air_report'), $data)->json();
        //dd($auditReport);
        if (isSuccess($auditReport)) {
            $content = $auditReport['data']['content'];

            if ($this->current_office_id() == 19) {
                $directorate_address = 'অডিট কমপ্লেক্স,১ম তলা,সেগুনবাগিচা,ঢাকা-১০০০।';
            } elseif ($this->current_office_id() == 32) {
                $directorate_address = 'অডিট কমপ্লেক্স (নিচ তলা ও ২য় তলা),সেগুনবাগিচা,ঢাকা-১০০০।';
            } else {
                $directorate_address = 'অডিট কমপ্লেক্স (৭ম-৮ম তলা),সেগুনবাগিচা,ঢাকা-১০০০।';
            }

            $cover_info = [
                'directorate_name' => $this->current_office()['office_name_bn'],
                'directorate_address' => $directorate_address,
            ];

            return view('modules.audit_report.qc.create',
                compact('content','cover_info'));
        }
        else {
            return ['status' => 'error', 'data' => $auditReport['data']];
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
            'annual_plan_id' => 'required|integer',
            'audit_plan_id' => 'required|integer',
            'activity_id' => 'required|integer',
            'air_description' => 'required',
        ])->validate();

        $data['plan_description'] = makeEncryptedData(gzcompress(json_encode($request->air_description)));
        $data['status'] = 'approved';
        $data['cdesk'] = $this->current_desk_json();
        $saveAirReport = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.qc.store_air_report'), $data)->json();
        if (isSuccess($saveAirReport)) {
            return response()->json(['status' => 'success', 'data' => $saveAirReport['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $saveAirReport]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function loadAuditPlanList(Request $request)
    {
        $requestData = Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
            'per_page' => 'required|integer',
            'page' => 'required|integer',
        ])->validate();

        $requestData['cdesk'] =$this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.qc.load_approve_plan_list'), $requestData)->json();
        //dd($responseData);
        $data['audit_plans'] = isSuccess($responseData)?$responseData['data']:[];
        $data['current_designation_id'] = $this->current_designation_id();
        return view('modules.audit_report.qc.partials.load_audit_plans',$data);
    }

    public function download(Request $request)
    {
        $air_description = $request->air_description;
        /*$cover = $air_description[0];
        array_shift($air_description);*/
        $cover ='';

        //dd($air_description);

        $pdf = \PDF::loadView('modules.audit_report.qc.partials.air_book',compact('air_description',
            'cover'));
        $fileName = 'air_' . date('D_M_j_Y') . '.pdf';
        return $pdf->stream($fileName);
    }
}
