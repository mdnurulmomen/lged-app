<form autocomplete="off" id="office_order_generate_form">
    <input type="hidden" name="audit_plan_id" value="0">
    <input type="hidden" name="annual_plan_id" value="{{$annual_plan_id}}">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="memorandum_no">স্মারক নং<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="memorandum_no" name="memorandum_no"
                       placeholder="স্মারক নং লিখুন"
                       value="{{empty($office_order)?'':$office_order['memorandum_no']}}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="memorandum_date">স্মারকলিপির তারিখ<span class="text-danger">*</span></label>
                <input class="form-control date" type="text" id="memorandum_date" name="memorandum_date"
                       placeholder="স্মারকলিপির তারিখ"
                       value="{{empty($office_order)?'':$office_order['memorandum_date']}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="heading_details">শিরোনাম<span class="text-danger">*</span></label>
                <textarea class="form-control" name="heading_details" id="heading_details" placeholder="শিরোনাম" cols="30" rows="2">{{empty($office_order)?'':$office_order['heading_details']}}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="advices">নির্দেশনা<span class="text-danger">*</span></label>
                <textarea class="form-control" name="advices" id="advices" placeholder="নির্দেশনা" cols="30" rows="2">{{empty($office_order)?'':$office_order['advices']}}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="order_cc_list">অনুলিপি<span class="text-danger">*</span></label>
                <textarea class="form-control" name="order_cc_list" id="order_cc_list" placeholder="অনুলিপি" cols="30" rows="2">{{empty($office_order)?'':$office_order['order_cc_list']}}</textarea>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <a href="javascript:;" role="button" onclick="Office_Order_Create_Container_Dc.generateOfficeOrder($(this))"
           class="btn btn-primary btn-sm btn-square btn-forward">
            <i class="fa fa-save"></i>
            {{empty($office_order)?'সংরক্ষন করুন':'হালনাগাদ করুন'}}
        </a>
    </div>
</form>

<script>
    var Office_Order_Create_Container_Dc ={
        generateOfficeOrder: function (elem) {
            url = '{{route('audit.plan.audit.office-orders-dc.generate-office-order')}}';
            data = $('#office_order_generate_form').serialize();
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'success') {
                    toastr.success('সফলভাবে অফিস আদেশ সংরক্ষন করা হয়েছে');
                    $('#kt_quick_panel_close').click();
                    $('.dc-office-order a').click();
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
        },
    };
</script>
