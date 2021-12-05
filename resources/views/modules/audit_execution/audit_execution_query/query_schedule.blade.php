<x-title-wrapper>Audit Schedules</x-title-wrapper>

<div class="card card-custom card-stretch">
    <div class="card-body p-0">
        <div class="load-table-data" data-href="{{route('audit.execution.load-query-schedule-lists')}}"></div>
    </div>
</div>


<script>
    $(function () {
        loadData();
    });

    function loadData() {
        url = $(".load-table-data").data('href');
        var data = {};
        ajaxCallAsyncCallbackAPI(url, data, 'GET', function (resp) {
            if (resp.status === 'error') {
                toastr.error('no');
                console.log(resp.data)
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
            cost_center_id = elem.attr('data-cost-center-id');
            cost_center_name_en = elem.attr('data-cost-center-name-en');
            cost_center_name_bn = elem.attr('data-cost-center-name-bn');

            data = {schedule_id,cost_center_id, cost_center_name_en,
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
            cost_center_id = elem.data('cost-center-id');
            cost_center_name_bn = elem.data('cost-center-name-bn');
            audit_year_start = elem.data('audit-year-start');
            audit_year_end = elem.data('audit-year-end');

            data = {schedule_id, audit_plan_id, cost_center_id,cost_center_name_bn,audit_year_start,audit_year_end};
            let url = '{{route('audit.execution.memo.index')}}'
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#kt_content').html(response)
                }
            });
        },
    }
</script>

