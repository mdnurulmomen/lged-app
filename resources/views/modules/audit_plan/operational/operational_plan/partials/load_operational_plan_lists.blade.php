<div class="card sna-card-border mt-3" style="margin-bottom:30px;">
    @foreach ($ops as $op)
        <div class="card rounded-0 mt-5">
            <div class="rounded-0 card-header text-center bg-light-primary py-3 px-5">
                <h3 class="font-size-h3">{{$op['outcome']}}-{{$op['outcome_id']}}:</h3>
                <p class="font-size-h5 mb-0">{!! $op['outcome_remarks'] !!}</p>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered table-light mb-0">
                    <thead class="bg-primary">
                    <tr>
                        <th style="width: 300px; text-align: center;" class="bg-primary text-light">
                            <strong>Output</strong>
                        </th>
                        <th style="width: 200px; text-align: center;" class="bg-primary text-light">
                            <strong>Activity<a title="" href="#_ftn1" name="_ftnref1"
                                               data-mce-href="#_ftn1">[1]</a></strong>
                        </th>
                        <th style="width: 250px; text-align: center;" class="bg-primary text-light">
                            <strong>Milestone</strong>
                        </th>
                        <th style="width: 200px; text-align: center;" class="bg-primary text-light">
                            <strong>Target Date</strong>
                        </th>
                        <th style="width: 150px; text-align: center;" class="bg-primary text-light">
                            <strong>Responsible</strong>
                        </th>
                        <th style="width: 100px; text-align: center;" class="bg-primary text-light">
                            <strong>Budget<a title="" href="#_ftn2" name="_ftnref2"
                                             data-mce-href="#_ftn2">[2]</a></strong>
                        </th>
                        <th style="width: 150px; text-align: center;" class="bg-primary text-light">
                            <strong>Staff Assigned</strong>
                        </th>
                        <th style="width: 150px; text-align: center;" class="bg-primary text-light">
                            <strong>Other Resources</strong>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($op['output'] as $output)
                        <tr>
                            @foreach ($output['activities']  as $key => $activity)
                                @if($loop->first)
                                    <td style="text-align: left; border-bottom-color: transparent;"
                                        class="bg-light">
                                        <p><strong>{{$output['output']}}:</strong></p>
                                        <p><strong>{{$output['output_remarks']}}</strong></p>
                                    </td>
                                @else
                                    <td></td>
                                @endif
                                <td style="text-align: center;"
                                    class="{{$loop->odd ? 'bg-light' : 'bg-white'}}">
                                    <p><strong>{{$activity['activity_no']}}:</strong></p>
                                    <p><strong>{{$activity['title_en']}}</strong></p>
                                </td>

                                <td style="text-align: center; padding: 0;">
                                    <table style="border: none; width: 100%;">
                                        @foreach ($activity['milestones'] as $milestone)
                                            <tr>
                                                <td class="bg-light">
                                                    <p><strong>{{$milestone['title_en']}}</strong></p>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </td>


                                <td style="text-align: center; padding: 0;">
                                    <table style="border: none; width: 100%;">
                                        @foreach ($activity['calendar_activity'] as $calendar)
                                            <tr>
                                                <td class="bg-light">
                                                    <p><strong>{{$calendar['target_date']}}</strong></p>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </td>

                                <td style="text-align: center; vertical-align: middle;"
                                    class="{{$loop->odd ? 'bg-light' : 'bg-white'}}">
                                    @foreach ($activity['responsibles'] as $responsiblity)
                                        <p>
                                            <strong>{{ $responsiblity['short_name_en'] }} {{ next($activity['responsibles']) ? ',' : '' }}</strong>
                                        </p>
                                    @endforeach
                                </td>


                                <td style="text-align: center; padding: 0;">
                                    <table style="border: none; width: 100%;">
                                        <tr>
                                            <td class="bg-light">
                                                <p><strong>&nbsp;</strong></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p><strong>&nbsp;</strong></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light">
                                                <p><strong>&nbsp;</strong></p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="text-align: center; vertical-align: middle;"
                                    class="bg-light text-info">
                                    <div class="operational_staffs" data-activity-id="{{$activity['id']}}">
                                        <p class="mb-0"><strong>{{$activity['assigned_staffs']}}</strong>
                                        </p>
                                        {{--                                                <p class="mb-0"><strong>Annex-01</strong></p>--}}
                                    </div>
                                </td>
                                <td style="text-align: center; padding: 0;">
                                    <table style="border: none; width: 100%;">
                                        <tr>
                                            <td class="bg-light">
                                                <p><strong>&nbsp;</strong></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p><strong>&nbsp;</strong></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light">
                                                <p><strong>&nbsp;</strong></p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                        </tr>
                    @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</div>

<div id="assigned_staff_details_modal_area">

</div>

<script>
    /*$('.operational_staffs').click(function () {
        let url = '{{route('audit.plan.operational.plan.assigned-details.modal')}}';
        let activity_id = $(this).data('activity-id');
        let data = {activity_id}
        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
            if (response.status === 'error') {
                toastr.error(response.data)
            } else {
                $('#assigned_staff_details_modal_area').html();
                $('#assigned_staff_details_modal_area').html(response);
            }
        });
    });*/

    $('.operational_staffs').click(function () {
        detailView();
    });
</script>
