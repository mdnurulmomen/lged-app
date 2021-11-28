<x-title-wrapper>Annual Plan Calender</x-title-wrapper>
<form class="pl-4 pt-4">
    <div class="form-row">
        <div class="col-md-4 ">
            <label>Select Fiscal Year</label>
            <select class="form-control select-select2" name="fiscal_year" id="select_fiscal_year_annual_plan">
                <option value="">Choose Fiscal Year</option>
                @foreach($fiscal_years as $fiscal_year)
                    <option
                        value="{{$fiscal_year['id']}}" {{now()->year == $fiscal_year['start']?'selected':''}}>{{$fiscal_year['description']}}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>

<div class="px-3 py-3" id="load_annual_plan_lists">

</div>

@include('scripts.script_generic')
<script>
    $(function (){
        fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
        Annual_Plan_Calender.loadAnnualPlanList(fiscal_year_id);
    });
    var Annual_Plan_Calender = {
        loadAnnualPlanList: function (fiscal_year_id) {
            let url = '{{route('audit.plan.annual.plan.list.all')}}';
            let data = {fiscal_year_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#load_annual_plan_lists').html(response);
                }
            });
        },
    };

    $('#select_fiscal_year_annual_plan').change(function () {
        let fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
        if (fiscal_year_id) {
            Annual_Plan_Calender.loadAnnualPlanList(fiscal_year_id);
        } else {
            $('#load_annual_plan_lists').html('');
        }
    });
</script>
