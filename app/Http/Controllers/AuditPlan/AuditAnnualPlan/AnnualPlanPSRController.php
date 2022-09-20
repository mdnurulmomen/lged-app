<?php

namespace App\Http\Controllers\AuditPlan\AuditAnnualPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AnnualPlanPSRController extends Controller
{
    public function index(Request $request)
    {
        $office_id = $this->current_office_id();
        $all_directorates = $this->allAuditDirectorates();
        $self_directorate = current(array_filter($all_directorates, function ($item) {
            return $this->current_office_id() == $item['office_id'];
        }));
        $directorates = $self_directorate ? [$self_directorate] : $all_directorates;
        $fiscal_years = $this->allFiscalYears();
        return view('modules.audit_plan.annual.annual_plan_revised.psr.psr_annual_plan_lists', compact('office_id', 'directorates', 'fiscal_years'));
    }

    public function create(Request $request)
    {
        $annual_plan_id = $request->annual_plan_id;
        $fiscal_year_id = $request->fiscal_year_id;
        $activity_id = $request->activity_id;
        $psr_data = $this->getAuditTemplate('performance', 'PSR');
        $content = $psr_data['content'];

        $data['annual_plan_id'] = $annual_plan_id;
        $data['fiscal_year_id'] = $fiscal_year_id;
        $data['op_audit_calendar_event_id'] = $activity_id;
        $data['cdesk'] = $this->current_desk_json();
        $annual_plan = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.get_annual_plan_info'), $data)->json();
        $annual_plan = isSuccess($annual_plan) ? $annual_plan['data'] : [];
        return view('modules.audit_plan.annual.annual_plan_revised.psr.create',compact('content', 'annual_plan_id', 'fiscal_year_id', 'activity_id','annual_plan'));
    }

    // Save PSR
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = Validator::make($request->all(), [
            //  'psr_plan_id' => '1',
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

    public function sendPsrTopicToOcag(Request $request){

        $data = Validator::make($request->all(), [
            'annual_plan_main_id' => 'required',
            'fiscal_year_id' => 'required',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();

        $data['annual_plan_ids'] = $request->psr_list;

//        dd($data);

        $response = $this->initHttpWithToken()->post(config('amms_bee_routes.psr_plan.send_psr_to_ocag'), $data)->json();

        if (isSuccess($response)) {
            return response()->json(['status' => 'success', 'data' => $response['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $response]);
        }
    }

    public function sendPsrReportToOcag(Request $request){

        $data = Validator::make($request->all(), [
            'psr_id' => 'required',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();

        $data['status'] = 'pending';
        $data['is_sent_cag'] = 1;

        $response = $this->initHttpWithToken()->post(config('amms_bee_routes.psr_plan.update'), $data)->json();

        if (isSuccess($response)) {
            return response()->json(['status' => 'success', 'data' => $response['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $response]);
        }
    }

    public function psrTopicApproval(){
        $office_id = $this->current_office_id();
        $all_directorates = $this->allAuditDirectorates();
        $self_directorate = current(array_filter($all_directorates, function ($item) {
            return $this->current_office_id() == $item['office_id'];
        }));
        $directorates = $self_directorate ? [$self_directorate] : $all_directorates;
        $fiscal_years = $this->allFiscalYears();
        return view('modules.audit_plan.annual.annual_plan_revised.psr.psr_topic_approval', compact('office_id', 'directorates', 'fiscal_years'));
    }

    public function getPsrTopicApprovalList(Request $request){

        $data = Validator::make($request->all(), [
            'office_id' => 'required',
            'fiscal_year_id' => 'required',
        ])->validate();

        $data['activity_type'] = 'performance';

        $psr_approval_list = $this->initHttpWithToken()->post(config('amms_bee_routes.psr_plan.get_psr_approval_list'), $data)->json();
//        dd($psr_approval_list);
        if (isSuccess($psr_approval_list)) {
            $psr_approval_list = $psr_approval_list['data'];
            return view('modules.audit_plan.annual.annual_plan_revised.psr.psr_approval_list', compact('psr_approval_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $psr_approval_list]);
        }

    }

    public function approvePsrTopic(Request $request){

        $data = Validator::make($request->all(), [
            'office_id' => 'required',
            'annual_plan_id' => 'required',
            'fiscal_year_id' => 'required',
        ])->validate();

//        dd($data);

        $data['cdesk'] = $this->current_desk_json();

        $response = $this->initHttpWithToken()->post(config('amms_bee_routes.psr_plan.approve_psr_topic'), $data)->json();

        if (isSuccess($response)) {
            return response()->json(['status' => 'success', 'data' => $response['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $response]);
        }
    }

    public function getPsrReprotApprovalList(Request $request){

        $data = Validator::make($request->all(), [
            'office_id' => 'required',
            'fiscal_year_id' => 'required',
        ])->validate();

        $psr_approval_list = $this->initHttpWithToken()->post(config('amms_bee_routes.psr_plan.get_psr_report_approval_list'), $data)->json();
//        dd($psr_approval_list);
        if (isSuccess($psr_approval_list)) {
            $psr_approval_list = $psr_approval_list['data'];
            return view('modules.audit_plan.annual.annual_plan_revised.psr.psr_report_approval_list', compact('psr_approval_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $psr_approval_list]);
        }

    }

    public function psrReportApproval(){
        $office_id = $this->current_office_id();
        $all_directorates = $this->allAuditDirectorates();
        $self_directorate = current(array_filter($all_directorates, function ($item) {
            return $this->current_office_id() == $item['office_id'];
        }));
        $directorates = $self_directorate ? [$self_directorate] : $all_directorates;
        $fiscal_years = $this->allFiscalYears();
        return view('modules.audit_plan.annual.annual_plan_revised.psr.psr_report_approval', compact('office_id', 'directorates', 'fiscal_years'));
    }

    public function approvePsrReport(Request $request){

        $data = Validator::make($request->all(), [
            'office_id' => 'required',
            'psr_id' => 'required',
        ])->validate();

        $data['office_approval_status'] = 'approved';

//        dd($data);

        $data['cdesk'] = $this->current_desk_json();

        $response = $this->initHttpWithToken()->post(config('amms_bee_routes.psr_plan.update'), $data)->json();

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
        $office_approval_status = $request->office_approval_status;
        $data['psr_plan_id'] = $psr_plan_id;
        $data['office_id'] = $request->office_id;
        $data['cdesk'] = $this->current_desk_json();

//        dd($data);

        $ap_plan = $this->initHttpWithToken()->post(config('amms_bee_routes.psr_plan.view'), $data)->json();

        if (isSuccess($ap_plan)) {
            $ap_plan = $ap_plan['data'];
            $plans = json_decode(json_decode(gzuncompress(getDecryptedData($ap_plan['plan_description'])), true), true);
            //dd($plans[1]['content']);
            $current_office_id = $this->current_office_id();
            $pdf = \PDF::loadView('modules.audit_plan.annual.annual_plan_revised.psr.partials.psr_plan_book', ['plans' => $plans], [], ['orientation' => 'P', 'format' => 'A4']);
            $fileName = $current_office_id . '_PSR_Plan_' . $psr_plan_id . '.pdf';

            Storage::put('public/psrs/' . $fileName, $pdf->output());

            return view('modules.audit_plan.annual.annual_plan_revised.psr.partials.preview_psr_plan',
                compact('fileName','scope_editable','psr_plan_id','office_approval_status'));
        } else {
            return ['status' => 'error', 'data' => 'Error'];
        }
    }


    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function edit(Request $request)
    {
        $data = Validator::make($request->all(), [
            'psr_plan_id' => 'required|integer',
        ])->validate();

        $psr_plan_id = $request->psr_plan_id;
        $data['psr_plan_id'] = $psr_plan_id;
        $data['cdesk'] = $this->current_desk_json();
        $ap_plan = $this->initHttpWithToken()->post(config('amms_bee_routes.psr_plan.view'), $data)->json();
        //dd($ap_plan);
        if (isSuccess($ap_plan)) {
            $ap_plan = $ap_plan['data'];
            $psr_plan_id= $ap_plan['id'];
            $activity_id= $ap_plan['activity_id'];
            $fiscal_year_id= $ap_plan['fiscal_year_id'];
            $annual_plan_id= $ap_plan['annual_plan_id'];
            $content = json_decode(gzuncompress(getDecryptedData($ap_plan['plan_description'])),true);
            //dd($content);
            return view('modules.audit_plan.annual.annual_plan_revised.psr.edit', compact('psr_plan_id','activity_id','fiscal_year_id','annual_plan_id','content'));
        } else {
            return ['status' => 'error', 'data' => $ap_plan['data']];
        }
    }

    public function loadPsrApporvalAuthority(Request $request)
    {
        $psr_approval_type = $request->psr_approval_type;
        $officeId = config('cag_amms_config.ocag_office_id');
        $fiscal_year_id = $request->fiscal_year_id;
        $annual_plan_id = $request->annual_plan_id;
        $officer_lists = $this->cagDoptorOfficeUnitDesignationEmployees($officeId);
//        dd($officer_lists);
//        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_annual_plan_revised.get_current_desk_approval_authority'), $data)->json();
//        $current_desk_approval_authority = isSuccess($responseData) ? $responseData['data'] : [];
        return view(
            'modules.audit_plan.annual.annual_plan_revised.psr.partials.psr_approval_authority',
            compact(
                'officeId',
                'fiscal_year_id',
                'officer_lists',
                'psr_approval_type',
                'annual_plan_id',
            )
        );
    }

    public function sendPsrSenderToReceiver(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $data = Validator::make($request->all(), [
                'psr_approval_type' => 'required|string',
                'fiscal_year_id' => 'required|integer',
                'receiver_type' => 'required',
                'receiver_office_id' => 'required',
                'receiver_office_name_en' => 'required',
                'receiver_office_name_bn' => 'required',
                'receiver_unit_id' => 'required',
                'receiver_unit_name_en' => 'required',
                'receiver_unit_name_bn' => 'required',
                'receiver_officer_id' => 'required',
                'receiver_name_en' => 'required',
                'receiver_name_bn' => 'required',
                'receiver_designation_id' => 'required',
                'receiver_designation_en' => 'required',
                'receiver_designation_bn' => 'required',
            ])->validate();

//            dd($data);

            $data['psr_list'] = explode(',',$request->psr_list);
            $data['status'] = 'pending';
            $data['comments'] = $request->comments;
            $data['cdesk'] = $this->current_desk_json();

            $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.psr_plan.send_psr_sender_to_receiver'), $data)->json();
//            dd($responseData);
            if (isSuccess($responseData)) {
                return response()->json(['status' => 'success', 'data' => 'Added!']);
            } else {
                return response()->json(['status' => 'error', 'data' => $responseData]);
            }
        } catch (ValidationException $exception) {
            return response()->json([
                'status' => 'error',
                'msg' => $exception->errors(),
                'statusCode' => '422',
            ]);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'data' => $exception->getMessage()]);
        }
    }

    public function laodPsrApprovalForm(Request $request)
    {
        $fiscal_year_id = $request->fiscal_year_id;
        $annual_plan_id = $request->annual_plan_id;
        $office_id = $request->office_id;
        $psr_approval_type = $request->psr_approval_type;

        return view('modules.audit_plan.annual.annual_plan_revised.psr.partials.psr_approval_form',
            compact('fiscal_year_id','office_id','psr_approval_type','annual_plan_id'));
    }

    public function sendPsrReceiverToSender(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
//            dd($request->all());
            $data = Validator::make($request->all(), [
                'fiscal_year_id' => 'required|integer',
                'annual_plan_id' => 'required|integer',
                'office_id' => 'required|integer',
                'psr_approval_type' => 'required|string',
                'receiver_type' => 'required',
                'status' => 'required',
            ],[
                'status.required' => 'স্ট্যাটাস বাছাই করুন'
            ])->validate();

//            dd($data);

            $data['comments'] = $request->comments;
            $data['cdesk'] = $this->current_desk_json();


            $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.psr_plan.send_psr_receiver_to_sender'), $data)->json();
//            dd($responseData);
            if (isSuccess($responseData)) {
                return response()->json(['status' => 'success', 'data' => 'Added!']);
            } else {
                return response()->json(['status' => 'error', 'data' => $responseData]);
            }

        } catch (ValidationException $exception) {
            return response()->json([
                'status' => 'error',
                'msg' => $exception->errors(),
                'statusCode' => '422',
            ]);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'data' => $exception->getMessage()]);
        }
    }
}
