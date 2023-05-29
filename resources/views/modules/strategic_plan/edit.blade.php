<div class="row m-0 mb-2 page-title-wrapper d-md-flex align-items-md-center">
    <div class="col-md-6">
      <div class="title py-2">
         <h4 class="mb-0 font-weight-bold"><i class="fas fa-list mr-3"></i>Create Strategic Plan</h4>
      </div>
    </div>

    <div class="col-md-6 text-right">
        <a onclick="Strategic_Plan_Create_Container.backToList()" class="btn btn-sm btn-warning btn_back btn-square mr-3">
            <i class="fad fa-arrow-alt-left"></i> Go Back
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card sna-card-border">
            <div class="row">
                <div class="col-4">
                    <select class="form-control select-select2" name="strategic_plan_year" id="strategic_plan_year">
                            <option value="{{$data['strategic_plan_id']}}">{{$data['strategic_plan_year']}}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-14">
    <div class="col-12">
        <div class="load-year-wise-plan"></div>
    </div>
</div>
@include('modules.strategic_plan.partial.strategic_plan_common_script')
<script>

    $(function () {
        Strategic_Plan_Create_Container.loadYearWiseStrategicPlan();
    });

    var Strategic_Plan_Create_Container = {
        loadYearWiseStrategicPlan: function () {
            loaderStart('loading...')
            strategic_plan_year = $('#strategic_plan_year').find(':selected').text();
            strategic_plan_year_id = $('#strategic_plan_year').find(':selected').val();
            let url = '{{route('audit.plan.strategy.get-year-wise-strategic-plan')}}';
            scop = 'edit';
            let data = {strategic_plan_year,scop,strategic_plan_year_id};
            ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
                loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('.load-year-wise-plan').html(response);
                }
            });
        },

        backToList: function () {
            $('.strategic_plan_link a').click();
        }
    };
</script>
