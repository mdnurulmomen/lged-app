<option value="">Select Audit Plan</option>
@foreach($all_audit_plan as $audit_plan)
    @php
        $entities = [];
        foreach($audit_plan['ap_entities'] as $ap_entities){
           $entity =  $ap_entities['entity_name_bn'];
            $entities[] = $entity;
        }
    @endphp
    <option data-entity-info="{{json_encode($audit_plan['ap_entities'])}}" value="{{$audit_plan['id']}}">
        {{implode(' , ', $entities)}} - প্ল্যান {{enTobn($audit_plan['id'])}}
    </option>
@endforeach
