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
                @php $teamMemberSL = 1; @endphp
                @foreach(json_decode($audit_team_schedule['team_members'],true) as $role => $team_members)
                    @if($role != 'teamLeader')
                        @foreach($team_members as $key => $sub_team_leader)
                            <tr>
                                <td style="text-align: center">{{enTobn($teamMemberSL)}}</td>
                                <td style="text-align: left;margin-left: 5px">জনাব {{$sub_team_leader['officer_name_bn']}}</td>
                                <td style="text-align: center">{{$sub_team_leader['designation_bn'].' ও '.$sub_team_leader['team_member_role_bn']}}</td>
                                <td style="text-align: center">{{enTobn($sub_team_leader['officer_mobile'])}}</td>
                                <td style="text-align: center"></td>
                            </tr>
                            @php $teamMemberSL++; @endphp
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
                    $totalActivityManDays = 0;
                @endphp
                @foreach(json_decode($audit_team_schedule['team_schedules'],true) as $role => $team_schedule)
                    @if($team_schedule['schedule_type'] == 'schedule')
                        @php $totalActivityManDays= $totalActivityManDays+$team_schedule['activity_man_days']; @endphp
                        <tr>
                            <td style="text-align: center">{{enTobn($loop->iteration)}}.</td>
                            <td style="text-align: left;margin-left: 5px">{{$team_schedule['cost_center_name_bn']}}</td>
                            <td style="text-align: center">{{enTobn($audit_team_schedule['audit_year_start'])}}-{{enTobn($audit_team_schedule['audit_year_end'])}}</td>
                            <td style="text-align: center">{{formatDate($team_schedule['team_member_start_date'],'bn')}} খ্রি.
                                হতে {{formatDate($team_schedule['team_member_end_date'],'bn')}} খ্রি.
                            </td>
                            <td style="text-align: center">{{enTobn($team_schedule['activity_man_days'])}} কর্ম দিবস</td>
                        </tr>
                    @else
                        <tr>
                            <td style="text-align: center">{{enTobn($loop->iteration)}}.</td>
                            <td colspan="3" style="text-align: center">{{formatDate($team_schedule['team_member_start_date'],'bn')}} খ্রি. {{$team_schedule['activity_details']}}</td>
                            <td></td>
                        </tr>
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
