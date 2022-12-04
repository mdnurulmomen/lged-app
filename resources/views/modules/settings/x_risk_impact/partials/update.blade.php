<form id="risk_impact_form_update">
    <div class="form-row">
        <input type="hidden" id="id" value="{{ $id }}">
        <div class="col-md-12 form-group">
            <label for="email">Value:</label>
            <input placeholder="Impact Value" class="form-control" type="number" id="impact_value" value="{{ $impact_value }}">
        </div>
        <div class="col-md-12 form-group">
            <label for="email">Title (Bangla):</label>
            <textarea placeholder="Query Title Bangla" class="form-control" type="text" id="title_bn">{{ $title_bn }}</textarea>
        </div>
        <div class="col-md-12 form-group">
            <label for="email">Title (English):</label>
            <textarea placeholder="Query Title English" class="form-control" type="text" id="title_en">{{ $title_en }}</textarea>
        </div>
        <div class="col-md-12 pt-4">
            <button type="button" class="btn btn-primary btn_update_risk_impact pt-4 ml-1">Update</button>
        </div>
    </div>
</form>

<script>
    $('.btn_update_risk_impact').click(function () {
        url = "{{ route('settings.risk-impacts.update', $id) }}";

        data = {
            id : $('#id').val(),
            title_bn : $('#title_bn').val(),
            title_en : $('#title_en').val(),
            impact_value : $('#impact_value').val(),
        };

        ajaxCallAsyncCallbackAPI(url, data, 'PUT', function (response) {
            if (response.status === 'success') {
                loadData();
                toastr.success(response.data);
                $('.ki-close').click();
                $('.x_risk_impact a').click();
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
