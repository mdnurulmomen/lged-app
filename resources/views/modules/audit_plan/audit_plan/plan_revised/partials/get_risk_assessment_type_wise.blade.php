<style>
    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
        box-shadow:  0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
</style>

<div class="pt-4">
    <div class="form-row">
        <div class="col-md-10">
            <label for="risk_assessment_{{$risk_assessment_type}}">রিস্ক এসেসমেন্ট</label>
            <select class="form-control select-select2" id="risk_assessment_{{$risk_assessment_type}}">
                <option value="">--সিলেক্ট--</option>
                @foreach($x_risk_assessment_list as $risk_assessment)
                    <option value="{{$risk_assessment['id']}}">
                        {{$risk_assessment['risk_assessment_title_bn']}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 mt-9">
            <button class="btn btn-sm btn-square btn-primary btn-hover-primary"
                    data-risk-assessment-type="{{$risk_assessment_type}}"
                    onclick="addRiskItemList($(this))">
                <i class="fas fa-plus"></i> যোগ করুন
            </button>
        </div>
    </div>
</div>

<div style="@if(empty($ap_risk_assessment_list)) display: none @endif"
     class="mt-4 risk_rate_div_{{$risk_assessment_type}}">
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">
            স্কোর
        </legend>
        <div class="row">
            <div class="col-md-4">
                <input type="hidden" id="risk_assessment_type_{{$risk_assessment_type}}" name="risk_assessment_type"
                       value="{{$risk_assessment_type}}">
                <input type="hidden" id="total_risk_value_{{$risk_assessment_type}}" name="total_risk_value" value="@if($ap_risk_assessment_list) {{count($ap_risk_assessment_list['risk_assessment_items']) * 5}} @endif">
                <input type="hidden" id="total_risk_score_{{$risk_assessment_type}}" name="total_risk_score" value="@if($ap_risk_assessment_list) {{$ap_risk_assessment_list['total_risk_value']}} @endif">
                <input type="hidden" id="risk_rate_{{$risk_assessment_type}}" name="risk_rate" value="@if($ap_risk_assessment_list) {{$ap_risk_assessment_list['risk_rate']}} @endif">
                <input type="hidden" id="risk_{{$risk_assessment_type}}" name="risk" value="@if($ap_risk_assessment_list) {{$ap_risk_assessment_list['risk']}} @endif">

                <div style="font-size: 15px">
                    <span>ঝুঁকির মাত্রা : </span>
                    <span style="font-weight: bold" class="risk_rate_number_{{$risk_assessment_type}}">
                        @if($ap_risk_assessment_list) {{enTobn($ap_risk_assessment_list['risk_rate'])}} @endif
                    </span>
                    <br>

                    <span class="risk_rate_{{$risk_assessment_type}}">
                        @if($ap_risk_assessment_list)
                            @if($ap_risk_assessment_list['risk'] == 'high')
                                (উচ্চ ঝুঁকি)
                            @elseif($ap_risk_assessment_list['risk'] == 'medium')
                                (মধ্যম ঝুঁকি)
                            @elseif($ap_risk_assessment_list['risk'] == 'low')
                                (নিম্ন ঝুঁকি)
                            @endif
                        @endif
                    </span>
                </div>
            </div>

            <div class="col-md-8">
                <div>
                    <span>০ - ০.২ = নিম্ন ঝুঁকি</span>  <br>
                    <span>০.২ - ০.৬ = মধ্যম ঝুঁকি</span>  <br>
                    <span>০.৬ - ১.০০ = উচ্চ ঝুঁকি</span>
                </div>
            </div>
        </div>
    </fieldset>
</div>

<div class="row pt-4">
    <div class="col-md-12">
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">
                রিস্কসমূহ
            </legend>
            <table width="100%" class="table table-bordered table-striped table-hover
            table-condensed table-sm" id="{{$risk_assessment_type}}ItemTblList">
                <thead>
                <tr>
                    <th width="80%">রিস্ক এসেসমেন্ট</th>
                    <th width="15%">স্কোর (০-৫)</th>
                    <th width="5%">সম্পাদন</th>
                </tr>
                </thead>
                <tbody id="{{$risk_assessment_type}}ItemListTblBody">
                @php $totalRiskScore = 0; @endphp
                @if(!empty($ap_risk_assessment_list))
                @foreach($ap_risk_assessment_list['risk_assessment_items'] as $ap_risk_assessment_item)
                    @php $totalRiskScore += $ap_risk_assessment_item['risk_value']; @endphp

                    <tr id="riskAssessmentId{{$ap_risk_assessment_item['x_risk_assessment_id']}}" class="row_risk_item_{{$risk_assessment_type}}">
                        <td width="85%">{{$ap_risk_assessment_item['risk_assessment_title_bn']}}</td>
                        <td width="10%">
                            <input style="width: 100%" type="number" min="1" max="5" data-risk-assessment-id="{{$ap_risk_assessment_item['x_risk_assessment_id']}}"
                                   data-risk-assessment-title-bn="{{$ap_risk_assessment_item['risk_assessment_title_bn']}}"
                                   data-risk-assessment-title-en="{{$ap_risk_assessment_item['risk_assessment_title_en']}}"
                                   onchange="calculateTotalRiskScoreSum('{{$risk_assessment_type}}')"
                                   class="integer_type_positive risk_score" value="{{$ap_risk_assessment_item['risk_value']}}">
                        </td>
                        <td width="5%">
                            <button type="button" class="btn btn-icon btn-outline-danger btn-xs border-0"
                                    data-risk-assessment-type="{{$risk_assessment_type}}"
                                    data-risk-assessment-id="{{$ap_risk_assessment_item['x_risk_assessment_id']}}"
                                    data-risk-assessment-title-bn="{{$ap_risk_assessment_item['risk_assessment_title_bn']}}"
                                    onclick="deleteRiskItem($(this))">
                                <i class="fal fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                @endif
                </tbody>
                <tfoot>
                <tr>
                    <th>মোট</th>
                    <th class="total-{{$risk_assessment_type}}-risk-score">{{$totalRiskScore}}</th>
                    <td></td>
                </tr>
                </tfoot>
            </table>

            @if($risk_assessment_type == 'detection')
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="comment{{$risk_assessment_type}}">ঝুঁকি</label>
                        <textarea class="form-control" id="comment{{$risk_assessment_type}}"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label for="comment{{$risk_assessment_type}}">মিটিগেশন</label>
                        <textarea class="form-control" id="comment{{$risk_assessment_type}}"></textarea>
                    </div>
                </div>
            @endif
        </fieldset>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-12">
        <button type="button" onclick="calculateRiskRate('{{$risk_assessment_type}}')"
                class="btn btn-info btn-square calculate_{{$risk_assessment_type}}">
            <i class="fas fa-calculator mr-2"></i> Calculate
        </button>
        <button
            type="button"
            @if(!empty($ap_risk_assessment_list))
            onclick="riskRateSubmit('{{$risk_assessment_type}}','update','{{$ap_risk_assessment_list['id']}}')"
            @else
            onclick="riskRateSubmit('{{$risk_assessment_type}}','add','')"
            @endif
            class="btn btn-success btn-square save_{{$risk_assessment_type}}">
            <i class="fas fa-save mr-2"></i> {{!empty($ap_risk_assessment_list)?'Update':'Save'}}
        </button>
    </div>
</div>


<script>
    $(function () {
        type = '{{$risk_assessment_type}}';
        $('.save_' + type).prop("disabled", true);
    });
</script>
