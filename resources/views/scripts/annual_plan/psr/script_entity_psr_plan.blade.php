<script>
    var PSR_Plan_Container = {
        draftPSRPlan: function (elem) {
            url = '{{route('audit.plan.annual.psr.store')}}';
            psr_plan_id = typeof elem.data('psr-plan-id') !== typeof undefined && elem.data('psr-plan-id') !== false ? elem.data('psr-plan-id') : '';
            annual_plan_id = elem.data('annual-plan-id');
            fiscal_year_id = elem.data('fiscal-year-id');
            activity_id = elem.data('activity-id');
            plan_description = JSON.stringify(templateArray);

            KTApp.block('#kt_full_width_page', {
                opacity: 0.1,
                message: 'সংরক্ষন হচ্ছে অপেক্ষা করুন',
                state: 'primary' // a bootstrap color
            });

            data = {plan_description, psr_plan_id, annual_plan_id,fiscal_year_id,activity_id};

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_full_width_page');
                if (response.status === 'success') {
                    toastr.success('Audit Plan Saved Successfully');
                    if (!psr_plan_id) {
                        if ($(".entity_audit_plan_save").length){
                            $('.entity_audit_plan_save').attr('data-psr-plan-id', response.data);
                            $('.entity_audit_plan_preview').prop( "disabled", false );
                        }
                    }
                }else {
                    toastr.error('Not Saved');
                }
            })
        },

        previewAuditPlanPSR: function (elem) {
            scope_editable = elem.data('scope-editable');
            psr_plan_id = $(".draft_entity_audit_plan").data('psr-plan-id');

            data = {scope_editable,psr_plan_id};
            url = '{{route('audit.plan.annual.psr.preview')}}';

            KTApp.block('#kt_full_width_page', {
                opacity: 0.1,
                message: 'লোড হচ্ছে অপেক্ষা করুন',
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_full_width_page');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('প্ল্যান');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '90%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            })
        },
    }

</script>
