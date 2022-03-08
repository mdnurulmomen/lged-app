@if(empty($annual_plans))
<div class="card sna-card-border mt-3" style="margin-bottom:30px;">
    <div class="table-responsive mb-4">
        <table class="table table-bordered table-head-custom">
            <thead class="bg-primary">
            <tr class="font-weight-bolder">
                <th class="font-weight-bolder" style="color: black !important;" width="20%">Activity Title</th>
                <th class="font-weight-bolder" style="color: black !important;" width="20%">Milestones</th>
                <th class="font-weight-bolder" style="color: black !important;" width="10%">Target Date</th>
                <th class="font-weight-bolder" style="color: black !important;" width="5%">Budget</th>
                <th class="font-weight-bolder" style="color: black !important;" width="5%">No of Items</th>
                <th class="font-weight-bolder" style="color: black !important;" width="5%">Assigned Staff</th>
                <th class="font-weight-bolder" style="color: black !important;" width="5%">Action</th>
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
                                {{isset($plan['total_no_of_items']) ? enTobn($plan['total_no_of_items']) : 0}}
                            </td>
                        @endif
                        @if($loop->iteration == 1)
                            <td width="5%" class="vertical-middle text-center" rowspan="{{count($annual_plan)}}">
                                @if(isset($plan['total_assigned_staff']))
                                    {{enTobn($plan['total_assigned_staff'])}}
                                @else
                                    {{isset($plan['assigned_staff']) ? enTobn($plan['assigned_staff']) : 0}}
                                @endif
                            </td>
                        @endif
                        @if($plan['activity_type'] == 'financial' || $plan['activity_type'] == 'performance' || $plan['activity_type'] == 'compliance')
                            @if($loop->iteration == 1)
                                <td width="5%" class="vertical-middle text-center" rowspan="{{count($annual_plan)}}"></td>
                            @endif
                        @else
                            <td width="5%" class="text-center">
                                <button data-schedule-id="{{ $plan['schedule_id'] }}"
                                        type="button" class="btn btn-outline-secondary btn-icon btn_edit_activity_milestone_value btn-square">
                                        <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        @endif

                    </tr>
                @endforeach
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@else
    <div class="alert alert-custom alert-white alert-shadow fade show gutter-b" role="alert">
        <div class="alert-icon">
            <i class="text-danger flaticon-warning"></i>
        </div>
        <div class="alert-text">
            {{___('generic.no_data_found')}}
        </div>
    </div>
@endif

<script>
     $('.btn_edit_activity_milestone_value').on('click', function (){

        url = '{{route('audit.plan.annual.plan.list.load-edit-milestone')}}';
        schedule_id = $(this).data('schedule-id');

        data = {schedule_id};

        KTApp.block('#kt_content', {
            opacity: 0.1,
            state: 'primary' // a bootstrap color
        });

        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
            KTApp.unblock('#kt_content');
            if (response.status === 'error') {
                toastr.error('No data found');
            }
            else {
                $(".offcanvas-title").text('Activity Wise Value Entry');
                quick_panel = $("#kt_quick_panel");
                quick_panel.addClass('offcanvas-on');
                quick_panel.css('opacity', 1);
                quick_panel.css('width', '40%');
                quick_panel.removeClass('d-none');
                $("html").addClass("side-panel-overlay");
                $(".offcanvas-wrapper").html(response);
            }
        });

    });

</script>



