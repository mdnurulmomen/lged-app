<option value="">ফাইনাল রিপোর্ট বাছাই করুন</option>
@foreach($report_list as $report)
    <option value="{{$report['id']}}">{{$report['report_name']}} </option>
@endforeach
