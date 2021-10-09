<div class="row">
    <div class="col-md-4">
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
    <div class="col-md-4">
        <select class="form-select select-select2" id="team_filter">
            <option value="all">All Teams</option>
        </select>
    </div>
    <button class="btn btn-icon btn-light-success btn-square mr-2" type="button"><i class="fad fa-search"></i></button>
</div>

<div class="row">
    <div class="col-md-12" id="load_team_calendar">

    </div>
</div>

<script>
    var Team_Calendar_Container = {
        loadTeamCalendar: function (directorate_id) {
            let url = '{{route('calendar.load-teams')}}';
            let data = {directorate_id};
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

    $(function () {
            directorate_id = $('#directorate_filter').val();
            if (directorate_id) {
                Team_Calendar_Container.loadTeamCalendar(directorate_id);
            } else {
                $('#load_team_calendar').html('');
            }
        }
    );

    $('#directorate_filter').change(function () {
        directorate_id = $('#directorate_filter').val();
        if (directorate_id) {
            Team_Calendar_Container.loadTeamCalendar(directorate_id);
        } else {
            $('#load_team_calendar').html('');
        }
    });
</script>
