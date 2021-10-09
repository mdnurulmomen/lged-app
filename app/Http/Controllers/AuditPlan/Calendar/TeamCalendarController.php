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

        $self_directorate = current(array_filter($all_directorates, function ($item) {
            return $this->current_office_id() == $item['office_id'];
        }));

        $directorates = $self_directorate ? [$self_directorate] : $all_directorates;

        if (!empty($directorates)) {
            return view('modules.audit_plan.calendar.team_calender', compact('directorates'));
        } else {
            return response()->json(['status' => 'error', 'data' => $directorates]);
        }
    }

    public function loadTeams(Request $request): \Illuminate\Http\JsonResponse
    {
        $data['cdesk'] = json_encode_unicode($this->current_desk());
        $data['office_id'] = $request->office_id;

        $calendar_data = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_visit_plan_calendar.individual_calendar_list'), $data)->json();
        if (isSuccess($calendar_data)) {
            return response()->json(['status' => 'success', 'data' => $calendar_data['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $calendar_data['data']]);
        }
    }

    public function loadTeamCalendar(Request $request)
    {
        $data['cdesk'] = json_encode_unicode($this->current_desk());
        $data['office_id'] = $request->office_id;
        $data['team_id'] = $request->team_id;

        $calendar_data = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_visit_plan_calendar.individual_calendar_list'), $data)->json();
        if (isSuccess($calendar_data)) {
            $calendar_data = $calendar_data['data'];
            return view('modules.audit_plan.calendar.load_team_calendar', compact('calendar_data'));
        } else {
            return response()->json(['status' => 'error', 'data' => $calendar_data['data']]);
        }
    }


    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $data['cdesk'] = json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE);
        $calendar_data_store = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_visit_plan_calendar.individual_calendar_create'), $data)->json();
        if (isSuccess($calendar_data_store)) {
            return response()->json(['status' => 'error', 'data' => 'Successfully saved!']);
        } else {
            return response()->json(['status' => 'error', 'data' => $calendar_data_store['data']]);
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
            return response()->json(['status' => 'error', 'data' => $updateStatus['data']]);
        }
    }
}
