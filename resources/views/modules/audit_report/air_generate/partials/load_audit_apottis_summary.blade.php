<div style="margin-top: 5px">
    <table width="100%" border="1">
        <thead>
        <tr>
            <th style="text-align: center" width="15%">অনুচ্ছেদ নম্বর</th>
            <th style="text-align: center" width="65%">আপত্তির শিরোনাম</th>
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
                <td style="text-align: right">{{enTobn(currency_format($apotti['total_jorito_ortho_poriman']))}}/-</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2" style="text-align: right">সর্বমোটঃ</td>
            <td style="text-align: right">{{enTobn(currency_format($totalJoritoOrtho))}}/-</td>
        </tr>
        </tbody>
    </table>

    <table width="100%" border="0">
        <tr>
            <td>কথায়ঃ {{ltrim(numberConvertToBnWord($totalJoritoOrtho))}} টাকা মাত্র</td>
        </tr>
    </table>
</div>
