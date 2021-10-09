<div class="row">
    <div class="col-md-4">
        <select class="form-select select-select2" id="directorate_filter">
            <option value="all">Select Directorate</option>
            @foreach($directorates as $directorate)
                <option value="1">{{$directorate['office_name_en']}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <select class="form-select select-select2" id="team_filter">
            <option value="all">Select Team</option>
            <option value="1">team 1</option>
            <option value="2">team 2</option>
        </select>
    </div>
</div>

<div class="row">
    <div class="col-md-12" id="load_team_calendar">

    </div>
</div>


