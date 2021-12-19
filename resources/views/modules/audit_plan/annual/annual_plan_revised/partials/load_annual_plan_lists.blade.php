<div class="table-responsive mb-4">
    <table class="table table-bordered table-head-custom">
        <thead class="bg-primary">
        <tr class="font-weight-bolder">
            <th class="font-weight-bolder" style="color: black !important;" width="20%">Activity Title</th>
            <th class="font-weight-bolder" style="color: black !important;" width="20%">Milestones</th>
            <th class="font-weight-bolder" style="color: black !important;" width="10%">Target Date</th>
            <th class="font-weight-bolder" style="color: black !important;" width="5%">Budget</th>
            <th class="font-weight-bolder" style="color: black !important;" width="5%">Assigned Staff</th>
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
                                <span class="badge badge-info text-uppercase m-1 p-1 ">
                                    {{$plan['activity_type']}}
                                </span>
                            @endif
                        </td>
                    @endif
                    <td width="20%">{{$plan['milestone_title_en']}}</td>
                    <td width="10%" class="text-center">{{enTobn(formatDate($plan['milestone_target']))}}</td>
                    @if($loop->iteration == 1)
                        <td width="5%" class="vertical-middle text-center" rowspan="{{count($annual_plan)}}">
                            {{isset($plan['assigned_budget']) ? enTobn($plan['assigned_budget']) : 0}}
                        </td>
                    @endif
                    @if($loop->iteration == 1)
                        <td width="5%" class="vertical-middle text-center" rowspan="{{count($annual_plan)}}">
                            {{isset($plan['assigned_staff']) ? enTobn($plan['assigned_staff']) : 0}}
                        </td>
                    @endif

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

