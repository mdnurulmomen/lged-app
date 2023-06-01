<table class="table table-bordered" width="100%">
    <thead class="thead-light">
        <tr>
            <th style="width: 4%;">SL</th>
            <th style="width: 43%;">Sub-Area</th>
            <th style="width: 43%;">Risk Name</th>
            <th style="width: 10%;">Actions</th>
        </tr>
    </thead>

    <tbody>
    @forelse($riskidentifications as $riskidentification)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                @php
                    $area = collect($allAuditAreas)->firstWhere('id', $riskidentification['audit_area_id']);
                    $areaEnName = $area['name_en'];

                    $parentArea = collect($allAuditAreas)->firstWhere('id', $riskidentification['parent_area_id']);
                    $parentEnName = $parentArea['name_en'];
                @endphp

                {{ ucfirst($areaEnName) }} ({{ ucfirst($parentEnName) }})
            </td>
            <td>{{ $riskidentification['risk_name'] }}</td>
            <td>
                <a 
                    href="javascript:;"
                    class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_edit_sector_risk_assessment"
                    data-id="{{ $riskidentification['id'] }}" 
                    data-parent_area_id="{{ $riskidentification['parent_area_id'] }}" 
                    data-audit_area_id="{{ $riskidentification['audit_area_id'] }}" 
                    data-assessment_sector_id="{{ $riskidentification['assessment_sector_id'] }}" 
                    data-assessment_sector_type="{{ $riskidentification['assessment_sector_type'] }}" 
                    data-risk_name="{{ $riskidentification['risk_name'] }}" 
                >
                    <i class="fas fa-edit"></i>
                </a>
                
                <a href="javascript:;"
                    data-parent_area_id="{{ $riskidentification['parent_area_id'] }}" 
                    data-assessment_sector_id="{{ $riskidentification['assessment_sector_id'] }}" 
                    data-assessment_sector_type="{{ $riskidentification['assessment_sector_type'] }}" 
                    data-url="{{ route('audit.plan.risk-identifications.destroy', $riskidentification['id']) }}"
                    class="btn btn-icon btn-outline-danger btn-xs border-0 mr-2 delete_sector_risk_assessment">
                    <i class="fal fa-trash-alt"></i>
                </a>
            </td>
        </tr>

    @empty
        <tr>
            <td colspan="4" class="datatable-cell text-center"><span>Nothing Found</span></td>
        </tr>
    @endforelse
    </tbody>
</table>

<script>
    $('.btn_edit_sector_risk_assessment').click(function () {

        id = $(this).data('id');
        parent_area_id =$(this).data('parent_area_id');
        audit_area_id =$(this).data('audit_area_id');
        assessment_sector_id = $(this).data('assessment_sector_id');
        assessment_sector_type = $(this).data('assessment_sector_type'); 
        risk_name = $(this).data('risk_name'); 

        url = "{{ route('audit.plan.risk-identifications.edit') }}";

        var data = {id,parent_area_id,audit_area_id,assessment_sector_id,assessment_sector_type,risk_name};
        
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (resp) {
            loaderStop();
            if (resp.status === 'error') {
                toastr.error('no');
                console.log(resp.data)
            } else {
                // $('#id').val(id);
                // $('#title_bn').text(title_bn);
                // $('#title_en').text(title_en);
                // $('#impact_value').val(impact_value);
                // $('#x_risk_factor_id').val(x_risk_factor_id);
                $(".offcanvas-title").text('Update Risk Identification');
                quick_panel = $("#kt_quick_panel");
                quick_panel.addClass('offcanvas-on');
                quick_panel.css('opacity', 1);
                quick_panel.css('width', '50%');
                quick_panel.removeClass('d-none');
                $("html").addClass("side-panel-overlay");
                $(".offcanvas-wrapper").html(resp);
            }
        });
    });

    $(".delete_sector_risk_assessment").click(function () {

        url = $(this).data('url');
        
        // id = $(this).data('id');
        assessment_sector_type = $(this).data('assessment_sector_type'); 
        assessment_sector_id = $(this).data('assessment_sector_id');
        parent_area_id =$(this).data('parent_area_id');

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
                        // console.log(resp.data)
                    } else {
                        toastr.success('Delete Successfully');
                        Risk_Assessment_Item_Container.laodItemRiskIdentifications(parent_area_id);
                        // $('#row_' + id).remove();
                    }
                });
            }
        });
    });
</script>
