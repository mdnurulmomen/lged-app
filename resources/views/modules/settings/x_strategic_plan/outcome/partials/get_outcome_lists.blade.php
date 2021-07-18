<table class="datatable-bordered datatable-head-custom datatable-table"
       id="kt_datatable"
       style="display: block;">

    <thead class="datatable-head">
    <tr class="datatable-row" style="left: 0px;">
        <th class="datatable-cell datatable-cell-sort">
            Duration
        </th>
        <th class="datatable-cell datatable-cell-sort">
            Outcome No
        </th>

        <th class="datatable-cell datatable-cell-sort">
            Title En
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
    @forelse($plan_outcomes as $plan_outcome)
        <tr data-row="{{$loop->iteration}}" class="datatable-row">
            <td class="datatable-cell text-center">
                <span>{{$plan_outcome['plan_duration']['start_year']}} - {{$plan_outcome['plan_duration']['end_year']}}</span>
            </td>
            <td class="datatable-cell text-center"><span>{{$plan_outcome['outcome_no']}}</span></td>
            <td class="datatable-cell text-center"><span>{{$plan_outcome['outcome_title_en']}}</span></td>
            <td class="datatable-cell text-center"><span>{{$plan_outcome['outcome_title_bn']}}</span></td>
            <td class="datatable-cell text-center">
                <a href="javascript:;"
                   data-id="{{$plan_outcome['id']}}"
                   data-duration-id="{{$plan_outcome['duration_id']}}"
                   data-no="{{$plan_outcome['outcome_no']}}"
                   data-title-en="{{$plan_outcome['outcome_title_en']}}"
                   data-title-bn="{{$plan_outcome['outcome_title_bn']}}"
                   data-remarks="{{$plan_outcome['remarks']}}"
                   data-url="{{route('settings.strategic-plan.outcome.update', ['outcome' => $plan_outcome['id']])}}"
                   data-method="PUT"
                   class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_edit_plan_outcome">
                    <i class="fas fa-edit"></i>
                </a>
            </td>
            <td class="datatable-cell text-center">
                <a href="javascript:;"
                   data-url="{{route('settings.strategic-plan.outcome.destroy', ['outcome' => $plan_outcome['id']])}}"
                   class="btn btn-icon btn-outline-danger btn-xs border-0 mr-2 delete_plan_outcome">
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
    $('.btn_edit_plan_outcome').click(function () {
        $('#plan_outcome_modal_title').text('Update ' + $(this).data('title-en'));
        $('#btn_plan_outcome_modal_save').text('Update');
        $('#btn_plan_outcome_modal_save').data('url', $(this).data('url'));
        $('#btn_plan_outcome_modal_save').data('method', $(this).data('method'));
        $('#duration_id').val($(this).data('duration-id')).trigger('change');
        $('#outcome_id').val($(this).data('id'));
        $('#outcome_title_en').val($(this).data('title-en'));
        $('#outcome_no').val($(this).data('no'));
        $('#outcome_title_bn').val($(this).data('title-bn'));
        $('#remarks').val($(this).data('remarks'));
        $('#plan_outcome_modal').modal('show');
    });

    $('.delete_plan_outcome').click(function () {
        url = $(this).data('url');
        submitModalData(url, {}, 'delete', 'plan_outcome_modal');
    });
</script>
