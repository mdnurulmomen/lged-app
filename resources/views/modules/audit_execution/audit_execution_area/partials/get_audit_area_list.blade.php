<table class="table table-bordered" width="100%">
    <thead class="thead-light">
    <tr>
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
    @forelse($audit_area_list as $audit_area)
        <tr id="row_{{$audit_area['id']}}" data-row="{{$loop->iteration}}">
            <td> {{ ucfirst($audit_area['name_bn']) }} </td>
            <td> {{ ucfirst($audit_area['name_en']) }} </td>
            <td>
                <a href="javascript:;"
                   data-id="{{$audit_area['id']}}" 
                   data-title-en="{{$audit_area['name_bn']}}"
                   data-title-bn="{{$audit_area['name_en']}}" 
                   class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_edit_audit_area">
                    <i class="fas fa-edit"></i>
                </a>
                
                <a href="javascript:;"
                   data-id="{{$audit_area['id']}}"
                   data-url="{{ route('audit.execution.areas.destroy', $audit_area['id']) }}"
                   class="btn btn-icon btn-outline-danger btn-xs border-0 mr-2 delete_audit_area">
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
    $('.btn_edit_audit_area').click(function () {
        quick_panel = $("#kt_quick_panel");
        $('.offcanvas-wrapper').html('');
        quick_panel.addClass('offcanvas-on');
        quick_panel.css('opacity', 1);
        quick_panel.css('width', '500px');
        $('.offcanvas-footer').hide();
        quick_panel.removeClass('d-none');
        $("html").addClass("side-panel-overlay");
        $('.offcanvas-title').html('Edit Audit Area');

        id = $(this).data('id');
        name_en =$(this).data('title-en');
        name_bn = $(this).data('title-bn');

        url = "{{ route('audit.execution.areas.edit') }}";
        var data = {id,name_bn,name_en};
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (resp) {
            if (resp.status === 'error') {
                toastr.error('no');
                console.log(resp.data)
            } else {
                // $('#id').val(id);
                // $('#risk_weight').val(risk_weight);
                // $('#name_bn').text(name_bn);
                // $('#name_en').text(name_en);
                $('.offcanvas-wrapper').html(resp);
            }
        });
    });

    $(".delete_audit_area").click(function () {

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
