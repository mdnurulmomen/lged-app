<div class="audit_schedule_list_div">
    <table class="audit-schedule-table table table-bordered table-striped table-hover table-condensed
                                            text-center">
        <thead>
        <tr>
            <th width="25%">
                শাখার নাম
            </th>
            <th width="25%">
                নিরীক্ষা বছর
            </th>
            <th width="35%">
                নিরীক্ষার সময়কাল
            </th>

            <th width="12%">
                কর্ম দিবস
            </th>
            <th width="3%">
                <div class="ml-1" align="left">
                    <button type="button" onclick="Load_Team_Schedule.addAuditScheduleTblRow()"
                            class="btn btn-warning btn-sm">+
                    </button>
                </div>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr class='audit_schedule_row'>
            <td>
                <select class="form-control input-branch-name" id="branchNameSelect1" data-id="1">
                    <option value=''>--Select--</option>
                    @foreach(json_decode($audit_plan['annual_plan']['nominated_offices'],true) as $key => $nominatedOffice)
                        <option value="{{$nominatedOffice['office_id']}}" data-office-name-bn="{{$nominatedOffice['office_name_bn']}}" data-office-name-en="{{$nominatedOffice['office_name_en']}}">{{$nominatedOffice['office_name_bn']}}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <div class="row">
                    <div class="col">
                        <input type="text" data-id="1"
                               class="year-picker form-control input-start-year"
                               placeholder="শুরু"/>
                    </div>
                    <div class="col">
                        <input type="text" data-id="1"
                               class="year-picker form-control input-end-year"
                               placeholder="শেষ"/>
                    </div>
                </div>
            </td>
            <td>
                <div class="row">
                    <div class="col">
                        <input type="text" data-id="1"
                               class="date form-control input-start-duration"
                               placeholder="শুরু"/>
                    </div>
                    <div class="col">
                        <input type="text" data-id="1"
                               class="date form-control input-end-duration"
                               placeholder="শেষ"/>
                    </div>
                </div>
            </td>

            <td>
                <input type="number" data-id="1" value="0"
                       class="form-control input-total-working-day"
                       id="inputTotalWorkingDay1"/>
            </td>
            <td>

            </td>
        </tr>
        <tr>
            <td>
                <input type="text" data-id="1" class="date form-control input-detail-duration"/>
            </td>
            <td colspan="4">
                <input type="text" data-id="1" class="form-control input-detail"/>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<script>
    var Load_Team_Schedule = {
        addAuditScheduleTblRow:function (){
            var totalAuditScheduleRow = $('.audit-schedule-table tbody tr').length +1;
            var newRow = "<tr class='audit_schedule_row' data-audit-schedule-row='"+totalAuditScheduleRow+"'>";
            newRow += "<td><select id='branchNameSelect"+ totalAuditScheduleRow +"' class='form-control input-branch-name' data-id='"+ totalAuditScheduleRow +"'>" +
                "<option value=''>--Select--</option>"+
                @foreach(json_decode($audit_plan['annual_plan']['nominated_offices'],true) as $key => $nominatedOffice)
                    "<option value='{{$nominatedOffice['office_id']}}'>{{$nominatedOffice['office_name_bn']}}</option>"
            @endforeach
                "</td>";
            newRow += "<td><div class='row'><div class='col'><input type='text' " +
                "class='year-picker form-control input-start-year' data-id='"+ totalAuditScheduleRow +"' placeholder='শুরু'/></div><div class='col'>" +
                "<input type='text' class='year-picker form-control input-end-year' data-id='"+ totalAuditScheduleRow +"' placeholder='শেষ'/>" +
                "</div></div></td>";

            newRow += "<td><div class='row'><div class='col'><input type='text' " +
                "class='date form-control input-start-duration' data-id='"+ totalAuditScheduleRow +"' placeholder='শুরু'/></div><div class='col'>" +
                "<input type='text' class='date form-control input-end-duration' data-id='"+ totalAuditScheduleRow +"' placeholder='শেষ'/>" +
                "</div></div></td>";

            newRow += "<td><input type='number' value='0' class='form-control input-total-working-day' id='inputTotalWorkingDay"+totalAuditScheduleRow+"' data-id='"+ totalAuditScheduleRow +"'/></td>";
            newRow += "<td><button type='button' name='remove' data-row='row" + totalAuditScheduleRow + "' class='btn btn-danger btn-sm remove'><span class='fa fa-trash'></span></button></td>";
            newRow += "</tr>";
            newRow += "<tr>";
            newRow += "<td><input type='text' data-id='"+ totalAuditScheduleRow +"' class='date form-control input-detail-duration'/></td>";
            newRow += "<td colspan='4'><input type='text' data-id='"+ totalAuditScheduleRow +"' class='form-control input-detail'/></td>";
            newRow += "</tr>";

            $('.audit-schedule-table').append(newRow);
        }
    };


    $(document).on('keyup', '.audit_schedule_row input', function () {
        populateData(this);
    });

    $(document).on('change', '.audit_schedule_row input', function () {
        populateData(this);
    });

    $(document).on('change', '.audit_schedule_row select', function () {
        populateData(this);
    });

    auditScheduleList = {};
    function populateData(element) {
        var id = $(element).data("id");
        var currentInputValue = $(element).val();
        if (typeof auditScheduleList[id] === 'undefined') {
            auditScheduleList[id] = {};
        }

        if ($(element).hasClass('input-branch-name')) {
            branchId = $(element).attr('id');
            branchName = $("#" + branchId +" option:selected").text();
            auditScheduleList[id]['branch_name'] = branchName;
        }

        if ($(element).hasClass('input-start-year')) {
            auditScheduleList[id]['start_year'] = currentInputValue;
        }

        if ($(element).hasClass('input-end-year')) {
            auditScheduleList[id]['end_year'] = currentInputValue;
        }

        /*duration*/
        if ($(element).hasClass('input-start-duration')) {
            auditScheduleList[id]['start_duration'] = currentInputValue;
        }

        if ($(element).hasClass('input-end-duration')) {
            let startDuration = $(element).closest('tr').find('.input-start-duration').val();
            auditScheduleList[id]['end_duration'] = currentInputValue;


            startDurationData = startDuration.split("/");
            endDurationData = currentInputValue.split("/");
            startDateForamt = startDurationData[1]+'/'+startDurationData[0]+'/'+startDurationData[2];
            endDateForamt = endDurationData[1]+'/'+endDurationData[0]+'/'+endDurationData[2];
            totalDayDifference = dateDifferenceInDay(startDateForamt,endDateForamt);
            console.log(totalDayDifference)
            console.log(id)
            $("#inputTotalWorkingDay"+id).val(totalDayDifference);
            auditScheduleList[id]['total_working_days'] = totalDayDifference;
        }

        /*total working days*/
        if ($(element).hasClass('input-total-working-day')) {
            auditScheduleList[id]['total_working_days'] = currentInputValue;
        }
    }
</script>
