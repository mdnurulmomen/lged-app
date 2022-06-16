<x-title-wrapper>Audit Plan List</x-title-wrapper>

<div class="card sna-card-border d-flex flex-wrap flex-row">
    <div class="col-xl-12">
        <select class="form-control select-select2" name="fiscal_year" id="select_fiscal_year_annual_plan">
            <option value="">--সিলেক্ট--</option>
            @foreach($fiscal_years as $fiscal_year)
                <option
                    value="{{$fiscal_year['id']}}" {{now()->year == $fiscal_year['end']?'selected':''}}>{{$fiscal_year['description']}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="card sna-card-border mt-2 mb-14">
    <div class="load-plan-list">
        <div class="d-flex align-items-center">
            <div class="spinner-grow text-warning mr-3" role="status">
                <span class="sr-only"></span>
            </div>
            <div>
                loading.....
            </div>
        </div>
    </div>
</div>


<script>
    $(function () {
        AIR_Container.loadAuditPlanList();
    });

    $('#select_fiscal_year_annual_plan').change(function () {
        AIR_Container.loadAuditPlanList();
    });

    var AIR_Container = {
        loadAuditPlanList: function (page = 1, per_page = 500) {
            let air_type = '{{$air_type}}';
            let fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
            if (fiscal_year_id) {
                let url = '{{route('audit.report.air.load-approved-plan-list')}}';
                let data = {air_type, fiscal_year_id, page, per_page};
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.error(response.data);
                    } else {
                        $('.load-plan-list').html(response);
                    }
                });
            }
            else {
                $('.load-plan-list').html('');
            }
        },

        loadAIRCreate: function (elem) {
            url = '{{route('audit.report.air.create')}}';
            air_type = '{{$air_type}}';
            fiscal_year_id = elem.data('fiscal-year-id');
            fiscal_year_start = elem.data('fiscal-year-start');
            fiscal_year_end = elem.data('fiscal-year-end');
            activity_id = elem.data('activity-id');
            annual_plan_id = elem.data('annual-plan-id');
            audit_plan_id = elem.data('audit-plan-id');
            audit_plan_entities = elem.data('audit-plan-entities');
            audit_plan_entity_info = elem.data('audit-plan-entity-info');

            data = {air_type,fiscal_year_id,fiscal_year_start,fiscal_year_end,activity_id,annual_plan_id, audit_plan_id,audit_plan_entities,audit_plan_entity_info};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    var newDoc = document.open("text/html", "replace");
                    newDoc.write(response);
                    newDoc.close();
                }
            })
        },


        loadAIRShow: function (elem) {
            url = '{{route('audit.report.air.show')}}';
            fiscal_year_id = elem.data('fiscal-year-id');
            activity_id = elem.data('activity-id');
            annual_plan_id = elem.data('annual-plan-id');
            audit_plan_id = elem.data('audit-plan-id');
            audit_plan_entities = elem.data('audit-plan-entities');
            air_report_id = elem.data('air-report-id');

            data = {fiscal_year_id,activity_id,annual_plan_id, audit_plan_id,audit_plan_entities, air_report_id};


            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('এআইআর');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '70%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },

        loadAIREdit: function (elem) {
            url = '{{route('audit.report.air.edit')}}';
            air_report_id = elem.data('air-report-id');
            audit_plan_entities = elem.data('audit-plan-entities');
            data = {air_report_id,audit_plan_entities};
            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    var newDoc = document.open("text/html", "replace");
                    newDoc.write(response);
                    newDoc.close();
                }
            })
        },
    }
</script>

