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
        @php $totalSFIJoritoOrtho = 0; @endphp
        @foreach($apottis as $apotti)
            @if($apotti['apotti_type'] == 'sfi' && $apotti['is_delete'] == 0)
                @php $totalSFIJoritoOrtho = $totalSFIJoritoOrtho+$apotti['total_jorito_ortho_poriman']; @endphp
                <tr>
                    <td style="text-align: center">{{enTobn($apotti['onucched_no'])}}.</td>
                    <td style="text-align: left;margin-left: 5px">{{$apotti['apotti_title']}}</td>
                    <td style="text-align: center">{{enTobn(currency_format($apotti['total_jorito_ortho_poriman']))}}/-</td>
                </tr>
            @endif
        @endforeach
        <tr>
            <td colspan="2" style="text-align: right">সর্বমোটঃ</td>
            <td style="text-align: center">{{enTobn(currency_format($totalSFIJoritoOrtho))}}/-</td>
        </tr>
        </tbody>
    </table>
</div>
