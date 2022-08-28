<option value="">মন্ত্রণালয় বাছাই করুন</option>
@foreach($all_ministrys as $ministry)
    <option data-ministry-en="{{$ministry['directorate_ministry']['name_eng']}}" value="{{$ministry['directorate_ministry']['id']}}">{{$ministry['directorate_ministry']['name_bng']}}</option>
@endforeach
