<form id="risk_level_form">
    <div class="form-row">
        <div class="col-md-6 form-group">
            <label for="from">From:</label>
            <input placeholder="Level From" class="form-control" type="number" id="level_from">
        </div>

        <div class="col-md-6 form-group">
            <label for="from">To:</label>
            <input placeholder="Level To" class="form-control" type="number" id="level_to">
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-12 form-group">
            <label for="type">Type:</label>
            <select class="form-control" id="type">
                <option value="" disabled selected>Level Type</option>
                <option value="factor_risk_assessment">Factor Risk Assessment</option>
                <option value="area_risk_assessment">Area Risk Assessment</option>
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
            <button type="button" id="btn_risk_level_modal_save" class="btn btn-primary ml-auto">Save</button>
        </div>
    </div>
</form>

<script>
    $('#btn_risk_level_modal_save').click(function () {
        url = "{{ route('settings.risk-levels.store') }}";
        method = 'POST';
        
        // data = $('#risk_level_form').serialize();

        data = {
            level_from : $('#level_from').val(),
            level_to : $('#level_to').val(),
            title_bn : $('#title_bn').val(),
            title_en : $('#title_en').val(),
            type : $('#type').find(":selected").val()
        };

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

