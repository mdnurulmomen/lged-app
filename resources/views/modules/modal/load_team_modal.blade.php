<!-- Office Modal -->
<div class="modal fade" id="officeEmployeeModal" tabindex="-1" role="dialog"
     aria-labelledby="officeEmployeeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="officeEmployeeModalLabel">Add Audit Team</h5>
            </div>
            <div class="modal-body">
                <div class="row  pb-6">
                    <div class="col-md-4">
                        <label for="">নিরীক্ষা নিযুক্তি দল নম্বর</label>
                        <div class="form-row">
                            <input class="form-control" id="assignTeamNo" placeholder="নিরীক্ষা নিযুক্তি দল নম্বর" type="text" name="">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="">নিরীক্ষাধীন অর্থ বছর</label>
                        <div class="row">
                            <div class="col">
                                <input type="text" data-id="1"
                                       class="year-picker form-control input-start-year"
                                       placeholder="শুরু"/>
                            </div>
                            <div class="col">
                                <input type="text" data-id="1"
                                       class="year-picker form-control input-end-year"
                                       placeholder="শেষ"/>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="">নিরীক্ষা সম্পাদনের সময়কাল</label>
                        <div class="row">
                            <div class="col">
                                <input type="text" data-id="1"
                                       class="date form-control input-start-duration"
                                       placeholder="শুরু"/>
                            </div>
                            <div class="col">
                                <input type="text" data-id="1"
                                       class="date form-control input-end-duration"
                                       placeholder="শেষ"/>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-5">
                        <ul class="nav nav-tabs custom-tabs mb-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active rounded-0" data-toggle="tab" href="#set_own_office">
                                    <span class="nav-text">Own Office</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#set_other_office" aria-controls="profile">
                                    <span class="nav-text">Other Office</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content" id="plan_office_tab">
                            <div class="tab-pane border border-top-0 p-3 fade show active" id="set_own_office" role="tabpanel"
                                 aria-labelledby="own-tab">
                                <div class="row">
                                    <div class="col-md-12 officers_list_area">
                                        <div class="rounded-0 own_office_organogram_tree"
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
                                                                            @if(!empty($designation['employee_info']))
                                                                                <li data-officer-info="{{json_encode(
    [
        'designation_id' => $designation['designation_id'],
        'designation_en' => $designation['designation_eng'],
        'designation_bn' => $designation['designation_bng'],
        'officer_name_en' => !empty($designation['employee_info']) ? $designation['employee_info']['name_eng'] : '',
        'officer_name_bn' => !empty($designation['employee_info']) ? $designation['employee_info']['name_bng'] : '',
        'employee_grade' => !empty($designation['employee_info']['employee_grade']) ? $designation['employee_info']['employee_grade'] : '1',
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
                                                                            @endif
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
                                </div>
                            </div>

                            <div class="tab-pane fade border border-top-0 p-3" id="set_other_office" role="tabpanel"
                                 aria-labelledby="other_office-tab">

                                <div class="row">
                                    <div class="col-md-12">
                                        <select class="form-control select-select2" id="other_office">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <ul class="nav nav-tabs custom-tabs mb-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active rounded-0" data-toggle="tab" href="#team_members">
                                    <span class="nav-text">টিম গঠন</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#sub_team_create" aria-controls="profile">
                                    <span class="nav-text">উপদল গঠন</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#team_schedule" aria-controls="profile">
                                    <span class="nav-text">সময়সূচী</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane border border-top-0 p-3 fade show active" id="team_members" role="tabpanel"
                                 aria-labelledby="selected_offices_tab">
                                <div style="overflow-y: scroll; height: 60vh" class="pl-4 selected_offices"></div>
                            </div>

                            <div class="tab-pane fade border border-top-0 p-3" id="sub_team_create" role="tabpanel"
                                 aria-labelledby="sub_team_create_tab">
                            </div>

                            <div class="tab-pane fade border border-top-0 p-3" id="team_schedule" role="tabpanel"
                                 aria-labelledby="team_schedule_tab">
                            </div>
                        </div>

                    </div>
                </div>


                <div class="assign_employee_div" style="display:none;">
                    <table class="assign_employee_list" width="100%" border="1">
                        <thead>
                        <tr>
                            <td width="30%">নাম</td>
                            <td width="20%">পদবী</td>
                            <td width="30%">নিরীক্ষা দলে অবস্থান</td>
                            <td width="20%">মোবাইল নং</td>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary"
                        onclick="Load_Team_Container.addEmployeeToAssignEditor()">Assign</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('.own_office_organogram_tree').jstree({
        "core": {
            "themes": {
                "responsive": true
            }
        },
        "types": {
            "default": {
                "icon": "fal fa-folder"
            },
            "person": {
                "icon": "fal fa-file "
            }
        },
        "plugins": ["types", "checkbox",]
    });

    //
    var employees = {};
    $('.own_office_organogram_tree').on('select_node.jstree', function (e, data) {
        if (data.node.children.length === 0) {
            var officer_info = $('#' + data.node.id).data('officer-info')
            employees[officer_info.officer_id] = officer_info;
            Load_Team_Container.addEmployeeToAssignedList(officer_info);
            Load_Team_Container.addSelectedOfficeList(officer_info);
        } else {
            data.node.children.map(child => {
                var officer_info = $('#' + child).data('officer-info')
                employees[officer_info.officer_id] = officer_info;
                Load_Team_Container.addEmployeeToAssignedList(officer_info);
                Load_Team_Container.addSelectedOfficeList(officer_info);
            })
        }
    }).on('deselect_node.jstree', function (e, data) {
        if (data.node.children.length === 0) {
            var officer_info = $('#' + data.node.id).data('officer-info');
            delete employees[officer_info.officer_id];
            $("#selected_rp_employee_"+officer_info.officer_id).remove();
            Load_Team_Container.removeSelectedOfficer(officer_info.officer_id);
        } else {
            data.node.children.map(child => {
                var officer_info = $('#' + child).data('officer-info');
                delete employees[officer_info.officer_id];
                $("#selected_rp_employee_"+officer_info.officer_id).remove();
                Load_Team_Container.removeSelectedOfficer(officer_info.officer_id);
            })
        }
    });

    var Load_Team_Container = {
        addEmployeeToAssignedList: function (entity_info) {
            var newRow = '<tr id="selected_rp_employee_' + entity_info.officer_id + '">' +
                '<td width="35%">' + entity_info.officer_name_bn + '</td>' +
                '<td width="30%">' + entity_info.designation_bn + '</td>' +
                '<td width="35%">' + '{{$own_office}}' + '</td>' +
                '</tr>';
            $(".assign_employee_list tbody").prepend(newRow);
        },


        addSelectedOfficeList: function (entity_info) {
            if ($('#selected_officer_' + entity_info.officer_id).length === 0) {
                var newRow = '<div class="mt-2" style="border: 1px solid #ebf3f2;padding: 10px" id="selected_officer_' + entity_info.officer_id + '">' +
                    '<li style="border: 1px solid #ebf3f2;list-style: none;margin: 5px;padding:10px;">' +
                    /*'<span onclick="Load_Team_Container.removeSelectedOfficer(' + entity_info.officer_id + ')" style="cursor:pointer;color:red;">' +
                    '<i class="fas fa-trash-alt text-danger pr-2"></i></span>' +*/
                    '<i class="fa fa-user pr-2"></i>' + entity_info.officer_name_bn+ ' ('+entity_info.designation_bn+')' +
                    '</li>'+
                    '<div class="row">'+
                    '<div class="col-md-4">'+
                    '<select name="selected_officer_designation[]" class="form-control select-select2">' +
                    '<option value="">Select</option><option value="দলনেতা">দলনেতা</option>' +
                    '<option value="উপ দলনেতা">উপ দলনেতা</option><option value="সদস্য">সদস্য</option>' +
                    '</select>'+
                    '</div>'+
                    '<div class="col-md-8">'+
                    '<input type="text" name="selected_officer_phone[]" placeholder="Enter phone number" class="form-control selected_officer_phone" value=""/>'+
                    '</div></div></div>';

                $(".selected_offices").append(newRow);
                /*selected_auditee = {
                    'office_id': entity_info.entity_id,
                    'office_name_en': entity_info.entity_name_en,
                    'office_name_bn': entity_info.entity_name_bn,
                };
                controlling_office = {
                    'controlling_office_id': entity_info.controlling_office_id,
                    'controlling_office_name_en': entity_info.controlling_office_name_en,
                    'controlling_office_name_bn': entity_info.controlling_office_name_bn,
                    'entity_id': entity_info.entity_id,
                };
                ministry_info = {
                    'ministry_id': entity_info.ministry_id,
                    'ministry_name_en': entity_info.ministry_name_en,
                    'ministry_name_bn': entity_info.ministry_name_bn,
                    'entity_id': entity_info.entity_id,
                }

                $(".selected_offices").find('#selected_entity_' + entity_info.entity_id).val(JSON.stringify(selected_auditee));
                $(".selected_offices").find('#controlling_office_' + entity_info.controlling_office_id).val(JSON.stringify(controlling_office));
                $(".selected_offices").find('#ministry_info_' + entity_info.ministry_id).val(JSON.stringify(ministry_info));*/
            }
        },
        removeSelectedOfficer: function (entity_id) {
            $('#selected_officer_' + entity_id).remove();
        },

        addEmployeeToAssignEditor:function (){
            if ($("#employee_type").val() === 'leader'){
                localStorage.setItem("teamLeader", JSON.stringify(employees));
            }
            else if($("#employee_type").val() === 'member'){
                localStorage.setItem("teamMember", JSON.stringify(employees));
            }
            $(".summernote").summernote("editor.pasteHTML", $(".assign_employee_div").html());
            $('#officeEmployeeModal').modal('hide');
        }
    }
</script>
