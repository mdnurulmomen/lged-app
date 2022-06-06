<?php

namespace App\Http\Controllers\AuditReport;

use App\Http\Controllers\Controller;
use App\Services\PDFServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Mpdf\Mpdf;

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
        return view('modules.audit_report.air_generate.index', compact('fiscal_years', 'air_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['template_type'] = 'preliminary_air';
        $data['cdesk'] = $this->current_desk_json();

        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.create_air_report'), $data)->json();
        if (isSuccess($responseData)) {
            $content = $responseData['data']['content'];
            $directorate_name = $this->current_office()['office_name_bn'];
            //$directorate_address = $this->current_office_details()['office_address']; //todo mahmud vai
            $directorate_address = '';
            //dd($directorate_address);
            $auditType = $request->session()->get('dashboard_audit_type_bn');

            $air_type = $request->air_type;
            $fiscal_year_id = $request->fiscal_year_id;
            $activity_id = $request->activity_id;
            $annual_plan_id = $request->annual_plan_id;
            $audit_plan_id = $request->audit_plan_id;

            $audit_year = enTobn($request->fiscal_year_start) . '-' . enTobn($request->fiscal_year_end);
            $fiscal_year = enTobn($request->fiscal_year_start) . '-' . enTobn($request->fiscal_year_end);

            $audit_plan_entities = $request->audit_plan_entities;
            $audit_plan_entity_info = $request->audit_plan_entity_info;
            //dd($audit_plan_entity_info);

            return view('modules.audit_report.air_generate.create',
                compact(
                    'directorate_name',
                    'directorate_address',
                    'auditType',
                    'air_type',
                    'content',
                    'fiscal_year_id',
                    'activity_id',
                    'annual_plan_id',
                    'audit_plan_id',
                    'audit_year',
                    'fiscal_year',
                    'audit_plan_entities',
                    'audit_plan_entity_info'
                )
            );
        } else {
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
        $data =  Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
            'annual_plan_id' => 'required|integer',
            'audit_plan_id' => 'required|integer',
            'activity_id' => 'required|integer',
            'air_description' => 'required',
            'ministry_id' => 'required',
            'ministry_name_en' => 'required',
            'ministry_name_bn' => 'required',
            'entity_id' => 'required',
            'entity_name_en' => 'required',
            'entity_name_bn' => 'required',
        ])->validate();

        $air_description = json_decode($request->air_description);
        unset($air_description['27']);
        //dd(json_encode($air_description));

        $data['air_id'] = $request->air_id;
        $data['air_description'] = makeEncryptedData(gzcompress(json_encode($air_description)));
        $data['type'] = $request->air_type;
        $data['audit_plan_entities'] = $request->audit_plan_entities;
        $data['status'] = 'draft';
        $data['all_apottis'] = empty($request->all_apottis) ? [] : explode(',', $request->all_apottis);
        $data['apottis'] = empty($request->apottis) ? [] : explode(',', $request->apottis);
        $data['cdesk'] = $this->current_desk_json();

        $data_rearrange_apotti['onucched_list'] =  $this->apotti_onucced_genarate($data['all_apottis'], $data['apottis']);
        $data_rearrange_apotti['cdesk'] = $this->current_desk_json();

        //dd($data_rearrange_apotti['onucched_list']);

        $rearrange_apotti = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.apotti.onucched_rearrange'), $data_rearrange_apotti)->json();

        if (isSuccess($rearrange_apotti)) {
            $saveAirReport = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.store_air_report'), $data)->json();
            //dd($saveAirReport);
            if (isSuccess($saveAirReport)) {
                return response()->json(['status' => 'success', 'data' => $saveAirReport['data']]);
            } else {
                return response()->json(['status' => 'error', 'data' => $saveAirReport]);
            }
        } else {
            return response()->json(['status' => 'error', 'data' => 'Apotti rearrange issue']);
        }
    }

    public function apotti_onucced_genarate($all_apottis, $selected_apottis)
    {

        $unselect_sort_apottis = [];
        $select_sort_apottis = [];

        $unselected_apottis = array_diff($all_apottis, $selected_apottis);
        $selected_apotti_count = count($selected_apottis);

        foreach ($unselected_apottis as  $unselected_apotti) {
            $selected_apotti_count++;
            $sort_apottis_temp = [
                'apotti_id' => $unselected_apotti,
                'onucched_no' => $selected_apotti_count,
            ];
            $unselect_sort_apottis[] = $sort_apottis_temp;
        }

        foreach ($selected_apottis as  $key => $selected_apotti) {
            $sort_apottis_temp = [
                'apotti_id' => $selected_apotti,
                'onucched_no' => $key + 1,
            ];
            $select_sort_apottis[] = $sort_apottis_temp;
        }

        return array_merge($select_sort_apottis, $unselect_sort_apottis);
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
        //        dd($responseData);
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
            $audit_plan_entities = $request->audit_plan_entities;
            $latest_receiver_designation_id = empty($airReport['latest_r_air_movement']) ? 0 : $airReport['latest_r_air_movement']['receiver_employee_designation_id'];
            $current_designation_id = $this->current_designation_id();

            return view(
                'modules.audit_report.air_generate.partials.load_air_details',
                compact(
                    'air_descriptions',
                    'air_report_id',
                    'annual_plan_id',
                    'audit_plan_id',
                    'air_status',
                    'fiscal_year_id',
                    'activity_id',
                    'air_type',
                    'latest_receiver_designation_id',
                    'current_designation_id',
                    'audit_plan_entities'
                )
            );
        } else {
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
        //        dd($responseData);
        if (isSuccess($responseData)) {
            $airReport = $responseData['data'];
            $content = gzuncompress(getDecryptedData($airReport['air_description']));
            $air_report_id = $airReport['id'];
            $annual_plan_id = $airReport['annual_plan_id'];
            $audit_plan_id = $airReport['audit_plan_id'];
            $fiscal_year_id = $airReport['fiscal_year_id'];
            $activity_id = $airReport['activity_id'];
            $air_type = $airReport['type'];
            $air_status = $airReport['status'];

            $ministry_id = $airReport['ministry_id'];
            $ministry_name_en = $airReport['ministry_name_en'];
            $ministry_name_bn = $airReport['ministry_name_bn'];
            $entity_id = $airReport['entity_id'];
            $entity_name_en = $airReport['entity_name_en'];
            $entity_name_bn = $airReport['entity_name_bn'];

            $audit_plan_entities = $request->audit_plan_entities;
            $audit_plan_entity_info = $airReport['annual_plan']['ap_entities'];
            //dd($audit_plan_entity_info);

            return view(
                'modules.audit_report.air_generate.edit',
                compact(
                    'content',
                    'air_report_id',
                    'annual_plan_id',
                    'audit_plan_id',
                    'fiscal_year_id',
                    'activity_id',
                    'air_type',
                    'air_status',
                    'audit_plan_entities',
                    'audit_plan_entity_info',
                    'ministry_id',
                    'ministry_name_en',
                    'ministry_name_bn',
                    'entity_id',
                    'entity_name_en',
                    'entity_name_bn'
                )
            );
        } else {
            return ['status' => 'error', 'data' => $responseData['data']];
        }
    }


    public function loadApprovedAuditPlanList(Request $request)
    {
        $requestData = Validator::make($request->all(), [
            'air_type' => 'required',
            'fiscal_year_id' => 'required|integer',
            'per_page' => 'required|integer',
            'page' => 'required|integer',
        ])->validate();

        $requestData['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.load_approve_plan_list'), $requestData)->json();
        //dd($responseData);
        $data['audit_plans'] = isSuccess($responseData) ? $responseData['data'] : [];
        $data['current_designation_id'] = $this->current_designation_id();
        return view('modules.audit_report.air_generate.partials.load_audit_plans', $data);
    }

    public function preview(Request $request)
    {
        //dd($request->air_description);
        $auditReport = $request->air_description;
        return view(
            'modules.audit_report.air_generate.partials.preview_air_book',
            compact('auditReport')
        );
    }

    public function download(Request $request)
    {
        ini_set("pcre.backtrack_limit", "999999999999");
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 0);

        $apotti_items = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get-air-wise-porisistos'), ['air_id' => $request->air_id, 'all' => '1', 'cdesk' => $this->current_desk_json()])->json();
        $porisistos_html = [];
        if (isSuccess($apotti_items)) {
            $apotti_items = $apotti_items['data'];
            foreach ($apotti_items as $apotti_item) {
                foreach ($apotti_item['porisishtos'] as $porisishto) {
                    $porisistos_html[] = $porisishto['details'];
                }
            }
        } else {
            $porisistos_html = [];
        }

        $auditReport = $request->air_description;
        $pdf = \PDF::loadView(
            'modules.audit_report.air_generate.partials.air_book',
            ['auditReport' => $auditReport, 'porisistos' => $porisistos_html],
            [],
            ['orientation' => 'P', 'format' => 'A4']
        );
        $fileName = 'draft_air_report_' . date('D_M_j_Y') . '.pdf';
        return $pdf->stream($fileName);
    }


    public function getAuditTeam(Request $request)
    {
        $requestData = Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
            'activity_id' => 'required|integer',
            'annual_plan_id' => 'required|integer',
            'audit_plan_id' => 'required|integer',
        ])->validate();

        $requestData['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get_audit_team'), $requestData)->json();
        $auditTeamMembers = isSuccess($responseData) ? $responseData['data'] : [];
        return view('modules.audit_report.air_generate.partials.load_audit_teams', compact('auditTeamMembers'));
    }

    public function getAuditTeamSchedule(Request $request)
    {
        $requestData = Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
            'activity_id' => 'required|integer',
            'annual_plan_id' => 'required|integer',
            'audit_plan_id' => 'required|integer',
        ])->validate();

        $requestData['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get_audit_team_schedule'), $requestData)->json();
        $audit_team_schedules = isSuccess($responseData) ? $responseData['data'] : [];
        return view('modules.audit_report.air_generate.partials.load_audit_team_schedules', compact('audit_team_schedules'));
    }


    public function getPlanEntity(Request $request)
    {
        $requestData = Validator::make($request->all(), [
            'entity_info' => 'required',
            'fiscal_year_id' => 'required|integer',
            'audit_plan_id' => 'required|integer',
            'air_type' => 'required',
        ])->validate();

        //       dd($requestData);

        return view('modules.audit_report.air_generate.partials.load_entity_list', $requestData);
    }


    public function getAuditApottiList(Request $request)
    {
        $requestData = Validator::make($request->all(), [
            'fiscal_year_id' => 'required|integer',
            'audit_plan_id' => 'required|integer',
            'entity_id' => 'required|integer',
            'air_type' => 'required',
        ])->validate();

        $requestData['air_id'] = $request->air_id;
        $requestData['cdesk'] = $this->current_desk_json();
        $entity_info = $request->entity_info;
        //        dd($entity_info);
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get_audit_apotti_list'), $requestData)->json();
        $apottiData = isSuccess($responseData) ? $responseData['data'] : [];
        //        dd($apottiData);
        return view('modules.audit_report.air_generate.partials.load_audit_apottis', compact('apottiData', 'entity_info'));
    }

    public function getAuditApotti(Request $request)
    {
        $requestData = Validator::make($request->all(), [
            'apottis' => 'required',
        ])->validate();

        //        dd($requestData);

        $requestData['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get_audit_apotti'), $requestData)->json();
        $apottis = isSuccess($responseData) ? $responseData['data'] : [];
        //dd($apottis);
        if ($request->apotti_view_scope == 'summary') {
            return view('modules.audit_report.air_generate.partials.load_audit_apottis_summary', compact('apottis'));
        } else {
            return view('modules.audit_report.air_generate.partials.load_audit_apottis_details', compact('apottis'));
        }
    }

    public function getAuditApottiWisePrisistos(Request $request)
    {
        $requestData = Validator::make($request->all(), [
            'apottis' => 'required',
        ])->validate();

        $requestData['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get_audit_apotti_wise_porisistos'), $requestData)->json();
        $apotti_items = isSuccess($responseData) ? $responseData['data'] : [];
        return view('modules.audit_report.air_generate.partials.load_audit_apottis_wise_porisistos', compact('apotti_items'));
    }

    public function authorityAirReport(Request $request)
    {
        $all_directorates = $this->allAuditDirectorates();

        //        dd($all_directorates);

        $self_directorate = current(array_filter($all_directorates, function ($item) {
            return $this->current_office_id() == $item['office_id'];
        }));

        $directorates = $self_directorate ? [$self_directorate] : $all_directorates;

        $fiscal_years = $this->allFiscalYears();

        return view('modules.audit_report.audit_air_report.index', compact('fiscal_years', 'directorates'));
    }

    public function getAuthorityAuditAirReport(Request $request)
    {
        $data = Validator::make($request->all(), [
            'office_id' => 'required',
            'qac_type' => 'required',
            'activity_id' => 'required',
        ], [
            'office_id.required' => 'অধিদপ্তর বাছাই করুন',
            'activity_id.required' => 'অ্যাক্টিভিটি বাছাই করুন',
        ])->validate();
        //        dd($data);
        $data['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get-authority-air-report'), $data)->json();
        //        dd($responseData);
        $current_designation_id = $this->current_designation_id();
        $final_report = isSuccess($responseData) ? $responseData['data'] : [];
        return view(
            'modules.audit_report.audit_air_report.air_report_list',
            compact('final_report', 'current_designation_id')
        );
    }
}
