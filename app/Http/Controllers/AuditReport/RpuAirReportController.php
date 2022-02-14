<?php

namespace App\Http\Controllers\AuditReport;

use App\Http\Controllers\Controller;
use App\Services\FireNotificationServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RpuAirReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function airSendToRpu(Request $request)
    {
        $data = Validator::make($request->all(), [
            'air_id' => 'required',
            'entity_ids' => 'required',
            'report_name' => 'required'
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();
        $airSendToRpu = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.air_send_to_rpu'), $data)->json();
        //dd($airSendToRpu);
        if (isSuccess($airSendToRpu)) {

            $mail_data = [
                'entity_ids' => $request->entity_ids,
                'report_name' => $request->report_name,
                'directorate_name_en' => $this->current_office()['office_name_en'],
                'notifiable_type' => 'air',
            ];
            $send_mail_to_rpu = (new FireNotificationServices())->sendMailToRpu($mail_data);

            return response()->json(['status' => 'success', 'data' => 'AIR has been sent to RPU successfully']);
        } else {
            return response()->json(['status' => 'error', 'data' => $airSendToRpu]);
        }
    }
}
