<div class="col-lg-12 p-0 mt-3">
    <!--begin::Table-->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="bg-primary">
            <tr>
                <th class="text-light">মন্ত্রণালয়/বিভাগ</th>
                <th class="text-light">এনটিটি / প্রতিষ্ঠান</th>
                <th class="text-light">প্রতিষ্ঠানের ধরণ</th>
                <th class="text-light">প্রতিষ্ঠানের ইউনিটের সংখ্যা</th>
                <th class="text-light">অডিটের জন্য প্রস্তাবিত ইউনিটের নাম ও সংখ্যা</th>
                <th class="text-light">সাবজেক্ট ম্যাটার</th>
                <th class="text-light">প্রয়োজনীয় লোকবল</th>
                <th class="text-light">মন্তব্য</th>
                <th class="text-light" width="10%">প্ল্যান</th>
            </tr>
            </thead>
            <tbody>
            @foreach($all_entities['data'] as $annual_plan)
                <tr>
                    <td>{{$annual_plan['ministry_name_bn']}}</td>
                    <td>{{$annual_plan['parent_office_name_bn']}}</td>
                    <td>{{$annual_plan['office_type']}}</td>
                    <td>{{enTobn($annual_plan['total_unit_no'])}}</td>
                    <td>
                        @foreach(json_decode($annual_plan['nominated_offices'],true) as $office)
                            {{enTobn($loop->iteration)}}| {{$office['office_name_bn']}} <br>
                        @endforeach
                        <span style="float: right;font-weight: bold">মোট {{enTobn($annual_plan['nominated_office_counts'])}}টি ইউনিট</span>
                    </td>
                    <td>{{$annual_plan['subject_matter']}}</td>
                    <td>
                        @foreach(json_decode($annual_plan['nominated_man_powers'],true)['staffs'] as $man)
                            {{enTobn($loop->iteration)}}| {{$man['designation_bn'].', '.
                                        $man['responsibility_bn'].' - '.enTobn($man['staff']).'জন'}} <br>
                        @endforeach
                    </td>
                    <td>{{$annual_plan['comment']}}</td>
                    <td>
                        <span
                            data-annual-plan-id="{{$annual_plan['id']}}"
                            data-activity-id="{{$annual_plan['activity_id']}}"
                            data-fiscal-year-id="{{$annual_plan['fiscal_year_id']}}"
                            class="btn btn-sm btn-transparent-success btn-icon btn-square"
                            onclick="Audit_Plan_Container.loadAuditPlanBookCreatable($(this))"><i
                                class="fal fa-plus"></i></span>
                        <ul class="list-unstyled mb-0 mt-2">
                            @foreach($annual_plan['audit_plans'] as $audit_plans)
                                <li>{{enTobn($loop->iteration)}}|
                                    <a href="javascript:;"
                                       data-audit-plan-id="{{$audit_plans['id']}}"
                                       data-fiscal-year-id="{{$audit_plans['fiscal_year_id']}}"
                                       data-annual-plan-id="{{$audit_plans['annual_plan_id']}}"
                                       onclick="Audit_Plan_Container.loadAuditPlanBookEditable($(this))">
                                        প্ল্যান: {{enTobn($audit_plans['id'])}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!--end::Table-->
</div>

<script>
    $('.entity_list_item_clickable_area').click(function () {
        Audit_Plan_Container.loaoAuditPlanBookEditable($(this));
    })
</script>
