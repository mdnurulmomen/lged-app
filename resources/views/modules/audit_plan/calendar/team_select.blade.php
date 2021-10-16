<option value="">All Teams</option>
@foreach($team_list as $team)
     <option value="{{$team['id']}}">{{$team['team_name']}} ({{$team['leader_name_bn']}})</option>
         @if($team['child'])
            @foreach($team['child'] as $sub_team)
                <option value="{{$sub_team['id']}}">&nbsp;&nbsp;{{$sub_team['team_name']}} ({{$sub_team['leader_name_bn']}})</option>
            @endforeach
         @endif
@endforeach
