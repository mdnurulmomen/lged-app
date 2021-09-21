@php
    $nominatedOffices = json_decode($audit_plan['annual_plan']['nominated_offices'],true);
@endphp

<div class="audit_schedule_list_div">
    <table id="audit_schedule_table_{{$team_layer_id}}" class="audit-schedule-table table table-bordered table-striped table-hover table-condensed
                                            text-center">
        <thead>
        <tr>
            <th width="50%">
                শাখার নাম
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
        <tbody data-tbody-id="{{$team_layer_id}}_1">
        <tr class='audit_schedule_row_{{$team_layer_id}}' data-layer-id="{{$team_layer_id}}" data-schedule-first-row='0_0'>
            <td>
                <select id="branch_name_select_{{$team_layer_id}}_0" class="form-control input-branch-name" data-id="{{$team_layer_id}}_0">
                    <option value=''>--Select--</option>
                    @foreach($nominatedOffices as $key => $nominatedOffice)
                        <option value="{{$nominatedOffice['office_id']}}" data-cost-center-id="{{$nominatedOffice['office_id']}}" data-cost-center-name-bn="{{$nominatedOffice['office_name_bn']}}" data-cost-center-name-en="{{$nominatedOffice['office_name_en']}}">{{$nominatedOffice['office_name_bn']}}</option>
                    @endforeach
                </select>
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
        <tr class="audit_schedule_row_{{$team_layer_id}}" data-layer-id="{{$team_layer_id}}" data-schedule-second-row='0_0'>
            <td width="20%">
                <input type="text" data-id="{{$team_layer_id}}_0" class="date form-control input-detail-duration"/>
            </td>
            <td width="80%" colspan="3">
                <input type="text" data-id="{{$team_layer_id}}_0" class="form-control input-detail"/>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<script>
    var Load_Team_Schedule = {
        addAuditScheduleTblRow:function (){
            var totalAuditScheduleTbody = $('.audit-schedule-table tbody').length +1;
            var totalAuditScheduleRow = $('.audit-schedule-table tbody tr').length +1;
            var teamScheduleHtml = "<tbody data-tbody-id='{{$team_layer_id}}_"+totalAuditScheduleTbody+"'><tr class='audit_schedule_row_{{$team_layer_id}}' data-layer-id='{{$team_layer_id}}' data-audit-schedule-first-row='"+totalAuditScheduleRow+"_"+{{$team_layer_id}}+"'>";
            teamScheduleHtml += "<td>" +
                "<select id='branch_name_select_{{$team_layer_id}}_"+totalAuditScheduleRow+"' class='form-control input-branch-name' data-id='{{$team_layer_id}}_"+ totalAuditScheduleRow +"'>" +
                "<option value=''>--Select--</option>"+
                @foreach($nominatedOffices as $key => $nominatedOffice)
                    "<option value='{{$nominatedOffice['office_id']}}' data-cost-center-id='{{$nominatedOffice['office_id']}}' data-cost-center-name-bn='{{$nominatedOffice['office_name_bn']}}' data-cost-center-name-en='{{$nominatedOffice['office_name_en']}}'>{{$nominatedOffice['office_name_bn']}}</option>"+
                @endforeach
                "</select></td>";

            teamScheduleHtml += "<td><div class='row'><div class='col'><input type='text' " +
                "class='date form-control input-start-duration' data-id='{{$team_layer_id}}_"+ totalAuditScheduleRow +"' placeholder='শুরু'/></div><div class='col'>" +
                "<input type='text' class='date form-control input-end-duration' data-id='{{$team_layer_id}}_"+ totalAuditScheduleRow +"' placeholder='শেষ'/>" +
                "</div></div></td>";

            teamScheduleHtml += "<td><input type='number' value='0' class='form-control input-total-working-day' id='input_total_working_day_{{$team_layer_id}}_"+totalAuditScheduleRow+"' data-id='{{$team_layer_id}}_"+ totalAuditScheduleRow +"'/></td>";
            teamScheduleHtml += "<td><button type='button' data-row='row" + totalAuditScheduleRow + "' class='btn btn-danger btn-sm remove-schedule-row'><span class='fa fa-trash'></span></button></td>";
            teamScheduleHtml += "</tr>";
            teamScheduleHtml += "<tr class='audit_schedule_row_{{$team_layer_id}}' data-layer-id='{{$team_layer_id}}' data-schedule-second-row='"+totalAuditScheduleRow+"_"+{{$team_layer_id}}+"'>";
            teamScheduleHtml += "<td><input type='text' data-id='{{$team_layer_id}}_"+ totalAuditScheduleRow +"' class='date form-control input-detail-duration'/></td>";
            teamScheduleHtml += "<td colspan='3'><input type='text' data-id='{{$team_layer_id}}_"+ totalAuditScheduleRow +"' class='form-control input-detail'/></td>";
            teamScheduleHtml += "</tr></tbody>";

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

    function populateData(element) {
        let id = $(element).data("id");
        let layer_id = $(element).closest('tr').data("layer-id");

        if ($("#list_group_"+layer_id).find('li p[data-member-role=subTeamLeader]').length === 1){
            designationData = $("#list_group_"+layer_id).find('li p[data-member-role=subTeamLeader]').data('content');
        }
        else if($("#list_group_"+layer_id).find('li p[data-member-role=teamLeader]').length === 1){
            designationData = $("#list_group_"+layer_id).find('li p[data-member-role=teamLeader]').data('content');
        }

        designation_id = designationData.designation_id;

        var currentInputValue = $(element).val();
        costCenterId = $(element).closest('tbody').find('.input-branch-name').val();
        if (typeof auditSchedule[designation_id] === 'undefined') {
            auditSchedule[designation_id] = [];
        }
        if (typeof auditSchedule[designation_id][costCenterId] === 'undefined') {
            auditSchedule[designation_id][costCenterId] = [];
        }
        if ($(element).hasClass('input-branch-name')) {
            costCenterIdAttribute = $(element).attr('id');
            let selectedCostCenter = $("#" + costCenterIdAttribute +" option:selected");
            //costCenterId = selectedCostCenter.data("cost-center-id");
            costCenterNameEn = selectedCostCenter.data("cost-center-name-en");
            costCenterNameEn = selectedCostCenter.data("cost-center-name-bn");

            auditSchedule[designation_id][costCenterId]['cost_center_id'] = costCenterId;
            auditSchedule[designation_id][costCenterId]['cost_center_name_en'] = costCenterNameEn;
            auditSchedule[designation_id][costCenterId]['cost_center_name_en'] = costCenterNameEn;
        }

        /*duration*/
        if ($(element).hasClass('input-start-duration')) {
            auditSchedule[designation_id][costCenterId]['team_member_start_date'] = currentInputValue;
        }

        if ($(element).hasClass('input-end-duration')) {
            let startDuration = $(element).closest('tr').find('.input-start-duration').val();
            auditSchedule[designation_id][costCenterId]['team_member_end_date'] = currentInputValue;

            startDurationData = startDuration.split("/");
            endDurationData = currentInputValue.split("/");
            startDateForamt = startDurationData[1]+'/'+startDurationData[0]+'/'+startDurationData[2];
            endDateForamt = endDurationData[1]+'/'+endDurationData[0]+'/'+endDurationData[2];
            totalDayDifference = dateDifferenceInDay(startDateForamt,endDateForamt);
            $("#input_total_working_day_"+id).val(totalDayDifference);
            auditSchedule[designation_id][costCenterId]['activity_man_days'] = totalDayDifference;
        }

        /*total working days*/
        if ($(element).hasClass('input-total-working-day')) {
            auditSchedule[designation_id][costCenterId]['activity_man_days'] = currentInputValue;
        }

        /*team member activity*/
        if ($(element).hasClass('input-detail-duration')) {
            let activityDescription = $(element).closest('tr').find('.input-detail').val();
            auditSchedule[designation_id][costCenterId]['team_member_activity'] = currentInputValue;
            auditSchedule[designation_id][costCenterId]['team_member_activity_description'] = currentInputValue+' ' +activityDescription;
        }

        if ($(element).hasClass('input-detail')) {
            let activityDuration = $(element).closest('tr').find('.input-detail-duration').val();
            auditSchedule[designation_id][costCenterId]['team_member_activity_description'] = activityDuration+' '+currentInputValue;
            auditSchedule[designation_id][costCenterId]['activity_location'] = currentInputValue;
        }
    }
</script>
