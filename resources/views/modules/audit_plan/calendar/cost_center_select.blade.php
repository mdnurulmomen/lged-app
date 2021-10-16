<option value="">All Cost Center</option>
@foreach($cost_center_list as $cost_center)
     <option value="{{$cost_center['cost_center_id']}}">{{$cost_center['cost_center_name_bn']}}</option>
@endforeach
