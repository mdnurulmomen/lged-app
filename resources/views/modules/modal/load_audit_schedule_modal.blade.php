<!-- Office Modal -->
<div class="modal fade" id="auditScheduleModal" tabindex="-1" role="dialog"
     aria-labelledby="auditScheduleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="auditScheduleModalLabel">Add Audit Schedule</h5>
            </div>
            <div class="modal-body">
                <div class="audit_schedule_list_div">
                    <table class="audit-schedule-table table table-bordered table-striped table-hover table-condensed
                                            text-center">
                        <thead>
                        <tr>
                            <th width="5%">ক্রমিক নং</th>
                            <th width="15%">
                                শাখার নাম
                            </th>
                            <th width="27%">
                                নিরীক্ষা বছর
                            </th>
                            <th width="40%">
                                নিরীক্ষার সময়কাল
                            </th>

                            <th width="8%">
                                মোট কর্ম দিবস
                            </th>
                            <th width="5%">
                                <div class="ml-1" align="left">
                                    <button type="button" id="addRowInAuditScheduleTbl"
                                            class="btn btn-warning btn-sm">+
                                    </button>
                                </div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                1
                            </td>
                            <td>
                                <input type="text" name="branch_names[]"
                                       class="form-control"
                                       placeholder="শাখার নাম"/>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <input type="text" name="audit_start_years[]"
                                               class="form-control"
                                               placeholder="শুরু"/>
                                    </div>
                                    <div class="col">
                                        <input type="text" name="audit_end_years[]"
                                               class="form-control"
                                               placeholder="শেষ"/>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <input type="date" name="audit_start_time_schedules[]"
                                               class="form-control"
                                               placeholder="শুরু"/>
                                    </div>
                                    <div class="col">
                                        <input type="date" name="audit_end_time_schedules[]"
                                               class="form-control"
                                               placeholder="শেষ"/>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <input type="number" name="total_working_days[]"
                                       class="form-control"/>
                            </td>
                            <td>

                            </td>
                        </tr>
                        </tbody>
                    </table>

                    {{--<div class="ml-1" align="left">
                        <button type="button" id="addRowInAuditScheduleTbl"
                                class="btn btn-warning btn-sm">+
                        </button>
                    </div>--}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary"
                        onclick="">Assign</button>
            </div>
        </div>
    </div>
</div>

<script>
    // add row
    var count = 1;
    $("#addRowInAuditScheduleTbl").click(function () {
        count = count + 1;
        var newRow = "<tr id='row" + count + "'>";
        newRow += "<td>" + count + "</td>";
        newRow += "<td><input type='text' name='branch_names[]' class='form-control' placeholder='শাখার নাম'/></td>";
        newRow += "<td><div class='row'><div class='col'><input type='text' name='audit_start_years[]' " +
            "class='form-control' placeholder='শুরু'/></div><div class='col'>" +
            "<input type='text' name='audit_end_years[]' class='form-control' placeholder='শেষ'/>" +
            "</div></div></td>";

        newRow += "<td><div class='row'><div class='col'><input type='date' name='audit_start_time_schedules[]' " +
            "class='form-control' placeholder='শুরু'/></div><div class='col'>" +
            "<input type='date' name='audit_end_time_schedules[]' class='form-control' placeholder='শেষ'/>" +
            "</div></div></td>";

        newRow += "<td><input type='number' name='total_working_days[]' class='form-control'/></td>";
        newRow += "<td><button type='button' name='remove' data-row='row" + count + "' class='btn btn-danger btn-sm remove'><span class='fa fa-trash'></span></button></td>";
        newRow += "</tr>";

        $('.audit-schedule-table').prepend(newRow);
    });

    $(document).on('click', '.remove', function () {
        var delete_row = $(this).data("row");
        $('#' + delete_row).remove();
    });
</script>
