
<input type="hidden" id="qac_type" value="{{$qac_type}}">
<div class="table-search-header-wrapper mb-4 pt-3 pb-3 shadow-sm">
    <div class="col-xl-12">
        <div class="row mt-2 mb-2">

            <div class="col-md-3">
                <select class="form-select select-select2" id="fiscal_year_id">
                    @foreach($fiscal_years as $fiscal_year)
                    <option
                        value="{{$fiscal_year['id']}}" {{now()->year == $fiscal_year['end']?'selected':''}}>{{$fiscal_year['description']}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-select select-select2" id="activity_id">
                    <option value="">Select Activity</option>
                </select>
            </div>

            <div class="col-md-6">
                <select class="form-select select-select2" id="audit_plan_id">
                    <option value="">সিলেক্ট এনটিটি</option>
                </select>
            </div>
        </div>
        <div class="row mt-2 mb-2">
            {{--<div class="col-md-3">
                <select class="form-select select-select2" id="cost_center_filter">
                    <option value="">All Cost Center</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select select-select2" id="team_filter">
                    <option value="">All Teams</option>
                </select>
            </div>--}}

            <div class="col-md-6">
                <label for="">{{$qac_type_name_bn}} এর জন্য প্রেরিত প্রিলিমিনারি এআইআর এর তালিকা</label>
                <select class="form-select select-select2" id="preliminary_air_filter">
                    <option value="">প্রিলিমিনারি এআইআর</option>
                </select>
            </div>

            <div class="col-md-1">
                <div class="mt-8 action-group d-flex justify-content-end position-absolute action-group-wrapper">
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
        //Qac_Container.loadApottiList(fiscal_year_id);
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

        loadPreliminaryAIRList: function (audit_plan_id) {
            let url = '{{route('audit.execution.apotti.audit-plan-wise-preliminary-air')}}';
            let qac_type = '{{$qac_type}}';
            let data = {qac_type,audit_plan_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.warning(response.data)
                    } else {
                        $('#preliminary_air_filter').html(response);
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
            data = {apotti_id};
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

            air_report_id = elem.data('air-report-id');
            is_delete = elem.data('is-delete');
            apotti_id = elem.data('apotti-id');
            qac_type = elem.data('qac-type');

            data = {air_report_id,is_delete,apotti_id,qac_type}

            let url = '{{route('audit.qac.qac-apotti')}}';

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
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
                    $('#btn_filter').click();
                    /*if(qac_type == 'qac-1'){
                        $('.qac_1_menu a').trigger('click');
                    }else{
                        $('.qac_2_menu a').trigger('click');
                    }*/

                }
            });
        },
    };

    $('#btn_filter').click(function () {
        qac_type = $('#qac_type').val();
        air_id = $('#preliminary_air_filter').val();
        let url = '{{route('audit.qac.air-wise-apotti')}}';
        let data = {air_id,qac_type};

        KTApp.block('#kt_content', {
            opacity: 0.1,
            state: 'primary' // a bootstrap color
        });

        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
            KTApp.unblock('#kt_content');
            if (response.status === 'error') {
                toastr.warning(response.data)
            } else {
                $('#load_apotti_list').html(response);
                //$("#btn_filter").click();
            }
        });
    });

    /*$('#entity_filter').change(function () {
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
    });*/

    $('#activity_id').change(function (){
        activity_id = $('#activity_id').val();
        fiscal_year_id = $('#fiscal_year_id').val();
        Qac_Container.loadActivityWiseAuditPlan(fiscal_year_id,activity_id);
    });

    $('#audit_plan_id').change(function (){
        entity_list = $(this).find(':selected').attr('data-entity-info');
        Qac_Container.loadPlanWiseEntity(entity_list);
        Qac_Container.loadPreliminaryAIRList($(this).val());
    });
</script>
