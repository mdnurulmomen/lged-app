{{--{{dd($activity_calendars)}}--}}
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
            @forelse($activity_calendars as $activity_calendar)
                @if(!empty($activity_calendar['milestones']))
                    <tr>
                        <td class="vertical-middle">
                            {{$activity_calendar['title_en']}}
                        </td>
                        <td class="p-0">
                            <table class="table table-bordered w-100 mb-0">
                                @foreach($activity_calendar['milestones'] as $milestone)
                                    <tr>
                                        <td>{{$milestone['title_en']}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                        <td class="p-0">
                            <table class="table table-bordered w-100 mb-0">
                                @foreach($activity_calendar['milestones'] as $milestone)
                                    <tr>
                                        <td class="p-0">
                                            <input data-milestone-id="{{$milestone['id']}}"
                                                   data-activity-id="{{$activity_calendar['id']}}"
                                                   data-milestone-calendar-id="{{$milestone['milestone_calendar']['id']}}"
                                                   type="date"
                                                   value="{{$milestone['milestone_calendar']['target_date']}}"
                                                   class="form-control border-0 w-100 date target_date">
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                        <td class="p-0">
                            <table class="table w-100 mb-0 table-borderless">
                                <tr class="border-bottom">
                                    <td class="p-0" style="width: 25px;">
                                        <button
                                            data-activity-id="{{$activity_calendar['id']}}"
                                            data-activity-no="{{$activity_calendar['activity_no']}}"
                                            class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary add_responsible">
                                            <i class="fas {{count($activity_calendar['responsibles']) > 0 ? "fa-edit" : "fa-plus-square"}}"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td id="added_responsible_area_{{$activity_calendar['id']}}">
                                        @forelse($activity_calendar['responsibles'] as $responsible)
                                            {{--    <table>--}}
                                            {{--        <tr id="">--}}
                                            {{--            <td>--}}
                                            {{--                <i class="fas fa-building mr-2 text-primary"></i>{{$responsible['office']['short_name_en']}}--}}
                                            {{--            </td>--}}
                                            {{--        </tr>--}}
                                            {{--   </table>--}}
                                            {{$responsible['office']['short_name_en']}} {{$loop->last ? '' : ','}}
                                        @empty
                                            <table>
                                                <tr id="">
                                                    <td>
                                                        Responsibles
                                                    </td>
                                                </tr>
                                            </table>
                                        @endforelse
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td class="p-0">
                            <table class="table w-100 mb-0 table-borderless">
                                <tr class="border-bottom">
                                    <td class="p-0" style="width: 25px;">
                                        <button
                                            data-activity-id="{{$activity_calendar['id']}}"
                                            data-activity-no="{{$activity_calendar['activity_no']}}"
                                            class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary add_activity_comment">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td id="added_comment_area_{{$activity_calendar['id']}}">
                                        @if(isset($activity_calendar['comment']))
                                            <textarea
                                                class=" w-100 form-control" style="height: 100px !important;"
                                                readonly>{!! $activity_calendar['comment']['comment_en'] !!}</textarea>
                                        @else
                                            <textarea class=" w-100 form-control" style="height: 25px !important;"
                                                      readonly></textarea>
                                        @endif
                                    </td>
                                </tr>
                            </table>
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
        $('#audit_calendar_responsible_modal [id^=row_office_id]').remove('')
        $('#audit_calendar_responsible_form .activity_id').val($(this).data('activity-id'))
        $('#audit_calendar_responsible_modal #audit_calendar_responsible_modal_title').text('Responsible for - ' + $(this).data('activity-no'))
        $('#audit_calendar_responsible_modal').modal('show')
    });

    $('.add_activity_comment').click(function () {
        emptyModalData('audit_calendar_responsible_modal')
        $('#audit_calendar_remarks_form .activity_id').val($(this).data('activity-id'))
        $('#audit_calendar_remarks_modal #audit_calendar_remarks_modal_title').text('Comment - ' + $(this).data('activity-no'))
        $('#audit_calendar_remarks_modal').modal('show')
    });
</script>

