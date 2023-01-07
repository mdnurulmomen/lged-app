<?php

namespace App\Http\Controllers\RiskAssessment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SectorAssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
//        dd($type);

        $allProjects = $this->initHttpWithToken()->post(config('cag_rpu_api.get-all-projects'), [
            'all' => 1
        ])->json();

        $allProjects = $allProjects ? $allProjects['data'] : [];

        // dd($allProjects);

        $allFunctions = $this->initHttpWithToken()->post(config('cag_rpu_api.functions.list'), [
            'all' => 1
        ])->json();
        $allFunctions = $allFunctions ? $allFunctions['data'] : [];

        $allMasterUnits = $this->initHttpWithToken()->post(config('cag_rpu_api.master_units.list'), [
            'all' => 1
        ])->json();
        $allMasterUnits = $allMasterUnits ? $allMasterUnits['data'] : [];

        // $allCostCenters = $this->initHttpWithToken()->post(config('cag_rpu_api.cost-center-project-map.get-cost-center-project-map'), [
        //     'all' => 1
        // ])->json();
        // $allCostCenters = $allCostCenters ? $allCostCenters['data'] : [];

        return view('modules.settings.risk_assessment.index', compact('allProjects', 'allFunctions', 'allMasterUnits','type'));
    }

    public function getSectorRiskAssessmentList(Request $request)
    {
        $sectorriskassessments = $this->initHttpWithToken()->get(config('amms_bee_routes.sector_risk_assessments'), $request->all())->json();

        // dd($sectorriskassessments);

        $allAuditAreas = $this->initHttpWithToken()->get(config('cag_rpu_api.areas'), [
            'all' => 1
        ])->json()['data'];

       $assessment_type = $request->assessment_type;

        // dd($allAuditAreas);

        if ($sectorriskassessments['status'] == 'success') {
            $sectorriskassessments = $sectorriskassessments['data'];
            return view('modules.settings.risk_assessment.partials.list', compact(['sectorriskassessments', 'allAuditAreas','assessment_type']));
        } else {
            return response()->json(['status' => 'error', 'data' => $sectorriskassessments]);
        }
    }

    public function excelDownload(Request $request)
    {
//        dd($request->assessment_type);
        $sectorriskassessments = $this->initHttpWithToken()->get(config('amms_bee_routes.sector_risk_assessments'), $request->all())->json();

        $sectorriskassessments = isSuccess($sectorriskassessments) ? $sectorriskassessments['data'] : [];
//        dd($sectorriskassessments);

        $allAuditAreas = $this->initHttpWithToken()->get(config('cag_rpu_api.areas'), [
            'all' => 1
        ])->json()['data'];


//        dd(collect($allAuditAreas));

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Audit Area');
        $sheet->setCellValue('B1', 'Process/sub-process');
        $sheet->setCellValue('C1', 'Risk');
        $sheet->setCellValue('D1', 'Impact');
        $sheet->setCellValue('E1', 'Likelihood');

        if($request->assessment_type == 'final') {
            $sheet->setCellValue('F1', 'Inherent Risk Level');
        }else{
            $sheet->setCellValue('F1', 'Residual Risk');
        }

        $sheet->setCellValue('G1', 'Priority (1,2,3,4)');

        if($request->assessment_type == 'final') {
            $sheet->setCellValue('H1', 'Existing Control');
        }else{
            $sheet->setCellValue('H1', 'Effectiveness Of Control (Inadequate, Needs Improvement, Adequate)');
        }

        $sheet->setCellValue('I1', 'Risk Owner');
        $sheet->setCellValue('J1', 'Process Owner');
        $sheet->setCellValue('K1', 'Control Owner');

        if($request->assessment_type == 'final'){
            $sheet->setCellValue('L1', 'Related Issue Number');
        }

        $sheet->getColumnDimension('A')->setWidth(20);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(20);
        $sheet->getColumnDimension('G')->setWidth(20);
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getColumnDimension('I')->setWidth(20);
        $sheet->getColumnDimension('J')->setWidth(20);
        $sheet->getColumnDimension('K')->setWidth(20);
        if($request->assessment_type == 'final') {
            $sheet->getColumnDimension('L')->setWidth(20);
        }

        $count = 2;

        foreach ($sectorriskassessments as $sectorriskassessment) {
            if(count($sectorriskassessment['audit_assessment_area_risks']) > 1){
                $cell_count =  count($sectorriskassessment['audit_assessment_area_risks']) + 1;
                $sheet->mergeCells("A".$count.":A".$cell_count);
            }

            $sheet->setCellValue('A' . $count, collect($allAuditAreas)->firstWhere('id', $sectorriskassessment['audit_area_id'])['name_en']);
            $sub_cell = $count;
            foreach ($sectorriskassessment['audit_assessment_area_risks'] as $auditAssessmentAreaRisk) {
                $sheet->setCellValue('B' . $sub_cell,  $auditAssessmentAreaRisk['sub_area_name']);
                $sheet->setCellValue('C' . $sub_cell,  $auditAssessmentAreaRisk['inherent_risk']);
                $sheet->setCellValue('D' . $sub_cell,  $auditAssessmentAreaRisk['x_risk_assessment_impact']['title_en']);
                $sheet->setCellValue('E' . $sub_cell,  $auditAssessmentAreaRisk['x_risk_assessment_likelihood']['title_en'] );
                $sheet->setCellValue('F' . $sub_cell,  $auditAssessmentAreaRisk['risk_level']);
                $sheet->setCellValue('G' . $sub_cell,  $auditAssessmentAreaRisk['priority']);
                $sheet->setCellValue('H' . $sub_cell,  $auditAssessmentAreaRisk['control_system']);
                $sheet->setCellValue('I' . $sub_cell,  $auditAssessmentAreaRisk['risk_owner_name']);
                $sheet->setCellValue('J' . $sub_cell,  $auditAssessmentAreaRisk['process_owner_name']);
                $sheet->setCellValue('K' . $sub_cell,  $auditAssessmentAreaRisk['control_owner_name']);
                if($request->assessment_type == 'final') {
                    $sheet->setCellValue('L' . $sub_cell,  $auditAssessmentAreaRisk['issue_no']);
                }
                $sub_cell++;
                $count++;
            }
        }

        $writer = new Xlsx($spreadsheet);
        ob_start();
        $writer->save('risk_assessment.xlsx');
        $content = ob_get_contents();
        ob_end_clean();

        Storage::disk('public')->put("risk_assessment.xlsx", $content);

//        $writer->save('risk_assessment.xlsx');
        $file_name = 'risk_assessment.xlsx';
        $full_path = url('storage/risk_assessment.xlsx');
        return json_encode(['file_name' => $file_name, 'full_path' => $full_path]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
//        dd($request->all());

        $allProjects = $this->initHttpWithToken()->post(config('cag_rpu_api.get-all-projects'), [
            'all' => 1
        ])->json();

        $allProjects = $allProjects ? $allProjects['data'] : [];

        $allFunctions = $this->initHttpWithToken()->post(config('cag_rpu_api.functions.list'), [
            'all' => 1
        ])->json();
        $allFunctions = $allFunctions ? $allFunctions['data'] : [];

        $allMasterUnits = $this->initHttpWithToken()->post(config('cag_rpu_api.master_units.list'), [
            'all' => 1
        ])->json();
        $allMasterUnits = $allMasterUnits ? $allMasterUnits['data'] : [];

        // $allCostCenters = $this->initHttpWithToken()->post(config('cag_rpu_api.cost-center-project-map.get-cost-center-project-map'), [
        //     'all' => 1
        // ])->json();
        // $allCostCenters = $allCostCenters ? $allCostCenters['data'] : [];

        $allImpacts = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_impacts'), [
            'all' => 1
        ])->json();
        $allImpacts = $allImpacts ? $allImpacts['data'] : [];

        $allLikelihoods = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_likelihoods'), [
            'all' => 1
        ])->json();
        $allLikelihoods = $allLikelihoods ? $allLikelihoods['data'] : [];

        $officerLists = $this->initDoptorHttp()->post(config('cag_doptor_api.office_unit_designation_employee_map'),
            [
                'office_id' => $this->current_office_id(),
                'designation_grade' => 6,
            ]
        )->json();

        $officerLists = $officerLists ? $officerLists['data'] : [];

        $type = $request->type;

        //  dd($officerLists);

        return view('modules.settings.risk_assessment.partials.create', compact('allProjects', 'allFunctions', 'allMasterUnits', 'allImpacts', 'allLikelihoods', 'officerLists', 'type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'audit_area_id' => 'required|integer|max:255',
            'assessment_sector_id' => 'required|integer|max:255',
            'assessment_type' => 'required|string',
            'assessment_sector_type' => 'required|string|in:project,function,master-unit,cost-center',
            'audit_assessment_area_risks' => 'required|array',
//            'audit_assessment_area_risks.*.inherent_risk' => 'required|string',
            'audit_assessment_area_risks.*.x_risk_assessment_impact_id' => 'required|integer',
            'audit_assessment_area_risks.*.x_risk_assessment_likelihood_id' => 'required|integer',
//            'audit_assessment_area_risks.*.control_system' => 'required|string',
//            'audit_assessment_area_risks.*.control_effectiveness' => 'required|string',
//            'audit_assessment_area_risks.*.residual_risk' => 'required|string',
//            'audit_assessment_area_risks.*.recommendation' => 'required|string',
//            'audit_assessment_area_risks.*.implemented_by' => 'required|string',
//            'audit_assessment_area_risks.*.implementation_period' => 'required|string',
        ]);

//        dd($request->audit_assessment_area_risks);

        $currentUserId = $this->current_desk()['officer_id'];

        $data = [
            'audit_area_id' => $request->audit_area_id,
            'assessment_sector_id' => $request->assessment_sector_id,
            'assessment_sector_type' => $request->assessment_sector_type,
            'assessment_type' => $request->assessment_type,
            'audit_assessment_area_risks' => $request->audit_assessment_area_risks,
            'creator_id' => $currentUserId,
            'updater_id' => $currentUserId,
        ];

//        dd($data);

        $create_risk_impact = $this->initHttpWithToken()->post(config('amms_bee_routes.sector_risk_assessments'), $data)->json();
        //    dd($create_risk_assessment);
        if (isset($create_risk_impact['status']) && $create_risk_impact['status'] == 'success') {
            return response()->json(responseFormat('success', 'Created Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $create_risk_impact]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sectorRiskAssessmentEdit(Request $request)
    {
        $allProjects = $this->initHttpWithToken()->post(config('cag_rpu_api.get-all-projects'), [
            'all' => 1
        ])->json();
        $allProjects = $allProjects ? $allProjects['data'] : [];

        $allFunctions = $this->initHttpWithToken()->post(config('cag_rpu_api.functions.list'), [
            'all' => 1
        ])->json();
        $allFunctions = $allFunctions ? $allFunctions['data'] : [];

        $allMasterUnits = $this->initHttpWithToken()->post(config('cag_rpu_api.master_units.list'), [
            'all' => 1
        ])->json();
        $allMasterUnits = $allMasterUnits ? $allMasterUnits['data'] : [];

        // $allCostCenters = $this->initHttpWithToken()->post(config('cag_rpu_api.cost-center-project-map.get-cost-center-project-map'), [
        //     'all' => 1
        // ])->json();
        // $allCostCenters = $allCostCenters ? $allCostCenters['data'] : [];

        $allAreas = $this->initHttpWithToken()->get(config('cag_rpu_api.areas'), [
            'all' => 1
        ])->json()['data'];

        $allImpacts = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_impacts'), [
            'all' => 1
        ])->json();
        $allImpacts = $allImpacts ? $allImpacts['data'] : [];

        $allLikelihoods = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_likelihoods'), [
            'all' => 1
        ])->json();
        $allLikelihoods = $allLikelihoods ? $allLikelihoods['data'] : [];

        $id = $request->id;
        $audit_area_id = $request->audit_area_id;
        $assessment_sector_id = $request->assessment_sector_id;
        $assessment_sector_type = $request->assessment_sector_type;
        $audit_assessment_area_risks = $request->audit_assessment_area_risks;

        return view('modules.settings.risk_assessment.partials.update', compact('id', 'audit_area_id', 'assessment_sector_id', 'assessment_sector_type', 'audit_assessment_area_risks', 'allProjects', 'allFunctions', 'allMasterUnits', 'allAreas', 'allImpacts', 'allLikelihoods'));
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
        $request->validate([
            'audit_area_id' => 'required|integer|max:255',
            'assessment_sector_id' => 'required|integer|max:255',
            'assessment_sector_type' => 'required|string|in:project,function,master-unit,cost-center',
            'audit_assessment_area_risks' => 'required|array',
            'audit_assessment_area_risks.*.inherent_risk' => 'required|string',
            'audit_assessment_area_risks.*.x_risk_assessment_impact_id' => 'required|integer',
            'audit_assessment_area_risks.*.x_risk_assessment_likelihood_id' => 'required|integer',
            'audit_assessment_area_risks.*.control_system' => 'required|string',
            'audit_assessment_area_risks.*.control_effectiveness' => 'required|string',
            'audit_assessment_area_risks.*.residual_risk' => 'required|string',
            'audit_assessment_area_risks.*.recommendation' => 'required|string',
            'audit_assessment_area_risks.*.implemented_by' => 'required|string',
            'audit_assessment_area_risks.*.implementation_period' => 'required|string',
        ]);

        $data = [
            'id' => $request->id,
            'audit_area_id' => $request->audit_area_id,
            'assessment_sector_id' => $request->assessment_sector_id,
            'assessment_sector_type' => $request->assessment_sector_type,
            'audit_assessment_area_risks' => $request->audit_assessment_area_risks,
            'updater_id' => $this->current_desk()['officer_id'],
        ];

        $update_risk_impact = $this->initHttpWithToken()->put(config('amms_bee_routes.sector_risk_assessments')."/$request->id", $data)->json();
//        dd($create_audit_query);
        if (isset($update_risk_impact['status']) && $update_risk_impact['status'] == 'success') {
            return response()->json(['status' => 'success', 'data' => $update_risk_impact['data']]);
        } else {
            return response()->json(['status' => 'error', 'data' => $update_risk_impact]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = [
            'id' => $id,
        ];
    //    dd($data);
        $delete_risk_impact = $this->initHttpWithToken()->delete(config('amms_bee_routes.sector_risk_assessments')."/$id", $data)->json();
        if (isset($delete_risk_impact['status']) && $delete_risk_impact['status'] == 'success') {
            return response()->json(responseFormat('success', 'Deleted Successfully'));
        } else {
            return response()->json(['status' => 'error', 'data' => $delete_risk_impact]);
        }
    }

    public function getSectorAreaList(Request $request) {

        $request->validate([
            'assessment_sector_id' => 'required|integer',
            'assessment_sector_type' => 'required|in:project,function,master-unit',
        ]);

        if ($request->assessment_sector_type == 'project') {

            $allAreas = $this->initHttpWithToken()->get(config('cag_rpu_api.areas'), [
                'sector_id' => $request->assessment_sector_id,
                'sector_type' => 'App\Models\Project',
            ])->json();

        } else if ($request->assessment_sector_type == 'function') {

            $allAreas = $this->initHttpWithToken()->get(config('cag_rpu_api.areas'), [
                'sector_id' => $request->assessment_sector_id,
                'sector_type' => 'App\Models\Function',
            ])->json();

        } else if ($request->assessment_sector_type == 'master-unit') {

            $allAreas = $this->initHttpWithToken()->get(config('cag_rpu_api.areas'), [
                'sector_id' => $request->assessment_sector_id,
                'sector_type' => 'App\Models\UnitMasterInfo',
            ])->json();

        }

        // dd($allAreas);

        $allAreas = $allAreas ? $allAreas['data'] : [];

        return view('modules.settings.risk_assessment.partials.areas', compact('allAreas'));
    }

    public function sectorRiskAssessmentSummery(Request $request)
    {
        $sectorassessmentareas = $this->initHttpWithToken()->get(config('amms_bee_routes.sector_risk_assessments'), $request->all())->json();

        $allAuditAreas = $this->initHttpWithToken()->get(config('cag_rpu_api.areas'), [
            'all' => 1
        ])->json()['data'];

        $risk_levels = $this->initHttpWithToken()->get(config('amms_bee_routes.x_risk_levels'), [
            'all' => 1
        ])->json();

        // dd($risk_level_list);

        if ($sectorassessmentareas['status'] == 'success') {
            $risk_levels = $risk_levels['data'];
            $sectorassessmentareas = $sectorassessmentareas['data'];
            return view('modules.settings.risk_assessment.partials.get_risk_assessment_summery', compact(['sectorassessmentareas', 'risk_levels', 'allAuditAreas']));
        } else {
            return response()->json(['status' => 'error', 'data' => $sectorassessmentareas]);
        }
    }

    public function getSectorWiseIssue(Request $request){
//        dd($request->all());
        $data['project_id'] = $request->assessment_sector_type == 'project' ? $request->assessment_sector_id : 0;
        $memo_list = $this->initHttpWithToken()->post(config('amms_bee_routes.audit_conduct_query.memo.list'), $data)->json();

        if (isset($memo_list['status']) && $memo_list['status'] == 'success') {
            $memo_list = $memo_list['data'];
            return view('modules.audit_execution.audit_execution_memo.partials.issue_no_select', compact('memo_list'));
        } else {
            return response()->json(['status' => 'error', 'data' => $memo_list]);
        }
    }
}
