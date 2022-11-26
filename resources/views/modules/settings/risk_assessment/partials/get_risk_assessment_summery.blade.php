<table class="table table-bordered" width="100%">
    <thead class="thead-light">
        <tr>
            <th>
                L = Likelihood
                I = Impact 
            </th>
            
            @foreach ($item_assessment_areas[0]['audit_assessment_area_risks'] as $auditAssessmentAreaRisk)
                <th class="text-center">{{ ucfirst($auditAssessmentAreaRisk['inherent_risk']) }}</th>
            @endforeach

            <th>Total Score</th>
            <th>Level</th>
        </tr>

        <tr>
            <td></td>    
            
            @foreach ($item_assessment_areas[0]['audit_assessment_area_risks'] as $auditAssessmentAreaRisk)
                <th class="text-center">
                    <span class="p-1">L</span>
                    <span class="p-1">I</span>
                </th>
            @endforeach

                <td></td>
                <td></td>
        </tr>
    </thead>

    <tbody>
        @foreach ($item_assessment_areas as $item_assessment_area)
        <tr>
            <th>{{ ucfirst($item_assessment_area['audit_area']['name_en']) }}</th>
            
            @foreach ($item_assessment_area['audit_assessment_area_risks'] as $auditAssessmentAreaRisk)
                <td class="text-center">
                    <span class="p-1">
                        {{ $auditAssessmentAreaRisk['x_risk_assessment_likelihood_id'] }}
                    </span>

                    <span class="p-1">
                        {{ $auditAssessmentAreaRisk['x_risk_assessment_impact_id'] }}
                    </span>
                </td>
            @endforeach
                
            <td>
                {{-- {{ collect($item_assessment_area['audit_assessment_area_risks'])->sum('x_risk_assessment_impact_id') + collect($item_assessment_area['audit_assessment_area_risks'])->sum('x_risk_assessment_likelihood_id') }} --}}
            
                {{ 
                    $totalLikelihoodAndImpact = collect($item_assessment_area['audit_assessment_area_risks'])->sum(function ($areaRisk) {
                        return $areaRisk['x_risk_assessment_impact_id'] + $areaRisk['x_risk_assessment_likelihood_id'];
                    })
                }}
            </td>

            <td>
                {{ 
                    collect($risk_levels)->first(function ($risk_level, $key) use ($totalLikelihoodAndImpact) {
                        return $risk_level['level_from'] <= $totalLikelihoodAndImpact && $risk_level['level_to'] >= $totalLikelihoodAndImpact;
                    })['title_en'] ?? '--';
                }}
            </td>
        </tr>    
        @endforeach
    </tbody>
</table>
