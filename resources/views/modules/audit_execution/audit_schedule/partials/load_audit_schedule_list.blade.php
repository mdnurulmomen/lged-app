@if(!empty($audit_query_schedule_list['data']))
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
                                    <div class="font-weight-bolder">
                                        <span class="mr-2 font-size-1-2">ক্রমিক নং:</span>
                                        <span class="font-size-14">{{enTobn($loop->iteration)}}</span>
                                    </div>

                                    <div class="font-weight-normal">
                                        <span class="mr-2 font-size-1-1">এনটিটি/প্রতিষ্ঠানঃ</span>
                                        <span class="font-size-14">
                                            {{$schedule['entity_name_bn']}}
                                            <span class="label label-outline-warning label-pill label-inline">
                                                প্ল্যান - {{enTobn($schedule['audit_plan_id'])}}
                                            </span>
                                        </span>
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

                                    @if($schedule['annual_plan'] && $schedule['annual_plan']['project_id'])
                                        <div class="font-weight-normal">
                                            <span class="mr-2 font-size-1-1">প্রজেক্টঃ</span>
                                            <span class="font-size-14">
                                                    {{$schedule['annual_plan']['project_name_bn']}}
                                            </span>
                                        </div>
                                    @endif

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
                                        {{--<div class="d-flex align-items-center justify-content-md-end">
                                            <div class="mb-2 mt-3 soongukto-wrapper">
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <div class="text-dark-75 ml-3 rdate" cspas="date">{{formatDateTime($schedule['created_at'],'bn')}}</div>
                                                </div>
                                            </div>
                                        </div>--}}
                                        <div class="action-group d-flex justify-content-end position-absolute action-group-wrapper">
                                            @if($schedule['office_order'] != null && $schedule['office_order']['approved_status'] == 'approved')
                                                @if($schedule['team_member_start_date'] <= date('Y-m-d',strtotime(now())))
                                                    <button class="mr-3 btn btn-sm btn-primary btn-square"
                                                            title="কোয়েরি"
                                                            onclick="Audit_Query_Schedule_Container.query($(this))"
                                                            data-schedule-id="{{$schedule['id']}}"
                                                            data-audit-plan-id="{{$schedule['audit_plan_id']}}"
                                                            data-entity-id="{{$schedule['entity_id']}}"
                                                            data-cost-center-id="{{$schedule['cost_center_id']}}"
                                                            data-cost-center-name-en="{{$schedule['cost_center_name_en']}}"
                                                            data-cost-center-name-bn="{{$schedule['cost_center_name_bn']}}"
                                                            data-team-leader-name-bn="{{$schedule['plan_parent_team']['leader_name_bn']}}"
                                                            data-team-leader-designation-name-bn="{{$schedule['plan_parent_team']['leader_designation_name_bn']}}"
                                                            data-scope-sub-team-leader="{{$schedule['plan_team']['team_parent_id']}}"
                                                            data-sub-team-leader-name-bn="{{$schedule['plan_team']['leader_name_bn']}}"
                                                            data-sub-team-leader-designation-name-bn="{{$schedule['plan_team']['leader_designation_name_bn']}}"
                                                            data-project-name-bn="{{$schedule['annual_plan'] && $schedule['annual_plan']['project_id'] ? $schedule['annual_plan']['project_name_bn'] : ''}}">
                                                        <i class="fad fa-clipboard-list"></i> কোয়েরি ({{enTobn($schedule['queries_count'])}})
                                                    </button>
                                                    <button class="mr-3 btn btn-sm btn-warning btn-square"
                                                            title="মেমো"
                                                            data-schedule-id="{{$schedule['id']}}"
                                                            data-team-id="{{$schedule['team_id']}}"
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
                                                            data-project-name-bn="{{$schedule['annual_plan'] && $schedule['annual_plan']['project_id'] ? $schedule['annual_plan']['project_name_bn'] : ''}}"
                                                            onclick="Audit_Query_Schedule_Container.memo($(this))">
                                                        <i class="fad fa-clipboard-list"></i> মেমো ({{enTobn($schedule['memos_count'])}})
                                                    </button>
                                                @else
                                                    <button class="mr-3 btn btn-sm btn-outline-danger btn-square">
                                                        <i class="fad fa-info-square"></i> অডিট  শুরুর তারিখ হতে ({{formatDate($schedule['team_member_start_date'],'bn')}}) কোয়েরি এবং মেমোর বাটন দৃশ্যমান হবে
                                                    </button>
                                                @endif
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


