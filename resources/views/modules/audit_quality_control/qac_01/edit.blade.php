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
                    এআইআর
                </h4>
            </div>
        </div>
        <div class="col-md-6 text-right">
            @if($approved_status == 'approved')
                @if($is_sent == 0)
                    <button class="tap-button mr-1 btn btn-sm btn-outline-primary air_sent_responsible_party"
                            onclick="QAC_AIR_Report_Container.airSendToRpu()">
                        <i class="fad fa-paper-plane"></i> রেস্পন্সিবল পার্টিকে প্রেরণ করুন
                    </button>
                @elseif($is_received == null)
                    <span class="badge badge-primary">
                          <i class="fal fa-info text-white"></i>  রেস্পন্সিবল পার্টিকে প্রেরণ করা হয়েছে
                    </span>
                @elseif($is_received == 1)
                    <span class="badge badge-primary">
                          Received
                    </span>
                @endif
            @else
                @if($latest_receiver_designation_id == 0 || $latest_receiver_designation_id == $current_designation_id)
                    <button class="tap-button mr-1 btn btn-sm btn-outline-primary load_approval_authority"
                            title="প্রাপক বাছাই করুন"
                            onclick="QAC_AIR_Report_Container.loadApprovalAuthority()">
                        <i class="fad fa-paper-plane"></i> প্রেরণ করুন
                    </button>
                @endif
            @endif

                <button class="tap-button mr-1 btn btn-sm btn-outline-warning"
                        data-air-id="{{$air_report_id}}"
                        onclick="QAC_AIR_Report_Container.previewAirReport($(this))">
                    <i class="fad fa-eye"></i> Preview
                </button>

            @if($approved_status != 'approved')
                <button class="tap-button mr-1 btn btn-sm btn-outline-primary update-qac-air-report"
                        data-air-id="{{$air_report_id}}"
                        onclick="QAC_AIR_Report_Container.updateAIRReport($(this))">
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

    <script>
        $(function () {
            KTApp.block('#kt_full_width_page', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });
            let approved_status = '{{$approved_status}}';
            if (approved_status != 'approved'){
                $(".update-qac-air-report").click();
                QAC_AIR_Report_Container.setAuditApottiSummary();
                QAC_AIR_Report_Container.setAuditApottiDetails();
                $(".update-qac-air-report").click();
            }
            KTApp.unblock('#kt_full_width_page');
        });

        var QAC_AIR_Report_Container = {
            setJsonContentFromPlanBook:function () {
                templateArray.map(function (value, index) {
                    cover = $("#pdfContent_" + value.content_id).html();
                    value.content = cover;
                });
            },

            updateAIRReport: function (elem) {
                url = '{{route('audit.report.air.qac.update-air-report')}}';
                air_id = elem.data('air-id');
                air_description = JSON.stringify(templateArray);
                data = {air_id,air_description};

                KTApp.block('#kt_full_width_page', {
                    opacity: 0.1,
                    state: 'primary' // a bootstrap color
                });

                ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                    KTApp.unblock('#kt_full_width_page');
                    if (response.status === 'success') {
                        toastr.success('AIR Book Saved Successfully');
                    } else {
                        toastr.error('Not Saved');
                        console.log(response)
                    }
                })
            },

            previewAirReport: function () {
                let approved_status = '{{$approved_status}}';
                if (approved_status != 'approved'){
                    $('.update-qac-air-report').click();
                }
                air_description = templateArray;
                scope = 'preview';
                data = {scope,air_description};
                url = '{{route('audit.report.air.download')}}';

                KTApp.block('#kt_full_width_page', {
                    opacity: 0.1,
                    state: 'primary' // a bootstrap color
                });

                ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                    KTApp.unblock('#kt_full_width_page');
                    if (response.status === 'error') {
                        toastr.error('No data found');
                    } else {
                        $(".offcanvas-title").text('এআইআর');
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

            setAuditApottiSummary: function () {
                url = '{{route('audit.report.air.qac.get-air-wise-qac-apotti')}}';
                qac_type = '{{$qac_type}}';
                apotti_view_scope = 'summary';
                air_id = '{{$air_report_id}}';
                let data = {qac_type,apotti_view_scope,air_id};
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.error(response.data);
                    } else {
                        $('.audit_apotti_summary').html(response);
                        QAC_AIR_Report_Container.setJsonContentFromPlanBook();
                    }
                });
            },


            setAuditApottiDetails: function () {
                url = '{{route('audit.report.air.qac.get-air-wise-qac-apotti')}}';
                qac_type = '{{$qac_type}}';
                apotti_view_scope = 'details';
                air_id = '{{$air_report_id}}';
                let data = {qac_type,apotti_view_scope,air_id};
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
                url = '{{route('audit.report.air.get-approval-authority')}}';
                air_report_id = '{{$air_report_id}}';
                air_type = '{{$qac_type}}';
                data = {air_report_id,air_type};

                KTApp.block('#kt_full_width_page', {
                    opacity: 0.1,
                    state: 'primary' // a bootstrap color
                });

                ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                    KTApp.unblock('#kt_full_width_page');
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

            airSendToRpu: function () {
                let url = '{{route('audit.report.air.air-send-to-rpu')}}';
                air_id = '{{$air_report_id}}';
                let data = {air_id};
                KTApp.block('#kt_full_width_page', {
                    opacity: 0.1,
                    state: 'primary' // a bootstrap color
                });
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    KTApp.unblock('#kt_full_width_page');
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        toastr.success(response.data);
                        $('.air_sent_responsible_party').hide();
                    }
                });
            },
        }

    </script>
@endsection
