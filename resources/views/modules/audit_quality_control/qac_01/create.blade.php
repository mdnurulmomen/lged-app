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

    <div class="row m-0 mb-3 page-title-wrapper d-md-flex align-items-md-center shadow-sm">
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
                    <button class="btn btn-sm btn-square btn-warning btn-hover-warning load_approval_authority"
                            title="প্রাপক বাছাই করুন"
                            onclick="QAC_AIR_Report_Container.loadApprovalAuthority()">
                        <i class="fad fa-paper-plane"></i> প্রেরণ করুন
                    </button>
                @endif
            @endif

            <div class="dropdown dropdown-inline btn-outline-primary tap-button">
                <a href="#" class="btn btn-sm dropdown-toggle px-5 tap-button btn-outline-primary"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fad fa-download"></i> ডাউনলোড
                </a>
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="">
                    <!--begin::Navigation-->
                    <ul class="navi navi-hover">
                        <li class="navi-item">
                            <a href="javascript:;" onclick="QAC_AIR_Report_Container.downloadAIRReport('forwarding_letter')" class="navi-link">
                                <i class="fad fa-archive mr-3"></i>
                                <span class="navi-text">ফরোয়ার্ডিং লেটার</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="javascript:;" onclick="QAC_AIR_Report_Container.downloadAIRReport('apotti_air')" class="navi-link">
                                <i class="fad fa-archive mr-3"></i>
                                <span class="navi-text">এআইআর আপত্তি সমূহ</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="javascript:;" onclick="QAC_AIR_Report_Container.downloadAIRReport('porishisto_air')" class="navi-link">
                                <i class="fab fa-palfed mr-3"></i>
                                <span class="navi-text">এআইআর পরিশিষ্ট সমূহ</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="javascript:;" onclick="QAC_AIR_Report_Container.downloadAIRReport('full_air')" class="navi-link">
                                <i class="fad fa-box-full mr-3"></i>
                                <span class="navi-text">সম্পূর্ণ এআইআর</span>
                            </a>
                        </li>
                    </ul>
                    <!--end::Navigation-->
                </div>
            </div>

            <button class="tap-button mr-1 btn btn-sm btn-outline-warning"
                    data-air-id="{{$air_report_id}}"
                    onclick="QAC_AIR_Report_Container.previewAirReport($(this))">
                <i class="fad fa-eye"></i> Preview
            </button>

            @if($approved_status != 'approved')
                @if($latest_receiver_designation_id == 0 || $latest_receiver_designation_id == $current_designation_id)
                    <button class="tap-button mr-1 btn btn-sm btn-outline-primary update-qac-air-report"
                            data-air-id="{{$air_report_id}}"
                            onclick="QAC_AIR_Report_Container.updateAIRReport($(this))">
                        <i class="fas fa-save"></i> সংরক্ষণ করুন
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
    @include('scripts.audit_inspection_report.qac_1.create.script_create')

    <script>
        $(function () {
            KTApp.block('#kt_full_width_page', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });
            let approved_status = '{{$approved_status}}';
            let report_type = '{{$report_type}}';
            if (approved_status != 'approved') {
                $(".update-qac-air-report").click();
                /*if (report_type == 'cloned'){}*/
                QAC_AIR_Report_Container.setAIRContentWiseData();
                QAC_AIR_Report_Container.setAuditTeam();
                QAC_AIR_Report_Container.setAuditApottiSummary('sfi');
                QAC_AIR_Report_Container.setAuditApottiSummary('non-sfi');
                QAC_AIR_Report_Container.setAuditApottiDetails('sfi');
                QAC_AIR_Report_Container.setAuditApottiDetails('non-sfi');
                //QAC_AIR_Report_Container.setAuditApottiWisePrisistos();
                $(".update-qac-air-report").click();
            }
            KTApp.unblock('#kt_full_width_page');
        });

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
                data = {air_id, air_description};

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

            setAuditTeam: function () {
                url = '{{route('audit.report.air.get-audit-team')}}';
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
                        QAC_AIR_Report_Container.setJsonContentFromPlanBook();
                    }
                });
            },

            previewAirReport: function () {
                let approved_status = '{{$approved_status}}';
                if (approved_status != 'approved') {
                    $('.update-qac-air-report').click();
                }
                air_description = templateArray;
                data = {air_description};
                url = '{{route('audit.report.air.qac1.preview')}}';

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

            setAuditApottiSummary: function (apotti_type) {
                url = '{{route('audit.report.air.qac.get-air-and-apotti-type-wise-qac-apotti')}}';
                qac_type = '{{$qac_type}}';
                apotti_view_scope = 'summary';
                air_id = '{{$air_report_id}}';
                let data = {qac_type, apotti_view_scope, air_id, apotti_type};
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.error(response.data);
                    } else {
                        if (apotti_type == 'sfi') {
                            $('.audit_sfi_apotti_summary').html(response);
                        } else if (apotti_type == 'non-sfi') {
                            $('.audit_non_sfi_apotti_summary').html(response);
                        }
                        QAC_AIR_Report_Container.setJsonContentFromPlanBook();
                    }
                });
            },


            setAuditApottiDetails: function (apotti_type) {
                url = '{{route('audit.report.air.qac.get-air-and-apotti-type-wise-qac-apotti')}}';
                qac_type = '{{$qac_type}}';
                apotti_view_scope = 'details';
                air_id = '{{$air_report_id}}';
                let data = {qac_type, apotti_view_scope, air_id, apotti_type};
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.error(response.data);
                    } else {
                        if (apotti_type == 'sfi') {
                            $('.audit_sfi_apotti_details').html(response);
                        } else if (apotti_type == 'non-sfi') {
                            $('.audit_non_sfi_apotti_details').html(response);
                        }
                        QAC_AIR_Report_Container.setJsonContentFromPlanBook();
                    }
                });
            },

            setAuditApottiWisePrisistos: function () {
                url = '{{route('audit.report.air.qac.get-air-wise-porisistos')}}';
                air_id = '{{$air_report_id}}';
                let data = {air_id};
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.error(response.data);
                    } else {
                        $('.audit_apotti_porisistos').html(response);
                        QAC_AIR_Report_Container.setJsonContentFromPlanBook();
                    }
                });
            },


            loadApprovalAuthority: function () {
                url = '{{route('audit.report.air.get-approval-authority')}}';
                air_report_id = '{{$air_report_id}}';
                air_type = '{{$qac_type}}';
                data = {air_report_id, air_type};

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

            setAIRContentWiseData: function () {
                url = '{{route('audit.report.air.get-air-wise-content-key')}}';
                relational_id = '{{$parent_air_id}}';
                template_type = 'draft_air';
                let data = {relational_id, template_type};
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.error(response.data);
                    } else {

                        KTApp.block('#kt_full_width_page', {
                            opacity: 0.1,
                            message: 'ডাটা লোড হচ্ছে অপেক্ষা করুন...',
                            state: 'primary' // a bootstrap color
                        });

                        $('.div_entity_short_description').html(response.data.entity_short_description);
                        $('.div_audit_coverage').html(response.data.audit_coverage);
                        $('.div_critical').html(response.data.critical);
                        $('.div_standards').html(response.data.standards);
                        $('.div_audit_team_visit_unit').html(response.data.audit_team_visit_unit);
                        $('.div_idea_about_entity').html(response.data.idea_about_entity);
                        $('.div_list_of_recrods').html(response.data.list_of_recrods);
                        $('.div_information_provide_by_entity').html(response.data.information_provide_by_entity);
                        $('.div_information_not_provide_by_entity').html(response.data.information_not_provide_by_entity);
                        $('.div_number_of_meeting_and_date').html(response.data.number_of_meeting_and_date);
                        $('.div_during_audit_total_number_of_audit_queries_issued').html(response.data.during_audit_total_number_of_audit_queries_issued);
                        $('.div_number_of_answered_query').html(response.data.number_of_answered_query);
                        $('.div_jarikrito_number_of_audit_observation').html(response.data.jarikrito_number_of_audit_observation);
                        $('.div_answered_number_of_audit_observation').html(response.data.answered_number_of_audit_observation);
                        $('.div_number_of_draft_observation').html(response.data.number_of_draft_observation);
                        $('.div_observation_not_raised_during_audit').html(response.data.observation_not_raised_during_audit);
                        $('.audit_apotti_porisistos').html('<h1 class="text-center">পরিশিষ্টসমূহ ডাউলোড এর পর দেখতে পারবেন।</h1>');
                        QAC_AIR_Report_Container.setJsonContentFromPlanBook();
                        KTApp.unblock("#kt_full_width_page");
                    }
                });
            },

            downloadAIRReport: function(scope = 'only_apotti') {
                air_description = templateArray;
                air_id = '{{$air_report_id}}';

                if (air_id){
                    data = {
                        scope,
                        air_id,
                        air_description
                    };

                    KTApp.block('#kt_full_width_page', {
                        opacity: 0.1,
                        message: 'ডাউনলোড হচ্ছে অপেক্ষা করুন...',
                        state: 'primary' // a bootstrap color
                    });


                    url = '{{route('audit.report.air.qac1.download')}}';

                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: data,
                        xhrFields: {
                            responseType: 'blob'
                        },
                        success: function(response) {
                            KTApp.unblock("#kt_full_width_page");
                            var blob = new Blob([response]);
                            var link = document.createElement('a');
                            link.href = window.URL.createObjectURL(blob);
                            link.download = "QAC1 Report " + new Date().toDateString().replace(/ /g,
                                "_") + ".pdf";
                            link.click();
                        },
                        error: function(blob) {
                            KTApp.unblock("#kt_quick_panel");
                            toastr.error('Failed to generate PDF.')
                            console.log(blob);
                        }
                    });
                }else {
                    toastr.error('এআইআর সংরক্ষন করুন');
                }
            }
        }
    </script>
@endsection
