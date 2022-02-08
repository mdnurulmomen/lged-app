<option value="">--বাছাই করুন--</option>
@foreach($preliminaryAIRList as $preliminaryAIR)
    <option value="{{$preliminaryAIR['id']}}">{{$preliminaryAIR['report_name']}}</option>
@endforeach
