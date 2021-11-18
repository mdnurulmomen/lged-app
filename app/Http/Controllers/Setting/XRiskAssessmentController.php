<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class XRiskAssessmentController extends Controller
{
    public function index()
    {
        return view('modules.settings.x_risk_assessment.x_risk_assessment_lists');
    }

    public function getRiskAssessmentLists(Request $request)
    {
        $risk_assessment_list = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.risk_assessment_lists'), [
            'all' => 1
        ])->json();
//        dd($risk_assessment);
        if ($risk_assessment_list['status'] == 'success') {
            $risk_assessment_list = $risk_assessment_list['data'];
            return view('modules.settings.x_risk_assessment.partials.get_risk_assessment_lists', compact('risk_assessment_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $risk_assessment_list]);
        }
    }

    public function store(Request $request)
    {

        $data = [
            'risk_assessment_type' => $request->risk_assessment_type,
            'company_type' => $request->company_type,
            'risk_assessment_title_en' => $request->risk_assessment_title_en,
            'risk_assessment_title_bn' => $request->risk_assessment_title_bn,
        ];

        $data['cdesk'] = $this->current_desk_json();
//        dd($data);
        $create_risk_assessment = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.risk_assessment_create'), $data)->json();
//        dd($create_risk_assessment);
        if (isset($create_risk_assessment['status']) && $create_risk_assessment['status'] == 'success') {
            return response()->json(responseFormat('success', 'Created Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $create_risk_assessment]);
        }
    }

    public function riskAssessmentEdit(Request $request){
        $risk_assessment_id = $request->risk_assessment_id;
        $risk_assessment_type = $request->risk_assessment_type;
        $company_type = $request->company_type;
        $risk_assessment_title_bn = $request->risk_assessment_title_bn;
        $risk_assessment_title_en = $request->risk_assessment_title_en;
        return view('modules.settings.x_risk_assessment.partials.update_risk_assessment_modal',compact('risk_assessment_id','risk_assessment_type','company_type','risk_assessment_title_bn','risk_assessment_title_en'));
    }

    public function update(Request $request)
    {
        $data = [
            'id' => $request->id,
            'risk_assessment_type' => $request->risk_assessment_type,
            'company_type' => $request->company_type,
            'risk_assessment_title_en' => $request->risk_assessment_title_en,
            'risk_assessment_title_bn' => $request->risk_assessment_title_bn,
        ];

        $data['cdesk'] = $this->current_desk_json();

        $update_risk_assessment = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.risk_assessment_update'), $data)->json();
//        dd($create_audit_query);
        if (isset($update_risk_assessment['status']) && $update_risk_assessment['status'] == 'success') {
            return response()->json(['status' => 'success', 'data' => $update_risk_assessment['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $update_risk_assessment]);
        }
    }

    public function destroy($risk_assessment_id)
    {
        $data = [
            'id' => $risk_assessment_id,
        ];
//        dd($data);
        $delete_risk_assessment = $this->initHttpWithToken()->post(config('amms_bee_routes.settings.risk_assessment_delete'), $data)->json();
        if (isset($delete_risk_assessment['status']) && $delete_risk_assessment['status'] == 'success') {
            return response()->json(responseFormat('success', 'Updated Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $delete_risk_assessment]);
        }
    }
}
