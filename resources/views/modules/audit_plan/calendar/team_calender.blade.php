<div class="row">
    <div class="col-md-3">
        <select class="form-select select-select2" id="fiscal_year_id">
            @foreach($fiscal_years as $fiscal_year)
                <option value="{{$fiscal_year['id']}}" {{now()->year == $fiscal_year['start']?'selected':''}}>{{$fiscal_year['description']}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <select class="form-select select-select2" id="directorate_filter">
            @if(count($directorates) > 1)
                <option value="all">Select Directorate</option>
            @endif
            @foreach($directorates as $directorate)
                <option
                    value="{{$directorate['office_id']}}">{{$directorate['office_name_en']}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <select class="form-select select-select2" id="team_filter">
            <option value="">All Teams</option>
        </select>
    </div>
    <button id="btn_filter" class="btn btn-icon btn-light-success btn-square mr-2" type="button"><i class="fad fa-search"></i></button>
</div>

<div class="row">
    <div class="col-md-12" id="load_team_calendar">

    </div>
</div>

<script>
    var Team_Calendar_Container = {
        loadTeamCalendar: function (directorate_id,fiscal_year_id) {
            let url = '{{route('calendar.load-teams-calender')}}';
            let data = {directorate_id,fiscal_year_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.error(response.data)
                    } else {
                        $('#load_team_calendar').html(response);
                    }
                }
            );
        },
        loadTeamList: function (directorate_id,fiscal_year_id) {
            let url = '{{route('calendar.load-teams-select')}}';
            let data = {directorate_id,fiscal_year_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.error(response.data)
                    } else {
                        $('#team_filter').html(response);
                    }
                }
            );
        },
        loadTeamFilter: function (directorate_id,fiscal_year_id,team_id) {
            let url = '{{route('calendar.load-teams-calender-filter')}}';
            let data = {directorate_id,fiscal_year_id,team_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.error(response.data)
                    } else {
                        $('#load_team_calendar').html(response);
                    }
                }
            );
        },
    };
    @if(!isset($team_id))
    $(function () {
            directorate_id = $('#directorate_filter').val();
            fiscal_year_id = $('#fiscal_year_id').val();
            if (directorate_id) {
                Team_Calendar_Container.loadTeamCalendar(directorate_id,fiscal_year_id);
                Team_Calendar_Container.loadTeamList(directorate_id,fiscal_year_id);
            } else {
                $('#load_team_calendar').html('');
            }
        }
    );
    @else
        $(function () {
            team_id = '{{$team_id}}';
            $('#team_filter').val(team_id);
        }
    );
    @endif

    $('#directorate_filter').change(function () {
        directorate_id = $('#directorate_filter').val();
        if (directorate_id) {
            Team_Calendar_Container.loadTeamCalendar(directorate_id,fiscal_year_id);
        } else {
            $('#load_team_calendar').html('');
        }
    });

    $('#btn_filter').click(function () {
        directorate_id = $('#directorate_filter').val();
        fiscal_year_id = $('#fiscal_year_id').val();
        team_filter = $('#team_filter').val();
        Team_Calendar_Container.loadTeamFilter(directorate_id,fiscal_year_id,team_filter);
        Team_Calendar_Container.loadTeamList(directorate_id,fiscal_year_id);
    });
</script>
