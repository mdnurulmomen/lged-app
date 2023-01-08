<table class="table table-bordered" width="100%">
    <thead class="thead-light">
        <tr>
            <th>SL</th>
            <th>Audit Area</th>
            <th>Process/sub-process</th>
            <th>Risk</th>
            <th>Likelihood</th>
            <th>Impact</th>
            <th> {{$assessment_type == 'preliminary' ? 'Inherent Risk Level' : 'Residual Risk'}} </th>

            @if($assessment_type == 'preliminary')
            <th>Priority (1,2,3,4)</th>
            @endif

            @if($assessment_type == 'final')
                <th>Effectiveness Of Control (Inadequate, Needs Improvement, Adequate)</th>
            @else
                <th>Existing Control</th>
            @endif

            <th>Risk Owner</th>
            <th>Process Owner</th>
            <th>Control Owner</th>
            @if($assessment_type == 'final')
                <th>Related Issue Number</th>
            @endif
        </tr>
    </thead>

    <tbody>
    @forelse($sectorriskassessments as $sectorriskassessment)
        <tr>
            <td rowspan="{{ count($sectorriskassessment['audit_assessment_area_risks']) }}">{{ $loop->iteration }}</td>

            <td rowspan="{{ count($sectorriskassessment['audit_assessment_area_risks']) }}">

                {{ collect($allAuditAreas)->firstWhere('id', $sectorriskassessment['audit_area_id'])['name_en'] }}

                <a
                    href="javascript:;"
                    class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_edit_sector_risk_assessment"
                    data-id="{{ $sectorriskassessment['id'] }}"
                    data-audit_area_id="{{ $sectorriskassessment['audit_area_id'] }}"
                    data-assessment_sector_id="{{ $sectorriskassessment['assessment_sector_id'] }}"
                    data-assessment_sector_type="{{ $sectorriskassessment['assessment_sector_type'] }}"
                    data-audit_assessment_area_risks='@json($sectorriskassessment['audit_assessment_area_risks'])'
                >
                    <i class="fas fa-edit"></i>
                </a>

                <a href="javascript:;"
                   data-id="{{$sectorriskassessment['id']}}"
                   data-assessment_sector_id="{{ $sectorriskassessment['assessment_sector_id'] }}"
                    data-assessment_sector_type="{{ $sectorriskassessment['assessment_sector_type'] }}"
                   data-url="{{ route('settings.sector-risk-assessments.destroy', $sectorriskassessment['id']) }}"
                   class="btn btn-icon btn-outline-danger btn-xs border-0 mr-2 delete_sector_risk_assessment">
                    <i class="fal fa-trash-alt"></i>
                </a>
            </td>

        @foreach ($sectorriskassessment['audit_assessment_area_risks'] as $auditAssessmentAreaRisk)
            <td>{{ $auditAssessmentAreaRisk['sub_area_name'] }}</td>
            <td>{{ $auditAssessmentAreaRisk['inherent_risk'] }}</td>
            <td>{{ $auditAssessmentAreaRisk['x_risk_assessment_likelihood']['title_en'] }}</td>
            <td>{{ $auditAssessmentAreaRisk['x_risk_assessment_impact']['title_en'] }}</td>
            <td>{{ $auditAssessmentAreaRisk['risk_level'] }}</td>
                @if($assessment_type == 'preliminary')
                    <td>{{ $auditAssessmentAreaRisk['priority'] }}</td>
                @endif
            <td>{{ $auditAssessmentAreaRisk['control_system'] }}</td>
            <td>{{ $auditAssessmentAreaRisk['risk_owner_name'] }}</td>
            <td>{{ $auditAssessmentAreaRisk['process_owner_name'] }}</td>
            <td>{{ $auditAssessmentAreaRisk['control_owner_name'] }}</td>

            @if($assessment_type == 'final')
               <td>{{ $auditAssessmentAreaRisk['issue_no'] }}</td>
            @endif

        </tr>
        @endforeach

        @empty
            <tr>
                <td colspan="12" class="datatable-cell text-center"><span>Nothing Found</span></td>
            </tr>
        @endforelse
    </tbody>
</table>

<script>
    $('.btn_edit_sector_risk_assessment').click(function () {

        loaderStart('Please wait...');

        id = $(this).data('id');
        audit_area_id =$(this).data('audit_area_id');
        assessment_sector_id = $(this).data('assessment_sector_id');
        assessment_sector_type = $(this).data('assessment_sector_type');
        audit_assessment_area_risks = $(this).data('audit_assessment_area_risks');

        url = "{{ route('settings.sector-risk-assessments.edit') }}";

        var data = {id,audit_area_id,assessment_sector_id,assessment_sector_type,audit_assessment_area_risks};

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
                $("#kt_content").html(resp);
            }
        });
    });

    $(".delete_sector_risk_assessment").click(function () {

        id = $(this).data('id');
        url = $(this).data('url');

        assessment_sector_type = $(this).data('assessment_sector_type');
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
                        Risk_Assessment_Item_Container.laodItemRiskAssessments(assessment_sector_type, audit_assessment_area_risks);
                        // $('#row_' + id).remove();
                    }
                });
            }
        });
    });
</script>
