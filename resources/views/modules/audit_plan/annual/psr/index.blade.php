<x-title-wrapper>Preliminary Survey Report</x-title-wrapper>
<form>
    <div class="form-row">
        <div class="col-sm-4">
            <label for="select_fiscal_year_annual_plan" class="col-form-label font-size-h4">অর্থ বছর</label>
            <select class="form-control select-select2" name="fiscal_year" id="select_fiscal_year_annual_plan">
                <option value="">--সিলেক্ট--</option>
                @foreach($fiscal_years as $fiscal_year)
                    <option
                        value="{{$fiscal_year['id']}}" {{now()->year == $fiscal_year['end']?'selected':''}}>{{$fiscal_year['description']}}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>

<div class="px-3 py-3" id="load_psr">

</div>

{{--@include('scripts.script_generic')--}}
<script>
    $(function () {
        Psr_Container.loadPsr();
    });
    var Psr_Container = {
        loadPsr: function () {
            fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
            let url = '{{route('audit.plan.annual.psr.load-psr')}}';
            let data = {fiscal_year_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#load_psr').html(response);
                }
            });
        },
    };

    // $('#select_fiscal_year_annual_plan').change(function () {
    //     let fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
    //     if (fiscal_year_id) {
    //         Annual_Plan_Container.loadAnnualPlanList(fiscal_year_id);
    //     } else {
    //         $('#load_annual_plan_lists').html('');
    //     }
    // });
</script>
