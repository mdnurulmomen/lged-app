<div class="row mt-2 mb-2">
    <div class="col-md-3">
        <select class="form-select select-select2" id="directorate_filter">
            @if(count($directorates) > 1)
                <option value="all">Select Directorate</option>
            @endif
            @foreach($directorates as $directorate)
                <option value="{{$directorate['office_id']}}">{{$directorate['office_name_en']}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2">
        <select class="form-select select-select2" id="fiscal_year_id">
            @foreach($fiscal_years as $fiscal_year)
                <option
                    value="{{$fiscal_year['id']}}" {{now()->year == $fiscal_year['start']?'selected':''}}>{{$fiscal_year['description']}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <select class="form-select select-select2" id="cost_center_filter">
            <option value="">All Cost Center</option>
        </select>
    </div>

    <div class="col-md-3">
        <select class="form-select select-select2" id="team_filter">
            <option value="">All Teams</option>
        </select>
    </div>

    <div class="col-md-1">
        <button id="btn_filter" class="btn btn-icon btn-light-success btn-square mr-2" type="button"><i
            class="fad fa-search"></i></button>
    </div>
</div>

<div class="row">
    <div class="col-md-12" id="load_memo_list">

    </div>
</div>

<script>
    var Team_Calendar_Container = {
        loadCostCenterList: function (directorate_id, fiscal_year_id) {
            let url = '{{route('calendar.load-cost-center-directorate-fiscal-year-wise-select')}}';
            let data = {directorate_id, fiscal_year_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#cost_center_filter').html(response);
                    }
                }
            );
        },
        loadTeamList: function (directorate_id, fiscal_year_id) {
            let url = '{{route('calendar.load-teams-select')}}';
            let data = {directorate_id, fiscal_year_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#team_filter').html(response);
                    }
                }
            );
        },
        loadMemoList: function (directorate_id, fiscal_year_id, cost_center_id, team_id) {
            let url = '{{route('audit.execution.memo.load-authority-memo-list')}}';
            let data = {directorate_id, fiscal_year_id,cost_center_id,team_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#load_memo_list').html(response);
                    }
                }
            );
        },
    };
    $(function () {
            directorate_id = $('#directorate_filter').val();
            fiscal_year_id = $('#fiscal_year_id').val();
            team_filter = $('#team_filter').val();
            cost_center_id = $('#cost_center_filter').val();

            if (directorate_id !== 'all') {
                 Team_Calendar_Container.loadMemoList(directorate_id, fiscal_year_id, cost_center_id, team_filter);
                 Team_Calendar_Container.loadCostCenterList(directorate_id, fiscal_year_id);
                 Team_Calendar_Container.loadTeamList(directorate_id, fiscal_year_id);
            } else {
                toastr.info('Please select directorate.')
                $('#load_team_calendar').html('');
            }
    });

      $('#btn_filter').click(function () {
        directorate_id = $('#directorate_filter').val();
        fiscal_year_id = $('#fiscal_year_id').val();
        team_filter = $('#team_filter').val();
        cost_center_id = $('#cost_center_filter').val();
        if (directorate_id !== 'all') {
            if (team_filter || cost_center_id) {
                Team_Calendar_Container.loadMemoList(directorate_id, fiscal_year_id,cost_center_id, team_filter);
                Team_Calendar_Container.loadTeamList(directorate_id, fiscal_year_id);
            } else {
                 Team_Calendar_Container.loadMemoList(directorate_id, fiscal_year_id,cost_center_id, team_filter);
                // Team_Calendar_Container.loadTeamCalendar(directorate_id, fiscal_year_id);
            }
        } else {
            toastr.info('Please select a directorate.')
        }
    });
</script>
