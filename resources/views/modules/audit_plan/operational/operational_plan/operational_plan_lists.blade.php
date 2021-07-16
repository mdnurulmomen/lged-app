<x-title-wrapper>Operational Plans</x-title-wrapper>
<div class="mt-4 px-4">
<form>
    <div class="form-row">
        <div class="col-md-2 d-md-flex align-items-md-center">
            <p class="mb-0">Fiscal Year</p>
        </div>
        <div class="col-md-4 ">
            <select class="form-control select-select2" name="fiscal_year" id="select_fiscal_year">
                <option value="">Choose Fiscal Year</option>
                @foreach($fiscal_years as $fiscal_year)
                    <option value="{{$fiscal_year['id']}}">{{$fiscal_year['description']}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 text-right">
            <div class="btn-group mr-2">
                <a tabindex="0" href="javascript:;" role="button"
                   class="btn_summery_view btn btn-sm btn-square btn-success"><i class="fa fa-plus"></i>
                    <span>Summery View</span></a>
                <a tabindex="0" href="javascript:;" role="button" onclick="detailView()"
                   class="btn_detailed_view btn btn-primary btn-sm btn-square btn-forward"
                   id="btn_detailed_view"><i class="fa fa-paper-plane"></i>Detailed View</a>
            </div>
        </div>
    </div>
</form>

<div class="px-3" id="load_operational_plan_lists">

</div>
</div>
<script>
    $('#select_fiscal_year').change(function () {
        let fiscal_year = $('#select_fiscal_year').val();
        if (fiscal_year) {
            let url = '{{route('audit.plan.operational.plan.list.all')}}';
            let data = {fiscal_year};
            ajaxCallAsyncCallback(url, data, 'html', 'POST', function (response) {
                $('#load_operational_plan_lists').html(response);
            });
        } else {
            $('#load_operational_plan_lists').html('');
        }
    });

    function detailView() {
        let url = '{{route('audit.plan.operational.plan.assigned.staff')}}';
        let fiscal_year = $('#select_fiscal_year').val();
        let data = {fiscal_year}
        ajaxCallAsyncCallback(url, data, 'html', 'post', function (response) {
            $('#kt_content').html();
            $('#kt_content').html(response);
        });
    }
</script>
