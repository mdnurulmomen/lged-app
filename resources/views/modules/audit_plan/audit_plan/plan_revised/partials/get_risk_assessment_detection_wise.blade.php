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
                <i class="fas fa-plus"></i> Add
            </button>
        </div>
    </div>
</div>

<div class="row pt-6">
    <div class="col-md-12">
        <div class="form-group">
            <label for="risk_assessment_point_{{$risk_assessment_type}}">রিস্ক স্কোর (০-৫)</label>
            <input type="text" class="form-control detection-risk-score" id="risk_assessment_point_{{$risk_assessment_type}}"
            value="{{!empty($ap_risk_assessment_list)?$ap_risk_assessment_list['risk_rate']:''}}">
        </div>

        <fieldset class="scheduler-border">
            <legend class="scheduler-border">
                রিস্কসমূহ
            </legend>
            <table width="100%" class="table table-bordered table-striped table-hover
            table-condensed table-sm" id="detectionItemTblList">
                <tbody>
                <tr>
                    <th width="45%">ঝুঁকি</th>
                    <th width="45%">মিটিগেশন</th>
                    <th width="10%">সম্পাদন</th>
                </tr>
                @if(!empty($ap_risk_assessment_list))
                    @foreach($ap_risk_assessment_list['risk_assessment_items'] as $ap_risk_assessment_item)
                    <tr id="riskAssessmentId{{$ap_risk_assessment_item['x_risk_assessment_id']}}" class="row_risk_item_detection">
                        <td width="45%">{{$ap_risk_assessment_item['risk_assessment_title_bn']}}</td>
                        <td width="45%">
                            <textarea class="form-control risk_score" data-risk-assessment-id="{{$ap_risk_assessment_item['x_risk_assessment_id']}}"
                                      data-risk-assessment-title-bn="{{$ap_risk_assessment_item['risk_assessment_title_bn']}}"
                                      data-risk-assessment-title-en="{{$ap_risk_assessment_item['risk_assessment_title_en']}}">{{$ap_risk_assessment_item['detection_risk_value_bn']}}</textarea>
                        </td>
                        <td width="10%">
                            <button type="button" class="btn btn-icon btn-outline-danger btn-xs border-0"
                            onclick="deleteRiskItem($(this))">
                                <i class="fal fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
        </fieldset>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-12">
        <button
            type="button"
            @if(!empty($ap_risk_assessment_list))
            onclick="detectionRiskSubmit('update','{{$ap_risk_assessment_list['id']}}')"
            @else
            onclick="detectionRiskSubmit('add','')"
            @endif
            class="btn btn-success btn-square save_{{$risk_assessment_type}}">
            <i class="fas fa-save mr-2"></i> {{!empty($ap_risk_assessment_list)?'Update':'Save'}}
        </button>
    </div>
</div>

<script>
    $('.detection-risk-score').on('blur', function () {
        if ($(this).val() > 1) {
            $(this).val('');
            toastr.warning('সর্বোচ্চ ঝুঁকি মান ১');
        }
    });
</script>

