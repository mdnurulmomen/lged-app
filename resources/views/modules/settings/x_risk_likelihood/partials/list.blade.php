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
            Value
        </th>

        <th width="15%">
            Action
        </th>
    </tr>
    </thead>
    <tbody>
    @forelse($risk_likelihood_list as $risk_likelihood)
        <tr id="row_{{$risk_likelihood['id']}}" data-row="{{$loop->iteration}}">
            <td> {{ ucfirst($risk_likelihood['title_bn']) }} </td>
            <td> {{ ucfirst($risk_likelihood['title_en']) }} </td>
            <td> {{ $risk_likelihood['likelihood_value'] }} </td>
            <td>
                <a href="javascript:;"
                   data-id="{{$risk_likelihood['id']}}" 
                   data-title-en="{{$risk_likelihood['title_bn']}}"
                   data-title-bn="{{$risk_likelihood['title_en']}}" 
                   data-likelihood-value="{{$risk_likelihood['likelihood_value']}}" 
                   data-description-bn-value="{{$risk_likelihood['description_bn']}}" 
                   data-description-en-value="{{$risk_likelihood['description_en']}}" 
                   data-comment-en-value="{{$risk_likelihood['comment_en']}}" 
                   data-commnet-bn-value="{{$risk_likelihood['commnet_bn']}}" 
                   class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_edit_risk_likelihood">
                    <i class="fas fa-edit"></i>
                </a>
                
                <a href="javascript:;"
                   data-id="{{$risk_likelihood['id']}}"
                   data-url="{{ route('settings.risk-likelihoods.destroy', $risk_likelihood['id']) }}"
                   class="btn btn-icon btn-outline-danger btn-xs border-0 mr-2 delete_risk_likelihood">
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
    $('.btn_edit_risk_likelihood').click(function () {
        quick_panel = $("#kt_quick_panel");
        $('.offcanvas-wrapper').html('');
        quick_panel.addClass('offcanvas-on');
        quick_panel.css('opacity', 1);
        quick_panel.css('width', '500px');
        $('.offcanvas-footer').hide();
        quick_panel.removeClass('d-none');
        $("html").addClass("side-panel-overlay");
        $('.offcanvas-title').html('Edit Risk Likelihood');

        id = $(this).data('id');
        title_en =$(this).data('title-en');
        title_bn = $(this).data('title-bn');
        likelihood_value = $(this).data('likelihood-value');
        description_bn = $(this).data('description-bn-value');
        description_en = $(this).data('description-en-value');
        comment_en = $(this).data('comment-en-value');
        commnet_bn = $(this).data('commnet-bn-value');

        url = "{{ route('settings.risk-likelihoods.edit') }}";
        var data = {id,title_bn,title_en,likelihood_value,description_bn,description_en,comment_en,commnet_bn};
        
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (resp) {
            if (resp.status === 'error') {
                toastr.error('no');
                console.log(resp.data)
            } else {
                // $('#id').val(id);
                // $('#title_bn').text(title_bn);
                // $('#title_en').text(title_en);
                // $('#likelihood_value').val(likelihood_value);
                // $('#x_risk_factor_id').val(x_risk_factor_id);
                $('.offcanvas-wrapper').html(resp);
            }
        });
    });

    $(".delete_risk_likelihood").click(function () {

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
