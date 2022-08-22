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

        .progressBar {
            width: 100%;
            /*margin: 10px auto;
            height: 22px;*/
            /*background-color: #0A5F44;*/
        }

        .progressBar div {
            height: 100%;
            text-align: left;
            /*padding: 0 10px;*/
            /*line-height: 22px;*/ /* same as #progressBar height if we want text middle aligned */
            width: 0;
            /*background-color: #3699ff;*/
            box-sizing: border-box;
        }
    </style>
@endsection
@section('content')
    <script src="{{asset('assets/plugins/global/tinymce.min.js')}}" referrerpolicy="origin"></script>

    <div class="row m-0 mb-3 page-title-wrapper d-md-flex align-items-md-center shadow-sm">
        <div class="col-md-4">
            <div class="title py-2">
                <h4 class="mb-0 font-weight-bold">
                    <a href="{{route('audit.plan.audit.plan.all')}}">
                        <i title="Back To Audit Plan" class="fad fa-backward mr-3"></i>
                    </a>
                    Edit Audit Plan
                </h4>
            </div>
        </div>
        <div class="col-md-8 text-right">

            @if($check_edit_lock)
                <button class="btn btn-sm btn-square btn-primary btn-hover-primary"
                        data-audit-plan-id="{{$audit_plan['id']}}"
                        data-office-order-approval-status="{{$audit_plan['office_order'] ? $audit_plan['office_order']['approved_status'] : ''}}"
                        data-has-update-office-order="{{$audit_plan['has_update_office_order']}}"
                        data-parent-office-id="{{$entity_list}}"
                        onclick="Entity_Plan_Container.showTeamCreateModal($(this));">
                    <i class="fas fa-users"></i> Team
                </button>

                <button class="btn btn-sm btn-square btn-warning btn-hover-warning"
                        onclick="Entity_Plan_Container.riskAssessment($(this));">
                    <i class="fas fa-ballot-check"></i> Risk Assessment
                </button>
            @endif

            <button class="btn btn-sm btn-square btn-info btn-hover-info"
                    data-scope-editable="0"
                    data-audit-plan-id="{{$audit_plan['id']}}"
                    data-annual-plan-id="{{$annual_plan_id}}"
                    data-fiscal-year-id="{{$fiscal_year_id}}"
                    onclick="Entity_Plan_Container.previewAuditPlan($(this))">
                <i class="fas fa-eye"></i> Preview
            </button>


            @if($check_edit_lock)
                <button class="btn btn-sm btn-square btn-success btn-hover-success draft_entity_audit_plan"
                        data-audit-plan-id="{{$audit_plan['id']}}"
                        data-activity-id="{{$activity_id}}"
                        data-annual-plan-id="{{$annual_plan_id}}"
                        data-is-continue="1"
                        onclick="Entity_Plan_Container.draftEntityPlan($(this))">
                    <i class="fas fa-save"></i> Save And Continue
                </button>

                <button class="btn btn-sm btn-square btn-success btn-hover-success draft_entity_audit_plan"
                        data-audit-plan-id="{{$audit_plan['id']}}"
                        data-activity-id="{{$activity_id}}"
                        data-annual-plan-id="{{$annual_plan_id}}"
                        data-is-continue="0"
                        onclick="Entity_Plan_Container.draftEntityPlan($(this))">
                    <i class="fas fa-save"></i> Save And Exit
                </button>
            @endif
        </div>
    </div>

    <div class="split" id="splitWrapper">
        <div id="split-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="p-5">
                        @if(!$check_edit_lock)
                            <div class="ml-5">
                                <p>
                                    <i class="fa fa-user pl-5"></i> {{ 'হালনাগাদ করছেন ('.$audit_plan['edit_user_details'].')' }}
                                </p>
                                <p><i class="fa fa-clock pl-5"></i> {{enTobn($audit_plan['edit_time_start'])}} থেকে
                                    হালনাগাদ করছেন</p>
                            </div>
                        @else
                            <div class="progressBar" id="progressBar">
                                <div class="bar" style="width:100%"></div>
                            </div>
                            {{--<div>
                                <p style="margin-left: 15px" class="text-danger">
                                    ৩০ মিনিটের মধ্যে সংরক্ষণ বাটনে ক্লিক করুন
                                </p>
                            </div>--}}
                        @endif

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
