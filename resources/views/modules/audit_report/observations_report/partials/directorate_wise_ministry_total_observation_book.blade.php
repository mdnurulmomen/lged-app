<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    {{--    <link href="public/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>--}}
<style>
    html {
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
    }

    body {
        margin: 0;
        font-family: nikoshpdf !important;
    }

    .bangla-font {
        font-family: nikoshpdf !important;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0;
    }

    table thead  tr th,
    table tr td{
        padding: 8px;
    }
</style>
</head>

<body>
<div id="writing-screen-wrapper" style="font-family:nikoshpdf,serif !important;">
    <div class="pdf-screen bangla-font">
        <div class="bangla-font" style="font-family:nikoshpdf,serif !important;text-align: center">
            মহাপরিচালকের কার্যালয় <br>
            <x-office-header-details officeid="{{$directorate_id}}" />
        </div>
    </div>
    <table style="margin-top: 20px" class="table bangla-font" width="100%" border="1">
        <thead>
        <tr class="bangla-font" style="text-align: center">
            <th rowspan="2">ক্রমিক নং</th>
            <th rowspan="2">মন্ত্রণালয়</th>
            <th colspan="2">মোট আপত্তি</th>
            <th colspan="2">মোট জড়িত অর্থ</th>
            <th rowspan="2">সর্বমোট আপত্তি
            </th>
            <th rowspan="2">সর্বমোট জড়িত অর্থ
            </th>
        </tr>
        <tr class="bangla-font" style="text-align: center">
            <th>
                এসএফআই
            </th>
            <th>
                নন-এসএফআই
            </th>
            <th>
                এসএফআই
            </th>
            <th>
                নন-এসএফআই
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($ministry_list as $report)
            <tr class="bangla-font" style="text-align: center">
                <td class="text-center">
                    {{enTobn($loop->iteration)}}
                </td>
                <td class="text-left">
                    {{$report['ministry'] ? $report['ministry']['name_bng'] : ''}}
                </td>
                <td style="text-align: right">
                    {{enTobn(currency_format($report['sfi_count']))}}
                </td>
                <td style="text-align: right">
                    {{enTobn(currency_format($report['non_sfi_count']))}}
                </td>
                <td style="text-align: right">
                    {{enTobn(currency_format($report['jorito_ortho_poriman_sfi']))}}
                </td>
                <td style="text-align: right">
                    {{enTobn(currency_format($report['jorito_ortho_poriman_non_sfi']))}}
                </td>
                <td style="text-align: right">
                    {{enTobn(currency_format($report['non_sfi_count'] + $report['non_sfi_count']))}}
                </td>
                <td style="text-align: right">
                    {{enTobn(currency_format($report['jorito_ortho_poriman_sfi'] + $report['jorito_ortho_poriman_non_sfi']))}}
                </td>
            </tr>
        @endforeach

        @php
            $total_apotti_count_sfi =  $ministry_list ?  array_sum(array_column($ministry_list,'sfi_count')) : 0;
            $total_apotti_count_non_sfi = $ministry_list ? array_sum(array_column($ministry_list,'non_sfi_count')) : 0;
            $total_apotti = $total_apotti_count_sfi + $total_apotti_count_non_sfi;

            $total_jorito_ortho_poriman_sfi =  $ministry_list ?  array_sum(array_column($ministry_list,'jorito_ortho_poriman_sfi')) : 0;
            $total_jorito_ortho_poriman_non_sfi = $ministry_list ? array_sum(array_column($ministry_list,'jorito_ortho_poriman_non_sfi')) : 0;
            $total_jorito_ortho = $total_jorito_ortho_poriman_sfi + $total_jorito_ortho_poriman_non_sfi;
        @endphp
        <tr class="bangla-font" style="text-align: center">
            <td colspan="2" style="text-align: right">সর্বমোট</td>
            <td style="text-align: right">{{enTobn(currency_format($total_apotti_count_sfi))}}</td>
            <td style="text-align: right">{{enTobn(currency_format($total_apotti_count_non_sfi))}}</td>
            <td style="text-align: right">{{enTobn(currency_format($total_jorito_ortho_poriman_sfi))}}</td>
            <td style="text-align: right">{{enTobn(currency_format($total_jorito_ortho_poriman_non_sfi))}}</td>
            <td style="text-align: right">{{enTobn(currency_format($total_apotti))}}</td>
            <td style="text-align: right">{{enTobn(currency_format($total_jorito_ortho))}}</td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
