<x-title-wrapper>Annual Plan List</x-title-wrapper>

<div class="card sna-card-border mt-3" style="margin-bottom:15px;">
    <div class="col-md-12 text-right">
        <button class="btn btn-sm btn-info btn-square mr-1" title="বিস্তারিত দেখুন"
                onclick='loadPage($(this))'
                data-url="{{route('audit.plan.yearly-plan.create')}}"
        >
            <i class="fad fa-plus"></i> Create
        </button>
    </div>
</div>

<div class="card sna-card-border mt-3" style="margin-bottom:30px;">
    <div class="table-responsive">
        <div class="load-yearly-plan"></div>
    </div>
</div>


<script>
    $(function () {
        Yearly_Plan_Container.loadYearlyPlanList();
    });
    var Yearly_Plan_Container = {
        loadYearlyPlanList: function () {
            let url = '{{route('audit.plan.yearly-plan.get-yearly-plan-list')}}';
            let data = {};
            ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('.load-yearly-plan').html(response);
                }
            });
        },
    };
</script>

