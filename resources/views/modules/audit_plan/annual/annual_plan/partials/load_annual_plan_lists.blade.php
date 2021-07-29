<div class="table-responsive">
    <table class="table table-bordered table-head-custom">
        <thead>
        <tr>
            <th width="20%">Activity Title</th>
            <th width="20%">Milestones</th>
            <th width="10%">Target Date</th>
            <th width="5%">Budget</th>
            <th width="5%">Assigned Staff</th>
            <th>Auditee</th>
            <th>Plan</th>
        </tr>
        </thead>
        <tbody>
        @forelse($annual_plans as $activity_id => $annual_plan)
            @foreach($annual_plan as $plan)
                <tr>
                    @if($loop->iteration == 1)
                        <td width="20%" class="vertical-middle"
                            rowspan="{{count($annual_plan)}}">{{$plan['activity_title_en']}}</td>
                    @endif
                    <td width="20%">{{$plan['milestone_title_en']}}</td>
                    <td width="10%">{{$plan['milestone_target']}}</td>
                    @forelse($plan['assigned_budget'] as $budget)
                        <td width="5%"> {{$budget['budget']}}</td>
                    @empty
                        <td width="5%"></td>
                    @endforelse
                    <td width="5%">{{count($plan['assigned_staffs'])}}</td>
                    <td>
                        @forelse($plan['assigned_rp'] as $auditee)
                            {{$auditee['short_name_en']}}
                        @empty
                            <span></span>
                        @endforelse
                    </td>
                    <td class="vertical-middle">
                        <button class="btn_annual_plan"
                                data-schedule-id="{{$plan['schedule_id']}}"
                                data-activity-id="{{$plan['activity_id']}}"
                                data-milestone-id="{{$plan['activity_milestone_id']}}"
                                onclick="Annual_Plan.loadEntitySelection($(this))">Plan
                        </button>
                    </td>
                </tr>
            @endforeach
        @empty
            <tr>
                <td class="vertical-middle" colspan="5">
                    No Data Found
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
