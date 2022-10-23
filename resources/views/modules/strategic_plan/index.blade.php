<x-title-wrapper>Strategic Plan List</x-title-wrapper>

<div class="card sna-card-border mt-3" style="margin-bottom:15px;">
    <div class="d-flex justify-content-end">
        <a class="btn btn-success btn-sm btn-bold btn-square" onclick='loadPage($(this))'
           data-url="{{route('audit.plan.strategy.sp_file_upload')}}" href="javascript:;">
            <i class="far fa-plus mr-1"></i> Create Strategic Plan
        </a>
    </div>
</div>

<div class="card sna-card-border mt-3" style="margin-bottom:30px;">
    <div class="table-responsive">
        <div class="load-strategic-plan"></div>
    </div>
</div>


<script>
    $(function () {
        Strategic_Plan_Container.loadStrategicPlanList();
    });
    var Strategic_Plan_Container = {
        loadStrategicPlanList: function () {
            let url = '{{route('audit.plan.annual.plan.revised.list.all')}}';
            let data = {fiscal_year_id, fiscal_year};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('.load-strategic-plan').html(response);
                }
            });
        },
    };
</script>

