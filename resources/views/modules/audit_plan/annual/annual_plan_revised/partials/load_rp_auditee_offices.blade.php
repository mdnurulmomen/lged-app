<div class="row">
    <div class="col-md-12">
        @if(count($rp_offices)> 0)
            <div class="tree-demo rounded-0 rp_auditee_offices jstree-init jstree-1 jstree-default"
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
        ], JSON_UNESCAPED_UNICODE)}}" data-jstree='{ "opened" : true }'>
                                {{$rp_office['office_name_bn']}}
{{--                                @if(count($rp_office['child']) > 0)--}}
{{--                                    @include('modules.audit_plan.annual.annual_plan_revised.partials.load_rp_auditee_offices_child',--}}
{{--    [--}}
{{--        'entity_parent_id' => $rp_office['id'],--}}
{{--        'entity_parent_name_en' => $rp_office['office_name_en'],--}}
{{--        'entity_parent_name_bn' => $rp_office['office_name_bn'],--}}
{{--        'controlling_office_id' => $rp_office_list['controlling_office_id'],--}}
{{--        'controlling_office_name_bn' => htmlspecialchars($rp_office_list['controlling_office_name_bn']),--}}
{{--        'controlling_office_name_en' => htmlspecialchars($rp_office_list['controlling_office_name_en']),--}}
{{--        'ministry_id' => $rp_offices['office_ministry']['id'],--}}
{{--        'ministry_name_en' => htmlspecialchars($rp_offices['office_ministry']['name_eng']),--}}
{{--        'ministry_name_bn' => htmlspecialchars($rp_offices['office_ministry']['name_bng']),--}}
{{--        'rp_offices' => $rp_office['child']--}}
{{--        ])--}}
{{--                                @endif--}}
{{--                            </li>--}}
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
        Annual_Plan_Container.jsTreeInit('rp_auditee_offices');
        $('.rp_auditee_offices').jstree(true).refresh();

        selected_entities = $('#selected_rp_auditee_form').data('party-ids');
        selected_entities.map((party_id) => {
            id = $('li[data-rp-auditee-entity-id=' + party_id + ']')[0].id
            $(".rp_auditee_offices").jstree("select_node", "#" + id + "");
        })
    })

    $('.rp_auditee_offices').on('select_node.jstree', function (e, data) {
        var entity_info = $('#' + data.node.id).data('entity-info');
        //console.log(entity_info)
        Annual_Plan_Container.addSelectedRPAuditeeList(entity_info);

        data.node.children.map(child => {
            var entity_info = $('#' + child).data('entity-info')
            Annual_Plan_Container.addSelectedRPAuditeeList(entity_info)
        })
        /*if (data.node.children.length === 0) {
            var entity_info = $('#' + data.node.id).data('entity-info')
            Annual_Plan_Container.addSelectedRPAuditeeList(entity_info)
        } else {
            data.node.children.map(child => {
                var entity_info = $('#' + child).data('entity-info')
                Annual_Plan_Container.addSelectedRPAuditeeList(entity_info)
            })
        }*/
    }).on('deselect_node.jstree', function (e, data) {
        var entity_info = $('#' + data.node.id).data('entity-info');
        Annual_Plan_Container.removeSelectedRPAuditee(entity_info.entity_id);
        data.node.children.map(child => {
            var entity_info = $('#' + child).data('entity-info');
            Annual_Plan_Container.removeSelectedRPAuditee(entity_info.entity_id);
        })

        /*if (data.node.children.length === 0) {
            var entity_info = $('#' + data.node.id).data('entity-info');
            Annual_Plan_Container.removeSelectedRPAuditee(entity_info.entity_id);
        } else {
            data.node.children.map(child => {
                var entity_info = $('#' + child).data('entity-info');
                Annual_Plan_Container.removeSelectedRPAuditee(entity_info.entity_id);
            })
        }*/
    });
</script>
