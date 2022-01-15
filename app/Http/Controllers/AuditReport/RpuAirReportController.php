<?php

namespace App\Http\Controllers\AuditReport;

use App\Http\Controllers\Controller;
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
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();
        $airSendToRpu = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.air_send_to_rpu'), $data)->json();
        //dd($airSendToRpu);
        if (isSuccess($airSendToRpu)) {
            return response()->json(['status' => 'success', 'data' => 'AIR has been sent to RPU successfully']);
        } else {
            return response()->json(['status' => 'error', 'data' => $airSendToRpu]);
        }
    }
}
