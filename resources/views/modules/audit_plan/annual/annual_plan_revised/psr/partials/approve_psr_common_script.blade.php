<script>
    var Approve_Psr_Common_Container = {
        loadPsrApprovalForm: function (element) {
            url = '{{route('audit.plan.annual.psr.load-psr-approval-form')}}';
            fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
            office_id = $('#directorate_filter').val();
            annual_plan_id = element.data('annual-plan-id');
            psr_approval_type = element.data('psr-approval-type');

            data = {fiscal_year_id, office_id, annual_plan_id, psr_approval_type};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text();
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

        sendPsrReceiverToSender: function () {
            url = '{{route('audit.plan.annual.psr.send-psr-receiver-to-sender')}}';
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
                    $('#directorate_filter').trigger('change');
                } else {
                    if (response.statusCode === '422') {
                        var errors = response.msg;
                        $.each(errors, function (k, v) {
                            if (v !== '') {
                                toastr.error(v);
                            }
                        });
                    } else {
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
    }

</script>


