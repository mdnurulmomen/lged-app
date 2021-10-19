<div class="col-lg-12 mt-2">
    <button
        type="button"
        data-id="1"
        class="float-right font-weight-bolder font-size-sm mb-3 btn btn-success btn-sm btn-bold btn-square btn_create_audit_query">
        <i class="far fa-plus mr-1"></i> Add
    </button>
    <button
        type="button"
        class="float-right font-weight-bolder font-size-sm ml-2 btn btn-success btn-sm btn-bold btn-square sendQuery">
        <i class="far fa-paper-plane mr-1"></i> Send
    </button>
</div>

<table class="table table-striped mt-2">
    <thead class="thead-light">
    <tr class="datatable-row" style="left: 0px; ">
        <th class="datatable-cell datatable-cell-sort text-center">
            Select
        </th>
        <th class="datatable-cell datatable-cell-sort text-center">
            Query
        </th>
        <th class="datatable-cell datatable-cell-sort text-center">
            Action
        </th>
    </tr>
    </thead>
    <tbody style="" class="datatable-body">
    @forelse($audit_query_list as $query)
        <tr data-row="{{$loop->iteration}}" class="datatable-row" style="left: 0px;">
            <td class="datatable-cell text-center"><span><input class="selectQuery" value="{{$query['id']}}-{{$query['query_title_bn']}}-{{$query['query_title_en']}}" name="select_query" type="checkbox"></span></td>
            <td class="datatable-cell"><span>{{$query['query_title_bn']}}</span></td>
            <td class="datatable-cell text-center">
                <button
                    type="button"
                    class="float-right font-weight-bolder font-size-sm ml-2 btn btn-success btn-sm btn-bold btn-square receivedQuery">
                     Received
                </button>
            </td>
        </tr>
    @empty
        <tr data-row="0" class="datatable-row" style="left: 0px;">
            <td colspan="4" class="datatable-cell text-center"><span>Nothing Found</span></td>
        </tr>
    @endforelse
    </tbody>
</table>
@include('modules.settings.x_audit_query.partials.query_modal')

<script>

    $('.sendQuery').click(function () {
        cost_center_id = $('#cost_center_id').val();
        cost_center_name_en = $('#cost_center_name_en').val();
        cost_center_name_bn = $('#cost_center_name_bn').val();
        cost_center_type_id = $('#cost_center_type').val();
        query_ids = [];
        $(".selectQuery").each(function(i,value) {
            query_ids[i] = $(this).val();
        });
        url = '{{route('audit.execution.send-audit-query')}}';
        data = {query_ids,cost_center_id,cost_center_type_id,cost_center_name_bn,cost_center_name_en};
        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
            if (response.status === 'error') {
                toastr.warning(response.data)
            } else {
                toastr.warning(response.data)
            }
        })
    });
</script>
