<h4>
    @if($risk_assessment_type == 'inherent')
        Inherent Risk
    @elseif($risk_assessment_type == 'control')
        Control Risk
    @elseif($risk_assessment_type == 'detection')
        Detection Risk
    @endif
</h4>


<table class="table" border="1" width="100%">
    <thead>
    <tr>
        <th width="10%" style="text-align: center">ক্রমিক নং</th>
        <th width="{{$risk_assessment_type != 'detection'?70:45}}%" style="text-align: left">
            @if($risk_assessment_type == 'inherent')
                ইনহেরেন্ট রিস্ক ফ্যাক্টর
            @elseif($risk_assessment_type == 'control')
                কন্ট্রোল রিস্ক ফ্যাক্টর
            @elseif($risk_assessment_type == 'detection')
                ডিটেকশান রিস্ক
            @endif
        </th>
        <th width="{{$risk_assessment_type != 'detection'?20:45}}%" style="text-align: left">
            {{$risk_assessment_type != 'detection'?'রিস্কস্কোর (উচ্চ/মধ্যম/নিম্ন)':'মিটিগেশন'}}
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($risk_assessments as $risk_assessment)
        <tr>
            <td style="text-align: center">{{enTobn($loop->iteration)}}</td>
            <td>{{$risk_assessment['risk_assessment_title_bn']}}</td>
            <td>
                {{$risk_assessment_type != 'detection'?enTobn($risk_assessment['risk_value']):$risk_assessment['detection_risk_value_bn']}}
            </td>
        </tr>
    @endforeach

    @if($risk_assessment_type != 'detection')
        <tr>
            <td style="text-align: center" colspan="2">মোট:</td>
            <td style="text-align: center">{{enTobn($total_number)}}</td>
        </tr>
        <tr>
            <td style="text-align: center" colspan="2">
                @if($risk_assessment_type == 'inherent')
                    সামগ্রিক ইনহেরেন্ট রিস্ক
                @elseif($risk_assessment_type == 'control')
                    সামগ্রিক কন্ট্রোল রিস্ক
                @elseif($risk_assessment_type == 'detection')
                    সামগ্রিক ডিটেকশান রিস্ক
                @endif
            </td>
            <td style="text-align: center">
                {{enTobn(round($risk_rate,2))}}

                {{--@if($risk == 'high')
                    (উচ্চ ঝুঁকি)
                @elseif($risk == 'medium')
                    (মধ্যম ঝুঁকি)
                @elseif($risk == 'low')
                    (নিম্ন ঝুঁকি)
                @endif--}}
            </td>
        </tr>
    @endif
    </tbody>
</table>


