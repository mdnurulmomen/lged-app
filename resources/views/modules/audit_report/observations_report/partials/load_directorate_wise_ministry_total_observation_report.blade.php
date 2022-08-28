<div class="table-search-header-wrapper mb-4 pt-3 pb-3 shadow-sm">
    <div class="col-xl-12">
        <div class="d-flex justify-content-md-end">
            <a onclick="load_Directorate_Wise_Ministry_Report_Container.loadDirectoratewiseMinistryReportDownload()"
               class="btn btn-sm btn-info btn-square mr-1"
               href="javascript:;">
                <i class="fas fa-file mr-1"></i>
                ডাউনলোড করুন
            </a>
        </div>
    </div>
</div>

<table class="table table-bordered" width="100%">
    <thead class="thead-light">
    <tr class="text-center">
        <th rowspan="2">ক্রমিক নং</th>
        <th rowspan="2">মন্ত্রণালয়</th>
        <th colspan="2">মোট আপত্তি</th>
        <th colspan="2">মোট জড়িত অর্থ</th>
        <th rowspan="2">সর্বমোট আপত্তি
        </th>
        <th rowspan="2">সর্বমোট জড়িত অর্থ
        </th>
    </tr>
    <tr class="text-center">
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
        <tr class="text-center">
            <td class="text-center">
                {{enTobn($loop->iteration)}}
            </td>
            <td class="text-left">
                {{$report['ministry'] ? $report['ministry']['name_bng'] : ''}}
            </td>
            <td class="text-right">
                {{enTobn(currency_format($report['sfi_count']))}}
            </td>
            <td class="text-right">
                {{enTobn(currency_format($report['non_sfi_count']))}}
            </td>
            <td class="text-right">
                {{enTobn(currency_format($report['jorito_ortho_poriman_sfi']))}}
            </td>
            <td class="text-right">
                {{enTobn(currency_format($report['jorito_ortho_poriman_non_sfi']))}}
            </td>
            <td class="text-right">
                {{enTobn(currency_format($report['non_sfi_count'] + $report['non_sfi_count']))}}
            </td>
            <td class="text-right">
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
    <tr>
        <td colspan="2" class="text-right">সর্বমোট</td>
        <td class="text-right">{{enTobn(currency_format($total_apotti_count_sfi))}}</td>
        <td class="text-right">{{enTobn(currency_format($total_apotti_count_non_sfi))}}</td>
        <td class="text-right">{{enTobn(currency_format($total_jorito_ortho_poriman_sfi))}}</td>
        <td class="text-right">{{enTobn(currency_format($total_jorito_ortho_poriman_non_sfi))}}</td>
        <td class="text-right">{{enTobn(currency_format($total_apotti))}}</td>
        <td class="text-right">{{enTobn(currency_format($total_jorito_ortho))}}</td>
    </tr>
    </tbody>
</table>
