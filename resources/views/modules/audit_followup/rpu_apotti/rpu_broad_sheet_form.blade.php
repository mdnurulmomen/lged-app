
<form class="pb-15" id="broad_sheet_form" enctype="multipart/form-data">
    <div class="row">
        <input type="hidden" value="{{implode(',',$apottis)}}" name="apottis">
        <div class="col-md-6">
            <label for="memorandum_no">স্মারক নং</label>
            <input class="form-control" type="text" name="memorandum_no" id="memorandum_no">
        </div>
        <div class="col-md-6">
            <label for="memorandum_date">স্মারক তারিখ</label>
            <input class="form-control date"  type="text" name="memorandum_date" id="memorandum_date" autocomplete="off">
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-12">
            <label for="broad_sheet_hard_copy">জবাব হার্ডকপি</label>
            <input type="file" class="form-control" id="broad_sheet_hard_copy" name="broad_sheet_hard_copy">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label for="details">প্রাপকের বিস্তারিত</label>
            <textarea class="form-control" id="receiver_details" name="receiver_details" cols="30" rows="2"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label for="details">বিষয়</label>
            <textarea class="form-control" id="subject" name="subject" cols="30" rows="2"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label for="details">বিস্তারিত</label>
            <textarea class="form-control" id="details" name="details" cols="30" rows="2"></textarea>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <label for="details">অনুলিপি</label>
            <textarea class="form-control" id="cc_list" name="cc_list" cols="30" rows="2"></textarea>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-12">
            <a  class="btn btn-primary btn-sm btn-bold btn-square broad_sheet_submit float-right"
               href="javascript:;">
                <i class="far fa-save mr-1"></i> {{___('generic.save')}}
            </a>
        </div>
    </div>
</form>

<script>
    //for submit form
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.broad_sheet_submit').on('click', function (e) {
            e.preventDefault();
            from_data = new FormData(document.getElementById("broad_sheet_form"));

            memo_type = $('#memo_type').val();

            sender_type = memo_type == 'sfi' ? 'ministry' : 'entity';

            directorate_id = $('#directorate_filter').val();
            directorate_en = $('#directorate_filter').find(':selected').data('directorate-en');
            directorate_bn = $('#directorate_filter').find(':selected').text();

            ministry_id = $('#ministry_id').val();
            ministry_en = $('#ministry_id').find(':selected').data('ministry-en');
            ministry_bn = $('#ministry_id').find(':selected').text();

            entity_id = $('#entity_id').val();
            entity_en = $('#entity_id').find(':selected').data('entity-en');
            entity_bn = $('#entity_id').find(':selected').text();

            from_data.append('directorate_id', directorate_id);
            from_data.append('directorate_en', directorate_en);
            from_data.append('directorate_bn', directorate_bn);

            from_data.append('ministry_id', ministry_id);
            from_data.append('ministry_en', ministry_en);
            from_data.append('ministry_bn', ministry_bn);

            from_data.append('entity_id', entity_id);
            from_data.append('entity_en', entity_en);
            from_data.append('entity_bn', entity_bn);

            from_data.append('memo_type', memo_type);
            from_data.append('sender_type', sender_type);
            from_data.append('broad_sheet_type', 'air_report');


            elem = $(this);
            elem.prop('disabled', true);

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            $.ajax({
                data: from_data,
                url: '{{route('rpu-apotti.rpu-broad-sheet-submit')}}',
                type: "POST",
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (responseData) {
                    KTApp.unblock('#kt_content');
                    if (responseData.status === 'success') {
                        toastr.success(responseData.data);
                        $('#kt_quick_panel_close').click();
                        $('#memo_type').val(memo_type).trigger('change');
                    } else {
                        elem.prop('disabled', false);
                        if (responseData.statusCode === '422') {
                            var errors = responseData.msg;
                            $.each(errors, function (k, v) {
                                if (v !== '') {
                                    toastr.error(v);
                                }
                            });
                        } else {
                            toastr.error(responseData.data);
                        }
                    }
                },
                error: function (data) {
                    KTApp.unblock('#kt_content');
                    elem.prop('disabled', false)
                    if (data.responseJSON.errors) {
                        $.each(data.responseJSON.errors, function (k, v) {
                            if (isArray(v)) {
                                $.each(v, function (n, m) {
                                    toastr.error(m)
                                    console.log(m, n, v);
                                })
                            } else {
                                if (v !== '') {
                                    toastr.error(v);
                                }
                            }
                        });
                    }
                }
            });
        });
    });
</script>
