<?php

namespace App\Http\Controllers\AuditPlan\Calendar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamCalendarController extends Controller
{
    public function index()
    {
        $all_directorates = $this->allAuditDirectorates();

        $fiscal_years = $this->allFiscalYears();

        $self_directorate = current(array_filter($all_directorates, function ($item) {
            return $this->current_office_id() == $item['office_id'];
        }));

        $directorates = $self_directorate ? [$self_directorate] : $all_directorates;

        if (!empty($directorates)) {
            return view('modules.audit_plan.calendar.team_calender', compact('directorates', 'fiscal_years'));
        } else {
            return response()->json(['status' => 'error', 'data' => $directorates]);
        }
    }

    public function loadTeamCalendar(Request $request)
    {
        $data['cdesk'] = json_encode_unicode($this->current_desk());
        $data['office_id'] = $request->directorate_id ?: $this->current_office_id();
        $data['fiscal_year_id'] = $request->fiscal_year_id;

        $calendar_data = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_visit_plan_calendar.team_calendar_list'), $data)->json();
//        dd($calendar_data);
        if (isSuccess($calendar_data)) {
            $calendar_data = $calendar_data['data'];
            return view('modules.audit_plan.calendar.load_team_calendar', compact('calendar_data'));
        } else {
            return response()->json(['status' => 'error', 'data' => $calendar_data]);
        }
    }

    public function loadTeamsSelect(Request $request)
    {
        $data['office_id'] = $request->directorate_id;
        $data['fiscal_year_id'] = $request->fiscal_year_id;

        $team_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_visit_plan_calendar.get_fiscal_year_wise_team'), $data)->json();
        if (isSuccess($team_list)) {
            $team_list = $team_list['data'];
            return view('modules.audit_plan.calendar.team_select', compact('team_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $team_list]);
        }
    }

    public function loadSubTeamSelect(Request $request)
    {
        $data['office_id'] = $request->directorate_id;
        $data['fiscal_year_id'] = $request->fiscal_year_id;
        $data['team_id'] = $request->team_id;
        $data['cdesk'] = json_encode_unicode($this->current_desk());

        $sub_team_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_visit_plan_calendar.get_sub_team'), $data)->json();
//        dd($sub_team_list);
        if (isSuccess($sub_team_list)) {
            $sub_team_list = $sub_team_list['data'];
            return view('modules.audit_plan.calendar.sub_team_select', compact('sub_team_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $sub_team_list]);
        }
    }

    public function loadScheduleEntityFiscalYearWiseSelect(Request $request){
        $data['office_id'] = $request->directorate_id;
        $data['fiscal_year_id'] = $request->fiscal_year_id;

        $entity_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_visit_plan_calendar.get_schedule_entity_fiscal_year_wise'), $data)->json();
//        dd($entity_list);
        if (isSuccess($entity_list)) {
            $entity_list = $entity_list['data'];
            return view('modules.audit_plan.calendar.entity_select', compact('entity_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $entity_list]);
        }
    }

    public function loadCostCenterDirectorateFiscalYearWiseSelect(Request $request){
        $data['office_id'] = $request->directorate_id;
        $data['fiscal_year_id'] = $request->fiscal_year_id;
        $data['entity_id'] = $request->entity_id;

        $cost_center_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_visit_plan_calendar.get_cost_center_directorate_fiscal_year_wise'), $data)->json();
        if (isSuccess($cost_center_list)) {
            $cost_center_list = $cost_center_list['data'];
            return view('modules.audit_plan.calendar.cost_center_select', compact('cost_center_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $cost_center_list]);
        }
    }

    public function loadTeamCalendarFilter(Request $request)
    {
        $data['cdesk'] = json_encode_unicode($this->current_desk());
        $data['office_id'] = $request->directorate_id;
        $data['team_id'] = $request->team_id;
        $data['fiscal_year_id'] = $request->fiscal_year_id;
        $data['cost_center_id'] = $request->cost_center_id;
//        dd($data);
        $calendar_data = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_visit_plan_calendar.team_calender_filter'), $data)->json();
//        dd($calendar_data);
        if (isSuccess($calendar_data)) {
            $calendar_data = $calendar_data['data'];
            $team_id = $request->team_id;
            $cost_center_id = $request->cost_center_id;
            return view('modules.audit_plan.calendar.load_team_filter_calendar', compact('calendar_data', 'team_id','cost_center_id'));
        } else {
            return response()->json(['status' => 'error', 'data' => $calendar_data]);
        }
    }

    public function loadTeamCalendarScheduleList(Request $request)
    {
        $data['cdesk'] = json_encode_unicode($this->current_desk());
        $data['office_id'] = $request->directorate_id;
        $data['team_id'] = $request->team_id;
        $data['fiscal_year_id'] = $request->fiscal_year_id;
        $data['cost_center_id'] = $request->cost_center_id;
//        dd($data);

        $calendar_data = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_visit_plan_calendar.team_calender_schedule_list'), $data)->json();
//        dd($calendar_data);
        if (isSuccess($calendar_data)) {
            $calendar_data = $calendar_data['data'];
            $team_id = $request->team_id;
            $cost_center_id = $request->cost_center_id;
            return view('modules.audit_plan.calendar.individual_calender', compact('calendar_data', 'team_id','cost_center_id'));
        } else {
            return response()->json(['status' => 'error', 'data' => $calendar_data]);
        }
    }

    public function updateVisitCalenderStatus(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = Validator::make($request->all(), [
            'schedule_id' => 'required|integer',
            'status' => 'required|string',
        ])->validate();

        $data['cdesk'] = json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE);

        $updateStatus = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_visit_plan_calendar.update_visit_calender_status'), $data)->json();
        if (isSuccess($updateStatus)) {
            return response()->json(['status' => 'success', 'data' => 'Status Update Successfully']);
        } else {
            return response()->json(['status' => 'error', 'data' => $updateStatus]);
        }
    }
}
