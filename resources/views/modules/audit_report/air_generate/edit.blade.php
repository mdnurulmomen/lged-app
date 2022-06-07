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
    <script src="{{ asset('assets/plugins/global/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <input type="hidden" id="auditAllApottis">
    <input type="hidden" id="auditApottis">

    <input type="hidden" id="ministry_id" value="{{ $ministry_id }}">
    <input type="hidden" id="ministry_name_en" value="{{ $ministry_name_en }}">
    <input type="hidden" id="ministry_name_bn" value="{{ $ministry_name_bn }}">
    <input type="hidden" id="air_entity_id" value="{{ $entity_id }}">
    <input type="hidden" id="entity_name_en" value="{{ $entity_name_en }}">
    <input type="hidden" id="entity_name_bn" value="{{ $entity_name_bn }}">

    <input type="hidden" id="airId" value="{{ $air_report_id }}">

    <div class="row m-0 mb-3 page-title-wrapper d-md-flex align-items-md-center shadow-sm">
        <div class="col-md-6">
            <div class="title py-2">
                <h4 class="mb-0 font-weight-bold">
                    <a href="">
                        <i title="Back To Audit Plan" class="fad fa-backward mr-3"></i>
                    </a>
                    প্রাথমিক এআইআর
                </h4>
            </div>
        </div>
        <div class="col-md-6 text-right">

            <div class="dropdown dropdown-inline btn-outline-primary tap-button">
                <a href="#" class="btn btn-sm dropdown-toggle px-5 tap-button btn-outline-primary"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fad fa-download"></i> ডাউনলোড
                </a>
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="">
                    <!--begin::Navigation-->
                    <ul class="navi navi-hover">
                        <li class="navi-item">
                            <a href="javascript:;" onclick="AIR_Report_Create_Container.downloadAIRReport('apotti_air')" class="navi-link">
                                <i class="fad fa-archive mr-3"></i>
                                <span class="navi-text">এআইআর আপত্তি সমূহ</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="javascript:;" onclick="AIR_Report_Create_Container.downloadAIRReport('porishisto_air')" class="navi-link">
                                <i class="fab fa-palfed mr-3"></i>
                                <span class="navi-text">এআইআর পরিশিষ্ট সমূহ</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="javascript:;" onclick="AIR_Report_Create_Container.downloadAIRReport('full_air')" class="navi-link">
                                <i class="fad fa-box-full mr-3"></i>
                                <span class="navi-text">সম্পূর্ণ এআইআর</span>
                            </a>
                        </li>
                    </ul>
                    <!--end::Navigation-->
                </div>
            </div>
            @if ($air_status != 'approved')
                <button class="tap-button mr-1 btn btn-sm btn-outline-primary" data-fiscal-year-id="{{ $fiscal_year_id }}"
                    data-audit-plan-id="{{ $audit_plan_id }}"
                    onclick="AIR_Report_Create_Container.loadPlanEntity($(this))">
                    <i class="fad fa-search"></i> অনুচ্ছেদ
                </button>
            @endif

            <button class="tap-button mr-1 btn btn-sm btn-outline-warning"
                onclick="AIR_Report_Create_Container.previewAirReport($(this))">
                <i class="fad fa-eye"></i> Preview
            </button>

            @if ($air_status != 'approved')
                <button class="tap-button mr-1 btn btn-sm btn-outline-primary air_report_save"
                    data-air-id="{{ $air_report_id }}" data-activity-id="{{ $activity_id }}"
                    data-fiscal-year-id="{{ $fiscal_year_id }}" data-annual-plan-id="{{ $annual_plan_id }}"
                    data-audit-plan-id="{{ $audit_plan_id }}"
                    onclick="AIR_Report_Create_Container.storeAIRReportPlan($(this))">
                    <i class="fad fa-save"></i> হালনাগাদ করুন
                </button>
            @endif
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
@endsection
@section('scripts')
    @include('scripts.audit_inspection_report.preliminary.edit.script_edit')
    @include('scripts.audit_inspection_report.preliminary.script_report')

    <script>
        var Insert_AIR_Data_Container = {
            setJsonContentFromPlanBook: function() {
                templateArray.map(function(value, index) {
                    cover = $("#pdfContent_" + value.content_id).html();
                    value.content = cover;
                });
            }
        }
    </script>
@endsection
