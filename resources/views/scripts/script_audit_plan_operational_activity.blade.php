<script>
    $('.btn_create_audit_activity').on('click', function () {
        let url = $(this).data('url')
        ajaxCallAsyncCallback(url, {}, 'html', 'GET', function (response) {
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
</script>
