<x-title-wrapper>Audi Report Search</x-title-wrapper>

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

            <div class="col-md-3">
                <label for="fiscal_year_id" class="col-form-label">আপত্তির অর্থবছর</label>
                <select class="form-select select-select2" id="fiscal_year_id">
                    <option value="">সবগুলো</option>
                    @foreach($fiscal_years as $fiscal_year)
                        <option value="{{$fiscal_year['id']}}">{{enTobn($fiscal_year['description'])}}</option>
                    @endforeach
                </select>
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
    <div id="load_final_report_list"></div>
</div>


<script>
    $(function () {
        directorate_id = $('#directorate_id').val();
        Final_Report_Search_Container.loadDirectorateWiseMinistry(directorate_id);
        Final_Report_Search_Container.loadFinalReportList();
    });

    var Final_Report_Search_Container = {
        loadFinalReportList: function (page = 1, per_page = 10) {
            directorate_id = $("#directorate_id").val();
            ministry_id = $("#ministry_id").val();
            entity_id = $("#entity_id").val();
            fiscal_year_id = $('#fiscal_year_id').val();
            let url = '{{route('audit.final-report.get-final-report-search-list')}}';
            let data = {directorate_id, ministry_id, entity_id, fiscal_year_id, page, per_page};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('#load_final_report_list').html(response);
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
