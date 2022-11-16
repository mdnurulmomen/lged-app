<table class="table table-bordered">
    <thead class="thead-light">
        <tr>
            <th>Auditable Unit</th>
            @foreach($all_risk_factors as $factor)
                <th width="10%">{{$factor['title_bn']}}</th>
            @endforeach
            <th>Total Risk Score</th>
        </tr>
    </thead>
    <tbody>
       <tr>
           <td>Weight</td>
           @foreach($all_risk_factors as $factor)
               <td>{{$factor['risk_weight']}}%</td>
           @endforeach
           <td></td>
       </tr>
        @foreach($all_risk_assessment_factors as $risk_assessment_factor)
            <tr>
                <td>
                    @if($risk_assessment_factor['project_id'])
                        {{$risk_assessment_factor['project_name_bn']}}
                    @endif

                    @if($risk_assessment_factor['function_id'])
                        {{$risk_assessment_factor['function_name_bn']}}
                    @endif

                    @if($risk_assessment_factor['cost_center_id'])
                         {{$risk_assessment_factor['cost_center_name_bn']}}
                    @endif
                </td>
                @foreach($all_risk_factors as $factor)
                    <td>{{$risk_assessment_factor['risk_factor_items'][$factor['id']]}}</td>
                @endforeach
                <td>
                    {{$risk_assessment_factor['total_risk_score']}}
                    ({{ ucfirst($risk_assessment_factor['risk_score_key']) }})
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
