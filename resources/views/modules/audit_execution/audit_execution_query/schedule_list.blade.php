<x-title-wrapper>Fiscal Years</x-title-wrapper>
<div class="col-md-12">
    <div class="load-table-data" data-href="{{route('audit.execution.load-query-schedule-list')}}"></div>
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
    var calenderFunctions = {
        updateVisitCalenderStatus: function (schedule_id, status) {
            url = '{{route('calendar.update-visit-calender-status')}}';
            data = {schedule_id, status};
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'success') {
                    $('.fc-calendarListButton-button').trigger('click');
                    toastr.success(response.data);
                } else {
                    toastr.error(response.data);
                    console.log(response)
                }
            })
        }
    }
</script>
