<div class="row">
    <div class="col-md-12">
        @if(count($rp_offices) > 0)
            <input id="entity_search" type="text" class="form-control mb-1"
                   placeholder="এনটিটি/সংস্থা খুঁজুন">
            <div id="rp_auditee_parent_offices" style="overflow-y: scroll; height: 60vh">
                <ul>
                    @foreach($rp_offices as $rp_office)
                        <li data-office-id="{{$rp_office['entity_id']}}" data-rp-auditee-ministry-id="{{$rp_office['ministry_id']}}" data-rp-auditee-entity-id="{{$rp_office['entity_id']}}" data-entity-info="{{json_encode(
    [
        'entity_id' => $rp_office['entity_id'],
        'entity_name_en' =>  htmlspecialchars($rp_office['entity_name_bn']),
        'entity_name_bn' =>  htmlspecialchars($rp_office['entity_name_en']),
        'child_count' =>  0,
        ], JSON_UNESCAPED_UNICODE)}}" data-jstree='{ "type" : "default" }'>
                            {{$rp_office['entity_name_bn']}}
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

    $('input[type=radio][name=assessment]').on('change', function() {
        if($(this).val() == 'with_assessment'){
            parent_ministry_id =  $('#parent_ministry_id').val();
            office_category_type =  $('#office_category_type_select').val();
            activity_id =  $('#activity_id').val();
            Annual_Plan_Container.loadAssessmentEntity(parent_ministry_id,office_category_type,activity_id);
        }else{
            parent_ministry_id =  $('#parent_ministry_id').val();
            $('#parent_ministry_id').val(parent_ministry_id).trigger('change');
        }
    });
</script>
