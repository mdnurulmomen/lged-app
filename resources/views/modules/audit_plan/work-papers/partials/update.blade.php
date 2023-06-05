
<form id="risk_rating_form">
    <div class="form-row">
        <div class="col-md-12 form-group">
            <label for="email">Select Plan:</label>
            <select class="form-control" id="audit_plan_id">
                <option value="" selected>Select Audit Plan</option>
                @foreach ($auditPlans as $auditPlan)
                    <option value="{{ $auditPlan['id'] }}" {{ ( $auditPlan['id'] == $planWorkPaper['audit_plan_id']) ? 'selected' : '' }}> 
                        {{ ($auditPlan['yearly_plan_location']['project_name_en'] ?? $auditPlan['yearly_plan_location']['function_name_en'] ?? $auditPlan['yearly_plan_location']['cost_center_en']).' (Plan-'.$auditPlan['id'].')' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-12 form-group">
            <label for="email">Title (Bangla):</label>
            <textarea placeholder="Query Title Bangla" class="form-control" type="text" id="title_bn">{{$planWorkPaper['title_bn']}}</textarea>
        </div>

        <div class="col-md-12 form-group">
            <label for="email">Title (English):</label>
            <textarea placeholder="Query Title English" class="form-control" type="text" id="title_en">{{$planWorkPaper['title_en']}}</textarea>
        </div>

        <div class="col-md-12 form-group">
            <label for="exampleFormControlFile1">WorkPapers</label>
            <input id="attachment" name="attachment" type="file" class="mFilerInit form-control rounded-0">
        </div>

        <div style="font-family:SolaimanLipi,serif !important; width: 100%;">
            <div class="attachment_list_items">
                <ul class="list-group">
                    @php
                        $attachment = $planWorkPaper['attachment'];
                        $fileExtension = strrchr($attachment, '.');
                        $fileName = basename($attachment);
                    @endphp

                    @if($fileExtension == 'pdf')
                        @php $fileIcon = 'fa-file-pdf'; @endphp
                    @elseif($fileExtension  == 'excel')
                        @php $fileIcon = 'fa-file-excel'; @endphp
                    @elseif($fileExtension  == 'docx')
                        @php $fileIcon = 'fa-file-word'; @endphp
                    @else
                        @php $fileIcon = 'fa-file-image'; @endphp
                    @endif

                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 rounded-0 border-left-0 border-right-0">
                        <div class="position-relative w-100 d-flex align-items-start">
                            <a target="_blank" href="{{ config('amms_bee_routes.file_url').$planWorkPaper['attachment'] }}" download class="d-inline-block text-dark‌‌">
                                <span class="viewer_trigger d-flex align-items-start">
                                    <i class="text-warning fas {{$fileIcon}} fa-lg px-3"></i>
                                    <span class="ml-2 d-flex align-items-start">{{$fileName}}</span>
                                </span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-12 pt-4 text-right">
            <button type="button" id="update_btn" class="btn btn-primary ml-auto">
            <i class="fal fa-save"></i>Update</button>
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

    $(function() {
        audit_plan_id = "{{$audit_plan_id}}";
        $('#audit_plan_id').val(audit_plan_id);
    });

    $('#update_btn').click(function () {

    var formData = new FormData();

    // console.log($('#audit_plan_id').find(':selected').val());
    audit_plan_id = $('#audit_plan_id').find(':selected').val();
    formData.append('audit_plan_id', $('#audit_plan_id').find(':selected').val());
    formData.append('work_paper_id', {{$work_paper_id}});
    formData.append('title_bn', $('#title_bn').val());
    formData.append('title_en', $('#title_en').val());

    if ($('#attachment')[0].files.length) {
        formData.append('attachment', $('#attachment')[0].files[0]);
    }

    // console.log(formData);

    url = "{{ route('audit.plan.individual.plan-work-papers.update') }}";
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
    
</script>