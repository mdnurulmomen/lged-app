<?php

namespace App\Http\Controllers\AuditReport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuditFinalReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */

    public function index()
    {
        $all_directorates = $this->allAuditDirectorates();

        $self_directorate = current(array_filter($all_directorates, function ($item) {
            return $this->current_office_id() == $item['office_id'];
        }));

        $directorates = $self_directorate ? [$self_directorate] : $all_directorates;

        $fiscal_years = $this->allFiscalYears();

        return view('modules.audit_report.audit_final_report.final_report', compact('fiscal_years', 'directorates'));
    }

    public function getAuditFinalReport(Request $request)
    {

        $data = Validator::make($request->all(), [
            'office_id' => 'required',
            'qac_type' => 'required',
            'activity_id' => 'required',
        ], [
            'office_id.required' => 'অধিদপ্তর বাছাই করুন',
            'activity_id.required' => 'অ্যাক্টিভিটি বাছাই করুন',
        ])->validate();
//        dd($data);
        $data['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get_audit_final_report'), $data)->json();
//        dd($responseData);
        $current_designation_id = $this->current_designation_id();
        $final_report = isSuccess($responseData) ? $responseData['data'] : [];
        return view('modules.audit_report.audit_final_report.load_final_report_list',
            compact('final_report', 'current_designation_id'));
    }


    public function editAuditFinalReport(Request $request)
    {
//        dd(1);
        $data = Validator::make($request->all(), [
            'air_report_id' => 'required|integer',
            'office_id' => 'required|integer',
        ])->validate();


        $cdeskData = $this->current_desk_json();
        $data['cdesk'] = $cdeskData;

//        dd($cdeskData);

        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.edit_air_report'), $data)->json();
        //dd($responseData);
        if (isSuccess($responseData)) {
            $airReport = $responseData['data'];
            $air_report_id = $airReport['id'];
            $latest_receiver_designation_id = empty($airReport['latest_r_air_movement']) ? 0 : $airReport['latest_r_air_movement']['receiver_employee_designation_id'];
            $current_designation_id = $this->current_designation_id();
            $current_designation_grade = $this->current_officer_grade();
//            dd($current_designation_grade);
            $qac_type = $request->qac_type;
            $cqatData['template_type'] = 'cqat_report';
            $cqatData['cdesk'] = $cdeskData;
            $desk_office_id = json_decode($cdeskData, true);
            $desk_office_id = $desk_office_id['office_id'];
            $final_approval_status = $airReport['final_approval_status'];
            $approved_status = $airReport['approval_status'];
            $is_bg_press = $airReport['is_bg_press'];
            $printing_done = $airReport['is_printing_done'];
            $office_id = $request->office_id;

            $responseReportTemplateData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.create_air_report'), $cqatData)->json();

            if (isSuccess($responseReportTemplateData)) {
                $content = $responseReportTemplateData['data']['content'];

                $entityNames = [];
                foreach ($airReport['annual_plan']['ap_entities'] as $ap_entities) {
                    $entityNames[] = $ap_entities['entity_name_bn'];
                }
                $audit_plan_entities = count($entityNames) > 1 ? implode(" এবং ", $entityNames) : $entityNames[0];

                return view('modules.audit_report.audit_final_report.edit_final_report',
                    compact('content', 'audit_plan_entities', 'air_report_id',
                        'approved_status', 'final_approval_status', 'latest_receiver_designation_id', 'current_designation_id', 'qac_type', 'office_id', 'desk_office_id', 'is_bg_press', 'printing_done', 'current_designation_grade'));
            }
        } else {
            return ['status' => 'error', 'data' => $responseData['data']];
        }
    }

    public function loadFinalApprovalAuthority(Request $request)
    {
        $office_id = $request->office_id;
        $air_report_id = $request->air_report_id;
        $air_type = $request->air_type;
        $data['r_air_id'] = $air_report_id;
        $data['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get_air_last_movement'), $data)->json();
        $last_air_movement = isSuccess($responseData) ? $responseData['data'] : [];
        //dd($last_air_movement);
        $officer_lists = $this->initDoptorHttp()->post(config('cag_doptor_api.office_unit_designation_employee_map'),
            [
                'office_id' => $office_id,
                'designation_grade' => 6,
            ]
        )->json();
        $officer_lists = $officer_lists['status'] == 'success' ? $officer_lists['data'] : [];
        return view('modules.audit_report.audit_final_report.final_report_approval_authority', compact('officer_lists', 'air_report_id', 'last_air_movement', 'air_type', 'office_id'));
    }

    public function submitFinalApproval(Request $request)
    {

        try {
            $data = Validator::make($request->all(), [
                'r_air_id' => 'required|integer',
                'receiver_officer_id' => 'required|integer',
                'receiver_office_id' => 'required|integer',
                'receiver_unit_id' => 'required|integer',
                'receiver_unit_name_en' => 'required',
                'receiver_unit_name_bn' => 'required',
                'receiver_employee_id' => 'required|integer',
                'receiver_employee_name_en' => 'required',
                'receiver_employee_name_bn' => 'required',
                'receiver_employee_designation_id' => 'required|integer',
                'receiver_employee_designation_en' => 'required',
                'receiver_employee_designation_bn' => 'required',
                'receiver_officer_phone' => 'required',
                'receiver_officer_email' => 'required',
                'air_type' => 'required',
            ], [
                'r_air_id.required' => 'AIR id is required',
                'receiver_officer_id.required' => 'You have to choose receiver',
                'receiver_office_id.required' => 'You have to choose receiver',
                'air_type.required' => 'AIR type is required',
            ])->validate();

            $data['comments'] = $request->comments;
            $data['office_id'] = $request->office_id;
            $data['cdesk'] = $this->current_desk_json();
            $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.final_report_movement'), $data)->json();

            if (isSuccess($responseData)) {

                if ($request->final_approval_status) {
                    $report_data['air_id'] = $request->r_air_id;
                    $report_data['cdesk'] = $this->current_desk_json();
                    $report_data['office_id'] = $request->office_id;

                    $report_data['final_approval_status'] = $request->final_approval_status ?: $request->final_approval_status;

                    $saveAirReport = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.update_qac_air_report'), $report_data)->json();

                    if (isSuccess($saveAirReport)) {
                        return response()->json(['status' => 'success', 'data' => 'সফলভাবে প্রেরণ করা হয়েছে']);
                    } else {
                        return response()->json(['status' => 'error', 'data' => $saveAirReport]);
                    }
                } else {
                    return response()->json(['status' => 'success', 'data' => 'সফলভাবে প্রেরণ করা হয়েছে']);
                }


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

    public function finalReportStatusUpdate(Request $request)
    {
        $report_data = Validator::make($request->all(), [
            'air_id' => 'required|integer',
            'office_id' => 'required|integer',
        ])->validate();

        $report_data['is_bg_press'] = $request->is_bg_press ?: $request->is_bg_press;
        $report_data['is_printing_done'] = $request->is_printing_done ?: $request->is_printing_done;

        $report_data['cdesk'] = $this->current_desk_json();

        $updateFinalReport = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.update_qac_air_report'), $report_data)->json();

        if (isSuccess($updateFinalReport)) {
            return response()->json(['status' => 'success', 'data' => 'সফলভাবে প্রেরণ করা হয়েছে']);
        } else {
            return response()->json(['status' => 'error', 'data' => $updateFinalReport]);
        }
    }

    public function finalReportSearch(){
        $all_directorates = $this->allAuditDirectorates();
        $self_directorate = current(array_filter($all_directorates, function ($item) {
            return $this->current_office_id() == $item['office_id'];
        }));
        $directorates = $self_directorate ? [$self_directorate] : $all_directorates;
        $fiscal_years = $this->allFiscalYears();
        return view(
            'modules.audit_report.audit_final_report.final_report_search',
            compact('directorates','fiscal_years')
        );
    }

    public function getFinalReportSearchList(Request $request){
        $data = Validator::make($request->all(), [
            'directorate_id' => 'required',
            'ministry_id' => 'nullable',
            'entity_id' => 'nullable',
            'fiscal_year_id' => 'nullable',
        ], [
            'directorate_id.required' => 'অধিদপ্তর বাছাই করুন',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get_audit_final_report_search'), $data)->json();
        //dd($responseData);
        $current_designation_id = $this->current_designation_id();
        $report_list = isSuccess($responseData) ? $responseData['data'] : [];
        return view('modules.audit_report.audit_final_report.get_final_report_search_list',
            compact('report_list', 'current_designation_id','data'));
    }

    public function finalReportDetails(Request $request){

       $data = Validator::make($request->all(), [
            'office_id' => 'required',
            'air_id' => 'required',
        ], [
            'office_id.required' => 'অধিদপ্তর বাছাই করুন',
        ])->validate();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get_audit_final_report_details'), $data)->json();
        //dd($responseData);
        $apottiDetails = isSuccess($responseData)?$responseData['data']:[];
        return view('modules.audit_report.audit_final_report.final_report_details', compact('apottiDetails'));
    }

    public function finalReportApottiMap(){
        $all_directorates = $this->allAuditDirectorates();
        $self_directorate = current(array_filter($all_directorates, function ($item) {
            return $this->current_office_id() == $item['office_id'];
        }));
        $directorates = $self_directorate ? [$self_directorate] : $all_directorates;
        $fiscal_years = $this->allFiscalYears();
        return view('modules.audit_report.audit_final_report.final_report_apotti_map', compact('directorates','fiscal_years'));
    }

    public function getDirectorateWiseFinalReport(Request $request){
        $data = Validator::make($request->all(), [
            'directorate_id' => 'required',
        ], [
            'directorate_id.required' => 'অধিদপ্তর বাছাই করুন',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get_archive_final_report'), $data)->json();
        //dd($responseData);
        $report_list = isSuccess($responseData) ? $responseData['data'] : [];
        return view('modules.audit_report.audit_final_report.get_directorate_wise_final_report',
            compact('report_list'));
    }

    public function getArchiveFinalReportApotti(Request $request){
        $data = Validator::make($request->all(), [
            'directorate_id' => 'required',
        ], [
            'directorate_id.required' => 'অধিদপ্তর বাছাই করুন',
        ])->validate();

        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.get_archive_final_report_apotti'), $data)->json();
        //dd($responseData);
        $apottis= isSuccess($responseData) ? $responseData['data'] : [];
        return view('modules.audit_report.audit_final_report.get_final_report_apotii_map_list',
            compact('apottis'));
    }

    public function mapArchiveFinalReportApotti(Request $request){
        $data = Validator::make($request->all(), [
            'directorate_id' => 'required',
            'r_air_id' => 'required',
            'apottis' => 'required',
        ], [
            'directorate_id.required' => 'অধিদপ্তর বাছাই করুন',
            'r_air_id.required' => 'Report is required',
            'apottis.required' => 'Apottis is required',
        ])->validate();

        $data['cdesk'] = $this->current_desk_json();
        $responseData = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_report.air.map_archive_final_report_apotti'), $data)->json();
        //dd($responseData);
        if (isSuccess($responseData)) {
            return response()->json(['status' => 'success', 'data' => 'Stored successfully']);
        } else {
            return response()->json(['status' => 'error', 'data' => $responseData]);
        }
    }
}
