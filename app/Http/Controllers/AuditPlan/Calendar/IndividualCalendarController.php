<?php

namespace App\Http\Controllers\AuditPlan\Calendar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndividualCalendarController extends Controller
{
    public function index()
    {
        $data['cdesk'] = json_encode($this->current_desk(), JSON_UNESCAPED_UNICODE);
        $calendar_data = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_visit_plan_calendar.individual_calendar_list'), $data)->json();
//        dd($calendar_data);
        $office_admin = 0;
        if (isSuccess($calendar_data)) {
            $calendar_data = $calendar_data['data'];
            return view('modules.audit_plan.calendar.team_calender', compact('calendar_data'));
//            if($office_admin){
//                return view('modules.audit_plan.calendar.team_calender', compact('calendar_data'));
//            }else{
//                return view('modules.audit_plan.calendar.index', compact('calendar_data'));
//            }

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

    public function updateVisitCalenderStatus(Request $request)
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
