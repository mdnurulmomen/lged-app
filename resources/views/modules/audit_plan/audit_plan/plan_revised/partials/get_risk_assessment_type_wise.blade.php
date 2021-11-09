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
    @foreach($x_risk_assessment_list as $risk_assessment)
        <tr data-id="{{$risk_assessment['id']}}" class="row_{{$risk_assessment_type}}">
            <td>
                <input
                    data-risk-assessment-id="{{$risk_assessment['id']}}"
                    data-risk-assessment-title-bn="{{$risk_assessment['risk_assessment_title_en']}}"
                    data-risk-assessment-title-en="{{$risk_assessment['risk_assessment_title_en']}}"
                    class="select_{{$risk_assessment_type}}"
                    @if($ap_risk_assessment_list && isset($ap_risk_assessment_list['risk_assessment_items'][$risk_assessment['id']]))
                    checked
                    @endif
                    type="checkbox"
                    value="{{$risk_assessment['id']}}">
            </td>
            <td>{{$loop->iteration}}</td>
            <td>{{$risk_assessment['risk_assessment_title_bn']}}</td>
            <td>
                <input
                    class="yes"
                    @if($ap_risk_assessment_list &&  isset($ap_risk_assessment_list['risk_assessment_items'][$risk_assessment['id']]) && $ap_risk_assessment_list['risk_assessment_items'][$risk_assessment['id']]['yes'])
                    checked
                    @endif
                    type="radio"
                    name="yes_no_{{$risk_assessment['id']}}"
                    value="0">
            </td>
            <td>
                <input
                    @if($ap_risk_assessment_list &&  isset($ap_risk_assessment_list['risk_assessment_items'][$risk_assessment['id']]) && $ap_risk_assessment_list['risk_assessment_items'][$risk_assessment['id']]['no'])
                    checked
                    @endif
                    class="no"
                    type="radio"
                    name="yes_no_{{$risk_assessment['id']}}"
                    value="0">
            </td>
            <td>
                <input
                    type="text"
                    class="form-control integer_type_positive number_{{$risk_assessment_type}} max_value_five"
                    value="@if($ap_risk_assessment_list && isset($ap_risk_assessment_list['risk_assessment_items'][$risk_assessment['id']])){{$ap_risk_assessment_list['risk_assessment_items'][$risk_assessment['id']]['risk_value']}}@endif">
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div style="@if(!$ap_risk_assessment_list) display: none @endif"
     class="row mt-4 risk_rate_div_{{$risk_assessment_type}}">

    <input type="hidden" id="risk_assessment_type_{{$risk_assessment_type}}" name="risk_assessment_type"
           value="{{$risk_assessment_type}}">
    <input type="hidden" id="total_risk_value_{{$risk_assessment_type}}" name="total_risk_value" value="@if($ap_risk_assessment_list) {{$ap_risk_assessment_list['total_risk_value']}} @endif">
    <input type="hidden" id="risk_rate_{{$risk_assessment_type}}" name="risk_rate" value="@if($ap_risk_assessment_list) {{$ap_risk_assessment_list['risk_rate']}} @endif">
    <input type="hidden" id="risk_{{$risk_assessment_type}}" name="risk" value="@if($ap_risk_assessment_list) {{$ap_risk_assessment_list['risk']}} @endif">

    <div class="col-md-4"></div>
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="row"><p class="float-left">ঝুঁকির মাত্রা : </p>
            <p class="risk_rate_number_{{$risk_assessment_type}} float-left">@if($ap_risk_assessment_list) {{$ap_risk_assessment_list['risk_rate']}} @endif</p>
            <p class="risk_rate_{{$risk_assessment_type}} float-left">
                @if($ap_risk_assessment_list)
                    @if($ap_risk_assessment_list['risk'] == 'high')
                        (উচ্চ ঝুঁকি)
                    @elseif($ap_risk_assessment_list['risk'] == 'medium')
                        (মধ্যম ঝুঁকি)
                    @elseif($ap_risk_assessment_list['risk'] == 'low')
                        (নিম্ন ঝুঁকি)
                    @endif
                @endif
            </p>
        </div>
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
        <button type="button" onclick="calculateRiskRate('{{$risk_assessment_type}}')"
                class="btn  btn-info btn-square calculate_{{$risk_assessment_type}}"><i
                class="fas fa-calculator mr-2"></i> Calculate
        </button>
        <button
            type="button"
                @if($ap_risk_assessment_list)
                    onclick="riskRateSubmit('{{$risk_assessment_type}}','update','{{$ap_risk_assessment_list['id']}}')"
                @else
                    onclick="riskRateSubmit('{{$risk_assessment_type}}','add','')"
                @endif
            class="btn  btn-success btn-square save_{{$risk_assessment_type}}">
            <i class="fas fa-save mr-2"></i> Submit
        </button>

    </div>
</div>

<script>
    $(function () {
        type = '{{$risk_assessment_type}}';
        $('.save_' + type).prop("disabled", true);
    });

    $('.max_value_five').on('blur', function () {
        if ($(this).val() > 5) {
            $(this).val('');
        }
    });
</script>
