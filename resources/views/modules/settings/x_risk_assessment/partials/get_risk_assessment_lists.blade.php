<table class="table table-striped">
    <thead class="thead-light">
    <tr class="datatable-row" style="left: 0px; ">
        <th class="datatable-cell datatable-cell-sort text-center">
            Risk Assessment Type
        </th>

        <th class="datatable-cell datatable-cell-sort text-center">
            Company Type
        </th>

        <th class="datatable-cell datatable-cell-sort text-center">
            Risk Assessment  Title Bn
        </th>

        <th class="datatable-cell datatable-cell-sort text-center">
            Risk Assessment  Title En
        </th>

        <th class="datatable-cell datatable-cell-sort text-center">
            <i class="fas fa-edit"></i></th>

        <th class="datatable-cell datatable-cell-sort text-center">
            <i class="fas fa-trash-alt"></i>
        </th>
    </tr>
    </thead>
    <tbody style="" class="datatable-body">
    @forelse($risk_assessment_list as $risk_assessment)
        <tr id="row_{{$risk_assessment['id']}}" data-row="{{$loop->iteration}}" class="datatable-row" style="left: 0px;">
            <td class="datatable-cell text-left"><span>
                    @if($risk_assessment['risk_assessment_type'] == 'inherent')
                        Inherent Risk
                    @elseif($risk_assessment['risk_assessment_type'] == 'control')
                        Control Risk
                    @else
                        Detection Risk
                    @endif
                </span>
            </td>
            <td class="datatable-cell text-left">
                <span>
                    @if($risk_assessment['company_type'] == 'non_company')
                        For Non Companies

                    @elseif($risk_assessment['company_type'] == 'all_entity')
                        For all entities
                    @else
                        Common
                    @endif
                </span>
            </td>
            <td class="datatable-cell text-left"><span>{{$risk_assessment['risk_assessment_title_en']}}</span></td>
            <td class="datatable-cell text-left"><span>{{$risk_assessment['risk_assessment_title_bn']}}</span></td>
            <td class="datatable-cell text-center">
                <a href="javascript:;"
                   data-risk-assessment-id="{{$risk_assessment['id']}}"
                   data-risk-assessment-type="{{$risk_assessment['risk_assessment_type']}}"
                   data-company-type="{{$risk_assessment['company_type']}}"
                   data-risk-assessment-title-en="{{$risk_assessment['risk_assessment_title_bn']}}"
                   data-risk-assessment-title-bn="{{$risk_assessment['risk_assessment_title_en']}}"
                   class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_edit_risk_assessment">
                    <i class="fas fa-edit"></i>
                </a>
            </td>
            <td class="datatable-cell text-center">
                <a href="javascript:;"
                   data-risk-assessment-id="{{$risk_assessment['id']}}"
                   data-url="{{route('settings.risk-assessment.destroy', ['risk_assessment' => $risk_assessment['id']])}}"
                   class="btn btn-icon btn-outline-danger btn-xs border-0 mr-2 delete_audit_query">
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
    $('.btn_edit_risk_assessment').click(function () {
        quick_panel = $("#kt_quick_panel");
        $('.offcanvas-wrapper').html('');
        quick_panel.addClass('offcanvas-on');
        quick_panel.css('opacity', 1);
        quick_panel.css('width', '500px');
        $('.offcanvas-footer').hide();
        quick_panel.removeClass('d-none');
        $("html").addClass("side-panel-overlay");
        $('.offcanvas-title').html('Edit Risk Assessment');

        risk_assessment_id = $(this).data('risk-assessment-id');
        risk_assessment_type = $(this).data('risk-assessment-type');
        company_type = $(this).data('risk-company-type');
        risk_assessment_title_en =$(this).data('risk-assessment-title-en');
        risk_assessment_title_bn = $(this).data('risk-assessment-title-bn');

        url = '{{route('settings.risk-assessment.edit')}}';
        var data = {risk_assessment_id,risk_assessment_type,company_type,risk_assessment_title_bn,risk_assessment_title_en};
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (resp) {
            if (resp.status === 'error') {
                toastr.error('no');
                console.log(resp.data)
            } else {
                $('#risk_assessment_id').val(risk_assessment_id);
                $('#risk_assessment_type').val(risk_assessment_type);
                $('#company_type').val(company_type);
                $('#risk_assessment_title_bn').text(risk_assessment_title_bn);
                $('#risk_assessment_title_en').text(risk_assessment_title_en);
                $('.offcanvas-wrapper').html(resp);
            }
        });
    });

    $(".delete_risk_assessment").click(function () {

         id = $(this).data('risk-assessment-id');
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
