<option value="">All Sub Teams</option>
@foreach($sub_team_list as $sub_team)
     <option value="{{$sub_team['id']}}">{{$sub_team['team_name']}} ({{$sub_team['leader_name_bn']}})</option>
@endforeach
