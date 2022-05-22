
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
                @if($report['final_approval_status'] == 'approved')
                    <span class="label label-outline-success label-pill label-inline">
                      অনুমোদিত
                    </span>
                @elseif($report['latest_r_air_movement'])
                    <span class="label label-outline-warning label-pill label-inline">
                      {{$report['latest_r_air_movement']['receiver_employee_designation_bn']}} এর কাছে প্রেরণ করা হয়েছে
                    </span>
                @endif

                @if($report['is_bg_press'] && !$report['is_printing_done'])
                    <span class="label label-outline-warning label-pill label-inline">
                      বিজি প্রেসে প্রেরণ করা হয়েছে
                    </span>
                @elseif($report['is_printing_done'])
                    <span class="label label-outline-success label-pill label-inline">
                      মুদ্রণ সম্পন্ন হয়েছে
                    </span>
                @endif
            </td>
            <td class="text-left">
                <button class="mr-1 btn btn-sm btn-primary btn-square" title="বিস্তারিত দেখুন"
                        data-air-report-id="{{$report['id']}}"
                        onclick="Final_report_Container.loadAIREdit($(this))">
                    <i class="fad fa-eye"></i> বিস্তারিত
                </button>

{{--                @if($report['latest_r_air_movement'] &&  $current_designation_id == $report['latest_r_air_movement']['receiver_officer_id'])--}}
                    @if($report['final_approval_status'] == 'approved')
                        @if(!$report['is_bg_press'])
                            <button class="mr-1 btn btn-sm btn-primary btn-square" title="বিজি প্রেসে প্রেরণ"
                                    data-air-report-id="{{$report['id']}}"
                                    data-bg-press="1"
                                    onclick="Final_report_Container.loadFinalReportStatusUpdate($(this))">
                                <i class="fa fa-paper-plane"></i> বিজি প্রেসে প্রেরণ করুন
                            </button>
                        @endif
                    @endif

                    @if($report['is_bg_press'])
                        @if(!$report['is_printing_done'])
                            <button class="mr-1 btn btn-sm btn-primary btn-square" title="মুদ্রণ সম্পন্ন"
                                    data-air-report-id="{{$report['id']}}"
                                    data-printing-done="1"
                                    onclick="Final_report_Container.loadFinalReportStatusUpdate($(this))">
                                <i class="fad fa-book-dead"></i> মুদ্রণ সম্পন্ন করুন
                            </button>
                        @endif
                    @endif
{{--                @endif--}}
            </td>
        </tr>
    @empty
        <tr data-row="0" class="datatable-row" style="left: 0px;">
            <td colspan="4" class="datatable-cell text-center"><span>Nothing Found</span></td>
        </tr>
    @endforelse
    </tbody>
</table>
