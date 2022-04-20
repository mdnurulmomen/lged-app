<option value="">মন্ত্রণালয় বাছাই করুন</option>
@foreach($ministryList as $ministry)
    <option value="{{$ministry['ministry_id']}}">{{$ministry['ministry_name_bn']}} </option>
@endforeach
