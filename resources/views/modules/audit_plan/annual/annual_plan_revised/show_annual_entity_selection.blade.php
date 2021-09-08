<x-title-wrapper>Annual Plan For {{$fiscal_year}} - ({{$activity_title}})</x-title-wrapper>
<div class="col-md-12">
    <div class="d-flex justify-content-end">
        <a onclick="Annual_Plan_Container.addPlanInfo($(this))"
           data-activity-id="{{$activity_id}}"
           data-activity-title="{{$activity_title}}"
           data-schedule-id="{{$schedule_id}}"
           data-fiscal-year-id="{{$fiscal_year_id}}"
           data-milestone-id="{{$milestone_id}}"
           class="btn btn-success btn-sm btn-bold btn-square btn_create"
           href="javascript:;">
            <i class="far fa-plus mr-1"></i> Add Responsible Party
        </a>
    </div>
</div>
<div class="col-lg-12">
    <!--begin::Advance Table Widget 4-->
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Body-->
        <div class="card-body">
            <!--begin::Table-->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th class="align-middle">মন্ত্রণালয়/বিভাগ</th>
                        <th>প্রতিষ্ঠানের নাম</th>
                        <th>প্রতিষ্ঠানের ধরণ</th>
                        <th>প্রতিষ্ঠানের মোট ইউনিটের সংখ্যা</th>
                        <th>অডিটের জন্য প্রস্তাবিত ইউনিটের নাম ও সংখ্যা</th>
                        <th>সাবজেক্ট ম্যাটার</th>
                        <th>প্রয়োজনীয় লোকবল</th>
                        <th>মন্তব্য</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($plan_list as $plan)
                        <tr>
                            <td>{{$plan['ministry_name_bn']}}</td>
                            <td>{{$plan['controlling_office_bn']}}</td>
                            <td>{{$plan['office_type']}}</td>
                            <td>{{enTobn($plan['total_unit_no'])}}</td>
                            <td>
                                @foreach(json_decode($plan['nominated_offices'],true) as $office)
                                    {{enTobn($loop->iteration)}}| {{$office['office_name_bn']}} <br>
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
                                {{json_decode($plan['nominated_man_powers'],true)['comment']}}
                            </td>
                            <td>{{$plan['comment']}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!--end::Table-->
        </div>
    </div>
    <!--end::Advance Table Widget 4-->
</div>

