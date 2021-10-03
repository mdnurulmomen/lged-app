<div class="table-responsive">
    <table class="table table-striped table-responsive">
        <thead class="bg-primary">
        <tr>
            <th class="text-light">#</th>
            <th class="text-light">Audit Directorate</th>
            <th class="text-light">Team Count</th>
            <th class="text-light">Total Team Member</th>
            {{--            <th class="text-light">Total Resource</th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach($all_teams as $all_team)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$all_team['office_name_en']}}</td>
                <td>{{$all_team['total_teams']}}</td>
                <td>{{$all_team['total_team_members']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
