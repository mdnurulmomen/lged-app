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
    public function loadAuditTeamModal(Request $request)
    {
        $data = Validator::make($request->all(), [
            'audit_plan_id' => 'required|integer',
            'yearly_plan_location_id' => 'required|integer',
            'sector_type' => 'required|string',
            'sector_id' => 'required|integer',
        ])->validate();

//        dd($data);

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

        $yearly_plan_location_id = $request->yearly_plan_location_id;
        $sector_type = $request->sector_type;
        $sector_id = $request->sector_id;

        $own_office = ['name' => $this->current_office()['office_name_bn'], 'id' => $this->current_office()['id']];
        $other_offices = $this->cagDoptorOtherOffices($this->current_office_id());

        //for all team data
        $cdesk = $this->current_desk_json();
        $data['cdesk'] = $cdesk;
        $teamResponseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.get_audit_plan_wise_team'), $data)->json();
        $all_teams = isSuccess($teamResponseData) ? $teamResponseData['data'] : [];

//        dd($all_teams);

        return view('modules.modal.load_team_modal', compact(
            'activity_id',
            'annual_plan_id',
            'fiscal_year_id',
            'audit_plan_id',
            'own_office',
            'all_teams',
            'other_offices',
            'parent_office_id',
            'modal_type',
            'has_update_office_order',
            'office_order_approval_status',
            'project_id',
            'audit_plan_no',
            'yearly_plan_location_id',
            'sector_type',
            'sector_id',
        ));
    }

    public function loadNominatedOfficesSelectView(Request $request)
    {
        $getParentWithChildOfficePassData['parent_office_id'] = $request->parent_office_id;
        $getParentWithChildOfficePassData['ministry_id'] = $request->ministry_id;

        if($request->project_id){
            $nominated_offices = $this->initRPUHttp()->post(config('cag_rpu_api.get-project-wise-nominated-cost-center-list'), $getParentWithChildOfficePassData)->json();
        }else{
            $nominated_offices = $this->initRPUHttp()->post(config('cag_rpu_api.get-parent-with-child-office'), $getParentWithChildOfficePassData)->json();
        }

        $nominated_offices_list = isSuccess($nominated_offices) ? $nominated_offices['data'] : [];
        $nominated_offices_list = !empty($nominated_offices_list) ? !empty($nominated_offices_list['child_offices']) ? $nominated_offices_list['child_offices'] : [$nominated_offices_list['parent_office']] : [];
        $layer_id = $request->layer_id;
        $total_audit_schedule_row = $request->total_audit_schedule_row;
        return view('modules.audit_plan.audit_plan.plan_revised.partials.select_nominated_offices', compact('nominated_offices_list', 'layer_id', 'total_audit_schedule_row'));
    }

    public function getEntityWiseCosCenterAutoComplete(Request $request){
        $data['sector_id'] = $request->sector_id;
        $data['sector_type'] = $request->sector_type;
        $data['project_id'] = $request->project_id;
        $data['parent_office_id'] = $request->parent_office_id;
        $data['cost_center_name_bn'] = $request->cost_center_name_bn;

        if($request->sector_id){
            $nominated_offices = $this->initRPUHttp()->post(config('cag_rpu_api.get-project-map-cos-center-autoselect'), $data)->json();
        }else{
            $nominated_offices = $this->initRPUHttp()->post(config('cag_rpu_api.get-office-by-parent-office-autoselect'), $data)->json();
        }

//        dd($nominated_offices);

        return isSuccess($nominated_offices) ? $nominated_offices['data'] : [];

    }

    public function loadNominatedOfficesSelectOption(Request $request)
    {
        $getParentWithChildOfficePassData['parent_office_id'] = $request->parent_office_id;
        $nominated_offices = $this->initRPUHttp()->post(config('cag_rpu_api.get-parent-with-child-office'), $getParentWithChildOfficePassData)->json();
        $nominated_offices_list = isSuccess($nominated_offices) ? $nominated_offices['data'] : [];
        $nominated_offices_list = !empty($nominated_offices_list) ? !empty($nominated_offices_list['child_offices']) ? $nominated_offices_list['child_offices'] : [$nominated_offices_list['parent_office']] : [];
        return view('modules.audit_plan.audit_plan.plan_revised.partials.nominated_office_option', compact('nominated_offices_list'));
    }

    public function loadOfficeEmployeeList(Request $request)
    {
        Validator::make($request->all(), ['office_id' => 'integer|required'])->validate();

        $office_id = $request->office_id ?: $this->current_office_id();

        $officer_lists = $this->cagDoptorOfficeUnitDesignationEmployees($office_id);

        $office_type = $request->office_type;

        return view('modules.audit_plan.audit_plan.plan_revised.partials.load_officer_list_dnd_tree', compact('officer_lists', 'office_type'));
    }

    public function loadAuditTeamSchedule(Request $request)
    {
        $data = Validator::make($request->all(), [
            'team_layer_id' => 'required|integer',
            'sector_id' => 'required|integer',
            'sector_type' => 'required|string',
        ])->validate();

//     dd($data);

        // $data['cdesk'] = $this->current_desk_json();

        $sector_type = $request->sector_type;
        $sector_id = $request->sector_id;
        $allCostCenters = [];
        if ($sector_type == 'project') {
            $allCostCenters = $this->initRPUHttp()->post(config('cag_rpu_api.cost-center-sector-map.cost-centers'), $data)->json();
            $allCostCenters = $allCostCenters ? $allCostCenters['data'] : [];
        }

        $team_layer_id = $request->team_layer_id;
        $parent_office_id = $request->parent_office_id;
        $modal_type = $request->modal_type;
        $project_id = $request->project_id;
        return view('modules.audit_plan.audit_plan.plan_revised.partials.load_team_schedule',
            compact('team_layer_id','parent_office_id','modal_type','project_id','allCostCenters','sector_id','sector_type'));
    }

    public function addAuditScheduleRow(Request $request){
        $schedule_type = $request->schedule_type;
        $layer_id = $request->layer_id;
        $total_audit_schedule_row = $request->total_audit_schedule_row;
        $entity_list = $request->entity_list;
        $project_id = $request->project_id;
        $sector_id = $request->sector_id;
        $sector_type = $request->sector_type;
        return view('modules.audit_plan.audit_plan.plan_revised.partials.add_audit_schedule_row',
            compact('schedule_type','layer_id','total_audit_schedule_row','entity_list','project_id','sector_id','sector_type'));
    }
}
