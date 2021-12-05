<div class="px-3 py-3">
    <div class="row pb-4">
        {{--{{dd($annual_plans)}}--}}
        <div class="col-md-6">
            @if(!empty($plan_list))
                <button class="btn_annual_plan_submit_to_ocag btn btn-sm btn-square btn-outline-primary"
                        data-fiscal-year-id="{{$fiscal_year_id}}"
                        data-op-audit-calendar-event-id="{{$op_audit_calendar_event_id}}"
                        onclick="Annual_Plan_Container.loadAnnualPlanApprovalAuthority($(this))">
                        <i class="fa fa-paper-plane"></i>
                        Submit to OCAG
                </button>

                <button data-fiscal-year-id="{{$fiscal_year_id}}"
                        onclick="Annual_Plan_Container.printAnnualPlan($(this))"
                        class="btn btn-sm btn-outline-warning btn-square">
                        <i class="fa fa-arrow-alt-down"></i>
                        Download
                </button>

                <button class="btn btn-sm btn-outline-success btn-square"
                        data-fiscal-year-id="{{$fiscal_year_id}}"
                        data-op-audit-calendar-event-id="{{$op_audit_calendar_event_id}}"
                        onclick="Annual_Plan_Container.movementHistory($(this))">
                        <i class="fa fa-eye"></i>
                        History
                </button>

                <span class="badge badge-info text-uppercase m-1 p-1 ">
                {{$approval_status}}
            </span>
            @endif
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-end">
                <a onclick="Annual_Plan_Container.addPlanInfo($(this))"
                   data-fiscal-year-id="{{$fiscal_year_id}}"
                   data-op-audit-calendar-event-id="{{$op_audit_calendar_event_id}}"
                   class="btn btn-outline-success btn-sm btn-square btn_create"
                   href="javascript:;">
                    <i class="far fa-plus mr-1"></i> Add Responsible Party
                </a>
            </div>
        </div>
    </div>
</div>

<div class="px-3 py-3">
    <!--begin::Table-->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="bg-primary">
            <tr>
                <th class="align-middle text-light">মন্ত্রণালয়/বিভাগ</th>
                <th class="text-light">এনটিটি / প্রতিষ্ঠান</th>
                <th class="text-light">প্রতিষ্ঠানের ধরণ</th>
                <th class="text-light">প্রতিষ্ঠানের ইউনিটের সংখ্যা</th>
                <th class="text-light">অডিটের জন্য প্রস্তাবিত ইউনিটের নাম ও সংখ্যা</th>
                <th class="text-light">সাবজেক্ট ম্যাটার</th>
                <th class="text-light">প্রয়োজনীয় লোকবল</th>
                <th class="text-light">মন্তব্য</th>
                <th class="text-light">সম্পাদনা</th>
            </tr>
            </thead>
            <tbody>
            @foreach($plan_list as $plan)
                <tr>
                    <td>
                        @php
                            $ministries = [];
                            foreach($plan['ap_entities'] as $ap_entities){
                               $ministry =  $ap_entities['ministry_name_bn'];
                                $ministries[] = $ministry;
                            }
                        @endphp
                        {{implode(' , ', array_unique($ministries))}}
                    </td>
                    <td>
                        @php
                            $entities = [];
                            foreach($plan['ap_entities'] as $ap_entities){
                               $entity =  $ap_entities['entity_name_bn'];
                                $entities[] = $entity;
                            }
                        @endphp
                        {{implode(' , ', array_unique($entities))}}
                    </td>
                    <td>{{$plan['office_type']}}</td>
                    <td>{{enTobn($plan['total_unit_no'])}}</td>
                    <td style="height:100px;overflow: hidden">
                        @foreach($plan['ap_entities'] as $ap_entities)
                            {{$ap_entities['entity_name_bn']}} (এনটিটি) <br>
                            @foreach(json_decode($ap_entities['nominated_offices'],true) as $office)
                                {{enTobn($loop->iteration)}}| {{$office['office_name_bn']}} <br>
                            @endforeach
                            <br>
                        @endforeach
                        <span style="float: right;font-weight: bold">মোট {{enTobn($plan['nominated_office_counts'])}}টি ইউনিট</span>
                    </td>
                    <td>{{$plan['subject_matter']}}</td>
                    <td>
                        @if(count(json_decode($plan['nominated_man_powers'],true)['staffs']) >0)
                            @foreach(json_decode($plan['nominated_man_powers'],true)['staffs'] as $man)
                                {{enTobn($loop->iteration)}}| {{$man['designation_bn'].', '.
                                            $man['responsibility_bn'].' - '.enTobn($man['staff']).'জন'}} <br>
                            @endforeach
                            <br>
                        @endif
{{--                        {{json_decode($plan['nominated_man_powers'],true)['comment']}}--}}
                    </td>
                    <td>{{$plan['comment']}}</td>
                    <td>
                        <div class="btn-group">
                            <button title="সম্পাদন"
                                    class="btn btn-icon btn-square btn-sm btn-light btn-icon-primary"
                                    data-annual-plan-id="{{$plan['id']}}"
                                    data-fiscal-year-id="{{$fiscal_year_id}}"
                                    data-op-audit-calendar-event-id="{{$op_audit_calendar_event_id}}"
                                    onclick="Annual_Plan_Container.editPlanInfo($(this))">
                                <i class="fad fa-edit"></i>
                            </button>
                            <button title="দেখুন"
                                    class="btn btn-icon btn-square btn-sm btn-light btn-icon-primary"
                                    data-annual-plan-id="{{$plan['id']}}"
                                    onclick="Annual_Plan_Container.showPlanInfo($(this))">
                                <i class="fad fa-eye"></i>
                            </button>
                            <button title="বাতিল করুন"
                                    class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-danger"
                                    data-annual-plan-id="{{$plan['id']}}"
                                    onclick="Annual_Plan_Container.deletePlan($(this))">
                                <i class="fad fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!--end::Table-->
</div>


