<div class="card sna-card-border">
    <div class="row">
        <div class="col-md-8">
            <div class="d-flex justify-content-start">
                <h5 class="mt-5"></h5>
            </div>
        </div>
        <div class="col-md-4">
            <div class="d-flex justify-content-end">
                <a class="btn btn-sm btn-warning btn_back btn-square mr-3" href="javascript:;">
                    <i class="fad fa-arrow-alt-left"></i> {{___('generic.back')}}
                </a>
                <a id="archive_apotti_submit" class="btn btn-primary btn-sm btn-bold btn-square" href="javascript:;">
                    <i class="far fa-save mr-1"></i> {{___('generic.save')}}
                </a>
            </div>
        </div>
    </div>
</div>
<div class="mt-4 mb-15">
    <div class="row">
        <div class="col-md-12">
            <div class="card sna-card-border mt-3 mb-15">
                <h4>আপত্তির শিরোনাম: <span>{{$apotti['apotti_title']}}</span></h4>
                <div class="row">
                    <div class="col-6">
                        <table class="table table-sm table-bordered">
                            <tbody>
                            <tr>
                                <th style="width:180px!important">মন্ত্রণালয়/বিভাগ</th>
                                <td>{{$apotti['ministry_name_bn']}}</td>
                            </tr>
                            <tr>
                                <th>এনটিটি</th>
                                <td>{{$apotti['entity_name']}}</td>
                            </tr>
                            <tr>
                                <th>গ্রুপ</th>
                                <td>{{$apotti['parent_office_name_bn']}}</td>
                            </tr>
                            <tr>
                                <th>কস্ট সেন্টার</th>
                                <td>{{$apotti['cost_center_name_bn']}}</td>
                            </tr>
                            <tr>
                                <th>নিরীক্ষা বছর</th>
                                <td>{{enTobn($apotti['nirikkhar_shal'])}}</td>
                            </tr>
                            <tr>
                                <th>নিরীক্ষার ধরন</th>
                                <td>{{$apotti['nirikkha_dhoron']}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-6">
                        <table class="table table-sm table-bordered">
                            <tbody>
                            <tr>
                                <th style="width:180px!important">অনুচ্ছেদ নং</th>
                                <td>{{enTobn($apotti['onucched_no'])}}</td>
                            </tr>
                            <tr>
                                <th>আপত্তির শিরোনাম</th>
                                <td>{{$apotti['apotti_title']}}</td>
                            </tr>
                            <tr>
                                <th>আপত্তি অনিয়মের ক্যাটাগরি</th>
                                <td>{{empty($apotti['oniyomer_category'])?'':$apotti['oniyomer_category']['name_bn']}}</td>
                            </tr>
                            <tr>
                                <th>আপত্তির ধরন</th>
                                <td>{{$apotti['apottir_dhoron']}}</td>
                            </tr>
                            <tr>
                                <th>আপত্তির বর্তমান অবস্থা</th>
                                <td>{{$apotti['apotti_status']}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form class="mb-4" id="apotti_update_form" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" value="{{$apotti['id']}}" name="apotti_id">

        {{--cover_page--}}
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="card sna-card-border">
                    <div class="card-title font-size-h4 font-weight-bold">
                        কভার পেইজ
                        <input name="cover_page[]" type="file" class="mFilerInit form-control rounded-0">
                    </div>
                    <div class="row mt-3 mb-14">
                        <div class="col-md-2">
                            <img style="cursor: pointer;border: 2px solid #040404;" class="coverImage"
                                 src="{{config('amms_bee_routes.file_url').$apotti['cover_page_path'].$apotti['cover_page']}}"
                                 onclick="showImageOnModal(this)" width="80%" height="100%"/>

                            <div class="btn-group align-items-center ml-10 mt-3" role="group">
                                <button title="Download" type="button"
                                        class="mr-2 btn btn-sm btn-square btn-outline-primary text-violate"
                                        data-file-url="{{config('amms_bee_routes.file_url').$apotti['cover_page_path'].$apotti['cover_page']}}"
                                        onclick="downloadImage($(this))">
                                    <i class="fad fa-download"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--main_apottis--}}
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="card sna-card-border">
                    <div class="card-title font-size-h4 font-weight-bold">
                        আপত্তির মুল সংযুক্তি
                        <input name="main_apottis[]" multiple type="file" class="mFilerInit form-control rounded-0">
                    </div>
                    <div class="row mt-3 mb-14">
                        @foreach($main_attachments as $attachment)
                            <div class="col-md-2 mb-16">
                                <img style="cursor: pointer;border: 2px solid #040404;" class="coverImage"
                                     src="{{config('amms_bee_routes.file_url').$attachment['attachment_path'].$attachment['attachment_name']}}"
                                     onclick="showImageOnModal(this)" width="80%" height="100%"/>

                                <div class="btn-group align-items-center ml-3 mt-3" role="group">
                                    <button title="Download" type="button"
                                            class="mr-2 btn btn-sm btn-square btn-outline-primary text-violate"
                                            data-file-url="{{config('amms_bee_routes.file_url').$attachment['attachment_path'].$attachment['attachment_name']}}"
                                            onclick="downloadImage($(this))">
                                        <i class="fad fa-download"></i>
                                    </button>

                                    <button title="Delete" type="button"
                                            class="btn btn-sm btn-square btn-outline-danger text-violate"
                                            data-attachement-id="{{$attachment['id']}}"
                                            onclick="deleteAttachment($(this))">
                                        <i class="fad fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{--porisishtos--}}
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="card sna-card-border">
                    <div class="card-title font-size-h4 font-weight-bold">
                        আপত্তির পরিশিষ্ট সংযুক্তি
                        <input name="porisishtos[]" multiple type="file" class="mFilerInit form-control rounded-0">
                    </div>
                    <div class="row mt-3 mb-14">
                        @foreach($porisishto_attachments as $attachment)
                            <div class="col-md-2 mb-16">
                                <img style="cursor: pointer;border: 2px solid #040404;" class="coverImage"
                                     src="{{config('amms_bee_routes.file_url').$attachment['attachment_path'].$attachment['attachment_name']}}"
                                     onclick="showImageOnModal(this)" width="80%" height="100%"/>

                                <div class="btn-group align-items-center ml-3 mt-3" role="group">
                                    <button title="Download" type="button"
                                            class="mr-2 btn btn-sm btn-square btn-outline-primary text-violate"
                                            data-file-url="{{config('amms_bee_routes.file_url').$attachment['attachment_path'].$attachment['attachment_name']}}"
                                            onclick="downloadImage($(this))">
                                        <i class="fad fa-download"></i>
                                    </button>

                                    <button title="Delete" type="button"
                                            class="btn btn-sm btn-square btn-outline-danger text-violate"
                                            data-attachement-id="{{$attachment['id']}}"
                                            onclick="deleteAttachment($(this))">
                                        <i class="fad fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{--promanoks--}}
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="card sna-card-border">
                    <div class="card-title font-size-h4 font-weight-bold">
                        আপত্তির প্রমানক সংযুক্তি
                        <input name="promanoks[]" multiple type="file" class="mFilerInit form-control rounded-0">
                    </div>
                    <div class="row mt-3 mb-14">
                        @foreach($promanok_attachments as $attachment)
                            <div class="col-md-2 mb-16">
                                <img style="cursor: pointer;border: 2px solid #040404;" class="coverImage"
                                     src="{{config('amms_bee_routes.file_url').$attachment['attachment_path'].$attachment['attachment_name']}}"
                                     onclick="showImageOnModal(this)" width="80%" height="100%"/>

                                <div class="btn-group align-items-center ml-3 mt-3" role="group">
                                    <button title="Download" type="button"
                                            class="mr-2 btn btn-sm btn-square btn-outline-primary text-violate"
                                            data-file-url="{{config('amms_bee_routes.file_url').$attachment['attachment_path'].$attachment['attachment_name']}}"
                                            onclick="downloadImage($(this))">
                                        <i class="fad fa-download"></i>
                                    </button>

                                    <button title="Delete" type="button"
                                            class="btn btn-sm btn-square btn-outline-danger text-violate"
                                            data-attachement-id="{{$attachment['id']}}"
                                            onclick="deleteAttachment($(this))">
                                        <i class="fad fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{--others--}}
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="card sna-card-border">
                    <div class="card-title font-size-h4 font-weight-bold">
                        আপত্তির অন্যান্য সংযুক্তি
                        <input name="others[]" multiple type="file" class="mFilerInit form-control rounded-0">
                    </div>
                    <div class="row mt-3 mb-14">
                        @foreach($other_attachments as $attachment)
                            <div class="col-md-2 mb-16">
                                <img style="cursor: pointer;border: 2px solid #040404;" class="coverImage"
                                     src="{{config('amms_bee_routes.file_url').$attachment['attachment_path'].$attachment['attachment_name']}}"
                                     onclick="showImageOnModal(this)" width="80%" height="100%"/>

                                <div class="btn-group align-items-center ml-3 mt-3" role="group">
                                    <button title="Download" type="button"
                                            class="mr-2 btn btn-sm btn-square btn-outline-primary text-violate"
                                            data-file-url="{{config('amms_bee_routes.file_url').$attachment['attachment_path'].$attachment['attachment_name']}}"
                                            onclick="downloadImage($(this))">
                                        <i class="fad fa-download"></i>
                                    </button>

                                    <button title="Delete" type="button"
                                            class="btn btn-sm btn-square btn-outline-danger text-violate"
                                            data-attachement-id="{{$attachment['id']}}"
                                            onclick="deleteAttachment($(this))">
                                        <i class="fad fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

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
    function showImageOnModal(element) {
        var imageSrc = $(element).attr('src');
        $("#showImageModal").find('.modal-title').html('Image');
        $("#showImageModal").find('.modal-body img').attr('src', imageSrc);
        $("#showImageModal").modal('show');
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

            from_data = new FormData(document.getElementById("apotti_update_form"));

            elem = $(this);
            elem.prop('disabled', true);

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            $.ajax({
                data: from_data,
                url: '{{route('audit.execution.archive-apotti.store-new-attachment')}}',
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

    function deleteAttachment(elem){
        swal.fire({
            title: 'আপনি কি মুছে ফেলতে চান?',
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'হ্যাঁ',
            cancelButtonText: 'না'
        }).then(function(result) {
            if (result.value) {
                let url = '{{ route('audit.execution.archive-apotti.delete-attachment') }}';
                apotti_id = '{{$apotti['id']}}';
                attachement_id = elem.data('attachement-id');
                let data = {attachement_id};
                KTApp.block('#kt_wrapper', {
                    opacity: 0.1,
                    state: 'primary' // a bootstrap color
                });
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function(response) {
                    KTApp.unblock('#kt_wrapper');
                    if (response.status === 'success') {
                        toastr.success(response.data);
                        Archive_Apotti_Container.loadApottiDetails(apotti_id);
                    }else {
                        toastr.error(response.data);
                    }
                });
            }
        });
    }

    $('.btn_back').click(function () {
        backToList()
    })

    function backToList() {
        $('.apotti-upload a').click();
    }
</script>
