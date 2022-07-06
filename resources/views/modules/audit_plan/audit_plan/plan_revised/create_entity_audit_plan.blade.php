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
                    <a href="{{route('audit.plan.audit.index')}}">
                        <i title="Back To Audit Plan" class="fad fa-backward mr-3"></i>
                    </a>
                    Create Audit Plan
                </h4>
            </div>
        </div>
        <div class="col-md-6 text-right">
            <button class="btn btn-sm btn-square btn-primary btn-hover-primary entity_audit_plan_team_schedule"
                    data-parent-office-id="{{$entity_list}}"
                    onclick="Entity_Plan_Container.showTeamCreateModal($(this));">
                <i class="fas fa-users"></i> Team
            </button>

            <button class="btn btn-sm btn-square btn-warning btn-hover-warning entity_audit_plan_risk_assessment"
                    onclick="Entity_Plan_Container.riskAssessment($(this));">
                <i class="fas fa-ballot-check"></i> Risk Assessment
            </button>

            <button class="btn btn-sm btn-square btn-info btn-hover-info entity_audit_plan_preview"
                    onclick="Entity_Plan_Container.previewAuditPlan()">
                <i class="fas fa-eye"></i> Preview
            </button>

            <button class="btn btn-sm btn-square btn-success btn-hover-success draft_entity_audit_plan entity_audit_plan_save"
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
                        <div class="input-group mb-5">
                        </div>
                        <div class="mt-5">
                            {{--<h3>Audit list</h3>--}}
                        </div>
                        <!---JS tree start---->
                        <div id="createPlanJsTree" class="mt-5">
                        </div>
                        <!---JS tree end---->
                        <div class="form-group mt-5">
                            {{--<input class="form-control rounded-0" type="text" name="" id="searchPlaneField"
                                   placeholder="Search"/>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="split-1">
            <textarea id="kt-tinymce-1" name="kt-tinymce-1" class="kt-tinymce-1"></textarea>
        </div>

        <div id="split-2" class="d-none">
            <div id="writing-screen-wrapper" style="font-family:SolaimanLipi,serif !important;">
            </div>
        </div>
    </div>
    <div class="load-office-wise-employee"></div>
@endsection
@section('scripts')
    @if($audit_plan['audit_type'] == 'compliance')
        @include('scripts.audit_plan.create.script_create_entity_compliance_audit_plan')
    @elseif($audit_plan['audit_type'] == 'performance')
        @include('scripts.audit_plan.create.script_create_entity_compliance_audit_plan')
    @endif

    @include('scripts.audit_plan.script_entity_audit_plan')

    {{--<script>
        $('.draft_entity_audit_plan').click();
    </script>--}}

    <script>
    $(function () {
        $('.draft_entity_audit_plan').click();
        $('.entity_audit_plan_team_schedule').prop( "disabled", true );
        $('.entity_audit_plan_risk_assessment').prop( "disabled", true );
        $('.entity_audit_plan_preview').prop( "disabled", true );

        let inherentRiskTotalPoint = 0;
        let controlRiskTotalPoint = 0;
        let detectionRiskTotalPoint = 0;
    })
    </script>
@endsection
