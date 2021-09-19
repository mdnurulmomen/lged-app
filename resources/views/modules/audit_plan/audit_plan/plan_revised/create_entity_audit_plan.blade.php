@extends('layouts.full_width')
@section('styles')
    <style>
        .tox-tinymce {
            height: 78vh !important;
            font-size: 11px !important;
        }
    </style>
@endsection
@section('content')
    <script src="//cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <div class="row m-0 page-title-wrapper d-md-flex align-items-md-center">
        <div class="col-md-6">
            <div class="title py-2">
                <h4 class="mb-0 font-weight-bold">
                    <a href="{{route('audit.plan.audit.plan.all')}}">
                        <i title="Back To Audit Plan" class="fad fa-backward mr-3"></i>
                    </a>
                    Create Audit Plan
                </h4>
            </div>
        </div>
        <div class="col-md-6 text-right">
            <button class="btn btn-sm btn-square btn-primary btn-hover-success"
                    onclick="Create_Entity_Plan_Container.showTeamCreateModal($(this));">Team <i
                    class="fas fa-users"></i>
            </button>
            <button class="btn btn-sm btn-square btn-primary btn-hover-success"
                    onclick="Create_Entity_Plan_Container.printPlanBook($(this))">Print <i class="fas fa-print"></i>
            </button>
            <button class="btn btn-sm btn-square btn-primary btn-hover-success draft_entity_audit_plan"
                    data-activity-id="{{$activity_id}}"
                    data-annual-plan-id="{{$annual_plan_id}}"
                    onclick="Create_Entity_Plan_Container.draftEntityPlan($(this))">Save <i class="fas fa-save"></i>
            </button>
        </div>
    </div>

    <div class="split" id="splitWrapper">
        <div id="split-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="p-5">
                        <div class="input-group mb-5">
                            {{--<input class="form-control rounded-0" type="text" name="" placeholder="Add"
                                   aria-label="Recipient's " aria-describedby="my-addon">
                            <div class="input-group-append rounded-0">
                                <button class="btn btn-success btn-sm btn-square" type="button"><i
                                        class="far fa-plus"></i></button>
                            </div>--}}
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
            {{--            <div class="summernote" id="kt_summernote_1"></div>--}}
        </div>
        <div id="split-2">
            <div id="writing-screen-wrapper" style="font-family:SolaimanLipi,serif !important;">
            </div>
        </div>
    </div>

    <div class="load-office-wise-employee"></div>
    <div class="load-audit-schedule"></div>

@endsection
@section('scripts')
    @if($audit_plan['activity_type'] == 'compliance')
        @include('scripts.script_create_entity_audit_plan_revised')
    @elseif($audit_plan['activity_type'] == 'planning')
        @include('scripts.script_create_entity_audit_plan_revised')
    @endif
    <script>
        var Create_Entity_Plan_Container = {
            showTeamCreateModal: function (elem) {
                url = '{{route('audit.plan.audit.editor.load-office-employee-modal')}}';
                data = {};
                ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                    if (response.status === 'error') {
                        toastr.error('No data found');
                    } else {
                        $(".load-office-wise-employee").html(response)
                        $('#officeEmployeeModal').modal('show');
                    }
                })

            },
            draftEntityPlan: function (elem) {
                url = '{{route('audit.plan.audit.revised.plan.save-draft-entity-audit-plan')}}';

                plan_description = JSON.stringify(templateArray);
                activity_id = elem.data('activity-id');
                annual_plan_id = elem.data('annual-plan-id');
                audit_plan_id = elem.data('audit-plan-id');

                data = {plan_description, activity_id, annual_plan_id, audit_plan_id};
                ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                    if (response.status === 'success') {
                        toastr.success('Audit Plan Saved Successfully');
                    } else {
                        toastr.error('Not Saved');
                        console.log(response)
                    }
                })
            },

            printPlanBook: function (elem) {

                $('.draft_entity_audit_plan').click();

                url = '{{route('audit.plan.audit.revised.plan.print-audit-plan')}}';
                plan = templateArray;
                data = {plan};

                ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                    var newDoc = document.open("text/html", "replace");
                    newDoc.write(response);
                    newDoc.close();
                    /* myWindow = window.open("data:text/html," + encodeURIComponent(response),
                         "_blank", "width=200,height=100");
                     myWindow.focus();*/
                });
            },

            generatePDF: function (elem) {
                url = '{{route('audit.plan.audit.revised.plan.generate-audit-plan-pdf')}}';
                plan = templateArray;
                data = {plan};

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    xhrFields: {
                        responseType: 'blob'
                    },

                    success: function (response) {
                        var blob = new Blob([response]);
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = "audit_plan.pdf";
                        link.click();
                    },

                    error: function (blob) {
                        toastr.error('Failed to generate PDF.')
                        console.log(blob);
                    }

                });
            },
        };
    </script>
@endsection
