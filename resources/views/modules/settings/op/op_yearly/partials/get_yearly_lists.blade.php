<table class="datatable-bordered datatable-head-custom datatable-table"
       id="kt_datatable"
       style="display: block;">

    <thead class="datatable-head">
    <tr class="datatable-row" style="left: 0px;">
        <th class="datatable-cell datatable-cell-sort">
            Start Year
        </th>
        <th class="datatable-cell datatable-cell-sort">
            End Year
        </th>

        <th class="datatable-cell datatable-cell-sort">
            <i class="fas fa-edit"></i></th>

        <th class="datatable-cell datatable-cell-sort">
            <i class="fas fa-trash-alt"></i>
        </th>
    </tr>
    </thead>
    <tbody style="" class="datatable-body">
    @forelse($op_yearlies as $op_yearly)
        <tr data-row="0" class="datatable-row" style="left: 0px;">
            <td class="datatable-cell text-center"><span>{{$op_yearly['start_year']}}</span></td>
            <td class="datatable-cell text-center"><span>{{$op_yearly['end_year']}}</span></td>
            <td class="datatable-cell text-center">
                <a href="javascript:;"
                   data-fiscal-year-id="{{$op_yearly['id']}}"
                   data-fiscal-year-start="{{$op_yearly['start_year']}}"
                   data-fiscal-year-end="{{$op_yearly['end_year']}}"
                   data-fiscal-year-desc="{{$op_yearly['description']}}"
                   data-url="{{route('settings.operational-plan.yearly.update', ['yearly' => $op_yearly['id']])}}"
                   data-method="PUT"
                   class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_edit_op_yearly">
                    <i class="fas fa-edit"></i>
                </a>
            </td>
            <td class="datatable-cell text-center">
                <a href="javascript:;"
                   data-fiscal-year-id="{{$op_yearly['id']}}"
                   data-url="{{route('settings.operational-plan.yearly.destroy', ['yearly' => $op_yearly['id']])}}"
                   class="btn btn-icon btn-outline-danger btn-xs border-0 mr-2 btn_delete_op_yearly">
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
    $('.btn_edit_op_yearly').click(function () {
        $('#op_yearly_modal_title').text('Update ' + $(this).data('fiscal-year-start') + ' - ' + $(this).data('fiscal-year-start'));
        $('#btn_op_yearly_modal_save').text('Update');
        $('#btn_op_yearly_modal_save').data('url', $(this).data('url'));
        $('#btn_op_yearly_modal_save').data('method', $(this).data('method'));
        $('#op_yearly_id').val($(this).data('fiscal-year-id'));
        $('#end_op_yearly').val($(this).data('fiscal-year-end'));
        $('#start_op_yearly').val($(this).data('fiscal-year-start'));
        $('#description').val($(this).data('fiscal-year-desc'));
        $('#op_yearly_modal').modal('show');
    });

    $('.btn_delete_op_yearly').click(function () {
        url = $(this).data('url');
        submitModalData(url, {}, 'delete', 'op_yearly_modal');
    });
</script>
