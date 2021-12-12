<option value="">অ্যাক্টিভিটি বাছাই করুন</option>
@foreach($all_activity as $activity)
    <option value="{{$activity['id']}}">{{$activity['title_bn']}} </option>
@endforeach
