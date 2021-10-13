<div class="row">
    <div class="col-md-12">
        @if(count($rp_offices) > 0 && array_key_exists('offices', $rp_offices))
            <div id="rp_auditee_offices"
                 style="overflow-y: scroll; height: 60vh">
                <ul>
                    @foreach($rp_offices['offices'] as $rp_office_list)
                        @foreach($rp_office_list['rp_offices'] as $rp_office)
                            <li data-rp-auditee-entity-id="{{$rp_office['id']}}" data-entity-info="{{json_encode(
    [
        'entity_parent_id' => $rp_office['id'],
        'entity_parent_name_en' => $rp_office['office_name_en'],
        'entity_parent_name_bn' => $rp_office['office_name_bn'],
        'entity_id' => $rp_office['id'],
        'entity_name_en' =>  htmlspecialchars($rp_office['office_name_en']),
        'entity_name_bn' =>  htmlspecialchars($rp_office['office_name_bn']),
        'ministry_id' => $rp_offices['office_ministry']['id'],
        'ministry_name_en' => htmlspecialchars($rp_offices['office_ministry']['name_eng']),
        'ministry_name_bn' => htmlspecialchars($rp_offices['office_ministry']['name_bng']),
        'controlling_office_id' => $rp_office_list['controlling_office_id'],
        'controlling_office_name_bn' => htmlspecialchars($rp_office_list['controlling_office_name_bn']),
        'controlling_office_name_en' => htmlspecialchars($rp_office_list['controlling_office_name_en']),
        ], JSON_UNESCAPED_UNICODE)}}" data-jstree='{ "type" : "default" }'>
                                {{$rp_office['office_name_bn']}}
                                @if($rp_office['has_child'])
                                    <ul>
                                        <li data-jstree='{"opened" : false}'>&nbsp;</li>
                                    </ul>
                                @endif
                            </li>
                        @endforeach
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
            "plugins": ["types", "checkbox",]
        });
    })

    $('#rp_auditee_offices').on('select_node.jstree', function (e, data) {
        entity_info = $('#' + data.node.id).data('entity-info');
        Annual_Plan_Container.addSelectedRPAuditeeList(entity_info);
        data.node.children.map(child => {
            entity_info = $('#' + child).data('entity-info')
            Annual_Plan_Container.addSelectedRPAuditeeList(entity_info)
        })
    }).on('deselect_node.jstree', function (e, data) {
        entity_info = $('#' + data.node.id).data('entity-info');
        Annual_Plan_Container.removeSelectedRPAuditee(entity_info.entity_id);
        data.node.children.map(child => {
            entity_info = $('#' + child).data('entity-info');
            Annual_Plan_Container.removeSelectedRPAuditee(entity_info.entity_id);
        })
    }).on('open_node.jstree', function (e, data) {
        parent_node = data.node.id;
        Annual_Plan_Container.loadRPChildOffices(parent_node);
    }).on('close_node.jstree', function (e, data) {
        $('#' + data.node.id + ' ul').remove()
        $('#rp_auditee_offices').jstree('refresh')
    });
</script>
