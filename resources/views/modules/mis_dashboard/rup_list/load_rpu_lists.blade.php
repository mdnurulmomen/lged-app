<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-light">
        <tr>
            <th>মন্ত্রণালয়</th>
            <th>নাম(বাংলা)</th>
            <th>অফিস স্তর</th>
            <th>Risk area</th>
            <th>Last Audit Year</th>
        </tr>
        </thead>
        <tbody>
        @foreach($all_rpu_list_mis as $rpu)
            <tr>
                <td>{{$rpu['office_ministry']['name_bng']}}</td>
                <td>{{$rpu['office_name_bng']}}</td>
                <td>{{$rpu['office_layer']['layer_name_bng']}}</td>
                <td>{{$rpu['risk_category']}}</td>
                <td>{{$rpu['last_audit_year_start']}} - {{$rpu['last_audit_year_end']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
