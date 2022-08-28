<option value="">এনটিটি/সংস্থা  বাছাই করুন</option>
@foreach($entity_list as $entity)
     <option data-entity-en="{{$entity['entity_name_en']}}" value="{{$entity['entity_id']}}">{{$entity['entity_name_bn']}}</option>
@endforeach
