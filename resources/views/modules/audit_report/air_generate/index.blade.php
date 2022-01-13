<x-title-wrapper>Audit Plan List</x-title-wrapper>

<div class="table-search-header-wrapper pt-3 pb-3">
    <div class="col-xl-12">
        <form>
            <div class="m-0 form-group row">
                <label for="select_fiscal_year_annual_plan" class="col-sm-1 col-form-label font-size-1-1">অর্থ বছর</label>
                <div class="col-sm-11">
                    <select class="form-control select-select2" name="fiscal_year" id="select_fiscal_year_annual_plan">
                        <option value="">--সিলেক্ট--</option>
                        @foreach($fiscal_years as $fiscal_year)
                            <option
                                value="{{$fiscal_year['id']}}" {{now()->year == $fiscal_year['end']?'selected':''}}>{{$fiscal_year['description']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card card-custom card-stretch">
    <div class="card-body p-0">
        <div class="load-office-orders"></div>
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
        loadAuditPlanList: function (page = 1, per_page = 200) {
            let air_type = '{{$air_type}}';
            let fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
            if (fiscal_year_id) {
                let url = '{{route('audit.report.air.load-approved-plan-list')}}';
                let data = {air_type, fiscal_year_id, page, per_page};
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.error(response.data);
                    } else {
                        $('.load-office-orders').html(response);
                    }
                });
            }
            else {
                $('.load-office-orders').html('');
            }
        },

        loadAIRCreate: function (elem) {
            url = '{{route('audit.report.air.create')}}';
            air_type = '{{$air_type}}';
            fiscal_year_id = elem.data('fiscal-year-id');
            activity_id = elem.data('activity-id');
            annual_plan_id = elem.data('annual-plan-id');
            audit_plan_id = elem.data('audit-plan-id');
            audit_plan_entities = elem.data('audit-plan-entities');

            data = {air_type,fiscal_year_id,activity_id,annual_plan_id, audit_plan_id,audit_plan_entities};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
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


            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
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
            data = {air_report_id};
            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
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

