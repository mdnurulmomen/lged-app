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
                    <a href="{{route('audit.plan.audit.plan.all')}}">
                        <i title="Back To Audit Plan" class="fad fa-backward mr-3"></i>
                    </a>
                    Edit Audit Plan
                </h4>
            </div>
        </div>
        <div class="col-md-6 text-right">
            <button class="btn btn-sm btn-square btn-primary btn-hover-success"
                    onclick="Edit_Entity_Plan_Container.printPlanBook($(this))">PDF <i class="fas fa-save"></i>
            </button>
            <button class="btn btn-sm btn-square btn-primary btn-hover-success draft_entity_audit_plan"
                    data-audit-plan-id="{{$audit_plan['id']}}"
                    data-activity-id="{{$activity_id}}"
                    data-annual-plan-id="{{$annual_plan_id}}"
                    onclick="Edit_Entity_Plan_Container.draftEntityPlan($(this))">Save<i class="fas fa-save"></i>
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
        <div id="split-2">
            <div id="writing-screen-wrapper" style="font-family:SolaimanLipi,serif !important;">
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('scripts.audit_plan.edit.script_edit_entity_compliance_audit_plan')
    <script>
        var Edit_Entity_Plan_Container = {
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
        }
    </script>
@endsection
