<x-title-wrapper>Audit Query</x-title-wrapper>
<div class="card sna-card-border d-flex flex-wrap flex-row">
    <div class="col-xl-12 text-right">
        <button type="button" data-url="{{route('settings.audit-query.store')}}" data-method="POST"
                class="font-weight-bolder font-size-sm mr-3 btn btn-success btn-sm btn-bold btn-square btn_create_audit_query">
            <i class="far fa-plus mr-1"></i> Create Query
        </button>
    </div>
</div>

<div class="card sna-card-border mt-2">
    <div class="table-responsive load-table-data"
         data-href="{{route('settings.audit-query.lists')}}">
    </div>
</div>

<!-- Modal-->
@include('modules.settings.x_audit_query.partials.query_modal')

<script>
     $(function () {
        $('[data-toggle="tooltip"]').tooltip();
        if ($(".load-table-data").length > 0) {
            loadData();
        }
    });

    function loadData() {
        url = $(".load-table-data").data('href');
        var data = {};
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (resp) {
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
