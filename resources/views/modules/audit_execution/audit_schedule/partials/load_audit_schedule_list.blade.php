@if(!empty($audit_query_schedule_list['data']))
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
                <span class="mr-2">
                    <span id="daak_item_length_start">১</span> -
                    <span id="daak_item_length_end">{{enTobn(count($audit_query_schedule_list['data']))}}</span>
                    সর্বমোট: <span id="daak_item_total_record">{{enTobn(count($audit_query_schedule_list['data']))}}</span>
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

    {{--list view--}}
    <div>
        <ul class="list-group list-group-flush">
            @foreach($audit_query_schedule_list['data'] as $key=> $schedule)
                <li class="list-group-item py-2 border-bottom">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="pr-2 flex-fill cursor-pointer position-relative">
                            <div class="row d-md-flex flex-wrap align-items-start justify-content-md-between">
                                <!--begin::Title-->
                                <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3 col-md-8">
                                    <div class="font-weight-normal">
                                        <span class="mr-2 font-size-1-1">এনটিটি/প্রতিষ্ঠানঃ</span>
                                        <span class="font-size-14">
                                            {{$schedule['entity_name_bn']}}
                                            <span  class="label label-outline-warning label-pill label-inline">
                                                প্ল্যান - {{$schedule['audit_plan_id']}}</span>

                                    </div>

                                    <div class="d-flex align-items-center flex-wrap  font-size-1-2">
                                        <span class="mr-1">কস্ট সেন্টারঃ</span>
                                        <span class="text-info font-size-1-1">
                                            {{$schedule['cost_center_name_bn']}}
                                        </span>
                                        @if ((now()->toDateString() >= date('Y-m-d', strtotime($schedule['team_member_start_date']))) && (now()->toDateString() <= date('Y-m-d', strtotime($schedule['team_member_end_date']))))
                                            <span class="ml-2 label label-outline-warning label-pill label-inline">{{__('চলমান')}}</span>
                                        @endif
                                    </div>

                                    <div class="font-weight-normal">
                                        <span class="mr-2 font-size-1-1">তারিখঃ</span>
                                        <span class="font-size-14">
                                            {{formatDate($schedule['team_member_start_date'],'bn')}} - {{formatDate($schedule['team_member_end_date'],'bn')}}
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
                                                    <div class="text-dark-75 ml-3 rdate" cspas="date">{{formatDateTime($schedule['created_at'],'bn')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="action-group d-flex justify-content-end position-absolute action-group-wrapper">
                                            @if($schedule['office_order'] != null && $schedule['office_order']['approved_status'] == 'approved')
                                                <button class="mr-3 btn btn-sm btn-primary btn-square"
                                                        title="কোয়েরি"
                                                        onclick="Audit_Query_Schedule_Container.query($(this))"
                                                        data-schedule-id="{{$schedule['id']}}"
                                                        data-audit-plan-id="{{$schedule['audit_plan_id']}}"
                                                        data-entity-id="{{$schedule['entity_id']}}"
                                                        data-cost-center-id="{{$schedule['cost_center_id']}}"
                                                        data-cost-center-name-en="{{$schedule['cost_center_name_en']}}"
                                                        data-cost-center-name-bn="{{$schedule['cost_center_name_bn']}}">
                                                    <i class="fad fa-clipboard-list"></i> কোয়েরি
                                                </button>

                                                <button class="mr-3 btn btn-sm btn-warning btn-square"
                                                        title="মেমো"
                                                        data-schedule-id="{{$schedule['id']}}"
                                                        data-audit-plan-id="{{$schedule['audit_plan_id']}}"
                                                        data-entity-id="{{$schedule['entity_id']}}"
                                                        data-cost-center-id="{{$schedule['cost_center_id']}}"
                                                        data-cost-center-name-bn="{{$schedule['cost_center_name_bn']}}"
                                                        data-audit-year-start="{{$schedule['plan_team']['audit_year_start']}}"
                                                        data-audit-year-end="{{$schedule['plan_team']['audit_year_end']}}"
                                                        data-team-leader-name-bn="{{$schedule['plan_parent_team']['leader_name_bn']}}"
                                                        data-team-leader-designation-name-bn="{{$schedule['plan_parent_team']['leader_designation_name_bn']}}"
                                                        data-scope-sub-team-leader="{{$schedule['plan_team']['team_parent_id']}}"
                                                        data-sub-team-leader-name-bn="{{$schedule['plan_team']['leader_name_bn']}}"
                                                        data-sub-team-leader-designation-name-bn="{{$schedule['plan_team']['leader_designation_name_bn']}}"
                                                        onclick="Audit_Query_Schedule_Container.memo($(this))">
                                                    <i class="fad fa-clipboard-list"></i> মেমো
                                                </button>
                                            @else
                                                <button class="mr-3 btn btn-sm btn-outline-danger btn-square" title="অননুমোদিত অফিস আদেশ">
                                                    <i class="fad fa-info-square"></i> অননুমোদিত
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
@else
    <div class="alert alert-custom alert-light-primary fade show mb-5" role="alert">
        <div class="alert-icon">
            <i class="flaticon-warning"></i>
        </div>
        <div class="alert-text">{{___('generic.no_data_found')}}</div>
    </div>
@endif


