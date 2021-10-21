<!--begin::Table-->
<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-light">
        <tr>
            <th width="5%">ক্রমিক নং</th>
            <th width="7%">অনুচ্ছেদ নং</th>
            <th width="10%">আপত্তির শিরোনাম</th>
            <th width="10%">আপত্তি অনিয়মের ধরন</th>
            <th width="10%">জড়িত অর্থ (টাকা)</th>
            <th width="10%">অনিষ্পন্ন জড়িত অর্থ (টাকা)</th>
            <th width="10%">নিরীক্ষিত প্রতিষ্ঠান</th>
            <th width="10%">নিরীক্ষিত ধরন</th>
            <th width="10%">অর্থবছর</th>
            <th width="10%">আপত্তির ধরন</th>
        </tr>
        </thead>
        <tbody>
        @foreach($memo_list['data'] as $memo)
            <tr>
                <td>{{enTobn($loop->iteration)}}</td>
                <td>{{$memo['onucched_no']}}</td>
                <td>{{$memo['memo_title_bn']}}</td>
                <td>{{$memo['memo_irregularity_type']}}</td>
                <td>{{$memo['jorito_ortho_poriman']}}</td>
                <td>{{$memo['onishponno_jorito_ortho_poriman']}}</td>
                <td>{{$memo['cost_center_name_bn']}}</td>
                <td>{{$memo['audit_type']}}</td>
                <td>{{enTobn($memo['audit_year_start']).'-'.enTobn($memo['audit_year_end'])}}</td>
                <td>{{$memo['memo_irregularity_type']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!--end::Table-->
