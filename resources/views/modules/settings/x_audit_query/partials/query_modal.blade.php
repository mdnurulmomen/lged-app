<x-modal id="audit_query_modal" title="Create Fiscal Year" url="{{route('settings.audit-query.store')}}">
    <form id="audit_query_form">

        <div class="form-row pt-4">
            <div class="col-md-4">
                <select name="cost_center_type_id" id="cost_center_type_id" class="form-control select-select2">
                    <option value="">Select Cost Center Type</option>
                    @foreach($cost_center_types as $key => $type)
                        <option value="{{$type['id']}}">{{$type['name_bn']}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="appendQuery">
            <div class="form-row pt-4">
                <div class="col-md-4">
                    <textarea placeholder="Query Title Bangla" class="form-control" type="text" name="query_title_bn[]"></textarea>

                </div>
                <div class="col-md-4">
                    <textarea placeholder="Query Title English" class="form-control" type="text" name="query_title_en[]"></textarea>
                </div>
                <div class="col-md-2">
                <span title="যোগ করুন"
                      class="btn btn-outline-primary btn-sm btn-square btn_query_add">
                    <i class="fal fa-plus"></i>
                </span>
                </div>
            </div>
        </div>
        <input type="hidden" name="audit_query_id" id="audit_query_id" value="">
    </form>
</x-modal>

<script>
    $('.btn_create_audit_query').click(function () {
        emptyModalData('audit_query_modal');
        $('#audit_query_modal_title').text('Create');
        $('#btn_audit_query_modal_save').text('Save');
        $('#btn_audit_query_modal_save').data('url', $(this).data('url'));
        $('#btn_audit_query_modal_save').data('method', $(this).data('method'));
        modal_backdrop = $(this).attr('data-id');
        $('#audit_query_modal').modal('show');
        if(modal_backdrop){
            $('.fade').removeClass('modal-backdrop');
        }
    });

    $('#btn_audit_query_modal_save').click(function () {
        url = $(this).data('url');
        data = $('#audit_query_form').serialize();
        method = $(this).data('method');
        ajaxCallAsyncCallbackAPI(url, data, method, function (response) {
            if (response.status === 'success') {
                toastr.success('Success')
                $('#audit_query_modal').modal('hide');
                $('.x_query_menu a').click();
            } else {
                // toastr.error(response.data.message)
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
                console.log(response.data)
            }
        })
    });

    $('.btn_query_add').on('click', function () {
        $('.appendQuery').append(
            `<div class="form-row pt-4">
                <div class="col-md-4">
                    <textarea placeholder="Query Title Bangla" class="form-control" type="text" name="query_title_bn[]"></textarea>
                </div>
                <div class="col-md-4">
                    <textarea placeholder="Query Title Bangla" class="form-control" type="text" name="query_title_en[]"></textarea>
                </div>
                <div class="col-md-2">
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
