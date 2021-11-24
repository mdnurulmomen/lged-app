<h4>Detection Risk</h4>

<table class="table" border="1" width="100%">
    <thead>
    <tr>
        <th width="10%" style="text-align: center">ক্রমিক নং</th>
        <th width="45%" style="text-align: left">ডিটেকশান রিস্ক</th>
        <th width="45%" style="text-align: left">মিটিগেশন</th>
    </tr>
    </thead>
    <tbody>
    @foreach($risk_assessments as $risk_assessment)
        <tr>
            <td width="10%" style="text-align: center">{{enTobn($loop->iteration)}}</td>
            <td width="45%">{{$risk_assessment['risk_assessment_title_bn']}}</td>
            <td width="45%">{{enTobn($risk_assessment['risk_value'])}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
