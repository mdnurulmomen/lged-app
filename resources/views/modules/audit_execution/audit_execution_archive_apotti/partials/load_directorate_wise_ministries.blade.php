<select name="ministry_id" id="ministry_id" class="form-control rounded-0">
    <option value="">সবগুলো</option>
    @foreach($all_ministries as $ministry)
        <option data-ministry-name-en="{{$ministry['directorate_ministry']['name_eng']}}"
                data-ministry-name-bn="{{$ministry['directorate_ministry']['name_bng']}}"
                value="{{$ministry['directorate_ministry']['id']}}">{{$ministry['directorate_ministry']['name_bng']}}</option>
    @endforeach
</select>
