<div style="margin-top: 5px">
    <table width="100%" border="1">
        <thead>
        <tr>
            <th style="text-align: center" width="10%">অনুচ্ছেদ নং</th>
            <th style="text-align: center" width="70%">আপত্তির শিরোনাম</th>
            <th style="text-align: center" width="20%">জড়িত টাকা</th>
        </tr>
        </thead>
        <tbody>
        @php $totalJoritoOrtho = 0; @endphp
        @foreach($apottis as $apotti)
            @php $totalJoritoOrtho = $totalJoritoOrtho+$apotti['total_jorito_ortho_poriman']; @endphp
            <tr>
                <td style="text-align: center">{{enTobn($apotti['onucched_no'])}}.</td>
                <td style="text-align: left;margin-left: 5px">{{$apotti['apotti_title']}}</td>
                <td style="text-align: center">{{enTobn(number_format($apotti['total_jorito_ortho_poriman'],0))}}/-</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2" style="text-align: right">সর্বমোটঃ</td>
            <td style="text-align: center">{{enTobn(number_format($totalJoritoOrtho,0))}}</td>
        </tr>
        </tbody>
    </table>
</div>
