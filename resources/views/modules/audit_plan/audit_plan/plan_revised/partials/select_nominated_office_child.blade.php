@foreach($nominated_offices_list as $key => $nominatedOffice)
    <option value='{{$nominatedOffice['id']}}' data-cost-center-id='{{$nominatedOffice['id']}}' data-cost-center-name-bn='{{$nominatedOffice['office_name_bng']}}' data-cost-center-name-en='{{$nominatedOffice['office_name_eng']}}'>{{$nominatedOffice['office_name_bng']}}</option>
    @if(count($nominatedOffice) > 0)
        @include('modules.audit_plan.audit_plan.plan_revised.partials.select_nominated_office_child', ['nominated_offices_list' => $nominatedOffice['child']])
    @endif
@endforeach
