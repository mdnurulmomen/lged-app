<table class="datatable-bordered datatable-head-custom datatable-table"
       id="kt_datatable"
       style="display: block;">

    <thead class="datatable-head">
    <tr class="datatable-row" style="left: 0px;">
        <th class="datatable-cell datatable-cell-sort">
            Duration
        </th>
        <th class="datatable-cell datatable-cell-sort">
            Activity No
        </th>
        <th class="datatable-cell datatable-cell-sort">
            Title
        </th>

        <th class="datatable-cell datatable-cell-sort">
            Title Bn
        </th>

        <th class="datatable-cell datatable-cell-sort">
            <i class="fas fa-edit"></i></th>

        <th class="datatable-cell datatable-cell-sort">
            <i class="fas fa-trash-alt"></i>
        </th>
    </tr>
    </thead>
    <tbody style="" class="datatable-body">
    @forelse($op_activities as $op_activity)
        @if($op_activity['plan_output'])
            <tr data-row="0" class="datatable-row" style="left: 0px;">
                <td class="datatable-cell text-center">
                <span>{{$op_activity['plan_output']['plan_outcome']['plan_duration']['start_year']}} -
                    {{$op_activity['plan_output']['plan_outcome']['plan_duration']['end_year']}}</span>
                </td>
                <td class="datatable-cell text-center"><span>{{$op_activity['activity_no']}}</span></td>
                <td class="datatable-cell text-center"><span>{{$op_activity['title_en']}}</span></td>
                <td class="datatable-cell text-center"><span>{{$op_activity['title_bn']}}</span></td>
                <td class="datatable-cell">
                    <a href="javascript:;"
                       data-activity-id="{{$op_activity['id']}}"
                       data-url="{{route('settings.operational-plan.activity.edit', ['activity' => $op_activity['id']])}}"
                       class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_edit_op_activity">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
                <td class="datatable-cell">
                    <a href="javascript:;"
                       data-fiscal-year-id="{{$op_activity['id']}}"
                       data-url="{{route('settings.operational-plan.activity.destroy', ['activity' => $op_activity['id']])}}"
                       class="btn btn-icon btn-outline-danger btn-xs border-0 mr-2 btn_delete_op_activity">
                        <i class="fal fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
        @endif
    @empty
        <tr data-row="0" class="datatable-row" style="left: 0px;">
            <td colspan="4" class="datatable-cell text-center"><span>Nothing Found</span></td>
        </tr>
    @endforelse
    </tbody>
</table>

<script>
    $('.btn_edit_op_activity').click(function () {
        url = $(this).data('url');
        modal_id = $(".modal_area").data('modal-id');
        var data = {};
        ajaxCallAsyncCallbackAPI(url, data, 'GET', function (resp) {
            if (resp.status === 'error') {
                toastr.error('no');
                console.log(resp.data)
            } else {
                $(".modal_area").html(resp);
                $('#' + modal_id).modal('show');
            }
        });
    });

    $('.btn_delete_op_activity').click(function () {
        url = $(this).data('url');
        submitModalData(url, {}, 'delete', 'op_activity_modal');
    });
</script>
