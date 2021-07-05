<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="select_fiscal_year" class="col-form-label">Fiscal Year</label>
            <select class="form-control select-select2" name="fiscal_year" id="select_fiscal_year">
                <option value="">Choose Fiscal Year</option>
                <option value="2021-2022">2021-2022</option>
            </select>
        </div>
    </div>
</div>

<div class="row" id="load_schedule_milestones">

</div>

<script>
    $('#select_fiscal_year').change(function () {
        let fiscal_year = $('#select_fiscal_year').val();
        if (fiscal_year) {
            let url = '{{route('audit.plan.operational.calendar.load.milestone')}}';
            let data = {fiscal_year};
            ajaxCallAsyncCallback(url, data, 'html', 'POST', function (response) {
                $('#load_schedule_milestones').html(response);
            });
        } else {
            $('#load_schedule_milestones').html('');
        }
    });
</script>
