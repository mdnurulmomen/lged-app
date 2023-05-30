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

        downloadStrategicPlanList:  function (elem) {
            url = '{{route('audit.plan.strategy.download-year-wise-strategic-plan')}}';
            let strategic_plan_id = elem.data('strategic-plan-id');
            let strategic_plan_year = elem.data('strategic-plan-year');
            data = {strategic_plan_id, strategic_plan_year};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                message: 'Downloading Please Wait..',
                state: 'primary' // a bootstrap color
            });

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                xhrFields: {
                    responseType: 'blob'
                },
                success: function (response) {
                    KTApp.unblock('#kt_wrapper');
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "strategic_plan_(" + strategic_plan_year + ").pdf";
                    link.click();
                },
                error: function (blob) {
                    toastr.error('Failed to generate PDF.')
                    console.log(blob);
                }
            });;
        },
        deleteStrategicPlan: function (elem) {
            loaderStart('loading...')
            strategic_plan_id = elem.data('strategic-plan-id');
            strategic_plan_year = elem.data('strategic-plan-year');
            let url = '{{route('audit.plan.strategy.delete-strategic-plan')}}';
            let data = {strategic_plan_id,strategic_plan_year};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    Strategic_Plan_Container.loadStrategicPlanList();
                }
            });
        },
    };
</script>

