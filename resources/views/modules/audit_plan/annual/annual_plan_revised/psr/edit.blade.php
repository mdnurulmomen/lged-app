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
                    <a href="#">
                        <i title="Back To Plan" class="fad fa-backward mr-3"></i>
                    </a>
                </h4>
            </div>
        </div>
        <div class="col-md-8 text-right">
            <button class="btn btn-sm btn-square btn-info btn-hover-info entity_audit_plan_preview"
                    data-scope-editable="0"
                    onclick="PSR_Plan_Container.previewAuditPlanPSR($(this))">
                <i class="fas fa-eye"></i> Preview
            </button>

            <button class="btn btn-sm btn-square btn-save draft_entity_audit_plan entity_audit_plan_save"
                    data-annual-plan-id="{{$annual_plan_id}}"
                    data-fiscal-year-id="{{$fiscal_year_id}}"
                    data-activity-id="{{$activity_id}}"
                    data-psr-plan-id="{{$psr_plan_id}}"
                    onclick="PSR_Plan_Container.draftPSRPlan($(this))">
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
            <div id="writing-screen-wrapper" style="font-family:Nikosh,serif !important;"></div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('scripts.annual_plan.psr.edit.script_edit_psr')
    @include('scripts.annual_plan.psr.script_entity_psr_plan')
@endsection
