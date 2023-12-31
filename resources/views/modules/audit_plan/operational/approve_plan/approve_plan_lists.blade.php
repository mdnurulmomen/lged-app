<x-title-wrapper>Annual Audit Plan List</x-title-wrapper>

<div class="card sna-card-border mt-3">
    <form>
        <div class="form-row">
            <div class="col-md-4 ">
                <label>Audit Year</label>
                <select class="form-control select-select2" name="fiscal_year" id="select_fiscal_year_annual_plan">
                    <option value="">Choose Fiscal Year</option>
                    @foreach($fiscal_years as $fiscal_year)
                        <option
                            value="{{$fiscal_year['id']}}" {{$current_fiscal_year == $fiscal_year['id']?'selected':''}}>{{$fiscal_year['description']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>
</div>

<div class="card sna-card-border mt-3">
    <div id="load_directorate_lists"></div>
</div>

@include('scripts.script_generic')
<script>
    $(function () {
        Approve_Plan_List_Container.loadOpYearlyEventList();
    });

    $('#select_fiscal_year_annual_plan').change(function () {
        Approve_Plan_List_Container.loadOpYearlyEventList();
    });

    var Approve_Plan_List_Container = {
        loadOpYearlyEventList: function () {
            fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
            fiscal_year = $('#select_fiscal_year_annual_plan').select2('data')[0].text;

            if (fiscal_year_id) {
                let url = '{{route('audit.plan.operational.plan.load-op-yearly-event-list')}}';
                let data = {fiscal_year_id, fiscal_year};

                KTApp.block('#kt_wrapper', {
                    opacity: 0.1,
                    state: 'primary' // a bootstrap color
                });

                ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    KTApp.unblock('#kt_wrapper');
                    if (response.status === 'error') {
                        toastr.error(response.data)
                    } else {
                        $('#load_directorate_lists').html(response);
                    }
                })
            } else {
                $('#load_directorate_lists').html('');
            }
        },

        viewDirectorateWiseAnnualPlan:function (element){
            url = '{{route('audit.plan.operational.plan.load-directorate-wise-annual-plan')}}';
            fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
            office_id = element.data('office-id');
            annual_plan_main_id = element.data('annual-plan-main-id');
            has_update_request = element.data('has-update-request');
            activity_type = element.data('activity-type');
            office_id = element.data('office-id');
            data = {fiscal_year_id,office_id,activity_type,annual_plan_main_id,has_update_request};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '70%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },

        loadOpYearlyEventApprovalForm: function (element) {
            url = '{{route('audit.plan.operational.plan.load-op-yearly-event-approval-form')}}';
            fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
            op_audit_calendar_event_id = element.data('op-audit-calendar-event-id');
            annual_plan_main_id = element.data('annual-plan-main-id');
            has_update_request = element.data('has-update-request');
            activity_type = element.data('activity-type');
            office_id = element.data('office-id');
            office_name_bn = element.data('office-name-bn');
            data = {fiscal_year_id,op_audit_calendar_event_id,office_id,activity_type,annual_plan_main_id,has_update_request};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text(office_name_bn);
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '40%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            });

            loadAnnualPlanUrl = '{{route('audit.plan.operational.plan.load-directorate-wise-annual-plan')}}'
            fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
            office_id = element.data('office-id');
            dataLoadAnnualPlan = {fiscal_year_id,office_id,annual_plan_main_id,activity_type};

            ajaxCallAsyncCallbackAPI(loadAnnualPlanUrl, dataLoadAnnualPlan, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".annual-plan-view").html(response);
                }
            });
        },

        sendAnnualPlanReceiverToSender: function () {
            url = '{{route('audit.plan.operational.plan.send-annual-plan-receiver-to-sender')}}';
            data = $('#approval_form').serialize();

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'success') {
                    toastr.success('অনুমোদনের জন্য প্রেরিত হয়েছে');
                    $("#kt_quick_panel_close").click();
                    Approve_Plan_List_Container.loadOpYearlyEventList();
                }
                else {
                    if (response.statusCode === '422') {
                        var errors = response.msg;
                        $.each(errors, function (k, v) {
                            if (v !== '') {
                                toastr.error(v);
                            }
                        });
                    }
                    else {
                        toastr.error(response.data.message);
                    }
                }
            })
        },

        movementHistory: function (element) {
            url = '{{route('audit.plan.annual.plan.revised.movement-history-annual-plan')}}';
            fiscal_year_id = element.data('fiscal-year-id');
            op_audit_calendar_event_id = element.data('op-audit-calendar-event-id');

            data = {fiscal_year_id, op_audit_calendar_event_id};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('গতিবিধি');
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

        printAnnualPlan: function (elem) {
            url = '{{route('audit.plan.annual.plan.revised.book')}}';
            office_id = elem.data('office-id');
            fiscal_year_id = elem.data('fiscal-year-id');
            annual_plan_main_id = elem.data('annual-plan-main-id');
            has_update_request = elem.data('has-update-request');
            activity_type = elem.data('activity-type');

            loaderStart('loading...');

            $.ajax({
                type: 'POST',
                url: url,
                data: {office_id,fiscal_year_id,annual_plan_main_id,activity_type,has_update_request},
                xhrFields: {
                    responseType: 'blob'
                },

                success: function (response) {
                    loaderStop();
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "annual_plan.pdf";
                    link.click();
                },

                error: function (blob) {
                    toastr.error('Failed to generate PDF.')
                    console.log(blob);
                }

            });
        },
    };
</script>
