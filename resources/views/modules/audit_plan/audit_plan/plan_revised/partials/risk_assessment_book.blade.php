<h4>{{$risk_assessment_type}}</h4>
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
                            <td>{{$loop->iteration}}</td>
                            <td>{{$risk_assessment['risk_assessment_title_bn']}}</td>
{{--                            <td>--}}
{{--                                <input class="yes" type="checkbox" value="0">--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="no" type="checkbox" value="0">--}}
{{--                            </td>--}}
                            <td>{{$risk_assessment['risk_value']}}</td>
                        </tr>
                @endforeach
                </tbody>
            </table>
