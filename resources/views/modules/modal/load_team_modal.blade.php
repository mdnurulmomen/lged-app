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
                            <input class="form-control" id="assignTeamNo" placeholder="নিরীক্ষা নিযুক্তি দল নম্বর" type="text" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="">নিরীক্ষাধীন অর্থ বছর</label>
                        <div class="row">
                            <div class="col">
                                <input type="text" id="team_start_year"
                                       class="year-picker form-control"
                                       placeholder="শুরু" autocomplete="off"/>
                            </div>
                            <div class="col">
                                <input type="text" id="team_end_year"
                                       class="year-picker form-control"
                                       placeholder="শেষ" autocomplete="off"/>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="">নিরীক্ষা সম্পাদনের সময়কাল</label>
                        <div class="row">
                            <div class="col">
                                <input type="text" id="team_start_date"
                                       class="date form-control"
                                       placeholder="শুরু" autocomplete="off"/>
                            </div>
                            <div class="col">
                                <input type="text" id="team_end_date"
                                       class="date form-control"
                                       placeholder="শেষ" autocomplete="off"/>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-4">
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
                    <div class="col-md-8">
                        <ul class="nav nav-tabs custom-tabs mb-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active rounded-0" data-toggle="tab" href="#team_members">
                                    <span class="nav-text">টিম গঠন</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="subTeamCreateNavLink" class="nav-link disabled" data-toggle="tab" href="#sub_team_create" aria-controls="profile" disabled="">
                                    <span class="nav-text">উপদল গঠন</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#team_schedule" aria-controls="profile"
                                onclick="Load_Team_Container.loadTeamSchedule()">
                                    <span class="nav-text">সময়সূচী</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane border border-top-0 p-3 fade show active" id="team_members" role="tabpanel"
                                 aria-labelledby="selected_offices_tab">
                                <div style="overflow-y: scroll; height: 60vh" class="pl-4 selected_offices"></div>
                                <button id="save_team" onclick="Load_Team_Container.saveTeamMember()" class="btn btn-primary float-left"> save </button>
                            </div>

                            <div class="tab-pane fade border border-top-0 p-3" id="sub_team_create" role="tabpanel"
                                 aria-labelledby="sub_team_create_tab">
                                <div class="pl-4 sub_teams"></div>
                                <button id="save_sub_team" onclick="Load_Team_Container.saveSubTeam()" class="btn btn-primary float-left"> save </button>
                                <div class="pl-4 assign_sub_team_members"></div>
                            </div>

                            <div class="tab-pane fade border border-top-0 p-3" id="team_schedule" role="tabpanel"
                                 aria-labelledby="team_schedule_tab">
                                <div class="audit_schedule_list_div"></div>
                            </div>
                        </div>
                    </div>
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
    var team = {};
    var subTeam = [];
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
                    '<li  style="border: 1px solid #ebf3f2;list-style: none;margin: 5px;padding:10px;">' +
                    /*'<span onclick="Load_Team_Container.removeSelectedOfficer(' + entity_info.officer_id + ')" style="cursor:pointer;color:red;">' +
                    '<i class="fas fa-trash-alt text-danger pr-2"></i></span>' +*/
                    '<input  id="officer_name_' + entity_info.officer_id + '"  type="hidden" class="form-control" value="'+ entity_info.officer_name_bn+'"/>'+
                    '<i class="fa fa-user pr-2"></i>' + entity_info.officer_name_bn+ ' ('+entity_info.designation_bn+')' +
                    '</li>'+
                    '<div class="row">'+
                    '<div class="col-md-4">'+
                    '<select id="selected_officer_designation_' + entity_info.officer_id + '" name="selected_officer_designation[]" class="form-control select-select2">' +
                    '<option value="">Select</option><option value="teamLeader">দলনেতা</option>' +
                    '<option value="subTeamLeader">উপ দলনেতা</option><option value="member">সদস্য</option>' +
                    '</select>'+
                    '</div>'+
                    '<div class="col-md-8">'+
                    '<input data-id="' + entity_info.officer_id + '" id="selected_officer_phone_' + entity_info.officer_id + '" data-designation-id="' + entity_info.designation_id + '" data-designation-name-bn="' + entity_info.designation_bn + '" data-designation-name-en="' + entity_info.designation_en + '" type="text" name="selected_officer_phone[]" placeholder="Enter phone number" class="form-control selected_officer_phone" value=""/>'+
                    '</div></div></div>';

                $(".selected_offices").append(newRow);
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
        },

        saveTeamMember: function () {
            let totalSubTeamCreate = 0;
            let teamLeaderNameBn;
            let teamLeaderDesignationId;
            let teamLeaderDesignationNameBn;
            let teamLeaderDesignationNameEn;

            var selected_officer_phone = $('.selected_officer_phone');
            selected_officer_phone.each(function(k, v) {
                 var id = $(this).attr('data-id');
                 var designationId = $(this).data('designation-id');
                 var designationNameBn = $(this).data('designation-name-bn');
                 var designationNameEn = $(this).data('designation-name-en');

                 var name = $('#officer_name_'+id).val();

                 var member_role = $('#selected_officer_designation_'+id).val();

                 if (member_role == "teamLeader"){
                     teamLeaderNameBn = name;
                     teamLeaderDesignationId = designationId;
                     teamLeaderDesignationNameBn = designationNameBn;
                     teamLeaderDesignationNameEn = designationNameEn;
                 }
                 if (member_role == "subTeamLeader"){
                     totalSubTeamCreate++;
                 }

                 var phone = $('#selected_officer_phone_'+id).val();
                 info = {'name' : name,'member_role' : member_role,'phone' : phone,'teamLeaderDesignationNameBn':teamLeaderDesignationNameBn};
                 team[id] = info;

                 if (member_role == 'subTeamLeader'){
                     $(".sub_teams").append(
                         `<div class="row">
                               <input  class="sub_team_name form-control" type="text" placeholder="উপদল">
                         </div>`
                     );
                 }
            });
            // console.log(team);
            localStorage.setItem("team", JSON.stringify(team));
            if (totalSubTeamCreate >1){
                $("#subTeamCreateNavLink").removeClass('disabled');
            }


            //for save audit team
            let urlAuditTeam = '{{route('audit.plan.audit.revised.plan.store-audit-team')}}';
            let dataAuditTeam = {
                'activity_id': '{{$activity_id}}',
                'annual_plan_id': '{{$annual_plan_id}}',
                'fiscal_year_id': '{{$fiscal_year_id}}',
                'audit_plan_id': '{{$audit_plan_id}}',
                'entity_id': '20307',
                'entity_name_en': 'রাজশাহী কৃষি উন্নয়ন ব্যাংক',
                'entity_name_bn': 'রাজশাহী কৃষি উন্নয়ন ব্যাংক',
                'team_start_date': $("#team_start_date").val(),
                'team_end_date': $("#team_end_date").val(),
                'team_members': JSON.stringify(team),
                'leader_name_en': teamLeaderNameBn,
                'leader_name_bn': teamLeaderNameBn,
                'leader_designation_id': teamLeaderDesignationId,
                'leader_designation_name_en': teamLeaderDesignationNameEn,
                'leader_designation_name_bn': teamLeaderDesignationNameBn,
                'audit_year_start': $("#team_start_year").val(),
                'audit_year_end': $("#team_end_year").val(),
            };
            ajaxCallAsyncCallbackAPI(urlAuditTeam, dataAuditTeam, 'POST', function (response) {
                if (response.status === 'success') {
                    toastr.success('Audit Team Save Successfully');
                } else {
                    toastr.error(response.data)
                }
            });

        },

        saveSubTeam: function () {

            var sub_team_name = $('.sub_team_name');
            var team_id = 1;
            url = '{{route('audit.plan.audit.revised.plan.get-sub-team')}}';
            data = {team_id};
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                $('.assign_sub_team_members').html(response)
            })

            // console.log(subTeam);

            // teamMember = JSON.parse(localStorage.getItem('team'));
            //
            // addRow = `<ul class="nav nav-tabs custom-tabs mb-0" role="tablist">`;
            // subTeam.each(function(k, v) {
            //         addRow = addRow +
            //         `<li class="nav-item">
            //             <a class="nav-link active rounded-0" data-toggle="tab" href="#sub_1">
            //                 <span class="nav-text">sub 1</span>
            //             </a>
            //         </li>`;
            // });
            //
            // addRow = addRow + `</ul>`
            //
            // addRow = addRow + `<div class="tab-content">`;
            //
            // for( key in teamMember) {
            //     if (teamMember.hasOwnProperty(key)) {
            //         addRow = addRow +
            //             `<div class="tab-pane border border-top-0 p-3 fade show active" id="sub_1" role="tabpanel"
            //                  aria-labelledby="selected_offices_tab">
            //             </div>`
            //     }
            // }
            // addRow = addRow + `</div>`;
            //
            // $(".assign_sub_team_members").append(newRow);

            // for( key in teamMember) {
            //     if (teamMember.hasOwnProperty(key)) {
            //         var newRow = '<div class="mt-2" style="border: 1px solid #ebf3f2;padding: 10px">' +
            //         '<li  style="border: 1px solid #ebf3f2;list-style: none;margin: 5px;padding:10px;">' +
            //         '<i class="fa fa-user pr-2"></i>' + teamMember[key].name+ '</li>'+
            //         '<div class="row">'+
            //         '<div class="col-md-4">'+
            //         '<select  name="selected_officer_designation[]" class="form-control select-select2">';
            //         subTeam.map(function (v){
            //             newRow = newRow +  '<option value="'+v+'">'+v+'</option>';
            //         });
            //         newRow = newRow + '</select>'+ '</div>'+ '</div></div>';
            //
            //     $(".assign_sub_team_members").append(newRow);
            //     }
            // }
        },

        loadTeamSchedule:function (){
            url = '{{route('audit.plan.audit.editor.load-audit-team-schedule')}}';
            annual_plan_id = '{{$annual_plan_id}}';
            activity_id = '{{$activity_id}}';
            fiscal_year_id = '{{$fiscal_year_id}}';
            data = {annual_plan_id, activity_id, fiscal_year_id};
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".audit_schedule_list_div").html(response);
                }
            })
        }
    }
</script>
