@foreach($preliminaryAIRList as $preliminaryAIR)
    <option value="{{$preliminaryAIR['id']}}">প্রিলিমিনারি এআইআর - {{enTobn($preliminaryAIR['id'])}}</option>
@endforeach
