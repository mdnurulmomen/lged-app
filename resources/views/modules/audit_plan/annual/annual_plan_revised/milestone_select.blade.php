@foreach($all_milestone as $milestone)
    <option value="">মাইলস্টোন বাছাই করুন</option>
    <option value="{{$milestone['id']}}">{{$milestone['title_bn']}} </option>
@endforeach
