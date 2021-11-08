{{--<h4>--}}
{{--    @if($risk_assessment_type == 'inherent')--}}
{{--        সহজাত ঝুঁকি--}}
{{--    @elseif($risk_assessment_type == 'control')--}}
{{--        নিয়ন্ত্রণ ঝুঁকি--}}
{{--    @elseif($risk_assessment_type == 'detection')--}}
{{--        সনাক্ত ঝুঁকি--}}
{{--    @endif--}}
{{--</h4>--}}
<table class="table table-bordered">
                <thead>
                <tr>
                    <th width="10%" class="text-center">ক্রঃ নং</th>
                    <th width="70%" class="text-center">বিবরণ</th>
{{--                    <th width="5%">হ্যাঁ</th>--}}
{{--                    <th width="5%">না</th>--}}
                    <th width="20%" class="text-center">স্কোর (০-৫ স্কেলে)</th>
                </tr>
                </thead>
                <tbody>
                @foreach($risk_assessments as $risk_assessment)
                        <tr>
                            <td class="text-center">{{enTobn($loop->iteration)}}</td>
                            <td class="text-center">{{$risk_assessment['risk_assessment_title_bn']}}</td>
{{--                            <td>--}}
{{--                                <input class="yes" type="checkbox" value="0">--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="no" type="checkbox" value="0">--}}
{{--                            </td>--}}
                            <td class="text-center">{{enTobn($risk_assessment['risk_value'])}}</td>
                        </tr>
                @endforeach
                        <tr>
                            <td class="text-center" colspan="2">সর্বমোট</td>
                            <td>{{enTobn($total_number)}}</td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2">
                                @if($risk_assessment_type == 'inherent')
                                    সহজাত ঝুঁকির মাত্রা
                                @elseif($risk_assessment_type == 'control')
                                    নিয়ন্ত্রণ ঝুঁকির মাত্রা
                                @elseif($risk_assessment_type == 'detection')
                                    সনাক্ত ঝুঁকির মাত্রা
                                @endif
                            </td>
                            <td>
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
