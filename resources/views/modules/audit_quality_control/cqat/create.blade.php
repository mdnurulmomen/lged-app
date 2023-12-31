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
                    অডিট রিপোর্ট
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

            <button class="btn btn-sm btn-square btn-info btn-hover-info"
                    data-air-id="{{$air_report_id}}"
                    onclick="QAC_AIR_Report_Container.previewAirReport($(this))">
                <i class="fad fa-search"></i> Preview
            </button>

            @if($approved_status != 'approved')
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
            <div id="writing-screen-wrapper" style="font-family:Nikosh,serif !important;">
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('scripts.audit_inspection_report.report.create.script_create')

    <script>
        $(function () {
            KTApp.block('#kt_full_width_page', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });
            //$(".update-qac-air-report").click();
            QAC_AIR_Report_Container.setAuditApottiSummary();
            QAC_AIR_Report_Container.setAuditApottiDetails();
            QAC_AIR_Report_Container.setAIRContentWiseData();
            //$(".update-qac-air-report").click();
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
                        toastr.success('Audit Report Saved Successfully');
                    } else {
                        toastr.error('Not Saved');
                        console.log(response)
                    }
                })
            },

            previewAirReport: function () {
                let approved_status = '{{$approved_status}}';
                if (approved_status != 'approved') {
                    $('.update-qac-air-report').click();
                }
                air_description = templateArray;
                scope = 'preview';
                data = {scope, air_description};
                url = '{{route('audit.report.air.final-report.preview')}}';

                KTApp.block('#kt_full_width_page', {
                    opacity: 0.1,
                    state: 'primary' // a bootstrap color
                });

                ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                    KTApp.unblock('#kt_full_width_page');
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

            setAuditApottiSummary: function () {
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


            setAuditApottiDetails: function () {
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

            setAIRContentWiseData: function () {
                url = '{{route('audit.report.air.get-air-wise-content-key')}}';
                relational_id = '{{$parent_air_id}}';
                template_type = 'qac-2';
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

                        $('.div_preface_cover').html(response.data.preface_cover_page);
                        $('.div_audit_report_info').html(response.data.audit_report_info_page);
                        $('.div_audit_organization_info').html(response.data.audit_organization_info_page);
                        $('.div_legal_basis_audit').html(response.data.legal_basis_audit_page);
                        $('.div_scope_audit').html(response.data.scope_audit_page);
                        $('.div_audit_planning_and_management').html(response.data.audit_planning_and_management_page);
                        $('.div_executive_summary').html(response.data.executive_summary_page);
                        $('.div_abbreviation_words').html(response.data.abbreviation_words_page);
                        QAC_AIR_Report_Container.setJsonContentFromPlanBook();
                        KTApp.unblock("#kt_full_width_page");
                    }
                });
            },

            loadApprovalAuthority: function () {
                url = '{{route('audit.report.air.get-approval-authority')}}';
                air_report_id = '{{$air_report_id}}';
                air_type = '{{$qac_type}}';
                office_id = '{{$office_id}}';
                // alert(office_id);
                data = {air_report_id, air_type, office_id};

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


                    url = '{{route('audit.report.air.final-report.download')}}';

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
                            link.download = "Final_Report_ " + new Date().toDateString().replace(/ /g,
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
