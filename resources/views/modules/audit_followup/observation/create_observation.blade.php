<x-title-wrapper-return area="#kt_content" title="Back To Lists"
                        url="{{route('audit.followup.observation.lists')}}">
    Create Objection
</x-title-wrapper-return>
<div class="mt-4 px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <form id="objection_create">
                        <div class="row">

                            <div class="col-md-3">
                                <label for="ministry_id" class="col-form-label">Ministry</label>
                                <select class="form-control rounded-0 select-select2" id="ministry_id"
                                    name="ministry_id" aria-hidden="true">
                                    <option value="">Select</option>
                                    <option value="1">পরিকল্পনা মন্ত্রণালয়</option>
                                    <option value="2">পররাষ্ট্র মন্ত্রণালয়</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="division_id" class="col-form-label">Division</label>
                                <select class="form-control rounded-0 select-select2" id="division_id"
                                    name="division_id" aria-hidden="true">
                                    <option value="">Select</option>
                                    <option value="1">Dhaka</option>
                                    <option value="2">Chittagong</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="parent_office_id" class="col-form-label">Parent office</label>
                                <select class="form-control rounded-0 select-select2" id="parent_office_id"
                                    name="parent_office_id" aria-hidden="true">
                                    <option value="">Select</option>
                                    <option value="1">Office 1</option>
                                    <option value="2">Office 2</option>
                                </select>
                            </div>

                            <div class="col-md-3">
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

                            <div class="col-md-3">
                                <label for="fiscal_year_id" class="col-form-label">Fiscal year</label>
                                <select class="form-control rounded-0 select-select2" id="fiscal_year_id"
                                    name="fiscal_year_id" aria-hidden="true">
                                    <option value="">Select</option>
                                    @foreach($fiscal_years as $fiscal_year)
                                        <option value="{{$fiscal_year['id']}}">{{$fiscal_year['description']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="audit_id" class="col-form-label">Audit plan</label>
                                <select class="form-control rounded-0 select-select2" id="audit_id"
                                    name="audit_id" aria-hidden="true">
                                    <option value="">Select</option>
                                    <option value="1">Plan 1</option>
                                    <option value="2">Plan 2</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="team_leader_id" class="col-form-label">Team leader</label>
                                <select class="form-control rounded-0 select-select2" id="team_leader_id"
                                    name="team_leader_id" aria-hidden="true">
                                    <option value="">Select</option>
                                    <option value="1">Member 1</option>
                                    <option value="2">Member 2</option>
                                </select>
                            </div>


                            

                            <div class="col-md-3">
                                <label for="observation_type" class="col-form-label">Observation type</label>
                                <select class="form-control rounded-0 select-select2" id="observation_type"
                                    name="observation_type" aria-hidden="true">
                                    <option value="">Select type</option>
                                    <option value="SFI">SFI</option>
                                    <option value="NON-SFI">NON-SFI</option>
                                </select>
                            </div>




                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Observation title english
                                        :</label>
                                        <input type="text" name="observation_en" class="form-control rounded-0" placeholder="" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Observation title bangla
                                        :</label>
                                        <input type="text"  name="observation_bn" class="form-control rounded-0" placeholder="" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Observation details
                                        :</label>
                                        <textarea name="observation_details" id="editor"></textarea>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Amount
                                        :</label>
                                        <input type="text" name="amount" class="form-control rounded-0" placeholder="" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Initiation date
                                        :</label>
                                        <input type="date"  name="initiation_date" class="form-control rounded-0" placeholder="" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="status" class="col-form-label">Status:</label>
                                    <input style="width:20%; height: 16px;"  name="status" class="form-check-input form-control" type="checkbox">
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
                                            <label for="" class="col-form-label">Cover Page:</label>
                                            <input class="file" type="file" name="cover_page">
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Main Observation Attachment:</label>
                                            <input class="main_attachments" type="file" name="main_attachments[]" multiple>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Appendix Attachment:</label>
                                            <input class="appendix_attachments" type="file" name="appendix_attachments[]" multiple>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Authentic attachment:</label>
                                            <input class="authentic_attachments" type="file" name="authentic_attachments[]" multiple>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Other Observation Attachment:</label>
                                            <input class="other_attachments" type="file" name="other_attachments[]" multiple>
                                        </div>
                                    </div>
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

	$('.file').filer({
		showThumbs: true,
		addMore: false,
		allowDuplicates: false,
        extensions: ["jpg", "png", "gif", "jepg", "pdf", "docx", "doc"],
	});

	$('.main_attachments').filer({
		showThumbs: true,
		addMore: true,
		allowDuplicates: false,
        extensions: ["jpg", "png", "gif", "jepg", "pdf", "docx", "doc"],
	});

	$('.appendix_attachments').filer({
		showThumbs: true,
		addMore: true,
		allowDuplicates: false,
        extensions: ["jpg", "png", "gif", "jepg", "pdf", "docx", "doc"],
	});
	$('.authentic_attachments').filer({
		showThumbs: true,
		addMore: true,
		allowDuplicates: false,
        extensions: ["jpg", "png", "gif", "jepg", "pdf", "docx", "doc"],
	});
	$('.other_attachments').filer({
		showThumbs: true,
		addMore: true,
		allowDuplicates: false,
        extensions: ["jpg", "png", "gif", "jepg", "pdf", "docx", "doc"],
	});

    $("#rp_office_id").change(function() {
        let fiscal_year_id = $('#fiscal_year_id').val();

        if(fiscal_year_id != "") {
            url = '{{route('audit.followup.observation.get.audit.plan')}}';
            let data = {
                rp_office_id: $(this).val(),
                fiscal_year_id: fiscal_year_id
            };
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                console.log(response);
            });
        }

    });

    $("#fiscal_year_id").change(function() {
        let rp_office_id = $('#rp_office_id').val();

        if(rp_office_id != "") {
            url = '{{route('audit.followup.observation.get.audit.plan')}}';
            let data = {
                rp_office_id: rp_office_id,
                fiscal_year_id: $(this).val()
            };
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                console.log(response);
            });
        }

    });


});

$('#submit_form').click(function () {

    $.ajax({
        url: "{{route('audit.followup.observation.store')}}", 
        type: "POST",             
        data: new FormData($('#objection_create')[0]),
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



