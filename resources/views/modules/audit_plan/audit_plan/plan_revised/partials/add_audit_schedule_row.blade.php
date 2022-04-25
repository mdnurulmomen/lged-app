<tbody id="schedule_tbody_{{$layer_id}}_{{$total_audit_schedule_row}}" data-schedule-type='schedule' data-tbody-id='{{$layer_id}}_{{$total_audit_schedule_row}}'>
<tr class='audit_schedule_row_{{$layer_id}}' data-layer-id='{{$layer_id}}'
    data-audit-schedule-first-row='{{$total_audit_schedule_row}}_{{$layer_id}}'>
    <td class='selected_entity_data_{{$layer_id}}'>
        <select data-id="{{$layer_id}}_{{$total_audit_schedule_row}}" class='form-control select-select2 input-entity-name'>
            <option>--{{___('generic.choose')}}--</option>
            @foreach(json_decode($entity_list,true) as $key => $entity)
                <option data-ministry-id="{{$entity['ministry_id']}}"
                        data-ministry-name-bn="{{$entity['ministry_name_bn']}}"
                        data-ministry-name-en="{{$entity['ministry_name_bn']}}"
                        data-entity-name-bn="{{$entity['entity_name_bn']}}"
                        data-entity-name-en="{{$entity['entity_name_en']}}"
                        value="{{$entity['entity_id']}}">{{$entity['entity_name_bn']}}</option>
            @endforeach
        </select>
    </td>
    <td class='selected_nominated_office_data_{{$layer_id}}'>
        <select id="branch_name_select_{{$layer_id}}_{{$total_audit_schedule_row}}" data-id="{{$layer_id}}_{{$total_audit_schedule_row}}" class='form-control select-select2 input-branch-name'>
            <option>--{{___('generic.loading')}}--</option>
        </select>
    </td>

    <td>
        <div class='row'>
            <div class='col pr-0'>
                <input style="padding: 5px"
                    type='text'
                    class='date form-control input-start-duration'
                    data-id='{{$layer_id}}_{{$total_audit_schedule_row}}' placeholder='শুরু'/>
            </div>
            <div class='col pl-0'>
                <input  style="padding: 5px" type='text' class='date form-control input-end-duration'
                       data-id='{{$layer_id}}_{{$total_audit_schedule_row}}' placeholder='শেষ'/>
            </div>
        </div>
    </td>
    <td><input style="padding: 5px" type='number' min='0' value='0' class='form-control input-total-working-day bijoy-bangla'
               id='input_total_working_day_{{$layer_id}}_{{$total_audit_schedule_row}}'
               data-id='{{$layer_id}}_{{$total_audit_schedule_row}}'/></td>
    <td>
        <div style="display:flex;">
            <button title='Add Schedule' type='button' onclick='addAuditScheduleTblRow({{$layer_id}},{{$total_audit_schedule_row}})'
                    class='pulse pulse-primary btn btn-icon btn-outline-success border-0 btn-xs mr-2'>
                <span class='fad fa-calendar-day'></span>
            </button>
            <button title='Add Transit' type='button' onclick='addDetailsTblRow({{$layer_id}},{{$total_audit_schedule_row}})'
                    class='btn btn-icon btn-outline-warning border-0 btn-xs mr-2'>
                <span class='fad fa-plus'></span>
            </button>
            <button title='Remove' onclick='removeScheduleRow($(this), {{$layer_id}})' type='button'
                    data-row='row{{$total_audit_schedule_row}}'
                    class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2'>
                <span class='fal fa-trash-alt'></span>
            </button>
        </div>
    </td>
</tr>
</tbody>

<script>
    $(".input-entity-name").change(function () {
        parent_office_id = $(this).val();

        layer_row = $(this).attr('data-id');
        layer_row = layer_row.split("_");

        layer_id = layer_row[0];
        row = layer_row[1];

        loadSelectNominatedOffices(parent_office_id, layer_id, row);
    });
</script>
