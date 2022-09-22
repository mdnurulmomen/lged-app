{{--{{dd($event_list)}}--}}
<div class="toolbar flex-wrap justify-content-between shadow-sm pl-1 d-flex border-bottom">
    <div class="d-flex">
        <div id="daak_group_action_panel">
            <div class="d-flex flex-wrap">
                <div class="btn-group">
                    <div class="dropdown bootstrap-select form-control">
                        <button type="button" tabindex="-1" class="btn dropdown-toggle btn-light border-0"
                                data-toggle="dropdown" role="combobox" aria-owns="bs-select-1"
                                aria-haspopup="listbox" aria-expanded="false" data-id="daak_status_selectpicker"
                                title="সকল">
                            <div class="filter-option">
                                <div class="filter-option-inner">
                                    <div class="filter-option-inner-inner">সকল</div>
                                </div>
                            </div>
                        </button>
                        <div class="dropdown-menu " style="max-height: 406px; overflow: hidden; min-height: 118px;">
                            <div class="inner show" role="listbox" id="bs-select-1" tabindex="-1"
                                 aria-activedescendant="bs-select-1-0"
                                 style="max-height: 406px; overflow-y: auto; min-height: 118px;">
                                <ul class="dropdown-menu inner show" role="presentation"
                                    style="margin-top: 0px; margin-bottom: 0px;">
                                    <li class="selected active"><a role="option"
                                                                   class="dropdown-item active selected"
                                                                   id="bs-select-1-0" tabindex="0" aria-setsize="5"
                                                                   aria-posinset="1" aria-selected="true"><span
                                                class="text">সকল</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <button id="btn-daak-toolbar-reset" class="btn btn-icon mx-1" type="button" data-toggle="tooltip"
                        title="রিসেট">
                    <span class="fas fa-recycle text-warning"></span>
                </button>
                <button id="btn-daak-toolbar-refresh" class="btn btn-icon mx-1" type="button" data-toggle="tooltip"
                        title="রিফ্রেশ">
                    <span class="fa fa-sync text-info"></span>
                </button>
                <div id="personal_folder_selected_name" class="p-2 d-none">
                </div>
            </div>
        </div>
    </div>
    <div id="daak_pagination_panel" class="float-right d-flex align-items-center" style="vertical-align:middle;">
                    <span class="mr-2"><span id="daak_item_length_start">১</span> -
                        <span id="daak_item_length_end">{{enTobn(count($event_list))}}</span>
                        সর্বমোট:
                        <span id="daak_item_total_record">{{enTobn(count($event_list))}}</span>
                    </span>
        <div class="btn-group">
            <button class="btn-list-prev btn btn-icon btn-secondary btn-square" disabled="disabled" type="button"><i
                    class="fad fa-chevron-left" data-toggle="popover" data-content="পূর্ববর্তী"
                    data-original-title="" title=""></i></button>
            <button class="btn-list-next btn btn-icon btn-secondary btn-square" type="button" disabled="disabled"><i
                    class="fad fa-chevron-right" data-toggle="popover" data-content="পরবর্তী" data-original-title=""
                    title=""></i></button>
        </div>
    </div>
</div>

@if(!empty($event_list))
    {{--list view--}}
    <div>
        <ul class="list-group list-group-flush">
            @foreach($event_list as $event)
                <li class="list-group-item py-2 border-bottom">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="pr-2 flex-fill cursor-pointer position-relative">
                            <div class="row d-md-flex flex-wrap align-items-start justify-content-md-between">
                                <!--begin::Title-->
                                <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3 col-md-8">
                                    <div class="font-weight-bolder">
                                        <span class="mr-2 font-size-1-2">ক্রমিক নং:</span>
                                        <span class="font-size-14">{{enTobn($loop->iteration)}}</span>
                                    </div>

                                    <div class="font-weight-normal">
                                        <span class="mr-2 font-size-1-1">অডিট অধিদপ্তর :</span>
                                        <span class="font-size-14">
                                                    {{$event['office_bn']}}
                                            </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap  font-size-1-2">
                                        <span class="mr-1">স্ট্যাটাস :</span>
                                        <span class="font-size-14">
                                                @if ($event['approval_status'] == 'pending')
                                                <span class="badge badge-info text-uppercase m-1 p-1">Pending for Approval</span>
                                            @elseif ($event['approval_status'] == 'reject')
                                                <span class="badge badge-primary text-uppercase m-1 p-1">Return to Audit Directorate</span>
                                            @else
                                                <span
                                                    class="badge badge-success text-uppercase m-1 p-1">{{$event['approval_status']}}</span>
                                            @endif
                                            </span>
                                    </div>
                                    <div class="font-weight-normal">
                                        <span class="mr-2 font-size-1-1">অডিট ধরণ :</span>
                                        <span class="font-size-14">
                                                    {{$event['activity_type'] == 'compliance'?'কমপ্লায়েন্স':$event['activity_type']}}
                                            </span>
                                    </div>
                                    <div class="d-flex mt-3">
                                        @if($event['annual_plan_main']['annual_plan_logs'])
                                            @foreach($event['annual_plan_main']['annual_plan_logs'] as $logs)
                                                <a href="{{ config('amms_bee_routes.file_url').$logs['log_path'] }}"
                                                   title="অফিস আদেশ বিস্তারিত দেখুন"
                                                   class="badge-square rounded-0 badge d-flex align-items-center
                                                       alert-success font-weight-normal mr-1 border decision">
                                                    <i class="fa fa-download mr-2 text-dark-100"></i>
                                                    Annual Plan Log ({{enTobn($loop->iteration)}})
                                                </a>
                                            @endforeach
                                        @endif
                                        <button type="button"
                                                class="mr-1 btn btn-sm btn-details" title="বিস্তারিত দেখুন"
                                                data-office-id="{{$event['office_id']}}"
                                                data-annual-plan-main-id="{{$event['annual_plan_main_id']}}"
                                                data-has-update-request="0"
                                                data-activity-type="{{$event['activity_type']}}"
                                                data-fiscal-year-id="{{$event['fiscal_year_id']}}"
                                                data-office-name-bn="{{$event['office_bn']}}"
                                                onclick="Approve_Plan_List_Container.viewDirectorateWiseAnnualPlan($(this))">
                                            <i style="color: white" class="fad fa-eye"></i>
                                            {{$event['annual_plan_main']['approval_status'] == 'approved' ? 'অনুমোদিত' : ''}}
                                        </button>
                                    </div>
                                </div>
                                <!--end::Title-->
                                <!--begin::Info-->
                                <div class="d-flex align-items-center justify-content-md-end py-lg-0 py-2 col-md-4">
                                    <div class="d-block">
{{--                                        <div class="mt-5 d-flex align-items-center justify-content-md-end">--}}
{{--                                            <div class="mb-2 mt-5 soongukto-wrapper">--}}
{{--                                                <div class="d-flex justify-content-end align-items-center">--}}
{{--                                                    <div class="text-dark-75 ml-3 rdate"--}}
{{--                                                         cspas="date">{{formatDateTime($audit_plan['created_at'],'bn')}}</div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="action-group d-flex justify-content-end position-absolute action-group-wrapper">
                                            @if($event['annual_plan_main']['has_update_request'] == 3)
                                                <button type="button"
                                                        class="mr-1 btn btn-sm btn-details" title="বিস্তারিত দেখুন"
                                                        data-office-id="{{$event['office_id']}}"
                                                        data-annual-plan-main-id="{{$event['annual_plan_main_id']}}"
                                                        data-has-update-request="{{$event['annual_plan_main']['has_update_request']}}"
                                                        data-activity-type="{{$event['activity_type']}}"
                                                        data-fiscal-year-id="{{$event['fiscal_year_id']}}"
                                                        data-office-name-bn="{{$event['office_bn']}}"
                                                        onclick="Approve_Plan_List_Container.viewDirectorateWiseAnnualPlan($(this))">
                                                    <i style="color: white" class="fad fa-eye"></i>
                                                    রিভাইজড
                                                </button>
                                            @endif

                                            @if($event['approval_status'] == 'pending')
                                                    <button class="mr-1 btn btn-sm btn-edit" title=""
                                                            data-op-audit-calendar-event-id="{{$event['op_audit_calendar_event_id']}}"
                                                            data-office-id="{{$event['office_id']}}"
                                                            data-annual-plan-main-id="{{$event['annual_plan_main_id']}}"
                                                            data-activity-type="{{$event['activity_type']}}"
                                                            data-office-name-bn="{{$event['office_bn']}}"
                                                            data-has-update-request="{{$event['annual_plan_main']['has_update_request']}}"
                                                            onclick="Approve_Plan_List_Container.loadOpYearlyEventApprovalForm($(this))">
                                                        <i style="color: white" class="fad fa-check"></i>
                                                        অনুমোদন করুন
                                                    </button>
                                            @endif

{{--                                            @if($audit_plan['has_office_order'] == 1)--}}
{{--                                                @if($audit_plan['has_update_office_order'] == 1)--}}
{{--                                                    <button--}}
{{--                                                        class="mr-1 btn btn-sm btn-details"--}}
{{--                                                        title="বিস্তারিত দেখুন"--}}
{{--                                                        data-office-order-id="{{$audit_plan['office_order_update']['id']}}"--}}
{{--                                                        data-audit-plan-id="{{$audit_plan['id']}}"--}}
{{--                                                        data-annual-plan-id="{{$audit_plan['annual_plan_id']}}"--}}
{{--                                                        onclick="Office_Order_Container.showUpdateOfficeOrder($(this))"--}}
{{--                                                        type="button">--}}
{{--                                                        <i style="color: white" class="fad fa-eye"></i> আপডেট--}}
{{--                                                    </button>--}}
{{--                                                @endif--}}
{{--                                            @endif--}}

{{--                                            @if($audit_plan['has_office_order'] == 1)--}}
{{--                                                @if($audit_plan['office_order']['approved_status'] != 'draft' || (isset($audit_plan['office_order_update']) && $audit_plan['office_order_update']['approved_status'] == 'draft'))--}}
{{--                                                    <button--}}
{{--                                                        class="mr-1 btn btn-sm btn-sent" title="প্রেরণ করুন"--}}
{{--                                                        data-ap-office-order-id="{{$audit_plan['has_update_office_order'] == 1 ? $audit_plan['office_order_update']['id'] : $audit_plan['office_order']['id'] }}"--}}
{{--                                                        data-audit-plan-id="{{$audit_plan['id']}}"--}}
{{--                                                        data-annual-plan-id="{{$audit_plan['annual_plan_id']}}"--}}
{{--                                                        onclick="Office_Order_Container.loadOfficeOrderApprovalAuthority($(this))"--}}
{{--                                                        type="button">--}}
{{--                                                        <i style="color: white" class="fad fa-share-square"></i>--}}
{{--                                                    </button>--}}
{{--                                                @endif--}}

{{--                                                @if(($audit_plan['office_order']['approved_status'] == 'draft' && $audit_plan['office_order']['office_order_movement'] != null--}}
{{--                                                && $audit_plan['office_order']['office_order_movement']['employee_designation_id'] == $current_designation_id) || (isset($audit_plan['office_order_update']) && $audit_plan['office_order_update']['approved_status'] == 'draft' && isset($audit_plan['office_order_update']['office_order_movement']) && $audit_plan['office_order_update']['office_order_movement'] != null--}}
{{--                                                && $audit_plan['office_order_update']['office_order_movement']['employee_designation_id'] == $current_designation_id))--}}
{{--                                                    <button--}}
{{--                                                        class="mr-1 btn btn-approval" title="অনুমোদন করুন"--}}
{{--                                                        data-ap-office-order-id="{{$audit_plan['has_update_office_order'] == 1 ? $audit_plan['office_order_update']['id'] : $audit_plan['office_order']['id'] }}"--}}
{{--                                                        data-audit-plan-id="{{$audit_plan['id']}}"--}}
{{--                                                        data-annual-plan-id="{{$audit_plan['annual_plan_id']}}"--}}
{{--                                                        data-has-office-order-update="{{$audit_plan['has_update_office_order']}}"--}}
{{--                                                        onclick="Office_Order_Container.approveOfficeOrder($(this))"--}}
{{--                                                        type="button">--}}
{{--                                                        <i style="color: white" class="fad fa-check"></i>--}}
{{--                                                    </button>--}}
{{--                                                @endif--}}
{{--                                            @endif--}}
                                        </div>
                                    </div>
                                </div>
                                <!--end::Info-->
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    </div>
@else
    <div class="alert alert-custom alert-white alert-shadow fade show gutter-b" role="alert">
        <div class="alert-icon">
            <i class="text-danger flaticon-warning"></i>
        </div>
        <div class="alert-text">
            {{___('generic.no_data_found')}}
        </div>
    </div>
@endif


