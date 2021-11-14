
<div class="row">
    <div class="col-md-12">
{{--        {{dd($audit_query_schedule_list['data'])}}--}}
        @foreach($audit_query_schedule_list['data'] as $key=> $schedule)
            <div class="">
                <ul class="list-group list-group-flush">
                    <li id="daak_container_inbox_1_54_Daptorik"
                        class="daak_list_item list-group-item pl-0 py-2 border-bottom">
                        <div class="d-flex justify-content-between align-items-start">
                   <span class="input-group-text bg-transparent border-0" data-toggle="popover"
                         data-content="ডাক বাছাই করুন" data-original-title="" title="">
                   </span>
                            <div
                                class="pr-2 flex-fill daak_list_item_clickable_area cursor-pointer position-relative"
                                did="daak_container_inbox_1_54_Daptorik">
                                <div class="row d-md-flex flex-wrap align-items-start justify-content-md-between">
                                    <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3 col-md-6">
                                        <div class="d-flex align-items-center flex-wrap  font-size-1-2"><a
                                                href="javascript:void(0)"
                                                class=" text-dark text-hover-primary font-size-h5"
                                                data-content="">{{$schedule['cost_center_name_bn']}}
                                                @if ((now()->toDateString() >= date('Y-m-d', strtotime($schedule['team_member_start_date']))) && (now()->toDateString() <= date('Y-m-d', strtotime($schedule['team_member_end_date']))))
                                                    <span
                                                        class="badge badge-pill badge-info border font-weight-bold mr-1 shadow">
                                                        <span
                                                            class="en_to_bn_text text-light text-uppercase">{{__('চলমান')}}</span>
                                                    </span>
                                                @endif

                                            </a>
                                        </div>
                                        <div class=" subject-wrapper font-weight-normal font-weight-normal">
                                            <span class="mr-2 font-size-1-1">নাম:</span>
                                            <span
                                                class="description text-wrap font-size-14">{{$schedule['team_member_name_bn']}}</span>
                                        </div>
                                        <div class=" subject-wrapper font-weight-normal font-weight-normal">
                                            <span class="mr-2 font-size-1-1">তারিখ:</span>
                                            <span class="description text-wrap font-size-14"> {{formatDate($schedule['team_member_start_date'],'bn')}} - {{formatDate($schedule['team_member_end_date'],'bn')}}</span>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex align-items-center justify-content-md-end py-lg-0 py-2 col-md-6">
                                        <div class="d-block">
                                            <div class="d-flex align-items-center justify-content-md-end">
                                                <div class="btn-group folder-wrapper mb-2 mt-3 mr-3">
                                                    <button
                                                        id="query_schedule_{{$schedule['id']}}"
                                                        onclick="Audit_Query_Schedule_Container.query($(this))"
                                                        data-schedule-id="{{$schedule['id']}}"
                                                        data-cost-center-id="{{$schedule['cost_center_id']}}"
                                                        data-cost-center-name-en="{{$schedule['cost_center_name_en']}}"
                                                        data-cost-center-name-bn="{{$schedule['cost_center_name_bn']}}"
                                                        type="button"
                                                        class="btn btn-sm rounded-0 alert-primary query_schedule_{{$schedule['id']}}  folder_click">
                                                        Query
                                                    </button>

                                                    <button
                                                        id="memo_schedule_{{$schedule['id']}}"
                                                        data-schedule-id="{{$schedule['id']}}"
                                                        data-audit-plan-id="{{$schedule['audit_plan_id']}}"
                                                        data-cost-center-id="{{$schedule['cost_center_id']}}"
                                                        data-cost-center-name-bn="{{$schedule['cost_center_name_bn']}}"
                                                        data-audit-year-start="{{$schedule['plan_team']['audit_year_start']}}"
                                                        data-audit-year-end="{{$schedule['plan_team']['audit_year_end']}}"
                                                        onclick="Audit_Query_Schedule_Container.memo($(this))" type="button"
                                                        class="btn btn-sm rounded-0 alert-warning  folder_click">
                                                        Memo
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        @endforeach
    </div>

</div>
