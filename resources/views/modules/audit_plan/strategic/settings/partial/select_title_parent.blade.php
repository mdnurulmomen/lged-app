<select name="parent_id" id="parent_id" class="form-control rounded-0">
    <option value="0">--Select--</option>
    @foreach($titles as $title)
        <option value="{{$title['id']}}">@if($title['parent']) {{$title['parent']['title']}} -> @endif {{$title['title']}}</option>
    @endforeach
</select>
