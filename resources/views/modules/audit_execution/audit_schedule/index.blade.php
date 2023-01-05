<x-title-wrapper>Audit Schedules</x-title-wrapper>

<!-- <div class="card sna-card-border mt-3" style="margin-bottom:15px;">
    <div class="row">
        <div class="col-md-3">
            <select class="form-select select-select2" id="directorate_filter">
                @if (count($directorates) > 1)
                    <option value="all">Select Directorate</option>
                @endif
                @foreach ($directorates as $directorate)
                    <option value="{{ $directorate['office_id'] }}">{{ $directorate['office_name_bn'] }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-control select-select2" name="fiscal_year" id="select_fiscal_year_annual_plan">
                <option value="">--সিলেক্ট--</option>
                @foreach($fiscal_years as $fiscal_year)
                    <option
                        value="{{$fiscal_year['id']}}" {{$current_fiscal_year == $fiscal_year['id']?'selected':''}}>{{$fiscal_year['description']}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-control select-select2" id="activity_id">
                <option value="">--সিলেক্ট--</option>
            </select>
        </div>

        <div class="col-md-3">
            <select class="form-select select-select2" id="audit_plan_id">
                <option value="">প্ল্যান বাছাই করুন</option>
            </select>
        </div>
    </div>
</div> -->

<div class="card sna-card-border mt-2 mb-15">
    <div class="load-table-data" data-href="{{route('audit.execution.load-audit-schedule-list')}}">
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
        // Audit_Query_Schedule_Container.loadFiscalYearWiseActivity();
        Audit_Query_Schedule_Container.loadData();
    });

    $('#select_fiscal_year_annual_plan').change(function () {
        Audit_Query_Schedule_Container.loadFiscalYearWiseActivity();
        Audit_Query_Schedule_Container.loadData();
    });

    $('#activity_id').change(function () {
        Audit_Query_Schedule_Container.loadActivityWiseAuditPlan();
        Audit_Query_Schedule_Container.loadData();
    });

    $('#audit_plan_id').change(function (){
        Audit_Query_Schedule_Container.loadData();
    });

    var Audit_Query_Schedule_Container = {
        loadData: function (page = 1, per_page = 200){
            fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
            activity_id = $('#activity_id').val();
            audit_plan_id = $('#audit_plan_id').val();

            url = $(".load-table-data").data('href');
            var data = {page,per_page,fiscal_year_id,activity_id,audit_plan_id};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (resp) {
                KTApp.unblock("#kt_wrapper");
                if (resp.status === 'error') {
                    toastr.error('no');
                } else {
                    $(".load-table-data").html(resp);
                }
            });
        },

        // query: function (elem) {
        //     url = '{{route('audit.execution.query.index')}}';

        //     schedule_id = elem.attr('data-schedule-id');
        //     team_id = elem.attr('data-team-id');
        //     audit_plan_id = elem.attr('data-audit-plan-id');
        //     entity_id = elem.attr('data-entity-id');
        //     cost_center_id = elem.attr('data-cost-center-id');
        //     cost_center_name_en = elem.attr('data-cost-center-name-en');
        //     cost_center_name_bn = elem.attr('data-cost-center-name-bn');
        //     project_name_bn = elem.attr('data-project-name-bn');
        //     project_name_en = elem.attr('data-project-name-en');

        //     KTApp.block('#kt_wrapper', {
        //         opacity: 0.1,
        //         state: 'primary' // a bootstrap color
        //     });

        //     data = {schedule_id,team_id,audit_plan_id,entity_id,cost_center_id,cost_center_name_en,cost_center_name_bn,project_name_bn,project_name_en};

        //     ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
        //         KTApp.unblock('#kt_wrapper');
        //         if (response.status === 'error') {
        //             toastr.error(response.data)
        //         } else {
        //             $('#kt_content').html(response);
        //         }
        //     })
        // },

        program: function (elem) {
            url = '{{route('audit.plan.program.index')}}';

            type = elem.attr('data-type');
            schedule_id = elem.attr('data-schedule-id');
            team_id = elem.attr('data-team-id');
            audit_plan_id = elem.attr('data-audit-plan-id');
            yearly_plan_location_id = elem.attr('data-yearly-plan-location-id');
            project_id = elem.attr('data-project-id');
            project_name_en = elem.attr('data-project-name-en');
            project_name_bn = elem.attr('data-project-name-bn');
            cost_center_id = elem.attr('data-cost-center-id');
            cost_center_name_en = elem.attr('data-cost-center-name-en');
            cost_center_name_bn = elem.attr('data-cost-center-name-bn');

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            data = {type,schedule_id,team_id,audit_plan_id,yearly_plan_location_id,project_id,cost_center_id,cost_center_name_en,cost_center_name_bn,project_name_en,project_name_bn};
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#kt_content').html(response);
                }
            })
        },

        memo: function (elem) {
            schedule_id = elem.data('schedule-id');
            team_id = elem.data('team-id');
            audit_plan_id = elem.data('audit-plan-id');
            entity_id = elem.attr('data-entity-id');
            cost_center_id = elem.data('cost-center-id');
            cost_center_name_bn = elem.data('cost-center-name-bn');
            cost_center_name_en = elem.data('cost-center-name-en');
            audit_year_start = elem.data('audit-year-start');
            audit_year_end = elem.data('audit-year-end');
            project_name_bn = elem.data('project-name-bn');
            project_name_en = elem.data('project-name-en');

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            data = {schedule_id, team_id, audit_plan_id, entity_id, cost_center_id,cost_center_name_bn,cost_center_name_en,audit_year_start,
                audit_year_end,project_name_bn,project_name_en};

            let url = '{{route('audit.execution.memo.index')}}';

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#kt_content').html(response)
                }
            });
        },

        // loadFiscalYearWiseActivity: function () {
        //     fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
        //     fiscal_year = $('#select_fiscal_year_annual_plan').select2('data')[0].text;
        //     if (fiscal_year_id) {
        //         let url = '{{route('audit.plan.annual.plan.revised.fiscal-year-wise-activity-select')}}';
        //         let data = {fiscal_year_id, fiscal_year};
        //         ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
        //             if (response.status === 'error') {
        //                 toastr.error(response.data)
        //             } else {
        //                 $('#activity_id').html(response);
        //                 setActivityAnonymously();
        //                 // alert(activity_id);
        //                 // $('#activity_id').val(7);
        //                 // Annual_Plan_Container.loadAnnualPlanList();
        //             }
        //         });
        //     } else {
        //         $('#activity_id').html('');
        //     }
        // },

        // loadActivityWiseAuditPlan: function () {

        //     office_id = $('#directorate_filter').val();
        //     activity_id = $('#activity_id').val();
        //     fiscal_year_id = $('#select_fiscal_year_annual_plan').val();

        //     let url = '{{route('audit.plan.operational.activity.audit-plan')}}';

        //     let data = {fiscal_year_id,activity_id,office_id};

        //     KTApp.block('#kt_wrapper', {
        //         opacity: 0.1,
        //         state: 'primary' // a bootstrap color
        //     });

        //     ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
        //             KTApp.unblock('#kt_wrapper');
        //             if (response.status === 'error') {
        //                 toastr.warning(response.data)
        //             } else {
        //                 $('#audit_plan_id').html(response);
        //             }
        //         }
        //     );
        // },

        paginate: function(elem) {
            page = $(elem).attr('data-page');
            per_page = $(elem).attr('data-per-page');
            Audit_Query_Schedule_Container.loadData(page, per_page);
        },
    }
</script>

