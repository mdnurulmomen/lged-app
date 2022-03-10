<div class="rounded-0" id="officeMemberTree"
     style="overflow-y: scroll; height: 60vh">
    <ul>
        @foreach($officer_lists as $key => $officer_list)
            @foreach($officer_list['units'] as $unit)
                @foreach($unit['designations'] as $designation)
                    @if(!empty($designation['employee_info']))
                        <li data-officer-info="{{json_encode(
    [
        'designation_id' =>  htmlspecialchars($designation['designation_id']),
        'designation_en' =>  htmlspecialchars($designation['designation_eng']),
        'designation_bn' => htmlspecialchars($designation['designation_bng']),
        'officer_name_en' =>  htmlspecialchars($designation['employee_info']['name_eng']),
        'officer_name_bn' =>  htmlspecialchars($designation['employee_info']['name_bng']),
        'officer_mobile' =>  htmlspecialchars($designation['employee_info']['personal_mobile']),
        'officer_email' =>  htmlspecialchars($designation['employee_info']['personal_email']),
        'employee_grade' => !empty($designation['employee_info']['employee_grade']) ? $designation['employee_info']['employee_grade'] : '1',
        'officer_id' =>  htmlspecialchars($designation['employee_info']['id']),
        'unit_id' => $unit['office_unit_id'],
        'unit_name_en' => htmlspecialchars($unit['unit_name_eng']),
        'unit_name_bn' => htmlspecialchars($unit['unit_name_bng']),
        'office_id' => $officer_list['office_id'],
        ], JSON_UNESCAPED_UNICODE)}}"
                            data-jstree='{ "icon" : "{{!empty($designation['employee_info']) ? "fas": "fal"}} fa-user text-warning" }'>
                            {{!empty($designation['employee_info']) ? $designation['employee_info']['name_bng'] : ''}}
                            <small>{{$designation['designation_bng']}}</small>
                        </li>
                    @endif
                @endforeach
            @endforeach
        @endforeach
    </ul>
</div>

<script>
    $('#officeMemberTree').jstree({
        "core": {
            "check_callback": true,
        },
        "types": {
            "default": {
                "icon": "fal fa-user"
            },
        },
        "plugins": ["types", "checkbox", "search"]
    });

    $('#officeMemberTree').on('select_node.jstree', function (e, data) {
        var officer_info = $('#' + data.node.id).data('officer-info');

        selected_member = {
            'officer_id': officer_info.officer_id,
            'officer_bn': officer_info.officer_name_bn,
            'officer_en': officer_info.officer_name_en,
            'officer_unit_id': officer_info.unit_id,
            'officer_unit_bn': officer_info.unit_name_bn,
            'officer_unit_en': officer_info.unit_name_en,
            'officer_designation_grade': 0,
            'officer_designation_id': officer_info.designation_id,
            'officer_designation_en': officer_info.designation_en,
            'officer_designation_bn': officer_info.designation_bn,
        };


        var newRow = '<li id="selected_member_li_' + officer_info.officer_id + '"  style="border: 1px solid #ebf3f2;list-style: none;margin: 5px;padding-left: 4px;cursor: move;" draggable="true" ondragend="dragEnd()" ondragover="dragOver(event)" ondragstart="dragStart(event)">' +
            '<span id="remove_member_'+officer_info.officer_id + '" data-member-id="'+ officer_info.officer_id + '" onclick="Qac_Committee_Container.removeMember('+ officer_info.officer_id + ',0)" style="cursor:pointer;color:red;"><i class="fas fa-trash-alt text-danger pr-2"></i></span>' +
            '<span>'+ officer_info.officer_name_bn +'<span/>' +
            '<input class="selected_member" id="selected_member_'+ officer_info.officer_id + '"  type="hidden"/>' +
            '</li>';

        let select_member =  $(".select_member");
        select_member.append(newRow);
        select_member.find('#selected_member_' + officer_info.officer_id).val(JSON.stringify(selected_member));

    }).on('deselect_node.jstree', function (e, data) {
        var officer_info = $('#' + data.node.id).data('officer-info');
        $('#selected_member_li_' + officer_info.officer_id).remove();
    });
</script>
