<style>
    .tox{
        z-index: 1060 !important;
    }
    .scroll.ps > .ps__rail-y > .ps__thumb-y {
        overflow-y: visible;
        background-color: black;
    }
</style>
<form  id="individual_plan_form" autocomplete="off">
    <input type="hidden" value="{{$data['audit_plan_id']}}" name="id">
    <input type="hidden" value="{{$data['yearly_plan_location_id']}}" name="yearly_plan_location_id">
    <input type="hidden" value="0" name="yearly_plan_id">

        <div class="block">
            <label>Audit Type<span class="text-danger">*</span> : </label>
            <input class="form_control ml-2" type="text" id="audit_type" value=" {{$individualPlanInfo ? $individualPlanInfo['audit_type'] : '' }}" name="audit_type">
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <label>Scope : </label>
                <textarea id="scope" class="kt-tinymce-summary" name="scope">
                    {!! $individualPlanInfo ? $individualPlanInfo['scope'] : '' !!}
                </textarea>
            </div>
            <div class="col-md-6">
                <label>Objectives : </label>
                <textarea id="objective" class="kt-tinymce-summary" name="objective">
                    {!! $individualPlanInfo ? $individualPlanInfo['objective'] : '' !!}
                </textarea>
            </div>
        </div>

        <div class="row mt-2">
        <div class="col-md-12">
            <table id="milestone-table" class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th width="30%">Particulars</th>
                    <th width="30%">Start Date</th>
                    <th width="30%">End Date</th>
                    <th width="10%">Action</th>
                </tr>
                </thead>
                <tbody>
                @if($individualPlanInfo && $individualPlanInfo['milestones'])
                    @foreach($individualPlanInfo['milestones'] as $milestone)
                        <tr class="milestone_row">
                            <td>
                                <input  type="text" class="form-control milestone_bn" value="{{$milestone['milestone_bn']}}">
                            </td>
                            <td>
                                <input  type="text" class="form-control start_date date" value="{{formatDate($milestone['start_date'],'en','/')}}">
                            </td>
                            <td>
                                <input  type="text" class="form-control end_date date" value="{{formatDate($milestone['end_date'],'en','/')}}">
                            </td>
                            <td>
                                <div style="display: flex">
                                    <button type="button" title="Add"
                                            onclick=""
                                            class="btn btn-icon btn-outline-warning border-0 btn-xs mr-2 add_row">
                                        <span class="fad fa-plus"></span>
                                    </button>

                                    <button type='button' title="Remove"
                                            data-row='row1'
                                            onclick=""
                                            class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2 delete_row'>
                                        <span class='fal fa-trash-alt'></span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                <tr class="milestone_row">
                    <td>
                        <input  type="text" class="form-control milestone_bn" value="">
                    </td>
                    <td>
                        <input  type="text" class="form-control start_date date" value="">
                    </td>
                    <td>
                        <input  type="text" class="form-control end_date date" value="">
                    </td>
                    <td>
                        <div style="display: flex">
                            <button type="button" title="Add"
                                    onclick=""
                                    class="btn btn-icon btn-outline-warning border-0 btn-xs mr-2 add_row">
                                <span class="fad fa-plus"></span>
                            </button>


                            <button type='button' title="Remove"
                                    data-row='row1'
                                    onclick=""
                                    class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2 delete_row'>
                                <span class='fal fa-trash-alt'></span>
                            </button>
                        </div>
                    </td>
                </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</form>

<button class="btn btn-sm btn-square btn-outline-primary float-right save-button" style="margin-bottom: 1cm;">
    <i class="fa fa-save"></i> Save
</button>

<script src="{{asset('assets/plugins/global/tinymce.min.js')}}" referrerpolicy="origin"></script>
<script>
    $(".save-button").on('click', function(event){

        loaderStart('Please wait...');

        milestone_list = {};

        $('.milestone_row').each(function (j, w) {
            if($(this).find('.milestone_bn').val()){
                milestone_list[j] = {};
                milestone_list[j]['milestone_bn'] = $(this).find('.milestone_bn').val();
                milestone_list[j]['start_date'] = formatDate($(this).find('.start_date').val());
                milestone_list[j]['end_date'] = formatDate($(this).find('.end_date').val());
            }
        });


            let id = $("input[name=id]").val();
            let yearly_plan_id = $("input[name=yearly_plan_id]").val();
            let yearly_plan_location_id = $("input[name=yearly_plan_location_id]").val();
            let scope = tinymce.get("scope").getContent();
            let objective = tinymce.get("objective").getContent();
            let audit_type = $("input[name=audit_type]").val();

            let data = {id, scope, objective, yearly_plan_id, yearly_plan_location_id, milestone_list, audit_type};

            url = "{{route('audit.plan.individual.store')}}";

            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                loaderStop();
                if (response.status == 'error') {
                    toastr.error(response.data)
                } else {
                    toastr.success(response.data);
                    $('#kt_quick_panel_close').click();
                    $('#strategic_plan_year').trigger('change');
                }
            });
    });

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

    $("#milestone-table").on("click", ".add_row", function() {
        $('#milestone-table > tbody:last').append(
            `<tr class="milestone_row">
                    <td>
                        <input type="text" class="form-control milestone_bn" value="">
                    </td>
                    <td>
                        <input type="text" class="form-control start_date date" value="">
                    </td>
                    <td>
                        <input type="text" class="form-control end_date date" value="">
                    </td>
                    <td>
                        <div style="display: flex">
                            <button type="button" title="Add"
                                    class="btn btn-icon btn-outline-warning border-0 btn-xs mr-2 add_row">
                                <span class="fad fa-plus"></span>
                            </button>

                            <button type='button' title="Remove"
                                    data-row='row1'
                                    class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2 delete_row'>
                                <span class='fal fa-trash-alt'></span>
                            </button>
                        </div>
                    </td>
                </tr>`
        );
        $("#milestone-table").on("click", ".delete_row", function() {
            $(this).closest("tr").remove();
        });
    });

    $("#milestone-table").on("click", ".delete_row", function() {
        $(this).closest("tr").remove();
    });
</script>
