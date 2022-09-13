<select name="entity_id" id="entity_id" class="form-control rounded-0">
    <option value="">সবগুলো</option>
    @foreach($offices as $office)
        <option value="{{$office['id']}}" data-office-name-en="{{$office['office_name_en']}}"
                data-office-name-bn="{{$office['office_name_bn']}}">
            {{$office['office_name_bn']}}
        </option>
    @endforeach
</select>
