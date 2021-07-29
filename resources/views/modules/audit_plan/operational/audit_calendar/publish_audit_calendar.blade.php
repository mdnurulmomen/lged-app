<x-title-wrapper>Annual Audit Calender</x-title-wrapper>
<div class="col-lg-12">
    <div class="card card-custom card-stretch gutter-b">
        <div class="card-body pt-0 pb-3">
            <form id="publish_audit_calendar_form">
                <div class="table-responsive datatable datatable-default datatable-bordered datatable-loaded">
                    <table class="datatable-bordered datatable-head-custom datatable-table"
                           id="kt_datatable"
                           style="display: block;">
                        <thead class="datatable-head">
                        <tr class="datatable-row">
                            <th class="datatable-cell datatable-cell-sort" width="60%">Office</th>
                            <th class="datatable-cell datatable-cell-sort" width="2%">Activity</th>
                            <th class="datatable-cell datatable-cell-sort" width="2%">Tasks</th>
                            <th class="datatable-cell datatable-cell-sort" width="16%">Status</th>
                        </tr>
                        </thead>
                        <tbody style="" class="datatable-body">
                        @forelse($pending_events as $pending_event)
                            <tr data-row="{{$loop->iteration}}" class="datatable-row">
                                <td width="60%" class="vertical-middle datatable-cell">
                                    {{ $pending_event['office']['office_name_en'] }}
                                </td>
                                <td width="2%" class="vertical-middle datatable-cell text-center">
                                    {{$pending_event['activity_count']}}
                                </td>
                                <td width="2%" class="vertical-middle datatable-cell text-center">
                                    {{$pending_event['milestone_count']}}
                                </td>
                                <td width="16%" class="vertical-middle datatable-cell">
                                    @if($pending_event['status'] == 'pending')
                                        <button
                                            onclick="Publish_Audit_Calendar.retryOrSinglePublish({{$pending_event['office_id']}})"
                                            title="Retry"
                                            class="btn btn-square btn-light btn-hover-icon-success btn-icon-primary list-btn-toggle text-danger"
                                            type="button">
                                            <span class="">Pending</span>
                                            <i class="fad fa-repeat-alt" data-toggle="popover"
                                               data-content="Pending"></i>
                                        </button>
                                        <input type="hidden" name="office_ids[]"
                                               value="{{$pending_event['office_id']}}">
                                    @elseif($pending_event['status'] == 'published')
                                        <button
                                            title="Published"
                                            class="btn btn-square btn-light btn-hover-icon-success btn-icon-primary list-btn-toggle text-success"
                                            type="button">
                                            <span>Published</span>
                                            <i class="fad fa-check" data-toggle="popover" data-content="Published"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="vertical-middle" colspan="3">
                                    No Data Found
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <input type="hidden" name="calendar_id" class="audit_calendar_id" value="{{$calendar_id}}">

                <button
                    onclick="Publish_Audit_Calendar.publishAll()"
                    title="Publish All"
                    class="btn btn-square btn-light btn-hover-icon-success btn-icon-primary list-btn-toggle text-danger"
                    type="button">
                    <span class="">Publish All</span>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    var Publish_Audit_Calendar = {
        publishAll: function () {
            url = '{{route('audit.plan.operational.calendar.publish')}}';
            data = $('#publish_audit_calendar_form').serialize();
            Publish_Audit_Calendar.publishCalendar(url, data);
        },

        retryOrSinglePublish: function (office_id) {
            url = '{{route('audit.plan.operational.calendar.publish')}}';
            data = {
                'calendar_id': $('#publish_audit_calendar_form .audit_calendar_id').val(),
                'office_ids[0]': office_id
            }

            Publish_Audit_Calendar.publishCalendar(url, data);
        },

        publishCalendar: function (url, data) {
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'success') {

                    pending_url = '{{route('audit.plan.operational.calendar.pending-event-to-publish')}}';
                    calendar_id = $('#publish_audit_calendar_form .audit_calendar_id').val();
                    pending_data = {calendar_id};
                    ajaxCallAsyncCallbackAPI(pending_url, pending_data, 'POST', function (response) {
                        if (response.status === 'error') {
                            toastr.error('Error')
                        } else {
                            $("#kt_content").html(response);
                        }
                    });
                } else {
                    toastr.error('Error!');
                    console.log(response.data)
                }
            });
        }
    };

</script>
