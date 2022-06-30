<select name="unit_group_office_id" id="unit_group_office_id" class="form-control rounded-0">
    <option value="">সবগুলো</option>
    @foreach($offices as $office)
        <option value="{{$office['id']}}">
            {{$office['office_name_bng']}}
        </option>
    @endforeach
</select>
