<?php

namespace App\Http\Controllers\AuditReport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuditQCReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['template_type'] = 'air';
        $data['cdesk'] = $this->current_desk_json();

        $auditReport = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.qc.create_air_report'), $data)->json();
        //dd($auditReport);
        if (isSuccess($auditReport)) {
            $content = $auditReport['data']['content'];

            if ($this->current_office_id() == 19) {
                $directorate_address = 'অডিট কমপ্লেক্স,১ম তলা,সেগুনবাগিচা,ঢাকা-১০০০।';
            } elseif ($this->current_office_id() == 32) {
                $directorate_address = 'অডিট কমপ্লেক্স (নিচ তলা ও ২য় তলা),সেগুনবাগিচা,ঢাকা-১০০০।';
            } else {
                $directorate_address = 'অডিট কমপ্লেক্স (৭ম-৮ম তলা),সেগুনবাগিচা,ঢাকা-১০০০।';
            }

            $cover_info = [
                'directorate_name' => $this->current_office()['office_name_bn'],
                'directorate_address' => $directorate_address,
            ];

            return view('modules.audit_report.qc.index',
                compact('content','cover_info'));
        }
        else {
            return ['status' => 'error', 'data' => $auditReport['data']];
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
