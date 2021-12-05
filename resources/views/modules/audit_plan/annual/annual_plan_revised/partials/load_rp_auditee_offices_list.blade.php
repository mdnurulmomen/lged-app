<div class="row">
    <div class="col-md-12">
        @if(count($rp_offices) > 0)
            <div id="rp_auditee_offices" style="overflow-y: scroll; height: 60vh">
                <ul>
                    @foreach($rp_offices as $rp_office)
                        <li data-rp-auditee-entity-id="{{$entity_id}}" data-entity-info="{{json_encode(
    [
        'office_id' => $rp_office['id'],
        'office_name_en' =>  htmlspecialchars($rp_office['office_name_en']),
        'office_name_bn' =>  htmlspecialchars($rp_office['office_name_bn']),
        'entity_id' => $entity_id,
        'entity_name_en' =>  htmlspecialchars($entity_name_en),
        'entity_name_bn' =>  htmlspecialchars($entity_name_bn),
        'entity_count' => count($rp_offices),
        ], JSON_UNESCAPED_UNICODE)}}" data-jstree='{ "type" : "default" }'>
                            {{$rp_office['office_name_bn']}}
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
            "plugins": ["types", "checkbox",]
        });
    })

    $('#rp_auditee_offices').on('select_node.jstree', function (e, data) {
        entity_info = $('#' + data.node.id).data('entity-info');
        console.log(entity_info);
        Annual_Plan_Container.addSelectedRPAuditeeList(entity_info);
        data.node.children.map(child => {
            entity_info = $('#' + child).data('entity-info');
            Annual_Plan_Container.removeSelectedRPAuditee(entity_info.entity_id);
        })
        $('#total_selected_unit_no').val($('.selected_entity_sr').length);
    }).on('deselect_node.jstree', function (e, data) {
        entity_info = $('#' + data.node.id).data('entity-info');
        Annual_Plan_Container.removeSelectedRPAuditee(entity_info.entity_id);
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

    // if ($('#total_unit').val()) {
    //     total_count = parseInt($('#total_unit').val()) + parseInt(count);
    //     $('#total_unit_no').val(total_count).prop('readonly', true);
    //     $('#total_unit').val(total_count);
    //
    // } else {
    //     $('#total_unit').val(count);
    //     $('#total_unit_no').val(count).prop('readonly', true);
    // }
</script>
