<x-title-wrapper>Plan Meetings</x-title-wrapper>
<div class="col-lg-12 pt-5">
    <!--begin::Advance Table Widget 4-->
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0 py-5 justify-content-end">
            <div class="card-toolbar">
                <x-toolbar-button class="btn btn-success btn-sm btn-bold btn-square btn_create_audit_activity"
                                  href="{{route('audit.plan.operational.activity.create')}}">
                    <i class="far fa-plus mr-1"></i> Add Meeting Activity
                </x-toolbar-button>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-0 pb-3">
            <!--begin::Table-->
            <div id="kt_calendar"></div>
            <!--end::Table-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Advance Table Widget 4-->
</div>
