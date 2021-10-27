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
        <tr id="row_{{$audit_query['id']}}" data-row="{{$loop->iteration}}" class="datatable-row" style="left: 0px;">
            <td class="datatable-cell text-center"><span>{{$audit_query['cost_center_type']['name_bn']}}</span></td>
            <td class="datatable-cell text-center"><span>{{$audit_query['query_title_en']}}</span></td>
            <td class="datatable-cell text-center"><span>{{$audit_query['query_title_bn']}}</span></td>
            <td class="datatable-cell text-center">
                <a href="javascript:;"
                   data-audit-query-id="{{$audit_query['id']}}"
                   data-audit-query-cost-center-type="{{$audit_query['cost_center_type_id']}}"
                   data-audit-query-title-en="{{$audit_query['query_title_en']}}"
                   data-audit-query-title-bn="{{$audit_query['query_title_bn']}}"
                   class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_edit_audit_query">
                    <i class="fas fa-edit"></i>
                </a>
            </td>
            <td class="datatable-cell text-center">
                <a href="javascript:;"
                   data-audit-query-id="{{$audit_query['id']}}"
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
        quick_panel = $("#kt_quick_panel");
        $('.offcanvas-wrapper').html('');
        quick_panel.addClass('offcanvas-on');
        quick_panel.css('opacity', 1);
        quick_panel.css('width', '500px');
        $('.offcanvas-footer').hide();
        quick_panel.removeClass('d-none');
        $("html").addClass("side-panel-overlay");
        $('.offcanvas-title').html('Edit Query');

        audit_query_id = $(this).data('audit-query-id');
        audit_query_cost_center_type = $(this).data('audit-query-cost-center-type');
        audit_query_title_en =$(this).data('audit-query-title-en');
        audit_query_title_bn = $(this).data('audit-query-title-bn');

        url = '{{route('settings.audit-query.edit')}}';
        var data = {audit_query_id,audit_query_cost_center_type,audit_query_title_en,audit_query_title_bn};
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (resp) {
            if (resp.status === 'error') {
                toastr.error('no');
                console.log(resp.data)
            } else {
                $('#audit_query_id').val(audit_query_id);
                $('#cost_center_type_id').val(audit_query_cost_center_type);
                $('#audit_query_title_en').text(audit_query_title_en);
                $('#audit_query_title_bn').text(audit_query_title_bn);
                $('.offcanvas-wrapper').html(resp);
            }
        });
    });

    $(".delete_audit_query").click(function () {

         id = $(this).data('audit-query-id');
         url = $(this).data('url');

        swal.fire({
            title: 'আপনি কি তথ্যটি মুছে ফেলতে চান?',
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'হ্যাঁ',
            cancelButtonText: 'না'
        }).then(function (result) {
            if (result.value) {
                ajaxCallAsyncCallbackAPI(url, {}, 'delete', function (resp) {
                    if (resp.status === 'error') {
                        toastr.error('no');
                        console.log(resp.data)
                    } else {
                        toastr.success('Delete Successfully');
                        $('#row_' + id).remove();
                    }
                });

            }
        });
    });

    // $('.delete_audit_query').click(function () {
    //     id = $(this).data('audit-query-id');
    //     url = $(this).data('url');
    //     // submitModalData(url, {}, 'delete', 'audit_query_modal');
    //     ajaxCallAsyncCallbackAPI(url, {}, 'delete', function (resp) {
    //         if (resp.status === 'error') {
    //             toastr.error('no');
    //             console.log(resp.data)
    //         } else {
    //             toastr.success('Delete Successfully');
    //             $('#row_'+id).remove();
    //         }
    //     });
    // });
</script>
