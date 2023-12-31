<div class="row">
    <div class="col-md-12">
        @if(count($rp_offices) > 0 && array_key_exists('office', $rp_offices))
            <div id="rp_auditee_offices" style="overflow-y: scroll; height: 60vh">
                <ul>
                    @foreach($rp_offices['office'] as $rp_office_list)
                        @foreach($rp_office_list['rp_offices'] as $rp_office)
                            <li data-rp-auditee-entity-id="{{$rp_office['id']}}" data-entity-info="{{json_encode(
    [
        'entity_id' => $rp_office['id'],
        'entity_name_en' =>  htmlspecialchars($rp_office['office_name_en']),
        'entity_name_bn' =>  htmlspecialchars($rp_office['office_name_bn']),
        'office_type' => htmlspecialchars($rp_office['office_type']),
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
            entity_info = $('#' + child).data('entity-info');
            Annual_Plan_Container.removeSelectedRPAuditee(entity_info.entity_id);
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
