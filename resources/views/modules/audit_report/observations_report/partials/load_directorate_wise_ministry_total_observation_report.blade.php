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
<h2>এসএফআই তালিকা</h2>
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
        $ministry_list_onisponno = array_filter($ministry_list, function ($var) {
            return ($var['memo_type'] == 'sfi');
        });
    @endphp
    @forelse($ministry_list_onisponno as $report)
        <tr class="text-center">
            <td class="text-center">
                {{$loop->iteration}}
            </td>
            <td class="text-left">
                {{$report['ministry'] ? $report['ministry']['name_bng'] : ''}}
            </td>
            <td class="text-left">
                {{enTobn($report['total_apotti'])}}
            </td>
            <td class="text-left">
                {{enTobn($report['total_jorito_ortho_poriman'])}}
            </td>
        </tr>
    @empty
        <tr data-row="0" class="datatable-row" style="left: 0px;">
            <td colspan="4" class="datatable-cell text-center"><span>Nothing Found</span></td>
        </tr>
    @endforelse
    </tbody>
</table>
<h2>নন-এসএফআই তালিকা</h2>
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
        $ministry_list_nisponno = array_filter($ministry_list, function ($var) {
            return ($var['memo_type'] == 'non-sfi');
        });
    @endphp
    @forelse($ministry_list_nisponno as $report)
        <tr class="text-center">
            <td class="text-center">
                {{$loop->iteration}}
            </td>
            <td class="text-left">
                {{$report['ministry'] ? $report['ministry']['name_bng'] : ''}}
            </td>
            <td class="text-left">
                {{enTobn($report['total_apotti'])}}
            </td>
            <td class="text-left">
                {{enTobn($report['total_jorito_ortho_poriman'])}}
            </td>
        </tr>
    @empty
        <tr data-row="0" class="datatable-row" style="left: 0px;">
            <td colspan="4" class="datatable-cell text-center"><span>Nothing Found</span></td>
        </tr>
    @endforelse
    </tbody>
</table>
