<table class="table table-bordered" width="100%">
    <thead class="thead-light">
    <tr>
        <th>
            Start Year
        </th>
        <th>
            End Year
        </th>

        <th>
            Action
        </th>
    </tr>
    </thead>
    <tbody>
    @forelse($fiscal_years as $fiscal_year)
        <tr data-row="{{$loop->iteration}}">
            <td><span>{{$fiscal_year['start']}}</span></td>
            <td><span>{{$fiscal_year['end']}}</span></td>
            <td>
                <a href="javascript:;"
                   data-fiscal-year-id="{{$fiscal_year['id']}}"
                   data-fiscal-year-duration="{{$fiscal_year['duration_id']}}"
                   data-fiscal-year-start="{{$fiscal_year['start']}}"
                   data-fiscal-year-end="{{$fiscal_year['end']}}"
                   data-fiscal-year-desc="{{$fiscal_year['description']}}"
                   data-url="{{route('settings.fiscal-years.update', ['fiscal_year' => $fiscal_year['id']])}}"
                   data-method="PUT"
                   class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_edit_fiscal_year">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="javascript:;"
                   data-fiscal-year-id="{{$fiscal_year['id']}}"
                   data-url="{{route('settings.fiscal-years.destroy', ['fiscal_year' => $fiscal_year['id']])}}"
                   class="btn btn-icon btn-outline-danger btn-xs border-0 mr-2 delete_fiscal_year">
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
    $('.btn_edit_fiscal_year').click(function () {
        $('#fiscal_year_modal_title').text('Update ' + $(this).data('fiscal-year-start') + ' - ' + $(this).data('fiscal-year-start'));
        $('#btn_fiscal_year_modal_save').text('Update');
        $('#btn_fiscal_year_modal_save').data('url', $(this).data('url'));
        $('#btn_fiscal_year_modal_save').data('method', $(this).data('method'));
        $('#fiscal_year_id').val($(this).data('fiscal-year-id'));
        $('#duration_id').val($(this).data('fiscal-year-duration')).trigger('change');
        $('#start_fiscal_year').val($(this).data('fiscal-year-start'));
        $('#end_fiscal_year').val($(this).data('fiscal-year-end'));
        $('#description').val($(this).data('fiscal-year-desc'));
        $('#fiscal_year_modal').modal('show');
    });

    $('.delete_fiscal_year').click(function () {
        url = $(this).data('url');
        swal.fire({
            title: 'আপনি কি তথ্যটি মুছে ফেলতে চান?',
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'হ্যাঁ',
            cancelButtonText: 'না'
        }).then(function(result) {
            if (result.value) {
                submitModalData(url, {}, 'delete', 'fiscal_year_modal');
                loadData();
            }
        });
    });
</script>
