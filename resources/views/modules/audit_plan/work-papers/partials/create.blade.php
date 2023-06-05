<form id="risk_rating_form">
    <div class="form-row">
        <div class="col-md-12 form-group">
            <label for="email">Select Plan:</label>
            <select class="form-control" id="audit_plan_id">
                <option value="" selected>Select Audit Plan</option>
                @foreach ($auditPlans as $auditPlan)
                    <option value="{{ $auditPlan['id'] }}">
                        {{ ($auditPlan['yearly_plan_location']['project_name_en'] ?? $auditPlan['yearly_plan_location']['function_name_en'] ?? $auditPlan['yearly_plan_location']['cost_center_en']).' (Plan-'.$auditPlan['id'].')' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-12 form-group">
            <label for="email">Title (Bangla):</label>
            <textarea placeholder="Query Title Bangla" class="form-control" type="text" id="title_bn"></textarea>
        </div>

        <div class="col-md-12 form-group">
            <label for="email">Title (English):</label>
            <textarea placeholder="Query Title English" class="form-control" type="text" id="title_en"></textarea>
        </div>

        <div class="col-md-12 form-group">
            <label for="exampleFormControlFile1">Choose WorkPaper</label>
            <input id="attachment" name="attachment" type="file" class="mFilerInit form-control rounded-0">
        </div>

        <div class="col-md-12 pt-4">
            <button type="button" id="btn_modal_save" class="btn btn-primary ml-auto">Save</button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        $('.mFilerInit').filer({
            showThumbs: true,
            addMore: false,
            allowDuplicates: false
        });
    });

    $('#btn_modal_save').click(function () {

        var formData = new FormData();

        // console.log($('#audit_plan_id').find(':selected').val());
        audit_plan_id = $('#audit_plan_id').find(':selected').val();
        formData.append('audit_plan_id', $('#audit_plan_id').find(':selected').val());
        formData.append('title_bn', $('#title_bn').val());
        formData.append('title_en', $('#title_en').val());
        formData.append('attachment', $('#attachment').files);

        if ($('#attachment')[0].files.length) {
            formData.append('attachment', $('#attachment')[0].files[0]);
        }

        // console.log(formData);

        url = "{{ route('audit.plan.individual.plan-work-papers.store') }}";
        method = 'POST';

        loaderStart('Please wait...');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            async: true,
            type: 'POST',
            url: url,
            data: formData,
            cache: false,
            contentType: false,
            processData : false,
        })
        .done(function(response) {
            toastr.success(response.data);
            $("#kt_quick_panel_close").click();
            $("#filter_audit_plan_id").val(audit_plan_id).trigger('change');

        })
        .fail(function(response) {
            toastr.error(response.data)
        })
        .always(function() {
            loaderStop();
        });
    });

    var Risk_Assessment_Factor_Approach_Container = {
        backToList: function () {
            $('.working_paper_link  a').click();
        }
    }
</script>
