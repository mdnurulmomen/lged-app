<option value="">এনটিটি/সংস্থা বাছাই করুন</option>
@foreach($entityList as $entity)
    <option value="{{$entity['sender_office_id']}}">{{$entity['sender_office_name_bn']}} </option>
@endforeach
