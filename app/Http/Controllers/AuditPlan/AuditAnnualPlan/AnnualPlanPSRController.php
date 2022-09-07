<?php

namespace App\Http\Controllers\AuditPlan\AuditAnnualPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AnnualPlanPSRController extends Controller
{
    public function create(Request $request)
    {
        $data['cdesk'] = $this->current_desk_json();
        if ($this->current_office_id() == 14) {
            $directorate_address_footer = 'অডিট কমপ্লেক্স,৩য় তলা,সেগুনবাগিচা,ঢাকা-১০০০।';
            $directorate_address_top = 'অডিট কমপ্লেক্স (৩য় তলা) <br> সেগুনবাগিচা,ঢাকা-১০০০।';
            $directorate_website = 'www.worksaudit.org.bd';
        } elseif ($this->current_office_id() == 3) {
            $directorate_address_footer = 'অডিট কমপ্লেক্স,২য় তলা,সেগুনবাগিচা,ঢাকা-১০০০।';
            $directorate_address_top = 'অডিট কমপ্লেক্স (২য় তলা) <br> সেগুনবাগিচা,ঢাকা-১০০০।';
            $directorate_website = 'www.dgcivil-cagbd.org';
        } elseif ($this->current_office_id() == 2) {
            $directorate_address_footer = 'অডিট কমপ্লেক্স,৮ম তলা,সেগুনবাগিচা,ঢাকা-১০০০।';
            $directorate_address_top = 'অডিট কমপ্লেক্স (৮ম তলা) <br> সেগুনবাগিচা,ঢাকা-১০০০।';
            $directorate_website = 'www.cad.org.bd';
        } else {
            $directorate_address_footer = '';
            $directorate_address_top = '';
            $directorate_website = '';
        }

        $annual_plan_id = $request->annual_plan_id;
        $fiscal_year_id = $request->fiscal_year_id;
        $activity_id = $request->activity_id;
        $psr_data = $this->getAuditTemplate('performance','PSR');
        $content = $psr_data['content'];
        // dd($content);

        $cover_info = [
            'directorate_address_footer' => $directorate_address_footer,
            'directorate_address_top' => $directorate_address_top,
            'directorate_website' => $directorate_website
        ];

        return view('modules.audit_plan.annual.annual_plan_revised.psr.create_psr',
            compact('content','annual_plan_id','fiscal_year_id','activity_id','cover_info'));
    }

    // Save PSR
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
         $data = Validator::make($request->all(), [
             'psr_plan_id' => 'nullable',
             'annual_plan_id' => 'required',
             'fiscal_year_id' => 'required',
             'activity_id' => 'required',
             'plan_description' => 'required',
         ])->validate();

        $data['cdesk'] = $this->current_desk_json();
        $data['plan_description'] = makeEncryptedData(gzcompress(json_encode($request->plan_description)));
        $data['status'] = 'draft';

        $response = $this->initHttpWithToken()->post(config('amms_bee_routes.psr_plan.store'), $data)->json();
        //dd($response);
        if (isSuccess($response)) {
            return response()->json(['status' => 'success', 'data' => $response['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $response]);
        }
    }


    public function preview(Request $request)
    {
        ini_set("pcre.backtrack_limit", "999999999999");
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 0);

        $scope_editable = $request->scope_editable;
        $psr_plan_id = $request->psr_plan_id;
        $data['psr_plan_id'] = $psr_plan_id;
        $data['cdesk'] = $this->current_desk_json();
        $ap_plan = $this->initHttpWithToken()->post(config('amms_bee_routes.psr_plan.view'), $data)->json();

        if (isSuccess($ap_plan)) {
            $ap_plan = $ap_plan['data'];
            $plans = json_decode(json_decode(gzuncompress(getDecryptedData($ap_plan['plan_description'])),true),true);
            //dd($plans[1]['content']);
            $current_office_id = $this->current_office_id();
            $pdf = \PDF::loadView('modules.audit_plan.annual.annual_plan_revised.psr.partials.psr_plan_book', ['plans' => $plans], [], ['orientation' => 'P', 'format' => 'A4']);
            $fileName = $current_office_id.'_Plan'.$psr_plan_id.'.pdf';

            Storage::put('public/psrs/'.$fileName, $pdf->output());

            return view('modules.audit_plan.annual.annual_plan_revised.psr.partials.preview_psr_plan',
                compact('fileName'));
        }
        else {
            return ['status' => 'error', 'data' => 'Error'];
        }
    }
}
