@if(!empty($all_entities['data']))
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
            <x-paginate from="{{$all_entities['from']}}" to="{{$all_entities['to']}}" total="{{$all_entities['total']}}" appLocale="{{app()->getLocale()}}" extraClass="" callbackFunction="A"></x-paginate>
        </div>

        {{--list view--}}
        <div>
            <ul class="list-group list-group-flush">
                @foreach($all_entities['data'] as $annual_plan)
                    <li class="list-group-item py-2 border-bottom">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="pr-2 flex-fill cursor-pointer position-relative">
                                <div class="row d-md-flex flex-wrap align-items-start justify-content-md-between">
                                    <!--begin::Title-->
                                    <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3 col-md-6">
                                        <div class="font-weight-normal">
                                            <span class="mr-2 font-size-1-1">{{___('generic.list_views.plan.audit_plan.ministry_or_bivag')}}</span>
                                            <span class="font-size-14">
                                                @php
                                                    $ministries = [];
                                                    foreach($annual_plan['ap_entities'] as $ap_entities){
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
                                                    foreach($annual_plan['ap_entities'] as $ap_entities){
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
                                                {{$annual_plan['office_type']}}
                                            </span>
                                            @if(!empty($annual_plan['total_unit_no']))
                                                <span title="প্রতিষ্ঠানের ইউনিটের সংখ্যা" class="label label-outline-danger label-pill label-inline">
                                                    {{enTobn($annual_plan['total_unit_no'])}}
                                                </span>
                                            @endif
                                        </div>

                                        @if($annual_plan['project_id'])
                                            <div class="font-weight-normal">
                                                <span class="mr-2 font-size-1-1">প্রজেক্ট</span>
                                                <span class="font-size-14">
                                                    {{$annual_plan['project_name_bn']}}
                                                </span>
                                            </div>
                                        @endif

                                        <div class="font-weight-normal">
                                            <span class="mr-2 font-size-1-1">{{___('generic.list_views.plan.audit_plan.subject_matter')}}</span>
                                            <span class="font-size-14">
                                            {{$annual_plan['subject_matter']}}
                                        </span>
                                        </div>
                                        <div class="font-weight-normal d-none predict-wrapper">
                                            <span class="predict-label text-success "></span>
                                        </div>

                                        <div class="d-flex mt-3">
                                            @foreach($annual_plan['audit_plans'] as $audit_plans)
                                                @php
                                                    $start = strtotime($audit_plans['edit_time_start']);
                                                    $end = strtotime(now());
                                                    $mins = ($end - $start) / 60;

                                                    $edit_user = $mins < 30 ? 'এই সময়ে হালনাগাদ করতেছেন'.'('.$audit_plans['edit_user_details'].')' : '';
                                                @endphp
                                                <a href="javascript:;"
                                                   title="প্ল্যান-{{enTobn($audit_plans['id'])}} বিস্তারিত দেখুন"
                                                   class="badge-square rounded-0 badge d-flex align-items-center
                                                   alert-{{$audit_plans['office_order'] == null || $audit_plans['office_order']['approved_status'] !='approved'?'danger':'success'}}
                                                       font-weight-normal mr-1 border decision"
                                                   data-audit-plan-id="{{$audit_plans['id']}}"
                                                   data-fiscal-year-id="{{$audit_plans['fiscal_year_id']}}"
                                                   data-annual-plan-id="{{$audit_plans['annual_plan_id']}}"
                                                   onclick="Audit_Plan_Container.loadAuditPlanBookEditable($(this))">
                                                    <i class="fad fa-badge-sheriff mr-2 text-dark-100"></i>
                                                    প্ল্যান: {{enTobn($audit_plans['id'])}} {{$edit_user}}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Info-->
                                    <div class="d-flex align-items-center justify-content-md-end py-lg-0 py-2 col-md-6">
                                        <div class="d-block">
                                            <div
                                                class="d-md-flex flex-wrap mb-2 align-items-center justify-content-md-end text-nowrap">
                                                <div class="ml-3  d-flex align-items-center text-primary">
                                                    <i class="flaticon2-copy mr-2 text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-md-end">
                                                <div class="mb-5 mt-5 soongukto-wrapper">
                                                    <div class="d-flex justify-content-end align-items-center">
                                                        <div class="text-dark-75 ml-3 rdate" cspas="date">{{formatDateTime($annual_plan['created_at'],'bn')}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="action-group d-flex justify-content-end position-absolute action-group-wrapper">

                                                @php
                                                    $entity_list = [];
                                                    foreach ($annual_plan['ap_entities'] as $ap_entitie) {
                                                        $entity_info = [
                                                            'ministry_id' => $ap_entitie['ministry_id'],
                                                            'ministry_name_bn' => $ap_entitie['ministry_name_bn'],
                                                            'ministry_name_en' => $ap_entitie['ministry_name_en'],
                                                            'entity_id' => $ap_entitie['entity_id'],
                                                            'entity_name_bn' => $ap_entitie['entity_name_bn'],
                                                            'entity_name_en' => $ap_entitie['entity_name_en'],
                                                        ];
                                                        $entity_list[] = $entity_info;
                                                    }
                                                    $entity_list = json_encode($entity_list);
                                                @endphp
                                                <button {{$annual_plan['annual_plan_main']['approval_status'] != 'approved'?'disabled':''}} class="mr-3 btn btn-sm btn-primary btn-square" title="বিস্তারিত দেখুন"
                                                        data-annual-plan-id="{{$annual_plan['id']}}"
                                                        data-activity-id="{{$annual_plan['activity_id']}}"
                                                        data-fiscal-year-id="{{$annual_plan['fiscal_year_id']}}"
                                                        data-parent-office-id="{{$entity_list}}"
                                                        onclick="Audit_Plan_Container.showTeamDataCollectionCreateModal($(this));">
                                                    <i class="fa fa-database" aria-hidden="true"></i>
                                                    প্রাইমারি ডাটা কালেকশন
                                                    @if($annual_plan['has_dc_schedule'])
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                    @endif

                                                </button>

                                                <button class="mr-3 btn btn-sm btn-primary btn-square" title="বিস্তারিত দেখুন"
                                                        data-office-id="{{$office_id}}"
                                                        data-annual-plan-id="{{$annual_plan['id']}}"
                                                        onclick="Audit_Plan_Container.showPlanInfo($(this))">
                                                    <i class="fad fa-eye"></i> বিস্তারিত
                                                </button>

                                                @if(count($annual_plan['audit_plans']) == 0)
                                                    <button {{$annual_plan['annual_plan_main']['approval_status'] != 'approved'?'disabled':''}}
                                                        class="mr-3 btn btn-sm btn-warning btn-square" title="নতুন অডিট প্ল্যান করুন"
                                                        data-annual-plan-id="{{$annual_plan['id']}}"
                                                        data-activity-id="{{$annual_plan['activity_id']}}"
                                                        data-fiscal-year-id="{{$annual_plan['fiscal_year_id']}}"
                                                        onclick="Audit_Plan_Container.loadAuditPlanBookCreatable($(this))">
                                                        <i class="fad fa-plus-circle"></i> নতুন অডিট প্ল্যান
                                                    </button>
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

        <script>
            $('.entity_list_item_clickable_area').click(function () {
                Audit_Plan_Container.loaoAuditPlanBookEditable($(this));
            })
        </script>
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
