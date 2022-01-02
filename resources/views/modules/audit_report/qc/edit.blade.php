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
    <div class="row m-0 page-title-wrapper d-md-flex align-items-md-center">
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
            <button class="btn btn-sm btn-square btn-info btn-hover-info"
                    onclick="AIR_Report_Container.previewAirReport($(this))">
                <i class="fad fa-search"></i> Preview
            </button>

            <button class="btn btn-sm btn-square btn-success btn-hover-success air_report_save"
                    data-air-id="{{$air_report_id}}"
                    data-activity-id="{{$activity_id}}"
                    data-fiscal-year-id="{{$fiscal_year_id}}"
                    data-annual-plan-id="{{$annual_plan_id}}"
                    data-audit-plan-id="{{$audit_plan_id}}"
                    onclick="AIR_Report_Container.storeAIRReportPlan($(this))">
                <i class="fas fa-save"></i> Update
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
            <div id="writing-screen-wrapper" style="font-family:SolaimanLipi,serif !important;">
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('scripts.air_report.edit.script_edit_air_report')
    @include('scripts.air_report.script_air_report')
@endsection
