<form id="risk_factor_form">
    <div class="form-row">
        <div class="col-md-12 form-group">
            <label for="email">Weight:</label>
            <input placeholder="Factor Weight" class="form-control" type="number" id="risk_weight" max="{{ 100 - $risk_weight }}" @if ($risk_weight >= 100 ) disabled @endif>
        </div>
        <div class="col-md-12 form-group">
            <label for="email">Title (Bangla):</label>
            <textarea placeholder="Query Title Bangla" class="form-control" type="text" id="title_bn" @if ($risk_weight >= 100 ) disabled @endif></textarea>
        </div>
        <div class="col-md-12 form-group">
            <label for="email">Title (English):</label>
            <textarea placeholder="Query Title English" class="form-control" type="text" id="title_en" @if ($risk_weight >= 100 ) disabled @endif></textarea>
        </div>
        <div class="col-md-12 pt-4">
            <button type="button" id="btn_risk_factor_modal_save" class="btn btn-primary ml-auto">Save</button>
        </div>
    </div>
</form>

<script>
    $('#btn_risk_factor_modal_save').click(function () {
        url = "{{ route('settings.risk-factors.store') }}";
        method = 'POST';
        
        // data = $('#risk_factor_form').serialize();

        data = {
            title_bn : $('#title_bn').val(),
            title_en : $('#title_en').val(),
            risk_weight : $('#risk_weight').val(),
        };
        
        // console.log(data);

        ajaxCallAsyncCallbackAPI(url, data, method, function (response) {
            if (response.status === 'success') {
                toastr.success('Success');
                loadData();
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

