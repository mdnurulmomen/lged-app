<option value="">সিলেক্ট এনটিটি</option>
@foreach($entity_list as $entity)
    <option value="{{$entity['entity_id']}}">
        {{$entity['entity_name_bn']}}
    </option>
@endforeach
