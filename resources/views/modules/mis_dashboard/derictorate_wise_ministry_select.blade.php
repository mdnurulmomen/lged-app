<option value="0">Choose Ministry</option>
@foreach($all_ministrys as $ministry)
    <option value="{{$ministry['directorate_ministry']['id']}}">{{$ministry['directorate_ministry']['name_bng']}}</option>
@endforeach
