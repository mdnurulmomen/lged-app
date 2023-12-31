<x-title-wrapper>Operational Plans</x-title-wrapper>
<div class="card sna-card-border mt-3" style="margin-bottom:15px;">
    <form>
        <div class="form-row">
            <div class="col-md-3">
                <select class="form-control select-select2" name="fiscal_year" id="select_fiscal_year">
                    <option value="">Choose Fiscal Year</option>
                    @foreach($fiscal_years as $fiscal_year)
                        <option
                            value="{{$fiscal_year['id']}}" {{$fiscal_year['id']== $current_fiscal_year?'selected':''}}>{{$fiscal_year['description']}}</option>
                    @endforeach
                </select>
            </div>

            <div class="offset-6 col-md-3 text-right">
                <div class="btn-group mr-2">
                    <a tabindex="0" href="javascript:;" role="button"
                       onclick="summeryView()"
                       class="btn_summery_view btn btn-sm btn-square btn-success"><i class="fas fa-search-minus"></i>
                        <span>Summery View</span></a>
                    <a tabindex="0" href="javascript:;" role="button" onclick="detailView()"
                       class="btn_detailed_view btn btn-primary btn-sm btn-square btn-forward"
                       id="btn_detailed_view"><i class="fas fa-info-square"></i>Detailed View</a>
                </div>
            </div>
        </div>
    </form>
</div>

<div id="load_operational_plan_lists"></div>
<script>

    $(function (){
        summeryView();
    });

    $('#select_fiscal_year').change(function () {
        summeryView();
    });

    function detailView() {
        let fiscal_year = $('#select_fiscal_year').val();
        if (fiscal_year) {
            let url = '{{route('audit.plan.operational.plan.assigned.staff')}}';
            let data = {fiscal_year}
            ajaxCallAsyncCallback(url, data, 'html', 'post', function (response) {
                $('#load_operational_plan_lists').html('');
                $('#load_operational_plan_lists').html(response);
            });
        } else {
            $('#load_operational_plan_lists').html('');
            toastr.error('Please Choose Fiscal Year');
        }
    }

    function summeryView() {
        let fiscal_year = $('#select_fiscal_year').val();
        if (fiscal_year) {
            let url = '{{route('audit.plan.operational.plan.list.all')}}';
            let data = {fiscal_year};
            ajaxCallAsyncCallback(url, data, 'html', 'POST', function (response) {
                $('#load_operational_plan_lists').html('');
                $('#load_operational_plan_lists').html(response);
            });
        } else {
            $('#load_operational_plan_lists').html('');
            toastr.error('Please Choose Fiscal Year');
        }
    }
</script>
