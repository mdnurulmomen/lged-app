<form id="risk_matrix_form">
    <div class="form-row">
        <div class="col-md-12 form-group">
            <label for="email">Risk Likelihood:</label>
            {{-- <input placeholder="Criterion Weight" class="form-control" type="number" id="risk_weight"> --}}
            <select class="form-control" id="x_risk_assessment_likelihood_id">
                <option>Select Likelihood:</option>
                @foreach ($riskAssessmentLivelihoods as $riskAssessmentLivelihood)
                    <option value="{{ $riskAssessmentLivelihood['id'] }}">{{ $riskAssessmentLivelihood['title_en'] }}</option>
                @endforeach
              </select>
        </div>
        <div class="col-md-12 form-group">
            <label for="email">Risk Impact:</label>
            {{-- <input placeholder="Criterion Weight" class="form-control" type="number" id="risk_weight"> --}}
            <select class="form-control" id="x_risk_assessment_impact_id">
                <option>Select Impact:</option>
                @foreach ($riskAssessmentImpacts as $riskAssessmentImpact)
                    <option value="{{ $riskAssessmentImpact['id'] }}">{{ $riskAssessmentImpact['title_en'] }}</option>
                @endforeach
              </select>
        </div>
        <div class="col-md-12 form-group">
            <label for="email">Risk Level:</label>
            {{-- <input placeholder="Criterion Weight" class="form-control" type="number" id="risk_weight"> --}}
            <select class="form-control" id="x_risk_level_id">
                <option>Select Level:</option>
                @foreach ($riskLevels as $riskLevel)
                    <option value="{{ $riskLevel['id'] }}">{{ $riskLevel['title_en'] }}</option>
                @endforeach
              </select>
        </div>
        <div class="col-md-12 form-group">
            <label for="priority">Priority:</label>
            <input placeholder="Priority" class="form-control" type="number" id="priority">
        </div>
        <div class="col-md-12 pt-4">
            <button type="button" id="btn_risk_matrix_modal_save" class="btn btn-primary ml-auto">Save</button>
        </div>
    </div>
</form>

<script>
    $('#btn_risk_matrix_modal_save').click(function () {
        url = "{{ route('risk-assessment.risk-matrixes.store') }}";
        method = 'POST';
        
        // data = $('#risk_matrix_form').serialize();

        data = {
            x_risk_assessment_likelihood_id : $('#x_risk_assessment_likelihood_id').val(),
            x_risk_assessment_impact_id : $('#x_risk_assessment_impact_id').val(),
            x_risk_level_id : $('#x_risk_level_id').val(),
            priority : $('#priority').val(),
        };
        
        // console.log(data);

        ajaxCallAsyncCallbackAPI(url, data, method, function (response) {
            if (response.status === 'success') {
                loadData();
                toastr.success('Success');
                $('.btn-quick-panel-close').click();
            } else {
                // toastr.error(response.data.message)
                if (response.errors.length) {
                    $.each(response.errors, function (k, v) {
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
            }
        })
    });
</script>

