<x-title-wrapper>Annual Plan Lists</x-title-wrapper>
<form>
    <div class="form-row">
        <div class="col-md-2 d-md-flex align-items-md-center">
            <p class="mb-0">Fiscal Year</p>
        </div>
        <div class="col-md-4 ">
            <select class="form-control select-select2" name="fiscal_year" id="select_fiscal_year_annual_plan">
                <option value="">Choose Fiscal Year</option>
                @foreach($fiscal_years as $fiscal_year)
                    <option value="{{$fiscal_year['id']}}">{{$fiscal_year['description']}}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>

<div class="px-3" id="load_auditable_plan_lists">

</div>

@include('scripts.script_generic')
<script>
    var Audit_Plan_Container = {
        loadAuditablePlanList: function (fiscal_year_id, page = 1, per_page = 10) {
            let url = '{{route('audit.plan.audit.plan.load-all-lists')}}';
            let data = {fiscal_year_id, page, per_page};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#load_auditable_plan_lists').html(response);
                }
            });
        },
    };

    $('#select_fiscal_year_annual_plan').change(function () {
        let fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
        if (fiscal_year_id) {
            Audit_Plan_Container.loadAuditablePlanList(fiscal_year_id);
        } else {
            $('#load_auditable_plan_lists').html('');
        }
    });
</script>
