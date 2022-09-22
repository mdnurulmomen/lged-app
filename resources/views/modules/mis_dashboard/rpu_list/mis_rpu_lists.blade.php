<x-title-wrapper>Rpu List</x-title-wrapper>
<div class="card sna-card-border">
    <div class="row">
        <div class="col-md-12">
            <form class="pl-4 pt-4">
                <div class="form-row">
                    <div class="col-md-6">
                        <label>Directorate</label>
                        <select class="form-control select-select2" name="directorate_id" id="directorate_id"
                                onchange="MIS_RPU_LIST_CONTAINER.loadMinistryLists()">
                            <option value="">Choose Directorates</option>
                            @foreach($directorates as $directorate)
                                <option
                                    value="{{$directorate['office_id']}}">{{$directorate['office_name_en']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Ministry</label>
                        <select class="form-control select-select2" name="office_ministry_id" id="office_ministry_id">
                            <option value="">Choose Ministry</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label>Audit Due Year</label>
                        <select class="form-control select-select2" name="audit_due_year" id="audit_due_year">
                            <option value="">Choose Fiscal Year</option>
                            @foreach($fiscal_years as $fiscal_year)
                                <option
                                    value="{{$fiscal_year['start']}}">{{$fiscal_year['description']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Risk Area </label>
                        <select class="form-control select-select2" name="risk_category" id="risk_category">
                            <option value="">Choose Risk Area</option>
                            <option value="high">High</option>
                            <option value="medium">Medium</option>
                            <option value="low">Low</option>
                        </select>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        {{--                    <button type="button" onclick="MIS_RPU_LIST_CONTAINER.loadRupLists()" class="btn btn-primary">Submit--}}
                        {{--                    </button>--}}
                        <a tabindex="0" onclick="MIS_RPU_LIST_CONTAINER.loadRupLists()" role="button"
                           class="write_onucched btn btn-sm btn-square btn-success"><i class="fad fa-search"></i>
                            <span>অনুসন্ধান</span></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="card sna-card-border mt-2">
    <div class="px-3 py-3" id="report_heading"></div>
    <div class="px-3 py-3" id="load_mis_team_lists"></div>
</div>

<script>

    var MIS_RPU_LIST_CONTAINER = {
        loadMinistryLists: function () {
            let url = '{{route('mis_and_dashboard.directorate_wise_ministry')}}';
            directorate_id = $('#directorate_id').val();
            let data = {directorate_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                $('#office_ministry_id').html(response);
            });
        },

        loadRupLists: function () {
            let url = '{{route('mis_and_dashboard.rpu_list.load-lists')}}';
            directorate_id = $('#directorate_id').val();
            office_ministry_id = $('#office_ministry_id').val();
            audit_due_year = $('#audit_due_year').val();
            risk_category = $('#risk_category').val();
            let data = {directorate_id, office_ministry_id, audit_due_year, risk_category};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                let heading = '<p>Showing Report For: </p>';
                if (directorate_id) {
                    heading += '<p class="float-left pl-4"><b>Directorate:</b> ' + $("#directorate_id option:selected").text() + '</p>';
                }
                if (office_ministry_id) {
                    heading += '<p class="float-left pl-4"><b>Ministry:</b> ' + $("#office_ministry_id option:selected").text() + '</p>';
                }
                if (audit_due_year) {
                    heading += '<p class="float-left pl-4"><b>Due Year:</b> ' + $("#audit_due_year option:selected").text() + '</p>';
                }
                if (risk_category) {
                    heading += '<p class="float-left pl-4"><b>Risk Area:</b> ' + $("#risk_category option:selected").text() + '</p>';
                }

                $('#report_heading').html(heading);
                $('#load_mis_team_lists').html(response);
            });
        }
    };
    // $(function () {
    //     MIS_TEAM_LIST_CONTAINER.loadMISTeamLists();
    // });

</script>
