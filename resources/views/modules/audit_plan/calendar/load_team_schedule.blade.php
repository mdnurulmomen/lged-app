<h4 class="text-center"> সদস্য তালিকা </h4>
<table class="table table-bordered" id='table'>
    <tr>
        <th>নাম</th>
        <th>পদবী</th>
        <th>নিরীক্ষা দলের অবস্থান</th>
        <th>মোবাইল নং</th>
    </tr>

    @foreach($team_members['teamLeader']  as $team_learder)
        <tr>
            <td>{{$team_learder['officer_name_bn']}}</td>

            <td>{{$team_learder['designation_bn']}}</td>

            <td>{{$team_learder['team_member_role_bn']}}</td>

            <td>{{$team_learder['officer_mobile']}}</td>
        </tr>
    @endforeach

    @if(isset($team_members['subTeamLeader']))
        @foreach($team_members['subTeamLeader']  as $team_learder)
            <tr>
                <td>{{$team_learder['officer_name_bn']}}</td>

                <td>{{$team_learder['designation_bn']}}</td>

                <td>{{$team_learder['team_member_role_bn']}}</td>

                <td>{{$team_learder['officer_mobile']}}</td>
            </tr>
        @endforeach
    @endif

    @if(isset($team_members['member']))
        @foreach($team_members['member']  as $team_learder)
            <tr>
                <td>{{$team_learder['officer_name_bn']}}</td>

                <td>{{$team_learder['designation_bn']}}</td>

                <td>{{$team_learder['team_member_role_bn']}}</td>

                <td>{{$team_learder['officer_mobile']}}</td>
            </tr>
        @endforeach
    @endif

</table>

</br>

@if(!empty($team_schedules))
    <table width='100%' class="table table-bordered" id='table'>
        <tr>
            <th width='30%'>ইউনিট/কস্ট সেন্টারের নাম</th>
            <th width='25%'>নিরীক্ষা বছর</th>
            <th width='35%'>নিরীক্ষা সময়কাল</th>
            <th width='10%'>মোট কর্ম দিবস</th>
        </tr>

        @foreach($team_schedules as $schedule)
            @if($schedule['schedule_type'] == 'schedule')
                <tr>
                    <td> {{$schedule['cost_center_name_bn']}}</td>

                    <td>{{enTobn($audit_year)}}</td>

                    <td> {{enTobn(formatDate($schedule['team_member_start_date'],'bn','/'))}}
                        থেকে {{enTobn(formatDate($schedule['team_member_end_date'],'bn','/'))}}</td>

                    <td>{{enTobn($schedule['activity_man_days'])}} </td>

                </tr>
            @endif
            @if($schedule['schedule_type'] == 'visit')
                <tr>
                    <td class="text-center" colspan="4"> {{enTobn(formatDate($schedule['team_member_start_date'],'bn','/'))}}
                        খ্রি. {{$schedule['activity_details']}}</td>
                </tr>
            @endif
        @endforeach
@endif
    </table>
