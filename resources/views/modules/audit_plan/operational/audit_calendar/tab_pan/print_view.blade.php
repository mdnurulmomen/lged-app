<form>
    <div class="form-row">
        <div class="col-md-2 d-md-flex align-items-md-center">
            <p class="mb-0">Fiscal Year</p>
        </div>
        <div class="col-md-4 ">
            <select class="form-control select-select2" name="fiscal_year" id="select_fiscal_year_print_view">
                <option value="">Choose Fiscal Year</option>
                @foreach($fiscal_years as $fiscal_year)
                    <option value="{{$fiscal_year['id']}}">{{$fiscal_year['description']}}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>


<div class="py-7" id="load_audit_calendar_print_view">

</div>

<div class="text-right">
    <button id="download_pdf" type="button" class="btn btn-success btn-square mr-2">
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

    {{--$('#download_pdf').click(function () {--}}
    {{--    let fiscal_year = $('#select_fiscal_year_print_view').val();--}}
    {{--    if (fiscal_year) {--}}
    {{--        let url = '{{route('audit.plan.operational.calendar.pdf.view.load')}}';--}}
    {{--        let data = {fiscal_year};--}}
    {{--        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {--}}
    {{--            // $('#load_audit_calendar_print_view').html(response);--}}
    {{--            // window.open(response.full_path,'_blank' );--}}
    {{--        });--}}
    {{--    } else {--}}
    {{--        $('#load_audit_calendar_print_view').html('');--}}
    {{--    }--}}
    {{--});--}}

        $("#download_pdf").click(function(){


        let fiscal_year = $('#select_fiscal_year_print_view').val();

        $.ajax({

            type: 'GET',

            url: '{{route('audit.plan.operational.calendar.pdf.view.load')}}',

            data: {fiscal_year},

            xhrFields: {

                responseType: 'blob'

            },

            success: function(response){

                var blob = new Blob([response]);

                var link = document.createElement('a');

                link.href = window.URL.createObjectURL(blob);

                link.download = "audit_clander.pdf";

                link.click();

            },

            error: function(blob){

                console.log(blob);

            }

        });

    });

</script>
