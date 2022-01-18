@if($qac_type == 'qac-1')
    <div style="margin-top: 5px">
        <table width="100%" border="1">
            <thead>
            <tr>
                <th colspan="3">এসএফআই অনুচ্ছেদসমূহ</th>
            </tr>
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
                        <td style="text-align: center">{{enTobn(number_format($apotti['total_jorito_ortho_poriman'],0))}}/-</td>
                    </tr>
                @endif
            @endforeach
            <tr>
                <td colspan="2" style="text-align: right">সর্বমোটঃ</td>
                <td style="text-align: center">{{enTobn(number_format($totalSFIJoritoOrtho,0))}}/-</td>
            </tr>
            </tbody>
        </table>
    </div>

    <br>
    <br>
    <div style="margin-top: 5px">
        <table width="100%" border="1">
            <thead>
            <tr>
                <th colspan="3">নন-এসএফআই অনুচ্ছেদসমূহ</th>
            </tr>
            <tr>
                <th style="text-align: center" width="10%">অনুচ্ছেদ নং</th>
                <th style="text-align: center" width="70%">আপত্তির শিরোনাম</th>
                <th style="text-align: center" width="20%">জড়িত টাকা</th>
            </tr>
            </thead>
            <tbody>
            @php $totalNonSFIJoritoOrtho = 0; @endphp
            @foreach($apottis as $apotti)
                @if($apotti['apotti_type'] == 'non-sfi' && $apotti['is_delete'] == 0)
                    @php $totalNonSFIJoritoOrtho = $totalNonSFIJoritoOrtho+$apotti['total_jorito_ortho_poriman']; @endphp
                    <tr>
                        <td style="text-align: center">{{enTobn($apotti['onucched_no'])}}.</td>
                        <td style="text-align: left;margin-left: 5px">{{$apotti['apotti_title']}}</td>
                        <td style="text-align: center">{{enTobn(number_format($apotti['total_jorito_ortho_poriman'],0))}}/-</td>
                    </tr>
                @endif
            @endforeach
            <tr>
                <td colspan="2" style="text-align: right">সর্বমোটঃ</td>
                <td style="text-align: center">{{enTobn(number_format($totalNonSFIJoritoOrtho,0))}}/-</td>
            </tr>
            </tbody>
        </table>
    </div>

@elseif($qac_type == 'qac-2')
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
                @if($apotti['apotti_type'] == 'sfi' && $apotti['is_delete'] == 0 && $apotti['final_status'] == 'draft')
                    @php $totalSFIJoritoOrtho = $totalSFIJoritoOrtho+$apotti['total_jorito_ortho_poriman']; @endphp
                    <tr>
                        <td style="text-align: center">{{enTobn($apotti['onucched_no'])}}.</td>
                        <td style="text-align: left;margin-left: 5px">{{$apotti['apotti_title']}}</td>
                        <td style="text-align: center">{{enTobn(number_format($apotti['total_jorito_ortho_poriman'],0))}}/-</td>
                    </tr>
                @endif
            @endforeach
            <tr>
                <td colspan="2" style="text-align: right">সর্বমোটঃ</td>
                <td style="text-align: center">{{enTobn(number_format($totalSFIJoritoOrtho,0))}}/-</td>
            </tr>
            </tbody>
        </table>
    </div>

@elseif($qac_type == 'cqat')
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
                @if($apotti['apotti_type'] == 'sfi' && $apotti['is_delete'] == 0 && $apotti['final_status'] == 'approved')
                    @php $totalSFIJoritoOrtho = $totalSFIJoritoOrtho+$apotti['total_jorito_ortho_poriman']; @endphp
                    <tr>
                        <td style="text-align: center">{{enTobn($apotti['onucched_no'])}}.</td>
                        <td style="text-align: left;margin-left: 5px">{{$apotti['apotti_title']}}</td>
                        <td style="text-align: center">{{enTobn(number_format($apotti['total_jorito_ortho_poriman'],0))}}/-</td>
                    </tr>
                @endif
            @endforeach
            <tr>
                <td colspan="2" style="text-align: right">সর্বমোটঃ</td>
                <td style="text-align: center">{{enTobn(number_format($totalSFIJoritoOrtho,0))}}/-</td>
            </tr>
            </tbody>
        </table>
    </div>
@endif
