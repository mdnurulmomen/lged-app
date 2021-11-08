<table class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th width="5%">#</th>
                    <th width="5%">ক্রঃ নং</th>
                    <th width="70%">বিবরণ</th>
                    <th width="5%">হ্যাঁ</th>
                    <th width="5%">না</th>
                    <th width="10%">স্কোর (০-৫ স্কেলে)</th>
                </tr>
                </thead>
                <tbody>
                @foreach($risk_assessment_list as $risk_assessment)
                        <tr data-id="{{$risk_assessment['id']}}" class="row_{{$risk_assessment_type}}">
                            <td>
                                <input
                                    data-risk-assessment-id="{{$risk_assessment['id']}}"
                                    data-risk-assessment-title-bn="{{$risk_assessment['risk_assessment_title_en']}}"
                                    data-risk-assessment-title-en="{{$risk_assessment['risk_assessment_title_en']}}"
                                    class="select_{{$risk_assessment_type}}" type="checkbox"
                                    value="{{$risk_assessment['id']}}" >
                            </td>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$risk_assessment['risk_assessment_title_bn']}}</td>
                            <td>
                                <input class="yes" type="checkbox" value="0">
                            </td>
                            <td>
                                <input class="no" type="checkbox" value="0">
                            </td>
                            <td><input type="text" class="form-control number_{{$risk_assessment_type}}" value=""></td>
                        </tr>
                @endforeach
                </tbody>
            </table>

<div style="display: none" class="row mt-4 risk_rate_div_{{$risk_assessment_type}}">

                <input type="hidden" id="risk_assessment_type_{{$risk_assessment_type}}" name="risk_assessment_type" value="{{$risk_assessment_type}}">
                <input type="hidden" id="total_risk_value_{{$risk_assessment_type}}" name="total_risk_value">
                <input type="hidden" id="risk_rate_{{$risk_assessment_type}}" name="risk_rate">
                <input type="hidden" id="risk_{{$risk_assessment_type}}" name="risk">

                <div class="col-lg-4"></div>
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <div class="row"><p class="float-left">ঝুঁকির মাত্রা : </p>
                        <p class="risk_rate_number_{{$risk_assessment_type}} float-left"></p>
                        <p class="risk_rate_{{$risk_assessment_type}} float-left"></p></div>
                    <div class="row">
                        <div>
                            <p>০ - ০.২ = নিম্ন ঝুঁকি</p>
                            <p>০.২ - ০.৬ = মধ্যম ঝুঁকি</p>
                            <p>০.৬ - ১.০০ = উচ্চ ঝুঁকি</p>
                        </div>
                    </div>
                </div>
            </div>
        <div class="row mt-4">
                <div class="col-lg-12">
                    <button type="button" onclick="calculateRiskRate('{{$risk_assessment_type}}')" class="btn  btn-success btn-square"><i
                            class="fas fa-save mr-2"></i> Calculate
                    </button>
                    <button type="button" onclick="riskRateSubmit('{{$risk_assessment_type}}')" class="btn  btn-success btn-square"><i
                            class="fas fa-save mr-2"></i> Submit
                    </button>
                </div>
        </div>
