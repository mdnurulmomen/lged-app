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

        $calendar_data = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_visit_plan_calendar.individual_calendar_list'), $data)->json();

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

        $team_list = $this->initHttpWithToken()->post(config('amms_bee_routes.mis_and_dashboard.get_fiscal_year_wise_team'), $data)->json();
        if (isSuccess($team_list)) {
            $team_list = $team_list['data'];
            return view('modules.audit_plan.calendar.team_select', compact('team_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $team_list]);
        }
    }

    public function loadTeamCalendarFilter(Request $request)
    {
        $data['cdesk'] = json_encode_unicode($this->current_desk());
        $data['office_id'] = $request->directorate_id;
        $data['team_id'] = $request->team_id;
        $data['fiscal_year_id'] = $request->fiscal_year_id;

        $calendar_data = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_visit_plan_calendar.team_calender_filter'), $data)->json();
        if (isSuccess($calendar_data)) {
            $calendar_data = $calendar_data['data'];
            $team_id = $request->team_id;
            return view('modules.audit_plan.calendar.load_team_filter_calendar', compact('calendar_data', 'team_id'));
        } else {
            return response()->json(['status' => 'error', 'data' => $calendar_data]);
        }
    }


    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $data['cdesk'] = json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE);
        $calendar_data_store = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_visit_plan_calendar.individual_calendar_create'), $data)->json();
        if (isSuccess($calendar_data_store)) {
            return response()->json(['status' => 'error', 'data' => 'Successfully saved!']);
        } else {
            return response()->json(['status' => 'error', 'data' => $calendar_data_store]);
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
