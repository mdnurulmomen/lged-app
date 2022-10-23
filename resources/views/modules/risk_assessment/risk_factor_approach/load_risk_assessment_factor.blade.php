<table class="table table-bordered">
    <thead class="thead-light">
        <tr>
            <th>Auditable Unit</th>
            @foreach($all_risk_factor as $factor)
                <th width="10%">{{$factor['title_bn']}}</th>
            @endforeach
            <th>Total Risk Score</th>
        </tr>
    </thead>
    <tbody>
       <tr>
           <td>Weight</td>
           @foreach($all_risk_factor as $factor)
               <td>{{$factor['risk_weight']}}%</td>
           @endforeach
       </tr>
        @foreach($risk_assessment_factor as $unit)
            <tr>
                <td>
                    @if($unit['project_id'])
                        {{$unit['project_name_bn']}}
                    @endif

                    @if($unit['function_id'])
                        {{$unit['function_name_bn']}}
                    @endif

                    @if($unit['cost_center_id'])
                         {{$unit['cost_center_name_bn']}}
                    @endif
                </td>
                @foreach($all_risk_factor as $factor)
                    <td>{{$unit['risk_factor_items'][$factor['id']]}}</td>
                @endforeach
                <td>{{$unit['total_risk_score']}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
