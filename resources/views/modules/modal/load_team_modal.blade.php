<style type="text/css">
    .custom-timeline {
        padding-left: 10px;
    }

    .custom-timeline-item > .timeline-media {
        cursor: pointer;
    }

    .permitted_designation {
        cursor: pointer;
    }

    .timeline.timeline-3 .timeline-items .timeline-item {
        margin-left: 0px;
    }

    .dragged_data_area::after {
        content: "";
        height: 60px;
        width: 100%;
        position: relative;
        bottom: 0;
        left: 0;
        border: 1px dashed #3699ff;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #3f4254;
        background: #fffed8;
        font-size: 16px;
        font-family: 'SolaimanLipi', serif;
        margin: 0 2px;
        border-radius: 5px;
    }
</style>
{{--<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>--}}
<!-- Office Modal -->
<div class="modal fade custom-modal" id="officeEmployeeModal" tabindex="-1" role="dialog"
     aria-labelledby="officeEmployeeModalLabel"
     aria-hidden="true"
     data-backdrop="static"
>
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title" id="officeEmployeeModalLabel">Add Audit Team</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row pb-1">
                    {{--                    <div class="col-md-4">--}}
                    {{--                        <div class="form-row">--}}
                    {{--                            <input class="form-control" id="assignTeamNo" placeholder="নিরীক্ষা নিযুক্তি দল নম্বর"--}}
                    {{--                                   type="text" autocomplete="off">--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col">
                                <input type="text" id="audit_year_start"
                                       class="year-picker form-control"
                                       placeholder="নিরীক্ষাধীন অর্থ বছর শুরু" autocomplete="off"/>
                            </div>
                            <div class="col">
                                <input type="text" id="audit_year_end"
                                       class="year-picker form-control"
                                       placeholder="নিরীক্ষাধীন অর্থ বছর শেষ" autocomplete="off"/>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col">
                                <input type="text" id="team_start_date"
                                       class="date form-control"
                                       placeholder="সম্পাদনের সময়কাল শুরু" autocomplete="off"/>
                            </div>
                            <div class="col">
                                <input type="text" id="team_end_date"
                                       class="date form-control"
                                       placeholder="সম্পাদনের সময়কাল শেষ" autocomplete="off"/>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-4">
                        <ul class="nav nav-tabs custom-tab-header mb-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active rounded-0" data-toggle="tab" href="#set_own_office">
                                    <span class="nav-text"><i
                                            class="fad fa-briefcase mr-2 text-primary"></i>নিজ অফিস</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#set_other_office" aria-controls="profile">
                                    <span class="nav-text"> <i class="fad fa-building mr-2 text-primary"></i>অন্যান্য অফিস</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content" id="plan_office_tab">
                            <div class="tab-pane border border-top-0 p-3 fade show active" id="set_own_office"
                                 role="tabpanel"
                                 aria-labelledby="own-tab">
                                <div class="row">
                                    <div class="col-md-12 officers_list_area">
                                        <div class="rounded-0 own_office_organogram_tree"
                                             style="overflow-y: scroll; height: 60vh">
                                            <ul>
                                                @foreach($officer_lists as $key => $officer_list)
                                                    @foreach($officer_list['units'] as $unit)
                                                        @foreach($unit['designations'] as $designation)
                                                            @if(!empty($designation['employee_info']))
                                                                <li data-officer-info="{{json_encode(
    [
        'designation_id' => $designation['designation_id'],
        'designation_en' => $designation['designation_eng'],
        'designation_bn' => $designation['designation_bng'],
        'officer_name_en' => !empty($designation['employee_info']) ? $designation['employee_info']['name_eng'] : '',
        'officer_name_bn' => !empty($designation['employee_info']) ? $designation['employee_info']['name_bng'] : '',
        'officer_mobile' => !empty($designation['employee_info']) ? $designation['employee_info']['personal_mobile'] : '',
        'officer_email' => !empty($designation['employee_info']) ? $designation['employee_info']['personal_email'] : '',
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
                                                    @endforeach
                                                @endforeach
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
                    <div class="col-md-8" style="overflow: auto;height: 70vh;">
                        <div class="kt-portlet" style="margin-bottom:0;">
                            <div class="kt-portlet__head d-md-flex align-items-md-center justify-content-md-between">
                                <div class="kt-portlet__head-label">
                                    <h5 class="kt-portlet__head-title">বাছাইকৃত অফিসারদের তালিকা</h5>
                                </div>
                                <div class="kt-portlet__head-label">
                                    <div
                                        class="form-group custom-form-group p-0 mb-2 d-md-flex align-items-md-center justify-content-md-between">
                                        <div class="d-flex flex-wrarp mt-3 align-items-center">
                                            <button type="button" class="btn btn-sm btn-primary btn-square"
                                                    id="createNewLayer" onclick="Load_Team_Container.addLayer()"><i
                                                    class="fad fa-plus"></i>নতুন তৈরি করুন
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-custom gutter-b w-100">
                                <div class="card-body p-0">
                                    <!--begin::Timeline-->
                                    <div class="timeline timeline-3 custom-timeline" id="customTimeline">
                                        <form id="team_form">
                                            <div class="timeline-items " id="permitted_designations"></div>
                                        </form>
                                    </div>
                                    <!--end::Timeline-->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="actions text-right mt-3 permission_action_btn">
                            <button type="button" class="btn btn-sm btn-primary btn-square" id="saveAuditTeam"
                                    onclick="Load_Team_Container.saveAuditTeam()"><i class="fad fa-cloud"></i>সংরক্ষণ
                                করুন
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary btn-square"
                                    id="dismissNothiPermission" onclick="$('.ki-close').click()"><i
                                    class="fad fa-window-close"></i>বন্ধ করুন
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    auditSchedule = {};

    member = {};
    $(document).off('click', '.layer_text').on('click', '.layer_text', function () {
        $(this).attr('contenteditable', 'true');
    });

    $("#permitted_designations .layer_text").click(function () {
        var attr = $(this).attr('contenteditable');
        if (typeof attr !== 'undefined' && attr !== false) {
            $(this).attr('contenteditable', true);
        } else {
            $(this).attr('contenteditable', false);
        }
    })
    $('.own_office_organogram_tree').jstree({
        'plugins': ["checkbox", "types", "search", "dnd"],
        'core': {
            check_callback: true,
            "themes": {
                "responsive": false
            },
        },
        'dnd': {
            "copy": true,
            // "always_copy": true,
        },
        'checkbox': {
            three_state: false, // to avoid that fact that checking a node also check others
            whole_node: false, // to avoid checking the box just clicking the node
            tie_selection: false // for checking without selecting and selecting without checking
        },
        "search": {
            "show_only_matches": true,
            "show_only_matches_children": true
        },
    });

    /**JS tree drag and drop start***/

    var draggedDiv = null;
    var old_currentTarget = null;
    var old_onselectstart;
    var old_unselectable;

    $(document).on('dnd_start.vakata', function (e, data) {
    }).on('drop', function (evt) {
    }).on('dnd_stop.vakata', function (e, data) {
        var getHoverID = data.event.target.id;
        var splitArray = getHoverID.split('_');
        if (data.event.target.id === 'right_drop_zone_' + splitArray[3] || $(data.event.target).parents('#right_drop_zone_' + splitArray[3]).length) {
            if (data.data.jstree && data.data.origin) {
                var node = data.data.origin.get_node(data.element);
                Load_Team_Container.addNode(splitArray[3], node.data.officerInfo);
            }
        } else {
            if (old_currentTarget !== null) {
                old_currentTarget.unselectable = old_unselectable;
                old_currentTarget.onselectstart = old_onselectstart;
                old_currentTarget = null;
            }
            if ($(data.event.target).parents('#own_office_organogram_tree').length) {
                if (draggedDiv !== null) {
                    if (!data.event.ctrlKey) {
                        draggedDiv.remove();
                    }
                    draggedDiv = null;
                }
            }
        }
        $('#right_drop_zone_' + splitArray[3]).click();
    })

    /**JS tree drag and drop end***/

        //
    var employees = {};
    var team = {};
    var subTeam = [];
    team_info = [];
    var Load_Team_Container = {
        load_level_selection_panel: 0,
        selected_designation_ids: JSON.parse('{"228237":228237,"22418":22418}'),

        checkSelectedItemsInOrgTree: function (tree_id) {
            $.each(Load_Team_Container.selected_designation_ids, function (i, v) {
                $(tree_id).jstree(true).check_node("#ofc_org_designation_" + v);
                // $(tree_id).jstree(true).disable_node("#ofc_org_designation_" + v);
            })
            // $(".ofc_org_unit").each(function (i, v) {
            //     var unit_node_id = $(v).attr('id').match(/\d+/)[0];
            //     $(tree_id).jstree(true).disable_node("#ofc_org_unit_" + unit_node_id);
            // })
            Load_Team_Container.load_level_selection_panel = 1;
        },

        addNode: function (layer_index, data_content, addType) {
            var html_officer = data_content.officer_name_bn;
            var node_html = `<li id="designtion_${data_content.designation_id}" class="list-group-item overflow-hidden p-1">
                                <p data-content='${JSON.stringify(data_content)}' data-member-role="member" data-layer="${layer_index}" class="assignedMember_${data_content.designation_id}_${layer_index} p-0 mb-0 permitted_designation" id="permitted_${data_content.designation_id}" data-id="${data_content.designation_id}">
                                    <i class="far fa-user"></i><span class="ml-2 mr-2">${html_officer}</span>
                                    <small>${data_content.designation_bn}, ${data_content.unit_name_bn}</small>`;
            if (layer_index == 1) {
                node_html = node_html + `<button type="button" data-designation-id=${data_content.designation_id} onclick="Load_Team_Container.memberRole($(this), ${layer_index} , 'teamLeader', ${data_content.designation_id})" class="teamLeaderBtn btn btn-xs signatory_layer text-primary"><i data-value="0" class="far text-primary fa-square"></i>দলনেতা</button>`;
            }

            node_html = node_html + `<button type="button" data-designation-id=${data_content.designation_id} onclick="Load_Team_Container.memberRole($(this), ${layer_index} , 'subTeamLeader', ${data_content.designation_id})" class="subTeamLeaderBtn btn btn-xs signatory_layer text-primary"><i data-value="0" class="far text-primary fa-square"></i>উপ দলনেতা</button>
<button type="button" data-designation-id=${data_content.designation_id} onclick="Load_Team_Container.memberRole($(this), ${layer_index} , 'member', ${data_content.designation_id})" class="memberBtn btn btn-xs signatory_layer text-primary"><i data-value="1" class="far text-primary fa-check-square"></i>সদস্য</button>
                    </select> <button type="button" onclick="Load_Team_Container.deleteNode('designation','permitted_${data_content.designation_id}', 0)" class="text-danger btn btn-icon btn-xs del_layer_designation"><i class="text-danger far fa-trash-alt"></i></button>
</p>                            </li>
            `;
            if ($("#designtion_" + data_content.designation_id).length > 0) {
                $("#designtion_" + data_content.designation_id).remove();
            }
            $("#permitted_level_" + layer_index + " .listed_items").append(node_html);
            // Load_Team_Container.newNodeResetSortableList($("#permitted_level_" + layer_index));
            if ($("p[id^=permitted_]").length == 1) {
                $('.teamLeaderBtn').click();
            }
            Load_Team_Container.addTeamInformation(layer_index, data_content.designation_id);
        },

        leader: {},
        subleader: {},
        member_info: {},
        editor_leader_info: '',
        addTeamInformation: function (layer_index, designation_id) {

            all_member = [];

            select_data = $('.assignedMember_' + designation_id + '_' + layer_index).attr('data-content');
            role = $('.assignedMember_' + designation_id + '_' + layer_index).attr('data-member-role');

            console.log(select_data);
            if (role == 'teamLeader') {
                Load_Team_Container.leader = {
                    'team_member_name_en': JSON.parse(select_data).officer_name_en,
                    'team_member_name_bn': JSON.parse(select_data).officer_name_bn,
                    'designation_id': JSON.parse(select_data).designation_id,
                    'designation_en': JSON.parse(select_data).designation_en,
                    'designation_bn': JSON.parse(select_data).designation_bn,
                    'team_member_role_en': 'teamLeader',
                    'team_member_role_bn': 'দলনেতা',
                    'officer_mobile': JSON.parse(select_data).officer_mobile,
                    'officer_email': JSON.parse(select_data).officer_email,
                    'officer_id': JSON.parse(select_data).officer_id,
                    'unit_name_en': JSON.parse(select_data).unit_name_en,
                    'office_id': JSON.parse(select_data).office_id,
                    'comment': ''
                }


                leader_officer_id = JSON.parse(select_data).officer_id;
                leader_name_bn = JSON.parse(select_data).officer_name_bn;
                leader_name_en = JSON.parse(select_data).officer_name_bn;
                leader_designation_id = JSON.parse(select_data).designation_id;
                leader_designation_name_en = JSON.parse(select_data).designation_en;
                leader_designation_name_bn = JSON.parse(select_data).designation_bn;

            }


            if (role == 'subTeamLeader') {
                Load_Team_Container.subleader = {
                    'team_member_name_en': JSON.parse(select_data).officer_name_en,
                    'team_member_name_bn': JSON.parse(select_data).officer_name_bn,
                    'designation_id': JSON.parse(select_data).designation_id,
                    'designation_en': JSON.parse(select_data).designation_en,
                    'designation_bn': JSON.parse(select_data).designation_bn,
                    'team_member_role_en': 'subTeamLeader',
                    'team_member_role_bn': 'উপ দলনেতা',
                    'officer_mobile': JSON.parse(select_data).officer_mobile,
                    'officer_email': JSON.parse(select_data).officer_email,
                    'officer_id': JSON.parse(select_data).officer_id,
                    'unit_name_en': JSON.parse(select_data).unit_name_en,
                    'office_id': JSON.parse(select_data).office_id,
                    'comment': ''
                }

                if (layer_index > 1) {
                    leader_officer_id = JSON.parse(select_data).officer_id;
                    leader_name_bn = JSON.parse(select_data).officer_name_bn;
                    leader_name_en = JSON.parse(select_data).officer_name_bn;
                    leader_designation_id = JSON.parse(select_data).designation_id;
                    leader_designation_name_en = JSON.parse(select_data).designation_en;
                    leader_designation_name_bn = JSON.parse(select_data).designation_bn;
                }
            }

            if (typeof member[layer_index] === 'undefined') {
                member[layer_index] = {};
            }

            if (role == 'member') {
                Load_Team_Container.member_info[JSON.parse(select_data).designation_id] = {
                    'team_member_name_en': JSON.parse(select_data).officer_name_en,
                    'team_member_name_bn': JSON.parse(select_data).officer_name_bn,
                    'designation_id': JSON.parse(select_data).designation_id,
                    'designation_en': JSON.parse(select_data).designation_en,
                    'designation_bn': JSON.parse(select_data).designation_bn,
                    'team_member_role_en': 'subTeamLeader',
                    'team_member_role_bn': 'উপ দলনেতা',
                    'officer_mobile': JSON.parse(select_data).officer_mobile,
                    'officer_email': JSON.parse(select_data).officer_email,
                    'officer_id': JSON.parse(select_data).officer_id,
                    'unit_name_en': JSON.parse(select_data).unit_name_en,
                    'office_id': JSON.parse(select_data).office_id,
                    'comment': ''
                }

                member[layer_index][JSON.parse(select_data).designation_id] = {
                    'team_member_name_en': JSON.parse(select_data).officer_name_en,
                    'team_member_name_bn': JSON.parse(select_data).officer_name_bn,
                    'designation_id': JSON.parse(select_data).designation_id,
                    'designation_en': JSON.parse(select_data).designation_en,
                    'designation_bn': JSON.parse(select_data).designation_bn,
                    'team_member_role_en': 'member',
                    'team_member_role_bn': 'সদস্য',
                    'officer_mobile': JSON.parse(select_data).officer_mobile,
                    'officer_email': JSON.parse(select_data).officer_email,
                    'officer_id': JSON.parse(select_data).officer_id,
                    'unit_name_en': JSON.parse(select_data).unit_name_en,
                    'office_id': JSON.parse(select_data).office_id,
                    'comment': ''
                };
            }


            $('.permitted_designation').each(function (v) {
                content = $('#' + v.id).attr('data-content');
            });


            if (layer_index == 1) {
                team_type = "parent";
            } else {
                team_type = "sub";
            }

            team_info[layer_index] = {
                team_type: team_type,
                team_name: $('#permitted_level_1').find('.layer_text').html(),
                team_start_date: formatDate($('#team_start_date').val()),
                team_end_date: formatDate($('#team_end_date').val()),
                audit_year_start: $('#audit_year_start').val(),
                audit_year_end: $('#audit_year_end').val(),
                leader_officer_id: leader_officer_id,
                leader_name_bn: leader_name_bn,
                leader_name_en: leader_name_en,
                leader_designation_id: leader_designation_id,
                leader_designation_name_en: leader_designation_name_en,
                leader_designation_name_bn: leader_designation_name_bn,
                leader: Load_Team_Container.leader,
                subleader: Load_Team_Container.subleader,
                team_members: member[layer_index],
            };
            team_info.shift();
            $('#team_information_' + layer_index).val(JSON.stringify(team_info));
        },

        setEditorInfo: function () {
            $('.audit_team_leader').html(Load_Team_Container.editor_leader_info);
        },

        memberRole: function (elem, layer_index, role, designation_id) {
            $('.assignedMember_' + designation_id + '_' + layer_index).attr('data-member-role', role);
            designation_id = elem.data('designation-id');
            if (elem.find('i').hasClass('fa-square')) {
                elem.find('i').removeClass('fa-square').addClass('far fa-check-square')
                elem.find('i').attr('data-value', 1);
                elem.parent('p').attr('data-member-role', role)
            } else {
                elem.find('i').removeClass('fa-check-square').addClass('far fa-square')
                elem.find('i').attr('data-value', 0);
                elem.parent('p').attr('data-member-role', '')
            }
            if (role === 'member') {
                $('.assignedMember_' + designation_id + '_' + layer_index + ' .teamLeaderBtn').find('i').removeClass('fa-check-square').addClass('fa-square');
                $('.assignedMember_' + designation_id + '_' + layer_index + ' .subTeamLeaderBtn').find('i').removeClass('fa-check-square').addClass('fa-square');
            } else if (role === 'teamLeader') {
                data_content = $('.assignedMember_' + designation_id + '_' + layer_index).data('content')
                Load_Team_Container.editor_leader_info = data_content.officer_name_bn + ', ' + data_content.designation_bn + ', ' + data_content.unit_name_bn + '|';
                $('.assignedMember_' + designation_id + '_' + layer_index + ' .memberBtn').find('i').removeClass('fa-check-square').addClass('fa-square');
                $('.assignedMember_' + designation_id + '_' + layer_index + ' .subTeamLeaderBtn').find('i').removeClass('fa-check-square').addClass('fa-square');
            } else if (role === 'subTeamLeader') {
                $('.assignedMember_' + designation_id + '_' + layer_index + ' .teamLeaderBtn').find('i').removeClass('fa-check-square').addClass('fa-square');
                $('.assignedMember_' + designation_id + '_' + layer_index + ' .memberBtn').find('i').removeClass('fa-check-square').addClass('fa-square');
            }

            if (elem.find('i').data('value') === 1) {
                Load_Team_Container.addTeamInformation(layer_index, designation_id);
            }

            Load_Team_Container.setEditorInfo();
        },

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
                    '<input  id="officer_name_' + entity_info.officer_id + '"  type="hidden" class="form-control" value="' + entity_info.officer_name_bn + '"/>' +
                    '<i class="fa fa-user pr-2"></i>' + entity_info.officer_name_bn + ' (' + entity_info.designation_bn + ')' +
                    '</li>' +
                    '<div class="row">' +
                    '<div class="col-md-4">' +
                    '<select id="selected_officer_designation_' + entity_info.officer_id + '" name="selected_officer_designation[]" class="form-control select-select2">' +
                    '<option value="">Select</option><option value="teamLeader">দলনেতা</option>' +
                    '<option value="subTeamLeader">উপ দলনেতা</option><option value="member">সদস্য</option>' +
                    '</select>' +
                    '</div>' +
                    '<div class="col-md-8">' +
                    '<input data-id="' + entity_info.officer_id + '" id="selected_officer_phone_' + entity_info.officer_id + '" data-designation-id="' + entity_info.designation_id + '" data-designation-name-bn="' + entity_info.designation_bn + '" data-designation-name-en="' + entity_info.designation_en + '" type="text" name="selected_officer_phone[]" placeholder="Enter phone number" class="form-control selected_officer_phone" value=""/>' +
                    '</div></div></div>';

                $(".selected_offices").append(newRow);
            }
        },

        removeSelectedOfficer: function (entity_id) {
            $('#selected_officer_' + entity_id).remove();
        },

        addEmployeeToAssignEditor: function () {
            if ($("#employee_type").val() === 'leader') {
                localStorage.setItem("teamLeader", JSON.stringify(employees));
            } else if ($("#employee_type").val() === 'member') {
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
            selected_officer_phone.each(function (k, v) {
                var id = $(this).attr('data-id');
                var designationId = $(this).data('designation-id');
                var designationNameBn = $(this).data('designation-name-bn');
                var designationNameEn = $(this).data('designation-name-en');


                name = $('#officer_name_' + id).val();

                var member_role = $('#selected_officer_designation_' + id).val();

                if (member_role == "teamLeader") {
                    teamLeaderNameBn = name;
                    teamLeaderDesignationId = designationId;
                    teamLeaderDesignationNameBn = designationNameBn;
                    teamLeaderDesignationNameEn = designationNameEn;
                }
                if (member_role == "subTeamLeader") {
                    totalSubTeamCreate++;
                }

                phone = $('#selected_officer_phone_' + id).val();
                info = {
                    'name': name,
                    'member_role': member_role,
                    'phone': phone,
                    'teamLeaderDesignationNameBn': teamLeaderDesignationNameBn
                };
                team[id] = info;

                if (member_role == 'subTeamLeader') {
                    $(".sub_teams").append(
                        `<div class="row">
                               <input  class="sub_team_name form-control" type="text" placeholder="উপদল">
                         </div>`
                    );
                }
            });
            // console.log(team);
            localStorage.setItem("team", JSON.stringify(team));
            if (totalSubTeamCreate > 1) {
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
                'team_start_date': formatDate($("#team_start_date").val()),
                'team_end_date': formatDate($("#team_end_date").val()),
                'team_members': JSON.stringify(team),
                'leader_name_en': teamLeaderNameBn,
                'leader_name_bn': teamLeaderNameBn,
                'leader_designation_id': teamLeaderDesignationId,
                'leader_designation_name_en': teamLeaderDesignationNameEn,
                'leader_designation_name_bn': teamLeaderDesignationNameBn,
                'audit_year_start': $("#team_start_date").val(),
                'audit_year_end': $("#team_end_date").val(),
            };
            ajaxCallAsyncCallbackAPI(urlAuditTeam, dataAuditTeam, 'POST', function (response) {
                if (response.status === 'success') {
                    toastr.success('Audit Team Save Successfully');
                } else {
                    toastr.error(response.data)
                }
            });

        },

        loadTeamSchedule: function (team_schedule_list_div, team_layer_id) {
            url = '{{route('audit.plan.audit.editor.load-audit-team-schedule')}}';
            annual_plan_id = '{{$annual_plan_id}}';
            activity_id = '{{$activity_id}}';
            fiscal_year_id = '{{$fiscal_year_id}}';
            data = {team_layer_id, annual_plan_id, activity_id, fiscal_year_id};
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $("#" + team_schedule_list_div).append(response);
                    $("#team_schedule_layer_btn_" + team_layer_id).hide();
                }
            })
        },

        deleteNode: function (type, node_id, from_tree) {
            if (type === 'layer') {
                $('#' + node_id + ' .permitted_designation').each(function (i, v) {
                    // $('#own_office_organogram_tree').jstree(true).enable_node("#ofc_org_designation_" + $(this).data('id'));
                    // $('#own_office_organogram_tree').jstree(true).uncheck_node("#ofc_org_designation_" + $(this).data('id'));
                    if ($("#nothi_permission_office_organogram_tree").length !== 0) {
                        // $('#nothi_permission_office_organogram_tree').jstree(true).enable_node("#ofc_org_designation_" + $(this).data('id'));
                        // $('#nothi_permission_office_organogram_tree').jstree(true).uncheck_node("#ofc_org_designation_" + $(this).data('id'));
                    }
                    delete Load_Team_Container.selected_designation_ids[$(this).data('id')];
                })
                $('#' + node_id).remove();
                Load_Team_Container.reorderLayer();
            } else {
                var designation_id = node_id.match(/\d+/)[0];
                var parent_timeline_content = $('#' + node_id).closest('.timeline-content');
                var layer_index = parent_timeline_content.data('layer_index');
                if (parent_timeline_content.find('.permitted_designation').length >= 1) {
                    var parentId = $('#' + node_id).parent('li').parent('ul').parent('.dragged_data_area').attr('id');
                    var clientHeight = document.getElementById(parentId).clientHeight;
                    $('#' + parentId).removeAttr('style');
                }
                $('#' + node_id).parent('li').remove();
                // $('#own_office_organogram_tree').jstree(true).enable_node("#ofc_org_designation_" + designation_id);
                // $('#own_office_organogram_tree').jstree(true).uncheck_node("#ofc_org_designation_" + designation_id);
                if ($("#nothi_permission_office_organogram_tree").length !== 0) {
                    // $('#nothi_permission_office_organogram_tree').jstree(true).enable_node("#ofc_org_designation_" + designation_id);
                    // $('#nothi_permission_office_organogram_tree').jstree(true).uncheck_node("#ofc_org_designation_" + designation_id);
                }
                delete Load_Team_Container.selected_designation_ids[designation_id];
            }
        },

        reorderLayer: function () {
            var start_layer = 1;
            $("#permitted_designations .timeline-item").each(function () {
                $(this).attr('id', 'right_' + start_layer);
                $(this).find('.timeline-content').attr('data-layer_index', start_layer);
                $(this).find('.timeline-content').attr('id', "permitted_level_" + start_layer);
                $(this).find('.dragged_data_area').attr('id', "right_drop_zone_" + start_layer);
                $(this).find('.listed_items').attr('id', "list_group_" + start_layer);
                $(this).attr('id', 'right_' + start_layer).find(".del_layer").attr("onclick", "Load_Team_Container.deleteNode('layer', 'right_" + start_layer + "', 0)");
                ++start_layer;
            })
        },

        newNodeResetSortableList: function (parent_div_id) {
            var idsArray = [];
            var idArray = $('.dragged_data_area ').find('.listed_items');
            idArray.each(function (i, v) {
                idsArray.push(v.id)
            })
            $(parent_div_id).find('.listed_items').each(function (i, v) {
                $('#' + v.id).sortable();
            });
        },

        initiateSortableList: function () {
            var idsArray = [];
            var idArray = $('.dragged_data_area ').find('.listed_items');
            idArray.each(function (i, v) {
                idsArray.push(v.id)
            })
            $('#permitted_designations').find('.timeline-content').each(function () {
                $(this).find('.listed_items').each(function (i, v) {
                    $('#' + v.id).sortable();
                });
            });
        },

        saveAuditTeamSchedule: function () {
            if (!$.isEmptyObject(auditSchedule)) {
                url = '{{route('audit.plan.audit.revised.plan.store-audit-team-schedule')}}';
                schedule = {"schedule": auditSchedule}
                team_schedules = JSON.stringify(schedule);
                audit_plan_id = $('.draft_entity_audit_plan').data('audit-plan-id');
                data = {team_schedules, audit_plan_id};
                ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                    if (response.status === 'success') {
                        toastr.success(response.data);
                    } else {
                        toastr.error(response.data);
                        console.log(response)
                    }
                })
            } else {
                toastr.error('Please Make Schedule');
            }
        },

        saveAuditTeam: function () {
            url = '{{route('audit.plan.audit.revised.plan.store-audit-team')}}';
            annual_plan_id = '{{$annual_plan_id}}';
            audit_plan_id = $('.draft_entity_audit_plan').data('audit-plan-id');
            activity_id = '{{$activity_id}}';
            fiscal_year_id = '{{$fiscal_year_id}}';
            audit_year_start = $('#audit_year_start').val();
            audit_year_end = $('#audit_year_end').val();
            teams = $("#team_form").serializeArray();
            // console.log(teams);
            data = {
                annual_plan_id,
                activity_id,
                fiscal_year_id,
                audit_year_start,
                audit_year_end,
                audit_plan_id,
                teams
            };
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'success') {
                    toastr.success(response.data);
                    Load_Team_Container.saveAuditTeamSchedule();
                    Load_Team_Container.insertTeamDataInBook();
                } else {
                    toastr.error(response.data);
                    console.log(response)
                }
            })
        },

        insertTeamDataInBook: function () {
            Load_Team_Container.insertAuditScheduleListInBook();
            Load_Team_Container.insertAuditTeamListInBook();
        },

        itemStyle: function () {
            var innerDivLength = $("#permitted_designations").children('.timeline-item');
            var basePadding = 15 * innerDivLength.length;
            innerDivLength.each(function () {
                $(this).removeAttr('style');
                $(this).css('padding-left', basePadding);
                basePadding = basePadding - 15;
            })
        },

        addLayer: function () {
            var innerDivLength = $("#permitted_designations").children('.timeline-item');
            var number = innerDivLength.length + 1;
            if (number === 1) {
                team_name = 'দল ' + enTobn(number);
            } else {
                subteamNumber = number - 1;
                team_name = 'উপদল ' + enTobn(subteamNumber);
            }
            var level_html = `
                <div class="custom-timeline-item timeline-item border-left-0 d-flex align-items-start" style="padding-left: 15px;">
    <div class="timeline-media position-relative"><i
            class="fas fa-chair text-primary"></i></div>
    <div class="timeline-content rounded-0 p-0 w-100" data-layer_index="${number}" id="permitted_level_${number}">
        <div class="px-3 pt-2 pb-0 mb-0 d-flex align-items-center justify-content-between">
            <h5 class="layer_text text-dark-75 text-hover-primary font-weight-bold p-2" style="width: 20%;">${team_name}</h5>
            <div class="d-flex align-items-center justify-content-end">
                <div class="d-flex align-items-center justify-content-between mb-0 mt-0">
                    <div class="mr-2">
                        <button type="button" id="team_schedule_layer_btn_${number}" onclick="Load_Team_Container.loadTeamSchedule('team_schedule_list_${number}',${number})"
                                class="justify-self-end text-danger btn btn-icon btn-md">
                            <i class="text-primary far fa-calendar-alt"></i>
                        </button>`
            if (number > 1) {
                level_html = level_html + `                        <button type="button" onclick="Load_Team_Container.deleteNode('layer','right_${number}', 0)"
                                class="justify-self-end text-danger btn btn-icon btn-md del_layer">
                            <i class="text-danger far fa-trash-alt"></i>
                        </button>`
            }
            level_html = level_html + `</div>
        </div>
        </div>
        </div>
            <div class="dragged_data_area px-2 pt-0" id="right_drop_zone_${number}">
                <ul class="listed_items rounded-0 list-group" id="list_group_${number}">
                    <li class="list-group-item overflow-hidden p-1 dummy_li"></li>
                </ul>
            </div>
            <input type="hidden" name="teams[]" id="team_information_${number}" value=""/>
            <div class="px-2 pt-0" id="team_schedule_list_${number}"></div>
        </div>
        </div>
            `;
            $("#permitted_designations").append(level_html);
            // Load_Team_Container.itemStyle();
            // Load_Team_Container.initiateSortableList();
        },

        insertAuditTeamListInBook: function () {
            let totalAuditTeamRow = $('.audit_team_view_list tbody tr').length + 1;
            let auditTeamListRow = '<tr>' +
                '<td class="text-center">' + totalAuditTeamRow + '.</td>' +
                '<td class="text-left"></td>' +
                '<td class="text-center"></td>' +
                '<td class="text-center"></td>' +
                '<td class="text-left"></td>' +
                '</tr>';
            $(".audit_team_view_list tbody").append(auditTeamListRow);
        },

        //for insert audit schedule
        insertAuditScheduleListInBook: function () {
            let totalAuditScheduleRow = $('.audit_schedule_view_list tbody tr').length;

            var totalTableArrayData = [];
            for (var i in auditSchedule) {
                totalTableArrayData.push([i, auditSchedule[i]]);
            }

            for (var i = 0; i < totalTableArrayData.length; i++) {
                //console.log(totalTableArrayData[i]);
                for (var j = 1; j < totalTableArrayData[i].length; j++) {
                    $(".audit_team_no_04").append(createAuditScheduleTable(totalTableArrayData[i][j]));
                    console.log(totalTableArrayData[i][j]);
                }
            }

            /*var resultScheduleList = [];
            for(var scheduleData in auditSchedule){
                for(var key in auditSchedule[scheduleData]){
                    resultScheduleList.push([key,auditSchedule[scheduleData][key]]);
                }
            }

            for(var startResultSchedule=0;startResultSchedule<resultScheduleList.length;startResultSchedule++){
                for(var j=1;j<resultScheduleList[startResultSchedule].length;j++){
                    let auditScheduleListRow = '<tr>' +
                        '<td class="text-center">'+BnFromEng(totalAuditScheduleRow) +'</td>' +
                        '<td class="text-center">'+resultScheduleList[startResultSchedule][j].cost_center_name_bn +'</td>' +
                        '<td class="text-center">2019-2020</td>' +
                        '<td class="text-center">'+BnFromEng(resultScheduleList[startResultSchedule][j].team_member_start_date) +' হতে '+
                        BnFromEng(resultScheduleList[startResultSchedule][j].team_member_end_date)+'</td>' +
                        '<td class="text-center">'+BnFromEng(resultScheduleList[startResultSchedule][j].activity_man_days) +'</td>' +
                        '</tr>';
                    $(".audit_schedule_view_list tbody").append(auditScheduleListRow);

                    //console.log(resultScheduleList[startResultSchedule][j].cost_center_id);
                }
            }*/

            //$(".audit_team_no_04").html($(".audit_schedule_view_list_container").html());
            //$(".summernote").summernote("editor.pasteHTML", $(".audit_schedule_view_list_container").html());
        }
    };


    function createAuditScheduleTable(scheduleList) {
        let rowNumber = 1;
        var htmlTable = `
            <table class="audit_schedule_view_list mt-5" width="100%" border="1">
                <thead>
                <tr>
                    <th class="text-center" width="5%">ক্রমিক নং</th>
                    <th class="text-center" width="15%">শাখার নাম</th>
                    <th class="text-center" width="27%">নিরীক্ষা বছর</th>
                    <th class="text-center" width="40%">নিরীক্ষার সময়কাল</th>
                    <th class="text-center" width="13%">মোট কর্ম দিবস</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th class="text-center">১</th>
                    <th class="text-center">২</th>
                    <th class="text-center">৩</th>
                    <th class="text-center">৪</th>
                    <th class="text-center">৫</th>
                </tr>
        `;

        for (var i in scheduleList) {
            //console.log(scheduleList[i].cost_center_id);
            htmlTable += '<tr>' +
                '<td class="text-center">' + BnFromEng(rowNumber) + '</td>' +
                '<td class="text-center">' + scheduleList[i].cost_center_name_bn + '</td>' +
                '<td class="text-center">২০২০-২০২১</td>' +
                '<td class="text-center">' + BnFromEng(scheduleList[i].team_member_start_date) + ' হতে ' +
                BnFromEng(scheduleList[i].team_member_end_date) + '</td>' +
                '<td class="text-center">' + BnFromEng(scheduleList[i].activity_man_days) + '</td>' +
                '</tr>';

            if (scheduleList[i].team_member_activity !== "") {
                htmlTable += '<tr>' +
                    '<td class="text-center">' + BnFromEng(rowNumber + 1) + '</td>' +
                    '<td colspan="4" class="text-center">' + BnFromEng(scheduleList[i].team_member_activity) + ' খ্রি. ' + scheduleList[i].activity_location + '</td>' +
                    '</tr>';

                rowNumber = rowNumber + 2;
            } else {
                rowNumber++;
            }
        }

        htmlTable += ` </tbody>
            </table>`;

        return htmlTable;

    }


</script>
