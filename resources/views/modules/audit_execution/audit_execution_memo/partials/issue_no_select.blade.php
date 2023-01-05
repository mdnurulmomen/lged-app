<option value="">Select Issue No</option>
@foreach($memo_list as $memo)
    <option value="{{$memo['onucched_no']}}">{{$memo['onucched_no']}}</option>
@endforeach
