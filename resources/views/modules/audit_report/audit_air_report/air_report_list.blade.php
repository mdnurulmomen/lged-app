
<table class="table table-bordered" width="100%">
    <thead class="thead-light">
    <tr class="bg-hover-warning">
        <th width="7%" class="text-center">
            ক্রম
        </th>

        <th width="33%" class="text-left">
            শিরোনাম
        </th>

        <th width="33%" class="text-left">
            কার্যক্রম
        </th>
    </tr>
    </thead>

    <tbody>
    @forelse($final_report as $report)
        <tr class="text-center">
            <td class="text-center">
                {{$loop->iteration}}
            </td>
            <td class="text-left">
                {{$report['report_name']}}
            </td>
            <td class="text-left">
                <button class="mr-1 btn btn-sm btn-primary btn-square" title="বিস্তারিত দেখুন"
                        data-air-report-id="{{$report['id']}}"
                        onclick="Air_Report_Container.loadAIREdit($(this))">
                    <i class="fad fa-eye"></i> বিস্তারিত
                </button>
            </td>
        </tr>
    @empty
        <tr data-row="0" class="datatable-row" style="left: 0px;">
            <td colspan="4" class="datatable-cell text-center"><span>Nothing Found</span></td>
        </tr>
    @endforelse
    </tbody>
</table>
