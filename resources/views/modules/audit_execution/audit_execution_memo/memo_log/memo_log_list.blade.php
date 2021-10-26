<table class="table table-striped mt-2">
    <thead class="thead-light">
    <tr class="datatable-row" style="left: 0px; ">
        <th class="datatable-cell datatable-cell-sort">
            No
        </th>
        <th class="datatable-cell datatable-cell-sort">
            Date
        </th>
        <th class="datatable-cell datatable-cell-sort">
            Action
        </th>
    </tr>
    </thead>
    <tbody style="" class="datatable-body">
    @forelse($log_list['data'] as $log)
        <tr id="row_{{$log['id']}}" class="datatable-row" style="left: 0px;">
            <td class="datatable-cell"><span>{{$loop->iteration}}</span></td>

            <td class="datatable-cell">
                {{$log['created_at']}}
            </td>

            <td class="datatable-cell">
                <button title="Show Log"
                        class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary show_log"
                        data-id="{{$log['id']}}"
                        data-content="{{$log['memo_content_change']}}">
                    <i class="fa fa-eye"></i>
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
<script>

    $('.btn_create_recommendation').click(function () {
        memo_id = $('#memo_id').val();
        url = '{{route('audit.execution.memo.audit-memo-recommendation-store')}}';
        data = $('#add_recommendation_form').serialize();
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (resp) {
            if (resp.status === 'error') {
                toastr.error(resp.data);
            } else {
                toastr.success(resp.data);
                Memo_List_Container.recommendationMemo(memo_id)
            }
        });
    });

    $('.show_log').click(function () {
        $('.memo_log_row').remove();
        id = $(this).attr('data-id');
        log_info = $(this).attr('data-content');
        url = '{{route('audit.execution.memo.audit-memo-log-show')}}';
        data = {log_info};
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (resp) {
            if (resp.status === 'error') {
                toastr.error(resp.data);
            } else {
                $('#row_'+id).after('<tr class="memo_log_row bg-white"><td colspan="3"><div class="memo_log_info"></div></td></tr>');
                $('.memo_log_info').html(resp);
            }
        });

    });

    $('.btn_close').click(function (){
       $('.recommendation_form').hide();
    });
</script>
