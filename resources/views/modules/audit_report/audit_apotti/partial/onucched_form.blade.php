
<div class="row ml-1 mt-2">
    <div class="col-7">
        <div class="card">
            <div class="card-body p-4">
                <form id="onucched_marge_form">
                    <div class="form-row pt-4">
                        <div class="col-md-6">
                            <label class="col-form-label"> অনুচ্ছেদ নম্বর</label>
                            <input class="form-control" name="onucched_no" placeholder="অনুচ্ছেদ নম্বর" value="">
                        </div>

                        <div class="col-md-6">
                            <label class="col-form-label"> জড়িত অর্থ (টাকা) </label>
                            <input class="form-control" name="total_jorito_ortho_poriman" readonly value="{{$jorito_ourtho}}">
                        </div>

                        <div class="col-md-12">
                            <label class="col-form-label"> আপত্তির শিরোনাম লিখুন</label>
                            <input class="form-control" name="apotti_title" placeholder="আপত্তির শিরোনাম লিখুন"
                                   value="">
                        </div>

                        <div class="col-md-12 mb-2">
                            <textarea id="kt-tinymce-1" name="apotti_description" class="kt-tinymce-1"></textarea>
                        </div>

                        <div class="col-md-12 mb-2">
                            <label class="col-form-label">অনিয়মের কারণ</label>
                            <textarea class="form-control mb-1" name="irregularity_cause" placeholder="অনিয়মের কারণ"
                                      cols="30"
                                      rows="2"></textarea>
                        </div>

                        <div class="col-md-12 mb-2">
                            <label class="col-form-label">অডিট প্রতিষ্ঠানের জবাব</label>
                            <textarea class="form-control mb-1" name="response_of_rpu"
                                      placeholder="নিরীক্ষিত প্রতিষ্ঠানের জবাব"
                                      cols="30"
                                      rows="2"></textarea>
                        </div>

                        <div class="col-md-12 mb-2">
                            <label class="col-form-label">নিরীক্ষা মন্তব্য</label>
                            <textarea class="form-control mb-1" name="audit_conclusion" placeholder="নিরীক্ষা মন্তব্য"
                                      cols="30"
                                      rows="2"></textarea>
                        </div>

                        <div class="col-md-12 mb-2">
                            <label class="col-form-label">নিরীক্ষার সুপারিশ</label>
                            <textarea class="form-control mb-1" name="audit_recommendation"
                                      placeholder="নিরীক্ষার সুপারিশ" cols="30"
                                      rows="2"></textarea>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-square btn-outline-primary mr-2"
                            data-apotti-ids = "{{$apotti_ids}}"
                            data-sequence = "{{$sequence}}"
                            onclick="Apotti_Container.mergeOnucchedSubmit($(this))"><i class="fa fa-save"></i> সংরক্ষণ
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-5">
        <div class="card">
            <div class="card-body p-4">
                <div class="form-row pt-4">
                    <div class="col-md-12">
                        <label class="col-form-label"> অনুচ্ছেদ</label>
                        <select id="selected_onucched" class="form-control select-selct2">
                            <option value="">অনুচ্ছেদ বাছাই করুন</option>
                            @foreach($apotti_item_list as $apotti_item)
                                <option value="{{$apotti_item['apotti_item_id']}}">{{$apotti_item['memo_title_bn']}}</option>
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
</script>

