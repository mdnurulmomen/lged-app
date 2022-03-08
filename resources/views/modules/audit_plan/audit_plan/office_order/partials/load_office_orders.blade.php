@if(!empty($audit_plans['data']))
    <div class="card sna-card-border mt-3" style="margin-bottom:30px;">
        <div class="search-all position-relative">
            <div class="row">
                <div class="col align-self-start">
                    <div class="input-group-append">
                        <button class="btn btn-icon btn-light-info btn-square advanced_button" type="button"><i
                                class="fa fa-caret-down"></i>
                        </button>
                        <input type="text" placeholder="অনুসন্ধান করুন" class="form-control rounded-0">
                        <button data-toggle="tooltip" data-placement="left" title="খুঁজুন"
                                class="btn btn-icon btn-light-success btn-square" type="button"><i
                                class="fad fa-search"></i>
                        </button>
                        <button data-toggle="tooltip" data-placement="left" title="রিসেট"
                                class="btn btn-icon btn-light-danger btn-square" id="reset_btn" type="reset"><i
                                class="fad fa-recycle"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

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
                    <span class="mr-2"><span id="daak_item_length_start">১</span> - <span id="daak_item_length_end">৫</span> সর্বমোট: <span
                            id="daak_item_total_record">৫</span></span>
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

        {{--list view--}}
        <div>
            <ul class="list-group list-group-flush">
                @foreach($audit_plans['data'] as $audit_plan)
                    <li class="list-group-item py-2 border-bottom">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="pr-2 flex-fill cursor-pointer position-relative">
                                <div class="row d-md-flex flex-wrap align-items-start justify-content-md-between">
                                    <!--begin::Title-->
                                    <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3 col-md-8">
                                        <div class="font-weight-normal">
                                            <span class="mr-2 font-size-1-1">{{___('generic.list_views.plan.audit_plan.ministry_or_bivag')}}</span>
                                            <span class="font-size-14">
                                                    @php
                                                        $ministries = [];
                                                        foreach($audit_plan['annual_plan']['ap_entities'] as $ap_entities){
                                                            $ministry =  $ap_entities['ministry_name_bn'];
                                                            $ministries[] = $ministry;
                                                        }
                                                    @endphp
                                                {{implode(' , ', array_unique($ministries))}}
                                                </span>
                                        </div>
                                        <div class="d-flex align-items-center flex-wrap  font-size-1-2">
                                            <span class="mr-1">{{___('generic.list_views.plan.audit_plan.entity_or_institute')}}</span>
                                            <a href="javascript:void(0)" class="text-info font-size-h5">
                                                @php
                                                    $entities = [];
                                                    foreach($audit_plan['annual_plan']['ap_entities'] as $ap_entities){
                                                        $entity =  $ap_entities['entity_name_bn'];
                                                        $entities[] = $entity;
                                                    }
                                                @endphp
                                                {{implode(' , ', array_unique($entities))}}
                                            </a>
                                        </div>
                                        <div class="font-weight-normal">
                                            <span class="mr-2 font-size-1-1">{{___('generic.list_views.plan.audit_plan.institute_type')}}</span>
                                            <span class="font-size-14">
                                                    {{$audit_plan['annual_plan']['office_type']}}
                                                </span>
                                        </div>
                                        <div class="font-weight-normal">
                                            <span class="mr-2 font-size-1-1">প্ল্যানঃ</span>
                                            <span class="font-size-14">
                                                    অডিট প্ল্যান {{enTobn($audit_plan['id'])}}
                                                </span>
                                            <span class="label label-outline-danger label-pill label-inline">
                                                    {{$audit_plan['office_order'] != null? ucfirst($audit_plan['office_order']['approved_status']):'অফিস অর্ডার তৈরি হয়নি'}}
                                                </span>
                                        </div>
                                        <div class="font-weight-normal d-none predict-wrapper">
                                            <span class="predict-label text-success "></span>
                                        </div>
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Info-->
                                    <div class="d-flex align-items-center justify-content-md-end py-lg-0 py-2 col-md-4">
                                        <div class="d-block">
                                            <div
                                                class="d-md-flex flex-wrap mb-2 align-items-center justify-content-md-end text-nowrap">
                                                <div class="ml-3  d-flex align-items-center text-primary">
                                                    <i class="flaticon2-copy mr-2 text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-md-end">
                                                <div class="mb-2 mt-3 soongukto-wrapper">
                                                    <div class="d-flex justify-content-end align-items-center">
                                                        <div class="text-dark-75 ml-3 rdate" cspas="date">{{formatDateTime($audit_plan['created_at'],'bn')}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="action-group d-flex justify-content-end position-absolute action-group-wrapper">
                                                @if($audit_plan['has_office_order'] == 0)
                                                    <button class="mr-3 btn btn-sm btn-create" title="অফিস অর্ডার তৈরি করুন"
                                                            data-audit-plan-id="{{$audit_plan['id']}}"
                                                            data-annual-plan-id="{{$audit_plan['annual_plan_id']}}"
                                                            onclick="Office_Order_Container.loadOfficeOrderCreateForm($(this))">
                                                        <i style="color:#ffffff;" class="fad fa-plus-circle"></i> অফিস অর্ডার তৈরি করুন
                                                    </button>
                                                @endif

                                                @if($audit_plan['has_office_order'] == 1)
                                                    @if($audit_plan['office_order']['approved_status'] == 'draft')
                                                        <button class="mr-1 btn btn-sm btn-edit" title="হালনাগাদ করুন"
                                                                data-audit-plan-id="{{$audit_plan['id']}}"
                                                                data-annual-plan-id="{{$audit_plan['annual_plan_id']}}"
                                                                onclick="Office_Order_Container.loadOfficeOrderCreateForm($(this))">
                                                            <i style="color: white" class="fad fa-edit"></i>
                                                        </button>
                                                    @endif
                                                @endif


                                                @if($audit_plan['has_office_order'] == 1)
                                                    <button
                                                        class="mr-1 btn btn-sm btn-details" title="বিস্তারিত দেখুন"
                                                        data-audit-plan-id="{{$audit_plan['id']}}"
                                                        data-annual-plan-id="{{$audit_plan['annual_plan_id']}}"
                                                        onclick="Office_Order_Container.showOfficeOrder($(this))" type="button">
                                                        <i style="color: white" class="fad fa-eye"></i>
                                                    </button>
                                                @endif

                                                @if($audit_plan['has_office_order'] == 1)
                                                    @if($audit_plan['office_order']['approved_status'] == 'draft')
                                                        <button
                                                            class="mr-1 btn btn-sm btn-sent" title="প্রেরণ করুন"
                                                            data-ap-office-order-id="{{$audit_plan['office_order']['id']}}"
                                                            data-audit-plan-id="{{$audit_plan['id']}}"
                                                            data-annual-plan-id="{{$audit_plan['annual_plan_id']}}"
                                                            onclick="Office_Order_Container.loadOfficeOrderApprovalAuthority($(this))"
                                                            type="button">
                                                            <i style="color: white" class="fad fa-share-square"></i>
                                                        </button>
                                                    @endif

                                                    @if($audit_plan['office_order']['approved_status'] == 'draft' && $audit_plan['office_order']['office_order_movement'] != null
                                                    && $audit_plan['office_order']['office_order_movement']['employee_designation_id'] == $current_designation_id)
                                                        <button
                                                            class="mr-1 btn btn-approval" title="অনুমোদন করুন"
                                                            data-ap-office-order-id="{{$audit_plan['office_order']['id']}}"
                                                            data-audit-plan-id="{{$audit_plan['id']}}"
                                                            data-annual-plan-id="{{$audit_plan['annual_plan_id']}}"
                                                            onclick="Office_Order_Container.approveOfficeOrder($(this))"
                                                            type="button">
                                                            <i style="color: white" class="fad fa-check"></i>
                                                        </button>
                                                    @endif
                                                @endif
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

