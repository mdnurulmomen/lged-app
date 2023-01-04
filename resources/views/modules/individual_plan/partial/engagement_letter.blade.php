<style>
    .tox{
        z-index: 1060 !important;
    }
</style>
<form id="engagement_letter_form">
    <div class="form-row">

        <div class="col-md-12 form-group">
            <label for="to">To:</label>
            <textarea placeholder="Letter to" class="form-control" type="text" id="letter_to" rows="1"></textarea>
        </div>

        <div class="col-md-12 form-group">
            <label for="subject">Subject:</label>
            <textarea placeholder="Subject of the letter" class="form-control" type="text" id="subject"></textarea>
        </div>
        
        <div class="col-md-12 form-group">
            <label for="body">Body:</label>
            <textarea placeholder="Body of the letter" class="form-control" type="text" id="body"></textarea>
        </div>

        <div class="col-md-12 form-group">
            <label for="email">Others:</label>
            <textarea id="others" class="kt-tinymce-summary" name="others"></textarea>
        </div>

        <div class="col-md-12" style="text-align: right;">
            <button type="button" id="btn_modal_save" class="btn btn-primary ml-auto">Save</button>
        </div>
    </div>
</form>

<script src="{{asset('assets/plugins/global/tinymce.min.js')}}" referrerpolicy="origin"></script>

<script>

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
    }

    $("#btn_modal_save").on('click', function(event){

    loaderStart('Please wait...');

    let audit_plan_id = "{{$data['audit_plan_id']}}";
    let yearly_plan_location_id = "{{$data['yearly_plan_location_id']}}";
    let letter_to = $('#letter_to').val();
    let subject = $('#subject').val();
    let body = $('#body').val();
    let others = tinymce.get("others").getContent();

    let data = {audit_plan_id, yearly_plan_location_id, letter_to, subject, body, others};

    url = "{{route('audit.plan.individual.engagement-letter-store')}}";

    ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
        loaderStop();
        if (response.status == 'error') {
            toastr.error(response.data)
        } else {
            toastr.success(response.data);
            $('#kt_quick_panel_close').click();
        }
    });
});
</script>