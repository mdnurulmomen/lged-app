<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-light">
        <tr>
            @if(!$data['office_ministry_id'])
                <th>মন্ত্রণালয়</th>
            @endif

            <th>নাম(বাংলা)</th>

            <th>অফিস স্তর</th>

            @if(!$data['risk_category'])
                <th>রিস্ক এরিয়া</th>
            @endif

            <th> সর্বশেষ নিরীক্ষা বছর</th>
        </tr>
        </thead>
        <tbody>
        @foreach($all_rpu_list_mis as $rpu)
            <tr>
                @if(!$data['office_ministry_id'])
                    <td>{{$rpu['office_ministry']['name_bng']}}</td>
                @endif

                <td>{{$rpu['office_name_bng']}}</td>

                <td>{{$rpu['office_layer']['layer_name_bng']}}</td>

                @if(!$data['risk_category'])
                    <td>{{$rpu['risk_category']}}</td>
                @endif

                <td>{{$rpu['last_audit_year_start']}} - {{$rpu['last_audit_year_end']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
