<ul>
    @foreach($rp_offices as $rp_office)
        <li data-rp-auditee-entity-id="{{$rp_office['id']}}" data-entity-info="{{json_encode(
    [
        'entity_id' => $rp_office['id'],
        'entity_name_en' => $rp_office['office_name_en'],
        'entity_name_bn' => $rp_office['office_name_bn'],
        'controlling_office_id' => $controlling_office_id,
        'controlling_office_name_bn' => $controlling_office_name_bn,
        'controlling_office_name_en' => $controlling_office_name_en,
        ], JSON_UNESCAPED_UNICODE)}}" data-jstree='{ "opened" : true }'>
            {{$rp_office['office_name_bn']}}
            @if(count($rp_office['child']) > 0)
                @include('modules.audit_plan.annual.annual_plan_revised.partials.load_rp_auditee_offices_child',
 [
        'controlling_office_id' => $controlling_office_id,
        'controlling_office_name_bn' => $controlling_office_name_bn,
        'controlling_office_name_en' => $controlling_office_name_en,
         'rp_offices' => $rp_office['child']
     ])
            @endif

        </li>
    @endforeach
</ul>


<script>
    $(document).ready(function () {
        $(`#rp_auditee_parent_offices`).jstree({
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

    $('#rp_auditee_parent_offices').on('select_node.jstree', function (e, data) {
        entity_info = $('#' + data.node.id).attr('data-entity-info');
        Annual_Plan_Container.addSelectedRPAuditeeList(entity_info, data.node.id, false);
    }).on('deselect_node.jstree', function (e, data) {
        entity_info = $('#' + data.node.id).data('entity-info');
        Annual_Plan_Container.removeSelectedEntity(entity_info.entity_id,data.node.id);
    }).on('open_node.jstree', function (e, data) {
        parent_node = data.node.id;
        Annual_Plan_Container.loadRPChildOffices(parent_node, '#rp_auditee_parent_offices');
    }).on('close_node.jstree', function (e, data) {
        $('#' + data.node.id + ' ul').remove()
        $('#rp_auditee_parent_offices').jstree('refresh')
    });
</script>
