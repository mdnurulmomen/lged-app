<form id="risk_criterion_form">
    <div class="form-row">
        <div class="col-md-12 form-group">
            <label for="email">Factor:</label>
            {{-- <input placeholder="Criterion Weight" class="form-control" type="number" id="risk_weight"> --}}
            <select class="form-control" id="x_risk_factor_id">
                <option>Select criterion:</option>
                @foreach ($riskFactors as $riskFactor)
                    <option value="{{ $riskFactor['id'] }}">{{ $riskFactor['title_en'] }}</option>
                @endforeach
              </select>
        </div>
        <div class="col-md-12 form-group">
            <label for="email">Title (Bangla):</label>
            <textarea placeholder="Query Title Bangla" class="form-control" type="text" id="title_bn"></textarea>
        </div>
        <div class="col-md-12 form-group">
            <label for="email">Title (English):</label>
            <textarea placeholder="Query Title English" class="form-control" type="text" id="title_en"></textarea>
        </div>
        <div class="col-md-12 pt-4">
            <button type="button" id="btn_risk_criterion_modal_save" class="btn btn-primary ml-auto">Save</button>
        </div>
    </div>
</form>

<script>
    $('#btn_risk_criterion_modal_save').click(function () {
        url = "{{ route('settings.risk-criteria.store') }}";
        method = 'POST';
        
        // data = $('#risk_criterion_form').serialize();

        data = {
            title_bn : $('#title_bn').val(),
            title_en : $('#title_en').val(),
            x_risk_factor_id : $('#x_risk_factor_id').val(),
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

