@php
    $nominatedOffices = json_decode($audit_plan['annual_plan']['nominated_offices'],true);
@endphp

<div class="audit_schedule_list_div">
    <table id="audit_schedule_table_{{$team_layer_id}}" class="audit-schedule-table table table-bordered table-striped table-hover table-condensed
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
        <tr class='audit_schedule_row_{{$team_layer_id}}' data-schedule-first-row='0_0'>
            <td>
                <select class="form-control input-branch-name" data-id="{{$team_layer_id}}_0">
                    <option value=''>--Select--</option>
                    @foreach($nominatedOffices as $key => $nominatedOffice)
                        <option value="{{$nominatedOffice['office_id']}}" data-office-name-bn="{{$nominatedOffice['office_name_bn']}}" data-office-name-en="{{$nominatedOffice['office_name_en']}}">{{$nominatedOffice['office_name_bn']}}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <div class="row">
                    <div class="col">
                        <input type="text" data-id="{{$team_layer_id}}_0"
                               class="year-picker form-control input-start-year"
                               placeholder="শুরু"/>
                    </div>
                    <div class="col">
                        <input type="text" data-id="{{$team_layer_id}}_0"
                               class="year-picker form-control input-end-year"
                               placeholder="শেষ"/>
                    </div>
                </div>
            </td>
            <td>
                <div class="row">
                    <div class="col">
                        <input type="text" data-id="{{$team_layer_id}}_0"
                               class="date form-control input-start-duration"
                               placeholder="শুরু"/>
                    </div>
                    <div class="col">
                        <input type="text" data-id="{{$team_layer_id}}_0"
                               class="date form-control input-end-duration"
                               placeholder="শেষ"/>
                    </div>
                </div>
            </td>

            <td>
                <input type="number" data-id="{{$team_layer_id}}_0" value="0"
                       class="form-control input-total-working-day"
                       id="input_total_working_day_{{$team_layer_id}}_0"/>
            </td>
            <td>

            </td>
        </tr>
        <tr data-schedule-second-row='0_0'>
            <td>
                <input type="text" data-id="{{$team_layer_id}}_0" class="date form-control input-detail-duration"/>
            </td>
            <td colspan="4">
                <input type="text" data-id="{{$team_layer_id}}_0" class="form-control input-detail"/>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<script>
    var Load_Team_Schedule = {
        addAuditScheduleTblRow:function (){
            var totalAuditScheduleRow = $('.audit-schedule-table tbody tr').length +1;
            var teamScheduleHtml = "<tr class='audit_schedule_row_{{$team_layer_id}}' data-audit-schedule-first-row='"+totalAuditScheduleRow+"_"+{{$team_layer_id}}+"'>";
            teamScheduleHtml += "<td>" +
                "<select class='form-control input-branch-name' data-id='{{$team_layer_id}}_"+ totalAuditScheduleRow +"'>" +
                "<option value=''>--Select--</option>"+
                @foreach($nominatedOffices as $key => $nominatedOffice)
                    "<option value='{{$nominatedOffice['office_id']}}' data-office-name-bn='{{$nominatedOffice['office_name_bn']}}' data-office-name-en='{{$nominatedOffice['office_name_en']}}'>{{$nominatedOffice['office_name_bn']}}</option>"+
                @endforeach
                "</select></td>";
            teamScheduleHtml += "<td><div class='row'><div class='col'><input type='text' " +
                "class='year-picker form-control input-start-year' data-id='{{$team_layer_id}}_"+ totalAuditScheduleRow +"' placeholder='শুরু'/></div><div class='col'>" +
                "<input type='text' class='year-picker form-control input-end-year' data-id='{{$team_layer_id}}_"+ totalAuditScheduleRow +"' placeholder='শেষ'/>" +
                "</div></div></td>";

            teamScheduleHtml += "<td><div class='row'><div class='col'><input type='text' " +
                "class='date form-control input-start-duration' data-id='{{$team_layer_id}}_"+ totalAuditScheduleRow +"' placeholder='শুরু'/></div><div class='col'>" +
                "<input type='text' class='date form-control input-end-duration' data-id='{{$team_layer_id}}_"+ totalAuditScheduleRow +"' placeholder='শেষ'/>" +
                "</div></div></td>";

            teamScheduleHtml += "<td><input type='number' value='0' class='form-control input-total-working-day' id='input_total_working_day_{{$team_layer_id}}_"+totalAuditScheduleRow+"' data-id='{{$team_layer_id}}_"+ totalAuditScheduleRow +"'/></td>";
            teamScheduleHtml += "<td><button type='button' data-row='row" + totalAuditScheduleRow + "' class='btn btn-danger btn-sm remove-schedule-row'><span class='fa fa-trash'></span></button></td>";
            teamScheduleHtml += "</tr>";
            teamScheduleHtml += "<tr data-schedule-second-row='"+totalAuditScheduleRow+"_"+{{$team_layer_id}}+"'>";
            teamScheduleHtml += "<td><input type='text' data-id='{{$team_layer_id}}_"+ totalAuditScheduleRow +"' class='date form-control input-detail-duration'/></td>";
            teamScheduleHtml += "<td colspan='4'><input type='text' data-id='{{$team_layer_id}}_"+ totalAuditScheduleRow +"' class='form-control input-detail'/></td>";
            teamScheduleHtml += "</tr>";

            $('#audit_schedule_table_{{$team_layer_id}}').append(teamScheduleHtml);
        }
    };

    $(document).on('click', '.remove-schedule-row', function () {
        let rowId = $(this).closest("tr").data('audit-schedule-first-row');
        $('#audit_schedule_table_{{$team_layer_id}} tbody tr[data-schedule-second-row='+rowId+']').remove();
        $(this).closest("tr").remove();
    });


    $(document).on('keyup', '.audit_schedule_row_{{$team_layer_id}} input', function () {
        populateData(this);
    });

    $(document).on('change', '.audit_schedule_row_{{$team_layer_id}} input', function () {
        populateData(this);
    });

    $(document).on('change', '.audit_schedule_row_{{$team_layer_id}} select', function () {
        populateData(this);
    });

    auditScheduleList = {};
    function populateData(element) {
        var id = $(element).data("id");
        console.log(id)
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
            $("#input_total_working_day_"+id).val(totalDayDifference);
            auditScheduleList[id]['total_working_days'] = totalDayDifference;
        }

        /*total working days*/
        if ($(element).hasClass('input-total-working-day')) {
            auditScheduleList[id]['total_working_days'] = currentInputValue;
        }
    }
</script>
