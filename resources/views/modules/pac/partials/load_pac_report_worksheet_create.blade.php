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
    <input type="hidden" id="pacMeetingWorksheetId">

    <div class="row m-0 page-title-wrapper d-md-flex align-items-md-center">
        <div class="col-md-6">
            <div class="title py-2">
                <h4 class="mb-0 font-weight-bold">
                    <a href="">
                        <i title="Back To Audit Plan" class="fad fa-backward mr-3"></i>
                    </a>
                    বৈঠকের কার্যপত্র
                </h4>
            </div>
        </div>
        <div class="col-md-6 text-right">
            <button class="btn btn-sm btn-square btn-warning btn-hover-warning"
                onclick="PAC_Worksheet_Report_Container.previewPacWorksheetReport()">
                <i class="fad fa-search"></i> Preview
            </button>

            <button class="btn btn-sm btn-square btn-success btn-hover-success pac_worksheet_save"
                data-pac-meeting-id="" onclick="PAC_Worksheet_Report_Container.storePacWorksheetReport($(this))">
                <i class="fas fa-save"></i> সংরক্ষণ করুন
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
                        <div class="form-group mt-5"></div>
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
    @include('scripts.pac_report.create.script_create')
    @include('scripts.pac_report.script_report')

    <script>
        $(function () {
            PAC_Report_Create_Container.addAuditApotti();
        });

        var PAC_Report_Create_Container = {
            setJsonContentFromPlanBook:function () {
                templateArray.map(function (value, index) {
                    cover = $("#pdfContent_" + value.content_id).html();
                    value.content = cover;
                });
            },

            addAuditApotti: function () {
                url = '{{route('pac.meeting-worksheet-report.get-audit-apotti')}}';
                let data = {};
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.error(response.data);
                    } else {
                        $('.apotti_details').html(response);
                        PAC_Report_Create_Container.setJsonContentFromPlanBook();
                    }
                });
            },
        }
    </script>
@endsection
