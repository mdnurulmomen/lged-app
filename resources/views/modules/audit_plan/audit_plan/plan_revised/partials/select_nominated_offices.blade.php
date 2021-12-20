<select id='branch_name_select_{{$layer_id}}_{{$total_audit_schedule_row}}' class='form-control select-select2 input-branch-name' data-id='{{$layer_id}}_{{$total_audit_schedule_row}}'>
    <option value=''>--Select--</option>
    @foreach($nominated_offices_list as $key => $nominatedOffice)
        <option value='{{$nominatedOffice['id']}}' data-cost-center-id='{{$nominatedOffice['id']}}' data-cost-center-name-bn='{{$nominatedOffice['office_name_bng']}}' data-cost-center-name-en='{{$nominatedOffice['office_name_eng']}}'>{{$nominatedOffice['office_name_bng']}}</option>
        @if(count($nominatedOffice) > 0)
            @include('modules.audit_plan.audit_plan.plan_revised.partials.select_nominated_office_child', ['nominated_offices_list' => $nominatedOffice['child']])
        @endif
    @endforeach
</select>
