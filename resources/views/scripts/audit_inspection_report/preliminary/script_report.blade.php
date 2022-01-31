<script>
    var AIR_Report_Create_Container = {
        loadApottiList: function (elem) {
            air_id = $("#airId").val();
            air_type = '{{$air_type}}';
            fiscal_year_id = elem.data('fiscal-year-id');
            audit_plan_id = elem.data('audit-plan-id');
            data = {air_id,air_type,fiscal_year_id,audit_plan_id};
            url = '{{route('audit.report.air.get-audit-apotti-list')}}';

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
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

        storeAIRReportPlan: function (elem) {
            url = '{{route('audit.report.air.store')}}';
            air_id = elem.data('air-id');
            apottis = $("#auditApottis").val();
            all_apottis = $("#auditAllApottis").val();
            audit_plan_entities = '{{$audit_plan_entities}}';
            air_type = '{{$air_type}}';
            activity_id = elem.data('activity-id');
            fiscal_year_id = elem.data('fiscal-year-id');
            annual_plan_id = elem.data('annual-plan-id');
            audit_plan_id = elem.data('audit-plan-id');
            air_description = JSON.stringify(templateArray);

            data = {air_id,apottis,all_apottis,audit_plan_entities,air_type,activity_id,fiscal_year_id,annual_plan_id,audit_plan_id,air_description};
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'success') {
                    elem.data('air-id',response.data.air_id);
                    $("#airId").val(response.data.air_id);
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
            url = '{{route('audit.report.air.preview')}}';

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
