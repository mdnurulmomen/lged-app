<!--begin::Table-->
<div class="row">
    <div class="col-md-12 officers_list_area">
        <h5 class="mt-2 mb-4">{{!empty($last_air_movement)?$last_air_movement['receiver_employee_name_bn'].' ('.$last_air_movement['receiver_employee_designation_bn'].') এর কাছে প্রেরণ করা হয়েছে':''}}</h5>
        <label class="col-form-label">প্রাপক বাছাই করুন</label>
        <div class="rounded-0" id="approvalAuthorityTree"
             style="overflow-y: scroll; height: 20vh">
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

        <form id="approval_authority_form">
            <input type="hidden" name="r_air_id" value="{{$air_report_id}}">
            <input type="hidden" name="air_type" value="{{$air_type}}">
            <input type="hidden" name="office_id" value="{{$office_id}}">
            <input type="hidden" name="approval_type" value="directorate">

            <ul class="d-none select_approval_authority"></ul>

            <div class="form-group mt-4">
                <label class="col-form-label" for="approval_status">স্ট্যাটাস</label>
                <select name="approval_status" class="form-control select-select2" id="status">
                    <option value="draft">Draft</option>
                    <option value="pending" selected>Pending</option>
                    <option value="approved">Approved</option>
                </select>
            </div>

            <div class="form-group">
                <label class="col-form-label" for="comments">মন্তব্য</label>
                <textarea class="form-control" name="comments" id="comments" cols="30" rows="2"></textarea>
            </div>
        </form>

        <div class="text-left mt-2">
            <a tabindex="0" href="javascript:;" role="button"
               onclick="Air_Movement_Container.store()"
               class="btn btn-primary btn-sm btn-square btn-forward" id="onucched_forward">
                <i class="fa fa-paper-plane"></i>প্রেরণ করুন</a>
        </div>
    </div>
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
            '<input name="receiver_officer_id" type="hidden" value="' + officer_info.officer_id + '"/>'+
            '<input name="receiver_office_id" type="hidden" value="' + officer_info.office_id + '"/>' +
            '<input name="receiver_unit_id" type="hidden" value="' + officer_info.unit_id + '"/>' +
            '<input name="receiver_unit_name_en" type="hidden" value="' + officer_info.unit_name_en + '"/>' +
            '<input name="receiver_unit_name_bn" type="hidden" value="' + officer_info.unit_name_bn + '"/>'+
            '<input name="receiver_employee_id" type="hidden" value="' + officer_info.officer_id + '"/>'+
            '<input name="receiver_employee_name_en" type="hidden" value="' + officer_info.officer_name_en + '"/>'+
            '<input name="receiver_employee_name_bn" type="hidden" value="' + officer_info.officer_name_bn + '"/>'+
            '<input name="receiver_employee_designation_id" type="hidden" value="' + officer_info.designation_id + '"/>'+
            '<input name="receiver_employee_designation_en" type="hidden" value="' + officer_info.designation_en + '"/>'+
            '<input name="receiver_employee_designation_bn" type="hidden" value="' + officer_info.designation_bn + '"/>'+
            '<input name="receiver_officer_phone" type="hidden" value="' + officer_info.officer_mobile + '"/>'+
            '<input name="receiver_officer_email" type="hidden" value="' + officer_info.officer_email + '"/>'+
            '</li>';

        let select_approval_authority =  $(".select_approval_authority");
        select_approval_authority.append(newRow);

    }).on('deselect_node.jstree', function (e, data) {
        var officer_info = $('#' + data.node.id).data('officer-info');
        //console.log(officer_info)
        $('#approval_authority_' + officer_info.officer_id).remove();
    });

    var Air_Movement_Container = {
        store: function () {
            url = '{{route('audit.final-report.submit-final-approval')}}';
            data = $('#approval_authority_form').serialize();
            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'success') {
                    toastr.success('সফলভাবে প্রেরণ করা হয়েছে');
                    $('#kt_quick_panel_close').click();
                    $(".load_approval_authority").hide();
                    $(".update-qac-air-report").hide();
                }
                else {
                    toastr.error(response.data.message);
                }
            })
        },
    };
</script>
