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
                    অডিট রিপোর্ট
                </h4>
            </div>
        </div>
        <div class="col-md-6 text-right">
                @if($desk_office_id == 1 && $current_designation_grade == 1)
                    @if($latest_receiver_designation_id == 0 || $latest_receiver_designation_id == $current_designation_id)
                        <button class="btn btn-sm btn-square btn-warning btn-hover-warning load_cag_approval_authority"
                                    title="অনুমোদন করুন"
                                    onclick="QAC_AIR_Report_Container.loadCagFinalApproval()">
                                <i class="fad fa-paper-plane"></i> অনুমোদন করুন
                        </button>
                    @endif
                @else
                    @if($latest_receiver_designation_id == 0 || $latest_receiver_designation_id == $current_designation_id)
                        <button class="btn btn-sm btn-square btn-warning btn-hover-warning load_cag_approval_authority"
                                title="প্রাপক বাছাই করুন"
                                onclick="QAC_AIR_Report_Container.loadCagAuthority()">
                            <i class="fad fa-paper-plane"></i> {{$desk_office_id == 1 ? 'নিজ অফিসে প্রেরণ করুন' : 'সিএজিতে প্রেরণ করুন' }}
                        </button>
                    @endif

                    @if($latest_receiver_designation_id == 0 || $latest_receiver_designation_id == $current_designation_id)
                        <button class="btn btn-sm btn-square btn-warning btn-hover-warning load_approval_authority"
                                title=" অধিদপ্তর প্রেরণ করুন"
                                onclick="QAC_AIR_Report_Container.loadApprovalAuthority()">
                            <i class="fad fa-paper-plane"></i> {{$desk_office_id == 1 ? 'অধিদপ্তর প্রেরণ' : 'নিজ অফিসে প্রেরণ করুন' }}
                        </button>
                    @endif
                @endif


            <button class="btn btn-sm btn-square btn-info btn-hover-info"
                    data-air-id="{{$air_report_id}}"
                    onclick="QAC_AIR_Report_Container.previewAirReport($(this))">
                <i class="fad fa-search"></i> Preview
            </button>

            @if(!$printing_done)
                @if($latest_receiver_designation_id == 0 || $latest_receiver_designation_id == $current_designation_id)
                    <button class="btn btn-sm btn-square btn-success btn-hover-success update-qac-air-report"
                            data-air-id="{{$air_report_id}}"
                            onclick="QAC_AIR_Report_Container.updateAIRReport($(this))">
                        <i class="fas fa-save"></i> Update
                    </button>
                @endif
            @endif
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
    @include('scripts.audit_inspection_report.report.create.script_create')

    <script>
        {{--$(function () {--}}
        {{--    let approved_status = '{{$approved_status}}';--}}
        {{--    if (approved_status != 'approved') {--}}
        {{--        $(".update-qac-air-report").click();--}}
        {{--        QAC_AIR_Report_Container.insertAuditApottiSummary();--}}
        {{--        QAC_AIR_Report_Container.insertAuditApottiDetails();--}}
        {{--        $(".update-qac-air-report").click();--}}
        {{--    }--}}
        {{--});--}}

        var QAC_AIR_Report_Container = {
            setJsonContentFromPlanBook: function () {
                templateArray.map(function (value, index) {
                    cover = $("#pdfContent_" + value.content_id).html();
                    value.content = cover;
                });
            },

            updateAIRReport: function (elem) {
                url = '{{route('audit.report.air.qac.update-air-report')}}';
                air_id = elem.data('air-id');
                air_description = JSON.stringify(templateArray);
                office_id = '{{$office_id}}';
                data = {air_id, air_description,office_id};
                ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                    if (response.status === 'success') {
                        toastr.success('Audit Report Saved Successfully');
                    } else {
                        toastr.error('Not Saved');
                        console.log(response)
                    }
                })
            },

            previewAirReport: function () {
                let approved_status = '{{$approved_status}}';
                // if (approved_status != 'approved') {
                //     $('.update-qac-air-report').click();
                // }
                air_description = templateArray;
                scope = 'preview';
                data = {scope, air_description};
                url = '{{route('audit.report.air.final-report.preview')}}';

                KTApp.block('#kt_content', {
                    opacity: 0.1,
                    state: 'primary' // a bootstrap color
                });

                ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                    KTApp.unblock('#kt_content');
                    if (response.status === 'error') {
                        toastr.error('No data found');
                    } else {
                        $(".offcanvas-title").text('অডিট রিপোর্ট');
                        quick_panel = $("#kt_quick_panel");
                        quick_panel.addClass('offcanvas-on');
                        quick_panel.css('opacity', 1);
                        quick_panel.css('width', '70%');
                        quick_panel.removeClass('d-none');
                        $("html").addClass("side-panel-overlay");
                        $(".offcanvas-wrapper").html(response);
                    }
                });
            },

            insertAuditApottiSummary: function () {
                url = '{{route('audit.report.air.qac.get-air-wise-qac-apotti')}}';
                qac_type = '{{$qac_type}}';
                apotti_view_scope = 'summary';
                air_id = '{{$air_report_id}}';
                let data = {qac_type, apotti_view_scope, air_id};
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.error(response.data);
                    } else {
                        $('.audit_apotti_summary').html(response);
                        QAC_AIR_Report_Container.setJsonContentFromPlanBook();
                    }
                });
            },


            insertAuditApottiDetails: function () {
                url = '{{route('audit.report.air.qac.get-air-wise-qac-apotti')}}';
                qac_type = '{{$qac_type}}';
                apotti_view_scope = 'details';
                air_id = '{{$air_report_id}}';
                let data = {qac_type, apotti_view_scope, air_id};
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.error(response.data);
                    } else {
                        $('.audit_apotti_details').html(response);
                        QAC_AIR_Report_Container.setJsonContentFromPlanBook();
                    }
                });
            },

            loadApprovalAuthority: function () {
                url = '{{route('audit.final-report.get-final-approval-authority')}}';
                air_report_id = '{{$air_report_id}}';
                air_type = '{{$qac_type}}';
                office_id = '{{$office_id}}';
                data = {air_report_id, air_type, office_id};

                KTApp.block('.content', {
                    opacity: 0.1,
                    state: 'primary' // a bootstrap color
                });

                ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                    KTApp.unblock('.content');
                    if (response.status === 'error') {
                        toastr.error('No data found');
                    } else {
                        $(".offcanvas-title").text('');
                        quick_panel = $("#kt_quick_panel");
                        quick_panel.addClass('offcanvas-on');
                        quick_panel.css('opacity', 1);
                        quick_panel.css('width', '40%');
                        quick_panel.removeClass('d-none');
                        $("html").addClass("side-panel-overlay");
                        $(".offcanvas-wrapper").html(response);
                    }
                });
            },

            loadCagAuthority: function () {
                url = '{{route('audit.report.air.get-cag-authority')}}';
                air_report_id = '{{$air_report_id}}';
                air_type = '{{$qac_type}}';
                office_id = '{{$office_id}}';
                data = {air_report_id,air_type,office_id};

                KTApp.block('.content', {
                    opacity: 0.1,
                    state: 'primary' // a bootstrap color
                });

                ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                    KTApp.unblock('.content');
                    if (response.status === 'error') {
                        toastr.error('No data found');
                    } else {
                        $(".offcanvas-title").text('');
                        quick_panel = $("#kt_quick_panel");
                        quick_panel.addClass('offcanvas-on');
                        quick_panel.css('opacity', 1);
                        quick_panel.css('width', '40%');
                        quick_panel.removeClass('d-none');
                        $("html").addClass("side-panel-overlay");
                        $(".offcanvas-wrapper").html(response);
                    }
                });
            },

            loadCagFinalApproval: function () {
                url = '{{route('audit.report.air.get-cag-final-approval-form')}}';
                air_report_id = '{{$air_report_id}}';
                air_type = '{{$qac_type}}';
                office_id = '{{$office_id}}';
                data = {air_report_id,air_type,office_id};

                KTApp.block('.content', {
                    opacity: 0.1,
                    state: 'primary' // a bootstrap color
                });

                ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                    KTApp.unblock('.content');
                    if (response.status === 'error') {
                        toastr.error('No data found');
                    } else {
                        $(".offcanvas-title").text('');
                        quick_panel = $("#kt_quick_panel");
                        quick_panel.addClass('offcanvas-on');
                        quick_panel.css('opacity', 1);
                        quick_panel.css('width', '40%');
                        quick_panel.removeClass('d-none');
                        $("html").addClass("side-panel-overlay");
                        $(".offcanvas-wrapper").html(response);
                    }
                });
            },
        }
    </script>
@endsection
