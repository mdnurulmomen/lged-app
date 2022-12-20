<script>
    var Plan_Common_Container = {
        addLocationRow: function (strategic_year,row_type) {
            loaderStart('loading...');
            row_count = $('.'+row_type+'_row_'+strategic_year).length + 1;
            let url = '{{route('audit.plan.strategy.add-location-row')}}';
            let data = {strategic_year,row_type,row_count};
            ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
                loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#'+row_type+'_table_'+strategic_year).append(response);
                }
            });
        },

        removeLocationRow: function (element) {
            element.closest("tr").remove();
        },

        loadCostCenterProjectMap: function (project_id,row_no,strategic_year) {
            let url = '{{route('audit.plan.strategy.get-cost-center-project-map')}}';
            let data = {project_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#location_'+strategic_year+'_'+row_no).html(response);
                }
            });
        },
    };
</script>
