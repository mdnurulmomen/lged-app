<x-title-wrapper> আপত্তির তালিকা</x-title-wrapper>

<div class="card sna-card-border d-flex flex-wrap flex-row">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-md-12 text-right">
                <input type="checkbox" id="plan_type"> প্রকল্প
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-3">
                <label for="directorate_id" class="col-form-label">অডিট ডিরেক্টরেট সমূহ</label>
                <select class="form-select select-select2" id="directorate_id">
                    @foreach ($directorates as $directorate)
                        <option value="{{ $directorate['office_id'] }}">{{ $directorate['office_name_bn'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label for="ministry_id" class="col-form-label">মন্ত্রণালয়/বিভাগ</label>
                <select class="form-select select-select2" id="ministry_id">
                    <option value="">সবগুলো (ALL)</option>
                </select>
            </div>

            <div id="doner_div" class="col-md-3" style="display: none">
                <label for="doner_id" class="col-form-label">ডেভেলপমেন্ট এজেন্সী</label>
                <select class="form-select select-select2" id="doner_id">
                    <option value="">সবগুলো</option>
                </select>
            </div>

            <div id="project_div" class="col-md-3" style="display: none">
                <label for="project_id" class="col-form-label">প্রকল্প</label>
                <select class="form-select select-select2" id="project_id">
                    <option value="">সবগুলো</option>
                </select>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">
                <label for="entity_id" class="col-form-label">এনটিটি</label>
                <select class="form-select select-select2" id="entity_id">
                    <option value="">সবগুলো</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="unit_group_office_id" class="col-form-label">গ্রুপ</label>
                <select class="form-select select-select2" id="unit_group_office_id" name="unit_group_office_id">
                    <option value="">সবগুলো</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="cost_center_id" class="col-form-label">কস্ট সেন্টার/ইউনিট</label>
                <select class="form-select select-select2" id="cost_center_id" name="cost_center_id">
                    <option value="">সবগুলো</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="file_token_no" class="col-form-label">ফাইল নং</label>
                <input class="form-control" id="file_token_no" type="text">
            </div>
        </div>


        <div class="row mb-2">
            <div class="col-md-3">
                <label for="fiscal_year_id" class="col-form-label">আপত্তির অর্থবছর</label>
                <select class="form-select select-select2" id="fiscal_year_id">
                    <option value="">সবগুলো</option>
                    @foreach($fiscal_years as $fiscal_year)
                        <option value="{{$fiscal_year['id']}}">{{enTobn($fiscal_year['description'])}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="audit_year_start" class="col-form-label">নিরীক্ষা বছর</label>
                <div class="input-group">
                    <input class="form-control year-picker" id="audit_year_start"
                           placeholder="শুরু" type="text">
                    <input class="form-control year-picker" id="audit_year_end" placeholder="শেষ" type="text">
                </div>
            </div>

            <div class="col-md-3">
                <label for="apotti_type" class="col-form-label">আপত্তির ধরন</label>
                <select class="form-control select-select2" id="apotti_type">
                    <option selected="selected" value="">আপত্তির ধরন</option>
                    <option value="sfi">এসএফআই</option>
                    <option value="non-sfi">নন-এসএফআই</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="memo_status" class="col-form-label">আপত্তির অবস্থা</label>
                <select class="form-control select-select2" id="memo_status">
                    <option selected="selected" value="">আপত্তির অবস্থা</option>
                    <option value="1">নিস্পন্ন</option>
                    <option value="2">অনিস্পন্ন</option>
                    <option value="3">আংশিক নিস্পন্ন</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="jorito_ortho_poriman" class="col-form-label">জড়িত অর্থ (টাকা)</label>
                <input class="form-control" id="jorito_ortho_poriman" type="text">
            </div>

            <div class="col-md-3">
                <label for="onucched_no" class="col-form-label">অনুচ্ছেদ নম্বর</label>
                <input class="form-control" id="onucched_no" type="text">
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
    <div id="load_apotti_list" class="table-responsive"></div>
</div>

@include('modules.audit_execution.audit_execution_archive_apotti.scripts.archive_scripts')

<script>
    $(function () {
        directorate_id = $('#directorate_id').val();
        Archive_Apotti_Common_Container.loadDirectorateWiseMinistry(directorate_id);
        var type = localStorage['report_type'] || '';
        if(type == 'project_based'){
            $('#plan_type').click();
        }
    });

    var Archive_Apotti_Container = {
        loadApottiList: function (page = 1, per_page = 10) {
            directorate_id = $("#directorate_id").val();
            doner_id = $("#doner_id").val();
            project_id = $("#project_id").val();
            ministry_id = $("#ministry_id").val();
            entity_id = $("#entity_id").val();
            cost_center_id = $("#cost_center_id").val();
            onucched_no = $("#onucched_no").val();
            fiscal_year_id = $("#fiscal_year_id").val();
            audit_year_start = $("#audit_year_start").val();
            audit_year_end = $("#audit_year_end").val();
            apotti_type = $("#apotti_type").val();
            jorito_ortho_poriman = $("#jorito_ortho_poriman").val();
            file_token_no = $("#file_token_no").val();
            memo_status = $("#memo_status").val();

            let url = '{{ route('audit.execution.apotti.search-list') }}';
            let data = {
                directorate_id,
                doner_id,
                project_id,
                ministry_id,
                entity_id,
                cost_center_id,
                onucched_no,
                fiscal_year_id,
                audit_year_start,
                audit_year_end,
                apotti_type,
                jorito_ortho_poriman,
                file_token_no,
                memo_status,
                page,
                per_page
            };

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('#load_apotti_list').html(response);
                }
            });
        },

        loadApottiEditForm: function (elem) {
            apotti_item_id = elem.data('apotti-item-id');
            directorate_id = $('#directorate_id').val();
            let url = '{{ route('audit.execution.apotti.search-edit') }}';
            let data = {apotti_item_id, directorate_id};
            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary'
            });
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.warning(response.data);
                } else {
                    $('#kt_content').html(response);
                }
            });
        },

        showApotti: function (element) {
            url = '{{route('audit.execution.apotti.get-doner-wise-project')}}';
            directorate_id = $("#directorate_id").val();
            apotti_id = element.data('apotti-id');
            data = {directorate_id, apotti_id};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.warning(response.data);
                } else {
                    $('#kt_content').html(response);
                }
            });
        },

        paginate: function (elem) {
            page = $(elem).attr('data-page');
            per_page = $(elem).attr('data-per-page');
            Archive_Apotti_Container.loadApottiList(page, per_page);
        },

        laadDonerWiseProject: function (element) {
            url = '{{route('audit.execution.apotti.get-doner-wise-project')}}';

            directorate_id = $("#directorate_id").val();
            doner_id = $("#doner_id").val();
            ministry_id = $("#ministry_id").val();
            data = {directorate_id, doner_id, ministry_id};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.warning(response.data);
                } else {
                    $('#project_id').html(response);
                }
            });
        },

        loadMinistryWisePrjectAndDoner: function (element) {
            url = '{{route('audit.execution.apotti.get-ministry-wise-project-and-doner')}}';

            directorate_id = $("#directorate_id").val();
            ministry_id = $("#ministry_id").val();

            doner_id = $("#doner_id").val();
            data = {directorate_id, ministry_id};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.warning(response.data);
                } else {
                    $('#doner_id').html(response);
                }
            });
        },

        laadMinisryWiseProject: function (element) {
            url = '{{route('audit.execution.apotti.get-ministry-wise-project')}}';

            directorate_id = $("#directorate_id").val();
            ministry_id = $("#ministry_id").val();
            data = {directorate_id, ministry_id};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.warning(response.data);
                } else {
                    $('#project_id').html(response);
                }
            });
        },
    };


    //ministry
    $('#directorate_id').change(function () {
        directorate_id = $('#directorate_id').val();
        Archive_Apotti_Common_Container.loadDirectorateWiseMinistry(directorate_id);
    });

    $('#doner_id').change(function () {
        doner_id = $('#doner_id').val();
        Archive_Apotti_Container.laadDonerWiseProject();
    });


    //entity
    $('#ministry_id').change(function () {
        ministry_id = $('#ministry_id').val();
        Archive_Apotti_Common_Container.loadMinistryWiseEntity(ministry_id);
        Archive_Apotti_Container.loadMinistryWisePrjectAndDoner();
        Archive_Apotti_Container.laadMinisryWiseProject();
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
        Archive_Apotti_Common_Container.loadOniyomerSubCategory(directorate_id, apotti_oniyomer_category_id);
    });

    $('#plan_type').click(function () {
        if($(this).is(':checked') == true){
            localStorage['report_type'] = 'project_based';
            Archive_Apotti_Container.loadMinistryWisePrjectAndDoner();
            Archive_Apotti_Container.laadMinisryWiseProject();
            $('#doner_div').show();
            $('#project_div').show();
        }else {
            $('#doner_div').hide();
            $('#project_div').hide();
        }
    });
</script>
