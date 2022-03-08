<table class="table table-bordered" width="100%">
    <thead class="thead-light">
    <tr class="bg-hover-warning">
        <th>
            Duration
        </th>
        <th>
            Outcome
        </th>
        <th>
            Output No
        </th>

        <th>
            Title English
        </th>

        <th>
            Title Bangla
        </th>

        <th>
            Action
        </th>

    </tr>
    </thead>
    <tbody>
    @forelse($plan_outputs as $plan_output)
        <tr data-row="{{$loop->iteration}}">
            <td>
                <span>{{$plan_output['plan_outcome']['plan_duration']['start_year']}} - {{$plan_output['plan_outcome']['plan_duration']['end_year']}}</span>
            </td>
            <td>
                <span>{{$plan_output['plan_outcome']['outcome_no']}}</span>
            </td>
            <td><span>{{$plan_output['output_no']}}</span></td>
            <td><span>{{$plan_output['output_title_en']}}</span></td>
            <td><span>{{$plan_output['output_title_bn']}}</span></td>
            <td class="text-center">
                <a href="javascript:;"
                   data-id="{{$plan_output['id']}}"
                   data-duration-id="{{$plan_output['duration_id']}}"
                   data-outcome-id="{{$plan_output['outcome_id']}}"
                   data-no="{{$plan_output['output_no']}}"
                   data-title-en="{{$plan_output['output_title_en']}}"
                   data-title-bn="{{$plan_output['output_title_bn']}}"
                   data-remarks="{{$plan_output['remarks']}}"
                   data-url="{{route('settings.strategic-plan.output.update', ['output' => $plan_output['id']])}}"
                   data-method="PUT"
                   class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_edit_plan_output">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="javascript:;"
                   data-url="{{route('settings.strategic-plan.output.destroy', ['output' => $plan_output['id']])}}"
                   class="btn btn-icon btn-outline-danger btn-xs border-0 mr-2 delete_plan_output">
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
    $('.btn_edit_plan_output').click(function () {
        $('#plan_output_modal_title').text('Update ' + $(this).data('title-en'));
        $('#btn_plan_output_modal_save').text('Update');
        $('#btn_plan_output_modal_save').data('url', $(this).data('url'));
        $('#btn_plan_output_modal_save').data('method', $(this).data('method'));
        $('#duration_id').val($(this).data('duration-id')).trigger('change');
        $('#outcome_id').val($(this).data('outcome-id')).trigger('change');
        $('#output_id').val($(this).data('id'));
        $('#output_title_en').val($(this).data('title-en'));
        $('#output_no').val($(this).data('no'));
        $('#output_title_bn').val($(this).data('title-bn'));
        $('#remarks').val($(this).data('remarks'));
        $('#plan_output_modal').modal('show');
    });

    $('.delete_plan_output').click(function () {
        url = $(this).data('url');
        submitModalData(url, {}, 'delete', 'plan_output_modal');
    });
</script>
