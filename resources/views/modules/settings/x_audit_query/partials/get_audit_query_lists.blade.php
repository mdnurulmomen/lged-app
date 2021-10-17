<table class="table table-striped">
    <thead class="thead-light">
    <tr class="datatable-row" style="left: 0px; ">
        <th class="datatable-cell datatable-cell-sort text-center">
            Cost Center Type
        </th>
        <th class="datatable-cell datatable-cell-sort text-center">
            Query Title Bn
        </th>

        <th class="datatable-cell datatable-cell-sort text-center">
            Query Title En
        </th>

        <th class="datatable-cell datatable-cell-sort text-center">
            <i class="fas fa-edit"></i></th>

        <th class="datatable-cell datatable-cell-sort text-center">
            <i class="fas fa-trash-alt"></i>
        </th>
    </tr>
    </thead>
    <tbody style="" class="datatable-body">
    @forelse($audit_querys as $audit_query)
        <tr data-row="{{$loop->iteration}}" class="datatable-row" style="left: 0px;">
            <td class="datatable-cell text-center"><span>{{$audit_query['cost_center_type']['name_bn']}}</span></td>
            <td class="datatable-cell text-center"><span>{{$audit_query['query_title_en']}}</span></td>
            <td class="datatable-cell text-center"><span>{{$audit_query['query_title_bn']}}</span></td>
            <td class="datatable-cell text-center">
                <a href="javascript:;"
                   data-audit-query-id="{{$audit_query['id']}}"
                   data-audit-query-cost-center-type="{{$audit_query['cost_center_type_id']}}"
                   data-audit-query-title-en="{{$audit_query['query_title_en']}}"
                   data-audit-query-title-bn="{{$audit_query['query_title_en']}}"
                   data-url="{{route('settings.audit-query.update', ['audit_query' => $audit_query['id']])}}"
                   data-method="PUT"
                   class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_edit_audit_query">
                    <i class="fas fa-edit"></i>
                </a>
            </td>
            <td class="datatable-cell text-center">
                <a href="javascript:;"
                   data-fiscal-year-id="{{$audit_query['id']}}"
                   data-url="{{route('settings.audit-query.destroy', ['audit_query' => $audit_query['id']])}}"
                   class="btn btn-icon btn-outline-danger btn-xs border-0 mr-2 delete_audit_query">
                    <i class="fal fa-trash-alt"></i>
                </a>
            </td>
        </tr>
    @empty
        <tr data-row="0" class="datatable-row" style="left: 0px;">
            <td colspan="4" class="datatable-cell text-center"><span>Nothing Found</span></td>
        </tr>
    @endforelse
    </tbody>
</table>

<script>
    $('.btn_edit_audit_query').click(function () {
        $('#audit_query_modal_title').text('Update ' + $(this).data('fiscal-year-start') + ' - ' + $(this).data('fiscal-year-start'));
        $('#btn_audit_query_modal_save').text('Update');
        $('#btn_audit_query_modal_save').data('url', $(this).data('url'));
        $('#btn_audit_query_modal_save').data('method', $(this).data('method'));
        $('#audit_query_id').val($(this).data('fiscal-year-id'));
        $('#duration_id').val($(this).data('fiscal-year-duration')).trigger('change');
        $('#start_audit_query').val($(this).data('fiscal-year-start'));
        $('#end_audit_query').val($(this).data('fiscal-year-end'));
        $('#description').val($(this).data('fiscal-year-desc'));
        $('#audit_query_modal').modal('show');
    });

    $('.delete_audit_query').click(function () {
        url = $(this).data('url');
        submitModalData(url, {}, 'delete', 'audit_query_modal');
    });
</script>
