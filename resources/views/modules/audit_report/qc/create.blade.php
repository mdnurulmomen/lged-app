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
                data-air-id=""
                data-activity-id="{{$activity_id}}"
                data-fiscal-year-id="{{$fiscal_year_id}}"
                data-annual-plan-id="{{$annual_plan_id}}"
                data-audit-plan-id="{{$audit_plan_id}}"
                onclick="AIR_Report_Container.storeAIRReportPlan($(this))">
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
@endsection
@section('scripts')
    @include('scripts.air_report.create.script_create_air_report')
    @include('scripts.air_report.script_air_report')

    <script>
        $(function () {
            Create_AIR_Container.insertAuditTeam();
            Create_AIR_Container.insertAuditTeamSchedule();
            Create_AIR_Container.insertAuditApottiSummary();
            Create_AIR_Container.insertAuditApottiDetails();
        });

        Create_AIR_Container = {
            setJsonContentFromPlanBook:function () {
                templateArray.map(function (value, index) {
                    cover = $("#pdfContent_" + value.content_id).html();
                    value.content = cover;
                });
            },

            insertAuditTeam: function () {
                url = '{{route('audit.report.qc.air-report.get-audit-team')}}';
                fiscal_year_id = '{{$fiscal_year_id}}';
                activity_id = '{{$activity_id}}';
                annual_plan_id = '{{$annual_plan_id}}';
                audit_plan_id = '{{$audit_plan_id}}';
                let data = {fiscal_year_id, activity_id, annual_plan_id, audit_plan_id};
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.error(response.data);
                    } else {
                        $('.audit_team').html(response);
                        Create_AIR_Container.setJsonContentFromPlanBook();
                    }
                });
            },

            insertAuditTeamSchedule: function () {
                url = '{{route('audit.report.qc.air-report.get-audit-team-schedule')}}';
                fiscal_year_id = '{{$fiscal_year_id}}';
                activity_id = '{{$activity_id}}';
                annual_plan_id = '{{$annual_plan_id}}';
                audit_plan_id = '{{$audit_plan_id}}';
                let data = {fiscal_year_id, activity_id, annual_plan_id, audit_plan_id};
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.error(response.data);
                    } else {
                        $('.audit_schedule').html(response);
                        Create_AIR_Container.setJsonContentFromPlanBook();
                    }
                });
            },

            insertAuditApottiSummary: function () {
                url = '{{route('audit.report.qc.air-report.get-audit-apotti-summary')}}';
                fiscal_year_id = '{{$fiscal_year_id}}';
                audit_plan_id = '{{$audit_plan_id}}';
                let data = {fiscal_year_id, audit_plan_id};
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.error(response.data);
                    } else {
                        $('.audit_apotti_summary').html(response);
                        Create_AIR_Container.setJsonContentFromPlanBook();
                    }
                });
            },

            insertAuditApottiDetails: function () {
                url = '{{route('audit.report.qc.air-report.get-audit-apotti-details')}}';
                fiscal_year_id = '{{$fiscal_year_id}}';
                audit_plan_id = '{{$audit_plan_id}}';
                let data = {fiscal_year_id, audit_plan_id};
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.error(response.data);
                    } else {
                        $('.audit_apotti_details').html(response);
                        Create_AIR_Container.setJsonContentFromPlanBook();
                    }
                });
            },
        }
    </script>
@endsection
