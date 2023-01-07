<form id="risk_level_form_update">
    <input type="hidden" id="id" value="{{ $id }}">
    <div class="form-row">
        <div class="col-md-6 form-group">
            <label for="from">From:</label>
            <input placeholder="Level From" class="form-control" id="level_from" value="{{ $level_from }}">
        </div>

        <div class="col-md-6 form-group">
            <label for="from">To:</label>
            <input placeholder="Level To" class="form-control" id="level_to" value="{{ $level_to }}">
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-12 form-group">
            <label for="email">Type:</label>
            <select class="form-control" id="type">
                <option value="factor_risk_assessment" @if ($type=='factor_risk_assessment') selected @endif>Factor Risk Assessment</option>
                <option value="area_risk_assessment" @if ($type=='area_risk_assessment') selected @endif>Area Risk Assessment</option>
            </select>
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
            <button type="button" class="btn btn-primary btn_update_risk_level pt-4 ml-1">Update</button>
        </div>
    </div>
</form>

<script>
    $('.btn_update_risk_level').click(function () {
        url = "{{ route('settings.risk-levels.update', $id) }}";

        data = {
            id : $('#id').val(),
            level_from : $('#level_from').val(),
            level_to : $('#level_to').val(),
            type : $('#type').find(":selected").val(),
            title_bn : $('#title_bn').val(),
            title_en : $('#title_en').val(),
        };

        ajaxCallAsyncCallbackAPI(url, data, 'PUT', function (response) {
            if (response.status === 'success') {
                loadData();
                toastr.success(response.data);
                // $('.x_risk_level a').click();
                $('.btn-quick-panel-close').click();
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
