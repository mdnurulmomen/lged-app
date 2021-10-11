<!--begin::Table-->
<div class="row">
    <div class="col-md-12 officers_list_area">
        <h5>{{$office_order['office_order_movement'] != null?$office_order['office_order_movement']['employee_name_bn'].' ('.$office_order['office_order_movement']['employee_designation_bn'].') কাছে প্রেরিত হয়েছে।':''}}</h5>
        <div class="rounded-0" id="approvalAuthorityTree"
             style="overflow-y: scroll; height: 60vh">
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
        </div>

        <div class="text-left mt-5">
            <a tabindex="0" href="javascript:;" role="button" onclick="Office_Order_Container.saveOfficeOrderApprovalAuthority()" class="btn btn-primary btn-sm btn-square btn-forward" id="onucched_forward"><i class="fa fa-paper-plane"></i>প্রেরণ করুন</a>
        </div>
    </div>


    <form class="d-none" id="approval_authority_form">
        <ul class="select_approval_authority"></ul>
    </form>

</div>
<!--end::Table-->

<script>
    $('#approvalAuthorityTree').jstree({
        "core": {
            "check_callback": true,
        },
        "types": {
            "default": {
                "icon": "fal fa-user"
            },
        },
        "plugins": ["search", "types"]
    });

    $('#approvalAuthorityTree').on('select_node.jstree', function (e, data) {
        var officer_info = $('#' + data.node.id).data('officer-info');
        //console.log(officer_info);

        var newRow = '<li id="approval_authority_' + officer_info.officer_id + '">' +
            '<input name="ap_office_order_id" type="text" value="{{$ap_office_order_id}}"/>' +
            '<input name="annual_plan_id" type="hidden" value="{{$annual_plan_id}}"/>' +
            '<input name="audit_plan_id" type="hidden" value="{{$audit_plan_id}}"/>' +
            '<input name="office_id" type="hidden" value="' + officer_info.office_id + '"/>' +
            '<input name="unit_id" type="hidden" value="' + officer_info.unit_id + '"/>' +
            '<input name="unit_name_en" type="hidden" value="' + officer_info.unit_name_en + '"/>' +
            '<input name="unit_name_bn" type="hidden" value="' + officer_info.unit_name_bn + '"/>'+
            '<input name="officer_type" type="hidden" value="approver"/>'+
            '<input name="employee_id" type="hidden" value="' + officer_info.officer_id + '"/>'+
            '<input name="employee_name_en" type="hidden" value="' + officer_info.officer_name_en + '"/>'+
            '<input name="employee_name_bn" type="hidden" value="' + officer_info.officer_name_bn + '"/>'+
            '<input name="employee_designation_id" type="hidden" value="' + officer_info.designation_id + '"/>'+
            '<input name="employee_designation_en" type="hidden" value="' + officer_info.designation_en + '"/>'+
            '<input name="employee_designation_bn" type="hidden" value="' + officer_info.designation_bn + '"/>'+
            '<input name="officer_phone" type="hidden" value="' + officer_info.officer_mobile + '"/>'+
            '<input name="officer_email" type="hidden" value="' + officer_info.officer_email + '"/>'+
            '<input name="received_by" type="hidden" value="' + officer_info.officer_id + '"/>'+
            '</li>';

        let select_approval_authority =  $(".select_approval_authority");
        select_approval_authority.append(newRow);

    }).on('deselect_node.jstree', function (e, data) {
        var officer_info = $('#' + data.node.id).data('officer-info');
        //console.log(officer_info)
        $('#approval_authority_' + officer_info.officer_id).remove();
    });
</script>
