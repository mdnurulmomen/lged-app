<form>
    <div class="form-row">
        <div class="col-md-2 d-md-flex align-items-md-center">
            <p class="mb-0">Fiscal Year</p>
        </div>
        <div class="col-md-4 ">
            <select class="form-control select-select2" name="fiscal_year" id="select_fiscal_year_view_calendar">
                <option value="">Choose Fiscal Year</option>
                @foreach($fiscal_years as $fiscal_year)
                    <option value="{{$fiscal_year['id']}}">{{$fiscal_year['description']}}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>

<div class="row mt-5" id="load_view_calendar">

</div>

<script>
    $('#select_fiscal_year_view_calendar').change(function () {
        let fiscal_year_id = $('#select_fiscal_year_view_calendar').val();
        if (fiscal_year_id) {
            let url = '{{route('audit.plan.operational.calendar.view.load')}}';
            let data = {fiscal_year_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#load_view_calendar').html(response);
                }
            });
        } else {
            $('#load_view_calendar').html('');
        }
    });
</script>
