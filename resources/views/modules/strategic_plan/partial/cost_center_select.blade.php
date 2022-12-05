<option value="0">Select Location</option>
@foreach($cost_center_list as $cost_center)
<option data-parent-office-id="{{$cost_center['parent_office_id'] ? $cost_center['parent_office_id'] : ''}}"
        data-parent-office-name-en="{{$cost_center['parent_office_id'] ? $cost_center['parent_office']['office_name_eng'] : ''}}"
        data-parent-office-name-bn="{{$cost_center['parent_office_id'] ? $cost_center['parent_office']['office_name_bng'] : ''}}"
        data-office-name-en="{{$cost_center['office']['office_name_eng']}}"
        data-office-name-bn="{{$cost_center['office']['office_name_bng']}}"
        value="{{$cost_center['office_id']}}">{{$cost_center['office']['office_name_bng']}}</option>
@endforeach
