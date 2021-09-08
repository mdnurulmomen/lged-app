@if(count($annual_plans) > 0)
<div class="row pb-4">
    <div class="col-md-6">
        <button class="btn_annual_plan_submit_to_ocag btn-sm btn-primary btn-square"
                data-fiscal-year-id="{{$fiscal_year_id}}"
                onclick="Annual_Plan_Container.submitToOCAG($(this))">Submit to OCAG
        </button>

        <button data-fiscal-year-id="{{$fiscal_year_id}}" onclick="Annual_Plan_Container.printAnnualPlan($(this))"
                class="btn-sm btn-warning btn-square">Print
        </button>
    </div>
</div>

@endif

<div class="table-responsive mb-4">
    <table class="table table-bordered table-head-custom">
        <thead>
        <tr class="font-weight-bolder">
            <th class="font-weight-bolder" style="color: black !important;" width="20%">Activity Title</th>
            <th class="font-weight-bolder" style="color: black !important;" width="20%">Milestones</th>
            <th class="font-weight-bolder" style="color: black !important;" width="10%">Target Date</th>
            <th class="font-weight-bolder" style="color: black !important;" width="5%">Budget</th>
            <th class="font-weight-bolder" style="color: black !important;" width="5%">Assigned Staff</th>
            <th class="font-weight-bolder" style="color: black !important;" width="35%">Auditee</th>
            <th class="font-weight-bolder" style="color: black !important;" width="5%">Plan</th>
        </tr>
        </thead>
        <tbody>
        @forelse($annual_plans as $activity_id => $annual_plan)
            @foreach($annual_plan as $plan)
                <tr>
                    @if($loop->iteration == 1)
                        <td width="20%" class="vertical-middle"
                            rowspan="{{count($annual_plan)}}">{{$plan['activity_title_en']}}
                            @if($plan['activity_type'])
                                <span
                                    class="badge-info btn btn-info btn-sm text-uppercase m-1 p-1 ">{{$plan['activity_type']}}</span>
                            @endif
                        </td>
                    @endif
                    <td width="20%">{{$plan['milestone_title_en']}}</td>
                    <td width="10%">{{$plan['milestone_target']}}</td>
                    <td width="5%"> {{$plan['assigned_budget']}}</td>
                    <td width="5%">{{$plan['assigned_staffs']}}</td>
                    <td width="35%">
                        @forelse($plan['assigned_rp'] as $auditee)
                            {{$auditee['party_name_en']}}<br/>
                        @empty
                            <span></span>
                        @endforelse
                    </td>
                    <td width="5%" class="vertical-middle">
                        <button class="btn_annual_plan btn-sm btn-hover-transparent-primary btn-primary"
                                data-schedule-id="{{$plan['schedule_id']}}"
                                data-activity-id="{{$plan['activity_id']}}"
                                data-milestone-id="{{$plan['activity_milestone_id']}}"
                                data-activity-title="{{$plan['activity_title_en']}}"
                                data-fiscal-year-id="{{$fiscal_year_id}}"
                                data-fiscal-year="{{$fiscal_year}}"
                                onclick="Annual_Plan_Container.loadEntitySelection($(this))">Plan
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
