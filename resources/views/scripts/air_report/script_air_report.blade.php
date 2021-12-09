<script>
    var AIR_Report_Container = {
        storeAIRReportPlan: function (elem) {
            url = '{{route('audit.report.qc.air-report.store')}}';

            air_id = elem.data('air-id');
            activity_id = elem.data('activity-id');
            fiscal_year_id = elem.data('fiscal-year-id');
            annual_plan_id = elem.data('annual-plan-id');
            audit_plan_id = elem.data('audit-plan-id');
            air_description = JSON.stringify(templateArray);

            data = {air_id,activity_id,fiscal_year_id,annual_plan_id,audit_plan_id,air_description};
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'success') {
                    elem.data('air-id',response.data.air_id);
                    console.log(elem.data('air-id'))
                    console.log(response.data.air_id)
                    toastr.success('AIR Book Saved Successfully');
                } else {
                    toastr.error('Not Saved');
                    console.log(response)
                }
            })
        },

        previewAirReport: function () {
            $('.air_report_save').click();
            air_description = templateArray;
            scope = 'preview';
            data = {scope,air_description};
            url = '{{route('audit.report.qc.air-report.download')}}';

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
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
    }

</script>
