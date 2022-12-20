@forelse($working_plan_list as $workPaper)
    <tr id="row_{{$workPaper['id']}}" data-row="{{$loop->iteration}}">
        <td>
            {{ ucfirst($workPaper['title_en']) }}
        </td>

        <td>
            {{ ucfirst($workPaper['title_en']) }}
        </td>

        <td>
            <a href="{{ config('amms_bee_routes.file_url').$workPaper['attachment'] }}" class="btn btn-download btn-sm btn-bold btn-square ml-auto">
                <i class="fa fa-file" aria-hidden="true"></i>
                Download
            </a>
        </td>
    </tr>
@empty
    <tr data-row="0" class="datatable-row" style="left: 0px;">
        <td colspan="3" class="datatable-cell text-danger text-center"><span>No Workpaper Found</span></td>
    </tr>
@endforelse
