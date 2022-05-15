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
                    <a
                        onclick=""
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
                        @foreach($apotti['attachments'] as $attachment)
                            <div class="col-md-2">
                                <img style="cursor: pointer" class="coverImage" src="{{$attachment['attachment_path'].'/'.$attachment['attachment_name']}}"
                                     onclick="showImageOnModal(this)" width="60"/>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card sna-card-border mt-3" style="height: calc(100vh - 145px);overflow: auto;padding: 10px;">
                    <div class="row">
                        <div class="col-md-8">
                            <button class="mr-2 btn btn-icon btn-square btn-sm btn-hover-icon-danger btn-primary list-btn-toggle" type="button" onclick="zoomIn()" id="btnZoom">
                                <i class="fa fa-plus"></i>
                            </button>
                            <button class="mr-2 btn btn-icon btn-square btn-sm btn-hover-icon-danger btn-primary list-btn-toggle" type="button" onclick="zoomOut()" id="btnZoom">
                                <i class="fad fa-minus"></i>
                            </button>
                            <button class="mr-2 btn btn-icon btn-square btn-sm btn-hover-icon-danger btn-primary list-btn-toggle" type="button" onclick="rotate(image)">
                                <i class="fad fa-undo"></i>
                            </button>
                        </div>
                        <div class="col-md-4">
                            <h5 style="float: right">আপত্তি আইডি: {{ $apotti['id'] }}</h5>
                        </div>
                    </div>

                    @foreach($apotti['attachments'] as $attachment)
                        @if ($attachment['attachment_type'] == 'main')
                            <div class="double-scroll zoom mt-1"  style="height: calc(100vh - 245px);">
                                <img src="{{$attachment['attachment_path'].'/'.$attachment['attachment_name']}}"
                                     alt="" id="image" {{--onclick="rotate(this)"--}} width="650px">
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">
                <div class="card sna-card-border mt-3 mb-15">
                    <input class="form-control" id="onucched_no" name="onucched_no" type="text"
                           value="{{$apotti['onucched_no']}}">

                    <textarea class="form-control" name="apotti_title" cols="30" rows="2">{{$apotti['apotti_title']}}</textarea>

                    <input style="float: right" class="form-control" id="jorito_ortho_poriman" name="jorito_ortho_poriman" type="text"
                           value="{{$apotti['jorito_ortho_poriman']}}">

                    <select class="form-select select-select2" id="directorate_id" name="directorate_id">
                        @foreach($directorates as $directorate)
                            <option value="{{$directorate['office_id']}}" {{$apotti['directorate_id']==$directorate['office_id']?'selected':''}}>{{$directorate['office_name_bn']}}</option>
                        @endforeach
                    </select>

                    <select class="form-select select-select2" id="ministry_id" name="ministry_id">
                        <option value="">মন্ত্রণালয়/অফিস</option>
                    </select>

                    <select class="form-select select-select2" id="entity_id" name="entity_id">
                        <option value="">এনটিটি</option>
                    </select>

                    <select class="form-select select-select2" id="unit_group_office_id" name="unit_group_office_id">
                        <option value="">ইউনিট গ্রুপ</option>
                    </select>

                    <select class="form-select select-select2" id="cost_center_id" name="cost_center_id">
                        <option value="">কস্ট সেন্টার</option>
                    </select>

                    <div class="input-group">
                        <input class="form-control year-picker" id="audit_year_start" name="audit_year_start" placeholder="শুরু" type="text" value="{{$apotti['year_start']}}">
                        <input class="form-control year-picker" name="audit_year_end" placeholder="শেষ" type="text" value="{{$apotti['year_end']}}">
                    </div>

                    <select class="form-select select-select2" id="apotti_oniyomer_category_id" name="apotti_oniyomer_category_id">
                        <option value="">--বাছাই করুন--</option>
                        @foreach($categories as $category)
                            <option value="{{$category['id']}}" {{$apotti['apotti_category_id'] == $category['id']?'selected':''}}>
                                {{$category['name_bn']}}
                            </option>
                        @endforeach
                    </select>

                    <select class="form-select select-select2" id="apotti_oniyomer_category_child_id" name="apotti_oniyomer_category_child_id">
                        <option value="">সবগুলো</option>
                    </select>

                    <select class="form-control select-select2" id="nirikkha_dhoron" name="nirikkha_dhoron">
                        <option value="">নিরিক্ষার ধরন</option>
                        <option value="কমপ্লায়েন্স অডিট" {{$apotti['nirikkha_dhoron'] == 'কমপ্লায়েন্স অডিট'?'selected':''}}>কমপ্লায়েন্স অডিট</option>
                        <option value="পারফরমেন্স অডিট" {{$apotti['nirikkha_dhoron'] == 'পারফরমেন্স অডিট'?'selected':''}}>পারফরমেন্স অডিট</option>
                        <option value="ফাইন্যান্সিয়াল অডিট" {{$apotti['nirikkha_dhoron'] == 'ফাইন্যান্সিয়াল অডিট'?'selected':''}}>ফাইন্যান্সিয়াল অডিট</option>
                        <option value="বার্ষিক অডিট" {{$apotti['nirikkha_dhoron'] == 'বার্ষিক অডিট'?'selected':''}}>বার্ষিক অডিট</option>
                        <option value="বিশেষ অডিট" {{$apotti['nirikkha_dhoron'] == 'বিশেষ অডিট'?'selected':''}}>বিশেষ অডিট</option>
                        <option value="ইস্যুভিত্তিক অডিট" {{$apotti['nirikkha_dhoron'] == 'ইস্যুভিত্তিক অডিট'?'selected':''}}>ইস্যুভিত্তিক অডিট</option>
                    </select>

                    <select class="form-control select-select2" id="apottir_dhoron" name="apottir_dhoron">
                        <option value="">আপত্তির ধরন</option>
                        <option value="এসএফআই" {{$apotti['apottir_dhoron'] == 'এসএফআই'?'selected':''}}>এসএফআই</option>
                        <option value="নন-এসএফআই" {{$apotti['apottir_dhoron'] == 'নন-এসএফআই'?'selected':''}}>নন-এসএফআই</option>
                        <option value="ড্রাফ্ট প্যারা" {{$apotti['apottir_dhoron'] == 'ড্রাফ্ট প্যারা'?'selected':''}}>ড্রাফ্ট প্যারা</option>
                        <option value="পাণ্ডুলিপি" {{$apotti['apottir_dhoron'] == 'পাণ্ডুলিপি'?'selected':''}}>রিপোর্টভুক্ত আপত্তি</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal -->
<div class="modal fade" id="showImageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="" class="img-fluid" style="width:100%">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<script>
    $(function () {
        directorate_id = $('#directorate_id').val();

        //minitsry
        ministry_id = '{{$apotti['ministry_id']}}';
        Archive_Apotti_Container.loadDirectorateWiseMinistry(directorate_id,ministry_id);

        //entity
        entity_id = '{{$apotti['entity_info_id']}}';
        Archive_Apotti_Container.loadMinistryWiseEntity(ministry_id,entity_id);

        //unit group
        parent_office_id = '{{$apotti['parent_office_id']}}';
        Archive_Apotti_Container.loadEntityWiseUnitGroupOffice(entity_id,parent_office_id);

        //cost center
        cost_center_id = '{{$apotti['cost_center_id']}}';
        Archive_Apotti_Container.loadEntityOrUnitGroupWiseCostCenter(parent_office_id,cost_center_id);

        apotti_oniyomer_category_id = $('#apotti_oniyomer_category_id').val();
        apotti_oniyomer_category_child_id = '{{$apotti['apotti_sub_category_id']}}';
        Archive_Apotti_Container.loadOniyomerSubCategory(directorate_id,apotti_oniyomer_category_id,apotti_oniyomer_category_child_id);
    });


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

            elem = $(this);
            elem.prop('disabled', true);

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            $.ajax({
                data: from_data,
                url: '{{route('audit.execution.archive-apotti.update')}}',
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
        if($(".doubleScroll-scroll:first").length == 0) {
            $('.double-scroll').doubleScroll();
        }
        $(".doubleScroll-scroll:first").css('width', (imgWidth + 50) + "px");
    }

    function zoomOut() {
        let image = document.getElementById('image');
        let imgWidth = image.clientWidth;

        image.style.width = (imgWidth - 50) + "px";
        if($(".doubleScroll-scroll:first").length == 0) {
            $('.double-scroll').doubleScroll();
        }
        $(".doubleScroll-scroll:first").css('width', (imgWidth - 50) + "px");
    }

    rotateAngle = 90;

    function rotate(image) {
        image.setAttribute("style", "transform: rotate(" + rotateAngle + "deg)");

        rotateAngle = rotateAngle + 90;
        setTimeout(function() {
            $(image).css("margin-top", $(image).position().left + "px");
        }, 500);
    }
</script>
