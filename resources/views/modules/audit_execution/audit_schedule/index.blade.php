<x-title-wrapper>Audit Schedules</x-title-wrapper>

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
        loadData();
    });

    function loadData() {
        url = $(".load-table-data").data('href');
        var data = {};
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
    }
</script>

