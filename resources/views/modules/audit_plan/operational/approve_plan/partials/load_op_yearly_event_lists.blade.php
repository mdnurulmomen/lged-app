{{--{{dd($event_list)}}--}}
<div class="table-responsive mb-4">
    <table class="table  table-striped">
        <thead class="bg-primary">
        <tr>
            <th class="text-light">Serial Number</th>
            <th class="text-light">Audit Directorate</th>
            <th class="text-light">Status</th>
            <th class="text-light">Audit Type</th>
            <th class="text-light">Action</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($event_list))
            @foreach($event_list as $event)
                    <tr>
                        <td>{{enToBn($loop->iteration)}}</td>
                        <td>
                            {{$event['office_bn']}}
                        </td>
                        <td>
                            @if ($event['approval_status'] == 'pending')
                                <span class="badge badge-info text-uppercase m-1 p-1">Pending for Approval</span>
                            @elseif ($event['approval_status'] == 'reject')
                                <span class="badge badge-primary text-uppercase m-1 p-1">Return to Audit Directorate</span>
                            @else
                                <span class="badge badge-success text-uppercase m-1 p-1">{{$event['approval_status']}}</span>
                            @endif
                        </td>
                        <td>
                            {{$event['activity_type'] == 'compliance'?'কমপ্লায়েন্স':$event['activity_type']}}
                        </td>
                        <td>
                            <div class='btn-group btn-group-sm' role='group'>
                                <button title="মুভমেন্ট লগ" class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary mr-1"
                                    data-annual-plan-main-id="{{$event['annual_plan_main_id']}}"
                                    data-fiscal-year-id="{{$event['fiscal_year_id']}}"
                                    data-op-audit-calendar-event-id="{{$event['op_audit_calendar_event_id']}}"
                                    onclick="Approve_Plan_List_Container.movementHistory($(this))">
                                    <i class="fad fa-clipboard-list"></i>
                                </button>

                                <button title="বিস্তারিত"
                                    class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary mr-1"
                                    data-office-id="{{$event['office_id']}}"
                                    data-annual-plan-main-id="{{$event['annual_plan_main_id']}}"
                                    data-activity-type="{{$event['activity_type']}}"
                                    data-fiscal-year-id="{{$event['fiscal_year_id']}}"
                                    data-office-name-bn="{{$event['office_bn']}}"
                                    onclick="Approve_Plan_List_Container.viewDirectorateWiseAnnualPlan($(this))">
                                    <i class="fad fa-eye"></i>
                                </button>

                                <button title="ডাউনলোড" data-office-id="{{$event['office_id']}}"
                                        data-fiscal-year-id="{{$event['fiscal_year_id']}}"
                                        data-annual-plan-main-id="{{$event['annual_plan_main_id']}}"
                                        data-activity-type="{{$event['activity_type']}}"
                                        onclick="Approve_Plan_List_Container.printAnnualPlan($(this))"
                                        class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary mr-1">
                                    <i class="fad fa-file-download"></i>
                                </button>

                                @if ($event['approval_status'] == 'pending')
                                    <button title="অ্যাকশন"
                                        class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"
                                        data-op-audit-calendar-event-id="{{$event['op_audit_calendar_event_id']}}"
                                        data-office-id="{{$event['office_id']}}"
                                        data-annual-plan-main-id="{{$event['annual_plan_main_id']}}"
                                        data-activity-type="{{$event['activity_type']}}"
                                        data-office-name-bn="{{$event['office_bn']}}"
                                        onclick="Approve_Plan_List_Container.loadOpYearlyEventApprovalForm($(this))">
                                        <i class="fad fa-check"></i>
                                    </button>
                                @endif
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
