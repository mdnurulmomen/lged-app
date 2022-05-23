<x-title-wrapper>Apotti Report List</x-title-wrapper>

<div class="card sna-card-border d-flex flex-wrap flex-row">
    <div class="col-xl-12 text-right">
        <a class="btn btn-primary btn-sm btn-bold btn-square" href="javascript:;"
           onclick="Archive_Apotti_Report_Container.load_apotti_repot_upload()">
            <i class="far fa-plus mr-1"></i> আপত্তি রিপোর্ট আপলোড করুন
        </a>
    </div>
</div>

<div class="card sna-card-border d-flex flex-wrap flex-row">
    <div class="col-xl-12">
        <div class="row mt-2">
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

            <div class="col-md-2">
                <label for="audit_year_start" class="col-form-label">আপত্তির অর্থবছর</label>
                <div class="input-group">
                    <input class="form-control year-picker" name="year_from" placeholder="শুরু" type="text">
                    <input class="form-control year-picker" name="year_to" placeholder="শেষ" type="text">
                </div>
            </div>

            <div class="mt-12 col-md-3">
                <button onclick="Archive_Apotti_Report_Container.load_apotti_report_list()"
                        class="btn btn-sm btn-primary btn-square" type="button">
                    <i class="fad fa-search"></i> অনুসন্ধান
                </button>
            </div>
        </div>
    </div>
</div>


<div class="card sna-card-border mt-2 mb-15">
    <div id="load_apotti_list"></div>
</div>


<script>
    $(function () {
        directorate_id = $('#directorate_id').val();
        Archive_Apotti_Report_Container.loadDirectorateWiseMinistry(directorate_id);
        Archive_Apotti_Report_Container.load_apotti_report_list();
    });

    var Archive_Apotti_Report_Container = {
        load_apotti_report_list: function (page = 1, per_page = 10) {
            directorate_id = $("#directorate_id").val();
            ministry_id = $("#ministry_id").val();
            year_from = $("#year_from").val();
            year_to = $("#year_to").val();
            let url = '{{route('audit.execution.archive-apotti-report.list')}}';
            let data = {directorate_id, ministry_id, year_from, year_to, page, per_page};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('#load_apotti_list').html(response);
                }
            });
        },

        load_apotti_repot_upload: function (){
            let url = '{{route('audit.execution.archive-apotti-report.create')}}';
            let data = {};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data);
                    } else {
                        $('#kt_content').html(response);
                    }
                }
            );
        },

        loadDirectorateWiseMinistry: function (directorate_id,ministry_id='') {
            let url = '{{route('audit.execution.archive-apotti.load-directorate-wise-ministry')}}';
            let data = {directorate_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data);
                    } else {
                        $('#ministry_id').html(response);
                        if (ministry_id != ""){
                            $("#ministry_id").val(ministry_id).trigger('change');
                        }
                    }
                }
            );
        },

        loadMinistryWiseEntity: function (ministry_id,entity_id='') {
            let url = '{{route('audit.execution.archive-apotti.load-ministry-wise-entity')}}';
            let data = {ministry_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data);
                    } else {
                        $('#entity_id').html(response);
                        if (entity_id != ""){
                            $("#entity_id").val(entity_id).trigger('change');
                        }
                    }
                }
            );
        },

        loadEntityWiseUnitGroupOffice: function (entity_id,parent_office_id='') {
            let url = '{{route('audit.execution.archive-apotti.load-entity-wise-unit-group-office')}}';
            let data = {entity_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data);
                    } else {
                        $('#unit_group_office_id').html(response);
                        if (parent_office_id != ""){
                            $("#unit_group_office_id").val(parent_office_id).trigger('change');
                        }
                    }
                }
            );
        },

        loadEntityOrUnitGroupWiseCostCenter: function (parent_office_id,cost_center_id='') {
            let url = '{{route('audit.execution.archive-apotti.load-entity-or-unit-group-wise-cost-center')}}';
            let data = {parent_office_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data);
                    } else {
                        $('#cost_center_id').html(response);
                        if (cost_center_id != ""){
                            $("#cost_center_id").val(cost_center_id).trigger('change');
                        }
                    }
                }
            );
        },

        loadOniyomerSubCategory: function (directorate_id,apotti_oniyomer_category_id,apotti_oniyomer_category_child_id="") {
            let url = '{{route('audit.execution.archive-apotti.load-oniyomer-sub-category-list')}}';
            let data = {directorate_id,apotti_oniyomer_category_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data);
                    } else {
                        $('#apotti_oniyomer_category_child_id').html(response);
                        if (apotti_oniyomer_category_child_id != ""){
                            $("#apotti_oniyomer_category_child_id").val(apotti_oniyomer_category_child_id).trigger('change');
                        }
                    }
                }
            );
        },

        loadApottiEditForm: function (elem){
            apotti_id = elem.data('apotti-id');
            let url = '{{route('audit.execution.archive-apotti.edit')}}';
            let data = {apotti_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data);
                    } else {
                        $('#kt_content').html(response);
                    }
                }
            );
        },

        loadApottiDetails: function (elem){
            apotti_id = elem.data('apotti-id');
            let url = '{{route('audit.execution.archive-apotti.view')}}';
            let data = {apotti_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data);
                    } else {
                        $('#kt_content').html(response);
                    }
                }
            );
        },
    };


    //ministry
    $('#directorate_id').change(function () {
        directorate_id = $('#directorate_id').val();
        Archive_Apotti_Container.loadDirectorateWiseMinistry(directorate_id);
    });

    //entity
    $('#ministry_id').change(function () {
        ministry_id = $('#ministry_id').val();
        Archive_Apotti_Container.loadMinistryWiseEntity(ministry_id);
    });

    //unit group & cost center
    $('#entity_id').change(function () {
        entity_id = $('#entity_id').val();
        Archive_Apotti_Container.loadEntityWiseUnitGroupOffice(entity_id);
        Archive_Apotti_Container.loadEntityOrUnitGroupWiseCostCenter(entity_id);
    });

    //cost center
    $('#unit_group_office_id').change(function () {
        unit_group_office_id = $('#unit_group_office_id').val();
        Archive_Apotti_Container.loadEntityOrUnitGroupWiseCostCenter(unit_group_office_id);
    });

    //sub category
    $('#apotti_oniyomer_category_id').change(function () {
        directorate_id = $('#directorate_id').val();
        apotti_oniyomer_category_id = $('#apotti_oniyomer_category_id').val();
        Archive_Apotti_Container.loadOniyomerSubCategory(directorate_id,apotti_oniyomer_category_id);
    });
</script>
