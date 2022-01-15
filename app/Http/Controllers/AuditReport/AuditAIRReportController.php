<?php

namespace App\Http\Controllers\AuditReport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuditAIRReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index($air_type)
    {
        $fiscal_years = $this->allFiscalYears();
        return view('modules.audit_report.air_generate.index', compact('fiscal_years','air_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['template_type'] = 'air';
        $data['cdesk'] = $this->current_desk_json();

        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.create_air_report'), $data)->json();
        //dd($responseData);
        if (isSuccess($responseData)) {
            $content = $responseData['data']['content'];

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

            $air_type = $request->air_type;
            $fiscal_year_id = $request->fiscal_year_id;
            $activity_id = $request->activity_id;
            $annual_plan_id = $request->annual_plan_id;
            $audit_plan_id = $request->audit_plan_id;
            $audit_year = '২০১৯-২০২০';
            $audit_plan_entities = $request->audit_plan_entities;

            return view('modules.audit_report.air_generate.create',
                compact('air_type','content','cover_info','fiscal_year_id','activity_id',
                    'annual_plan_id','audit_plan_id','audit_year','audit_plan_entities'));
        }
        else {
            return ['status' => 'error', 'data' => $responseData['data']];
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
        //dd($request->fiscal_year_id);
        Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
            'annual_plan_id' => 'required|integer',
            'audit_plan_id' => 'required|integer',
            'activity_id' => 'required|integer',
            'air_description' => 'required',
        ])->validate();

        $data['air_id'] = $request->air_id;
        $data['fiscal_year_id'] = $request->fiscal_year_id;
        $data['activity_id'] = $request->activity_id;
        $data['annual_plan_id'] = $request->annual_plan_id;
        $data['audit_plan_id'] = $request->audit_plan_id;
        $data['air_description'] = makeEncryptedData(gzcompress($request->air_description));
        $data['type'] = $request->air_type;
        $data['status'] = 'draft';
        $data['all_apottis'] = empty($request->all_apottis)?[]:explode(',',$request->all_apottis);
        $data['apottis'] = empty($request->apottis)?[]:explode(',',$request->apottis);
        $data['cdesk'] = $this->current_desk_json();
        $saveAirReport = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.store_air_report'), $data)->json();
        if (isSuccess($saveAirReport)) {
            return response()->json(['status' => 'success', 'data' => $saveAirReport['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $saveAirReport]);
        }
    }


    public function show(Request $request)
    {
        $data = Validator::make($request->all(), [
            'air_report_id' => 'required|integer',
            'fiscal_year_id' => 'required|integer',
            'annual_plan_id' => 'required|integer',
            'audit_plan_id' => 'required|integer',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.edit_air_report'), $data)->json();
        //dd($responseData);
        if (isSuccess($responseData)) {
            $airReport = $responseData['data'];
            $air_descriptions = gzuncompress(getDecryptedData($airReport['air_description']));
            //$cover = $air_descriptions[0];
            //array_shift($air_descriptions);
            $air_report_id = $airReport['id'];
            $annual_plan_id = $airReport['annual_plan_id'];
            $audit_plan_id = $airReport['audit_plan_id'];
            $air_status = $airReport['status'];
            $air_type = $airReport['type'];
            $fiscal_year_id = $request->fiscal_year_id;
            $activity_id = $request->activity_id;
            $latest_receiver_designation_id = empty($airReport['latest_r_air_movement'])?0:$airReport['latest_r_air_movement']['receiver_employee_designation_id'];
            $current_designation_id = $this->current_designation_id();

            return view('modules.audit_report.air_generate.partials.load_air_details',
                compact('air_descriptions','air_report_id','annual_plan_id',
                    'audit_plan_id','air_status','fiscal_year_id','activity_id','air_type',
                    'latest_receiver_designation_id','current_designation_id'));
        }
        else {
            return ['status' => 'error', 'data' => $responseData['data']];
        }
    }


    public function edit(Request $request)
    {
        $data = Validator::make($request->all(), [
            'air_report_id' => 'required|integer',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.edit_air_report'), $data)->json();
        //dd($responseData);
        if (isSuccess($responseData)) {
            $airReport = $responseData['data'];
            $content = gzuncompress(getDecryptedData($airReport['air_description']));
            $air_report_id = $airReport['id'];
            $annual_plan_id = $airReport['annual_plan_id'];
            $audit_plan_id = $airReport['audit_plan_id'];
            $fiscal_year_id = $airReport['fiscal_year_id'];
            $activity_id= $airReport['activity_id'];
            $air_type = $airReport['type'];

            return view('modules.audit_report.air_generate.edit',
                compact('content','air_report_id','annual_plan_id',
                    'audit_plan_id','fiscal_year_id','activity_id','air_type'));
        }
        else {
            return ['status' => 'error', 'data' => $responseData['data']];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {

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


    public function loadApprovedAuditPlanList(Request $request)
    {
        $requestData = Validator::make($request->all(), [
            'air_type' => 'required',
            'fiscal_year_id' => 'required|integer',
            'per_page' => 'required|integer',
            'page' => 'required|integer',
        ])->validate();

        $requestData['cdesk'] =$this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.load_approve_plan_list'), $requestData)->json();
        //dd($responseData);
        $data['audit_plans'] = isSuccess($responseData)?$responseData['data']:[];
        $data['current_designation_id'] = $this->current_designation_id();
        return view('modules.audit_report.air_generate.partials.load_audit_plans',$data);
    }

    public function download(Request $request)
    {
        //dd($request->air_description);
        $airReports = $request->air_description;
        $cover = $airReports[0];
        array_shift($airReports);

        if ($request->scope == 'generate') {
            $pdf = \PDF::loadView('modules.audit_report.air_generate.partials.air_book',
                compact('airReports', 'cover'));
            $fileName = 'Air_Report_' . date('D_M_j_Y') . '.pdf';
            return $pdf->stream($fileName);
        } elseif ($request->scope == 'preview') {
            return view('modules.audit_report.air_generate.partials.preview_air_book',
                compact('airReports', 'cover'));
        } else {
            return ['status' => 'error', 'data' => 'Somethings went wrong'];
        }
    }


    public function getAuditTeam(Request $request)
    {
        $requestData = Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
            'activity_id' => 'required|integer',
            'annual_plan_id' => 'required|integer',
            'audit_plan_id' => 'required|integer',
        ])->validate();

        $requestData['cdesk'] =$this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get_audit_team'), $requestData)->json();
        $auditTeamMembers = isSuccess($responseData)?$responseData['data']:[];
        return view('modules.audit_report.air_generate.partials.load_audit_teams',compact('auditTeamMembers'));
    }

    public function getAuditTeamSchedule(Request $request)
    {
        $requestData = Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
            'activity_id' => 'required|integer',
            'annual_plan_id' => 'required|integer',
            'audit_plan_id' => 'required|integer',
        ])->validate();

        $requestData['cdesk'] =$this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get_audit_team_schedule'), $requestData)->json();
        $audit_team_schedules = isSuccess($responseData)?$responseData['data']:[];
        return view('modules.audit_report.air_generate.partials.load_audit_team_schedules',compact('audit_team_schedules'));
    }


    public function getAuditApottiList(Request $request)
    {
        $requestData = Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
            'audit_plan_id' => 'required|integer',
            'air_type' => 'required',
        ])->validate();

        $requestData['air_id'] = $request->air_id;
        $requestData['cdesk'] =$this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get_audit_apotti_list'), $requestData)->json();
        $apottiData = isSuccess($responseData)?$responseData['data']:[];
        //dd($apottiData);
        return view('modules.audit_report.air_generate.partials.load_audit_apottis',compact('apottiData'));
    }

    public function getAuditApotti(Request $request)
    {
        $requestData = Validator::make($request->all(), [
            'apottis' => 'required',
        ])->validate();

        $requestData['cdesk'] =$this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get_audit_apotti'), $requestData)->json();
        $apottis = isSuccess($responseData)?$responseData['data']:[];
        //dd($apottis);
        if ($request->apotti_view_scope == 'summary'){
            return view('modules.audit_report.air_generate.partials.load_audit_apottis_summary',compact('apottis'));
        }
        else{
            return view('modules.audit_report.air_generate.partials.load_audit_apottis_details',compact('apottis'));
        }
    }
}
