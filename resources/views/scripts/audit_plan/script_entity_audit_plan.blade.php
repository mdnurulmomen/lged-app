<script>
    var Entity_Plan_Container = {
        showTeamCreateModal: function (elem) {
            url = '{{route('audit.plan.audit.editor.load-audit-team-modal')}}';
            annual_plan_id = '{{$annual_plan_id}}';
            project_id = '{{$project_id}}';
            activity_id = '{{$activity_id}}';
            fiscal_year_id = '{{$fiscal_year_id}}';
            audit_plan_id = elem.data('audit-plan-id');
            audit_plan_no = elem.data('audit-plan-no');
            parent_office_id = elem.data('parent-office-id');
            office_order_approval_status = elem.data('office-order-approval-status');
            has_update_office_order = elem.data('has-update-office-order');
            data = {annual_plan_id, activity_id, fiscal_year_id, audit_plan_id, audit_plan_no,  parent_office_id, has_update_office_order,office_order_approval_status,project_id};

            KTApp.block('#kt_full_width_page', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_full_width_page');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".load-office-wise-employee").html(response)
                    $('#officeEmployeeModal').modal('show');
                }
            })
        },


        draftEntityPlan: function (elem) {
            url = '{{route('audit.plan.audit.revised.plan.save-draft-entity-audit-plan')}}';

            plan_description = JSON.stringify(templateArray);
            activity_id = elem.data('activity-id');
            annual_plan_id = elem.data('annual-plan-id');
            audit_plan_id = elem.data('audit-plan-id');
            is_continue = elem.data('is-continue');
            plan_no = $('#plan_no').val();

            KTApp.block('#kt_full_width_page', {
                opacity: 0.1,
                message: 'সংরক্ষন হচ্ছে অপেক্ষা করুন',
                state: 'primary' // a bootstrap color
            });

            data = {plan_description, activity_id, annual_plan_id, audit_plan_id,is_continue,plan_no};
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_full_width_page');
                if (response.status === 'success') {
                    if (!audit_plan_id) {
                        if ($(".entity_audit_plan_team_schedule").length) {
                            btn_team_schedule = $('.entity_audit_plan_team_schedule');
                            btn_team_schedule.attr('data-audit-plan-id', response.data.id);
                            btn_team_schedule.attr('data-audit-plan-no', response.data.plan_no);
                            btn_team_schedule.prop( "disabled", false );
                        }

                        if ($(".entity_audit_plan_save").length){
                            $('.entity_audit_plan_save').attr('data-audit-plan-id', response.data.id);
                            $('#plan_no').val(response.data.plan_no);
                            $('.entity_audit_plan_save').attr('data-audit-plan-no', response.data.plan_no);
                        }

                        if ($(".entity_audit_plan_risk_assessment").length){
                            $('.entity_audit_plan_risk_assessment').prop( "disabled", false );
                        }
                        if ($(".entity_audit_plan_preview").length){
                            $('.entity_audit_plan_preview').prop( "disabled", false );
                        }
                    }else{
                        if(is_continue){
                            progress(1800, 1800, $('#progressBar'));
                        }else{
                            $('#progressBar').html('');
                            window.location.reload();
                        }
                    }
                    toastr.success('Audit Plan Saved Successfully');
                }else {
                    if(response.data.message == 'exist'){
                        toastr.error('Plan number already exist');
                    }else {
                        toastr.error('Not Saved');
                    }

                    console.log(response)
                }
            })
        },

        previewAuditPlan: function (elem) {
            $('.draft_entity_audit_plan').click();
            scope_editable = 'false';

            var isExistAuditPlanId = document.getElementsByClassName('draft_entity_audit_plan');
            audit_plan_id = isExistAuditPlanId.length > 0 ? $(".draft_entity_audit_plan").data('audit-plan-id') : elem.data('audit-plan-id');
            fiscal_year_id = elem.data('fiscal-year-id');
            annual_plan_id = elem.data('annual-plan-id');

            data = {scope_editable,audit_plan_id,fiscal_year_id,annual_plan_id};
            url = '{{route('audit.plan.audit.revised.plan.book-audit-plan')}}';

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
                    $(".offcanvas-title").text('অডিট প্ল্যান');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '90%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },

        riskAssessment: function (elem) {
            quick_panel = $("#kt_quick_panel");
            $('.offcanvas-wrapper').html('');
            quick_panel.addClass('offcanvas-on');
            quick_panel.css('opacity', 1);
            quick_panel.css('width', '800px');
            $('.offcanvas-footer').hide();
            quick_panel.removeClass('d-none');
            $("html").addClass("side-panel-overlay");
            $('.offcanvas-title').html('Risk Assessment');

            url = '{{route('audit.plan.audit.editor.load-risk-assessment-list')}}';
            annual_plan_id = '{{$annual_plan_id}}';
            activity_id = '{{$activity_id}}';
            fiscal_year_id = '{{$fiscal_year_id}}';
            audit_plan_id = $(".draft_entity_audit_plan").data('audit-plan-id');
            data = {annual_plan_id, activity_id, fiscal_year_id, audit_plan_id};

            KTApp.block('#kt_full_width_page', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_full_width_page');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-wrapper").html(response);
                }
            })

        },
    }

</script>
