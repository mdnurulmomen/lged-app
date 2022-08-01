<x-title-wrapper>Audit Schedules</x-title-wrapper>

<div class="card sna-card-border mt-3" style="margin-bottom:15px;">
    <div class="row">
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
    </div>
</div>

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
        Audit_Query_Schedule_Container.loadFiscalYearWiseActivity();
        loadData();
    });

    $('#select_fiscal_year_annual_plan').change(function () {
        Audit_Query_Schedule_Container.loadFiscalYearWiseActivity();
        loadData();
    });

    $('#activity_id').change(function () {
        loadData();
    });

    function loadData() {
        fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
        activity_id = $('#activity_id').val();

        url = $(".load-table-data").data('href');
        var data = {fiscal_year_id,activity_id};
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (resp) {
            if (resp.status === 'error') {
                toastr.error('no');
            } else {
                $(".load-table-data").html(resp);
            }
        });
    }
</script>
<script>
    var Audit_Query_Schedule_Container = {
        query: function (elem) {
            url = '{{route('audit.execution.query.index')}}';

            schedule_id = elem.attr('data-schedule-id');
            audit_plan_id = elem.attr('data-audit-plan-id');
            entity_id = elem.attr('data-entity-id');
            cost_center_id = elem.attr('data-cost-center-id');
            cost_center_name_en = elem.attr('data-cost-center-name-en');
            cost_center_name_bn = elem.attr('data-cost-center-name-bn');

            data = {schedule_id,audit_plan_id,entity_id,cost_center_id, cost_center_name_en,
                cost_center_name_bn};

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#kt_content').html(response);
                }
            })
        },

        memo: function (elem) {
            schedule_id = elem.data('schedule-id');
            audit_plan_id = elem.data('audit-plan-id');
            entity_id = elem.attr('data-entity-id');
            cost_center_id = elem.data('cost-center-id');
            cost_center_name_bn = elem.data('cost-center-name-bn');
            audit_year_start = elem.data('audit-year-start');
            audit_year_end = elem.data('audit-year-end');
            team_leader_name = elem.data('team-leader-name-bn');
            team_leader_designation_name = elem.data('team-leader-designation-name-bn');
            scope_sub_team_leader = elem.data('scope-sub-team-leader');
            sub_team_leader_name = elem.data('sub-team-leader-name-bn');
            sub_team_leader_designation_name = elem.data('sub-team-leader-designation-name-bn');

            data = {schedule_id, audit_plan_id, entity_id, cost_center_id,cost_center_name_bn,audit_year_start,
                audit_year_end,team_leader_name,team_leader_designation_name,scope_sub_team_leader,
                sub_team_leader_name,sub_team_leader_designation_name};
            let url = '{{route('audit.execution.memo.index')}}'
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#kt_content').html(response)
                }
            });
        },

        loadFiscalYearWiseActivity: function () {
            fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
            fiscal_year = $('#select_fiscal_year_annual_plan').select2('data')[0].text;
            if (fiscal_year_id) {
                let url = '{{route('audit.plan.annual.plan.revised.fiscal-year-wise-activity-select')}}';
                let data = {fiscal_year_id, fiscal_year};
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.error(response.data)
                    } else {
                        $('#activity_id').html(response);
                        setActivityAnonymously();
                        // alert(activity_id);
                        // $('#activity_id').val(7);
                        // Annual_Plan_Container.loadAnnualPlanList();
                    }
                });
            } else {
                $('#activity_id').html('');
            }
        },
    }
</script>

