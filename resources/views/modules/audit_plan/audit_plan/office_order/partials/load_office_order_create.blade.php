<form class="mb-10" autocomplete="off" id="office_order_generate_form">
    <input type="hidden" name="audit_plan_id" value="{{$audit_plan_id}}">
    <input type="hidden" name="annual_plan_id" value="{{$annual_plan_id}}">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="memorandum_no">Memo No<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="memorandum_no" name="memorandum_no"
                       placeholder="Enter Memo No"
                       value="{{empty($office_order)?'':$office_order['memorandum_no']}}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="memorandum_date">Date<span class="text-danger">*</span></label>
                <input class="form-control date" type="text" id="memorandum_date" name="memorandum_date"
                       placeholder="Date"
                       value="{{empty($office_order)?'':$office_order['memorandum_date']}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="heading_details">Heading Details<span class="text-danger">*</span></label>
                <textarea class="form-control" name="heading_details" id="heading_details" placeholder="Heading Details" cols="30" rows="2">{{empty($office_order)?'':$office_order['heading_details']}}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="advices">Tentative Scope of Audit Procedure:<span class="text-danger">*</span></label>
                <textarea class="form-control" name="advices" id="advices" placeholder="Tentative Scope of Audit Procedure:" cols="30" rows="2">{{empty($office_order)?'':$office_order['advices']}}</textarea>
            </div>
        </div>
    </div>

    <!-- <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="memorandum_no">স্মারক নং<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="memorandum_no_2" name="memorandum_no_2"
                       placeholder="স্মারক নং লিখুন"
                       value="{{empty($office_order)?'':$office_order['memorandum_no_2']}}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="memorandum_date">স্মারকলিপির তারিখ<span class="text-danger">*</span></label>
                <input class="form-control date" type="text" id="memorandum_date_2" name="memorandum_date_2"
                       placeholder="স্মারকলিপির তারিখ"
                       value="{{empty($office_order)?'':formatDate($office_order['memorandum_date_2'])}}">
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

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="issuer_details">ইস্যুকারী<span class="text-danger">*</span></label>
                <textarea class="form-control" name="issuer_details" id="issuer_details" placeholder="ইস্যুকারী" cols="40" rows="2">{{empty($office_order)?'':$office_order['issuer_details']}}</textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="cc_sender_details">দায়িত্বপ্রাপ্ত কর্মকর্তার<span class="text-danger">*</span></label>
                <textarea class="form-control" name="cc_sender_details" id="cc_sender_details" placeholder="দায়িত্বপ্রাপ্ত কর্মকর্তার" cols="40" rows="2">{{empty($office_order)?'':$office_order['cc_sender_details']}}</textarea>
            </div>
        </div>
    </div> -->

    <div class="d-flex justify-content-end">
        <a href="javascript:;" role="button" onclick="Office_Order_Create_Container.generateOfficeOrder($(this))"
           class="btn btn-primary btn-sm btn-square btn-forward">
            <i class="fa fa-save"></i>
            Save
        </a>
    </div>
</form>

<script>
    var Office_Order_Create_Container ={
        generateOfficeOrder: function (elem) {
            url = '{{route('audit.plan.audit.office-orders.generate-office-order')}}';
            data = $('#office_order_generate_form').serialize();

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                message: 'Saving Please Wait...',
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'success') {
                    toastr.success('Office Order Saved Successfully');
                    $('#kt_quick_panel_close').click();
                    Office_Order_Container.loadOfficeOrderList();
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
