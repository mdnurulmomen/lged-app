<form class="mb-4" id="apotti_create_form" enctype="multipart/form-data" autocomplete="off">
    <div class="card sna-card-border">
        <div class="row">
            <div class="col-md-8">
                <div class="d-flex justify-content-start">
                    <h5 class="mt-5"></h5>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex justify-content-end">
                    <a href="javascript:;"
                       class="btn btn-sm btn-warning btn_back btn-square mr-3">
                        <i class="fad fa-arrow-alt-left"></i> {{___('generic.back')}}
                    </a>
                    <a id="archive_apotti_submit" class="btn btn-primary btn-sm btn-bold btn-square"
                       href="javascript:;">
                        <i class="far fa-save mr-1"></i> {{___('generic.save')}}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 mb-15">
        <div class="row">
            <div class="col-md-8">
                <div class="card sna-card-border mt-3">
                    <div class="row">
                        <div class="col-md-2">
                            <img style="cursor: pointer" class="coverImage"
                                 src="{{config('amms_bee_routes.file_url').$apotti_item['cover_page_path'].$apotti_item['cover_page']}}"
                                 onclick="showImageOnModal(this)" width="60%"/>
                        </div>
                    </div>
                </div>

                <div class="card sna-card-border mt-3"
                     style="height: calc(100vh - 145px);overflow-y: auto;padding: 10px;">
                    <div class="row">
                        <div class="col-md-8">
                            <button
                                class="mr-2 btn btn-icon btn-square btn-sm btn-hover-icon-danger btn-primary list-btn-toggle"
                                type="button" onclick="zoomIn()" id="btnZoom">
                                <i class="fa fa-plus"></i>
                            </button>
                            <button
                                class="mr-2 btn btn-icon btn-square btn-sm btn-hover-icon-danger btn-primary list-btn-toggle"
                                type="button" onclick="zoomOut()" id="btnZoom">
                                <i class="fad fa-minus"></i>
                            </button>
                            <button
                                class="mr-2 btn btn-icon btn-square btn-sm btn-hover-icon-danger btn-primary list-btn-toggle"
                                type="button" onclick="rotate(image)">
                                <i class="fad fa-undo"></i>
                            </button>
                        </div>
                        <div class="col-md-4">
                            <h5 style="float: right">আপত্তি আইডি: {{ $apotti['id'] }}</h5>
                        </div>
                    </div>

                    @foreach($main_attachments as $attachment)
                        <img
                            src="{{config('amms_bee_routes.file_url').$attachment['file_path'].$attachment['file_custom_name']}}"
                            alt="" width="100%">
                    @endforeach

                    <div style="display:none;" class="load-porisishto-attachment">
                        @foreach($porisishto_attachments as $attachment)
                            <img
                                src="{{config('amms_bee_routes.file_url').$attachment['file_path'].$attachment['file_custom_name']}}"
                                alt="" width="100%">
                        @endforeach
                    </div>

                    <div style="display:none;" class="load-promanok-attachment">
                        @foreach($promanok_attachments as $attachment)
                            <img
                                src="{{config('amms_bee_routes.file_url').$attachment['file_path'].$attachment['file_custom_name']}}"
                                alt="" width="100%">
                        @endforeach
                    </div>
                </div>

                <div class="d-flex mt-2">
                    <a class="mr-2 btn btn-primary btn-sm btn-bold btn-square"
                       href="javascript:;" onclick="loadPorisishto()">
                        পরিশিষ্ট লোড করুন {{enTobn(count($porisishto_attachments))}}
                    </a>
                    <a class="btn btn-primary btn-sm btn-bold btn-square"
                       href="javascript:;" onclick="loadPromanok()">
                        প্রমাণক লোড করুন {{enTobn(count($promanok_attachments))}}
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card sna-card-border mt-3 mb-15">
                    <input type="hidden" name="apotti_item_id" value="{{$apotti_item['id']}}">
                    <input type="hidden" name="apotti_id" value="{{$apotti['id']}}">
                    <input type="hidden" name="directorate_id" value="{{$search_data['directorate_id']}}">

                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">অনুচ্ছেদ নম্বর</span></div>
                        <input class="form-control" id="onucched_no" name="onucched_no" type="text"
                               value="{{$apotti['onucched_no']}}" readonly>
                    </div>

                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">ফাইল নং</span></div>
                        <input class="form-control" id="file_no" name="file_no" type="text"
                               value="{{$apotti['file_token_no']}}" readonly>
                    </div>

                    <textarea class="form-control" name="apotti_title" cols="30"
                              rows="2" readonly>{{$apotti['apotti_title']}}</textarea>

                    <input style="float: right" class="form-control number-input" id="jorito_ortho_poriman"
                           name="jorito_ortho_poriman" type="text"
                           value="{{$apotti_item['jorito_ortho_poriman']}}"
                           readonly
                    >

                    <div class="border mt-2 mb-2 pt-2">
                        <p>মন্ত্রনালয়ঃ {{$apotti_item['ministry_name_bn']}}</p>
                        <p>এন্টিটিঃ {{$apotti_item['parent_office_name_bn']}}</p>
                        <p>কস্টসেন্টারঃ {{$apotti_item['cost_center_name_bn']}}</p>
                    </div>

                    <p class="text-danger d-none" style="font-weight:bold; font-size:1.1em" id="unmapped_error_tag">
                        সঠিক ম্যাপ এ নেই। অনুগ্রহ করে সঠিক ম্যাপ করুন।</p>

                    <select class="form-select select-select2" id="ministry_id" name="ministry_id">
                        <option value="">মন্ত্রণালয়/অফিস</option>
                    </select>
                    <br>

                    <select class="form-select select-select2" id="entity_id" name="entity_id">
                        <option value="">এনটিটি</option>
                    </select>
                    <br>

                    <select class="form-select select-select2" id="unit_group_office_id" name="unit_group_office_id">
                        <option value="">ইউনিট গ্রুপ</option>
                    </select>
                    <br>

                    <select class="form-select select-select2" id="cost_center_id" name="cost_center_id">
                        <option value="">কস্ট সেন্টার</option>
                    </select>
                    <br>

                    <select class="form-select select-select2" id="project_id" name="project_id">
                        <option value="">প্রজেক্ট বাছাই করুন</option>
                        @foreach($all_projects as $project)
                            <option value="{{$project['id']}}" data-project-name-en="{{$project['name_en']}}"
                                    data-project-name-bn="{{$project['name_bn']}}">{{$project['name_bn']}}</option>
                        @endforeach
                    </select>
                    <br>

                    <select class="form-select select-select2" id="fiscal_year_id" name="fiscal_year_id">
                        <option value="">অর্থ বছর বাছাই করুন</option>
                        @foreach($fiscal_years as $fiscal_year)
                            <option value="{{$fiscal_year['id']}}">{{$fiscal_year['description']}}</option>
                        @endforeach
                    </select>
                    <br>

                    <div class="input-group">
                        <input class="form-control year-picker" id="audit_year_start" name="audit_year_start"
                               placeholder="শুরু" type="text" value="{{$apotti_item['audit_year_start']}}">
                        <input class="form-control year-picker" name="audit_year_end" placeholder="শেষ" type="text"
                               value="{{$apotti_item['audit_year_end']}}">
                    </div>
                    <br>

                    <select class="form-control select-select2" id="audit_type" name="audit_type">
                        <option value="">নিরিক্ষার ধরন</option>
                        <option
                            value="compliance" {{$apotti_item['audit_type'] == 'compliance'?'selected':''}}>
                            কমপ্লায়েন্স অডিট
                        </option>
                        <option
                            value="performance" {{$apotti_item['audit_type'] == 'performance'?'selected':''}}>
                            পারফরমেন্স অডিট
                        </option>
                        <option
                            value="financial" {{$apotti_item['audit_type'] == 'financial'?'selected':''}}>
                            ফাইন্যান্সিয়াল অডিট
                        </option>
                        <option value="yearly" {{$apotti_item['audit_type'] == 'yearly'?'selected':''}}>
                            বার্ষিক অডিট
                        </option>
                        <option value="special" {{$apotti_item['audit_type'] == 'special'?'selected':''}}>বিশেষ
                            অডিট
                        </option>
                        <option
                            value="issue" {{$apotti_item['audit_type'] == 'issue_based'?'selected':''}}>
                            ইস্যুভিত্তিক অডিট
                        </option>
                    </select>

                    <select class="form-control select-select2" id="memo_type" name="memo_type">
                        <option value="">আপত্তির ধরন</option>
                        <option value="sfi" {{$apotti_item['memo_type'] == 'sfi'?'selected':''}}>এসএফআই</option>
                        <option value="non-sfi" {{$apotti_item['memo_type'] == 'non-sfi'?'selected':''}}>নন-এসএফআই
                        </option>
                        <option value="draft-para" {{$apotti_item['memo_type'] == 'draft-para'?'selected':''}}>
                            ড্রাফ্ট প্যারা
                        </option>
                        <option value="pandulipi" {{$apotti_item['memo_type'] == 'pandulipi'?'selected':''}}>
                            রিপোর্টভুক্ত আপত্তি
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal -->
<div class="modal fade" id="showImageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i style="color:#ffffff!important;" aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <img src="" class="img-fluid" style="width:100%">
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<script>
    $(function () {
        directorate_id = {{$search_data['directorate_id']}};

        //minitsry
        ministry_id = '{{$apotti_item['ministry_id']}}';
        Archive_Apotti_Common_Container.loadDirectorateWiseMinistry(directorate_id, ministry_id);

        //entity
        entity_id = '{{$apotti_item['parent_office_id']}}';
        loadMinistryWiseEntity(ministry_id, entity_id);


        Archive_Apotti_Common_Container.loadEntityWiseUnitGroupOffice(entity_id, entity_id);

        //cost center
        cost_center_id = '{{$apotti_item['cost_center_id']}}';
        Archive_Apotti_Common_Container.loadEntityOrUnitGroupWiseCostCenter(entity_id, cost_center_id);
    });

    //ministry
    $('#directorate_id').change(function () {
        directorate_id = $('#directorate_id').val();
        Archive_Apotti_Common_Container.loadDirectorateWiseMinistry(directorate_id);
    });

    //entity
    $('#ministry_id').change(function () {
        ministry_id = $('#ministry_id').val();
        Archive_Apotti_Common_Container.loadMinistryWiseEntity(ministry_id);
    });

    //unit group & cost center
    $('#entity_id').change(function () {
        entity_id = $('#entity_id').val();
        Archive_Apotti_Common_Container.loadEntityWiseUnitGroupOffice(entity_id);
        Archive_Apotti_Common_Container.loadEntityOrUnitGroupWiseCostCenter(entity_id);
    });

    //cost center
    $('#unit_group_office_id').change(function () {
        unit_group_office_id = $('#unit_group_office_id').val();
        Archive_Apotti_Common_Container.loadEntityOrUnitGroupWiseCostCenter(unit_group_office_id);
    });

    $('.btn_back').click(function () {
        backToList()
    })

    function backToList() {
        $('.apotti-upload a').click();
    }


    //for submit form
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#archive_apotti_submit').on('click', function (e) {
            e.preventDefault();

            from_data = new FormData(document.getElementById("apotti_create_form"));

            ministry_name_en = $('#ministry_id option:selected').attr('data-ministry-name-en');
            ministry_name_bn = $('#ministry_id option:selected').attr('data-ministry-name-bn');

            from_data.append('ministry_name_en', ministry_name_en);
            from_data.append('ministry_name_bn', ministry_name_bn);

            entity_name_en = $('#entity_id option:selected').attr('data-office-name-en');
            entity_name_bn = $('#entity_id option:selected').attr('data-office-name-bn');

            from_data.append('entity_name_en', entity_name_en);
            from_data.append('entity_name_bn', entity_name_bn);

            cost_center_name_en = $('#cost_center_id option:selected').attr('data-office-name-en');
            cost_center_name_bn = $('#cost_center_id option:selected').attr('data-office-name-bn');

            from_data.append('cost_center_name_en', cost_center_name_en);
            from_data.append('cost_center_name_bn', cost_center_name_bn);

            project_name_en = $('#project_id option:selected').attr('data-project-name-en');
            project_name_bn = $('#project_id option:selected').attr('data-project-name-bn');

            from_data.append('project_name_en', project_name_en);
            from_data.append('project_name_bn', project_name_bn);

            from_data.append('fiscal_year', $('#fiscal_year_id option:selected').text());

            elem = $(this);
            elem.prop('disabled', true);

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            $.ajax({
                data: from_data,
                url: '{{route('audit.execution.apotti.search-edit-submit')}}',
                type: "POST",
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (responseData) {
                    KTApp.unblock('#kt_wrapper');
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
                    KTApp.unblock('#kt_wrapper');
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

    function showImageOnModal(element) {
        var imageSrc = $(element).attr('src');
        $("#showImageModal").find('.modal-title').html('Image');
        $("#showImageModal").find('.modal-body img').attr('src', imageSrc);
        $("#showImageModal").modal('show');
    }

    function zoomIn() {
        let image = document.getElementById('image');
        let imgWidth = image.clientWidth;

        image.style.width = (imgWidth + 50) + "px";
        if ($(".doubleScroll-scroll:first").length == 0) {
            $('.double-scroll').doubleScroll();
        }
        $(".doubleScroll-scroll:first").css('width', (imgWidth + 50) + "px");
    }

    function zoomOut() {
        let image = document.getElementById('image');
        let imgWidth = image.clientWidth;

        image.style.width = (imgWidth - 50) + "px";
        if ($(".doubleScroll-scroll:first").length == 0) {
            $('.double-scroll').doubleScroll();
        }
        $(".doubleScroll-scroll:first").css('width', (imgWidth - 50) + "px");
    }

    rotateAngle = 90;

    function rotate(image) {
        image.setAttribute("style", "transform: rotate(" + rotateAngle + "deg)");

        rotateAngle = rotateAngle + 90;
        setTimeout(function () {
            $(image).css("margin-top", $(image).position().left + "px");
        }, 500);
    }

    function loadPorisishto() {
        $(".load-porisishto-attachment").show();
    }

    function loadPromanok() {
        $(".load-promanok-attachment").show();
    }

    function loadMinistryWiseEntity(ministry_id, entity_id = '') {
        let url = '{{route('audit.execution.archive-apotti.load-ministry-wise-entity')}}';
        let data = {ministry_id};
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.warning(response.data);
                } else {
                    $('#entity_id').html(response);
                    if ($("#entity_id option[value='" + entity_id + "']").length == 0) {
                        $('#unmapped_error_tag').removeClass('d-none')
                    } else {
                        $('#entity_id').val(entity_id).trigger('change');
                    }
                }
            }
        );
    }
</script>
