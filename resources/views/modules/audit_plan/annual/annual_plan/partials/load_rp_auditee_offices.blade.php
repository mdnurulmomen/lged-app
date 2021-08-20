<div class="row">
    <div class="col-md-12">
        <div class="tree-demo rounded-0 rp_auditee_offices jstree-init jstree-1 jstree-default"
             style="overflow-y: scroll; height: 60vh">
            <ul>
                <li>
                    Entities
                    <ul>
                        <li data-rp-auditee-entity-id="1" data-entity-info="{{json_encode(
    [
        'entity_id' => '1',
        'entity_name_en' => 'Ministry of Power, Energy and Mineral Resources',
        'entity_name_bn' => 'Ministry of Power, Energy and Mineral Resources',
        'ministry_id' => '1',
        'ministry_name_en' => 'Ministry En',
        'ministry_name_bn' => 'Ministry Bn',
        ])}}" data-jstree='{ "opened" : true }'>
                            Ministry of Power, Energy and Mineral Resources
                        </li>
                        <li data-rp-auditee-entity-id="2" data-entity-info="{{json_encode(
    [
        'entity_id' => '2',
        'entity_name_en' => 'Ministry of Finance',
        'entity_name_bn' => 'Ministry of Finance',
        'ministry_id' => '1',
        'ministry_name_en' => 'Ministry En',
        'ministry_name_bn' => 'Ministry Bn',
        ])}}" data-jstree='{ "opened" : true }'>
                            Ministry of Finance
                        </li>
                        <li data-rp-auditee-entity-id="3" data-entity-info="{{json_encode(
    [
        'entity_id' => '3',
        'entity_name_en' => 'Ministry of Home Affairs',
        'entity_name_bn' => 'Ministry of Home Affairs',
        'ministry_id' => '1',
        'ministry_name_en' => 'Ministry En',
        'ministry_name_bn' => 'Ministry Bn',
        ])}}" data-jstree='{ "opened" : true }'>
                            Ministry of Home Affairs
                        </li>
                        <li data-rp-auditee-entity-id="4" data-entity-info="{{json_encode(
    [
        'entity_id' => '4',
        'entity_name_en' => 'Ministry of Land',
        'entity_name_bn' => 'Ministry of Land',
        'ministry_id' => '1',
        'ministry_name_en' => 'Ministry En',
        'ministry_name_bn' => 'Ministry Bn',
        ])}}" data-jstree='{ "opened" : true }'>
                            Ministry of Land
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
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
        if (data.node.children.length === 0) {
            var entity_info = $('#' + data.node.id).data('entity-info')
            Annual_Plan_Container.addSelectedRPAuditeeList(entity_info)
        } else {
            data.node.children.map(child => {
                var entity_info = $('#' + child).data('entity-info')
                Annual_Plan_Container.addSelectedRPAuditeeList(entity_info)
            })
        }
        $('#save_selected_entities_btn').removeClass('d-none');
    }).on('deselect_node.jstree', function (e, data) {
        if (data.node.children.length === 0) {
            var entity_info = $('#' + data.node.id).data('entity-info')
            $("#selected_rp_auditee_form #btn_remove_auditee_" + entity_info.entity_id).click();
        } else {
            data.node.children.map(child => {
                var entity_info = $('#' + child).data('entity-info')
                $("#selected_rp_auditee_form #btn_remove_auditee_" + entity_info.entity_id).click();
            })
        }
    });
</script>
