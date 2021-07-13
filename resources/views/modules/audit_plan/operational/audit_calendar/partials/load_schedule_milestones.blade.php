{{--{{dd($activityMilestones)}}--}}
<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Activity</th>
                <th style="">Milestones</th>
                <th style="width:180px">Target Date</th>
                <th style="width:220px">Responsible</th>
                <th style="width:220px">Comment</th>
            </tr>
            </thead>
            <tbody>
            @forelse($activityMilestones as $activityMilestone)
                @if(!empty($activityMilestone['milestones']))
                    <tr>
                        <td class="vertical-middle">
                            {{$activityMilestone['activity_no']}}
                        </td>
                        <td class="p-0">
                            <table class="table table-bordered w-100 mb-0">
                                @foreach($activityMilestone['milestones'] as $milestone)
                                    <tr>
                                        <td>{{$milestone['title_en']}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                        <td class="p-0">
                            <table class="table table-bordered w-100 mb-0">
                                @foreach($activityMilestone['milestones'] as $milestone)
                                    <tr>
                                        <td class="p-0">
                                            <input data-milestone-id="{{$milestone['id']}}"
                                                   data-activity-id="{{$activityMilestone['id']}}"
                                                   data-milestone-calendar-id="{{$milestone['milestone_calendar']['id']}}"
                                                   type="date"
                                                   value="{{$milestone['milestone_calendar']['target_date']}}"
                                                   class="form-control border-0 w-100 date target_date">
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                        <td class="vertical-middle">
                            <table class="table w-100 mb-0">
                                <tr>
                                    <td class="p-0" style="width: 25px;">
                                        <i class="fas fa-plus-square fa-2x add_responsible" style=""
                                           data-activity-id="{{$activityMilestone['id']}}"
                                           data-activity-no="{{$activityMilestone['activity_no']}}"></i>
                                    </td>
                                    <td>
                                        <span>Responsible</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td class="p-0">
                            <textarea class="h-100 w-100 form-control"></textarea>
                        </td>
                    </tr>
                @endif
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
</div>

<script>
    $('.target_date').change(function () {
        target_date = $(this).val();
        milestone_id = $(this).data('milestone-id');
        activity_id = $(this).data('activity-id');
        yearly_audit_calendar_id = $(this).data('milestone-calendar-id');
        data = {target_date, milestone_id, activity_id, yearly_audit_calendar_id}
        url = '{{route('audit.plan.operational.calendar.milestone.date.update')}}';
        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
            if (response.status === 'success') {
                toastr.success('Added Successfully')
            } else {
                toastr.error('Please try again.')
                console.log(response)
            }
        });
    });

    $('.add_responsible').click(function () {
        emptyModalData('audit_calendar_responsible_modal')
        $('#audit_calendar_responsible_form .activity_id').val($(this).data('activity-id'))
        $('#audit_calendar_responsible_modal #audit_calendar_responsible_modal_title').text($(this).data('activity-no'))
        $('#audit_calendar_responsible_modal').modal('show')
    });
</script>

