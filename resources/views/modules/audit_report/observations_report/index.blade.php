<x-title-wrapper>
    {{$memo_status == 'unsettled'?'অনিষ্পন্ন আপত্তির তালিকা':'নিস্পন্ন আপত্তির তালিকা'}}
</x-title-wrapper>

<div class="card sna-card-border d-flex flex-wrap flex-row">
    <div class="col-xl-12">
        <div class="row mt-2">
            <div class="col-md-3">
                <label for="directorate_id" class="col-form-label">অডিট ডিরেক্টরেট সমূহ</label>
                <select class="form-select select-select2" id="directorate_id">
                    @foreach ($directorates as $directorate)
                        <option value="{{ $directorate['office_id'] }}">
                            {{ $directorate['office_name_bn'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label for="ministry_id" class="col-form-label">মন্ত্রণালয়/বিভাগ</label>
                <select class="form-select select-select2" id="ministry_id">
                    <option value="">সবগুলো</option>
                </select>
            </div>

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
        </div>


        <div class="row mb-2">
            <div class="col-md-4">
                <label for="cost_center_id" class="col-form-label">কস্ট সেন্টার/ইউনিট</label>
                <select class="form-select select-select2" id="cost_center_id" name="cost_center_id">
                    <option value="">সবগুলো</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="fiscal_year_id" class="col-form-label">আপত্তির অর্থবছর</label>
                <select class="form-select select-select2" id="fiscal_year_id">
                    <option value="">সবগুলো</option>
                    @foreach($fiscal_years as $fiscal_year)
                        <option value="{{$fiscal_year['id']}}">{{enTobn($fiscal_year['description'])}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="audit_year_start" class="col-form-label">নিরীক্ষা বছর</label>
                <div class="input-group">
                    <input class="form-control year-picker" id="audit_year_start" name="audit_year_start"
                           placeholder="শুরু" type="text">
                    <input class="form-control year-picker" name="audit_year_end" placeholder="শেষ" type="text">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <label for="memo_type" class="col-form-label">আপত্তির ধরন</label>
                <select class="form-control select-select2" id="memo_type">
                    <option selected="selected" value="">আপত্তির ধরন</option>
                    <option value="sfi">এসএফআই</option>
                    <option value="non-sfi">নন-এসএফআই</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="jorito_ortho_poriman" class="col-form-label">জড়িত অর্থ (টাকা)</label>
                <input class="form-control" id="jorito_ortho_poriman" type="text">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label for="columns" class="col-form-label">কলাম</label>
                <select class="form-control select-select2" id="columns" multiple>
                    <option value="sl_no" selected>ক্রমিক নং</option>
                    <option value="id_no" selected>আইডি</option>
                    <option value="audit_unit" selected>অডিট ইউনিট</option>
                    <option value="fiscal_year" selected>অর্থবছর</option>
                    <option value="audit_year" selected>নিরীক্ষা বছর</option>
                    <option value="onucched_no" selected>অনুচ্ছেদ নম্বর</option>
                    <option value="apotti_title" selected>আপত্তির শিরোনাম</option>
                    <option value="jorito_ortho" selected>জড়িত অর্থ (টাকা)</option>
                    <option value="audit_type" selected>নিরীক্ষার ধরন</option>
                    <option value="memo_irregularity_type" selected>অনিয়মের ধরন</option>
                    <option value="apotti_current_status" selected>আপত্তির বর্তমান অবস্থা</option>
                    <option value="apotti_type" selected>আপত্তির ধরন</option>
                </select>
            </div>
        </div>

        <div class="row mt-2 mb-2">
            <div class="col-md-4">
                <button onclick="Observations_Report_Container.loadApottiList()" class="btn btn-sm btn-primary btn-square"
                    type="button">
                    <i class="fad fa-search"></i> অনুসন্ধান
                </button>

                <button onclick="Observations_Report_Container.downloadReport()" class="btn btn-sm btn-primary btn-square"
                        type="button">
                    <i class="fad fa-download"></i> ডাউনলোড
                </button>
            </div>
        </div>
    </div>
</div>


<div class="card sna-card-border mt-2 mb-15">
    <div id="load_apotti_list"></div>
</div>

@include('modules.audit_execution.audit_execution_archive_apotti.scripts.archive_scripts')

<script>
    $(function() {
        directorate_id = $('#directorate_id').val();
        Archive_Apotti_Common_Container.loadDirectorateWiseMinistry(directorate_id);
    });

    var Observations_Report_Container = {
        loadApottiList: function(page = 1, per_page = 10) {
            memo_status = '{{$memo_status}}';
            directorate_id = $("#directorate_id").val();
            ministry_id = $("#ministry_id").val();
            entity_id = $("#entity_id").val();
            cost_center_id = $("#cost_center_id").val();
            fiscal_year_id = $("#fiscal_year_id").val();
            audit_year_start = $("#audit_year_start").val();
            audit_year_end = $("#audit_year_end").val();
            memo_type = $("#memo_type").val();
            jorito_ortho_poriman = $("#jorito_ortho_poriman").val();
            columns = $("#columns").val();
            let url = '{{ route('audit.report.observations.get-status-wise.list') }}';
            let data = {
                memo_status,
                directorate_id,
                ministry_id,
                entity_id,
                cost_center_id,
                fiscal_year_id,
                audit_year_start,
                audit_year_end,
                memo_type,
                jorito_ortho_poriman,
                columns,
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

        downloadReport: function() {
            memo_status = '{{$memo_status}}';
            directorate_id = $("#directorate_id").val();
            directorate_name = $("#directorate_id option:selected").text();

            ministry_id = $("#ministry_id").val();
            ministry_name = $("#ministry_id option:selected").text();

            entity_id = $("#entity_id").val();
            entity_name = $("#entity_id option:selected").text();

            unit_group_office_id = $("#unit_group_office_id").val();
            unit_group_office_name = $("#unit_group_office_id option:selected").text();

            cost_center_id = $("#cost_center_id").val();

            fiscal_year_id = $("#fiscal_year_id").val();
            memo_type = $("#memo_type").val();
            jorito_ortho_poriman = $("#jorito_ortho_poriman").val();
            columns = $("#columns").val();

            let data = {
                memo_status,
                directorate_id,
                directorate_name,
                ministry_id,
                ministry_name,
                entity_id,
                entity_name,
                unit_group_office_id,
                unit_group_office_name,
                cost_center_id,
                fiscal_year_id,
                memo_type,
                jorito_ortho_poriman,
                columns
            };

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                message: 'ডাউনলোড হচ্ছে অপেক্ষা করুন...',
                state: 'primary' // a bootstrap color
            });


            let url = '{{ route('audit.report.observations.get-status-wise.download') }}';

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response) {
                    KTApp.unblock("#kt_wrapper");
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "unsettled_observations_report_" + new Date().toDateString().replace(/ /g,
                        "_") + ".pdf";
                    link.click();
                },
                error: function(blob) {
                    KTApp.unblock("#kt_wrapper");
                    toastr.error('Failed to generate PDF.');
                }
            });
        },


        showApotti: function (element) {
            url = '{{route('audit.execution.apotti.search-view')}}';
            directorate_id = $("#directorate_id").val();
            apotti_id = element.data('apotti-id');
            data = {directorate_id,apotti_id};

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

        paginate: function(elem) {
            page = $(elem).attr('data-page');
            per_page = $(elem).attr('data-per-page');
            Observations_Report_Container.loadApottiList(page, per_page);
        },
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
