@extends('layouts.full_width')
@section('styles')
    <style>
        .tox-tinymce {
            height: 78vh !important;
            font-size: 11px !important;
        }

        .tox-notification.tox-notification--in.tox-notification--warning {
            display: none !important;
        }
    </style>
@endsection
@section('content')
    <script src="{{asset('assets/plugins/global/tinymce.min.js')}}" referrerpolicy="origin"></script>
    <div style="background-color: var(--sbodycontentbg);" class="row m-0 page-title-wrapper d-md-flex align-items-md-center">
        <div class="col-md-6">
            <div class="title py-2">
                <h4 class="mb-0 font-weight-bold">
                    <a href="{{route('audit.plan.audit.plan.all')}}">
                        <i title="Back To Audit Plan" class="fad fa-backward mr-3"></i>
                    </a>
                    Edit Audit Plan
                </h4>
            </div>
        </div>
        <div class="col-md-6 text-right">
            @if($audit_plan['office_order'] == null || $audit_plan['office_order']['approved_status'] != 'approved')
                <button class="btn btn-sm btn-square btn-primary btn-hover-primary"
                        data-audit-plan-id="{{$audit_plan['id']}}"
                        data-parent-office-id="{{$entity_list}}"
                        onclick="Entity_Plan_Container.showTeamCreateModal($(this));">
                        <i class="fas fa-users"></i> Team
                </button>
            @endif

            <button class="btn btn-sm btn-square btn-warning btn-hover-warning"
                    onclick="Entity_Plan_Container.riskAssessment($(this));">
                <i class="fas fa-ballot-check"></i> Risk Assessment
            </button>

            <button class="btn btn-sm btn-square btn-info btn-hover-info"
                    onclick="Entity_Plan_Container.previewAuditPlan()">
                <i class="fas fa-eye"></i> Preview
            </button>

            <button class="btn btn-sm btn-square btn-success btn-hover-success draft_entity_audit_plan"
                    data-audit-plan-id="{{$audit_plan['id']}}"
                    data-activity-id="{{$activity_id}}"
                    data-annual-plan-id="{{$annual_plan_id}}"
                    onclick="Entity_Plan_Container.draftEntityPlan($(this))">
                <i class="fas fa-save"></i> Save
            </button>
        </div>
    </div>

    <div class="split" id="splitWrapper">
        <div id="split-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="p-5">
                        <div id="createPlanJsTree" class="mt-5"></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="split-1">
            <textarea id="kt-tinymce-1" name="kt-tinymce-1" class="kt-tinymce-1"></textarea>
        </div>
        <div id="split-2" class="d-none">
            <div id="writing-screen-wrapper" style="font-family:Nikosh,serif !important;">
            </div>
        </div>
    </div>
    <div class="load-office-wise-employee"></div>
@endsection
@section('scripts')
    @include('scripts.audit_plan.edit.script_edit_entity_audit_plan')
    @include('scripts.audit_plan.script_entity_audit_plan')

    <script>
        let inherentRiskTotalPoint = 0;
        let controlRiskTotalPoint = 0;
        let detectionRiskTotalPoint = 0;
    </script>
@endsection
