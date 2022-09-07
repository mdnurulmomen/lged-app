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
        // $data = Validator::make($request->all(), [
        //     'psr_plan_id' => 'required|integer',
        //     'annual_plan_id' => 'required|integer'
        // ])->validate();

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
        $psr_plan_id = $request->psr_plan_id;
        $annual_plan_id = $request->annual_plan_id;
        $psr_data = $this->getAuditTemplate('performance','PSR');
        $content = $psr_data['content'];
        // dd($content);

        $cover_info = [
            'directorate_address_footer' => $directorate_address_footer,
            'directorate_address_top' => $directorate_address_top,
            'directorate_website' => $directorate_website
        ];
//            dd($cover_info);
        return view('modules.audit_plan.annual.annual_plan_revised.psr.create_psr', compact('content','psr_plan_id','annual_plan_id', 'cover_info'));

    }

// Save PSR
public function savePSRPlan(Request $request): \Illuminate\Http\JsonResponse
    {
        // Validator::make($request->all(), [
        //     'psr_plan_id' => 'required|integer',
        //     'annual_plan_id' => 'required|integer',
        //     'plan_description' => 'required',
        // ])->validate();

        // if ($request->has('audit_plan_id') && $request->audit_plan_id > 0) {
        //     $data['audit_plan_id'] = $request->audit_plan_id;
        // }
        $data['cdesk'] = $this->current_desk_json();
        // $annual_plan = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_entity_plan.ap_entity_plan_create_draft'), $data)->json();
        // dd($annual_plan);
        // if (isSuccess($annual_plan)) {
        //     $annual_plan_id = $request->annual_plan_id;
        // }
$annual_plan_id = 20;
$data['annual_plan_id'] = $request->annual_plan_id;
        $annual_plan_id = $request->annual_plan_id;
        $plan_no = $request->plan_no;

//        dd($data);

        //$plan_description = json_decode($request->plan_description);
        $data['plan_description'] = makeEncryptedData(gzcompress(json_encode($request->plan_description)));
        $data['status'] = 'approved';
        $data['is_continue'] = $request->is_continue;
        $data['cdesk'] = $this->current_desk_json();
        $save_draft = $this->initHttpWithToken()->post(config('amms_bee_routes.psr_plan.store'), $data)->json();
//        dd($save_draft);
        if (isSuccess($save_draft)) {
            return response()->json(['status' => 'success', 'data' => $save_draft['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $save_draft]);
        }
    }


    public function annualPlanPSRBookPreview(Request $request)
    {
        ini_set("pcre.backtrack_limit", "999999999999");
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 0);

        $scope_editable = $request->scope_editable;
        // $approval_status = $request->approval_status ?? 'pending';
        $psr_plan_id = 180;
        $data['id'] = $psr_plan_id;

        $current_office_id = $this->current_office_id();
        $data['cdesk'] = $this->current_desk_json();

        $data['office_id'] = $request->office_id;

        $ap_plan = $this->initHttpWithToken()->post(config('amms_bee_routes.psr_plan.view'), $data)->json();
        // dd($ap_plan);


        if (isSuccess($ap_plan)) {
            $ap_plan = $ap_plan['data'];

            $plans = json_decode(json_decode(gzuncompress(getDecryptedData($ap_plan['plan_description'])),true),true);
            //dd($plans);

            $pdf = \PDF::loadView('modules.audit_plan.annual.annual_plan_revised.psr.partials.audit_plan_book', ['plans' => $plans], [], ['orientation' => 'P', 'format' => 'A4']);
            $fileName = $current_office_id.'_Plan'.$psr_plan_id.'.pdf';

            Storage::put('public/psrs/'.$fileName, $pdf->output());

            return view('modules.audit_plan.annual.annual_plan_revised.psr.partials.preview_audit_plan',
                compact('plans','psr_plan_id','scope_editable','fileName'));
        }
        else {
            return ['status' => 'error', 'data' => 'Error'];
        }
    }
}
