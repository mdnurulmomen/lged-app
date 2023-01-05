<?php

namespace App\Http\Controllers\AuditPlan\Individual;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndividualPlanController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());
        $individual_strategic_plan_year = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_yearly_plan.get_individual_yearly_plan_year'))->json();

        if (isSuccess($individual_strategic_plan_year)) {
            $individual_strategic_plan_year = $individual_strategic_plan_year['data'];
            // dd($individual_strategic_plan_year);
            return view('modules.individual_plan.index',compact('individual_strategic_plan_year'));
        } else {
            return response()->json(['status' => 'error', 'data' => $individual_strategic_plan_year]);
        }
    }

    public function getIndividualYearlyPlan(Request $request){
        
        $data = Validator::make($request->all(), [
            'strategic_plan_year' => 'required|integer',
        ])->validate();

        $individual_yearly_plan = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_yearly_plan.get_individual_yearly_plan'),$data)->json();

//         dd($individual_yearly_plan);

        if (isSuccess($individual_yearly_plan)) {
            $individual_yearly_plan = $individual_yearly_plan['data'];
            return view('modules.individual_plan.partial.plans',compact('individual_yearly_plan'));
        } else {
            return response()->json(['status' => 'error', 'data' => $individual_yearly_plan]);
        }
    }

    public function getIndividualPlan(Request $request){

        $data = Validator::make($request->all(), [
            'audit_plan_id' => 'required',
            'yearly_plan_location_id' => 'required|integer',
            'plan_year' => 'required|integer',
            'sector_name' => 'required|string',
            // 'sector_type' => 'required|string',
            // 'sector_id' => 'required|integer',
        ])->validate();

        $individualPlanInfo = $this->initHttpWithToken()->post(config('amms_bee_routes.individual_plan.get-audit-plan-info'),$data)->json();

//        dd($individualPlanInfo);

        if (isSuccess($individualPlanInfo)) {
            $individualPlanInfo = $individualPlanInfo['data'];
            return view('modules.individual_plan.partial.individual_plans',compact('individualPlanInfo', 'data'));
        } else {
            return response()->json(['status' => 'error', 'data' => $individualPlanInfo]);
        }
    }

    public function store(Request $request){

        $data = Validator::make($request->all(), [
            'id' => 'nullable',
            'audit_type' => 'required|string',
            'yearly_plan_id' => 'required|integer',
            'yearly_plan_location_id' => 'required|integer',
            'milestone_list' => 'required',
            'objective' => 'required|string',
            'scope' => 'required|string',
        ])->validate();
        

        $data['cdesk'] = $this->current_desk_json();

        $individualPlanStore = $this->initHttpWithToken()->post(config('amms_bee_routes.individual_plan.store'),$data)->json();
    //    dd($individualPlanStore);
        if (isSuccess($individualPlanStore)) {
            return response()->json(['status' => 'success', 'data' => $individualPlanStore['data']]);
        } else {
            return ['status' => 'error', 'data' => $individualPlanStore];
        }
    }

    public function getAuditTeamModal(Request $request)
    {
        $data = Validator::make($request->all(), [
            'yearly_plan_location_id' => 'required|integer',
            'sector_type' => 'required|string',
            'sector_id' => 'required|integer',
        ])->validate();

        // dd($request);

        /*
        $data = Validator::make($request->all(), [
            'activity_id' => 'required|integer',
            'annual_plan_id' => 'required|integer',
            'fiscal_year_id' => 'required|integer',
            'audit_plan_id' => 'required|integer',
            'parent_office_id' => 'required',
        ])->validate();

        $project_id = $request->project_id;
        $modal_type = $request->modal_type;
        $activity_id = $request->activity_id;
        $annual_plan_id = $request->annual_plan_id;
        $fiscal_year_id = $request->fiscal_year_id;
        $audit_plan_id = $request->audit_plan_id;
        $audit_plan_no = $request->audit_plan_no;
        $has_update_office_order = $request->has_update_office_order;
        $office_order_approval_status = $request->office_order_approval_status;
        $parent_office_id = json_encode($request->parent_office_id);
        */

        $modal_type = '';
        $own_office = ['name' => $this->current_office()['office_name_bn'], 'id' => $this->current_office()['id']];
        $other_offices = $this->cagDoptorOtherOffices($this->current_office_id());

        $yearly_plan_location_id = $request->yearly_plan_location_id;
        $sector_type = $request->sector_type;
        $sector_id = $request->sector_id;
        // $strategic_plan_year = $request->strategic_plan_year;
        $parent_office_id = '';

        // dd($own_office);

        //for all team data
        // $cdesk = $this->current_desk_json();
        // $data['cdesk'] = $cdesk;
        // $data['yearly_plan_location_id'] = $yearly_plan_location_id;

        // $teamResponseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.get_audit_plan_wise_team'), $data)->json();

        // dd($teamResponseData);

        // $all_teams = isSuccess($teamResponseData) ? $teamResponseData['data'] : [];

        // dd($all_teams);

        return view('modules.individual_plan.partial.team-modal', compact(
            'modal_type',
            'own_office',
            'other_offices',
            'yearly_plan_location_id',
            'sector_type',
            'sector_id',
            'parent_office_id',
        ));
    }

    public function getAuditTeamSchedule(Request $request)
    {
        $data = Validator::make($request->all(), [
            'team_layer_id' => 'required|integer',
            'sector_id' => 'required|integer',
            'sector_type' => 'required|string',
        ])->validate();

        // dd($data);

        // $data['cdesk'] = $this->current_desk_json();

        $sector_type = $request->sector_type;
        $sector_id = $request->sector_id;
        $team_layer_id = $request->team_layer_id;

        if ($sector_type == 'project') {

            $allCostCenters = $this->initRPUHttp()->post(config('cag_rpu_api.cost-center-sector-map.cost-centers'), $data)->json();
            $allCostCenters = $allCostCenters ? $allCostCenters['data'] : [];
            // dd($allCostCenters);
        }

        return view('modules.individual_plan.partial.schedule-modal', compact(['team_layer_id', 'allCostCenters', 'sector_id']));
    }

    public function getAuditScheduleRow(Request $request){
        $data = Validator::make($request->all(), [
            // 'team_layer_id' => 'required|integer',
            'sector_id' => 'required|integer',
            'sector_type' => 'required|string',
        ])->validate();

        $sector_type = $request->sector_type;
        $sector_id = $request->sector_id;
        $team_layer_id = $request->team_layer_id;

        if ($sector_type == 'project') {

            $allCostCenters = $this->initRPUHttp()->post(config('cag_rpu_api.cost-center-sector-map.cost-centers'), $data)->json();
            $allCostCenters = $allCostCenters ? $allCostCenters['data'] : [];
            // dd($allCostCenters);
        }

        return view('modules.individual_plan.partial.schedule-row',
            compact('team_layer_id', 'allCostCenters', 'sector_type', 'sector_id'));
    }

    public function storeAuditTeam(Request $request)
    {
        $data = Validator::make($request->all(), [
            // 'activity_id' => 'required|integer',
            // 'fiscal_year_id' => 'required|integer',
            // 'annual_plan_id' => 'required|integer',
            'yearly_plan_location_id' => 'required|integer',
            // 'strategic_plan_year' => 'required|integer',
            'audit_year_start' => 'required',
            'audit_year_end' => 'required',
            'teams' => 'required',
            'modal_type' => 'nullable',
        ])->validate();

        // dd($request);

        $teams = json_encode_unicode($request->teams);
        $data['teams'] = json_encode(['teams' => json_decode($teams)], JSON_UNESCAPED_UNICODE);
        $data['approve_status'] = 'approved';
        $data['cdesk'] = $this->current_desk_json();

        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.store_audit_team'), $data)->json();

        // dd($responseData);

        if (isSuccess($responseData)) {
            return response()->json(['status' => 'success', 'data' => $responseData['data']]);
        } else {
            return ['status' => 'error', 'data' => $responseData];
        }
    }

    public function storeAuditTeamSchedule(Request $request)
    {
        $data = Validator::make($request->all(), [
            'yearly_plan_location_id' => 'required|integer',
            'team_schedules' => 'required|json',
        ])->validate();


        $data['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.store_audit_team_schedule'), $data)->json();

        // dd($responseData);

        if (isSuccess($responseData)) {
            return response()->json(['status' => 'success', 'data' => $responseData['data']]);
        } else {
            return ['status' => 'error', 'data' => $responseData];
        }
    }

    public function getAnnouncementMemo(Request $request)
    {
        $data = Validator::make($request->all(), [
            'audit_plan_id' => 'required|integer',
            'yearly_plan_location_id' => 'required|integer',
            'sector_type' => 'required|string',
            'sector_id' => 'required|integer',
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();

        // $sectorId = $request->sector_id;
        $sectorType = $request->sector_type;
        $yearly_plan_location_id = $request->yearly_plan_location_id;
        $announcementMemo = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_operational_plan.get_announcement_memo'),$data)->json();
        $announcementMemo = $announcementMemo ? $announcementMemo['data'] : [];

        // dd($announcementMemo['finding']);
        // dd($announcementMemo['yearly_plan_info']);

        return view('modules.individual_plan.partial.announcement-memo-modal', compact('announcementMemo', 'sectorType', 'yearly_plan_location_id'));
    }

    public function downloadAnnouncementMemo(Request $request)
    {
        $data = Validator::make($request->all(), [
            'audit_plan_id' => 'required|integer',
            'yearly_plan_location_id' => 'required|integer',
        ])->validate();
        $data['cdesk'] = $this->current_desk_json();
//         dd($data);

        $announcementMemo = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_operational_plan.get_announcement_memo'),$data)->json();
        $announcementMemo = $announcementMemo ? $announcementMemo['data'] : [];
        // dd($announcementMemo);
        $pdf = Pdf::loadView('modules.individual_plan.partial.download-announcement-memo', ['announcementMemo' => $announcementMemo]);
        // dd($pdf->stream('document.pdf'));

        return $pdf->stream();
        // return $pdf->download('announcement-memo.pdf');

        /*
        if (isSuccess($announcementMemo)) {
            return response()->json(['status' => 'success', 'data' => env('BEE_URL', 'http://localhost:8001').$announcementMemo['data']]);
        } else {
            return ['status' => 'error', 'data' => $announcementMemo];
        }
        */

    }

    public function engagementLetterCreate(Request $request){

        $data = Validator::make($request->all(), [
            'yearly_plan_location_id' => 'required|integer',
            'audit_plan_id' => 'required|integer',
        ])->validate(); 

        return view('modules.individual_plan.partial.engagement_letter',compact('data'));
    }

    public function engagementLetterStore(Request $request){

        // dd($request->all());
        $data = Validator::make($request->all(), [
            'yearly_plan_location_id' => 'required|integer',
            'audit_plan_id' => 'required|integer',
            'letter_to' => 'required|string',
            'subject' => 'required|string',
            'body' => 'required|string',
            'others' => 'required|string',
        ])->validate(); 
        
        $data['cdesk'] = $this->current_desk_json();
        $engagementLetterStore = $this->initHttpWithToken()->post(config('amms_bee_routes.individual_plan.engagement_letter_store'),$data)->json();
    //    dd($engagementLetterStore);
        if (isSuccess($engagementLetterStore)) {
            return response()->json(['status' => 'success', 'data' => $engagementLetterStore['data']]);
        } else {
            return ['status' => 'error', 'data' => $engagementLetterStore];
        }
    }
}
