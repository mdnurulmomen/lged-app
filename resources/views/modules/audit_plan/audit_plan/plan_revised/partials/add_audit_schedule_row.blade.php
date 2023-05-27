<tbody class="sequence_tbody_{{$layer_id}}" id="schedule_tbody_{{$layer_id}}_{{$total_audit_schedule_row}}" data-schedule-type='schedule' data-tbody-id='{{$layer_id}}_{{$total_audit_schedule_row}}'>
<tr class='audit_schedule_row_{{$layer_id}}' data-layer-id='{{$layer_id}}'
    data-audit-schedule-first-row='{{$total_audit_schedule_row}}_{{$layer_id}}'>
    <td class='selected_nominated_office_data_{{$layer_id}}'>
        <select id="branch_name_select_{{$layer_id}}_{{$total_audit_schedule_row}}" data-id="{{$layer_id}}_{{$total_audit_schedule_row}}" class='form-control input-branch-name'>
            <option>--{{___('generic.choose')}}--</option>
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
            <button title='Remove' onclick='removeScheduleRow($(this),{{$layer_id}},"{{$schedule_type}}")' type='button'
                    data-row='row{{$total_audit_schedule_row}}'
                    class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2'>
                <span class='fal fa-trash-alt'></span>
            </button>
        </div>
    </td>
</tr>
</tbody>

<script>
    $('.input-branch-name').select2({
        ajax: {
            url: '{{route('audit.plan.audit.editor.get-entity-wise-cos-center-autocomplete')}}',
            method: 'post',
            delay: 3000,
            dataType: 'json',
            data: function (params) {
                layer_row = $(this).attr('data-id');
                parent_office_id = $('#entity_name_select_'+layer_row).val();
                project_id = '{{$project_id}}';
                sector_id = '{{$sector_id}}';
                sector_type = '{{$sector_type}}';
                return {
                    sector_id: sector_id,
                    sector_type: sector_type,
                    parent_office_id: parent_office_id,
                    project_id: project_id,
                    cost_center_name_bn: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;

                return {
                    results: $.map(data.results, function (item) {
                        cost_center_info = {
                            'cost_center_id': item.id,
                            'cost_center_name_en': item.office_name_en,
                            'cost_center_name_bn': item.office_name_bn,
                        };
                        return {
                            text: item.office_name_en,
                            id: JSON.stringify(cost_center_info)
                        }
                    }),
                    pagination: {
                        more: (params.page * 10) < data.data_count
                    }
                };
            },
        },
        // minimumInputLength: 5,
    });
</script>
