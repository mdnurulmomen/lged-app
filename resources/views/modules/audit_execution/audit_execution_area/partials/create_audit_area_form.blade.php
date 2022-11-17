<form id="audit_area_form">
    <div class="form-row">
        <div class="col-md-12 form-group">
            <label for="email">Title (Bangla):</label>
            <textarea placeholder="Name Bangla" class="form-control" type="text" id="name_bn"></textarea>
        </div>
        <div class="col-md-12 form-group">
            <label for="email">Title (English):</label>
            <textarea placeholder="Name English" class="form-control" type="text" id="name_en"></textarea>
        </div>
        <div class="col-md-12 pt-4">
            <button type="button" id="btn_audit_area_modal_save" class="btn btn-primary ml-auto">Save</button>
        </div>
    </div>
</form>

<script>
    $('#btn_audit_area_modal_save').click(function () {
        url = "{{ route('audit.execution.areas.store') }}";
        method = 'POST';
        
        // data = $('#audit_area_form').serialize();

        data = {
            name_bn : $('#name_bn').val(),
            name_en : $('#name_en').val(),
        };
        
        // console.log(data);

        ajaxCallAsyncCallbackAPI(url, data, method, function (response) {
            if (response.status === 'success') {
                loadData();
                toastr.success('Success')
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

