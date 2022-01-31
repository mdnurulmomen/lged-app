@foreach($preliminaryAIRList as $preliminaryAIR)
    <option value="{{$preliminaryAIR['id']}}">{{$preliminaryAIR['report_name']}}</option>
@endforeach
