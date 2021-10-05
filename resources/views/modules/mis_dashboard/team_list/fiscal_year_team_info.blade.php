@foreach($all_teams as $team)
    @php
        $team_members =  json_decode($team['team_members'],true);
    @endphp

    <div class="card card-body mb-2">
        <h4>{{$team['team_name']}}</h4>
        <table class="table table-bordered">
            <thead>
            <th>#</th>
            <th>নাম</th>
            <th>পদবী</th>
            <th>মোবাইল নং</th>
            </thead>
            <tbody>
                @foreach($team_members as $role => $team_member)
                    @foreach($team_member as $key => $member)
                        <tr>
                            <td style="text-align: center">{{enTobn($loop->iteration)}}</td>
                            <td style="text-align: left">{{$member['officer_name_bn']}}</td>
                            <td style="text-align: center">{{$member['designation_bn'].' ও '.$member['team_member_role_bn']}}</td>
                            <td style="text-align: center">{{enTobn($member['officer_mobile'])}}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>

        @if($team['child'])
            @foreach($team['child'] as $child)
                @php
                    $sub_team_members =  json_decode($child['team_members'],true);
                @endphp
                <h4>{{$child['team_name']}}</h4>
                <table class="table table-bordered">
                    <thead>
                    <th>#</th>
                    <th>নাম</th>
                    <th>পদবী</th>
                    <th>মোবাইল নং</th>
                    </thead>
                    <tbody>
                        @foreach($sub_team_members as $role => $sub_team_member)
                             @if($role != 'teamLeader')
                                    @foreach($sub_team_member as $key => $sub_member)
                                        <tr>
                                            <td style="text-align: center">{{enTobn($loop->iteration)}}</td>
                                            <td style="text-align: left">{{$sub_member['officer_name_bn']}}</td>
                                            <td style="text-align: center">{{$sub_member['designation_bn'].' ও '.$sub_member['team_member_role_bn']}}</td>
                                            <td style="text-align: center">{{enTobn($sub_member['officer_mobile'])}}</td>
                                        </tr>
                                    @endforeach
                             @endif
                        @endforeach
                    </tbody>
                </table>

                @if($child['team_schedules'])
                @php
                    $sub_team_schedules =  json_decode($child['team_schedules'],true);
                @endphp
                <table class="table table-bordered" id='table'>
                <thead>
                <th>শাখার নাম</th>
                <th>নিরীক্ষা বছর</th>
                <th>নিরীক্ষা সময়কাল</th>
                <th>মোট কর্ম দিবস</th>
                </thead>
                <tbody>
                @foreach($sub_team_schedules as $sub_team_schedule)
                    <tr>
                        <td>{{$sub_team_schedule['cost_center_name_bn']}}</td>
                        <td>{{$team['audit_year_start']}} - {{$team['audit_year_end']}}</td>
                        <td>{{$child['team_start_date']}} - {{$child['team_end_date']}}</td>
                        <td>{{$child['activity_man_days']}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endif

            @endforeach
        @endif

        @if($team['team_schedules'])
             @php
                 $team_schedules =  json_decode($team['team_schedules'],true);
                    @endphp
                <table class="table table-bordered" id='table'>
                <thead>
                <th>শাখার নাম</th>
                <th>নিরীক্ষা বছর</th>
                <th>নিরীক্ষা সময়কাল</th>
                <th>মোট কর্ম দিবস</th>
                </thead>
                <tbody>
                @foreach($team_schedules as $schedules)
                    <tr>
                        <td>{{$schedules['cost_center_name_bn']}}</td>
                        <td>{{$team['audit_year_start']}} - {{$team['audit_year_end']}}</td>
                        <td>{{$team['team_start_date']}} - {{$team['team_end_date']}}</td>
                        <td>{{$team['activity_man_days']}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endif
    </div>
@endforeach


