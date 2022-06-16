<!--begin::Table-->
<div class="row">
    <div class="col-md-12">
        <form id="approval_authority_form">

            <input type="hidden" name="r_air_id" value="{{$air_report_id}}">
            <input type="hidden" name="air_type" value="{{$air_type}}">
            <input type="hidden" name="office_id" value="{{$office_id}}">

            <input name="receiver_officer_id" type="hidden" value="{{$last_air_movement['sender_officer_id']}}"/>
            <input name="receiver_office_id" type="hidden" value="{{$last_air_movement['sender_office_id']}}"/>
            <input name="receiver_unit_id" type="hidden" value="{{$last_air_movement['sender_unit_id']}}"/>
            <input name="receiver_unit_name_en" type="hidden" value="{{$last_air_movement['sender_unit_name_en']}}"/>
            <input name="receiver_unit_name_bn" type="hidden" value="{{$last_air_movement['sender_unit_name_bn']}}"/>
            <input name="receiver_employee_id" type="hidden" value="{{$last_air_movement['sender_employee_id']}}"/>
            <input name="receiver_employee_name_en" type="hidden" value="{{$last_air_movement['sender_employee_name_en']}}"/>
            <input name="receiver_employee_name_bn" type="hidden" value="{{$last_air_movement['sender_employee_name_bn']}}"/>
            <input name="receiver_employee_designation_id" type="hidden" value="{{$last_air_movement['sender_employee_designation_id']}}"/>
            <input name="receiver_employee_designation_en" type="hidden" value="{{$last_air_movement['sender_employee_designation_en']}}"/>
            <input name="receiver_employee_designation_bn" type="hidden" value="{{$last_air_movement['sender_employee_designation_bn']}}"/>
            <input name="receiver_officer_phone" type="hidden" value="{{$last_air_movement['sender_officer_phone']}}"/>
            <input name="receiver_officer_email" type="hidden" value="{{$last_air_movement['sender_officer_email']}}"/>

            <div class="form-group mt-4">
                <label class="col-form-label" for="final_approval_status">স্ট্যাটাস</label>
                <select name="final_approval_status" class="form-control select-select2" id="final_approval_status">
                    <option value="pending" selected>Pending</option>
                    <option value="approved">Approved</option>
                </select>
            </div>

            <div class="form-group">
                <label class="col-form-label" for="comments">মন্তব্য</label>
                <textarea class="form-control" name="comments" id="comments" cols="30" rows="2"></textarea>
            </div>

            <div class="text-left mt-2">
                <a tabindex="0" href="javascript:;" role="button"
                   onclick="Air_Movement_Container.store()"
                   class="btn btn-primary btn-sm btn-square btn-forward" id="onucched_forward">
                    <i class="fa fa-paper-plane"></i>প্রেরণ করুন</a>
            </div>
        </form>
    </div>
</div>
<!--end::Table-->

<script>

    var Air_Movement_Container = {
        store: function () {
            url = '{{route('audit.final-report.submit-final-approval')}}';
            data = $('#approval_authority_form').serialize();
            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'success') {
                    toastr.success('{{___('generic.sent_successfully')}}');
                    $('#kt_quick_panel_close').click();
                    $(".load_approval_authority").hide();
                    $(".load_cag_approval_authority").hide();
                    $(".update-qac-air-report").hide();
                }
                else {
                    toastr.error(response.data.message);
                }
            })
        },
    };
</script>
