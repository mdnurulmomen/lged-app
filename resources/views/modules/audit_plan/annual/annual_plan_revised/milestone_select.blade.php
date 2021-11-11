@foreach($all_milestone as $milestone)
    <option value="{{$milestone['id']}}">{{$milestone['title_bn']}} </option>
@endforeach
