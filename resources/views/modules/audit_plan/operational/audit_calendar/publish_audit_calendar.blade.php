<x-title-wrapper>Annual Audit Calender</x-title-wrapper>
<div class="col-lg-12">
    <div class="card card-custom card-stretch gutter-b">
        <div class="card-body pt-0 pb-3">
            <form id="publish_audit_calendar_form">

                <div class="table-responsive datatable datatable-default datatable-bordered datatable-loaded">

                    <table class="datatable-bordered datatable-head-custom datatable-table"
                           id="kt_datatable"
                           style="display: block;">
                        <thead class="datatable-head">
                        <tr class="datatable-row">
                            <th class="datatable-cell datatable-cell-sort" width="60%">Office</th>
                            <th class="datatable-cell datatable-cell-sort" width="2%">Activity</th>
                            <th class="datatable-cell datatable-cell-sort" width="2%">Tasks</th>
                            <th class="datatable-cell datatable-cell-sort" width="16%">Status</th>
                        </tr>
                        </thead>
                        <tbody style="" class="datatable-body">
                        @forelse($pending_events as $pending_event)
                            <tr data-row="{{$loop->iteration}}" class="datatable-row">
                                <td width="60%" class="vertical-middle datatable-cell">
                                    {{ $pending_event['office']['office_name_en'] }}
                                </td>
                                <td width="2%" class="vertical-middle datatable-cell text-center">
                                    {{$pending_event['activity_count']}}
                                </td>
                                <td width="2%" class="vertical-middle datatable-cell text-center">
                                    {{$pending_event['milestone_count']}}
                                </td>
                                <td width="16%" class="vertical-middle datatable-cell">
                                    @if($pending_event['status'] == 'pending')
                                        <button
                                            title="Retry"
                                            class="btn btn-square btn-light btn-hover-icon-success btn-icon-primary list-btn-toggle text-danger"
                                            type="button">
                                            <span class="">Pending</span>
                                            <i class="fad fa-repeat-alt" data-toggle="popover"
                                               data-content="Published"></i>
                                        </button>
                                    @elseif($pending_event['status'] == 'published')
                                        <button
                                            title="Published"
                                            class="btn btn-square btn-light btn-hover-icon-success btn-icon-primary list-btn-toggle text-success"
                                            type="button">
                                            <span>Published</span>
                                            <i class="fad fa-check" data-toggle="popover" data-content="Published"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="vertical-middle" colspan="3">
                                    No Data Found
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <input type="hidden" name="audit_calendar_id" class="audit_calendar_id" value="{{$calendar_id}}">
            </form>
        </div>
    </div>
</div>

