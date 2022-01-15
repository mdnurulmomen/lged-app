{{--{{dd($event_list)}}--}}
<div class="table-responsive mb-4">
    <table class="table  table-striped">
        <thead class="bg-primary">
        <tr>
            <th class="text-light">Serial Number</th>
            <th class="text-light">Audit Directorate</th>
            <th class="text-light">Activity Count</th>
            <th class="text-light">Milestone Count</th>
            <th class="text-light">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($event_list as $event)
            @if(!empty($event['office']))
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$event['office']['office_name_bn']}}
                    <span class="badge badge-info text-uppercase m-1 p-1">{{$event['approval_status']}}</span>
                </td>
                <td>
                    {{$event['activity_count']}}
                </td>
                <td>
                    {{$event['milestone_count']}}
                </td>
                <td>
                    <div class='btn-group btn-group-sm' role='group'>
                        <button
                            class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"
                            data-office-id="{{$event['office']['office_id']}}" data-office-name-bn="{{$event['office']['office_name_bn']}}"
                            onclick="Approve_Plan_List_Container.viewDirectorateWiseAnnualPlan($(this))"
                            title="View Plan">
                            <i class="fad fa-eye"></i>
                        </button>

                        <button
                            class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"
                            data-op-audit-calendar-event-id="{{$event['event_id']}}"
                            data-office-id="{{$event['office']['office_id']}}"
                            data-office-name-bn="{{$event['office']['office_name_bn']}}"
                            onclick="Approve_Plan_List_Container.loadOpYearlyEventApprovalForm($(this))"
                            title="View Approval Form">
                            <i class="fad fa-check"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>
