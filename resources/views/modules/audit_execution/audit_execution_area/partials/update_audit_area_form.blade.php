<form id="audit_area_form_update">
    <div class="form-row">
        <input type="hidden" id="id" value="{{ $id }}">
        <div class="col-md-12 form-group">
            <label for="email">Title (Bangla):</label>
            <textarea placeholder="Name Bangla" class="form-control" type="text" id="name_bn">{{ $name_bn }}</textarea>
        </div>
        <div class="col-md-12 form-group">
            <label for="email">Title (English):</label>
            <textarea placeholder="Name English" class="form-control" type="text" id="name_en">{{ $name_en }}</textarea>
        </div>
        <div class="col-md-12 pt-4">
            <button type="button" class="btn btn-primary btn_update_audit_area pt-4 ml-1">Update</button>
        </div>
    </div>
</form>

<script>
    $('.btn_update_audit_area').click(function () {
        url = "{{ route('audit.execution.areas.update', $id) }}";

        data = {
            id : $('#id').val(),
            name_bn : $('#name_bn').val(),
            name_en : $('#name_en').val(),
        };

        ajaxCallAsyncCallbackAPI(url, data, 'PUT', function (response) {
            if (response.status === 'success') {
                toastr.success(response.data);
                // loadData();
                $('.ki-close').click();
                $('.x_audit_area a').click();
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
