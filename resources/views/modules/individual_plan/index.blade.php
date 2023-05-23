<x-title-wrapper>Create Individual Plan</x-title-wrapper>

<div class="row">
    <div class="col-12">
        <div class="card sna-card-border">
            <div class="row">
                <div class="col-4">
                    <select class="form-control select-select2" name="strategic_plan_year" id="strategic_plan_year">
                        <option selected value="">--select--</option>
                        @foreach($individual_strategic_plan_year as $year)
                            <option data-strategic-plan="{{$year['strategic_plan_id']}}" value="{{$year['strategic_plan_year']}}">{{$year['strategic_plan_year']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card sna-card-border mt-2 strategic_year">
    <div class="load-year-wise-plan"></div>
</div>

</div>

<script>
    var individual_yearly_plan_data = '{!! session('individual_yearly_plan_filter') !!}';
    if(individual_yearly_plan_data != ""){
        filter_data = JSON.parse(individual_yearly_plan_data);
        console.log(filter_data)
        $("#strategic_plan_year").attr("selected", "true").val(filter_data.strategic_plan_year);
        $(function(){
            Yearly_Plan_Container.loadYearWiseStrategicPlan();
        })
    }else{
        $('#strategic_plan_year').change(function () {
            Yearly_Plan_Container.loadYearWiseStrategicPlan();
        });
    }

    var Yearly_Plan_Container = {
        loadYearWiseStrategicPlan: function () {
            loaderStart('loading...');
            strategic_plan_year = $('#strategic_plan_year').find(':selected').text();
            let url = '{{route('audit.plan.individual.get-yearly-plan')}}';
            let data = {strategic_plan_year};
            ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
                loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('.load-year-wise-plan').html(response);
                }
            });
        },
    };
</script>
