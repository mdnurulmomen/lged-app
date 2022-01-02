<select name="entity_id" id="entity_id" class="form-control rounded-0">
    <option value="0">--বাছাই করুন--</option>
    @foreach($offices as $office)
        <option value="{{$office['id']}}">
            {{$office['office_name_bn']}}
        </option>
    @endforeach
</select>
