<x-title-wrapper>Strategic Plan List</x-title-wrapper>

<div class="card sna-card-border mt-3" style="margin-bottom:15px;">
    <div class="col-md-12 text-right">
        <button class="btn btn-sm btn-info btn-square mr-1" title="বিস্তারিত দেখুন"
                onclick='loadPage($(this))'
                data-url="{{route('audit.plan.strategy.create')}}"
        >
            <i class="fad fa-plus"></i> Create
        </button>
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
            loaderStart('loading...')
            let url = '{{route('audit.plan.strategy.get-strategic-plan-list')}}';
            let data = {};
            ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
                loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('.load-strategic-plan').html(response);
                }
            });
        },
    };
</script>

