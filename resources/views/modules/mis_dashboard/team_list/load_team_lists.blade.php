
<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Audit Directorate</th>
            <th>Team Count</th>
            <th>Total Team Member</th>
            <th>Total Working Days</th>
            <th>Total Resource</th>
        </tr>
        </thead>
        <tbody>
        @foreach($all_teams as $all_team)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$all_team['office_name_en']}}</td>
                <td>
                    @if($all_team['total_teams'])
                        <a style="cursor: pointer;text-decoration: underline;color: #0a58ca" onclick="MIS_TEAM_LIST_CONTAINER.loadMISTeamInfo('{{$all_team['fiscal_year_id']}}','{{$all_team['office_id']}}')">{{$all_team['total_teams']}}</a>
                    @else
                        {{$all_team['total_teams']}}
                    @endif
                </td>
                <td>{{$all_team['total_team_members']}}</td>
                <td>{{$all_team['total_working_days']}}</td>
                <td>{{$all_team['total_employees']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

