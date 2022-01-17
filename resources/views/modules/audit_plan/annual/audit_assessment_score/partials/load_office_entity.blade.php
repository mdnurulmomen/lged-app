<select name="entity_id" id="entity_id" class="form-control rounded-0">
    <option value="">--বাছাই করুন--</option>
    @foreach($offices as $office)
        <option data-last-audit-year-start="{{$office['last_audit_year_start']}}" data-last-audit-year-end="{{$office['last_audit_year_end']}}" value="{{$office['id']}}">
            {{$office['office_name_bn']}}
        </option>
    @endforeach
</select>
