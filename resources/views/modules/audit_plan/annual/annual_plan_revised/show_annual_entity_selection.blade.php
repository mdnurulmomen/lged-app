<div class="card sna-card-border mt-3" style="margin-bottom:30px;">

    <div class="table-search-header-wrapper mb-4 pt-3 pb-3 shadow-sm">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-md-7">
                    @if(!is_null($plan_list))
                        @if($current_designation_grade == 2 || $current_designation_grade == 3 || $current_designation_grade == 5)
                            @if($plan_list['approval_status'] == 'draft' || $plan_list['approval_status'] == 'reject')
                                <button class="btn btn-sm btn-primary btn-square mr-1"
                                        data-annual-plan-main-id="{{$plan_list['id']}}"
                                        data-activity-type="{{$plan_list['activity_type']}}"
                                        data-fiscal-year-id="{{$fiscal_year_id}}"
                                        data-op-audit-calendar-event-id="{{$op_audit_calendar_event_id}}"
                                        onclick="Annual_Plan_Container.loadAnnualPlanApprovalAuthority($(this))">
                                    <i class="fad fa-paper-plane"></i>
                                    ওসিএজিতে প্রেরণ
                                </button>
                            @endif
                        @endif

                       @if($current_office_id != 1)
                            <button data-office-id="{{$office_id}}" data-fiscal-year-id="{{$fiscal_year_id}}"
                                    data-annual-plan-main-id="{{$plan_list['id']}}"
                                    data-activity-type="{{$plan_list['activity_type']}}"
                                    onclick="Annual_Plan_Container.printAnnualPlan($(this))"
                                    class="btn btn-sm btn-primary btn-square mr-1">
                                <i class="fad fa-file-download"></i>
                                ডাউনলোড
                            </button>

                            <button class="btn btn-sm btn-info btn-square mr-1"
                                    data-annual-plan-main-id="{{$plan_list['id']}}"
                                    data-fiscal-year-id="{{$fiscal_year_id}}"
                                    data-op-audit-calendar-event-id="{{$op_audit_calendar_event_id}}"
                                    onclick="Annual_Plan_Container.movementHistory($(this))">
                                <i class="fad fa-eye"></i>
                                লগ
                            </button>
                       @endif

                        <span class="badge badge-info text-uppercase m-1 p-1 ">
                            @if ($plan_list['approval_status'] == 'pending')
                                Pending for Approval
                            @elseif ($plan_list['approval_status'] == 'reject')
                                Return to Audit Directorate
                            @else
                                {{$plan_list['approval_status']}}
                            @endif
                        </span>
                    @endif
                </div>
                {{--            @php dump($plan_list) @endphp--}}
                @if((!$plan_list) || (isset($plan_list['approval_status']) && $plan_list['approval_status'] == 'draft' || $plan_list['approval_status']  == 'reject') && $current_office_id != 1)
                    <div class="col-md-5">
                        <div class="d-flex justify-content-md-end">
                            <a onclick="Annual_Plan_Container.addPlanInfo($(this))"
                               data-annual-plan-main-id="{{isset($plan_list['id']) ? $plan_list['id'] : 0}}"
                               data-fiscal-year-id="{{$fiscal_year_id}}"
                               data-op-audit-calendar-event-id="{{$op_audit_calendar_event_id}}"
                               class="btn btn-sm btn-info btn-square mr-1"
                               href="javascript:;">
                                <i class="fas fa-plus-circle mr-1"></i>
                                @if(session('dashboard_audit_type') != 'Performance Audit')
                                    রেস্পন্সিবল পার্টি যোগ করুন
                                @else
                                    নতুন টপিক যোগ করুন
                                @endif

                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
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
                    <span class="mr-2"><span id="daak_item_length_start">{{count($plan_list['annual_plan_items']) > 1 ?'১':'০'}}</span> - <span
                            id="daak_item_length_end">{{enTobn(count($plan_list['annual_plan_items'] ?? []))}}</span> সর্বমোট: <span
                            id="daak_item_total_record">{{enTobn(count($plan_list['annual_plan_items']?? []))}}</span></span>

        </div>
    </div>

    {{--list view--}}
    @if(!empty($plan_list))
        <div>
            <ul class="list-group list-group-flush">
                @foreach($plan_list['annual_plan_items'] as $plan)
                    <li class="list-group-item py-2 border-bottom {{$plan['activity']['activity_key']}}">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="pr-2 flex-fill cursor-pointer position-relative">
                                <div class="row d-md-flex flex-wrap align-items-start justify-content-md-between">
                                    <!--begin::Title-->
                                    <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3 col-md-7">
                                        <div class="font-weight-normal">
                                            <span
                                                class="mr-2 font-size-1-1">{{___('generic.list_views.plan.audit_plan.ministry_or_bivag')}}</span>
                                            <span class="font-size-14">
                                                @php
                                                    $ministries = [];
                                                    foreach($plan['ap_entities'] as $ap_entities){
                                                        $ministry =  $ap_entities['ministry_name_bn'];
                                                        $ministries[] = $ministry;
                                                    }
                                                @endphp
                                                {{implode(' , ', array_unique($ministries))}}
                                                <span class="label label-outline-warning label-pill label-inline">
                                                    {{$plan['activity']['title_bn']}}
                                                </span>
                                            </span>
                                        </div>
                                        <div class="font-weight-normal">
                                            <span
                                                class="mr-1">{{___('generic.list_views.plan.audit_plan.entity_or_institute')}}</span>
                                            <a href="javascript:void(0)" class="text-info font-size-h5">
                                                @php
                                                    $entities = [];
                                                    foreach($plan['ap_entities'] as $ap_entities){
                                                        $entity =  $ap_entities['entity_name_bn'];
                                                        $entities[] = $entity;
                                                    }
                                                @endphp
                                                {{implode(' , ', array_unique($entities))}}
                                            </a>
                                        </div>

                                        @if($office_id == 18)
                                        <div class="font-weight-normal">
                                            <span
                                                class="mr-2 font-size-1-1">প্রজেক্ট</span>
                                            <span class="font-size-14">
                                            {{$plan['project_name_bn']}}
                                        </span>
                                        </div>
                                        @endif
                                        <div class="font-weight-normal">
                                            <span
                                                class="mr-2 font-size-1-1">{{___('generic.list_views.plan.audit_plan.institute_type')}}</span>
                                            <span class="font-size-14">
                                                {{$plan['office_type']}}
                                            </span>
                                            @if($plan['total_unit_no'])
                                                <span title="প্রতিষ্ঠানের ইউনিটের সংখ্যা"
                                                      class="label label-outline-danger label-pill label-inline">
                                                    {{enTobn($plan['total_unit_no'])}}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="font-weight-normal">
                                            <span
                                                class="mr-2 font-size-1-1">{{___('generic.list_views.plan.audit_plan.subject_matter')}}</span>
                                            <span class="font-size-14">
                                            {{$plan['subject_matter']}}
                                        </span>
                                        </div>
                                        <div class="font-weight-normal d-none predict-wrapper">
                                            <span class="predict-label text-success "></span>
                                        </div>
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Info-->
                                    <div class="d-flex align-items-center justify-content-md-end py-lg-0 py-2 col-md-5">
                                        <div>
                                            <div class="action-group">
                                                <button class="mr-3 btn btn-sm btn-outline-primary btn-square"
                                                        title="বিস্তারিত দেখুন"
                                                        data-annual-plan-id="{{$plan['id']}}"
                                                        onclick="Annual_Plan_Container.showPlanInfo($(this))">
                                                    <i class="fad fa-eye"></i> বিস্তারিত
                                                </button>
                                                @if(($plan_list['approval_status'] == 'draft' || $plan_list['approval_status'] == 'reject') && $current_office_id != 1)
                                                    <button class="mr-3 btn btn-sm btn-outline-warning btn-square"
                                                            title="সম্পাদনা করুন"
                                                            data-annual-plan-id="{{$plan['id']}}"
                                                            data-fiscal-year-id="{{$fiscal_year_id}}"
                                                            data-op-audit-calendar-event-id="{{$plan_list['op_audit_calendar_event_id']}}"
                                                            onclick="Annual_Plan_Container.editPlanInfo($(this))">
                                                        <i class="fad fa-edit"></i> সম্পাদনা
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-danger btn-square"
                                                            title="বাতিল করুন"
                                                            data-annual-plan-id="{{$plan['id']}}"
                                                            data-fiscal-year-id="{{$fiscal_year_id}}"
                                                            data-op-audit-calendar-event-id="{{$plan_list['op_audit_calendar_event_id']}}"
                                                            onclick="Annual_Plan_Container.deletePlan($(this))">
                                                        <i class="fad fa-trash"></i> বাতিল করুন
                                                    </button>
                                                @endif

                                            </div>
                                            <div>
                                                <div class="mb-2 mt-3">
                                                    <div>
                                                        <div class="text-dark-75 ml-3"
                                                             cspas="date">{{formatDateTime($plan['created_at'],'bn')}}</div>
                                                    </div>
                                                </div>
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
    @endif

    <script>
        $('.entity_list_item_clickable_area').click(function () {
            Audit_Plan_Container.loaoAuditPlanBookEditable($(this));
        })

        $('.first-btn').click(function () {
            $('.second').hide();
            $('.first').show();
        });

        $('.second-btn').click(function () {
            $('.second').show();
            $('.first').hide();
        });
    </script>
</div>
