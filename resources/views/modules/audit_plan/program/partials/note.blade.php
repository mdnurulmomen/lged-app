
<style>
    .tox{
        z-index: 1060 !important;
    }
</style>

<div class="row">
    <div class="col-sm-7 form-group">
        <label for="note">Note : </label>
        <textarea class="kt-tinymce-summary" id="note" name="note"></textarea>
    </div>
    <div class="col-sm-5 form-group">
        <div>
            <label for="done-by">Done By : </label>
            <select class="form-select select-select2" id="team_member_officer_id" name="team_member_officer_id">
                <option value="">-- Select --</option>
                @foreach($team_members as $member)
                    <option value="{{json_encode($member)}}">{{$member['team_member_name_bn']}}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-5">
            <label for="done-by">W/P Reference : </label>
            <select class="form-select select-select2" id="workpaper_id" name="workpaper_id">
                <option value="">-- Select --</option>
                @foreach($working_plan_list as $workpaper)
                    <option value="{{$workpaper['id']}}">{{$workpaper['title_en']}}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-sm btn-square btn-primary mt-5" data-id={{$id}} onclick='Audit_Program_Container.edit($(this))'
            id="note_submit" style="float: right;">
            <i class="fa fa-save"></i> Save
        </button>
    </div>
</div>

<script src="{{asset('assets/plugins/global/tinymce.min.js')}}" referrerpolicy="origin"></script>
<script>

    $(document).ready(function () {
        EditorInit();
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
</script>