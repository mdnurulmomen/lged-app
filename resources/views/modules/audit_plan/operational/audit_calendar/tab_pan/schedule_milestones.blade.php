<form>
    <div class="form-row">
        <div class="col-md-2 d-md-flex align-items-md-center">
            <p class="mb-0">Fiscal Year</p>
        </div>
        <div class="col-md-4 ">
            <select class="form-control select-select2" name="fiscal_year" id="select_fiscal_year_schedule_milestone">
                <option value="">Choose Fiscal Year</option>
                <option value="2021-2022">2021-2022</option>
            </select>
        </div>
    </div>
</form>

<div class="row" id="load_schedule_milestones">

</div>

<script>
    $('#select_fiscal_year_schedule_milestone').change(function () {
        let fiscal_year = $('#select_fiscal_year_schedule_milestone').val();
        if (fiscal_year) {
            let url = '{{route('audit.plan.operational.calendar.milestone.load')}}';
            let data = {fiscal_year};
            ajaxCallAsyncCallback(url, data, 'html', 'POST', function (response) {
                $('#load_schedule_milestones').html(response);
            });
        } else {
            $('#load_schedule_milestones').html('');
        }
    });
</script>
