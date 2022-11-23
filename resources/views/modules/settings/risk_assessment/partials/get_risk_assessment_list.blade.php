<table class="table table-bordered" width="100%">
    <thead class="thead-light">
        <tr>
            <th>SL</th>
            <th>Audit Area</th>
            <th>Inherent Risk</th>
            <th>Impact</th>
            <th>Likelihood</th>
            <th>Control System</th>
            <th>Control Effect</th>
            <th>Residual Risk</th>
            <th>Recommendation</th>
            <th>Implemented By</th>
            <th>Implemented On</th>
        </tr>
    </thead>

    <tbody>
    @forelse($item_risk_assessments as $item_risk_assessment)
        <tr>
            <td rowspan="{{ count($item_risk_assessment['audit_assessment_area_risks']) }}">{{ $loop->iteration }}</td>

            <td rowspan="{{ count($item_risk_assessment['audit_assessment_area_risks']) }}">
                {{ $item_risk_assessment['audit_area']['name_en'] }}
                
                <a 
                    href="javascript:;"
                    class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_edit_item_risk_assessment"
                    data-id="{{ $item_risk_assessment['id'] }}" 
                    data-x_audit_area_id="{{ $item_risk_assessment['x_audit_area_id'] }}" 
                    data-assessment_item_id="{{ $item_risk_assessment['assessment_item_id'] }}" 
                    data-assessment_item_type="{{ $item_risk_assessment['assessment_item_type'] }}" 
                    data-audit_assessment_area_risks='@json($item_risk_assessment['audit_assessment_area_risks'])' 
                >
                    <i class="fas fa-edit"></i>
                </a>
                
                <a href="javascript:;"
                   data-id="{{$item_risk_assessment['id']}}" 
                   data-assessment_item_id="{{ $item_risk_assessment['assessment_item_id'] }}" 
                    data-assessment_item_type="{{ $item_risk_assessment['assessment_item_type'] }}" 
                   data-url="{{ route('settings.item-risk-assessments.destroy', $item_risk_assessment['id']) }}"
                   class="btn btn-icon btn-outline-danger btn-xs border-0 mr-2 delete_item_risk_assessment">
                    <i class="fal fa-trash-alt"></i>
                </a>
            </td>

        @foreach ($item_risk_assessment['audit_assessment_area_risks'] as $auditAssessmentAreaRisk)
            <td>{{ $auditAssessmentAreaRisk['inherent_risk'] }}</td>
            <td>{{ $auditAssessmentAreaRisk['x_risk_assessment_impact']['title_en'] }}</td>
            <td>{{ $auditAssessmentAreaRisk['x_risk_assessment_likelihood']['title_en'] }}</td>
            <td>{{ $auditAssessmentAreaRisk['control_system'] }}</td>
            <td>{{ $auditAssessmentAreaRisk['control_effectiveness'] }}</td>
            <td>{{ $auditAssessmentAreaRisk['residual_risk'] }}</td>
            <td>{{ $auditAssessmentAreaRisk['recommendation'] }}</td>
            <td>{{ $auditAssessmentAreaRisk['implemented_by'] }}</td>
            <td>{{ $auditAssessmentAreaRisk['implementation_period'] }}</td>
        </tr>
        <tr>
        @endforeach

        @empty
            <tr>
                <td colspan="11" class="datatable-cell text-center"><span>Nothing Found</span></td>
            </tr>
        @endforelse
    </tbody>
</table>

<script>
    $('.btn_edit_item_risk_assessment').click(function () {
        
        id = $(this).data('id');
        x_audit_area_id =$(this).data('x_audit_area_id');
        assessment_item_id = $(this).data('assessment_item_id');
        assessment_item_type = $(this).data('assessment_item_type'); 
        audit_assessment_area_risks = $(this).data('audit_assessment_area_risks'); 

        url = "{{ route('settings.item-risk-assessments.edit') }}";

        var data = {id,x_audit_area_id,assessment_item_id,assessment_item_type,audit_assessment_area_risks};
        
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (resp) {
            if (resp.status === 'error') {
                toastr.error('no');
                console.log(resp.data)
            } else {
                // $('#id').val(id);
                // $('#title_bn').text(title_bn);
                // $('#title_en').text(title_en);
                // $('#impact_value').val(impact_value);
                // $('#x_risk_factor_id').val(x_risk_factor_id);
                $("#kt_content").html(resp);
            }
        });
    });

    $(".delete_item_risk_assessment").click(function () {

        id = $(this).data('id');
        url = $(this).data('url');

        assessment_item_type = $(this).data('assessment_item_type'); 
        audit_assessment_area_risks = $(this).data('audit_assessment_area_risks'); 

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
                        Risk_Assessment_Item_Container.laodItemRiskAssessments(assessment_item_type, audit_assessment_area_risks);
                        // $('#row_' + id).remove();
                    }
                });
            }
        });
    });
</script>
