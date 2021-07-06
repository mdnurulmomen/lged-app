<form>
    <div class="form-row">
        <div class="col-md-2 d-md-flex align-items-md-center">
            <p class="mb-0">Fiscal Year</p>
        </div>
        <div class="col-md-4 ">
            <select data-container="{{$container}}" class="form-control select-select2" name="fiscal_year"
                    id="select_fiscal_year_component">
                <option value="">Choose Fiscal Year</option>
                <option value="2021-2022">2021-2022</option>
                @foreach($fiscalYears as $fiscalYear)
                    <option value="2021-2022">2021-2022</option>
                @endforeach
            </select>
        </div>
    </div>
</form>

<script>
    elem = $('#select_fiscal_year_component');
    elem.change(function () {
        let fiscal_year = elem.val();
        if (fiscal_year) {
            let url = '{{$url}}';
            if (url) {
                let data = {fiscal_year};
                ajaxCallAsyncCallback(url, data, 'html', 'post', function (response) {
                    $(`{{$container}}`).html(response);
                });
            } else {
                toastr.error('Sorry!')
            }
        } else {
            $(`{{$container}}`).html('');
        }
    });
</script>
