<option value="">All Teams</option>
@foreach($team_list as $team)
     <option value="{{$team['id']}}">{{$team['team_name']}} ({{$team['leader_name_bn']}})</option>
@endforeach
