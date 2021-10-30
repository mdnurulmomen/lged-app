<ul>
    @foreach($rp_offices as $rp_office)
        <li data-rp-auditee-entity-id="{{$rp_office['id']}}" data-entity-info="{{json_encode(
    [
        'entity_id' => $rp_office['id'],
        'entity_name_en' => $rp_office['office_name_en'],
        'entity_name_bn' => $rp_office['office_name_bn'],
        'controlling_office_id' => $controlling_office_id,
        'controlling_office_name_bn' => $controlling_office_name_bn,
        'controlling_office_name_en' => $controlling_office_name_en,
        ], JSON_UNESCAPED_UNICODE)}}" data-jstree='{ "opened" : true }'>
            {{$rp_office['office_name_bn']}}
            @if(count($rp_office['child']) > 0)
                @include('modules.audit_plan.annual.annual_plan_revised.partials.load_rp_auditee_offices_child',
 [
        'controlling_office_id' => $controlling_office_id,
        'controlling_office_name_bn' => $controlling_office_name_bn,
        'controlling_office_name_en' => $controlling_office_name_en,
         'rp_offices' => $rp_office['child']
     ])
            @endif

        </li>
    @endforeach
</ul>
