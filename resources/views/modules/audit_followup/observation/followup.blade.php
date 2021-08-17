<x-title-wrapper-return area="#kt_content" title="Back To Lists"
                        url="{{route('audit.followup.observation.lists')}}">
    Follow UP Objection
</x-title-wrapper-return>
<div class="mt-4 px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <form id="objection_followup">
                        <input type="hidden" name="observation_id" value="{{$data['id']}}">
                        <div class="row">

                            <div class="col-md-6">
                                <label for="parent_office_id" class="col-form-label">Parent office</label>
                                <select class="form-control rounded-0 select-select2" id="parent_office_id"
                                    name="parent_office_id" aria-hidden="true">
                                    <option value="">Select</option>
                                    <option value="1">Office 1</option>
                                    <option value="2">Office 2</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="rp_office_id" class="col-form-label">RP office</label>
                                <select class="form-control rounded-0 select-select2" id="rp_office_id"
                                    name="rp_office_id" aria-hidden="true">
                                    <option value="">Select</option>
                                    <option value="1">Office 1</option>
                                    <option value="2">Office 2</option>
                                    <option value="3">Office 3</option>
                                    <option value="4">Office 4</option>
                                </select>
                            </div>


                            <div class="col-md-6">
                                <label for="sent_to" class="col-form-label">Sent to</label>
                                <select class="form-control rounded-0 select-select2" id="sent_to"
                                    name="sent_to" aria-hidden="true">
                                    <option value="" disabled>Select</option>
                                    <option value="1">Member 1</option>
                                    <option value="2">Member 2</option>
                                </select>
                            </div>


                            <div class="col-md-6">
                                <label for="cc" class="col-form-label">Add CC</label>
                                <select class="form-control rounded-0 multiple_select" id="cc"
                                    name="cc[]" aria-hidden="true" multiple="multiple">
                                    <option value="" disabled>Select</option>
                                    <option value="1">Member 1</option>
                                    <option value="2">Member 2</option>
                                    <option value="3">Member 3</option>
                                    <option value="4">Member 4</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Title
                                        :</label>
                                        <input type="text" name="message_title" class="form-control rounded-0" placeholder="" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Details
                                        :</label>
                                        <textarea name="message_body" id="editor"></textarea>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h3>Attachments</h3> <small> (max size: 10MB, format: jpeg,jpg,png,gif,pdf,doc,docx)</small>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Select file:</label>
                                            <input class="file" type="file" name="attachments">
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>
                                </div>
                            
                            </div>
                        </div>

                        <div class="" style="padding: 3rem 0.25rem;">
                            <div class="d-flex align-items-center">
                                <button type="button" id="submit_form" class="btn-primary btn btn-square">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




</div>

<script>
$(document).ready(function() {
    $('#editor').summernote({
        height: 150,
        tabsize: 2
    });

    $(".multiple_select").select2({
        tags: true
    });

	$('.file').filer({
		showThumbs: true,
		addMore: true,
		allowDuplicates: false,
        extensions: ["jpg", "png", "gif", "jepg", "pdf", "docx", "doc"],
	});

    // $("#rp_office_id").change(function() {
    //     let fiscal_year_id = $('#fiscal_year_id').val();

    //     if(fiscal_year_id != "") {
    //         url = '{{route('audit.followup.observation.get.audit.plan')}}';
    //         let data = {
    //             rp_office_id: $(this).val(),
    //             fiscal_year_id: fiscal_year_id
    //         };
    //         ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
    //             console.log(response);
    //         });
    //     }

    // });


});

$('#submit_form').click(function () {

    $.ajax({
        url: "{{route('audit.followup.observation.follow-up.sent')}}", 
        type: "POST",             
        data: new FormData($('#objection_followup')[0]),
        contentType: false,       
        cache: false,             
        processData:false, 
        success: function(data) {
            toastr.success(data.data);
            url = '{{route('audit.followup.observation.lists')}}';
            data = {};
            ajaxCallAsyncCallbackAPI(url, {}, 'GET', function (response) {
                $('#kt_content').html(response);
            })
        },
        error: function (data) {
            if (data.responseJSON.errors) {
                $.each(data.responseJSON.errors, function (k, v) {
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
        },
    });

});

</script>