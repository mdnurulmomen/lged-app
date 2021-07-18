<x-modal id="forward_audit_calendar_modal" title="Forward" size='xl'
         url="{{route('audit.plan.operational.calendar.forward')}}">
    <div class="row">
        <div class="col-md-7 overflow-hidden">
            <div class="tree-demo rounded-0 office_organogram_tree jstree-init jstree-1 jstree-default"
                 style="overflow-y: scroll; height: 60vh">
                <ul>
                    <li>
                        Office
                        <ul>
                            @foreach($officer_lists as $key => $officer_list)
                                @foreach($officer_list['units'] as $unit)
                                    <li data-jstree='{ "opened" : true }'>
                                        {{$unit['unit_name_eng']}}
                                        <ul>
                                            @foreach($unit['designations'] as $designation)
                                                <li data-officer-info="{{json_encode(
    [
        'designation_id' => $designation['designation_id'],
        'designation_en' => $designation['designation_eng'],
        'designation_bn' => $designation['designation_bng'],
        'officer_name' => !empty($designation['employee_info']) ? $designation['employee_info']['name_eng'] : '',
        'officer_id' => !empty($designation['employee_info']) ? $designation['employee_info']['id'] : '',
        'unit_id' => $unit['office_unit_id'],
        'unit_name_en' => $unit['unit_name_eng'],
        'unit_name_bn' => $unit['unit_name_bng'],
        'office_id' => $officer_list['office_id'],
        ])}}"
                                                    data-jstree='{ "icon" : "{{!empty($designation['employee_info']) ? "fas": "fal"}} fa-user text-warning" }'>
                                                    {{!empty($designation['employee_info']) ? $designation['employee_info']['name_eng'] : ''}}
                                                    <small>{{$designation['designation_eng']}}</small>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-5">
            <form autocomplete="off" id="forward_audit_calendar_form">
                <div class="form-group">
                    <table class="table table-bordered custom-table ownOfficeForward">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Designation</th>
                            <th>Name</th>
                            <th>Role</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <input type="hidden" value="{{$audit_calendar_id}}" name="audit_calendar_id">
            </form>
        </div>
    </div>
</x-modal>

@include('scripts.script_generic')
<script>
    showHideModalSaveBtn();
    $('.office_organogram_tree').on('select_node.jstree', function (e, data) {
        if (data.node.children.length === 0) {
            var officer_info = $('#' + data.node.id).data('officer-info')
            if (officer_info.officer_name) {
                addOfficerToForwardedList(officer_info)
            } else {
                toastr.warning('Select Valid Officer');
            }
        } else {
            data.node.children.map(child => {
                var officer_info = $('#' + child).data('officer-info')
                if (officer_info.officer_name) {
                    addOfficerToForwardedList(officer_info)
                } else {
                    toastr.warning('Select Valid Officer');
                }
            })
        }
        showHideModalSaveBtn();
    }).on('deselect_node.jstree', function (e, data) {
        if (data.node.children.length === 0) {
            var officer_info = $('#' + data.node.id).data('officer-info')
            $("#forward_audit_calendar_form #btn_remove_officer_" + officer_info.designation_id).click();
        } else {
            data.node.children.map(child => {
                var officer_info = $('#' + child).data('officer-info')
                $("#forward_audit_calendar_form #btn_remove_officer_" + officer_info.designation_id).click();
            })
        }
        showHideModalSaveBtn();
    });

    function addOfficerToForwardedList(officer_info) {
        if ($('#selected_officer_for_forward_calendar_' + officer_info.designation_id).length === 0) {
            var newRow = '<tr id="selected_officer_for_forward_calendar_' + officer_info.designation_id + '">' +
                '<td>' +
                '<input name="designation_to_forward[]" class="designation_to_forward" data-designation-id="' + officer_info.designation_id + '" id="designation_to_forward_' + officer_info.designation_id + '" type="hidden" value=""/>' +
                '<span id="btn_remove_officer_' + officer_info.designation_id + '" data-designation-id="' + officer_info.designation_id + '" onclick="removeOfficerFromForwardedList(' + officer_info.designation_id + ')" style="cursor:pointer;color:red;"><i class="fa fa-trash"></i></span>' +
                '</td>' +
                '<td>' + officer_info.designation_bn + '</td>' +
                '<td>' + officer_info.officer_name + '</td>' +
                '<td>' + '<select name="designation_role[]" class="select-select2"><option value="editor_' + officer_info.designation_id + '" selected>Editor</option><option value="approver_' + officer_info.designation_id + '">Approver</option><option value="viewer_' + officer_info.designation_id + '">Viewer</option></select>' + ' </td>' +
                '</tr>';
            $(".ownOfficeForward tbody").prepend(newRow);
            $(".ownOfficeForward tbody").find('#designation_to_forward_' + officer_info.designation_id).val(JSON.stringify(officer_info));
        }
    }

    function removeOfficerFromForwardedList(designation_id) {
        $('#selected_officer_for_forward_calendar_' + designation_id).remove();
    }

    function showHideModalSaveBtn() {
        if ($(".designation_to_forward").length > 0) {
            $("#btn_forward_audit_calendar_modal_save").show();
        } else {
            $("#btn_forward_audit_calendar_modal_save").hide();
        }
    }

    $("#btn_forward_audit_calendar_modal_save").click(function () {
        url = $(this).data('url');
        data = $('#forward_audit_calendar_form').serialize();
        method = $(this).data('method');
        submit = submitModalData(url, data, method, 'forward_audit_calendar_modal')
    });


</script>
