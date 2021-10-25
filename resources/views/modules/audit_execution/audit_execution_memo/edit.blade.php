<form id="memo_update_form" enctype="multipart/form-data">

    <div class="row p-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-end">
                <a id="memo_submit" class="btn btn-success btn-sm btn-bold btn-square"
                   href="javascript:;">
                    <i class="far fa-save mr-1"></i> Update
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <input type="hidden" value="{{$memo['id']}}" name="memo_id">

        <div class="card-body pt-0 pb-3">
            <div class="row">
                <div class="col-md-7 p-3">
                    <textarea class="form-control mb-1" name="memo_title_bn" placeholder="আপত্তি শিরোনাম লিখুন" cols="30" rows="2">{{$memo['memo_title_bn']}}</textarea>

                    <textarea id="kt-tinymce-1" name="memo_description_bn" class="kt-tinymce-1">{{$memo['memo_description_bn']}}</textarea>

                    <label class="col-form-label">নিরীক্ষিত অফিসের জবাব</label>
                    <textarea class="form-control mb-1" name="response_of_rpu" placeholder="নিরীক্ষিত অফিসের জবাব" cols="30" rows="2">{{$memo['response_of_rpu']}}</textarea>

                    <label class="col-form-label">নিরীক্ষার মন্তব্য</label>
                    <textarea class="form-control mb-1" name="audit_conclusion" placeholder="নিরীক্ষার মন্তব্য" cols="30" rows="2">{{$memo['audit_conclusion']}}</textarea>

                    <label class="col-form-label">নিরীক্ষার সুপারিশ</label>
                    <textarea class="form-control mb-1" name="audit_recommendation" placeholder="নিরীক্ষার সুপারিশ" cols="30" rows="2">{{$memo['audit_recommendation']}}</textarea>
                </div>
                <div class="col-md-5 pr-0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body" style="padding: 10px;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input class="form-control" pattern="[0-9\.]*" value="{{$memo['jorito_ortho_poriman']}}"
                                                   name="jorito_ortho_poriman" placeholder="জড়িত অর্থ (টাকা)" type="text">

                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" pattern="[0-9\.]*" value="{{$memo['onishponno_jorito_ortho_poriman']}}"
                                                   name="onishponno_jorito_ortho_poriman" placeholder="অনিষ্পন্ন জড়িত অর্থ (টাকা)" type="text">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <input class="form-control year-picker" name="audit_year_start"
                                                   value="{{$memo['audit_year_start']}}" placeholder="নিরীক্ষাধীন অর্থ বছর শুরু" type="text">
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control year-picker" name="audit_year_end"
                                                   value="{{$memo['audit_year_end']}}" placeholder="নিরীক্ষাধীন অর্থ বছর শেষ" type="text">
                                        </div>
                                    </div>

                                    <select class="form-control select-select2" name="memo_irregularity_type">
                                        <option value="">আপত্তি অনিয়মের ধরন</option>
                                        <option value="1" {{$memo['memo_irregularity_type'] == 1?'selected':''}}>আত্মসাত, চুরি, প্রতারণা ও জালিয়াতিমূলক</option>
                                        <option value="2" {{$memo['memo_irregularity_type'] == 2?'selected':''}}>সরকারের আর্থিক ক্ষতি</option>
                                        <option value="3" {{$memo['memo_irregularity_type'] == 3?'selected':''}}>বিধি ও পদ্ধতিগত অনিয়ম</option>
                                        <option value="4" {{$memo['memo_irregularity_type'] == 4?'selected':''}}>বিশেষ ধরনের আপত্তি</option>
                                    </select>

                                    <select class="form-control select-select2" name="memo_irregularity_sub_type">
                                        <option value="">আপত্তি অনিয়মের সাব-ধরন</option>
                                        <option value="1" {{$memo['memo_irregularity_sub_type'] == 1?'selected':''}}>ভ্যাট-আইটিসহ সরকারি প্রাপ্য আদায় না করা</option>
                                        <option value="2" {{$memo['memo_irregularity_sub_type'] == 2?'selected':''}}>কম আদায় করা</option>
                                        <option value="3" {{$memo['memo_irregularity_sub_type'] == 3?'selected':''}}>আদায় করা সত্ত্বেও কোষাগারে জমা না করা</option>
                                        <option value="4" {{$memo['memo_irregularity_sub_type'] == 4?'selected':''}}>বাজার দর অপেক্ষা উচ্চমূল্যে ক্রয় কার্য সম্পাদন</option>
                                        <option value="5" {{$memo['memo_irregularity_sub_type'] == 5?'selected':''}}>রেসপন্সিভ সর্বনিম্ন দরদাতার স্থলে উচ্চ দরদাতার নিকট থেকে কার্য/পণ্য/সেবা ক্রয়</option>
                                        <option value="6" {{$memo['memo_irregularity_sub_type'] == 6?'selected':''}}>প্রকল্প শেষে অব্যয়িত অর্থ ফেরত না দেওয়া</option>
                                        <option value="7" {{$memo['memo_irregularity_sub_type'] == 7?'selected':''}}>ভুল বেতন নির্ধারণীর মাধ্যমে অতিরিক্ত বেতন উত্তোলন</option>
                                        <option value="8" {{$memo['memo_irregularity_sub_type'] == 8?'selected':''}}>প্রাপ্যতাবিহীন ভাতা উত্তোলন</option>
                                        <option value="9" {{$memo['memo_irregularity_sub_type'] == 9?'selected':''}}>জাতীয় অন্যান্য সরকারী অর্থের ক্ষতি সংক্রান্ত আপত্তি।</option>
                                    </select>

                                    <select class="form-control select-select2" name="memo_type">
                                        <option value="">আপত্তির ধরন</option>
                                        <option value="1" {{$memo['memo_type'] == 1?'selected':''}}>এসএফআই</option>
                                        <option value="2" {{$memo['memo_type'] == 2?'selected':''}}>নন-এসএফআই</option>
                                        <option value="3" {{$memo['memo_type'] == 3?'selected':''}}>ড্রাফ্ট প্যারা</option>
                                        <option value="4" {{$memo['memo_type'] == 4?'selected':''}}>পাণ্ডুলিপি</option>
                                    </select>

                                    <select class="form-control select-select2" name="memo_status">
                                        <option value="">আপত্তির অবস্থা</option>
                                        <option value="1" {{$memo['memo_status'] == 1?'selected':''}}>নিস্পন্ন</option>
                                        <option value="2" {{$memo['memo_status'] == 2?'selected':''}}>অনিস্পন্ন</option>
                                        <option value="3" {{$memo['memo_status'] == 3?'selected':''}}>আংশিক নিস্পন্ন</option>
                                    </select>

                                    <div class="form-group">
                                        <label class="col-form-label">পরিশিষ্ট সংযুক্তি</label>
                                        <input name="porisishto" type="file" class="form-control rounded-0"
                                               accept="image/*" multiple>
                                    </div>
                                    <div id="lightgalleryPorisishto">
                                        @foreach($memo['ac_memo_attachments'] as $attachment)
                                            @if($attachment['attachment_type'] == 'porisishto')
                                                <a href="{{$attachment['attachment_path']}}">
                                                    <img width="50px" height="50px" class="img-thumbnail" src="{{$attachment['attachment_path']}}" />
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">
                                            প্রামানক সংযুক্তি
                                        </label>
                                        <input name="pramanok" type="file" class="form-control rounded-0"
                                               accept="image/*" multiple>
                                    </div>

                                    <div id="lightgalleryPramanok">
                                        @foreach($memo['ac_memo_attachments'] as $attachment)
                                            @if($attachment['attachment_type'] == 'pramanok')
                                                <a href="{{$attachment['attachment_path']}}">
                                                    <img width="50px" height="50px" class="img-thumbnail" src="{{$attachment['attachment_path']}}" />
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
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

            from_data = new FormData(document.getElementById("memo_update_form")) ;
            from_data.append('memo_description_bn',tinymce.get("kt-tinymce-1").getContent())

            $.ajax({
                data: from_data,
                url: "{{route('audit.execution.memo.update')}}",
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

    lightGallery(document.getElementById('lightgalleryPorisishto'), {
        thumbnail:true
    });

    lightGallery(document.getElementById('lightgalleryPramanok'), {
        thumbnail:true
    });
</script>
