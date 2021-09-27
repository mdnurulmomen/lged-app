<x-title-wrapper>Office Order</x-title-wrapper>

<div class="col-md-12">
    <div class="d-flex justify-content-end">
        <button data-audit-plan-id="{{$office_order['audit_plan_id']}}" data-annual-plan-id="{{$office_order['annual_plan_id']}}"  onclick="Show_Office_Order_Container.printOfficeOrder($(this))" class="btn btn-info btn-sm btn-bold btn-square mr-2">
            <i class="far fa-print mr-1"></i> Print
        </button>
    </div>
</div>

<div class="col-lg-12 p-0 mt-3">
    <!--begin::Advance Table Widget 4-->
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Body-->
        <div class="card-body">
            <div style="font-family:SolaimanLipi,serif !important;text-align: center">
                গণপ্রজাতন্ত্রী বাংলাদেশ সরকার <br>
                <b>বাণিজ্যিক অডিট অধিদপ্তর</b> <br>
                অডিট কমপ্লেক্স (৮ম ও ৯ম তলা) <br>
                সেগুনবাগিচা, ঢাকা -১০০০।
            </div>

            <div style="font-family:SolaimanLipi,serif !important;width: 100%;margin-top: 10px">
            <span style="width: 85%;float: left">
                {{$office_order['memorandum_no']}}
            </span>
                <span style="width: 15%;float: right">
                তারিখঃ  {{enTobn(date('d/m/Y',strtotime($office_order['memorandum_date'])))}} খ্রি।
            </span>
            </div>

            <div style="font-family:SolaimanLipi,serif !important;text-align: center">
                <b><u>অফিস আদেশ</u></b>
            </div>
            <div style="font-family:SolaimanLipi,serif !important;text-align: justify">
                {{$office_order['heading_details']}}
            </div>

            <div style="font-family:SolaimanLipi,serif !important;text-align: center">
                <b><u>নিরীক্ষা দল নং-০১</u></b>
            </div>

            <div style="margin-top: 5px">
                <table width="100%" border="1">
                    <thead>
                    <tr>
                        <th style="text-align: center" width="5%">ক্রমিক নং</th>
                        <th style="text-align: center" width="45%">নাম</th>
                        <th style="text-align: center" width="20%">পদবী</th>
                        <th style="text-align: center" width="15%">নিরীক্ষা দলের অবস্থান</th>
                        <th style="text-align: center" width="15%">মোবাইল নং</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($audit_team_members as $audit_team_member)
                        <tr>
                            <td style="text-align: center">{{enTobn($loop->iteration)}}</td>
                            <td style="text-align: left">{{$audit_team_member['team_member_name_bn']}}</td>
                            <td style="text-align: center">{{$audit_team_member['team_member_designation_bn']}}</td>
                            <td style="text-align: center">{{$audit_team_member['team_member_role_bn']}}</td>
                            <td style="text-align: center">{{$audit_team_member['mobile_no']}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            @foreach($audit_team_schedules as $audit_team_schedule)
                @if($audit_team_schedule['team_schedules'] != null)
                    <div style="font-family:SolaimanLipi,serif !important;text-align: center;margin-top: 10px">
                        <b><u>{{$audit_team_schedule['team_name']}}</u></b>
                    </div>

                    <div style="margin-top: 5px">
                        <table width="100%" border="1">
                            <thead>
                            <tr>
                                <th style="text-align: center" width="5%">ক্রমিক নং</th>
                                <th style="text-align: center" width="45%">নাম</th>
                                <th style="text-align: center" width="20%">পদবী</th>
                                <th style="text-align: center" width="15%">মোবাইল নং</th>
                                <th style="text-align: center" width="15%">মন্তব্য</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(json_decode($audit_team_schedule['team_members'],true) as $role => $team_members)
                                @if($role != 'teamLeader')
                                    @foreach($team_members as $key => $sub_team_leader)
                                        <tr>
                                            <td style="text-align: center">{{enTobn($loop->iteration)}}</td>
                                            <td style="text-align: left">{{$sub_team_leader['officer_name_bn']}}</td>
                                            <td style="text-align: center">{{$sub_team_leader['designation_bn'].' ও '.$sub_team_leader['team_member_role_bn']}}</td>
                                            <td style="text-align: center">{{enTobn($sub_team_leader['officer_mobile'])}}</td>
                                            <td style="text-align: center"></td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div style="margin-top: 15px">
                        <table width="100%" border="1">
                            <tbody>
                            <tr>
                                <td style="text-align: center" width="5%">ক্রমিক নং</td>
                                <td style="text-align: center" width="45%">শাখার নাম</td>
                                <td style="text-align: center" width="20%">নিরীক্ষা বছর</td>
                                <td style="text-align: center" width="15%">নিরীক্ষা সময়কাল</td>
                                <td style="text-align: center" width="15%">মোট কর্ম দিবস</td>
                            </tr>
                            <tr>
                                <td style="text-align: center" width="5%">১</td>
                                <td style="text-align: center" width="45%">২</td>
                                <td style="text-align: center" width="20%">৩</td>
                                <td style="text-align: center" width="15%">৪</td>
                                <td style="text-align: center" width="15%">৫</td>
                            </tr>
                            @php
                                $scheduleSl = 1;
                                $totalActivityManDays = 0;
                            @endphp
                            @foreach(json_decode($audit_team_schedule['team_schedules'],true) as $role => $team_schedule)
                                @php $totalActivityManDays= $totalActivityManDays+$team_schedule['activity_man_days']; @endphp
                                <tr>
                                    <td style="text-align: center">{{enTobn($scheduleSl)}}.</td>
                                    <td style="text-align: left">{{$team_schedule['cost_center_name_bn']}}</td>
                                    <td style="text-align: center">{{enTobn($audit_team_schedule['audit_year_start'])}}-{{enTobn($audit_team_schedule['audit_year_end'])}}</td>
                                    <td style="text-align: center">{{enTobn(date('d/m/Y',strtotime($team_schedule['team_member_start_date'])))}} খ্রি.
                                        হতে {{enTobn(date('d/m/Y',strtotime($team_schedule['team_member_end_date'])))}} খ্রি.
                                    </td>
                                    <td style="text-align: center">{{enTobn($team_schedule['activity_man_days'])}} কর্ম দিবস</td>
                                </tr>
                                @if(!empty($team_schedule['activity_detail_date']))
                                    <tr>
                                        <td style="text-align: center">{{enTobn($scheduleSl+1)}}.</td>
                                        <td colspan="3" style="text-align: center">{{enTobn(date('d/m/Y',strtotime($team_schedule['activity_detail_date'])))}} খ্রি. {{$team_schedule['activity_details']}}</td>
                                        <td></td>
                                    </tr>
                                    @php $scheduleSl= $scheduleSl+2; @endphp
                                @else
                                    @php $scheduleSl++; @endphp
                                @endif
                            @endforeach
                            <tr>
                                <th colspan="4" style="text-align: right">সর্বমোট</th>
                                <th style="text-align: center">{{enTobn($totalActivityManDays)}} কর্ম দিবস</th>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                @endif
            @endforeach


            {{--for audit advice--}}
            <div style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
                <u>নিরীক্ষা দলের প্রতি নির্দেশনা:</u>
            </div>

            <div style="font-family:SolaimanLipi,serif !important;text-align: justify">
                {!! nl2br($office_order['advices']) !!}
            </div>

            <div style="font-family:SolaimanLipi,serif !important;text-align: center;float: right">
                (নাসিমুল ইসলাম) <br>
                পরিচালক <br>
                ফোন: ৪৮৩২১১৫৯
            </div>

            <div style="font-family:SolaimanLipi,serif !important;width: 100%;margin-top: 70px">
                <span style="width: 85%;float: left">
                    {{$office_order['memorandum_no']}}
                </span>
                    <span style="width: 15%;float: right">
                    তারিখঃ  {{enTobn(date('d/m/Y',strtotime($office_order['memorandum_date'])))}} খ্রি।
                </span>
            </div>
            <br>

            {{--for audit advice--}}
            <div style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
                <u>সদয় অবগতি ও প্রয়োজনীয় ব্যবস্থা গ্রহণের জন্য অনুলিপি প্রেরণ করা হলো :(জ্যেষ্ঠতার ক্রমানুসারে নয় )</u>
            </div>

            <div style="font-family:SolaimanLipi,serif !important;text-align: justify">
                {!! nl2br($office_order['order_cc_list']) !!}
            </div>

            <div style="font-family:SolaimanLipi,serif !important;text-align: center;float: right">
                (নাহিদ আক্তার) <br>
                নিরীক্ষা ও হিসাবরক্ষণ কর্মকর্তা <br>
                প্রশাসন-৩ শাখা <br>
                ফোন: ৪৮৩২১১৫৯
            </div>
        </div>
    </div>
</div>

<script>
    var Show_Office_Order_Container={
        printOfficeOrder: function (elem) {
            url = '{{route('audit.plan.audit.office-orders.show-office-order')}}';
            audit_plan_id = elem.data('audit-plan-id');
            annual_plan_id = elem.data('annual-plan-id');
            is_print = 1;
            data = {audit_plan_id,annual_plan_id,is_print};

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                var newDoc = document.open("text/html", "replace");
                newDoc.write(response);
                newDoc.close();
                /* myWindow = window.open("data:text/html," + encodeURIComponent(response),
                     "_blank", "width=200,height=100");
                 myWindow.focus();*/
            });
        },
    }
</script>
