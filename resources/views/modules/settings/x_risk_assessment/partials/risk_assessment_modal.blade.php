<x-modal id="risk_assessment_modal" title="Create Risk Assessment" url="{{route('settings.risk-assessment.store')}}">
    <form id="risk_assessment_form">
        <div class="form-row pt-4">
            <div class="col-md-4">
                <select name="risk_assessment_type" id="risk_assessment_type" class="form-control select-select2">
                    <option value="">Select Cost Center Type</option>
                    <option value="inherent">Inherent Risk</option>
                    <option value="control">Control Risk</option>
                    <option value="detection">Detection risk</option>
                </select>
            </div>
        </div>

        <div class="appendQuery">
            <div class="form-row pt-4">
                <div class="col-md-3">
                    <select name="company_type" id="company_type"
                            class="form-control select-select2">
                        <option value="">Select Company Type</option>
                        <option value="non_company">Non Company</option>
                        <option value="all_entity">All Entity</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <textarea placeholder="Query Title Bangla" class="form-control" type="text" name="risk_assessment_title_bn[]"></textarea>

                </div>
                <div class="col-md-3">
                    <textarea placeholder="Query Title English" class="form-control" type="text" name="risk_assessment_title_en[]"></textarea>
                </div>
                <div class="col-md-2">
                <span title="যোগ করুন"
                      class="btn btn-outline-primary btn-sm btn-square btn_query_add">
                    <i class="fal fa-plus"></i>
                </span>
                </div>
            </div>
        </div>
        <input type="hidden" name="risk_assessment_id" id="risk_assessment_id" value="">
    </form>
</x-modal>

<script>
    $('.btn_create_risk_assessment').click(function () {
        emptyModalData('risk_assessment_modal');
        $('#risk_assessment_modal_title').text('Create');
        $('#btn_risk_assessment_modal_save').text('Save');
        $('#btn_risk_assessment_modal_save').data('url', $(this).data('url'));
        $('#btn_risk_assessment_modal_save').data('method', $(this).data('method'));
        modal_backdrop = $(this).attr('data-id');
        $('#risk_assessment_modal').modal('show');
        if(modal_backdrop){
            $('.fade').removeClass('modal-backdrop');
        }
    });

    $('#btn_risk_assessment_modal_save').click(function () {
        url = $(this).data('url');
        data = $('#risk_assessment_form').serialize();
        method = $(this).data('method');
        ajaxCallAsyncCallbackAPI(url, data, method, function (response) {
            if (response.status === 'success') {
                toastr.success('Success')
                $('#risk_assessment_modal').modal('hide');
                $('.x_risk_assessment a').click();
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
                <div class="col-md-3">
                    <select name="company_type" id="company_type"
                            class="form-control select-select2">
                        <option value="">Select Company Type</option>
                        <option value="non_company">Non Company</option>
                        <option value="all_entity">All Entity</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <textarea placeholder="Risk Assessment Title Bangla" class="form-control" type="text" name="risk_assessment_title_bn[]"></textarea>
                </div>
                <div class="col-md-3">
                    <textarea placeholder="Risk Assessment Title English" class="form-control" type="text" name="risk_assessment_title_en[]"></textarea>
                </div>
                <div class="col-md-2">
                    <button title="মুছে ফেলুন" class="btn btn-outline-danger btn-sm btn-danger btn-square btn_risk_assessment_remove">
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
