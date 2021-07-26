<x-title-wrapper>Annual Audit Calender</x-title-wrapper>
<div class="col-lg-12">
    <!--begin::Advance Table Widget 4-->
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Header-->
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-0 pb-3">
            <!--begin::Table-->
            <div class="table-responsive datatable datatable-default datatable-bordered datatable-loaded">

                <table class="datatable-bordered datatable-head-custom datatable-table"
                       id="kt_datatable"
                       style="display: block;">

                    <thead class="datatable-head">
                    <tr class="datatable-row" style="left: 0px;">
                        <th class="datatable-cell datatable-cell-sort" style="width: 15%">
                            Fiscal Year
                        </th>

                        <th class="datatable-cell datatable-cell-sort" style="width: 25%">
                            Initiator
                        </th>

                        <th class="datatable-cell datatable-cell-sort" style="width: 25%">
                            Current Desk
                        </th>

                        <th class="datatable-cell datatable-cell-sort" style="width: 10%">
                            Status
                        </th>

                        <th class="datatable-cell datatable-cell-sort" colspan="5" style="width: 25%">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody style="" class="datatable-body">
                    @foreach($yearly_calendars as $yearly_calendar)
                        <tr data-row="{{$loop->iteration}}" class="datatable-row" style="left: 0px;">
                            <td class="datatable-cell" style="width: 15%">
                                <span>{{$yearly_calendar['fiscal_year']}}</span>
                            </td>
                            <td class="datatable-cell" style="width: 25%">
                                <span>{{$yearly_calendar['initiator_name_en']}}</span>
                                <span><small>{{$yearly_calendar['initiator_unit_name_en']}}</small></span>
                            </td>
                            <td class="datatable-cell" style="width: 25%">
                                <span>{{$yearly_calendar['initiator_name_en']}}</span>
                                <span><small>{{$yearly_calendar['initiator_unit_name_en']}}</small></span>
                            </td>
                            <td class="datatable-cell" style=" width: 10% ">
                                <span>{{ucfirst($yearly_calendar['status'])}}</span>
                            </td>
                            @php
                                $viewer = [];
                                $editor = [];
                                $approver = [];
                                foreach ($yearly_calendar['viewers'] as $value) {
                                    $viewer[] = $value['employee_id'];
                                }
                                foreach ($yearly_calendar['editors'] as $value) {
                                    $editor[] = $value['employee_id'];
                                }
                                foreach ($yearly_calendar['approvers'] as $value) {
                                    $approver[] = $value['employee_id'];
                                }
                            @endphp

                            @if (in_array(@$emp['id'], $viewer) || in_array(@$emp['id'], $approver) || in_array(@$emp['id'], $editor))
                                <td class="datatable-cell" style="width: 5%">
                                    <a href="javascript:;"
                                       data-fiscal-year-id="{{$yearly_calendar['fiscal_year_id']}}"
                                       data-yearly-audit-calendar-id="{{$yearly_calendar['id']}}"
                                       data-url="{{route('audit.plan.operational.calendars.show')}}"
                                       class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_view_operational_calendar">
                                        <i class="fad fa-eye"></i>
                                    </a>
                                </td>
                            @endif

                            @if ($yearly_calendar['status'] == 'draft' && (in_array(@$emp['id'], $approver) || in_array(@$emp['id'], $editor)))
                                <td class="datatable-cell" style="width: 5%">
                                    <a href="javascript:;"
                                       data-fiscal-year-id="{{$yearly_calendar['fiscal_year_id']}}"
                                       data-yearly-audit-calendar-id="{{$yearly_calendar['id']}}"
                                       data-url="{{route('audit.plan.operational.calendars.edit')}}"
                                       class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_edit_operational_calendar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            @endif

                            @if (in_array(@$emp['id'], $approver) && $yearly_calendar['status'] == 'draft')
                                <td class="datatable-cell" style="width: 5%">
                                    <button
                                        data-calendar-id="{{$yearly_calendar['id']}}"
                                        class="btn_audit_calendar_approve btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                        type="button">
                                        <i class="fad fa-check" data-toggle="popover" data-content="Approve"></i>
                                    </button>
                                </td>
                            @endif

                            @if (in_array(@$emp['id'], $approver) && $yearly_calendar['status'] == 'approved')
                                <td class="datatable-cell" style="width: 5%">
                                    <button
                                        title="disapprove"
                                        data-calendar-id="{{$yearly_calendar['id']}}"
                                        class="btn_audit_calendar_disapprove btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                        type="button">
                                        <i class="fad fa-times" data-toggle="popover" data-content="Disapprove"></i>
                                    </button>
                                </td>
                            @endif

                            @if ($yearly_calendar['status'] == 'approved')
                                <td class="datatable-cell" style="width: 5%">
                                    <button
                                        title="Publish"
                                        data-calendar-id="{{$yearly_calendar['id']}}"
                                        class="btn_audit_calendar_publish btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                        type="button">
                                        <i class="fad fa-paper-plane" data-toggle="popover" data-content="Publish"></i>
                                    </button>
                                </td>
                            @endif

                            <td class="datatable-cell" style="width: 5%">
                                <button
                                    title="Movement history"
                                    data-calendar-id="{{$yearly_calendar['id']}}"
                                    class="btn_audit_calendar_movement btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                    type="button">
                                    <i class="fad fa-history" data-toggle="popover" data-content="Movement history"></i>
                                </button>
                            </td>

                            <td class="datatable-cell" style="width: 5%">
                                <button
                                    title="Forward"
                                    data-calendar-id="{{$yearly_calendar['id']}}"
                                    class="btn_audit_calendar_forward btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                    type="button">
                                    <i class="fad fa-share" data-toggle="popover" data-content="Forward"></i>
                                </button>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="forward_audit_calendar_modal_area">

</div>

<div class="publish_audit_calendar_modal_area">

</div>

<x-modal id="movement_audit_calendar_modal" title="Movement History" size='lg' saveButton="off">
    <div class="row">
        <div class="movement_audit_calendar_modal_area"></div>
    </div>
</x-modal>

<script>
    $('.btn_view_operational_calendar').on('click', function () {
        url = $(this).data('url')
        fiscal_year_id = $(this).data('fiscal-year-id');
        yearly_audit_calendar_id = $(this).data('yearly-audit-calendar-id');
        ajaxCallAsyncCallbackAPI(url, {fiscal_year_id, yearly_audit_calendar_id}, 'POST', function (response) {
            if (response.status === 'error') {
                toastr.error('Error')
            } else {
                $("#kt_content").html(response);
            }
        });
    })

    $('.btn_edit_operational_calendar').on('click', function () {
        url = $(this).data('url')
        fiscal_year_id = $(this).data('fiscal-year-id');
        yearly_audit_calendar_id = $(this).data('yearly-audit-calendar-id');
        ajaxCallAsyncCallbackAPI(url, {fiscal_year_id, yearly_audit_calendar_id}, 'POST', function (response) {
            if (response.status === 'error') {
                toastr.error('Error')
            } else {
                $("#kt_content").html(response);
            }
        });
    })

    $('.btn_audit_calendar_forward').on('click', function () {
        url = '{{route('audit.plan.operational.calendar.forward_modal')}}'
        audit_calendar_id = $(this).data('calendar-id')
        ajaxCallAsyncCallbackAPI(url, {audit_calendar_id}, 'POST', function (response) {
            if (response.status === 'error') {
                toastr.error('Error')
            } else {
                $(".forward_audit_calendar_modal_area").html(response);
                $('#forward_audit_calendar_modal').modal('show')
            }
        });
    })

    $('.btn_audit_calendar_movement').on('click', function () {
        url = '{{route('audit.plan.operational.calendar.movement.history')}}'
        op_yearly_calendar_id = $(this).data('calendar-id')
        ajaxCallAsyncCallbackAPI(url, {op_yearly_calendar_id}, 'POST', function (response) {
            if (response.status === 'error') {
                toastr.error('Error')
            } else {
                $(".movement_audit_calendar_modal_area").html(response);
                $('#movement_audit_calendar_modal').modal('show')
            }
        });
    })

    $('.btn_audit_calendar_publish').on('click', function () {
        url = '{{route('audit.plan.operational.calendar.publish-modal')}}'
        op_yearly_calendar_id = $(this).data('calendar-id')
        ajaxCallAsyncCallbackAPI(url, {op_yearly_calendar_id}, 'POST', function (response) {
            if (response.status === 'error') {
                toastr.error('Error')
            } else {
                $(".publish_audit_calendar_modal_area").html(response);
                $('#publish_audit_calendar_modal').modal('show')
            }
        });
    })

    $('.btn_audit_calendar_approve').on('click', function () {
        Swal.fire({
            title: 'Are you sure ?',
            showCancelButton: true,
            confirmButtonText: `Approve`,
        }).then((result) => {
            if (result.isConfirmed) {
                url = '{{route('audit.plan.operational.calendar.change-status')}}'
                id = $(this).data('calendar-id');
                status = 'approved';
                ajaxCallAsyncCallbackAPI(url, {id, status}, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.error('Error');
                    } else {
                        Swal.fire('Approved!', '', 'success')
                        $('.op_audit_calendar a').click();
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('Canceled', '', 'info')
            }
        });

    })


    $('.btn_audit_calendar_disapprove').on('click', function () {
        Swal.fire({
            title: 'Are you sure ?',
            showCancelButton: true,
            confirmButtonText: `Disapprove`,
        }).then((result) => {
            if (result.isConfirmed) {
                url = '{{route('audit.plan.operational.calendar.change-status')}}'
                id = $(this).data('calendar-id');
                status = 'draft';
                ajaxCallAsyncCallbackAPI(url, {id, status}, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.error('Error');
                    } else {
                        Swal.fire('Disapproved!', '', 'success')
                        $('.op_audit_calendar a').click();
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('Canceled', '', 'info')
            }
        });
    })
</script>
