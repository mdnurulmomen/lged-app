@if(!empty($audit_query_schedule_list))
    {{--list view--}}
    <div class="card sna-card-border ">
        <ul class="list-group list-group-flush">
            @foreach($audit_query_schedule_list['data'] as $key=> $schedule)
                <li class="list-group-item py-2 border-bottom">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="pr-2 flex-fill cursor-pointer position-relative">
                            <div class="row d-md-flex flex-wrap align-items-start justify-content-md-between">
                                <!--begin::Title-->
                                <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3 col-md-9">
                                    <div class="font-weight-bolder">
                                        <span class="mr-2 font-size-1-2">Sl No :</span>
                                        <span class="font-size-14">{{($audit_query_schedule_list['current_page']-1)*200+$loop->iteration}}</span>
                                    </div>

                                    @if($schedule['plan_team']['yearly_plan_location'])
                                        <div>
                                            <span class="mr-2 font-size-1-2 font-weight-bolder">Project :</span>
                                            <span class="font-size-14">
                                                    {{$schedule['plan_team']['yearly_plan_location']['project_name_en']}}
                                            </span>
                                        </div>
                                    @endif

                                    <div class="d-flex align-items-center flex-wrap  font-size-1-2">
                                        <span class="mr-2 font-size-1-2 font-weight-bolder">Cost Center :</span>
                                        <span class="font-size-14">
                                            {{$schedule['cost_center_name_en']}}
                                        </span>
                                        <!-- @if ((now()->toDateString() >= date('Y-m-d', strtotime($schedule['team_member_start_date']))) && (now()->toDateString() <= date('Y-m-d', strtotime($schedule['team_member_end_date']))))
                                            <span class="ml-2 mt-1 label label-outline-warning label-pill label-inline">{{__('চলমান')}}</span>
                                        @endif -->
                                    </div>

                                    <div class="font-weight-normal">
                                        <span class="mr-2 font-size-1-2 font-weight-bolder">Date :</span>
                                        <span class="font-size-14">
                                            {{formatDate($schedule['team_member_start_date'],'en')}} - {{formatDate($schedule['team_member_end_date'],'en')}}
                                        </span>
                                    </div>
                                    <div class="font-weight-normal d-none predict-wrapper">
                                        <span class="predict-label text-success "></span>
                                    </div>
                                </div>
                                <!--end::Title-->
                                <!--begin::Info-->
                                <div class="d-flex align-items-center justify-content-md-end py-lg-0 py-2 col-md-3">
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
                                                    <!-- <button class="mr-3 btn btn-sm btn-primary btn-square"
                                                            title="কোয়েরি"
                                                            onclick="Audit_Query_Schedule_Container.query($(this))"
                                                            data-schedule-id="{{$schedule['id']}}"
                                                            data-team-id="{{$schedule['team_id']}}"
                                                            data-audit-plan-id="{{$schedule['audit_plan_id']}}"
                                                            data-entity-id=""
                                                            data-cost-center-id="{{$schedule['cost_center_id']}}"
                                                            data-cost-center-name-en="{{$schedule['cost_center_name_en']}}"
                                                            data-cost-center-name-bn="{{$schedule['cost_center_name_bn']}}"
                                                            data-project-name-bn="{{$schedule['plan_team']['yearly_plan_location'] ? $schedule['plan_team']['yearly_plan_location']['project_name_bn'] : ''}}">
                                                        <i class="fad fa-clipboard-list"></i> কোয়েরি
                                                    </button> -->

                                                    <button class="mr-3 btn btn-sm btn-primary btn-square"
                                                            title="Program Note"
                                                            onclick="Audit_Query_Schedule_Container.program($(this))"
                                                            data-schedule-id="{{$schedule['id']}}"
                                                            data-team-id="{{$schedule['team_id']}}"
                                                            data-audit-plan-id="{{$schedule['audit_plan_id']}}"
                                                            data-yearly-plan-location-id="{{$schedule['plan_team']['yearly_plan_location']['id']}}"
                                                            data-project-id="{{$schedule['plan_team']['yearly_plan_location']['project_id']}}"
                                                            data-project-name-en="{{$schedule['plan_team']['yearly_plan_location']['project_name_en']}}"
                                                            data-project-name-bn="{{$schedule['plan_team']['yearly_plan_location']['project_name_bn']}}"
                                                            data-type="program_note"
                                                            data-cost-center-id="{{$schedule['cost_center_id']}}"
                                                            data-cost-center-name-en="{{$schedule['cost_center_name_en']}}"
                                                            data-cost-center-name-bn="{{$schedule['cost_center_name_bn']}}"
                                                            data-project-name-bn="{{$schedule['plan_team']['yearly_plan_location'] ? $schedule['plan_team']['yearly_plan_location']['project_name_bn'] : ''}}">
                                                        <i class="fad fa-clipboard-list"></i> Program Note
                                                    </button>
                                                    <button class="mr-3 btn btn-sm btn-warning btn-square"
                                                            title="Findings"
                                                            data-team-id="{{$schedule['team_id']}}"
                                                            data-schedule-id="{{$schedule['id']}}"
                                                            data-audit-plan-id="{{$schedule['audit_plan_id']}}"
                                                            data-entity-id=""
                                                            data-cost-center-id="{{$schedule['cost_center_id']}}"
                                                            data-cost-center-name-bn="{{$schedule['cost_center_name_bn']}}"
                                                            data-cost-center-name-en="{{$schedule['cost_center_name_en']}}"
                                                            data-audit-year-start="{{$schedule['plan_team']['audit_year_start']}}"
                                                            data-audit-year-end="{{$schedule['plan_team']['audit_year_end']}}"
                                                            data-project-id="{{$schedule['plan_team']['yearly_plan_location']['project_id']}}"
                                                            data-project-name-bn="{{$schedule['plan_team']['yearly_plan_location'] ? $schedule['plan_team']['yearly_plan_location']['project_name_bn'] : ''}}"
                                                            data-project-name-en="{{$schedule['plan_team']['yearly_plan_location'] ? $schedule['plan_team']['yearly_plan_location']['project_name_en'] : ''}}"
                                                            onclick="Audit_Query_Schedule_Container.memo($(this))">
                                                        <i class="fad fa-clipboard-list"></i> Findings
                                                    </button>
                                                    <!-- <button class="mr-3 btn btn-sm btn-outline-danger btn-square">
                                                        <i class="fad fa-info-square"></i> অডিট শুরুর তারিখ ({{formatDate($schedule['team_member_start_date'],'bn')}}) হতে কোয়েরি এবং মেমোর বাটন দৃশ্যমান হবে
                                                    </button>
                                                <button class="mr-3 btn btn-sm btn-outline-danger btn-square" title="অননুমোদিত অফিস আদেশ">
                                                    <i class="fad fa-info-square"></i> অননুমোদিত
                                                </button> -->
                                                <!-- <button class="mr-3 btn btn-sm btn-outline-success btn-square"
                                                        title="কোয়েরি"
                                                        onclick="Audit_Query_Schedule_Container.query($(this))"
                                                        data-schedule-id="{{$schedule['id']}}"
                                                        data-team-id="{{$schedule['team_id']}}"
                                                        data-audit-plan-id="{{$schedule['audit_plan_id']}}"
                                                        data-entity-id=""
                                                        data-cost-center-id="{{$schedule['cost_center_id']}}"
                                                        data-cost-center-name-en="{{$schedule['cost_center_name_en']}}"
                                                        data-cost-center-name-bn="{{$schedule['cost_center_name_bn']}}"
                                                        data-project-name-bn="{{$schedule['plan_team']['yearly_plan_location'] ? $schedule['plan_team']['yearly_plan_location']['project_name_bn'] : ''}}">
                                                    <i class="fad fa-info-square"></i> Program
                                                </button> -->
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

        @if($audit_query_schedule_list['total'] > 200)
            <div class="pagination_ui">
                <div class="pagination">
                    @php
                        $current_page = $audit_query_schedule_list['current_page'];
                        $last_page = $audit_query_schedule_list['last_page'];
                        $prev_page = $audit_query_schedule_list['current_page'] - 1 < 1 ? 1 : $audit_query_schedule_list['current_page'] - 1;
                        $next_page = $audit_query_schedule_list['current_page'] + 1 > $audit_query_schedule_list['last_page'] ? $audit_query_schedule_list['last_page'] : $audit_query_schedule_list['current_page'] + 1;
                    @endphp
                    <ul>
                        <li class="page-item">
                            <a class="page-link" href="javascript:;"
                               onclick="Audit_Query_Schedule_Container.paginate($(this))" data-page={{ $prev_page }}>
                                <i class="fa fa-angle-left"></i>
                            </a>
                        </li>
                        @if ($last_page <= 5)
                            @for ($i = 1; $i <= $audit_query_schedule_list['last_page']; $i++)
                                <li class="page-item {{ $audit_query_schedule_list['current_page'] == $i ? 'active' : '' }}">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                            href="javascript:;" onclick="Audit_Query_Schedule_Container.paginate($(this))"
                                       data-page="{{ $i }}">{{ $i }}</a>
                                </li>
                            @endfor
                        @else
                            @if ($current_page < 5)
                                @for ($i = 1; $i < 6; $i++)
                                    <li class="page-item {{ $audit_query_schedule_list['current_page'] == $i ? 'active' : '' }}">
                                        <a class="page-link" data-current-page={{ $current_page }}
                                                href="javascript:;" onclick="Audit_Query_Schedule_Container.paginate($(this))"
                                           data-page="{{ $i }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                            href="javascript:;" data-page="{{ $last_page - 2 }}">...</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                            href="javascript:;" onclick="Audit_Query_Schedule_Container.paginate($(this))"
                                       data-page="{{ $last_page - 1 }}">{{ $last_page - 1 }}</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                            href="javascript:;" onclick="Audit_Query_Schedule_Container.paginate($(this))"
                                       data-page="{{ $last_page }}">{{ $last_page }}</a>
                                </li>
                            @elseif ($current_page >= 5 && $current_page < $last_page - 5)
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                            href="javascript:;" onclick="Audit_Query_Schedule_Container.paginate($(this))"
                                       data-page="1">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                            href="javascript:;" data-page="{{ $last_page - 2 }}">...</a>
                                </li>
                                @for ($i = $current_page - 4; $i <= $current_page + 4; $i++)
                                    <li class="page-item {{ $audit_query_schedule_list['current_page'] == $i ? 'active' : '' }}">
                                        <a class="page-link" data-current-page={{ $current_page }}
                                                href="javascript:;" onclick="Audit_Query_Schedule_Container.paginate($(this))"
                                           data-page="{{ $i }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                            href="javascript:;" data-page="{{ $last_page - 2 }}">...</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                            href="javascript:;" onclick="Audit_Query_Schedule_Container.paginate($(this))"
                                       data-page="{{ $last_page }}">{{ $last_page }}</a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                            href="javascript:;" onclick="Audit_Query_Schedule_Container.paginate($(this))"
                                       data-page="1">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                            href="javascript:;" onclick="Audit_Query_Schedule_Container.paginate($(this))"
                                       data-page="2">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" data-current-page={{ $current_page }}
                                            href="javascript:;" data-page="{{ $last_page - 2 }}">...</a>
                                </li>
                                @for ($i = $current_page - 4; $i <= $last_page; $i++)
                                    <li class="page-item {{ $audit_query_schedule_list['current_page'] == $i ? 'active' : '' }}">
                                        <a class="page-link" data-current-page={{ $current_page }}
                                                href="javascript:;" onclick="Audit_Query_Schedule_Container.paginate($(this))"
                                           data-page="{{ $i }}">{{ $i }}</a>
                                    </li>
                                @endfor
                            @endif
                        @endif
                        <li class="page-item">
                            <a class="page-link" href="javascript:;"
                               onclick="Audit_Query_Schedule_Container.paginate($(this))" data-page="{{ $next_page }}">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        @endif
    </div>
@else
    <div class="alert alert-custom alert-light-primary fade show mb-5" role="alert">
        <div class="alert-icon">
            <i class="flaticon-warning"></i>
        </div>
        <div class="alert-text">{{___('generic.no_data_found')}}</div>
    </div>
@endif


