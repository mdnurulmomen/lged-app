<table class="table table-bordered" width="100%">
    <thead class="thead-light">
    <tr>
        <th>Likelihood</th>

        <th>Impact</th>

        <th>Level</th>

        <th>Priority</th>

        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @forelse($risk_matrixes as $risk_matrix)
        <tr id="row_{{$risk_matrix['id']}}" data-row="{{$loop->iteration}}">
            <td> {{ ucfirst($risk_matrix['risk_assessment_livelihood']['title_en']) }} </td>
            <td> {{ ucfirst($risk_matrix['risk_assessment_impact']['title_en']) }} </td>
            <td> {{ ucfirst($risk_matrix['risk_level']['title_en']) }} </td>
            <td> {{ $risk_matrix['priority'] }} </td>
            <td>
                <a href="javascript:;"
                   data-id="{{$risk_matrix['id']}}" 
                   data-risk-livelihood="{{$risk_matrix['x_risk_assessment_likelihood_id']}}"
                   data-risk-impact="{{$risk_matrix['x_risk_assessment_impact_id']}}" 
                   data-risk-level="{{$risk_matrix['x_risk_level_id']}}" 
                   data-priority="{{ $risk_matrix['priority'] }}" 
                   class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_edit_risk_criterion">
                    <i class="fas fa-edit"></i>
                </a>
                
                <a href="javascript:;"
                   data-id="{{$risk_matrix['id']}}"
                   data-url="{{ route('risk-assessment.risk-matrixes.destroy', $risk_matrix['id']) }}"
                   class="btn btn-icon btn-outline-danger btn-xs border-0 mr-2 delete_risk_criterion">
                    <i class="fal fa-trash-alt"></i>
                </a>
            </td>
        </tr>
    @empty
        <tr data-row="0" class="datatable-row" style="left: 0px;">
            <td colspan="5" class="datatable-cell text-center"><span>Nothing Found</span></td>
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
        x_risk_assessment_likelihood_id =$(this).data('risk-livelihood');
        x_risk_assessment_impact_id = $(this).data('risk-impact');
        x_risk_level_id = $(this).data('risk-level');
        priority = $(this).data('priority');

        url = "{{ route('risk-assessment.risk-matrixes.edit') }}";
        var data = {id,x_risk_assessment_likelihood_id,x_risk_assessment_impact_id,x_risk_level_id,priority};
        
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (resp) {
            if (resp.status === 'error') {
                toastr.error('no');
                console.log(resp.data)
            } else {
                // $('#id').val(id);
                // $('#x_risk_factor_id').val(x_risk_factor_id);
                // $('#title_bn').text(title_bn);
                // $('#title_en').text(title_en);
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
