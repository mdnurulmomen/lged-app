<x-title-wrapper>Approve Plan List</x-title-wrapper>
<form class="pl-4 pt-4">
    <div class="form-row">
        <div class="col-md-4 ">
            <label>Fiscal Year</label>
            <select class="form-control select-select2" name="fiscal_year" id="select_fiscal_year_annual_plan">
                <option value="">Choose Fiscal Year</option>
                @foreach($fiscal_years as $fiscal_year)
                    <option
                        value="{{$fiscal_year['id']}}" {{now()->year == $fiscal_year['start']?'selected':''}}>{{$fiscal_year['description']}}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>

<div class="px-3 py-3" id="load_directorate_lists">

</div>

@include('scripts.script_generic')
<script>
    var Approve_Plan_List_Container = {
        loadDirectorateList: function (fiscal_year_id, fiscal_year) {
            let url = '{{route('audit.plan.operational.plan.load-directorate-list')}}';
            let data = {fiscal_year_id, fiscal_year};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#load_directorate_lists').html(response);
                }
            });
        },

        loadApproveOrRejectForm: function (element) {
            url = '{{route('audit.plan.operational.plan.load-approve-reject-form')}}';
            data = {};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '40%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },
    };

    $(function () {
        fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
        fiscal_year = $('#select_fiscal_year_annual_plan').select2('data')[0].text;
        if (fiscal_year_id) {
            Approve_Plan_List_Container.loadDirectorateList(fiscal_year_id, fiscal_year);
        } else {
            $('#load_directorate_lists').html('');
        }
    });

    $('#select_fiscal_year_annual_plan').change(function () {
        fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
        fiscal_year = $('#select_fiscal_year_annual_plan').select2('data')[0].text;
        if (fiscal_year_id) {
            Approve_Plan_List_Container.loadDirectorateList(fiscal_year_id, fiscal_year);
        } else {
            $('#load_directorate_lists').html('');
        }
    });
</script>
