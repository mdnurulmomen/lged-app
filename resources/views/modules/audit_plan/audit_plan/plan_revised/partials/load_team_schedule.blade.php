<div class="audit_schedule_list_div">
    <table id="audit_schedule_table_{{$team_layer_id}}" style="table-layout: fixed" class="audit-schedule-table table table-bordered table-striped table-hover table-condensed table-sm
                                            text-center">
        <thead>
        <tr>
            <th width="26%">
                কস্ট সেন্টার/ইউনিট
            </th>
{{--            <th width="26%">--}}
{{--                কস্ট সেন্টার/ইউনিট--}}
{{--            </th>--}}
            <th width="28%">
                {{$modal_type == 'data-collection' ? 'ডাটা কালেকশনের সময়কাল' : 'নিরীক্ষার সময়কাল' }}
            </th>

            <th width=10%">
                কর্ম দিবস
            </th>
            <th width="10%">
                <div style="display: flex" class="ml-1" align="left">
                    <button type="button"
                            class="btn btn-icon btn-outline-danger border-0 btn-xs mr-2 remove_audit_schedule_list_div">
                        <span class="fal fa-trash-alt"></span>
                    </button>
                </div>
            </th>
        </tr>
        </thead>
        <tbody class="sequence_tbody_{{$team_layer_id}}" id="schedule_tbody_{{$team_layer_id}}_1" data-tbody-id="{{$team_layer_id}}_1" data-schedule-type="schedule">
        <tr class='audit_schedule_row_{{$team_layer_id}}' data-layer-id="{{$team_layer_id}}"
            data-audit-schedule-first-row='1_{{$team_layer_id}}'>
            <td class="selected_nominated_office_data_{{$team_layer_id}}">
                <select id="branch_name_select_{{$team_layer_id}}_0" class="form-control input-branch-name"
                        data-id="{{$team_layer_id}}_0">
                    <option value=''>--{{___('generic.select')}}--</option>
{{--                    @foreach ($allCostCenters as $costCenter)--}}
{{--                        <option value="{{ $costCenter['office_id'] }}">{{ $costCenter['office']['office_name_eng'] }}</option>--}}
{{--                    @endforeach--}}
                </select>
            </td>
{{--            <td class="selected_nominated_office_data_{{$team_layer_id}}">--}}
{{--                <select id="branch_name_select_{{$team_layer_id}}_0" class="form-control input-branch-name"--}}
{{--                        data-id="{{$team_layer_id}}_0">--}}
{{--                    <option value=''>--{{___('generic.select')}}--</option>--}}
{{--                </select>--}}
{{--            </td>--}}
            <td>
                <div class="row">
                    <div class="col pr-0">
                        <input style="padding: 5px" type="text" data-id="{{$team_layer_id}}_0"
                               class="date form-control input-start-duration"
                               placeholder="শুরু"/>
                    </div>
                    <div class="col pl-0">
                        <input style="padding: 5px" type="text" data-id="{{$team_layer_id}}_0"
                               class="date form-control input-end-duration"
                               placeholder="শেষ"/>
                    </div>
                </div>
            </td>

            <td>
                <input style="padding: 5px" type="number" data-id="{{$team_layer_id}}_0" value="0"
                       class="form-control input-total-working-day"
                       min="0"
                       id="input_total_working_day_{{$team_layer_id}}_0"/>
            </td>
            <td>
                <div style="display: flex">
                    <button type="button" title="সিডিউল" onclick="addAuditScheduleTblRow({{$team_layer_id}},1)"
                            class="btn btn-icon btn-outline-success border-0 btn-xs mr-2">
                        <span class="fad fa-calendar-day"></span>
                    </button>

                    <button type="button" title="ট্রানজিট"
                            onclick="addDetailsTblRow({{$team_layer_id}},1)"
                            class="btn btn-icon btn-outline-warning border-0 btn-xs mr-2">
                        <span class="fad fa-plus"></span>
                    </button>

                    <button type='button' title="বাদ দিন"
                            data-row='row1'
                            onclick="removeScheduleRow($(this), {{$team_layer_id}},'schedule')"
                            class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2'>
                        <span class='fal fa-trash-alt'></span>
                    </button>
                </div>
            </td>
        </tr>
        </tbody>

        <tbody class="sequence_tbody_{{$team_layer_id}}" id="schedule_tbody_{{$team_layer_id}}_2" data-tbody-id="{{$team_layer_id}}_2" data-schedule-type="visit">
        <tr class="audit_schedule_row_{{$team_layer_id}}" data-layer-id="{{$team_layer_id}}"
            data-schedule-second-row='1_{{$team_layer_id}}'>
            <td colspan="1">
                <input placeholder="ট্রানজিট" type="text" data-id="{{$team_layer_id}}_0" class="form-control input-detail"/>
            </td>
            <td colspan="2">
                <input placeholder="ট্রানজিটের তারিখ" type="text" data-id="{{$team_layer_id}}_0" class="date form-control input-detail-duration"/>
                <span class="fal fa-calendar field-icon"></span>
            </td>
            <td>
                <div style="display: flex">
                    <button type="button" title="সিডিউল"
                            onclick="addAuditScheduleTblRow({{$team_layer_id}},2)"
                            class="btn btn-icon btn-outline-success border-0 btn-xs mr-2">
                        <span class="fad fa-calendar-day"></span>
                    </button>

                    <button type="button" title="ট্রানজিট"
                            onclick="addDetailsTblRow({{$team_layer_id}},2)"
                            class="btn btn-icon btn-outline-warning border-0 btn-xs mr-2">
                        <span class="fad fa-plus"></span>
                    </button>

                    <button type='button' title="বাদ দিন"
                            data-row='row1'
                            onclick="removeScheduleRow($(this), {{$team_layer_id}},'visit')"
                            class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2'>
                        <span class='fal fa-trash-alt'></span>
                    </button>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<script>
    $(document).on('change', '.audit_schedule_row_{{$team_layer_id}} input', function () {
        populateData(this);
    });

    $('.input-branch-name').select2({
        ajax: {
            url: '{{route('audit.plan.audit.editor.get-entity-wise-cos-center-autocomplete')}}',
            method: 'post',
            delay: 3000,
            dataType: 'json',
            data: function (params) {
                project_id = '{{$project_id}}'
                layer_row = $(this).attr('data-id');
                parent_office_id = $('#entity_name_select_'+layer_row).val();
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
                        more: (params.page * 50) < data.data_count
                    }
                };
            },
        },
        // minimumInputLength: 5,
    });

    // $(".input-entity-name").change(function () {
    //     parent_office_id = $(this).val();
    //     ministry_id = $(this).children('option:selected').data('ministry-id');
    //     layer_row = $(this).attr('data-id');
    //     layer_row = layer_row.split("_");
    //
    //     layer_id = layer_row[0];
    //     row = layer_row[1];
    //
    //     loadSelectNominatedOffices(parent_office_id, layer_id, row, ministry_id);
    // });
    $('.select-select2').select2({width: '100%'});
</script>


