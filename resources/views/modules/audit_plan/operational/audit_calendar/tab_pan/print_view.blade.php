<form>
    <div class="form-row">
        <div class="col-md-2 d-md-flex align-items-md-center">
            <p class="mb-0">Fiscal Year</p>
        </div>
        <div class="col-md-4 ">
            <select class="form-control select-select2" name="fiscal_year" id="select_fiscal_year_print_view">
                <option value="">Choose Fiscal Year</option>
                <option value="2021-2022">2021-2022</option>
            </select>
        </div>
    </div>
</form>


<div class="py-7" id="load_audit_calendar_print_view">

</div>

<div class="text-right">
    <button type="button" class="btn btn-success btn-square mr-2">
        <i class="fad fa-file-pdf"></i>
    </button>
</div>

<script>
    $('#select_fiscal_year_print_view').change(function () {
        let fiscal_year = $('#select_fiscal_year_print_view').val();
        if (fiscal_year) {
            let url = '{{route('audit.plan.operational.calendar.print.view.load')}}';
            let data = {fiscal_year};
            ajaxCallAsyncCallback(url, data, 'html', 'POST', function (response) {
                $('#load_audit_calendar_print_view').html(response);
            });
        } else {
            $('#load_audit_calendar_print_view').html('');
        }
    });
</script>
