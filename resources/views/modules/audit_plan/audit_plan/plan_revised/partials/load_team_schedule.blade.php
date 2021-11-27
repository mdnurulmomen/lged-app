<div class="audit_schedule_list_div">
    <table id="audit_schedule_table_{{$team_layer_id}}" class="audit-schedule-table table table-bordered table-striped table-hover table-condensed table-sm
                                            text-center">
        <thead>
        <tr>
            <th width="52%">
                শাখার নাম
            </th>
            <th width="30%">
                নিরীক্ষার সময়কাল
            </th>

            <th width="12%">
                কর্ম দিবস
            </th>
            <th width="6%">
                <div class="ml-1" align="left">
                    <button type="button"
                            class="btn btn-icon btn-outline-danger border-0 btn-xs mr-2 remove_audit_schedule_list_div">
                        <span class="fal fa-trash-alt"></span>
                    </button>
                </div>
            </th>
        </tr>
        </thead>
        <tbody data-tbody-id="{{$team_layer_id}}_1" data-schedule-type="schedule">
        <tr class='audit_schedule_row_{{$team_layer_id}}' data-layer-id="{{$team_layer_id}}"
            data-audit-schedule-first-row='1_{{$team_layer_id}}'>
            <td>
                <select id="branch_name_select_{{$team_layer_id}}_0" class="form-control select-select2 input-branch-name"
                        data-id="{{$team_layer_id}}_0">
                    <option value=''>--Select--</option>
                    @foreach($nominated_offices_list as $key => $nominatedOffice)
                        <option value="{{$nominatedOffice['id']}}"
                                data-cost-center-id="{{$nominatedOffice['id']}}"
                                data-cost-center-name-bn="{{$nominatedOffice['office_name_bng']}}"
                                data-cost-center-name-en="{{$nominatedOffice['office_name_eng']}}">{{$nominatedOffice['office_name_bng']}}</option>
                        @if(count($nominatedOffice) > 0)
                            @include('modules.audit_plan.audit_plan.plan_revised.partials.select_nominated_office_child', ['nominated_offices_list' => $nominatedOffice['child']])
                        @endif
                    @endforeach
                </select>
            </td>
            <td>
                <div class="row">
                    <div class="col pr-0">
                        <input type="text" data-id="{{$team_layer_id}}_0"
                               class="date form-control input-start-duration"
                               placeholder="শুরু"/>
                    </div>
                    <div class="col pl-0">
                        <input type="text" data-id="{{$team_layer_id}}_0"
                               class="date form-control input-end-duration"
                               placeholder="শেষ"/>
                    </div>
                </div>
            </td>

            <td>
                <input type="number" data-id="{{$team_layer_id}}_0" value="0"
                       class="form-control input-total-working-day"
                       min="0"
                       id="input_total_working_day_{{$team_layer_id}}_0"/>
            </td>
            <td style="display: inline-flex;">
                <button type="button" title="schedule" onclick="addAuditScheduleTblRow({{$team_layer_id}})"
                        class="btn btn-icon btn-outline-success border-0 btn-xs mr-2">
                    <span class="fad fa-calendar-day"></span>
                </button>

                <button type="button" title="visit"
                        onclick="addDetailsTblRow({{$team_layer_id}})"
                        class="btn btn-icon btn-outline-warning border-0 btn-xs mr-2">
                    <span class="fad fa-plus"></span>
                </button>

                <button type='button' title="remove"
                        data-row='row1'
                        onclick="removeScheduleRow($(this), {{$team_layer_id}})"
                        class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2'>
                    <span class='fal fa-trash-alt'></span>
                </button>
            </td>
        </tr>
        </tbody>

        <tbody data-tbody-id="{{$team_layer_id}}_2" data-schedule-type="visit">
        <tr class="audit_schedule_row_{{$team_layer_id}}" data-layer-id="{{$team_layer_id}}"
            data-schedule-second-row='1_{{$team_layer_id}}'>
            <td>
                <input type="text" data-id="{{$team_layer_id}}_0" class="form-control input-detail"/>
            </td>
            <td colspan="2">
                <input type="text" data-id="{{$team_layer_id}}_0" class="date form-control input-detail-duration"/>
                <span class="fal fa-calendar field-icon"></span>
            </td>
            <td style="display: inline-flex;">
                <button type="button" title="schedule"
                        onclick="addAuditScheduleTblRow({{$team_layer_id}})"
                        class="btn btn-icon btn-outline-success border-0 btn-xs mr-2">
                    <span class="fad fa-calendar-day"></span>
                </button>

                <button type="button" title="visit"
                        onclick="addDetailsTblRow({{$team_layer_id}})"
                        class="btn btn-icon btn-outline-warning border-0 btn-xs mr-2">
                    <span class="fad fa-plus"></span>
                </button>

                <button type='button' title="remove"
                        data-row='row1'
                        onclick="removeScheduleRow($(this), {{$team_layer_id}})"
                        class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2'>
                    <span class='fal fa-trash-alt'></span>
                </button>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<script>
    $(document).on('change', '.audit_schedule_row_{{$team_layer_id}} input', function () {
        populateData(this);
    });
</script>


