<div style="text-align: center">
    @foreach($team_schedules as $audit_team_schedule)
        @if($audit_team_schedule['team_schedules'] != null)
            <div style="margin-top: 15px">
                <table width="100%" border="1">
                    <tbody>
                    <tr>
                        <td colspan="7" style="text-align: center">{{$audit_team_schedule['team_name']}}</td>
                    </tr>
                    <tr>
                        <td style="text-align: center" width="5%">ক্রমিক নং</td>
                        <td style="text-align: center" width="30%">নিরীক্ষা প্রতিষ্ঠানের নাম</td>
                        <td style="text-align: center" width="15%">নিরীক্ষার বৎসর (অর্থ বছর)</td>
                        <td style="text-align: center" width="15%">নিরীক্ষার শুরুর তারিখ</td>
                        <td style="text-align: center" width="15%">নিরীক্ষার শেষের তারিখ</td>
                        <td style="text-align: center" width="15%">কর্ম দিবস</td>
                        <td style="text-align: center" width="15%">মন্তব্য</td>
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
                                <td style="text-align: center">
                                    {{formatDate($team_schedule['team_member_start_date'],'bn')}} খ্রি.
                                </td>
                                <td style="text-align: center">
                                    {{formatDate($team_schedule['team_member_end_date'],'bn')}} খ্রি.
                                </td>
                                <td style="text-align: center">{{enTobn($team_schedule['activity_man_days'])}} কর্ম দিবস</td>
                                <td></td>
                            </tr>
                        @else
                            <tr>
                                <td style="text-align: center">{{enTobn($loop->iteration)}}.</td>
                                <td colspan="6" style="text-align: center">{{formatDate($team_schedule['team_member_start_date'],'bn')}} খ্রি. {{$team_schedule['activity_details']}}</td>
                            </tr>
                        @endif
                    @endforeach
                    <tr>
                        <th colspan="5" style="text-align: right">সর্বমোট</th>
                        <th style="text-align: center">{{enTobn($totalActivityManDays)}} কর্ম দিবস</th>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        @endif
    @endforeach
</div>
