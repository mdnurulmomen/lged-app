<div class="card card-custom card-stretch">
    <div class="card-body p-0">
        <div id="load_query_list"></div>
    </div>
</div>

<script>

    $(function () {
        KTApp.block('#kt_content', {
            opacity: 0.1,
            state: 'primary' // a bootstrap color
        });
        url = '{{route('audit.execution.load-authority-query-list')}}';
        data = {};
        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
            KTApp.unblock('#kt_content');
            if (response.status === 'error') {
                toastr.warning(response.data)
            } else {
                $('#load_query_list').html(response);
            }
        })
    })
</script>
