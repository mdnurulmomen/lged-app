<style>
    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
        box-shadow:  0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
</style>

<div class="mb-12">
    <form id="onucched_marge_form">
        <div class="card sna-card-border">
            <div class="row">
                <div class="col-md-8">
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <button type="button" id="apotii_submit" class="btn btn-sm btn-square btn-outline-primary mr-2">
                            <i class="fa fa-save"></i> সংরক্ষণ করুন
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" name="apotti_id" value="{{$apotti_info['id']}}">

        <div class="card sna-card-border mt-3 mb-3">
            <div>
                <ul class="nav nav-tabs custom-tabs mb-0" id="apottiDetailsTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active rounded-0" data-toggle="tab"
                           href="#apotti_details">
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

                <div class="tab-content" id="apotti_edit_tab">
                    <div class="tab-pane fade border border-top-0 p-3 show active" id="apotti_details"
                         role="tabpanel" aria-labelledby="apotti-details-tab">

                        <div class="row ml-1 mt-2">
                            <div class="col-md-7">
                                <div class="form-row pt-4">
                                    <div class="col-md-3">
                                        <label class="col-form-label">অনুচ্ছেদ নং</label>
                                        <input readonly class="form-control" name="onucched_no" placeholder="অনুচ্ছেদ নং" value="{{$apotti_info['onucched_no']}}">
                                    </div>
                                    <div class="col-md-9">
                                        <label class="col-form-label">জড়িত অর্থ (টাকা)</label>
                                        <input type="text" readonly class="form-control integer_type_positive total_jorito_ortho_poriman" name="total_jorito_ortho_poriman" placeholder="জড়িত অর্থ" value="{{$apotti_info['total_jorito_ortho_poriman']}}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label class="col-form-label">শিরোনাম</label>
                                        <input class="form-control" name="apotti_title" placeholder="আপত্তির শিরোনাম লিখুন"
                                               value="{{$apotti_info['apotti_title']}}">
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <label class="col-form-label">বিবরণ</label>
                                        <textarea id="kt-tinymce-1" name="apotti_description" class="kt-tinymce-1">{!! $apotti_info['apotti_description'] !!}</textarea>
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <label class="col-form-label">অনিয়মের কারণ</label>
                                        <textarea class="form-control mb-1" name="irregularity_cause" placeholder="অনিয়মের কারণ"
                                                  cols="30"
                                                  rows="2">{{$apotti_info['irregularity_cause']}}</textarea>
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <label class="col-form-label">অডিটি প্রতিষ্ঠানের জবাব</label>
                                        <textarea class="form-control mb-1" name="response_of_rpu"
                                                  placeholder="অডিটি প্রতিষ্ঠানের জবাব"
                                                  cols="30"
                                                  rows="2">{{$apotti_info['response_of_rpu']}}</textarea>
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <label class="col-form-label">নিরীক্ষা মন্তব্য</label>
                                        <textarea class="form-control mb-1" name="audit_conclusion" placeholder="নিরীক্ষা মন্তব্য"
                                                  cols="30"
                                                  rows="2">{{$apotti_info['audit_conclusion']}}</textarea>
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <label class="col-form-label">নিরীক্ষার সুপারিশ</label>
                                        <textarea class="form-control mb-1" name="audit_recommendation"
                                                  placeholder="নিরীক্ষার সুপারিশ" cols="30"
                                                  rows="2">{{$apotti_info['audit_recommendation']}}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="card">
                                    <div class="card-body p-4">
                                        @foreach($apotti_info['apotti_items'] as $apotti_item)
                                            <input type="hidden" name="apotti_items[]" value="{{$apotti_item['id']}}">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label class="col-form-label">অনুচ্ছেদ নম্বর-{{enTobn($apotti_item['onucched_no'])}}</label><br>
                                                    <span>শিরোনামঃ {{$apotti_item['memo_title_bn']}}</span>
                                                    <input type="text" class="form-control jorito_ortho_poriman integer_type_positive" name="jorito_ortho_porimans[]" placeholder="জড়িত অর্থ"
                                                           value="{{$apotti_item['jorito_ortho_poriman']}}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body p-4">
                                        <div class="form-row pt-4">
                                            <div class="col-md-12">
                                                <label class="col-form-label">অনুচ্ছেদ</label>
                                                <select id="selected_onucched" class="form-control select-selct2">
                                                    <option value="">বাছাই করুন</option>
                                                    @foreach($apotti_info['apotti_items'] as $apotti_item)
                                                        <option value="{{$apotti_item['id']}}">{{$apotti_item['memo_title_bn']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row pt-4">
                                            <div class="col-md-12">
                                                <div id="apotti_item_info"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade border border-top-0 p-3" id="porisisto_tab"
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
                                @foreach($apotti_info['apotti_porisishtos'] as $porisishto)
                                    <tr id="apotii_porisishto_row_{{$porisishto['id']}}">
                                        <td>
                                            <div class="form-group">
                                                <label style="font-size: 1.5em" class="col-form-label">পরিশিষ্ট {{enTobn($loop->iteration)}}
                                                    <button style="border-radius: 13px" title="মুছে ফেলুন" type="button"
                                                            class="ml-1 btn btn-danger btn-sm btn-square" data-porisishto-id="{{$porisishto['id']}}"
                                                            onclick="removeUploadedPorisisto($(this))">
                                                        <span class="fa fa-trash"></span>
                                                    </button>
                                                </label>
                                                <textarea id="kt-tinymce-porisisto-{{$loop->iteration}}" class="porisisto_details kt-tinymce-1">{{$porisishto['details']}}</textarea>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
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

    $('#selected_onucched').change(function (){
        apotti_item_id = $(this).val();
        Apotti_Container.loadApottiItemInfo(apotti_item_id);
    });

    $(".jorito_ortho_poriman").keyup(function(){
        var jorito_orthos = $('.jorito_ortho_poriman').map((_,el) => el.value).get();
        var total_jorito_ortho_poriman = jorito_orthos.reduce(function(a, b){
            return a + parseFloat(b);
        }, 0);
        $(".total_jorito_ortho_poriman").val(total_jorito_ortho_poriman);
    });

    function addPorisisto(){
        total_porisito = $(".porisisto_details").length+1;
        porisito_html = '<tr><td>' +
            '<div class="form-group">' +
            '<label style="font-size: 1.5em"  class="col-form-label">' +
            'পরিশিষ্ট '+enTobn(total_porisito)+'' +
            '<button style="border-radius: 13px" title="মুছে ফেলুন" type="button" class="ml-1 btn btn-danger btn-sm btn-square" ' +
            'onclick="removePorisisto($(this))">' +
            '<span class="fa fa-trash"></span></button>' +
            '</label>' +
            '<textarea id="kt-tinymce-porisisto-'+total_porisito+'" class="porisisto_details kt-tinymce-1"></textarea>' +
            '</div>' +
            '</td></tr>';
        $('#tblPorisistoList').append(porisito_html);

        //todo mahmud vai
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
            toolbar: ['styleselect fontselect fontsizeselect | blockquote subscript superscript | undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify | table | bullist numlist | outdent indent | advlist | autolink | lists charmap | print preview |  code'],
            plugins: 'advlist paste autolink link image lists charmap print preview code table',
            context_menu: 'link image table',
            setup: function (editor) {
            },
        });
        setContentType('.kt-tinymce-1');
        toastr.success('Added');
    }

    function removePorisisto(elem){
        elem.closest("tr").remove();
    }

    //for submit form
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#apotii_submit').on('click', function (e) {
            e.preventDefault();

            from_data = new FormData(document.getElementById("onucched_marge_form"));
            from_data.append('apotti_description', tinymce.get("kt-tinymce-1").getContent());

            total_porisito = $(".porisisto_details").length;
            for (start=1;start<=total_porisito;start++){
                porisisto = tinymce.get("kt-tinymce-porisisto-"+start+"").getContent();
                from_data.append('porisisto_details[]', porisisto);
            }

            $.ajax({
                data: from_data,
                url: "{{route('audit.execution.apotti.update-apotti')}}",
                type: "POST",
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (responseData) {
                    if (responseData.status === 'success') {
                        toastr.success(responseData.data);
                        $('.btn_back').click();
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

    function removeUploadedPorisisto(elem){
        apotti_porisishto_id = elem.data('porisishto-id');
        swal.fire({
            title: 'আপনি কি তথ্যটি মুছে ফেলতে চান?',
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'হ্যাঁ',
            cancelButtonText: 'না'
        }).then(function(result) {
            if (result.value) {
                let url = '{{route('audit.execution.apotti.delete-apotti-porisisto')}}';
                data = {apotti_porisishto_id};
                ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                    if (response.status === 'error') {
                        toastr.error(response.data)
                    } else {
                        $("#apotii_porisishto_row_"+apotti_porisishto_id).hide();
                        toastr.success(response.data);
                    }
                });
            }
        });
    }

</script>

