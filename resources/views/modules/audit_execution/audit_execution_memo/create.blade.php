<link rel="stylesheet" href="{{asset('assets/css/mFiler-font.css')}}" referrerpolicy="origin">
<link rel="stylesheet" href="{{asset('assets/css/mFiler.css')}}" referrerpolicy="origin">

<form class="mb-4" id="memo_create_form" enctype="multipart/form-data" autocomplete="off">
    <div class="card sna-card-border">
        <div class="row">
            <div class="col-md-8">
                <div class="d-flex justify-content-start">
                    <h5 class="mt-5">{{$cost_center_name_bn}} (অর্থবছর : ২০২১-২০২২)</h5>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex justify-content-end">
                    <a
                        onclick="Audit_Query_Schedule_Container.memo($(this))"
                        data-schedule-id="{{$schedule_id}}"
                        data-audit-plan-id="{{$audit_plan_id}}"
                        data-cost-center-id="{{$cost_center_id}}"
                        data-cost-center-name-bn="{{$cost_center_name_bn}}"
                        data-audit-year-start="{{$audit_year_start}}"
                        data-audit-year-end="{{$audit_year_end}}"
                        data-team-leader-name-bn="{{$team_leader_name}}"
                        data-team-leader-designation-name-bn="{{$team_leader_designation_name}}"
                        data-scope-sub-team-leader="{{$scope_sub_team_leader}}"
                        data-sub-team-leader-name-bn="{{$sub_team_leader_name}}"
                        data-sub-team-leader-designation-name-bn="{{$sub_team_leader_designation_name}}"
                        class="btn btn-sm btn-warning btn_back btn-square mr-3">
                        <i class="fad fa-arrow-alt-left"></i> {{___('generic.back')}}
                    </a>
                    <a id="memo_submit" class="btn btn-primary btn-sm btn-bold btn-square"
                       href="javascript:;">
                        <i class="far fa-save mr-1"></i> {{___('generic.save')}}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card sna-card-border mt-3 mb-3">
        <div class="mt-4">
            <ul class="nav nav-tabs custom-tabs mb-0" id="memoCreateTab" role="tablist">
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
            </ul>
            <div class="tab-content" id="memo_create_tab">
                <div class="tab-pane fade border border-top-0 p-3 show active" id="memo_details"
                     role="tabpanel" aria-labelledby="memo-details-tab">

                    <input type="hidden" value="{{$schedule_id}}" name="schedule_id">
                    <div class="row mt-2">
                        <div class="col-md-7">
                            <div class="card sna-card-border">
                                <label class="col-form-label">শিরোনাম<span class="text-danger">*</span></label>
                                <textarea class="form-control mb-1" name="memo_title_bn" placeholder="শিরোনাম লিখুন" cols="30"
                                          rows="2"></textarea>

                                <label class="col-form-label">বিবরণ<span class="text-danger">*</span></label>
                                <textarea id="kt-tinymce-memo-details" class="kt-tinymce-1"></textarea>

                                <label class="col-form-label">অনিয়মের কারণ</label>
                                <textarea class="form-control mb-1" name="irregularity_cause" placeholder="অনিয়মের কারণ"
                                          cols="30" rows="2"></textarea>


                                <label class="col-form-label">অডিটি প্রতিষ্ঠানের জবাব</label>
                                <textarea class="form-control mb-1" name="response_of_rpu" placeholder="অডিটি প্রতিষ্ঠানের জবাব"
                                          cols="30" rows="2"></textarea>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="card sna-card-border mb-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input class="form-control bangla-number-input amount_number_format mb-1"
                                               name="jorito_ortho_poriman" placeholder="জড়িত অর্থ (টাকা)" type="text">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span
                                                    class="input-group-text">নিরীক্ষা বছর শুরু</span>
                                            </div>
                                            <input class="form-control" name="audit_year_start"
                                                   value="{{$audit_year_start}}"
                                                   placeholder="নিরীক্ষাধীন অর্থ বছর শুরু" type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span
                                                    class="input-group-text">নিরীক্ষা বছর শেষ</span>
                                            </div>
                                            <input class="form-control" name="audit_year_end"
                                                   value="{{$audit_year_end}}"
                                                   placeholder="নিরীক্ষাধীন অর্থ বছর শেষ" type="text" readonly>
                                        </div>
                                    </div>
                                </div>

                                <select class="form-control select-select2" name="memo_irregularity_type">
                                    <option value="0">আপত্তি অনিয়মের ধরন বাছাই করুন</option>
                                    <option value="1">আত্মসাত, চুরি, প্রতারণা ও জালিয়াতিমূলক</option>
                                    <option value="2">সরকারের আর্থিক ক্ষতি</option>
                                    <option value="3">বিধি ও পদ্ধতিগত অনিয়ম</option>
                                    <option value="4">বিশেষ ধরনের আপত্তি</option>
                                </select>

                                <select class="form-control select-select2" name="memo_irregularity_sub_type">
                                    <option value="0">আপত্তি অনিয়মের সাব-ধরন বাছাই করুন</option>
                                    <option value="1">ভ্যাট-আইটিসহ সরকারি প্রাপ্য আদায় না করা</option>
                                    <option value="2">কম আদায় করা</option>
                                    <option value="3">আদায় করা সত্ত্বেও কোষাগারে জমা না করা</option>
                                    <option value="4">বাজার দর অপেক্ষা উচ্চমূল্যে ক্রয় কার্য সম্পাদন</option>
                                    <option value="5">রেসপন্সিভ সর্বনিম্ন দরদাতার স্থলে উচ্চ দরদাতার নিকট থেকে কার্য/পণ্য/সেবা
                                        ক্রয়
                                    </option>
                                    <option value="6">প্রকল্প শেষে অব্যয়িত অর্থ ফেরত না দেওয়া</option>
                                    <option value="7">ভুল বেতন নির্ধারণীর মাধ্যমে অতিরিক্ত বেতন উত্তোলন</option>
                                    <option value="8">প্রাপ্যতাবিহীন ভাতা উত্তোলন</option>
                                    <option value="9">জাতীয় অন্যান্য সরকারী অর্থের ক্ষতি সংক্রান্ত আপত্তি।</option>
                                </select>
                            </div>

                            <div class="card sna-card-border mb-4">
                                <label class="col-form-label">পরিশিষ্ট সংযুক্তি</label>
                                <input name="porisishtos[]" type="file" class="mFilerInit form-control rounded-0" multiple>

                                <label class="col-form-label">প্রমানক সংযুক্তি</label>
                                <input name="pramanoks[]" type="file" class="mFilerInit form-control rounded-0" multiple>
                            </div>

                            <div class="card sna-card-border mb-4">
                                <input type="hidden" name="issued_by"
                                       value="{{$scope_sub_team_leader > 0?'sub_team_leader':'team_leader'}}">

                                <label class="col-form-label">দলনেতা</label>
                                <input type="text" class="form-control mb-1" placeholder="দলনেতা" readonly
                                       value="{{$team_leader_name.' ('.$team_leader_designation_name.')'}}">
                                <input type="hidden" name="team_leader_name" value="{{$team_leader_name}}">
                                <input type="hidden" name="team_leader_designation" value="{{$team_leader_designation_name}}">

                                <label class="col-form-label">উপদলনেতা</label>
                                <input type="text" class="form-control mb-1" placeholder="উপদলনেতা" readonly
                                       value="{{$scope_sub_team_leader > 0?$sub_team_leader_name.' ('.$sub_team_leader_designation_name.')':''}}">
                                <input type="hidden" name="sub_team_leader_name"
                                       value="{{$scope_sub_team_leader > 0?$sub_team_leader_name:''}}">
                                <input type="hidden" name="sub_team_leader_designation"
                                       value="{{$scope_sub_team_leader > 0?$sub_team_leader_designation_name:''}}">
                            </div>

                            <div class="card sna-card-border mb-4 d-none">
                                <label class="col-form-label">প্রতিষ্ঠান প্রধানের নাম</label>
                                <input type="text" class="form-control mb-1" name="rpu_acceptor_officer_name_bn"
                                       placeholder="প্রতিষ্ঠান প্রধানের নাম">

                                <label class="col-form-label">প্রতিষ্ঠান প্রধানের পদবী</label>
                                <input type="text" class="form-control mb-1" name="rpu_acceptor_designation_name_bn"
                                       placeholder="প্রতিষ্ঠান প্রধানের পদবী">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade border border-top-0 p-3" id="porisisto_tab"
                     role="tabpanel" aria-labelledby="porisisto-tab">

                    <label class="col-form-label">পরিশিষ্ট</label>
                    <textarea id="kt-tinymce-porisisto" class="kt-tinymce-1"></textarea>

                </div>
            </div>
        </div>
    </div>
</form>

<script src="{{asset('assets/js/mFiler.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/global/tinymce.min.js')}}" referrerpolicy="origin"></script>
<script>
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
        min_height: 400,
        height: 400,
        max_height: 400,
        branding: false,
        content_style: "body {font-family: solaimanlipi;font-size: 13pt;}",
        fontsize_formats: "8pt 10pt 12pt 13pt 14pt 18pt 24pt 36pt",
        font_formats: "Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Oswald=oswald; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Times New Roman=times new roman,times; Verdana=verdana,geneva; Solaimanlipi=solaimanlipi",
        toolbar: ['styleselect fontselect fontsizeselect | blockquote subscript superscript | undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify',
            'table | bullist numlist | outdent indent | advlist | autolink | lists charmap | print preview |  code'],
        plugins: 'advlist paste autolink link image lists charmap print preview code table',
        context_menu: 'link image table',
        setup: function (editor) {
        },
    });
    setContentType('.kt-tinymce-1')


    //for submit form
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#memo_submit').on('click', function (e) {
            e.preventDefault();

            from_data = new FormData(document.getElementById("memo_create_form"));
            from_data.append('memo_description_bn', tinymce.get("kt-tinymce-memo-details").getContent());
            from_data.append('porisisto_details', tinymce.get("kt-tinymce-porisisto").getContent());

            elem = $(this);
            elem.prop('disabled', true);

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            $.ajax({
                data: from_data,
                url: "{{route('audit.execution.memo.store')}}",
                type: "POST",
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (responseData) {
                    KTApp.unblock('#kt_content');
                    if (responseData.status === 'success') {
                        toastr.success(responseData.data);
                        $('.btn_back').click();
                    } else {
                        elem.prop('disabled', false);
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
                    KTApp.unblock('#kt_content');
                    elem.prop('disabled', false)
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
