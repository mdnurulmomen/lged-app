<x-title-wrapper>Summery Report</x-title-wrapper>

<div class="card sna-card-border mt-2">
    <div class="table-responsive load-table-data">
    </div>
</div>

<script>
     $(function () {
        loadData();
    });

    function loadData() {
        url = "{{ route('audit.plan.audit-plans.list') }}";

        var data = {};

        ajaxCallAsyncCallbackAPI(url, data, 'GET', function (resp) {
            if (resp.status === 'error') {
                toastr.error('no');
                console.log(resp.data)
            } else {
                $(".load-table-data").html(resp);
            }
        });
    }
</script>

@include('scripts.script_generic')
