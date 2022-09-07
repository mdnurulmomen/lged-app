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
        <div class="col-md-4">
            <div class="title py-2">
                <h4 class="mb-0 font-weight-bold">
                    <a href="">
                        <i title="Back To Annual Plan" class="fad fa-backward mr-3"></i>
                    </a>
                </h4>
            </div>
        </div>
        <div class="col-md-8 text-right">
            <button disabled class="btn btn-sm btn-square btn-info btn-hover-info entity_audit_plan_preview"
                    data-scope-editable="1"
                    onclick="PSR_Plan_Container.previewAuditPlanPSR($(this))">
                <i class="fas fa-eye"></i> Preview
            </button>

            <button class="btn btn-sm btn-square btn-success btn-hover-success draft_entity_audit_plan entity_audit_plan_save"
                    data-annual-plan-id="{{$annual_plan_id}}"
                    data-fiscal-year-id="{{$fiscal_year_id}}"
                    data-activity-id="{{$activity_id}}"
                    onclick="PSR_Plan_Container.draftPSRPlan($(this))">
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
                            <h3>PSR Plan</h3>
                        </div>
                        <!---JS tree start---->
                        <div id="createPlanJsTree" class="mt-5">
                        </div>
                        <!---JS tree end---->
                        <div class="form-group mt-5">
                            {{--<input class="form-control rounded-0" type="text" name="" id="searchPlaneField"
                                   0.placeholder="Search"/>--}}
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
    @include('scripts.annual_plan.psr.create.script_create_psr')

    <script>
        var PSR_Plan_Container = {
            draftPSRPlan: function (elem) {
                url = '{{route('audit.plan.annual.psr.store')}}';
                psr_plan_id = typeof elem.data('psr-plan-id') !== typeof undefined && elem.data('psr-plan-id') !== false ? elem.data('psr-plan-id') : '';
                annual_plan_id = elem.data('annual-plan-id');
                fiscal_year_id = elem.data('fiscal-year-id');
                activity_id = elem.data('activity-id');
                plan_description = JSON.stringify(templateArray);

                KTApp.block('#kt_full_width_page', {
                    opacity: 0.1,
                    message: 'সংরক্ষন হচ্ছে অপেক্ষা করুন',
                    state: 'primary' // a bootstrap color
                });

                data = {plan_description, psr_plan_id, annual_plan_id,fiscal_year_id,activity_id};

                ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                    KTApp.unblock('#kt_full_width_page');
                    if (response.status === 'success') {
                        toastr.success('Audit Plan Saved Successfully');
                        if (!psr_plan_id) {
                            if ($(".entity_audit_plan_save").length){
                                $('.entity_audit_plan_save').attr('data-psr-plan-id', response.data);
                                $('.entity_audit_plan_preview').prop( "disabled", false );
                            }
                        }
                    }else {
                        toastr.error('Not Saved');
                    }
                })
            },

            previewAuditPlanPSR: function (elem) {
                scope_editable = elem.data('scope-editable');
                psr_plan_id = $(".draft_entity_audit_plan").data('psr-plan-id');

                data = {scope_editable,psr_plan_id};
                url = '{{route('audit.plan.annual.psr.psrview')}}';

                KTApp.block('#kt_full_width_page', {
                    opacity: 0.1,
                    message: 'লোড হচ্ছে অপেক্ষা করুন',
                    state: 'primary' // a bootstrap color
                });

                ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                    KTApp.unblock('#kt_full_width_page');
                    if (response.status === 'error') {
                        toastr.error('No data found');
                    } else {
                        $(".offcanvas-title").text('প্ল্যান');
                        quick_panel = $("#kt_quick_panel");
                        quick_panel.addClass('offcanvas-on');
                        quick_panel.css('opacity', 1);
                        quick_panel.css('width', '90%');
                        quick_panel.removeClass('d-none');
                        $("html").addClass("side-panel-overlay");
                        $(".offcanvas-wrapper").html(response);
                    }
                })
            }
        }
    </script>
@endsection
