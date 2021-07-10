<script>
    $('.btn_create_audit_activity').on('click', function () {
        let url = $(this).data('url')
        ajaxCallAsyncCallbackAPI(url, {}, 'GET', function (response) {
            console.log(response)
            if (response.status === 'error') {
                toastr.error(response.data)
            }
            $("#kt_content").html(response);
        });
    })

    $('.btn_view_audit_annual_activity').on('click', function () {
        let url = $(this).data('url')
        ajaxCallAsyncCallback(url, {}, 'html', 'GET', function (response) {
            $("#kt_content").html(response);
        });
    })

    $('.btn_edit_audit_annual_activity').on('click', function () {
        let url = $(this).data('url')
        ajaxCallAsyncCallback(url, {}, 'html', 'GET', function (response) {
            $("#kt_content").html(response);
        });
    })

    $('#select_strategic_outcome').on('change', function () {
        outcome_id = $(this).val();
        if (outcome_id) {
            get_outcome_remarks_url = '{{route('generic.outcome.remarks')}}';
            ajaxCallAsyncCallbackAPI(get_outcome_remarks_url, {outcome_id}, 'POST', function (response) {
                $('#outcome_remarks_area').data('outcome-id', response.id)
                $('#outcome_remarks_area').html(response.remarks)
            });

            get_output_by_outcome_url = '{{route('audit.plan.operational.activity.load.outputs.by.outcome')}}';
            ajaxCallAsyncCallbackAPI(get_output_by_outcome_url, {outcome_id}, 'POST', function (response) {
                $('#strategic_output_area').html(response)
            });
        }
    })
</script>
