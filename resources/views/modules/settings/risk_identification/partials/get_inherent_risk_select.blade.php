<option value="">Select Inherent Risk</option>
@foreach($risk_list as $risk)
    <option value="{{$risk['id']}}">{{$risk['risk_name']}}</option>
@endforeach
