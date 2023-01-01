<link rel="stylesheet" href="{{asset('assets/css/mFiler-font.css')}}" referrerpolicy="origin">
<link rel="stylesheet" href="{{asset('assets/css/mFiler.css')}}" referrerpolicy="origin">

<form class="mb-4" id="memo_create_form" enctype="multipart/form-data" autocomplete="off">
    <div class="card sna-card-border">
        <div class="row">
            <div class="col-md-9">
                <input type="hidden" name="cost_center_id" value="{{$cost_center_id}}">
                <input type="hidden" name="cost_center_name_bn" value="{{$cost_center_name_bn}}">
                <input type="hidden" name="cost_center_name_en" value="{{$cost_center_name_en}}">
                <input type="hidden" name="audit_plan_id" value="{{$audit_plan_id}}">
                <input type="hidden" name="audit_year_start" value="{{$audit_year_start}}">
                <input type="hidden" name="audit_year_end" value="{{$audit_year_end}}">
                <div class="d-flex justify-content-start">
                    <h4 class="mt-5">{{$cost_center_name_en}}
                        ({{$audit_year_start}}-{{$audit_year_end}})</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="d-flex justify-content-end">
                    <a onclick="Audit_Query_Schedule_Container.memo($(this))" data-schedule-id="{{$schedule_id}}"
                        data-team-id="{{$team_id}}" data-audit-plan-id="{{$audit_plan_id}}"
                        data-cost-center-id="{{$cost_center_id}}" data-cost-center-name-bn="{{$cost_center_name_bn}}"
                        data-cost-center-name-en="{{$cost_center_name_en}}"
                        data-audit-year-start="{{$audit_year_start}}" data-audit-year-end="{{$audit_year_end}}"
                        class="btn btn-sm btn-warning btn-back btn-square mr-3">
                        <!-- <i class="fad fa-arrow-alt-left"></i> {{___('generic.back')}} -->
                        <i class="fad fa-arrow-alt-left"></i> Go Back
                    </a>
                    <a id="memo_submit" class="btn btn-primary btn-sm btn-bold btn-square" href="javascript:;">
                        <!-- <i class="far fa-save mr-1"></i> {{___('generic.save')}} -->
                        <i class="far fa-save mr-1"></i> Save
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card sna-card-border mt-3 mb-3">
        <div>
            <!-- <ul class="nav nav-tabs custom-tabs mb-0" id="memoCreateTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active rounded-0" data-toggle="tab"
                       href="#memo_details">
                        <span class="nav-text">মেমো সম্পর্কিত তথ্য</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-0" data-toggle="tab"
                       href="#porisisto_tab">
                        <span class="nav-text">পরিশিষ্ট</span>
                    </a>
                </li>
            </ul> -->

            <input type="hidden" value="{{$schedule_id}}" name="schedule_id">
            <input type="hidden" value="{{$memo_id}}" name="memo_id">
            <div class="row mt-2">
                <div class="col-md-6">
                    <div class="card sna-card-border" style="padding: 15px;">
                        <label class="col-form-label">Issue No</label>
                        <textarea class="form-control mb-1" name="issue_no" placeholder="Issue No" cols="20"
                            rows="1" disabled>{{$issue_no}}</textarea>

                        <label class="col-form-label">Issue Title</label>
                        <textarea class="form-control mb-1" name="issue_title" placeholder="Issue Title" cols="20"
                            rows="1" disabled>{{$issue_title}}</textarea>

                        <label class="col-form-label">Audit Observation</label>
                        <div class="card sna-card-border">{!!$audit_observation!!}</div>

                        <label class="col-form-label">Criteria</label>
                        <div class="card sna-card-border">{!!$criteria!!}</div>

                        <label class="col-form-label">Consequence/Impact</label>
                        <textarea class="form-control mb-1" name="consequence" placeholder="Consequence/Impact" cols="20"
                            rows="1" disabled>{{$impact}}</textarea>

                        <div class="card sna-card-border mt-2">
                            <table class="table table-bordered" style="border: 1px solid black; margin-bottom: 0;">
                                @foreach ($causes as $key=>$cause)
                                        <tr>
                                            <td style="padding: 10px;">Cause {{$key+1}} :</td>
                                            <td style="padding: 10px;">{{$cause}}</td>
                                        </tr>
                                @endforeach
                            </table>
                            
                            <!-- <div class="col-md-1">
                                <span title="Add Cause"
                                    class="btn btn-outline-primary btn-sm btn-square btn_query_add">
                                    <i class="fal fa-plus"></i>
                                </span>
                            </div> -->
                        </div>
                    </div>

                    @if (!empty($attachment_list))
                    <div class="card sna-card-border mt-2">
                        <div style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
                            <label for="files">Files</label>
                            <div class="attachment_list_items mt-2">
                                <ul class="list-group">
                                    @foreach($attachment_list as $attachment)
                                        @if($attachment['file_extension'] == 'pdf')
                                            @php $fileIcon = 'fa-file-pdf'; @endphp
                                        @elseif($attachment['file_extension']  == 'excel')
                                            @php $fileIcon = 'fa-file-excel'; @endphp
                                        @elseif($attachment['file_extension']  == 'docx')
                                            @php $fileIcon = 'fa-file-word'; @endphp
                                        @else
                                            @php $fileIcon = 'fa-file-image'; @endphp
                                        @endif

                                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 rounded-0 border-left-0 border-right-0">
                                            <div class="position-relative w-100 d-flex align-items-start">
                                                <a title="" href="{{config('amms_bee_routes.file_url').$attachment['file_path'].$attachment['file_custom_name']}}" download class="d-inline-block text-dark‌‌">
                                                    <span class="viewer_trigger d-flex align-items-start">
                                                        <i class="text-warning fas {{$fileIcon}} fa-lg px-3"></i>
                                                        <span class="ml-2 d-flex align-items-start">{{$attachment['file_user_define_name']}}</span>
                                                    </span>
                                                </a>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="col-md-6">
                    <div class="card sna-card-border" style="padding: 15px;">
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <label class="col-form-label">Recommendation<span class="text-danger">*</span></label>
                                <textarea class="form-control mb-1" name="recommendation" placeholder="Recommendation" cols="20"
                                    rows="1">{{$recommendation}}</textarea>

                                <label class="col-form-label">Managemen's Response<span class="text-danger">*</span></label>
                                <textarea class="form-control mb-1" name="m_response" placeholder="Managemen's Response" cols="20"
                                    rows="1">{{$m_response}}</textarea>

                                <label class="col-form-label">Auditor's Comment<span class="text-danger">*</span></label>
                                <textarea class="form-control mb-1" name="auditor_comment" placeholder="Auditor's Comment" cols="20"
                                    rows="1">{{$comment}}</textarea>

                                <label class="col-form-label">Risk Level</label>
                                <textarea class="form-control mb-1" name="risk_level"
                                    placeholder="Risk Level" cols="20" rows="1" disabled>{{$risk_level}}</textarea>

                                <label class="col-form-label">Action Taken<span class="text-danger">*</span></label><br>
                                <input type="radio" id="yes" name="action_taken" value="yes" <?php echo ($action_taken=='yes') ? 'checked="checked"':'';?>>
                                    <label for="yes">Yes</label><br>
                                <input type="radio" id="no" name="action_taken" value="no" <?php echo ($action_taken=='no') ? 'checked="checked"':'';?>>
                                    <label for="no">No</label><br>

                                <label class="col-form-label">Responsible Person<span class="text-danger">*</span></label>
                                <textarea class="form-control mb-1" name="responsible_person"
                                    placeholder="Responsible Person" cols="20" rows="1">{{$responsible_person}}</textarea>

                                <label class="col-form-label">Date to be implemented<span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                style="color:#3699FF !important" class="fa fa-calendar"
                                                aria-hidden="true"></i></span></div>
                                    <input type="text" id="date_to_be_implemented" name="date_to_be_implemented"
                                        value="{{$date_to_be_implemented ? date('d/m/Y',strtotime($date_to_be_implemented)) : ''}}" class="date form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="tab-pane fade border border-top-0 p-3" id="porisisto_tab"
                     role="tabpanel" aria-labelledby="porisisto-tab">

                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">
                            পরিশিষ্টসমূহ
                            <button style="border-radius: 13px" title="যোগ করুন" type='button'
                                    class='btn btn-primary btn-sm btn-square'
                                    onclick="addPorisisto()">
                                <span class='fa fa-plus'></span>
                            </button>
                        </legend>

                        <table width="100%" style="border: none"
                               class="table table-bordered table-sm"
                               id="tblPorisistoList">
                            <tbody>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label style="font-size: 1.5em" class="col-form-label">পরিশিষ্ট ১</label>
                                        <textarea id="" class="porisisto_details "></textarea>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </fieldset>
                </div> -->
            </div>
        </div>
</form>

<script src="{{asset('assets/js/mFiler.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/global/tinymce.min.js')}}" referrerpolicy="origin"></script>
<script>
    //for submit form

    $(document).ready(function () {
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

    $('input[type=radio][name=agree_type]').on('change', function () {
        let value = $(this).val();
        if (value == 'agree' || value == 'disagree') {
            $('#agree_in_part_input').hide();
        } else {
            $('#agree_in_part_input').show();
        }
    });

    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#memo_submit').on('click', function (elem) {
            elem.preventDefault();
            formData = new FormData(document.getElementById("memo_create_form"));
            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            $.ajax({
                data: formData,
                url: "{{route('audit.execution.memo.update')}}",
                type: "POST",
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (responseData) {
                    KTApp.unblock('#kt_wrapper');
                    if (responseData.status === 'success') {
                        toastr.success(responseData.data);
                        $('.btn-back').click();
                    } else {
                        if (responseData.statusCode === '422') {
                            var errors = responseData.msg;
                            $.each(errors, function (k, v) {
                                if (v !== '') {
                                    toastr.error(v);
                                }
                            });
                        } else {
                            toastr.error(responseData.data);
                        }
                    }
                },
                error: function (data) {
                    KTApp.unblock('#kt_wrapper');
                    if (data.responseJSON.errors) {
                        $.each(data.responseJSON.errors, function (k, v) {
                            if (isArray(v)) {
                                $.each(v, function (n, m) {
                                    toastr.error(m)
                                    console.log(m, n, v);
                                })
                            } else {
                                if (v !== '') {
                                    toastr.error(v);
                                }
                            }
                        });
                    }
                }
            });
        });
    });

</script>
