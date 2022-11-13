<table class="table table-bordered" width="100%">
    <thead class="thead-light">
    <tr>
        <th width="30%">
            Title Bn
        </th>

        <th width="30%">
            Title En
        </th>

        <th>
            Factor
        </th>

        <th width="15%">
            Action
        </th>
    </tr>
    </thead>
    <tbody>
    @forelse($risk_criterion_list as $risk_criterion)
        <tr id="row_{{$risk_criterion['id']}}" data-row="{{$loop->iteration}}">
            <td> {{ ucfirst($risk_criterion['title_bn']) }} </td>
            <td> {{ ucfirst($risk_criterion['title_en']) }} </td>
            <td> {{ $risk_criterion['x_risk_factor']['title_en'] }} </td>
            <td>
                <a href="javascript:;"
                   data-id="{{$risk_criterion['id']}}" 
                   data-title-en="{{$risk_criterion['title_bn']}}"
                   data-title-bn="{{$risk_criterion['title_en']}}" 
                   data-x-risk-factor-id="{{ $risk_criterion['x_risk_factor_id'] }}" 
                   class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_edit_risk_criterion">
                    <i class="fas fa-edit"></i>
                </a>
                
                <a href="javascript:;"
                   data-id="{{$risk_criterion['id']}}"
                   data-url="{{ route('settings.risk-criteria.destroy', $risk_criterion['id']) }}"
                   class="btn btn-icon btn-outline-danger btn-xs border-0 mr-2 delete_risk_criterion">
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
    $('.btn_edit_risk_criterion').click(function () {
        quick_panel = $("#kt_quick_panel");
        $('.offcanvas-wrapper').html('');
        quick_panel.addClass('offcanvas-on');
        quick_panel.css('opacity', 1);
        quick_panel.css('width', '500px');
        $('.offcanvas-footer').hide();
        quick_panel.removeClass('d-none');
        $("html").addClass("side-panel-overlay");
        $('.offcanvas-title').html('Edit Risk Criterion');

        id = $(this).data('id');
        title_en =$(this).data('title-en');
        title_bn = $(this).data('title-bn');
        x_risk_factor_id = $(this).data('x-risk-factor-id');

        url = "{{ route('settings.risk-criteria.edit') }}";
        var data = {id,x_risk_factor_id,title_bn,title_en};
        
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (resp) {
            if (resp.status === 'error') {
                toastr.error('no');
                console.log(resp.data)
            } else {
                $('#id').val(id);
                $('#x_risk_factor_id').val(x_risk_factor_id);
                $('#title_bn').text(title_bn);
                $('#title_en').text(title_en);
                $('.offcanvas-wrapper').html(resp);
            }
        });
    });

    $(".delete_risk_criterion").click(function () {

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
