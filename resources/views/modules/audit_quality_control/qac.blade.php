<input type="hidden" id="qac_type" value="{{$qac_type}}">

<div class="table-search-header-wrapper mb-4 pt-3 pb-3 shadow-sm">
    <div class="col-xl-12">
        <div class="row mt-2 mb-2">

            <div class="col-md-3">
                <select class="form-select select-select2" id="fiscal_year_id">
                    @foreach($fiscal_years as $fiscal_year)
                    <option
                        value="{{$fiscal_year['id']}}" {{now()->year == $fiscal_year['start']?'selected':''}}>{{$fiscal_year['description']}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-select select-select2" id="activity_id">
                    <option value="">Select Activity</option>
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-select select-select2" id="audit_plan_id">
                    <option value="">Select Plan</option>
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-select select-select2" id="entity_id">
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
            <div class="col-md-1">
                <div class="mt-1 action-group d-flex justify-content-end position-absolute action-group-wrapper">
                    <button id="btn_filter" class="btn btn-sm btn-outline-primary btn-square" type="button">
                        <i class="fad fa-search"></i> অনুসন্ধান
                    </button>
                </div>
            </div>
    </div>
</div>

</div>
<div class="card card-custom card-stretch">
    <div class="card-body p-0">
        <div id="load_apotti_list"></div>
    </div>
</div>


<script>
    $(function () {
        fiscal_year_id = $('#fiscal_year_id').val();
        team_filter = $('#team_filter').val();
        cost_center_id = $('#cost_center_filter').val();
        Qac_Container.loadApottiList(fiscal_year_id);
        Qac_Container.loadActivity(fiscal_year_id);

    });
    var Qac_Container = {
        loadActivity: function (fiscal_year_id) {
            let url = '{{route('audit.plan.operational.activity.select')}}';
            let data = {fiscal_year_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#activity_id').html(response);
                    }
                }
            );
        },
        loadActivityWiseAuditPlan: function (fiscal_year_id,activity_id) {
            let url = '{{route('audit.plan.operational.activity.audit-plan')}}';
            let data = {fiscal_year_id,activity_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#audit_plan_id').html(response);
                    }
                }
            );
        },
        loadPlanWiseEntity: function (entity_list) {
            let url = '{{route('audit.execution.apotti.audit-plan-wise-entity-select')}}';
            let data = {entity_list};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#entity_id').html(response);
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

        loadApottiList: function (fiscal_year_id) {
            qac_type = $('#qac_type').val();
            let url = '{{route('audit.qac.qac-apotti-list')}}';
            let data = {fiscal_year_id,qac_type};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#load_apotti_list').html(response);
                    }
                }
            );
        },

        loadApottiItemInfo: function (apotti_item_id) {
            let url = '{{route('audit.execution.apotti.apotti-item-info')}}';
            let data = {apotti_item_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#apotti_item_info').html(response);
                    }
                }
            );
        },


        showApotti: function (element) {
            url = '{{route('audit.execution.apotti.onucched-show')}}'
            apotti_id = element.data('apotti-id');
            data = {apotti_id};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('বিস্তারিত');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '60%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },

        editApotti: function (element){
            apotti_id = element.data('apotti-id');
            data = {apotti_id}
            let url = '{{route('audit.execution.apotti.edit-apotti')}}'
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $("#kt_content").html(response);
                }
            });
        },

        qacApotti:function (elem){

            $(".offcanvas-title").text('বিস্তারিত');
            quick_panel = $("#kt_quick_panel");
            quick_panel.addClass('offcanvas-on');
            quick_panel.css('opacity', 1);
            quick_panel.css('width', '40%');
            quick_panel.removeClass('d-none');
            $("html").addClass("side-panel-overlay");

            apotti_id = elem.data('apotti-id');

            data = {apotti_id}

            let url = '{{route('audit.qac.qac-apotti')}}';

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },

        showApotti: function (element) {
            url = '{{route('audit.execution.apotti.onucched-show')}}'
            apotti_id = element.data('apotti-id');
            data = {apotti_id};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('বিস্তারিত');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '60%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },

        qacApottiSubmit: function () {
            data  = $('#apotti_qac_form').serializeArray();

            qac_type = $('#qac_type').val();
            data.push({name: "qac_type", value: qac_type});

            let url = '{{route('audit.qac.qac-apotti-submit')}}'
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    toastr.success(response.data);
                    $('#kt_quick_panel_close').click();
                    // $('.apotti_menue a').trigger('click');
                }
            });
        },
    };

    // $('#btn_filter').click(function () {
    //     directorate_id = $('#directorate_filter').val();
    //     fiscal_year_id = $('#fiscal_year_id').val();
    //     team_filter = $('#team_filter').val();
    //     cost_center_id = $('#cost_center_filter').val();
    //     memo_irregularity_type = $('#memo_irregularity_type').val();
    //     memo_irregularity_sub_type = $('#memo_irregularity_sub_type').val();
    //     memo_type = $('#memo_type').val();
    //     memo_status = $('#memo_status').val();
    //     jorito_ortho_poriman = $('#jorito_ortho_poriman').val();
    //     audit_year_start = $('#audit_year_start').val();
    //     audit_year_end = $('#audit_year_end').val();
    //     if (directorate_id !== 'all') {
    //         Authority_Memo_Container.loadMemoList(directorate_id, fiscal_year_id, cost_center_id, team_filter, memo_irregularity_type, memo_irregularity_sub_type, memo_type, memo_status, jorito_ortho_poriman, audit_year_start,audit_year_end);
    //     } else {
    //         toastr.info('Please select a directorate.')
    //     }
    // });

    $('#entity_filter').change(function () {
        entity_id = $('#entity_filter').val();
        directorate_id = $('#directorate_filter').val();
        fiscal_year_id = $('#fiscal_year_id').val();
        Authority_Memo_Container.loadCostCenterList(directorate_id, fiscal_year_id, entity_id);
    });

    $('#cost_center_filter').change(function () {
        cost_center_id = $('#cost_center_filter').val();
        directorate_id = $('#directorate_filter').val();
        fiscal_year_id = $('#fiscal_year_id').val();
        Qac_Container.loadTeamList(directorate_id, fiscal_year_id, cost_center_id);
    });

    $('#activity_id').change(function (){
        activity_id = $('#activity_id').val();
        fiscal_year_id = $('#fiscal_year_id').val();
        Qac_Container.loadActivityWiseAuditPlan(fiscal_year_id,activity_id);
    });

    $('#audit_plan_id').change(function (){
        entity_list = $(this).find(':selected').attr('data-entity-info');
        Qac_Container.loadPlanWiseEntity(entity_list);
    });
</script>
