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
                        class="fad fa-search"></i></button>
                <button data-toggle="tooltip" data-placement="left" title="রিসেট"
                        class="btn btn-icon btn-light-danger btn-square" id="reset_btn" type="reset"><i
                        class="fad fa-recycle"></i></button>
                <button class="d-none btn btn-info btn-sm btn-square cd-btn js-cd-panel-trigger"
                        data-panel="main"><i class="fad fa-book"></i> নথিসমূহ
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
        @if(!empty($all_entities['data']))
            @foreach($all_entities['data'] as $annual_plan)
                <li class="list-group-item py-2 border-bottom">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="pr-2 flex-fill cursor-pointer position-relative">
                            <div class="row d-md-flex flex-wrap align-items-start justify-content-md-between">
                                <!--begin::Title-->
                                <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3 col-md-8">
                                    <div class="font-weight-normal">
                                        <span class="mr-2 font-size-1-1">মন্ত্রণালয়/বিভাগ:</span>
                                        <span class="font-size-14">{{$annual_plan['ministry_name_bn']}}</span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap  font-size-1-2">
                                        <span class="mr-1">এনটিটি/প্রতিষ্ঠান:</span>
                                        <a href="javascript:void(0)" class="text-info font-size-h5">
                                            {{$annual_plan['parent_office_name_bn']}}
                                        </a>
                                    </div>
                                    <div class="font-weight-normal">
                                        <span class="mr-2 font-size-1-1">প্রতিষ্ঠানের ধরণ:</span>
                                        <span class="font-size-14">
                                            {{$annual_plan['office_type']}}
                                        </span>
                                        <span title="প্রতিষ্ঠানের ইউনিটের সংখ্যা" class="label label-outline-danger label-pill label-inline">
                                            {{enTobn($annual_plan['total_unit_no'])}}
                                        </span>
                                    </div>
                                    <div class="font-weight-normal">
                                        <span class="mr-2 font-size-1-1">সাবজেক্ট ম্যাটার:</span>
                                        <span class="font-size-14">
                                        {{$annual_plan['subject_matter']}}
                                    </span>
                                    </div>
                                    <div class="font-weight-normal d-none predict-wrapper">
                                        <span class="predict-label text-success "></span>
                                    </div>

                                    <div class="d-flex mt-3">
                                        @foreach($annual_plan['audit_plans'] as $audit_plans)
                                            <a href="javascript:;"
                                               title="প্ল্যান-{{enTobn($audit_plans['id'])}} বিস্তারিত দেখুন"
                                               class="badge-square rounded-0 badge d-flex align-items-center alert-{{$loop->odd?'success':'danger'}}
                                                                font-weight-normal mr-1 border decision"
                                               data-audit-plan-id="{{$audit_plans['id']}}"
                                               data-fiscal-year-id="{{$audit_plans['fiscal_year_id']}}"
                                               data-annual-plan-id="{{$audit_plans['annual_plan_id']}}"
                                               onclick="Audit_Plan_Container.loadAuditPlanBookEditable($(this))">
                                              <i class="fad fa-badge-sheriff mr-2 text-dark-100"></i>
                                                প্ল্যান: {{enTobn($audit_plans['id'])}}
                                            </a>
                                        @endforeach
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
                                                    <div class="text-dark-75 ml-3 rdate" cspas="date">{{formatDateTime($annual_plan['created_at'],'bn')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="action-group d-flex justify-content-end position-absolute action-group-wrapper">
                                            <button class="mr-3 btn btn-sm btn-outline-primary btn-square" title="বিস্তারিত দেখুন"
                                                    data-annual-plan-id="{{$annual_plan['id']}}"
                                                    data-activity-id="{{$annual_plan['activity_id']}}"
                                                    data-fiscal-year-id="{{$annual_plan['fiscal_year_id']}}"
                                                    onclick="Audit_Plan_Container.loadAuditPlanBookCreatable($(this))">
                                                <i class="fa fa-eye"></i> বিস্তারিত
                                            </button>

                                            <button class="mr-3 btn btn-sm btn-outline-warning btn-square" title="নতুন অডিট প্ল্যান করুন"
                                                    data-annual-plan-id="{{$annual_plan['id']}}"
                                                    data-activity-id="{{$annual_plan['activity_id']}}"
                                                    data-fiscal-year-id="{{$annual_plan['fiscal_year_id']}}"
                                                    onclick="Audit_Plan_Container.loadAuditPlanBookCreatable($(this))">
                                                <i class="fas fa-plus-circle"></i> নতুন অডিট প্ল্যান
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Info-->
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        @else
        <li>
            <div class="alert alert-custom alert-light-primary fade show mb-5" role="alert">
                <div class="alert-icon">
                    <i class="flaticon-warning"></i>
                </div>
                <div class="alert-text">কোন তথ্য পাওয়া যায়নি</div>
            </div>
        </li>
        @endif
    </ul>
</div>

<script>
    $('.entity_list_item_clickable_area').click(function () {
        Audit_Plan_Container.loaoAuditPlanBookEditable($(this));
    })
</script>
