<form id="audit_query_form">
    <input type="hidden" name="ac_query_id" id="ac_query_id" value="{{$ac_query_id}}">
    <input type="text" class="form-control" value="{{$query_title_bn}}" readonly>
    <div class="form-row pt-4">
        <div class="col-md-12">
            <textarea placeholder="মন্তব্য" class="form-control" type="text"
                      name="comment" rows="5"></textarea>
        </div>
    </div>
    <button type="button" class="btn btn-primary mt-4" id="btn_audit_query_modal_save">Save</button>
</form>

<script>
    $('#btn_audit_query_modal_save').click(function () {
        url = '{{route('audit.execution.reject-audit-query')}}';
        data = $('#audit_query_form').serialize();
        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
            if (response.status === 'success') {
                toastr.success('সফলভাবে সংরক্ষণ করা হয়েছে');
                cost_center_type_id = '{{$cost_center_type_id}}';
                $('#cost_center_type').val(cost_center_type_id).trigger('change');
            }
            else {
                if (response.statusCode === '422') {
                    var errors = response.msg;
                    $.each(errors, function (k, v) {
                        if (v !== '') {
                            toastr.error(v);
                        }
                    });
                }
                else {
                    toastr.error(response.data.message);
                }
            }
        })
    });
</script>
