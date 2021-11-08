{{--<h4>--}}
{{--    @if($risk_assessment_type == 'inherent')--}}
{{--        সহজাত ঝুঁকি--}}
{{--    @elseif($risk_assessment_type == 'control')--}}
{{--        নিয়ন্ত্রণ ঝুঁকি--}}
{{--    @elseif($risk_assessment_type == 'detection')--}}
{{--        সনাক্ত ঝুঁকি--}}
{{--    @endif--}}
{{--</h4>--}}
<table class="table" border="1">
                <thead>
                <tr>
                    <th width="10%" style="text-align: center">ক্রঃ নং</th>
                    <th width="70%" style="text-align: center">বিবরণ</th>
{{--                    <th width="5%">হ্যাঁ</th>--}}
{{--                    <th width="5%">না</th>--}}
                    <th width="20%" style="text-align: center">স্কোর (০-৫ স্কেলে)</th>
                </tr>
                </thead>
                <tbody>
                @foreach($risk_assessments as $risk_assessment)
                        <tr>
                            <td style="text-align: center">{{enTobn($loop->iteration)}}</td>
                            <td>{{$risk_assessment['risk_assessment_title_bn']}}</td>
{{--                            <td>--}}
{{--                                <input class="yes" type="checkbox" value="0">--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="no" type="checkbox" value="0">--}}
{{--                            </td>--}}
                            <td style="text-align: center">{{enTobn($risk_assessment['risk_value'])}}</td>
                        </tr>
                @endforeach
                        <tr>
                            <td style="text-align: center" colspan="2">সর্বমোট</td>
                            <td style="text-align: center">{{enTobn($total_number)}}</td>
                        </tr>
                        <tr>
                            <td style="text-align: center" colspan="2">
                                @if($risk_assessment_type == 'inherent')
                                    সহজাত ঝুঁকির মাত্রা
                                @elseif($risk_assessment_type == 'control')
                                    নিয়ন্ত্রণ ঝুঁকির মাত্রা
                                @elseif($risk_assessment_type == 'detection')
                                    সনাক্ত ঝুঁকির মাত্রা
                                @endif
                            </td>
                            <td style="text-align: center">
                                {{enTobn($risk_rate)}}

                                @if($risk == 'high')
                                    (উচ্চ ঝুঁকি)
                                @elseif($risk == 'medium')
                                    (মধ্যম ঝুঁকি)
                                @elseif($risk == 'low')
                                    (নিম্ন ঝুঁকি)
                                @endif
                            </td>
                        </tr>
                </tbody>
            </table>
