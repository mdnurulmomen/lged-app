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

<script>
    $('.own_office_organogram_tree').jstree({
        'plugins': ["checkbox", "types", "search", "dnd"],
        'core': {
            check_callback: true,
            "themes": {
                "responsive": false
            },
        },
        'dnd': {
            "copy": true,
            // "always_copy": true,
        },
        'checkbox': {
            three_state: false, // to avoid that fact that checking a node also check others
            whole_node: false, // to avoid checking the box just clicking the node
            tie_selection: false // for checking without selecting and selecting without checking
        },
        "search": {
            "show_only_matches": true,
            "show_only_matches_children": true
        },
    });
</script>
