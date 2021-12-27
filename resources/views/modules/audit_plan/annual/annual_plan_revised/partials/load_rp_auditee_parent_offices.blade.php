{{--<div class="row">--}}
{{--    <div class="col-md-12">--}}
{{--        @if(count($rp_offices) > 0 && array_key_exists('offices', $rp_offices))--}}
{{--            <div id="rp_auditee_parent_offices"--}}
{{--                 style="overflow-y: scroll; height: 60vh">--}}
{{--                <ul>--}}
{{--                    @foreach($rp_offices['offices'] as $rp_office)--}}
{{--                        @foreach($rp_office_list['rp_offices'] as $rp_office)--}}
{{--                            <li data-rp-auditee-ministry-id="{{$rp_office['office_ministry_id']}}" data-rp-auditee-layer-id="{{$rp_office['office_layer_id']}}" data-rp-auditee-entity-id="{{$rp_office['id']}}" data-entity-info="{{json_encode(--}}
{{--    [--}}
{{--        'entity_id' => $rp_office['id'],--}}
{{--        'entity_name_en' =>  htmlspecialchars($rp_office['office_name_en']),--}}
{{--        'entity_name_bn' =>  htmlspecialchars($rp_office['office_name_bn']),--}}
{{--        'child_count' =>  $rp_office['child_count'],--}}
{{--        ], JSON_UNESCAPED_UNICODE)}}" data-jstree='{ "type" : "default" }'>--}}
{{--                                {{$rp_office['office_name_bn']}}--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        @else--}}
{{--            <div><p>No Data Found</p></div>--}}
{{--        @endif--}}
{{--    </div>--}}
{{--</div>--}}


{{--<script>--}}
{{--    $(document).ready(function () {--}}
{{--        $(`#rp_auditee_parent_offices`).jstree({--}}
{{--            "core": {--}}
{{--                "themes": {--}}
{{--                    "responsive": true--}}
{{--                },--}}
{{--                "check_callback": true,--}}
{{--            },--}}
{{--            "types": {--}}
{{--                "default": {--}}
{{--                    "icon": "fal fa-building text-warning"--}}
{{--                }--}}
{{--            },--}}
{{--            "plugins": ["types", "checkbox",]--}}
{{--        });--}}
{{--    })--}}

{{--    $('#rp_auditee_parent_offices').on('select_node.jstree', function (e, data) {--}}
{{--        entity_info = $('#' + data.node.id).data('entity-info');--}}
{{--        Annual_Plan_Container.addSelectedRPAuditeeList(entity_info, data.node.id, true);--}}
{{--    }).on('deselect_node.jstree', function (e, data) {--}}
{{--        entity_info = $('#' + data.node.id).data('entity-info');--}}
{{--        Annual_Plan_Container.removeSelectedEntity(entity_info.entity_id,data.node.id);--}}
{{--    }).on('open_node.jstree', function (e, data) {--}}
{{--        parent_node = data.node.id;--}}
{{--        Annual_Plan_Container.loadRPChildOffices(parent_node, '#rp_auditee_parent_offices');--}}
{{--    }).on('close_node.jstree', function (e, data) {--}}
{{--        $('#' + data.node.id + ' ul').remove()--}}
{{--        $('#rp_auditee_parent_offices').jstree('refresh')--}}
{{--    });--}}
{{--</script>--}}

<div class="row">
    <div class="col-md-12">

        @if(count($rp_offices) > 0)
            <input id="entity_search" type="text" class="form-control mb-1"
                   placeholder="এনটিটি/সংস্থা খুঁজুন">
            <div id="rp_auditee_parent_offices" style="overflow-y: scroll; height: 60vh">
                <ul>
                    @foreach($rp_offices['offices'] as $rp_office)
                        <li data-office-id="{{$rp_office['id']}}" data-rp-auditee-ministry-id="{{$rp_office['office_ministry_id']}}" data-rp-auditee-entity-id="{{$rp_office['id']}}" data-entity-info="{{json_encode(
    [
        'entity_id' => $rp_office['id'],
        'entity_name_en' =>  htmlspecialchars($rp_office['office_name_en']),
        'entity_name_bn' =>  htmlspecialchars($rp_office['office_name_bn']),
        'child_count' =>  $rp_office['child_count'],
        ], JSON_UNESCAPED_UNICODE)}}" data-jstree='{ "type" : "default" }'>
                            {{$rp_office['office_name_bn']}}
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
            "search": {
                "show_only_matches": true,
                "show_only_matches_children": true,
                "case_insensitive": true,
            },
            "plugins": ["types", "checkbox", "search"]
        }).bind('search.jstree', function (nodes, str, res) {
            if (str.nodes.length === 0) {
                $('#rp_auditee_parent_offices').jstree(true).hide_all();
            }
        });
    })

    $('#rp_auditee_parent_offices').on('select_node.jstree', function (e, data) {
        entity_info = $('#' + data.node.id).data('entity-info');
        Annual_Plan_Container.addSelectedRPAuditeeList(entity_info, data.node.id, true);
    }).on('deselect_node.jstree', function (e, data) {
        entity_info = $('#' + data.node.id).data('entity-info');
        Annual_Plan_Container.removeSelectedEntity(entity_info.entity_id, data.node.id);
    }).on('open_node.jstree', function (e, data) {
        parent_node = data.node.id;
        Annual_Plan_Container.loadRPChildOffices(parent_node, '#rp_auditee_parent_offices');
    }).on('close_node.jstree', function (e, data) {
        $('#' + data.node.id + ' ul').remove()
        $('#rp_auditee_parent_offices').jstree('refresh')
    });

    $('#entity_search').keyup(function () {
        $('#rp_auditee_parent_offices').jstree(true).show_all();
        $('#rp_auditee_parent_offices').jstree('search', $(this).val());
    });
</script>
