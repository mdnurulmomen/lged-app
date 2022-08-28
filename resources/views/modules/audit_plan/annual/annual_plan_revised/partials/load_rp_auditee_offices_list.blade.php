<div class="row">
    <div class="col-md-12">
        @if(count($rp_offices) > 0)
            <input id="unit_search" type="text" class="form-control mb-1"
                   placeholder="কস্ট সেন্টার/ইউনিট খুঁজুন">
            <div id="rp_auditee_offices" style="overflow-y: scroll; height: 60vh">
                <ul>
                    @foreach($rp_offices as $rp_office)
                        <li data-office-id="{{$rp_office['id']}}" data-rp-auditee-entity-id="{{$entity_id}}" data-entity-info="{{json_encode(
    [
        'office_id' => $rp_office['id'],
        'office_structure_type' => $rp_office['office_structure_type'],
        'office_name_en' =>  htmlspecialchars($rp_office['office_name_en']),
        'office_name_bn' =>  htmlspecialchars($rp_office['office_name_bn']),
        'entity_id' => $entity_id,
        'entity_name_en' =>  htmlspecialchars($entity_name_en),
        'entity_name_bn' =>  htmlspecialchars($entity_name_bn),
        'entity_count' => count($rp_offices),
        ], JSON_UNESCAPED_UNICODE)}}" data-jstree='{ "type" : "default" , "checkbox_disabled" : @if($rp_office['office_structure_type'] == 'unit_group') true @else false @endif}'>
                            {{$rp_office['office_name_bn']}}

                            @if($rp_office['office_structure_type'] == 'unit_group')
                                <span class="badge badge-info text-uppercase m-1 p-1 ">
                                    ইউনিট গ্রুপ</span>
                            @endif
                            @if($rp_office['has_child'])
                                <ul>
                                    <li data-jstree='{"opened" : false}'>&nbsp;</li>
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <div><p>No Data Found</p></div>
        @endif
    </div>
</div>


<script>
    $(document).ready(function () {
        $(`#rp_auditee_offices`).jstree({
            "core": {
                "themes": {
                    "responsive": true
                },
                "check_callback": true,
            },
            "types": {
                "default": {
                    "icon": "fal fa-building text-warning"
                }
            },
            "plugins": ["types", "checkbox", "search"],
            "search": {
                "show_only_matches": true,
                "show_only_matches_children": true,
                "case_insensitive": true,
            },
        }).bind('search.jstree', function (nodes, str, res) {
            if (str.nodes.length === 0) {
                $('#rp_auditee_offices').jstree(true).hide_all();
            }
        });
    })

    $('#unit_search').keyup(function () {
        $('#rp_auditee_offices').jstree(true).show_all();
        $('#rp_auditee_offices').jstree('search', $(this).val());
    });

    $('#rp_auditee_offices').on('select_node.jstree', function (e, data) {
        entity_info = $('#' + data.node.id).data('entity-info');
        if(entity_info.office_structure_type != 'unit_group'){
            Annual_Plan_Container.addSelectedRPAuditeeList(entity_info);
            data.node.children.map(child => {
                entity_info = $('#' + child).data('entity-info');
                Annual_Plan_Container.removeSelectedRPAuditee(entity_info.entity_id);
            });
        }
        $('#total_selected_unit_no').val($('.selected_entity_sr').length);
    }).on('deselect_node.jstree', function (e, data) {
        entity_info = $('#' + data.node.id).data('entity-info');
        Annual_Plan_Container.removeSelectedRPAuditee(entity_info.office_id);
        data.node.children.map(child => {
            entity_info = $('#' + child).data('entity-info');
            Annual_Plan_Container.removeSelectedRPAuditee(entity_info.entity_id);
        })
        $('#total_selected_unit_no').val($('.selected_entity_sr').length);
    }).on('open_node.jstree', function (e, data) {
        parent_node = data.node.id;
        Annual_Plan_Container.loadRPChildOffices(parent_node);
    }).on('close_node.jstree', function (e, data) {
        $('#' + data.node.id + ' ul').remove()
        $('#rp_auditee_offices').jstree('refresh')
    });

    count = '{{count($rp_offices)}}';
</script>
