<style>
    .jFiler-theme-default .jFiler-input{
        width: 329px!important;
    }
</style>
<link rel="stylesheet" href="{{asset('assets/css/mFiler-font.css')}}" referrerpolicy="origin">
<link rel="stylesheet" href="{{asset('assets/css/mFiler.css')}}" referrerpolicy="origin">


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

    <div class="card sna-card-border mt-3 mb-15">
        <div class="mt-4">
            <div class="row">
                <div class="col-md-3">
                    <label for="directorate_id" class="col-form-label">অডিট ডিরেক্টরেট সমূহ</label>
                    <select class="form-select select-select2" id="directorate_id" name="directorate_id">
                        @foreach($directorates as $directorate)
                            <option value="{{$directorate['office_id']}}">{{$directorate['office_name_bn']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="ministry_id" class="col-form-label">মন্ত্রণালয়/বিভাগ</label>
                    <select class="form-select select-select2" id="ministry_id" name="ministry_id">
                        <option value="">সবগুলো</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="entity_id" class="col-form-label">এনটিটি</label>
                    <select class="form-select select-select2" id="entity_id" name="entity_id">
                        <option value="">সবগুলো</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="unit_group_office_id" class="col-form-label">ইউনিট গ্রুপ</label>
                    <select class="form-select select-select2" id="unit_group_office_id" name="unit_group_office_id">
                        <option value="">সবগুলো</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="cost_center_id" class="col-form-label">কস্ট সেন্টার/ইউনিট</label>
                    <select class="form-select select-select2" id="cost_center_id" name="cost_center_id">
                        <option value="">সবগুলো</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="apotti_oniyomer_category_id" class="col-form-label">অনিয়মের ক্যাটাগরি</label>
                    <select class="form-select select-select2" id="apotti_oniyomer_category_id" name="apotti_oniyomer_category_id">
                        <option value="">--বাছাই করুন--</option>
                        @foreach($categories as $category)
                            <option value="{{$category['id']}}">
                                {{$category['name_bn']}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="apotti_oniyomer_category_child_id" class="col-form-label">অনিয়মের সাব-ক্যাটাগরি</label>
                    <select class="form-select select-select2" id="apotti_oniyomer_category_child_id" name="apotti_oniyomer_category_child_id">
                        <option value="">সবগুলো</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <label for="onucched_no" class="col-form-label">অনুচ্ছেদ নং</label>
                    <input class="form-control" id="onucched_no" name="onucched_no" type="text">
                </div>

                <div class="col-md-2">
                    <label for="audit_year_start" class="col-form-label">আপত্তির অর্থবছর</label>
                    <div class="input-group">
                        <input class="form-control year-picker" id="audit_year_start" name="audit_year_start" placeholder="শুরু" type="text">
                        <input class="form-control year-picker" name="audit_year_end" placeholder="শেষ" type="text">
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="nirikkha_dhoron" class="col-form-label">নিরীক্ষার ধরন</label>
                    <select class="form-control select-select2" id="nirikkha_dhoron" name="nirikkha_dhoron">
                        <option value="">নিরিক্ষার ধরন</option>
                        <option value="কমপ্লায়েন্স অডিট">কমপ্লায়েন্স অডিট</option>
                        <option value="পারফরমেন্স অডিট">পারফরমেন্স অডিট</option>
                        <option value="ফাইন্যান্সিয়াল অডিট">ফাইন্যান্সিয়াল অডিট</option>
                        <option value="বার্ষিক অডিট">বার্ষিক অডিট</option>
                        <option value="বিশেষ অডিট">বিশেষ অডিট</option>
                        <option value="ইস্যুভিত্তিক অডিট">ইস্যুভিত্তিক অডিট</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="apottir_dhoron" class="col-form-label">আপত্তির ধরন</label>
                    <select class="form-control select-select2" id="apottir_dhoron" name="apottir_dhoron">
                        <option value="">আপত্তির ধরন</option>
                        <option value="এসএফআই">এসএফআই</option>
                        <option value="নন-এসএফআই">নন-এসএফআই</option>
                        <option value="ড্রাফ্ট প্যারা">ড্রাফ্ট প্যারা</option>
                        <option value="পাণ্ডুলিপি">রিপোর্টভুক্ত আপত্তি</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="jorito_ortho_poriman" class="col-form-label">জড়িত অর্থ (টাকা)</label>
                    <input class="form-control" id="jorito_ortho_poriman" name="jorito_ortho_poriman" type="text">
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <label for="file_no" class="col-form-label">ফাইল নং</label>
                    <input class="form-control" id="file_no" name="file_no" type="text">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label for="apotti_title" class="col-form-label">আপত্তির শিরোনাম</label>
                    <input class="form-control" id="apotti_title" name="apotti_title" type="text">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label class="col-form-label">কভার-পেজ</label>
                    <input name="cover_page[]" type="file" class="mFilerInit form-control rounded-0">
                </div>

                <div class="col-md-4">
                    <label class="col-form-label">টপ-পেজ</label>
                    <input name="top_page[]" type="file" class="mFilerInit form-control rounded-0">
                </div>

                <div class="col-md-4">
                    <label class="col-form-label">মূল আপত্তি সংযুক্তি</label>
                    <input name="main_apottis[]" type="file" class="mFilerInit form-control rounded-0" multiple>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label class="col-form-label">পরিশিষ্ট সংযুক্তি</label>
                    <input name="porisishtos[]" type="file" class="mFilerInit form-control rounded-0" multiple>
                </div>

                <div class="col-md-4">
                    <label class="col-form-label">প্রামানক সংযুক্তি</label>
                    <input name="promanoks[]" type="file" class="mFilerInit form-control rounded-0" multiple>
                </div>

                <div class="col-md-4">
                    <label class="col-form-label">আপত্তির অন্যান্য সংযুক্তি</label>
                    <input name="others[]" type="file" class="mFilerInit form-control rounded-0" multiple>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="{{asset('assets/js/mFiler.js')}}" type="text/javascript"></script>
<script>
    $(function () {
        directorate_id = $('#directorate_id').val();
        Archive_Apotti_Common_Container.loadDirectorateWiseMinistry(directorate_id);
    });

    $(document).ready(function () {
        $('.mFilerInit').filer({
            showThumbs: true,
            addMore: true,
            allowDuplicates: false
        });

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

            ministry_name = $("#ministry_id option:selected").text();
            from_data.append('ministry_name', ministry_name);

            entity_name = $("#entity_id option:selected").text();
            from_data.append('entity_name', entity_name);

            parent_office_name_bn = $("#unit_group_office_id option:selected").text();
            from_data.append('parent_office_name_bn', parent_office_name_bn);

            cost_center_name_bn = $("#cost_center_id option:selected").text();
            from_data.append('cost_center_name_bn', cost_center_name_bn);

            elem = $(this);
            elem.prop('disabled', true);

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            $.ajax({
                data: from_data,
                url: '{{route('audit.execution.archive-apotti.store')}}',
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

    //sub category
    $('#apotti_oniyomer_category_id').change(function () {
        directorate_id = $('#directorate_id').val();
        apotti_oniyomer_category_id = $('#apotti_oniyomer_category_id').val();
        Archive_Apotti_Common_Container.loadOniyomerSubCategory(directorate_id,apotti_oniyomer_category_id);
    });
</script>
