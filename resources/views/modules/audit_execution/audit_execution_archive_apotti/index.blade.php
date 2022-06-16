<x-title-wrapper>Apotti List</x-title-wrapper>

<div class="card sna-card-border d-flex flex-wrap flex-row">
    <div class="col-xl-12 text-right">
        <a class="btn btn-primary btn-sm btn-bold btn-square" href="javascript:;"
            onclick="Archive_Apotti_Container.loadApottiUploadForm()">
            <i class="far fa-plus mr-1"></i> আপত্তি আপলোড করুন
        </a>
    </div>
</div>

<div class="card sna-card-border d-flex flex-wrap flex-row">
    <div class="col-xl-12">
        <div class="row mt-2">
            <div class="col-md-3">
                <label for="directorate_id" class="col-form-label">অডিট ডিরেক্টরেট সমূহ</label>
                <select class="form-select select-select2" id="directorate_id" name="directorate_id">
                    @foreach ($directorates as $directorate)
                        <option value="{{ $directorate['office_id'] }}">{{ $directorate['office_name_bn'] }}
                        </option>
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
                <label for="unit_group_office_id" class="col-form-label">গ্রুপ</label>
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
                <select class="form-select select-select2" id="apotti_oniyomer_category_id"
                    name="apotti_oniyomer_category_id">
                    <option value="">--বাছাই করুন--</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}">
                            {{ $category['name_bn'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="apotti_oniyomer_category_child_id" class="col-form-label">অনিয়মের সাব-ক্যাটাগরি</label>
                <select class="form-select select-select2" id="apotti_oniyomer_category_child_id"
                    name="apotti_oniyomer_category_child_id">
                    <option value="">সবগুলো</option>
                </select>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-2">
                <label for="onucched_no" class="col-form-label">অনুচ্ছেদ নং</label>
                <input class="form-control" id="onucched_no" name="onucched_no" type="text">
            </div>

            <div class="col-md-2">
                <label for="audit_year_start" class="col-form-label">আপত্তির অর্থবছর</label>
                <div class="input-group">
                    <input class="form-control year-picker" id="audit_year_start" name="audit_year_start"
                        placeholder="শুরু" type="text">
                    <input class="form-control year-picker" name="audit_year_end" placeholder="শেষ" type="text">
                </div>
            </div>

            <div class="col-md-3">
                <label for="nirikkha_dhoron" class="col-form-label">নিরীক্ষার ধরন</label>
                <select class="form-control select-select2" id="nirikkha_dhoron" name="nirikkha_dhoron">
                    <option selected="selected" value="">নিরীক্ষার ধরন</option>
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
                    <option selected="selected" value="">আপত্তির ধরন</option>
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

        <div class="row mt-2 mb-2">
            <div class="col-md-3">
                <button onclick="Archive_Apotti_Container.loadApottiList()" class="btn btn-sm btn-primary btn-square"
                    type="button">
                    <i class="fad fa-search"></i> অনুসন্ধান
                </button>
            </div>
        </div>
    </div>
</div>


<div class="card sna-card-border mt-2 mb-15">
    <div id="load_apotti_list"></div>
</div>

@include(
    'modules.audit_execution.audit_execution_archive_apotti.scripts.archive_scripts'
);

<script>
    $(function() {
        directorate_id = $('#directorate_id').val();
        Archive_Apotti_Common_Container.loadDirectorateWiseMinistry(directorate_id);
        Archive_Apotti_Container.loadApottiList();
    });

    var Archive_Apotti_Container = {
        loadApottiList: function(page = 1, per_page = 10) {
            directorate_id = $("#directorate_id").val();
            ministry_id = $("#ministry_id").val();
            entity_id = $("#entity_id").val();
            unit_group_office_id = $("#unit_group_office_id").val();
            cost_center_id = $("#cost_center_id").val();
            apotti_oniyomer_category_id = $("#apotti_oniyomer_category_id").val();
            apotti_oniyomer_category_child_id = $("#apotti_oniyomer_category_child_id").val();
            onucched_no = $("#onucched_no").val();
            audit_year_start = $("#audit_year_start").val();
            audit_year_end = $("#audit_year_end").val();
            nirikkha_dhoron = $("#nirikkha_dhoron").val();
            apottir_dhoron = $("#apottir_dhoron").val();
            jorito_ortho_poriman = $("#jorito_ortho_poriman").val();
            let url = '{{ route('audit.execution.archive-apotti.list') }}';
            let data = {
                directorate_id,
                ministry_id,
                entity_id,
                unit_group_office_id,
                cost_center_id,
                apotti_oniyomer_category_id,
                apotti_oniyomer_category_child_id,
                onucched_no,
                audit_year_start,
                audit_year_end,
                nirikkha_dhoron,
                apottir_dhoron,
                jorito_ortho_poriman,
                page,
                per_page
            };

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function(response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('#load_apotti_list').html(response);
                }
            });
        },

        loadApottiUploadForm: function() {
            let url = '{{ route('audit.execution.archive-apotti.create') }}';
            let data = {};
            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function(response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.warning(response.data);
                } else {
                    $('#kt_content').html(response);
                }
            });
        },

        loadApottiEditForm: function(elem) {
            apotti_id = elem.data('apotti-id');
            let url = '{{ route('audit.execution.archive-apotti.edit') }}';
            let data = {apotti_id};
            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function(response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.warning(response.data);
                } else {
                    $('#kt_content').html(response);
                }
            });
        },

        loadApottiDetails: function(apotti_id) {
            let url = '{{ route('audit.execution.archive-apotti.view') }}';
            let data = {apotti_id};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'POST', function(response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.warning(response.data);
                } else {
                    $('#kt_content').html(response);
                }
            });
        },

        syncArchiveApottiToAmms: function(elem) {
            apotti_id = elem.data('apotti-id');
            let url = '{{ route('audit.execution.archive-apotti.migrate-archive-apotti-to-amms') }}';
            let data = {apotti_id};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'POST', function(response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.warning(response.data);
                } else {
                    toastr.success('success');
                }
            });
        }
    };


    //ministry
    $('#directorate_id').change(function() {
        directorate_id = $('#directorate_id').val();
        Archive_Apotti_Common_Container.loadDirectorateWiseMinistry(directorate_id);
    });

    //entity
    $('#ministry_id').change(function() {
        ministry_id = $('#ministry_id').val();
        Archive_Apotti_Common_Container.loadMinistryWiseEntity(ministry_id);
    });

    //unit group & cost center
    $('#entity_id').change(function() {
        entity_id = $('#entity_id').val();
        Archive_Apotti_Common_Container.loadEntityWiseUnitGroupOffice(entity_id);
        Archive_Apotti_Common_Container.loadEntityOrUnitGroupWiseCostCenter(entity_id);
    });

    //cost center
    $('#unit_group_office_id').change(function() {
        unit_group_office_id = $('#unit_group_office_id').val();
        Archive_Apotti_Common_Container.loadEntityOrUnitGroupWiseCostCenter(unit_group_office_id);
    });

    //sub category
    $('#apotti_oniyomer_category_id').change(function() {
        directorate_id = $('#directorate_id').val();
        apotti_oniyomer_category_id = $('#apotti_oniyomer_category_id').val();
        Archive_Apotti_Common_Container.loadOniyomerSubCategory(directorate_id, apotti_oniyomer_category_id);
    });
</script>
