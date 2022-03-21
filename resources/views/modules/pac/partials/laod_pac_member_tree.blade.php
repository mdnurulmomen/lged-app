<div class="rounded-0" id="pacMemberTree"
     style="overflow-y: scroll; height: 60vh">
    <ul>
        @foreach($pac_users as $key => $pac_user)
                        <li data-officer-info="{{json_encode(
    [
        'pac_member_id' =>  htmlspecialchars($pac_user['id']),
        'pac_member_name' =>  htmlspecialchars($pac_user['user_real_name']),
        'pac_member_email' =>  htmlspecialchars($pac_user['email']),
        'pac_member_phone' => htmlspecialchars($pac_user['phone']),
        'pac_member_designation' => htmlspecialchars($pac_user['designation']),
        'pac_member_unit_name' => htmlspecialchars($pac_user['unit_name']),
        ], JSON_UNESCAPED_UNICODE)}}"
                            data-jstree='{ "icon" : "fas fa-user text-warning" }'>
                            <small>{{$pac_user['user_real_name']}}</small>
                        </li>
        @endforeach
    </ul>
</div>

<script>
    $('#pacMemberTree').jstree({
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

    $('#pacMemberTree').on('select_node.jstree', function (e, data) {
        var officer_info = $('#' + data.node.id).data('officer-info');

        selected_member = {
            'pac_member_id': officer_info.pac_member_id,
            'pac_member_name': officer_info.pac_member_name,
            'pac_member_email': officer_info.pac_member_email,
            'pac_member_phone': officer_info.pac_member_phone,
            'pac_member_designation': officer_info.pac_member_designation,
            'pac_member_unit_name': officer_info.pac_member_unit_name,
        };


        var newRow = '<li id="selected_pac_member_li_' + officer_info.pac_member_id + '"  style="border: 1px solid #ebf3f2;list-style: none;margin: 5px;padding-left: 4px;cursor: move;" draggable="true" ondragend="dragEnd()" ondragover="dragOver(event)" ondragstart="dragStart(event)">' +
            '<span id="remove_pac_member_'+officer_info.pac_member_id + '" data-member-id="'+ officer_info.pac_member_id + '" onclick="Qac_Committee_Container.removeMember('+ officer_info.pac_member_id + ',0)" style="cursor:pointer;color:red;"><i class="fas fa-trash-alt text-danger pr-2"></i></span>' +
            '<span>'+ officer_info.pac_member_name +'<span/>' +
            '<input class="selected_pac_member" id="selected_pac_member_'+ officer_info.pac_member_id + '"  type="hidden"/>' +
            '</li>';

        let select_member =  $(".select_pac_member");
        select_member.append(newRow);
        select_member.find('#selected_pac_member_' + officer_info.pac_member_id).val(JSON.stringify(selected_member));

    }).on('deselect_node.jstree', function (e, data) {
        var officer_info = $('#' + data.node.id).data('officer-info');
        $('#selected_pac_member_li_' + officer_info.pac_member_id).remove();
    });
</script>
