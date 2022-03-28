<x-title-wrapper>Audit Query List</x-title-wrapper>

<div class="card sna-card-border d-flex flex-wrap flex-row">
    <input type="hidden" name="status" id="status">
    <div class="col-xl-12">
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

            <div class="col-md-3">
                <select class="form-select select-select2" id="fiscal_year_id">
                    @foreach($fiscal_years as $fiscal_year)
                        <option
                            value="{{$fiscal_year['id']}}" {{now()->year == $fiscal_year['end']?'selected':''}}>{{$fiscal_year['description']}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-control select-select2" id="activity_id">
                    <option value="">--সিলেক্ট--</option>
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-select select-select2" id="entity_filter">
                    <option value="">All Entity</option>
                </select>
            </div>
        </div>
        <div class="row mt-2 mb-2">
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
            <div class="col-md-3">
                <input autocomplete="off" type="text" id="start_date" class="date form-control" placeholder="শুরুর তারিখ">
            </div>

            <div class="col-md-3">
                <input autocomplete="off" type="text" id="end_date" class="date form-control" placeholder="শেষের তারিখ">
            </div>
        </div>

        <div class="row mt-2 mb-2">
            <div class="col-md-3">
                <button id="btn_filter" class="btn icon-btn-primary" type="button">
                    <i class="fad fa-search"></i> অনুসন্ধান
                </button>
            </div>
        </div>
    </div>
</div>


<div class="card sna-card-border mt-2 mb-5">
    <div id="load_query_list">
        <div class="d-flex align-items-center">
            <div class="spinner-grow text-warning mr-3" role="status">
                <span class="sr-only"></span>
            </div>
            <div>
                loading.....
            </div>
        </div>
    </div>
</div>


<script>
    var dashboard_filter_data = '{!! session('dashboard_filter_data')!!}';
    $(function () {
        Authority_Query_Container.loadFiscalYearWiseActivity();
        if (dashboard_filter_data !== "") {
            filter_data = JSON.parse(dashboard_filter_data);
            if (filter_data.directorate_id != null) {
                $("#directorate_filter").val(filter_data.directorate_id).trigger('change');
            }
            if (filter_data.fiscal_year_id != null) {
                $("#fiscal_year_id").val(filter_data.fiscal_year_id).trigger('change');
            }
            if (filter_data.entity_id != null) {
                $("#entity_filter").val(filter_data.entity_id).trigger('change');
            }
            if (filter_data.cost_center_id != null) {
                $("#cost_center_filter").val(filter_data.cost_center_id).trigger('change');
            }
            if (filter_data.team_filter != null) {
                $("#team_filter").val(filter_data.team_filter).trigger('change');
            }
            if (filter_data.activity_id != null) {
                $("#activity_id").val(filter_data.activity_id).trigger('change');
            }
            if (filter_data.status != null) {
                $("#status").val(filter_data.status);
            }
        }

        directorate_id = $('#directorate_filter').val();
        fiscal_year_id = $('#fiscal_year_id').val();

        if (directorate_id !== 'all') {
            Authority_Query_Container.loadQueryList();
            Authority_Query_Container.loadEntityList(directorate_id, fiscal_year_id);
        } else {
            // toastr.info('Please select directorate.')
            $('#load_team_calendar').html('');
        }
    });
    var Authority_Query_Container = {
        loadFiscalYearWiseActivity: function () {
            fiscal_year_id = $('#fiscal_year_id').val();
            fiscal_year = $('#fiscal_year_id').select2('data')[0].text;
            if (fiscal_year_id) {
                let url = '{{route('audit.plan.annual.plan.revised.fiscal-year-wise-activity-select')}}';
                let data = {fiscal_year_id, fiscal_year};
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.error(response.data)
                    } else {
                        $('#activity_id').html(response);
                        $("#activity_id").val($("#activity_id option:eq(1)").val()).trigger('change');
                        if (dashboard_filter_data.activity_id != null) {
                            $("#activity_id").val(dashboard_filter_data.activity_id).trigger('change');
                        }
                    }
                });
            } else {
                $('#activity_id').html('');
            }
        },
        loadEntityList: function (directorate_id, fiscal_year_id) {
            activity_id = $('#activity_id').val();
            if (dashboard_filter_data && activity_id == null) {
                dashboard_filter_data = JSON.parse(dashboard_filter_data);
                activity_id = dashboard_filter_data.activity_id;
            }
            let url = '{{route('calendar.load-schedule-entity-fiscal-year-wise-select')}}';
            let data = {directorate_id, fiscal_year_id, activity_id};
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

        loadQueryList: function () {
            directorate_id = $('#directorate_filter').val();
            fiscal_year_id = $('#fiscal_year_id').val();
            activity_id = $('#activity_id').val();
            if (dashboard_filter_data && activity_id == null) {
                dashboard_filter_data = JSON.parse(dashboard_filter_data);
                activity_id = dashboard_filter_data.activity_id;
            }
            entity_id = $('#entity_filter').val();
            team_id = $('#team_filter').val();
            cost_center_id = $('#cost_center_filter').val();
            memo_irregularity_type = $('#memo_irregularity_type').val();
            memo_irregularity_sub_type = $('#memo_irregularity_sub_type').val();
            memo_type = $('#memo_type').val();
            memo_status = $('#memo_status').val();
            jorito_ortho_poriman = $('#jorito_ortho_poriman').val();
            audit_year_start = $('#audit_year_start').val();
            audit_year_end = $('#audit_year_end').val();
            start_date = $('#start_date').val();
            end_date = $('#end_date').val();
            status = $('#status').val();

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            url = '{{route('audit.execution.load-authority-query-list')}}';
            data = {
                directorate_id,
                fiscal_year_id,
                activity_id,
                entity_id,
                cost_center_id,
                team_id,
                memo_irregularity_type,
                memo_irregularity_sub_type,
                memo_type,
                memo_status,
                jorito_ortho_poriman,
                audit_year_start,
                audit_year_end,
                start_date,
                end_date,
                status
            };
            console.log(data);
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    KTApp.unblock('#kt_content');
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#load_query_list').html(response);
                    }
                }
            );
        },

        viewQuery: function (elem) {
            scope_authority = 1;
            ac_query_id = elem.data('ac-query-id');
            has_sent_to_rpu = elem.data('has-sent-to-rpu');

            data = {scope_authority, ac_query_id, has_sent_to_rpu};
            directorate_id = $('#directorate_filter').val();
            if (directorate_id) {
                data['directorate_id'] = directorate_id;
            }
            url = '{{route('audit.execution.query.view')}}';

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('কোয়েরি শিটের বিস্তারিত');
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

    $('#btn_filter').click(function () {
        directorate_id = $('#directorate_filter').val();
        if (directorate_id !== 'all') {
            Authority_Query_Container.loadQueryList();
        } else {
            toastr.info('Please select a directorate.')
        }
    });

    $('#directorate_filter').change(function () {
        directorate_id = $('#directorate_filter').val();
        fiscal_year_id = $('#fiscal_year_id').val();
        Authority_Query_Container.loadEntityList(directorate_id, fiscal_year_id);
    });

    $('#entity_filter').change(function () {
        entity_id = $('#entity_filter').val();
        directorate_id = $('#directorate_filter').val();
        fiscal_year_id = $('#fiscal_year_id').val();
        if (entity_id){
            Authority_Query_Container.loadCostCenterList(directorate_id, fiscal_year_id, entity_id);
        }
    });

    $('#cost_center_filter').change(function () {
        cost_center_id = $('#cost_center_filter').val();
        directorate_id = $('#directorate_filter').val();
        fiscal_year_id = $('#fiscal_year_id').val();
        if (cost_center_id){
            Authority_Query_Container.loadTeamList(directorate_id, fiscal_year_id, cost_center_id);
        }
    });
</script>
