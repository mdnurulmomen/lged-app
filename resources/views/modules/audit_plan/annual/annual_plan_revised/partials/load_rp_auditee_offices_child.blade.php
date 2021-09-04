<ul>
    @foreach($rp_offices as $rp_office)
        <li data-rp-auditee-entity-id="{{$rp_office['id']}}" data-entity-info="{{json_encode(
    [
        'entity_id' => $rp_office['id'],
        'entity_name_en' => $rp_office['office_name_en'],
        'entity_name_bn' => $rp_office['office_name_bn'],
        'ministry_id' => $ministry['id'],
        'ministry_name_en' => $ministry['name_en'],
        'ministry_name_bn' => $ministry['name_bn'],
        ])}}" data-jstree='{ "opened" : true }'>
            {{$rp_office['office_name_en']}}
            @if(count($rp_office['child']) > 0)
                @include('modules.audit_plan.annual.annual_plan.partials.load_rp_auditee_offices_child', ['rp_offices' => $rp_office['child']])
            @endif

        </li>
    @endforeach
</ul>
