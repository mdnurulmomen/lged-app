<x-title-wrapper>Rpu List</x-title-wrapper>
<form class="pl-4 pt-4">
    <div class="form-row">
        <div class="col-md-4 ">
            <label>Directorate</label>
            <select class="form-control select-select2" name="directorate_id" id="directorate_id"
                    onchange="MIS_TEAM_LIST_CONTAINER.loadMISTeamLists()">
                <option value="">Choose Fiscal Year</option>
{{--                @foreach($fiscal_years as $fiscal_year)--}}
{{--                    <option--}}
{{--                        value="{{$fiscal_year['id']}}" {{now()->year == $fiscal_year['start']?'selected':''}}>{{$fiscal_year['description']}}</option>--}}
{{--                @endforeach--}}
            </select>
        </div>
    </div>
</form>

<div class="px-3 py-3" id="load_mis_team_lists">

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
    };
    $(function () {
        MIS_TEAM_LIST_CONTAINER.loadMISTeamLists();
    });

</script>
