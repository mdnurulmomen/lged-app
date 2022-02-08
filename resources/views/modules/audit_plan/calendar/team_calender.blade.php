<div class="row mt-2 mb-2">
    <div class="col-md-3">
        <select class="form-select select-select2" id="directorate_filter">
            @if(count($directorates) > 1)
                <option value="all">Select Directorate</option>
            @endif
            @foreach($directorates as $directorate)
                <option value="{{$directorate['office_id']}}">{{$directorate['office_name_bn']}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2">
        <select class="form-select select-select2" id="fiscal_year_id">
            @foreach($fiscal_years as $fiscal_year)
                <option
                    value="{{$fiscal_year['id']}}" {{now()->year == $fiscal_year['end']?'selected':''}}>{{$fiscal_year['description']}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <select class="form-select select-select2" id="entity_filter">
            <option value="">All Entity</option>
        </select>
    </div>

    <div class="col-md-3">
        <select class="form-select select-select2" id="cost_center_filter">
            <option value="">All Cost Center</option>
        </select>
    </div>
</div>

<div class="row mt-2 mb-2">
    <div class="col-md-3">
        <select class="form-select select-select2" id="team_filter">
            <option value="">All Teams</option>
        </select>
    </div>

    <div class="col-md-1">
        <button id="btn_filter" class="btn btn-icon btn-light-success btn-square mr-2" type="button"><i
                class="fad fa-search"></i></button>
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="btn-group">
            <button id="btn_filter" class="btn btn-icon bg-success btn-square mr-2" style="width: 20px;height: 20px;" type="button"></button>
            <span class="mr-4">Data Collection Schedule</span>
            <button id="btn_filter" class="btn btn-icon bg-primary btn-square mr-2" style="width: 20px;height: 20px;" type="button"></button>
            <span>Individul Audit schedule</span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12" id="load_team_calendar">

    </div>
</div>

<script>
    var Team_Calendar_Container = {
        loadTeamCalendar: function (directorate_id, fiscal_year_id) {
            let url = '{{route('calendar.load-teams-calender')}}';
            let data = {directorate_id, fiscal_year_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        $('#load_team_calendar').html('<option value="">Select Team</option>');
                        toastr.error(response.data)
                    } else {
                        $('#load_team_calendar').html(response);
                    }
                }
            );
        },
        loadEntityList: function (directorate_id, fiscal_year_id) {
            let url = '{{route('calendar.load-schedule-entity-fiscal-year-wise-select')}}';
            let data = {directorate_id, fiscal_year_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#entity_filter').html(response);
                    }
                }
            );
        },
        loadCostCenterList: function (directorate_id, fiscal_year_id, entity_id) {
            let url = '{{route('calendar.load-cost-center-directorate-fiscal-year-wise-select')}}';
            let data = {directorate_id, fiscal_year_id, entity_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#cost_center_filter').html(response);
                    }
                }
            );
        },
        loadTeamList: function (directorate_id, fiscal_year_id, cost_center_id) {
            let url = '{{route('calendar.load-teams-select')}}';
            let data = {directorate_id, fiscal_year_id, cost_center_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#team_filter').html(response);
                    }
                }
            );
        },
        loadSubTeamList: function (directorate_id, fiscal_year_id, team_id) {
            let url = '{{route('calendar.load-sub-teams-select')}}';
            let data = {directorate_id, fiscal_year_id, team_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#sub_team_filter').html(response);
                    }
                }
            );
        },
        loadTeamFilter: function (directorate_id, fiscal_year_id, cost_center_id, team_id) {
            let url = '{{route('calendar.load-teams-calender-filter')}}';
            let data = {directorate_id, fiscal_year_id, cost_center_id, team_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#load_team_calendar').html(response);
                    }
                }
            );
        },
        loadTeamCalendarScheduleList: function (directorate_id, fiscal_year_id, cost_center_id, team_id) {
            let url = '{{route('calendar.load-team-calendar-schedule-list')}}';
            let data = {directorate_id, fiscal_year_id, cost_center_id, team_id};

            quick_panel = $("#kt_quick_panel");
            quick_panel.addClass('offcanvas-on');
            quick_panel.css('opacity', 1);
            quick_panel.css('width', '1200px');
            $('.offcanvas-footer').hide();
            quick_panel.removeClass('d-none');
            $("html").addClass("side-panel-overlay");
            $('.offcanvas-title').html('List');
            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    KTApp.unblock('#kt_content');
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {

                        $('.offcanvas-wrapper').html(response);
                    }
                }
            );
        },
    };
    @if(!isset($team_id))
    $(function () {
        directorate_id = $('#directorate_filter').val();
        fiscal_year_id = $('#fiscal_year_id').val();
        team_filter = $('#team_filter').val();
        cost_center_id = $('#cost_center_filter').val();

        if (directorate_id !== 'all') {
            //Team_Calendar_Container.loadTeamCalendar(directorate_id, fiscal_year_id);
            Team_Calendar_Container.loadTeamFilter(directorate_id, fiscal_year_id, cost_center_id, team_filter);
            // Team_Calendar_Container.loadTeamList(directorate_id, fiscal_year_id);
            Team_Calendar_Container.loadEntityList(directorate_id, fiscal_year_id);
            // Team_Calendar_Container.loadCostCenterList(directorate_id, fiscal_year_id);
        } else {
            toastr.info('Please select directorate.')
            $('#load_team_calendar').html('');
        }
    });
    @else
    $(function () {
            directorate_id = $('#directorate_filter').val();
            fiscal_year_id = $('#fiscal_year_id').val();
            team_id = '{{$team_id}}';
            Team_Calendar_Container.loadTeamList(directorate_id, fiscal_year_id);
            $('#team_filter').val(team_id);
        }
    );
    @endif

    $('#directorate_filter').change(function () {
        directorate_id = $('#directorate_filter').val();
        if (directorate_id) {
            // Team_Calendar_Container.loadTeamList(directorate_id, fiscal_year_id);
            Team_Calendar_Container.loadEntityList(directorate_id, fiscal_year_id);
            // Team_Calendar_Container.loadTeamCalendar(directorate_id, fiscal_year_id);
        } else {
            $('#load_team_calendar').html('');
        }
    });

    $('#team_filter').change(function () {
        team_id = $('#team_filter').val();
        directorate_id = $('#directorate_filter').val();
        fiscal_year_id = $('#fiscal_year_id').val();
        Team_Calendar_Container.loadSubTeamList(directorate_id, fiscal_year_id, team_id);
    });

    $('#btn_filter').click(function () {
        $('#load_team_calendar').html('');
        directorate_id = $('#directorate_filter').val();
        fiscal_year_id = $('#fiscal_year_id').val();
        team_filter = $('#team_filter').val();
        cost_center_id = $('#cost_center_filter').val();
        if (directorate_id !== 'all') {
            if (team_filter || cost_center_id) {
                Team_Calendar_Container.loadTeamFilter(directorate_id, fiscal_year_id, cost_center_id, team_filter);
            } else {
                Team_Calendar_Container.loadTeamFilter(directorate_id, fiscal_year_id, cost_center_id, team_filter);
                // Team_Calendar_Container.loadTeamCalendar(directorate_id, fiscal_year_id);
            }
        } else {
            toastr.info('Please select a directorate.')
        }
    });

    $('#entity_filter').change(function () {
        entity_id = $('#entity_filter').val();
        directorate_id = $('#directorate_filter').val();
        fiscal_year_id = $('#fiscal_year_id').val();
        Team_Calendar_Container.loadCostCenterList(directorate_id, fiscal_year_id, entity_id);
    });

    $('#cost_center_filter').change(function () {
        cost_center_id = $('#cost_center_filter').val();
        directorate_id = $('#directorate_filter').val();
        fiscal_year_id = $('#fiscal_year_id').val();
        Team_Calendar_Container.loadTeamList(directorate_id, fiscal_year_id, cost_center_id);
    });
</script>
