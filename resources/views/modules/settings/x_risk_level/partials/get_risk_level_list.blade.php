<table class="table table-bordered" width="100%">
    <thead class="thead-light">
    <tr>
        <th>
            From
        </th>

        <th>
            To
        </th>

        <th>
            Type
        </th>

        <th width="30%">
            Title Bn
        </th>

        <th width="30%">
            Title En
        </th>

        <th width="15%">
            Action
        </th>
    </tr>
    </thead>
    <tbody>
    @forelse($risk_level_list as $risk_level)
        <tr id="row_{{$risk_level['id']}}" data-row="{{$loop->iteration}}">
            <td> {{ $risk_level['level_from'] }} </td>
            <td> {{ $risk_level['level_to'] }} </td>
            <td> {{ ucfirst($risk_level['type']) }} </td>
            <td> {{ ucfirst($risk_level['title_bn']) }} </td>
            <td> {{ ucfirst($risk_level['title_en']) }} </td>
            <td>
                <a href="javascript:;"
                    data-id="{{$risk_level['id']}}" 
                    data-level-from="{{$risk_level['level_from']}}" 
                    data-level-to="{{$risk_level['level_to']}}" 
                    data-level-type="{{$risk_level['type']}}" 
                    data-title-en="{{$risk_level['title_bn']}}"
                    data-title-bn="{{$risk_level['title_en']}}" 
                    class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_edit_risk_level">
                    <i class="fas fa-edit"></i>
                </a>
                
                <a href="javascript:;"
                   data-id="{{$risk_level['id']}}"
                   data-url="{{ route('settings.risk-levels.destroy', $risk_level['id']) }}"
                   class="btn btn-icon btn-outline-danger btn-xs border-0 mr-2 delete_risk_level">
                    <i class="fal fa-trash-alt"></i>
                </a>
            </td>
        </tr>
    @empty
        <tr data-row="0" class="datatable-row" style="left: 0px;">
            <td colspan="6" class="datatable-cell text-center"><span>Nothing Found</span></td>
        </tr>
    @endforelse
    </tbody>
</table>

<script>
    $('.btn_edit_risk_level').click(function () {
        quick_panel = $("#kt_quick_panel");
        $('.offcanvas-wrapper').html('');
        quick_panel.addClass('offcanvas-on');
        quick_panel.css('opacity', 1);
        quick_panel.css('width', '500px');
        $('.offcanvas-footer').hide();
        quick_panel.removeClass('d-none');
        $("html").addClass("side-panel-overlay");
        $('.offcanvas-title').html('Edit Risk Level');

        id = $(this).data('id');
        level_from = $(this).data('level-from');
        level_to = $(this).data('level-to');
        type = $(this).data('level-type');
        title_en =$(this).data('title-en');
        title_bn = $(this).data('title-bn');

        url = "{{ route('settings.risk-levels.edit') }}";
        var data = {id,level_from,level_to,type,title_bn,title_en};
        
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (resp) {
            if (resp.status === 'error') {
                toastr.error('no');
                console.log(resp.data)
            } else {
                // $('#id').val(id);
                // $('#title_bn').text(title_bn);
                // $('#title_en').text(title_en);
                // $('#level_value').val(level_value);
                // $('#x_risk_factor_id').val(x_risk_factor_id);
                $('.offcanvas-wrapper').html(resp);
            }
        });
    });

    $(".delete_risk_level").click(function () {

         id = $(this).data('id');
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
</script>
