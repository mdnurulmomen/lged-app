<x-title-wrapper>Annual Audit Calender</x-title-wrapper>
<div class="col-lg-12">
    <!--begin::Advance Table Widget 4-->
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0 py-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark"></span>
            </h3>
            <div class="card-toolbar">
                <a href="javascript:;"
                   onclick="OP_Audit_Calendar_Container.createAnnualCalendar($(this))"
                   class="font-weight-bolder font-size-sm mr-3 btn btn-success btn-sm btn-bold btn-square btn_create_audit_activity"
                   data-url="{{route('audit.plan.operational.calendars.create')}}">
                    <i class="far fa-plus mr-1"></i> Create Annual Audit Calendar
                </a>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-0 pb-3">
            <!--begin::Table-->
            <div class="table-responsive datatable datatable-default datatable-bordered datatable-loaded">

                <table class="table" id="kt_datatable" style="display: block;">

                    <thead class="datatable-head">
                    <tr class="datatable-row" style="left: 0px;">
                        <th class="datatable-cell datatable-cell-sort" style="width: 10%">
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

                        <th class="datatable-cell datatable-cell-sort" colspan="5" style="width: 30%">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody style="" class="">
                    @foreach($yearly_calendars as $yearly_calendar)
                        <tr data-row="{{$loop->iteration}}" class="datatable-row" style="left: 0px;">
                            <td class="datatable-cell" style="width: 10%">
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

                            @if((count($approver) > 0 ) || (count($editor) > 0) || (count($viewer) > 0))
                                <td class="datatable-cell" style="width: 5%">
                                    <button
                                        title="Movement history"
                                        data-calendar-id="{{$yearly_calendar['id']}}"
                                        class="btn_audit_calendar_movement btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                        type="button">
                                        <i class="fad fa-history" data-toggle="popover"
                                           data-content="Movement history"></i>
                                    </button>
                                </td>
                            @endif
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


<div class="create_audit_calendar_modal_area">

</div>

<x-modal id="movement_audit_calendar_modal" title="Movement History" size='lg' saveButton="off">
    <div class="row">
        <div class="movement_audit_calendar_modal_area"></div>
    </div>
</x-modal>

<script>
    var OP_Audit_Calendar_Container = {

            createAnnualCalendar: function (elem) {
                let url = elem.data('url')
                ajaxCallAsyncCallbackAPI(url, {}, 'post', function (response) {
                    if (response.status === 'error') {
                        toastr.error(response.data)
                    } else {
                        $(".create_audit_calendar_modal_area").html(response);
                        $("#create_audit_calendar_modal").modal('show');
                    }
                });
            },

            storeAnnualCalendar: function (elem) {
                url = elem.data('url');
                data = $('#create_audit_calendar_form').serialize();
                method = elem.data('method');
                submitModalData(url, data, method, 'create_audit_calendar_modal');
                $('.op_audit_calendar a').click();
            },

            addOfficerToForwardedList: function (officer_info) {
                if ($('#selected_officer_for_forward_calendar_' + officer_info.designation_id).length === 0) {
                    var newRow = '<tr id="selected_officer_for_forward_calendar_' + officer_info.designation_id + '">' +
                        '<td>' +
                        '<input name="designation_to_forward[]" class="designation_to_forward" data-designation-id="' + officer_info.designation_id + '" id="designation_to_forward_' + officer_info.designation_id + '" type="hidden" value=""/>' +
                        '<span id="btn_remove_officer_' + officer_info.designation_id + '" data-designation-id="' + officer_info.designation_id + '" onclick="OP_Audit_Calendar_Container.removeOfficerFromForwardedList(' + officer_info.designation_id + ')" style="cursor:pointer;color:red;"><i class="fa fa-trash"></i></span>' +
                        '</td>' +
                        '<td>' + officer_info.designation_bn + '</td>' +
                        '<td>' + officer_info.officer_name + '</td>' +
                        '<td>' + '<select name="designation_role[]" class="select-select2"><option value="editor_' + officer_info.designation_id + '" selected>Editor</option><option value="approver_' + officer_info.designation_id + '">Approver</option><option value="viewer_' + officer_info.designation_id + '">Viewer</option></select>' + ' </td>' +
                        '</tr>';
                    $(".ownOfficeForward tbody").prepend(newRow);
                    $(".ownOfficeForward tbody").find('#designation_to_forward_' + officer_info.designation_id).val(JSON.stringify(officer_info));
                    $('.select-select2').select2();
                }
            },

            removeOfficerFromForwardedList: function (designation_id) {
                $('#selected_officer_for_forward_calendar_' + designation_id).remove();
            },

            forwardAuditCalendar: function (elem) {
                url = elem.data('url');
                data = $('#forward_audit_calendar_form').serialize();
                method = elem.data('method');
                submitModalData(url, data, method, 'forward_audit_calendar_modal')
            }
        }
    ;

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
        url = '{{route('audit.plan.operational.calendar.pending-event-to-publish')}}'
        calendar_id = $(this).data('calendar-id')
        ajaxCallAsyncCallbackAPI(url, {calendar_id}, 'POST', function (response) {
            if (response.status === 'error') {
                toastr.error('Error')
            } else {
                $("#kt_content").html(response);
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
