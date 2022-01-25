{{--{{dd($event_list)}}--}}
<div class="table-responsive mb-4">
    <table class="table  table-striped">
        <thead class="bg-primary">
        <tr>
            <th class="text-light">Serial Number</th>
            <th class="text-light">Audit Directorate</th>
            <th class="text-light">Type</th>
{{--            <th class="text-light">Activity Count</th>--}}
{{--            <th class="text-light">Milestone Count</th>--}}
            <th class="text-light">Action</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($event_list))
            @foreach($event_list as $event)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$event['office_bn']}}
                            <span class="badge badge-info text-uppercase m-1 p-1">{{$event['approval_status']}}</span>
                        </td>
                        <td>
                            {{$event['activity_type']}}
                        </td>
{{--                        <td>--}}
{{--                            {{$event['activity_count']}}--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            {{$event['milestone_count']}}--}}
{{--                        </td>--}}
                        <td>
                            <div class='btn-group btn-group-sm' role='group'>
                                <button
                                    class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"
                                    data-office-id="{{$event['office_id']}}"
                                    data-annual-plan-main-id="{{$event['annual_plan_main_id']}}"
                                    data-activity-type="{{$event['activity_type']}}"
                                    data-fiscal-year-id="{{$event['fiscal_year_id']}}"
                                    data-office-name-bn="{{$event['office_bn']}}"
                                    onclick="Approve_Plan_List_Container.viewDirectorateWiseAnnualPlan($(this))"
                                    title="View Plan">
                                    <i class="fad fa-eye"></i>
                                </button>

                                <button
                                    class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"
                                    data-op-audit-calendar-event-id="{{$event['op_audit_calendar_event_id']}}"
                                    data-office-id="{{$event['office_id']}}"
                                    data-annual-plan-main-id="{{$event['annual_plan_main_id']}}"
                                    data-activity-type="{{$event['activity_type']}}"
                                    data-office-name-bn="{{$event['office_bn']}}"
                                    onclick="Approve_Plan_List_Container.loadOpYearlyEventApprovalForm($(this))"
                                    title="View Approval Form">
                                    <i class="fad fa-check"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
            @endforeach
        @else
            <tr><td colspan="5">No data found</td></tr>
        @endif
        </tbody>
    </table>
</div>
