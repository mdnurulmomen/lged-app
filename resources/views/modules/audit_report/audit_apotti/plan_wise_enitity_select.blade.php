<option value="">Select Entity</option>
@foreach($entity_list as $entity)
    <option value="{{$entity['id']}}">
        {{$entity['entity_name_bn']}}
    </option>
@endforeach
