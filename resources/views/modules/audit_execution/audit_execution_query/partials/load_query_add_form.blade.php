<form id="audit_query_form">
    <div class="form-row">
        <div class="col-md-12">
            <select name="cost_center_type_id" id="cost_center_type_id" class="form-control">
                <option value="">Select Cost Center Type</option>
                @foreach($cost_center_types as $key => $type)
                    <option value="{{$type['id']}}" {{$type['id'] == $cost_center_type_id?'selected':''}}>{{$type['name_bn']}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="appendQuery">
        <div class="form-row pt-4">
            <div class="col-md-6">
                <textarea placeholder="Query Title Bangla" class="form-control" type="text" name="query_title_bn[]" rows="1"></textarea>
            </div>
            <div class="col-md-5">
                <textarea placeholder="Query Title English" class="form-control" type="text" name="query_title_en[]" rows="1"></textarea>
            </div>
            <div class="col-md-1 mt-1">
                <span title="যোগ করুন" class="btn btn-outline-primary btn-sm btn-square btn_query_add">
                    <i class="fal fa-plus"></i>
                </span>
            </div>
        </div>
    </div>
    <input type="hidden" name="audit_query_id" id="audit_query_id" value="">

    <button type="button" class="btn btn-primary mt-4" id="btn_audit_query_modal_save">Save</button>
</form>

<script>
    $('#btn_audit_query_modal_save').click(function () {
        url = '{{route('settings.audit-query.store')}}';
        data = $('#audit_query_form').serialize();
        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
            if (response.status === 'success') {
                toastr.success('সফলভাবে সংরক্ষণ করা হয়েছে');
                cost_center_type_id = $("#cost_center_type_id").val();
                $('#cost_center_type').val(cost_center_type_id).trigger('change');
                $('#kt_quick_panel_close').click();
            }
            else {
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
                else {
                    toastr.error(response.data.message);
                }
            }
        })
    });

    $('.btn_query_add').on('click', function () {
        $('.appendQuery').append(
            `<div class="form-row pt-4">
                <div class="col-md-6">
                    <textarea placeholder="Query Title Bangla" rows="1" class="form-control" type="text" name="query_title_bn[]"></textarea>
                </div>
                <div class="col-md-5">
                    <textarea placeholder="Query Title Bangla" rows="1" class="form-control" type="text" name="query_title_en[]"></textarea>
                </div>
                <div class="col-md-1 mt-1">
                    <button title="মুছে ফেলুন" class="btn btn-outline-danger btn-sm btn-danger btn-square btn_query_remove">
                        <i class="fal fa-minus"></i>
                    </button>
                </div>
            </div>`
        );

        $('.appendQuery').on('click', '.btn_query_remove', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });

        // $('.summernote').summernote();
        // $('div.note-editable').height(150);
    });

</script>
