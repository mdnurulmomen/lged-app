<!-- Office Order Generate Modal -->
<div class="modal fade" id="officeOrderGenerateModal" tabindex="-1" role="dialog"
     aria-labelledby="officeOrderGenerateModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="officeOrderGenerateModalLabel">Office Order Generate</h5>
            </div>
            <div class="modal-body">
                <form id="office_order_generate_form">
                    <input type="hidden" name="audit_plan_id" value="{{$audit_plan_id}}">
                    <input type="hidden" name="annual_plan_id" value="{{$annual_plan_id}}">
                    <input type="hidden" name="schedule_id" value="{{$schedule_id}}">
                    <input type="hidden" name="activity_id" value="{{$activity_id}}">
                    <input type="hidden" name="milestone_id" value="{{$milestone_id}}">
                    <input type="hidden" name="fiscal_year_id" value="{{$fiscal_year_id}}">
                    <input type="hidden" name="officer_id" value="{{$officer_id}}">
                    <input type="hidden" name="officer_name_en" value="{{$officer_name_en}}">
                    <input type="hidden" name="officer_name_bn" value="{{$officer_name_bn}}">
                    <input type="hidden" name="designation_id" value="{{$designation_id}}">
                    <input type="hidden" name="designation_name_en" value="{{$designation_name_en}}">
                    <input type="hidden" name="designation_name_bn" value="{{$designation_name_bn}}">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="memorandum_no">স্মারক নং<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="memorandum_no" name="memorandum_no">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="memorandum_date">স্মারকলিপির তারিখ<span class="text-danger">*</span></label>
                                <input class="form-control date" type="text" id="memorandum_date" name="memorandum_date">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="heading_details">শিরোনাম বিবরণ<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="heading_details" id="heading_details" cols="30" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="advices">নির্দেশনা<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="advices" id="advices" cols="30" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="order_cc_list">অনুলিপি<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="order_cc_list" id="order_cc_list" cols="30" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="Office_Order_Container.generateOfficeOrder($(this))">Generate</button>
            </div>
        </div>
    </div>
</div>

<script>
    /*tinymce.init({
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
            editor.on('init change blur', function (e) {
                checkIdAndSetContentTinyMce(e)
            });
        },
    });*/
</script>
