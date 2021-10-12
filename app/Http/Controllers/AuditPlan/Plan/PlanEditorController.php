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
            'activity_id' => 'required|integer',
            'annual_plan_id' => 'required|integer',
            'fiscal_year_id' => 'required|integer',
            'audit_plan_id' => 'required|integer',
            'parent_office_id' => 'required|integer',
        ])->validate();

        $activity_id = $request->activity_id;
        $annual_plan_id = $request->annual_plan_id;
        $fiscal_year_id = $request->fiscal_year_id;
        $audit_plan_id = $request->audit_plan_id;
        $parent_office_id = $request->parent_office_id;
        $own_office = ['name' => $this->current_office()['office_name_bn'], 'id' => $this->current_office()['id']];
//        $officer_lists = $this->cagDoptorOfficeUnitDesignationEmployees($this->current_office_id());
        $other_offices = $this->cagDoptorOtherOffices($this->current_office_id());

        //for all team data
        $data['cdesk'] = json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE);
        $teamResponseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.get_audit_plan_wise_team'), $data)->json();


        $nominated_offices = $this->initRPUHttp()->post(config('cag_rpu_api.get-parent-with-child-office'), $data)->json();
        $nominated_offices_list = isSuccess($nominated_offices)?$nominated_offices['data']:[];
        $nominated_offices_list = !empty($nominated_offices_list)?array_key_exists('child_offices',$nominated_offices_list)?$nominated_offices_list['child_offices']:[$nominated_offices_list['parent_office']]:[];

        $all_teams = isSuccess($teamResponseData) ? $teamResponseData['data'] : [];

        return view('modules.modal.load_team_modal', compact(
            'activity_id',
            'annual_plan_id',
            'fiscal_year_id',
            'audit_plan_id',
            'own_office',
            'all_teams',
            'other_offices',
            'nominated_offices_list',
            'parent_office_id'
        ));
    }

    public function loadOfficeEmployeeList(Request $request)
    {
        Validator::make($request->all(), ['office_id' => 'integer|required'])->validate();

        $office_id = $request->office_id ? $request->office_id : $this->current_office_id();

        $officer_lists = $this->cagDoptorOfficeUnitDesignationEmployees($office_id);

        $office_type = $request->office_type;

        return view('modules.audit_plan.audit_plan.plan_revised.partials.load_officer_list_dnd_tree', compact('officer_lists','office_type'));
    }

    public function loadAuditTeamSchedule(Request $request)
    {
        $data = Validator::make($request->all(), [
            'annual_plan_id' => 'required|integer',
            'parent_office_id' => 'required|integer',
        ])->validate();

        $data['cdesk'] = json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE);
        $nominated_offices = $this->initRPUHttp()->post(config('cag_rpu_api.get-parent-with-child-office'), $data)->json();
        $nominated_offices_list = isSuccess($nominated_offices)?$nominated_offices['data']:[];
        $nominated_offices_list = !empty($nominated_offices_list)?array_key_exists('child_offices',$nominated_offices_list)?$nominated_offices_list['child_offices']:[$nominated_offices_list['parent_office']]:[];

        $team_layer_id = $request->team_layer_id;
        return view('modules.audit_plan.audit_plan.plan_revised.partials.load_team_schedule',
            compact('team_layer_id', 'nominated_offices_list'));
    }
}
