<!--begin::Table-->
<form id="approval_authority_form">
    <div class="row">
        <div class="col-md-12 officers_list_area">
            <h5></h5>
            <div class="rounded-0" id="approvalAuthorityTree"
                 style="overflow-y: scroll; height: 55vh">
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
            'office_name_eng' => 'OCAG',
            'office_name_bng' => 'OCAG',
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

            <div class="form-row pb-4">
                <div class="col-md-12">
                    <label for="comments">মন্তব্য</label>
                    <textarea class="form-control" id="comments" name="comments"></textarea>
                </div>
            </div>

            <div class="text-left mt-5">
                <a tabindex="0" href="javascript:;" role="button" onclick="Annual_Plan_Container.storeAnnualPlanApprovalAuthority()"
                   class="btn btn-primary btn-sm btn-square btn-forward" id="onucched_forward"><i class="fa fa-paper-plane"></i>প্রেরণ করুন</a>
            </div>
        </div>

        <div class="d-none">
            <ul class="select_approval_authority"></ul>
        </div>
    </div>
</form>
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
            '<input name="fiscal_year_id" type="hidden" value="{{$fiscal_year_id}}"/>' +
            '<input name="op_audit_calendar_event_id" type="hidden" value="{{$op_audit_calendar_event_id}}"/>' +
            '<input name="receiver_type" type="hidden" value="approver"/>'+
            '<input name="receiver_office_id" type="hidden" value="' + officer_info.office_id + '"/>'+
            '<input name="receiver_office_name_en" type="hidden" value="' + officer_info.office_id + '"/>'+
            '<input name="receiver_office_name_bn" type="hidden" value="' + officer_info.office_id + '"/>'+
            '<input name="receiver_unit_id" type="hidden" value="' + officer_info.unit_id + '"/>'+
            '<input name="receiver_unit_name_en" type="hidden" value="' + officer_info.unit_name_en + '"/>'+
            '<input name="receiver_unit_name_bn" type="hidden" value="' + officer_info.unit_name_bn + '"/>'+
            '<input name="receiver_officer_id" type="hidden" value="' + officer_info.officer_id + '"/>'+
            '<input name="receiver_name_en" type="hidden" value="' + officer_info.officer_name_en + '"/>'+
            '<input name="receiver_name_bn" type="hidden" value="' + officer_info.officer_name_bn + '"/>'+
            '<input name="receiver_designation_id" type="hidden" value="' + officer_info.designation_id + '"/>'+
            '<input name="receiver_designation_bn" type="hidden" value="' + officer_info.designation_en + '"/>'+
            '<input name="receiver_designation_en" type="hidden" value="' + officer_info.designation_bn + '"/>'+
            '</li>';

        let select_approval_authority =  $(".select_approval_authority");
        select_approval_authority.append(newRow);

    }).on('deselect_node.jstree', function (e, data) {
        var officer_info = $('#' + data.node.id).data('officer-info');
        //console.log(officer_info)
        $('#approval_authority_' + officer_info.officer_id).remove();
    });
</script>
