<form id="risk_criterion_form_update">
    <div class="form-row">
        <input type="hidden" id="id" value="{{ $id }}">
        <div class="col-md-12 form-group">
            <label for="email">Risk Likelihood:</label>
            {{-- <input placeholder="Criterion Weight" class="form-control" type="number" id="risk_weight"> --}}
            <select class="form-control" id="x_risk_assessment_likelihood_id">
                <option>Select Likelihood:</option>
                @foreach ($riskAssessmentLivelihoods as $riskAssessmentLivelihood)
                    <option 
                        value="{{ $riskAssessmentLivelihood['id'] }}"
                        @if ($riskAssessmentLivelihood['id'] == $x_risk_assessment_likelihood_id) selected @endif
                    >
                        {{ $riskAssessmentLivelihood['title_en'] }}
                    </option>
                @endforeach
              </select>
        </div>
        <div class="col-md-12 form-group">
            <label for="email">Risk Impact:</label>
            {{-- <input placeholder="Criterion Weight" class="form-control" type="number" id="risk_weight"> --}}
            <select class="form-control" id="x_risk_assessment_impact_id">
                <option>Select Impact:</option>
                @foreach ($riskAssessmentImpacts as $riskAssessmentImpact)
                    <option 
                        value="{{ $riskAssessmentImpact['id'] }}" 
                        @if ($riskAssessmentImpact['id'] == $x_risk_assessment_impact_id) selected @endif
                    >
                        {{ $riskAssessmentImpact['title_en'] }}
                    </option>
                @endforeach
              </select>
        </div>
        <div class="col-md-12 form-group">
            <label for="email">Risk Level:</label>
            {{-- <input placeholder="Criterion Weight" class="form-control" type="number" id="risk_weight"> --}}
            <select class="form-control" id="x_risk_level_id">
                <option>Select Level:</option>
                @foreach ($riskLevels as $riskLevel)
                    <option 
                        value="{{ $riskLevel['id'] }}" 
                        @if ($riskLevel['id'] == $x_risk_level_id) selected @endif
                    >
                        {{ $riskLevel['title_en'] }}
                    </option>
                @endforeach
              </select>
        </div>
        <div class="col-md-12 form-group">
            <label for="priority">Priority:</label>
            <input placeholder="Priority" class="form-control" type="number" id="priority" value="{{ $priority }}">
        </div>
        <div class="col-md-12 pt-4">
            <button type="button" class="btn btn-primary btn_update_risk_criterion pt-4 ml-1">Update</button>
        </div>
    </div>
</form>

<script>
    $('.btn_update_risk_criterion').click(function () {
        url = "{{ route('risk-assessment.risk-matrixes.update', $id) }}";

        data = {
            id : $('#id').val(),
            x_risk_assessment_likelihood_id : $('#x_risk_assessment_likelihood_id').val(),
            x_risk_assessment_impact_id : $('#x_risk_assessment_impact_id').val(),
            x_risk_level_id : $('#x_risk_level_id').val(),
            priority : $('#priority').val(),
        };

        ajaxCallAsyncCallbackAPI(url, data, 'PUT', function (response) {
            if (response.status === 'success') {
                loadData();
                toastr.success(response.data);
                $('.ki-close').click();
                $('.x_risk_criterion a').click();
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
                
                // console.log(response.data)
            }
        });
    });
</script>
