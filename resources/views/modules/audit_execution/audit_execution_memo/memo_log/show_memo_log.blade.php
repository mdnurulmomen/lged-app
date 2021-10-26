<table class="table table-bordered">
    <thead>
    <tr class="" style="left: 0px; ">
        <th>
            Field Name
        </th>
        <th>
            Old
        </th>
        <th>
            New
        </th>
    </tr>
    </thead>
    <tbody>
        @forelse($memo_log_info as $key => $log)
            @if($key == 'memo_irregularity_type')
                <tr>
                    <td>আপত্তি অনিয়মের ধরন</td>
                    <td>{{$log['old']}}</td>
                    <td>{{$log['new']}}</td>
                </tr>
            @endif

            @if($key == 'memo_irregularity_sub_type')
                <tr>
                    <td>আপত্তি অনিয়মের সাব-ধরন</td>
                    <td>{{$log['old']}}</td>
                    <td>{{$log['new']}}</td>
                </tr>
            @endif

            @if($key == 'audit_year_start')
                <tr>
                    <td>নিরীক্ষাধীন অর্থ বছর শুরু</td>
                    <td>{{$log['old']}}</td>
                    <td>{{$log['new']}}</td>
                </tr>
            @endif

            @if($key == 'audit_year_end')
                <tr>
                    <td>নিরীক্ষাধীন অর্থ বছর শেষ</td>
                    <td>{{$log['old']}}</td>
                    <td>{{$log['new']}}</td>
                </tr>
            @endif

            @if($key == 'jorito_ortho_poriman')
                <tr>
                    <td>জড়িত অর্থ (টাকা)</td>
                    <td>{{$log['old']}}</td>
                    <td>{{$log['new']}}</td>
                </tr>
            @endif

            @if($key == 'onishponno_jorito_ortho_poriman')
                <tr>
                    <td>অনিষ্পন্ন জড়িত অর্থ (টাকা)</td>
                    <td>{{$log['old']}}</td>
                    <td>{{$log['new']}}</td>
                </tr>
            @endif

            @if($key == 'memo_title_bn')
                <tr>
                    <td>আপত্তির শিরোনাম</td>
                    <td>{{$log['old']}}</td>
                    <td>{{$log['new']}}</td>
                </tr>
            @endif

            @if($key == 'memo_description_bn')
                <tr>
                    <td>বিবরণ</td>
                    <td>{!! $log['old'] !!}</td>
                    <td> {!! $log['new'] !!}</td>
                </tr>
            @endif

            @if($key == 'memo_type')
                <tr>
                    <td>আপত্তির ধরন</td>
                    <td>{{$log['old']}}</td>
                    <td>{{$log['new']}}</td>
                </tr>
            @endif

            @if($key == 'memo_status')
                <tr>
                    <td>আপত্তির অবস্থা</td>
                    <td>{{$log['old']}}</td>
                    <td>{{$log['new']}}</td>
                </tr>
            @endif

            @if($key == 'response_of_rpu')
                <tr>
                    <td>নিরীক্ষিত অফিসের জবাব</td>
                    <td>{{$log['old']}}</td>
                    <td>{{$log['new']}}</td>
                </tr>
            @endif

            @if($key == 'audit_conclusion')
                <tr>
                    <td>নিরীক্ষার মন্তব্য</td>
                    <td>{{$log['old']}}</td>
                    <td>{{$log['new']}}</td>
                </tr>
            @endif

            @if($key == 'audit_recommendation')
                <tr>
                    <td>নিরীক্ষার সুপারিশ</td>
                    <td>{{$log['old']}}</td>
                    <td>{{$log['new']}}</td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
