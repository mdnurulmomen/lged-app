<form id="memo_create_form" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12 ml-5">
            <button id="memo_submit"  class="btn btn-sm btn-square btn-primary btn-hover-success">
                Save <i class="fas fa-save"></i>
            </button>
        </div>

        <input type="hidden" value="{{$schedule_id}}" name="schedule_id">

        <div class="card-body pt-0 pb-3">
            <div class="row">
                <div class="col-md-7 p-3">
                    <textarea class="form-control mb-1" name="memo_title_bn" placeholder="আপত্তি শিরোনাম লিখুন" cols="30" rows="2"></textarea>

                    <textarea id="kt-tinymce-1" name="memo_description_bn" class="kt-tinymce-1"></textarea>

                    <textarea class="form-control mb-1" name="response_of_rpu" placeholder="নিরীক্ষিত অফিসের জবাব" cols="30" rows="2"></textarea>
                    <textarea class="form-control mb-1" name="audit_conclusion" placeholder="নিরীক্ষার মন্তব্য" cols="30" rows="2"></textarea>
                    <textarea class="form-control mb-1" name="audit_recommendation" placeholder="নিরীক্ষার সুপারিশ" cols="30" rows="2"></textarea>
                </div>
                <div class="col-md-5 pr-0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body" style="height: calc(100vh - 145px);padding: 10px;">
                                    <input class="form-control mb-1" pattern="[0-9\.]*"
                                           name="jorito_ortho_poriman" placeholder="জড়িত অর্থ (টাকা)" type="text">

                                    <input class="form-control mb-1" pattern="[0-9\.]*"
                                           name="onishponno_jorito_ortho_poriman" placeholder="অনিষ্পন্ন জড়িত অর্থ (টাকা)" type="text">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <input class="form-control mb-1 mt-1 year-picker" name="audit_year_start" placeholder="নিরীক্ষাধীন অর্থ বছর শুরু" type="text">
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control mb-1 mt-1 year-picker" name="audit_year_end" placeholder="নিরীক্ষাধীন অর্থ বছর শেষ" type="text">
                                        </div>
                                    </div>

                                    <select class="form-control select-select2" name="memo_irregularity_type">
                                        <option value="">আপত্তি অনিয়মের ধরন</option>
                                        <option value="1">আত্মসাত, চুরি, প্রতারণা ও জালিয়াতিমূলক</option>
                                        <option value="2">সরকারের আর্থিক ক্ষতি</option>
                                        <option value="3">বিধি ও পদ্ধতিগত অনিয়ম</option>
                                        <option value="4">বিশেষ ধরনের আপত্তি</option>
                                    </select>

                                    <select class="form-control" name="memo_irregularity_sub_type">
                                        <option value="">আপত্তি অনিয়মের সাব-ধরন</option>
                                        <option value="1">ভ্যাট-আইটিসহ সরকারি প্রাপ্য আদায় না করা</option>
                                        <option value="2">কম আদায় করা</option>
                                        <option value="3">আদায় করা সত্ত্বেও কোষাগারে জমা না করা</option>
                                        <option value="4">বাজার দর অপেক্ষা উচ্চমূল্যে ক্রয় কার্য সম্পাদন</option>
                                        <option value="5">রেসপন্সিভ সর্বনিম্ন দরদাতার স্থলে উচ্চ দরদাতার নিকট থেকে কার্য/পণ্য/সেবা ক্রয়</option>
                                        <option value="6">প্রকল্প শেষে অব্যয়িত অর্থ ফেরত না দেওয়া</option>
                                        <option value="7">ভুল বেতন নির্ধারণীর মাধ্যমে অতিরিক্ত বেতন উত্তোলন</option>
                                        <option value="8">প্রাপ্যতাবিহীন ভাতা উত্তোলন</option>
                                        <option value="9">জাতীয় অন্যান্য সরকারী অর্থের ক্ষতি সংক্রান্ত আপত্তি।</option>
                                    </select>

                                    <select class="form-control" name="memo_type">
                                        <option value="">আপত্তির ধরন</option>
                                        <option value="1">এসএফআই</option>
                                        <option value="2">নন-এসএফআই</option>
                                        <option value="3">ড্রাফ্ট প্যারা</option>
                                        <option value="4">পাণ্ডুলিপি</option>
                                    </select>

                                    <select class="form-control" name="memo_status">
                                        <option value="">আপত্তির অবস্থা</option>
                                        <option value="1">১. নিস্পন্ন</option>
                                        <option value="2">২. অনিস্পন্ন</option>
                                        <option value="3">৩. আংশিক নিস্পন্ন</option>
                                    </select>

                                    <div class="form-group">
                                        <label class="col-form-label">
                                            পরিশিষ্ট সংযুক্তি
                                        </label>
                                        <input name="appendix_file" type="file" class="form-control rounded-0"
                                               accept="image/*" multiple>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">
                                            প্রামানক সংযুক্তি
                                        </label>
                                        <input name="authentic_file" type="file" class="form-control rounded-0"
                                               accept="image/*" multiple>
                                    </div>

                                    {{--<div class="form-group">
                                        <label class="col-form-label">
                                            কভার পেজ
                                        </label>
                                        <input name="file" type="file" class="form-control rounded-0"
                                               accept="image/*" multiple>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">
                                            টপ পেজ
                                        </label>
                                        <input name="file" type="file" class="form-control rounded-0"
                                               accept="image/*" multiple>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">
                                            মূল আপত্তি সংযুক্তি
                                        </label>
                                        <input name="file" type="file" class="form-control rounded-0"
                                               accept="image/*" multiple>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">
                                            আপত্তির অন্যান্য সংযুক্তি
                                        </label>
                                        <input name="file" type="file" class="form-control rounded-0"
                                               accept="image/*" multiple>
                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>




<script src="{{asset('assets/plugins/global/tinymce.min.js')}}" referrerpolicy="origin"></script>
<script>
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
        setup: function (editor) {},
    });

    //for submit form
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#memo_submit').on('click', function(e){
            e.preventDefault();

            from_data = new FormData(document.getElementById("memo_create_form")) ;
            from_data.append('memo_description_bn',tinymce.get("kt-tinymce-1").getContent())

            $.ajax({
                data: from_data,
                url: "{{route('audit.execution.memo.store')}}",
                type: "POST",
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (responseData) {
                    if (responseData.status === 'success') {
                        toastr.success(responseData.data);
                        /*var url = '{{route('audit.plan.strategy.sp_file_list')}}';
                        ajaxCallAsyncCallbackAPI(url,'', 'GET', function (response) {
                            if (response.status === 'error') {
                                toastr.error('Error');
                            } else {
                                $("#kt_content").html(response);
                            }
                        });*/
                    }
                    else {
                        if (responseData.statusCode === '422') {
                            var errors = responseData.msg;
                            $.each(errors, function (k, v) {
                                if (v !== '') {
                                    toastr.error(v);
                                }
                            });
                        }
                        else {
                            toastr.error(responseData.data);
                        }
                    }
                },
                error: function (data) {
                    if (data.responseJSON.errors) {
                        $.each(data.responseJSON.errors, function (k, v) {
                            if (isArray(v)) {
                                $.each(v, function (n, m) {
                                    toastr.error(m)
                                    console.log(m,n,v);
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
