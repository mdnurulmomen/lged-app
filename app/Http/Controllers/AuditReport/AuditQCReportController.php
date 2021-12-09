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
    public function create(Request $request)
    {
        $data['template_type'] = 'air';
        $data['cdesk'] = $this->current_desk_json();

        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.qc.create_air_report'), $data)->json();
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

            $fiscal_year_id = $request->fiscal_year_id;
            $activity_id = $request->activity_id;
            $annual_plan_id = $request->annual_plan_id;
            $audit_plan_id = $request->audit_plan_id;

            return view('modules.audit_report.qc.create',
                compact('content','cover_info','fiscal_year_id','activity_id',
                'annual_plan_id','audit_plan_id'));
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
    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $data = Validator::make($request->all(), [
            'audit_plan_id' => 'required|integer',
            'fiscal_year_id' => 'required|integer',
            'annual_plan_id' => 'required|integer',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();

        $audit_plan = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.ap_entity_plan_edit_draft'), $data)->json();

        if (isSuccess($audit_plan)) {
            $audit_plan = $audit_plan['data'];
            $parent_office_id = 0;
            $content = json_decode(gzuncompress(getDecryptedData($audit_plan['plan_description'])));
            $activity_id = $audit_plan['activity_id'];
            $annual_plan_id = $audit_plan['annual_plan_id'];
            $fiscal_year_id = $request->fiscal_year_id;

            $entities = [];
            $entity_list = [];

            foreach ($audit_plan['annual_plan']['ap_entities'] as $ap_entities) {
                $entity = $ap_entities['entity_name_bn'];
                $entities[] = $entity;

                $entity_info = [
                    'ministry_id' =>  $ap_entities['ministry_id'],
                    'ministry_name_bn' =>  $ap_entities['ministry_name_bn'],
                    'ministry_name_en' =>  $ap_entities['ministry_name_en'],
                    'entity_id' =>  $ap_entities['entity_id'],
                    'entity_name_bn' =>  $ap_entities['entity_name_bn'],
                    'entity_name_en' =>  $ap_entities['entity_name_en'],
                ];
                $entity_list[] = $entity_info;
            }

            $entity_list = json_encode($entity_list);

            return view('modules.audit_plan.audit_plan.plan_revised.edit_entity_audit_plan', compact('activity_id', 'annual_plan_id',
                'audit_plan', 'content', 'fiscal_year_id', 'parent_office_id','entity_list'));
        } else {
            return ['status' => 'error', 'data' => $audit_plan];
        }
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
        //dd($request->air_description);
        $airReports = $request->air_description;
        $cover = $airReports[0];
        array_shift($airReports);

        if ($request->scope == 'generate') {
            $pdf = \PDF::loadView('modules.audit_report.qc.partials.air_book',
                compact('airReports', 'cover'));
            $fileName = 'Air_Report_' . date('D_M_j_Y') . '.pdf';
            return $pdf->stream($fileName);
        } elseif ($request->scope == 'preview') {
            return view('modules.audit_report.qc.partials.preview_air_book',
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
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.qc.get_audit_team'), $requestData)->json();
        $auditTeamMembers = isSuccess($responseData)?$responseData['data']:[];
        return view('modules.audit_report.qc.partials.load_audit_teams',compact('auditTeamMembers'));
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
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.qc.get_audit_team_schedule'), $requestData)->json();
        $audit_team_schedules = isSuccess($responseData)?$responseData['data']:[];
        return view('modules.audit_report.qc.partials.load_audit_team_schedules',compact('audit_team_schedules'));
    }
}
