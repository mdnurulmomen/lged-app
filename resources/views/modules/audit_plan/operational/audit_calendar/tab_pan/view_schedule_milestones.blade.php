<div class="row mt-5" id="load_schedule_milestones">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Activity</th>
                    <th style="">Milestones</th>
                    <th style="width:180px">Target Date</th>
                    <th style="width:220px">Responsible</th>
                    <th style="width:180px">Comment</th>
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
                                                       readonly
                                                       value="{{$milestone['milestone_calendar']['target_date']}}"
                                                       class="form-control border-0 w-100 date target_date">
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="table w-100 mb-0 table-borderless">
                                    <tr>
                                        <td id="added_responsible_area_{{$activity_calendar['id']}}">
                                            @forelse($activity_calendar['responsibles'] as $responsible)
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
</div>

