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

            <div class="col-md-3">
                <label for="entity_id" class="col-form-label">এনটিটি</label>
                <select class="form-select select-select2" id="entity_id" name="entity_id">
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
        </div>
        <div class="mt-2 row">
            <div class="col-md-3">
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
            entity_id = $("#entity_id").val();
            year_from = $("#year_from").val();
            year_to = $("#year_to").val();
            let url = '{{route('audit.execution.archive-apotti-report.list')}}';
            let data = {directorate_id, ministry_id, entity_id, year_from, year_to, page, per_page};

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

        load_apotti_upload: function (elem){
            report_id = elem.data('report-id');
            let url = '{{route('audit.execution.archive-apotti-report.apotti-upload-page')}}';
            let data = {report_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data);
                    } else {
                        $('#kt_content').html(response);
                    }
                }
            );
        },

        load_report_details: function () {

        },

        store_report_apotti: function (){
            let url = '{{route('audit.execution.archive-apotti-report.apotti-store')}}';
            data = $('#apotti_create_form').serializeArray();
            //data = new FormData(document.getElementById("apotti_create_form"));

            directorate_name = $("#directorate_id option:selected").text();
            data.push({name: "directorate_name", value: directorate_name});

            ministry_name = $("#ministry_id option:selected").text();
            data.push({name: "ministry_name", value: ministry_name});

            entity_name = $("#entity_id option:selected").text();
            data.push({name: "entity_name", value: entity_name});

            parent_office_name = $("#unit_group_office_id option:selected").text();
            data.push({name: "parent_office_name", value: parent_office_name});

            cost_center_name = $("#cost_center_id option:selected").text();
            data.push({name: "cost_center_name", value: cost_center_name});

            $(".store-apotti-report").text('Loading....');

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_content');
                $(".store-apotti-report").hide();
                if (response.status === 'success') {
                    toastr.success(response.data);
                } else {
                    toastr.error(response.data);
                }
            },function (response) {
                KTApp.unblock('#kt_content');
                if (response.responseJSON.errors) {
                    $.each(response.responseJSON.errors, function (k, v) {
                        if (isArray(v)) {
                            $.each(v, function (n, m) {
                                toastr.error(m);
                            })
                        } else {
                            if (v !== '') {
                                toastr.error(v);
                            }
                        }
                    });
                }
            });
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

        loadMinistryWiseEntity: function (ministry_id) {
            let url = '{{route('audit.execution.archive-apotti.load-ministry-wise-entity')}}';
            let data = {ministry_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data);
                    } else {
                        $('#entity_id').html(response);
                    }
                }
            );
        },

        apotti_sync: function (elem) {
            report_id =  elem.data('report-id');
            let url = '{{route('audit.execution.archive-apotti-report.report-sync')}}';
            let data = {report_id};

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
    };


    //ministry
    $('#directorate_id').change(function () {
        directorate_id = $('#directorate_id').val();
        Archive_Apotti_Container.loadDirectorateWiseMinistry(directorate_id);
    });

    //entity
    $('#ministry_id').change(function() {
        ministry_id = $('#ministry_id').val();
        Archive_Apotti_Common_Container.loadMinistryWiseEntity(ministry_id);
    });
</script>
