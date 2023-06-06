<style>
    .tox{
        z-index: 1060 !important;
    }
</style>
<form class="mb-10" autocomplete="off" id="office_orderedit_form">
    <input type="hidden" name="audit_plan_id" value="{{$office_order['audit_plan_id']}}">
    <input type="hidden" name="annual_plan_id" value="{{$office_order['annual_plan_id']}}">
    <input type="hidden" name="office_order_id" value="{{$office_order['id']}}">

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
                <textarea id="heading_details" class="kt-tinymce-summary" name="heading_details">{{$office_order['heading_details']}}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="advices">Tentative Scope of Audit Procedure:<span class="text-danger">*</span></label>
                <textarea class="kt-tinymce-summary" name="advices" id="advices" placeholder="Tentative Scope of Audit Procedure" cols="30" rows="2">{{$office_order['advices']}}</textarea>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="order_cc_list">Copy for kind information and necessary action:<span class="text-danger">*</span></label>
                <textarea class="kt-tinymce-summary" name="order_cc_list" id="order_cc_list" placeholder="Copy for kind information and necessary action" cols="30" rows="2">{{$office_order['order_cc_list']}}</textarea>
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
        <a href="javascript:;" role="button" onclick="Office_Order_Create_Container.updateOfficeOrder($(this))"
           class="btn btn-primary btn-sm btn-square btn-forward">
            <i class="fa fa-save"></i>
            Update
        </a>
    </div>
</form>
<script src="{{asset('assets/plugins/global/tinymce.min.js')}}" referrerpolicy="origin"></script>
<script>

    var Office_Order_Create_Container ={
        updateOfficeOrder: function (elem) {
            url = '{{route('audit.plan.audit.office-orders.update-office-order')}}';
            let audit_plan_id = $("input[name=audit_plan_id]").val();
            let annual_plan_id = $("input[name=annual_plan_id]").val();
            let office_order_id = $("input[name=office_order_id]").val();
            let memorandum_no = $("input[name=memorandum_no]").val();
            let memorandum_date = $("input[name=memorandum_date]").val();
            let heading_details = tinymce.get("heading_details").getContent();;
            let advices = tinymce.get("advices").getContent();;
            let order_cc_list = tinymce.get("order_cc_list").getContent();

            let data = {audit_plan_id, annual_plan_id, office_order_id, memorandum_no, memorandum_date, heading_details, advices, order_cc_list};

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

    $(document).ready(function () {
        EditorInit();
        $('.mFilerInit').filer({
            showThumbs: true,
            addMore: true,
            allowDuplicates: false
        });
    });

    tinymce.init({
        selector: '.kt-tinymce-1',
        menubar: false,
        min_height: 600,
        height: 600,
        max_height: 640,
        branding: false,
        content_style: "body {font-family: solaimanlipi;font-size: 13pt;}",
        fontsize_formats: "8pt 10pt 12pt 13pt 14pt 18pt 24pt 36pt",
        font_formats: "Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Oswald=oswald; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Times New Roman=times new roman,times; Verdana=verdana,geneva; Solaimanlipi=solaimanlipi",
        toolbar: ['styleselect fontselect fontsizeselect | blockquote subscript superscript',
            'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify | table',
            'bullist numlist | outdent indent | advlist | autolink | lists charmap | print preview |  code'],
        plugins: 'advlist paste autolink link image lists charmap print preview code table',
        context_menu: 'link image table',
        setup: function (editor) {
        },
    });

    function EditorInit() {
        tinymce.init({
            selector: '.kt-tinymce-summary',
            menubar: false,
            min_height: 600,
            height: 600,
            max_height: 640,
            branding: false,
            content_style: "body {font-family: solaimanlipi;font-size: 13pt;}",
            fontsize_formats: "8pt 10pt 12pt 13pt 14pt 18pt 24pt 36pt",
            font_formats: "Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Oswald=oswald; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Times New Roman=times new roman,times; Verdana=verdana,geneva; Solaimanlipi=solaimanlipi",
            toolbar: ['styleselect fontselect fontsizeselect | blockquote subscript superscript | undo redo | cut copy paste | bold italic | link image',
                'alignleft aligncenter alignright alignjustify | table | bullist numlist | outdent indent | advlist | autolink | lists charmap | print preview |  code'],
            plugins: 'advlist paste autolink link image lists charmap print preview code table',
            context_menu: 'link image table',
            setup: function (editor) {
                editor.on('change', function (inst) {
                    summary_editor = tinymce.get('kt-tinymce-summary').getContent();
                    $('#kt-tinymce-summary').val(summary_editor)
                });
            },
        });
    };
</script>
