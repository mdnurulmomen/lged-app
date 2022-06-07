<script>
    var AIR_Report_Create_Container = {
        loadPlanEntity: function(elem) {
            air_id = $("#airId").val();
            air_type = '{{ $air_type }}';
            fiscal_year_id = elem.data('fiscal-year-id');
            audit_plan_id = elem.data('audit-plan-id');
            entity_info = '{{ json_encode($audit_plan_entity_info) }}';
            entity_info = JSON.parse(entity_info.replace(/&quot;/g, '"'));
            data = {
                fiscal_year_id,
                audit_plan_id,
                entity_info,
                air_id,
                air_type
            };
            url = '{{ route('audit.report.air.get-plan-entity') }}';

            KTApp.block('#kt_quick_panel', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function(response) {
                KTApp.unblock('#kt_quick_panel');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('অনুচ্ছেদসমূহ');
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

        loadApottiList: function(fiscal_year_id, audit_plan_id, entity_id) {
            air_id = $("#airId").val();
            air_type = '{{ $air_type }}';
            data = {
                air_id,
                air_type,
                fiscal_year_id,
                audit_plan_id,
                entity_id
            };
            url = '{{ route('audit.report.air.get-audit-apotti-list') }}';

            KTApp.block('#kt_full_width_page', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function(response) {
                KTApp.unblock('#kt_full_width_page');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $('.load_apotti_list').html(response.data);
                }
            });
        },

        storeAIRReportPlan: function(elem) {
            url = '{{ route('audit.report.air.store') }}';
            air_id = elem.data('air-id');
            apottis = $("#auditApottis").val();
            all_apottis = $("#auditAllApottis").val();

            ministry_id = $("#ministry_id").val();
            ministry_name_en = $("#ministry_name_en").val();
            ministry_name_bn = $("#ministry_name_bn").val();

            entity_id = $("#air_entity_id").val();
            entity_name_en = $("#entity_name_en").val();
            entity_name_bn = $("#entity_name_bn").val();

            audit_plan_entities = '{{ $audit_plan_entities }}';
            air_type = '{{ $air_type }}';
            activity_id = elem.data('activity-id');
            fiscal_year_id = elem.data('fiscal-year-id');
            annual_plan_id = elem.data('annual-plan-id');
            audit_plan_id = elem.data('audit-plan-id');
            air_description = JSON.stringify(templateArray);

            data = {
                air_id,
                apottis,
                all_apottis,
                audit_plan_entities,
                air_type,
                activity_id,
                fiscal_year_id,
                annual_plan_id,
                audit_plan_id,
                air_description,
                ministry_id,
                ministry_name_en,
                ministry_name_bn,
                entity_id,
                entity_name_en,
                entity_name_bn
            };

            KTApp.block('#kt_full_width_page', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function(response) {
                KTApp.unblock('#kt_full_width_page');
                if (response.status === 'success') {
                    elem.data('air-id', response.data.air_id);
                    $("#airId").val(response.data.air_id);
                    toastr.success('AIR Book Saved Successfully');
                } else {
                    toastr.error('AIR Book Not Saved');
                }
            })
        },

        previewAirReport: function() {
            $('.air_report_save').click();
            air_description = templateArray;
            scope = 'preview';
            data = {
                scope,
                air_description
            };
            url = '{{ route('audit.report.air.preview') }}';

            KTApp.block('#kt_full_width_page', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function(response) {
                KTApp.unblock('#kt_full_width_page');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('এআইআর');
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

        downloadAIRReport: function(scope = 'only_apotti') {
            air_description = templateArray;
            air_id = $("#airId").val();

            if (air_id){
                data = {
                    scope,
                    air_id,
                    air_description
                };

                KTApp.block('#kt_full_width_page', {
                    opacity: 0.1,
                    message: 'ডাউনলোড হচ্ছে অপেক্ষা করুন...',
                    state: 'primary' // a bootstrap color
                });


                url = '{{ route('audit.report.air.download') }}';

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function(response) {
                        KTApp.unblock("#kt_full_width_page");
                        var blob = new Blob([response]);
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = "draft_air_report_" + new Date().toDateString().replace(/ /g,
                            "_") + ".pdf";
                        link.click();
                    },
                    error: function(blob) {
                        KTApp.unblock("#kt_quick_panel");
                        toastr.error('Failed to generate PDF.')
                        console.log(blob);
                    }
                });
            }else {
                toastr.error('এআইআর সংরক্ষন করুন');
            }
        }
    }
</script>
