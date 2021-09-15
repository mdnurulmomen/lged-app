<?php

namespace App\Http\Controllers\AuditPlan\Calendar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Request;

class IndividualCalendarController extends Controller
{
    public function index()
    {
        $data['cdesk'] = json_encode($this->current_desk());
        $calendar_data = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_visit_plan_calendar.individual_calendar_list'), $data)->json();

        if (isSuccess($calendar_data)) {
            $calendar_data = $calendar_data['data'];
            return view('modules.audit_plan.calendar.index', compact('calendar_data'));
        } else {
            return response()->json(['status' => 'error', 'data' => $calendar_data['data']]);
        }
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $data['cdesk'] = json_encode($this->current_desk());
        $calendar_data_store = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_visit_plan_calendar.individual_calendar_create'), $data)->json();
        if (isSuccess($calendar_data_store)) {
            return response()->json(['status' => 'error', 'data' => 'Successfully saved!']);
        } else {
            return response()->json(['status' => 'error', 'data' => $calendar_data_store['data']]);
        }
    }
}
