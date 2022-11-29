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
    <tbody class="text-center">
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
                    {{$risk_assessment_factor['item_name_bn']}}
                </td>
                
                @foreach($all_risk_factors as $factor)
                <td>
                    <div>
                        {{ collect($risk_assessment_factor['risk_factor_items'])->firstWhere('x_risk_factor_id', $factor['id'])['factor_rating'] }} 
                    </div>
                    
                    @if (collect($risk_assessment_factor['risk_factor_items'])->firstWhere('x_risk_factor_id', $factor['id'])['comment'])
                        <i class="fa fa-comments fa-lg" style="color:blue"
                        onclick='alert("{{ collect($risk_assessment_factor['risk_factor_items'])->firstWhere('x_risk_factor_id', $factor['id'])['comment'] }}")'
                        ></i>
                    @endif
                    
                    @if (collect($risk_assessment_factor['risk_factor_items'])->firstWhere('x_risk_factor_id', $factor['id'])['attachment'])
                        <a target="_blank"  href="{{ collect($risk_assessment_factor['risk_factor_items'])->firstWhere('x_risk_factor_id', $factor['id'])['attachment'] }}"
                            title="Download Attachment"
                            class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle">
                            <i class="fa fa-download" aria-hidden="true"></i>
                        </a>
                    @endif
                </td>
                @endforeach
                
                <td>
                    {{$risk_assessment_factor['total_risk_score']}}
                    ({{ ucfirst($risk_assessment_factor['risk_score_key']) }})
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
