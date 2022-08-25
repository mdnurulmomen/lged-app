{{--<div class="table-search-header-wrapper mb-4 pt-3 pb-3 shadow-sm">--}}
{{--    <div class="col-xl-12">--}}
{{--        <div class="d-flex justify-content-md-end">--}}
{{--            <a onclick="load_Directorate_Wise_Ministry_Report_Container.loadDirectoratewiseMinistryReportExport()"--}}
{{--               class="btn btn-sm btn-info btn-square mr-1"--}}
{{--               href="javascript:;">--}}
{{--                <i class="fas fa-file mr-1"></i>--}}
{{--                Export--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<h2>এসএফআই</h2>
<table class="table table-bordered" width="100%">
    <thead class="thead-light">
    <tr class="bg-hover-warning">
        <th width="7%" class="text-center">
            ক্রম
        </th>

        <th width="33%" class="text-left">
            মন্ত্রণালয়
        </th>

        <th width="33%" class="text-left">
            মোট আপত্তি
        </th>

        <th width="33%" class="text-left">
            মোট জড়িত অর্থ
        </th>
    </tr>
    </thead>

    <tbody>
    @php
        $ministry_list_sfi = array_filter($ministry_list, function ($var) {
            return ($var['memo_type'] == 'sfi');
        });
        $total_apotti_count_sfi =  $ministry_list_sfi ?  array_sum(array_column($ministry_list_sfi,'total_apotti')) : 0;
        $total_jorito_ortho_poriman_sfi = $ministry_list_sfi ? array_sum(array_column($ministry_list_sfi,'total_jorito_ortho_poriman')) : 0;
    @endphp
    @forelse($ministry_list_sfi as $report)
        <tr class="text-center">
            <td class="text-center">
                {{$loop->iteration}}
            </td>
            <td class="text-left">
                {{$report['ministry'] ? $report['ministry']['name_bng'] : ''}}
            </td>
            <td class="text-right">
                {{enTobn($report['total_apotti'])}}
            </td>
            <td class="text-right">
                {{enTobn(currency_format($report['total_jorito_ortho_poriman']))}}
            </td>
        </tr>
    @empty
        <tr data-row="0" class="datatable-row" style="left: 0px;">
            <td colspan="4" class="datatable-cell text-center"><span>Nothing Found</span></td>
        </tr>
    @endforelse
    <tr>
        <td></td>
        <td>সর্বমোট</td>
        <td class="text-right">{{enTobn($total_apotti_count_sfi)}}</td>
        <td class="text-right">{{enTobn(currency_format($total_jorito_ortho_poriman_sfi))}}</td>
    </tr>
    </tbody>
</table>
<h2>নন-এসএফআই</h2>
<table class="table table-bordered" width="100%">
    <thead class="thead-light">
    <tr class="bg-hover-warning">
        <th width="7%" class="text-center">
            ক্রম
        </th>

        <th width="33%" class="text-left">
            মন্ত্রণালয়
        </th>

        <th width="33%" class="text-left">
            মোট আপত্তি
        </th>

        <th width="33%" class="text-left">
            মোট জড়িত অর্থ
        </th>
    </tr>
    </thead>

    <tbody>
    @php
        $ministry_list_non_sfi = array_filter($ministry_list, function ($var) {
            return ($var['memo_type'] == 'non-sfi');
        });
        $total_apotti_count_non_sfi =  $ministry_list_non_sfi ? array_sum(array_column($ministry_list_non_sfi,'total_apotti')) : 0;
        $total_jorito_ortho_poriman_non_sfi = $ministry_list_non_sfi ?  array_sum(array_column($ministry_list_non_sfi,'total_jorito_ortho_poriman')) : 0;
    @endphp

    @forelse($ministry_list_non_sfi as $report)
        <tr class="text-center">
            <td class="text-center">
                {{$loop->iteration}}
            </td>
            <td class="text-left">
                {{$report['ministry'] ? $report['ministry']['name_bng'] : ''}}
            </td>
            <td class="text-right">
                {{enTobn($report['total_apotti'])}}
            </td>
            <td class="text-right">
                {{enTobn(currency_format($report['total_jorito_ortho_poriman']))}}
            </td>
        </tr>
    @empty
        <tr data-row="0" class="datatable-row" style="left: 0px;">
            <td colspan="4" class="datatable-cell text-center"><span>Nothing Found</span></td>
        </tr>
    @endforelse
    <tr>
        <td></td>
        <td>সর্বমোট</td>
        <td class="text-right">{{enTobn($total_apotti_count_non_sfi)}}</td>
        <td class="text-right">{{enTobn(currency_format($total_jorito_ortho_poriman_non_sfi))}}</td>
    </tr>
    </tbody>
</table>
