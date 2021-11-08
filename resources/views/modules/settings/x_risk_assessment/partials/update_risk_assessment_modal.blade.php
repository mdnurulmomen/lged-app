<form id="risk_assessment_form_update">
    <div class="form-row pt-4">
        <div class="col-md-12">
            <select name="risk_assessment_type" id="risk_assessment_type" class="form-control select-select2">
                    <option value="">Select Risk Assessment Type</option>

                    <option @if($risk_assessment_type == 'inherent' ) selected @endif value="inherent">Inherent Risk</option>
                    <option @if($risk_assessment_type == 'control' ) selected @endif value="control">Control Risk</option>
                    <option @if($risk_assessment_type == 'detection' ) selected @endif value="detection">Detection risk</option>
            </select>
        </div>
    </div>

    <div class="form-row pt-4">
        <div class="col-md-12">
            <select name="company_type" id="company_type" class="form-control select-select2">
                    <option @if($company_type == '' ) selected @endif value="">Select Company Type</option>
                    <option @if($company_type == 'non_company' ) selected @endif value="non_company">Non Company</option>
                    <option @if($company_type == 'all_entity' ) selected @endif value="all_entity">All Entity</option>
                </select>
        </div>
    </div>

    <div class="form-row pt-4">
        <div class="col-md-12">
            <textarea id="risk_assessment_title_bn" placeholder="Risk Assessment Bangla" class="form-control" type="text"
                      name="risk_assessment_title_bn">{{$risk_assessment_title_bn}}</textarea>
        </div>
    </div>
    <div class="form-row pt-4">
        <div class="col-md-12">
            <textarea id="risk_assessment_title_en" placeholder="Riski Assessment English" class="form-control" type="text"
                      name="risk_assessment_title_en">{{$risk_assessment_title_en}}</textarea>
        </div>
    </div>
    <input type="hidden" name="id" id="id" value="{{$risk_assessment_id}}">
    <div class="form-row pt-4">
        <button type="button" class="btn btn-primary btn_update_risk_assessment pt-4 ml-1">Update</button>
    </div>
</form>

<script>
    $('.btn_update_risk_assessment').click(function () {
        url = '{{route('settings.risk-assessment.update', ['risk_assessment' => $risk_assessment_id])}}';
        var data = $('#risk_assessment_form_update').serialize();

        ajaxCallAsyncCallbackAPI(url, data, 'PUT', function (response) {
            if (response.status === 'success') {
                toastr.success(response.data);
                $('.ki-close').click();
                $('.x_risk_assessment a').click();
            } else {
                toastr.error(response.data.message)
                if (response.data.errors) {
                    $.each(response.data.errors, function (k, v) {
                        if (isArray(v)) {
                            $.each(v, function (n, m) {
                                toastr.error(m)
                            })
                        } else {
                            if (v !== '') {
                                toastr.error(v);
                            }
                        }
                    });
                }
                console.log(response.data)
            }
        });
    });
</script>
