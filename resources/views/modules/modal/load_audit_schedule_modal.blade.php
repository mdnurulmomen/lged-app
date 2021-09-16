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
                        <tr class='audit_schedule_row'>
                            <td>
                                1
                            </td>
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
                        </tbody>
                    </table>
                </div>

                {{--for hidden container--}}
                <div class="audit_schedule_list_container d-none">
                    <table class="audit_schedule_list" width="100%" border="1">
                        <thead>
                        <tr>
                            <th class="text-center" width="5%">ক্রমিক নং</th>
                            <th class="text-center" width="15%">
                                শাখার নাম
                            </th>
                            <th class="text-center" width="27%">
                                নিরীক্ষা বছর
                            </th>
                            <th class="text-center" width="40%">
                                নিরীক্ষার সময়কাল
                            </th>

                            <th class="text-center" width="13%">
                                মোট কর্ম দিবস
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th class="text-center" width="5%">১</th>
                            <th class="text-center" width="15%">২</th>
                            <th class="text-center" width="27%">৩</th>
                            <th class="text-center" width="40%">৪</th>
                            <th class="text-center" width="13%">৫</th>
                        </tr>
                        <tr>
                            <td class="text-center" width="5%">1.</td>
                            <td class="text-center branch-name" id="branch_name_text1" width="15%"></td>
                            <td class="text-center audit-schedule-year" id="audit_schedule_year_text1" width="27%"></td>
                            <td class="text-center audit-schedule-duration" id="audit_schedule_duration_text1" width="40%"></td>
                            <td class="text-center total-working-day" id="total_working_day_text1" width="13%"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary"
                        onclick="Load_Audit_Schedule_Container.addAuditScheduleInsertIntoEditor()">Assign</button>
            </div>
        </div>
    </div>
</div>

<script>
    auditScheduleList = {};

    // add row
    $("#addRowInAuditScheduleTbl").click(function () {
        var totalAuditScheduleRow = $('.audit-schedule-table tbody tr').length +1;
        var newRow = "<tr class='audit_schedule_row' data-audit-schedule-row='"+totalAuditScheduleRow+"'>";
        newRow += "<td>" + parseInt(totalAuditScheduleRow) + "</td>";
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

        $('.audit-schedule-table').append(newRow);


        var auditScheduleListShowTbl = '<tr data-show-id="'+ totalAuditScheduleRow + '">' +
            '<td class="text-center" width="5%">'+totalAuditScheduleRow +'.</td>' +
            '<td class="text-center branch-name" id="branch_name_text'+totalAuditScheduleRow+'" width="15%"></td>' +
            '<td class="text-center audit-schedule-year" width="27%" id="audit_schedule_year_text'+totalAuditScheduleRow+'"></td>' +
            '<td class="text-center audit-schedule-duration" width="40%" id="audit_schedule_duration_text'+totalAuditScheduleRow+'"></td>' +
            '<td class="text-center total-working-day" width="13%" id="total_working_day_text'+totalAuditScheduleRow+'"></td>' +
            '</tr>';
        $(".audit_schedule_list tbody").append(auditScheduleListShowTbl);
    });

    $(document).on('click', '.remove', function () {
        let rowId = $(this).closest("tr").data('audit-schedule-row');
        $('.audit_schedule_list tbody tr[data-show-id='+rowId+']').remove();
        $(this).closest("tr").remove();
    });


    $(document).on('keyup', '.audit_schedule_row input', function () {
        populateData(this);
    });

    $(document).on('change', '.audit_schedule_row input', function () {
        populateData(this);
    });

    $(document).on('change', '.audit_schedule_row select', function () {
        populateData(this);
    });


    function populateData(element) {
        var id = $(element).data("id");
        var currentInputValue = $(element).val();
        if (typeof auditScheduleList[id] === 'undefined') {
            auditScheduleList[id] = {};
        }

        if ($(element).hasClass('input-branch-name')) {
            branchId = $(element).attr('id');
            branchName = $("#" + branchId +" option:selected").text();
            $("#branch_name_text"+id).text(branchName);
            auditScheduleList[id]['branch_name'] = branchName;
        }

        if ($(element).hasClass('input-start-year')) {
            let endYear = $(element).closest('tr').find('.input-end-year').val();
            let auditYear = currentInputValue +'-'+ endYear;
            $("#audit_schedule_year_text"+id).text(auditYear);
            auditScheduleList[id]['start_year'] = currentInputValue;
        }

        if ($(element).hasClass('input-end-year')) {
            let startYear = $(element).closest('tr').find('.input-start-year').val();
            let auditYear = startYear +'-'+ currentInputValue;
            $("#audit_schedule_year_text"+id).text(auditYear);
            auditScheduleList[id]['end_year'] = currentInputValue;
        }

        /*duration*/
        if ($(element).hasClass('input-start-duration')) {
            let endDuration = $(element).closest('tr').find('.input-end-duration').val();
            let auditDuration = currentInputValue +' হতে '+ endDuration;
            $("#audit_schedule_duration_text"+id).text(auditDuration);
            auditScheduleList[id]['start_duration'] = currentInputValue;
        }

        if ($(element).hasClass('input-end-duration')) {
            let startDuration = $(element).closest('tr').find('.input-start-duration').val();
            let auditDuration = startDuration +' হতে '+ currentInputValue;
            $("#audit_schedule_duration_text"+id).text(auditDuration);
            auditScheduleList[id]['end_duration'] = currentInputValue;


            startDurationData = startDuration.split("/");
            endDurationData = currentInputValue.split("/");
            startDateForamt = startDurationData[1]+'/'+startDurationData[0]+'/'+startDurationData[2];
            endDateForamt = endDurationData[1]+'/'+endDurationData[0]+'/'+endDurationData[2];
            totalDayDifference = dateDifferenceInDay(startDateForamt,endDateForamt);
            //console.log(dateDifferenceInDay(startDateForamt,endDateForamt));
            $("#total_working_day_text"+id).text(BnFromEng(totalDayDifference)+' কর্ম দিবস');
            $("#inputTotalWorkingDay"+id).val(totalDayDifference);
            auditScheduleList[id]['total_working_days'] = totalDayDifference;
        }

        /*total working days*/
        if ($(element).hasClass('input-total-working-day')) {
            $("#total_working_day_text"+id).text(BnFromEng(currentInputValue)+' কর্ম দিবস');
            auditScheduleList[id]['total_working_days'] = currentInputValue;
        }
    }


    var Load_Audit_Schedule_Container = {
        addAuditScheduleInsertIntoEditor:function (){
            var totalWorkingDay = 0;
            $('input[type=number]').each(function(){
                totalWorkingDay = totalWorkingDay+parseInt($(this).val());
            })

            var scheduleList = '<tr>' +
                '<td colspan="4" class="text-right">সর্বমোট</td>' +
                '<td class="text-center">'+ BnFromEng(totalWorkingDay) +' কর্ম দিবস</td>' +
                '</tr>';
            $(".audit_schedule_list tbody").append(scheduleList);

            localStorage.setItem("auditScheduleList", JSON.stringify(auditScheduleList));
            $(".summernote").summernote("editor.pasteHTML", $(".audit_schedule_list_container").html());
            $('#auditScheduleModal').modal('hide');
        }
    }
</script>
