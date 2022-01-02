<x-title-wrapper>Annual Plan List</x-title-wrapper>
<form class="pl-4 pt-4">
    <div class="form-row">
        <div class="col-md-4 ">
            <label>Select Fiscal Year</label>
            <select class="form-control select-select2" name="fiscal_year" id="select_fiscal_year"
                    onchange="MIS_TEAM_LIST_CONTAINER.loadMISTeamLists()">
                <option value="">Choose Fiscal Year</option>
                @foreach($fiscal_years as $fiscal_year)
                    <option
                        value="{{$fiscal_year['id']}}" {{now()->year == $fiscal_year['end']?'selected':''}}>{{$fiscal_year['description']}}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>
<div class="row mt-2">
    <div class="col-md-12">
        <div id="load_mis_team_lists"></div>
    </div>
</div>
<script>


    var MIS_TEAM_LIST_CONTAINER = {
        loadMISTeamLists: function () {
            let url = '{{route('mis_and_dashboard.team_list.load-lists')}}';
            fiscal_year_id = $('#select_fiscal_year').val();
            let data = {fiscal_year_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    $('#load_mis_team_lists').html('');
                    toastr.error(response.data)
                } else {
                    $('#load_mis_team_lists').html(response);
                }
            });
        },
        loadMISTeamInfo: function (fiscal_year_id,office_id) {
            let url = '{{route('mis_and_dashboard.team_list.load-fiscal-year-wise-team')}}';
            let data = {fiscal_year_id,office_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '500px');
                    $('.offcanvas-footer').hide();
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $('.offcanvas-title').html('');
                    $('.offcanvas-wrapper').html(response);
                }
            });
        },
    };
    $(function () {
        MIS_TEAM_LIST_CONTAINER.loadMISTeamLists();
    });

</script>
