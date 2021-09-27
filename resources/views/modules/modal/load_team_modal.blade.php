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
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col">
                                <input type="text" id="audit_year_start"
                                       class="year-picker form-control"
                                       placeholder="নিরীক্ষাধীন অর্থ বছর শুরু"
                                       value="{{empty($all_teams) || empty($all_teams[0]['audit_year_start'])?'':$all_teams[0]['audit_year_start']}}"
                                       autocomplete="off"/>
                            </div>
                            <div class="col">
                                <input type="text" id="audit_year_end"
                                       class="year-picker form-control"
                                       value="{{empty($all_teams) || empty($all_teams[0]['audit_year_end'])?'':$all_teams[0]['audit_year_end']}}"
                                       placeholder="নিরীক্ষাধীন অর্থ বছর শেষ" autocomplete="off"/>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col">
                                <input type="text" id="team_start_date"
                                       class="date form-control"
                                       value="{{empty($all_teams) || empty($all_teams[0]['team_start_date'])?'':date('d/m/Y',strtotime($all_teams[0]['team_start_date']))}}"
                                       placeholder="সম্পাদনের সময়কাল শুরু" autocomplete="off"/>
                            </div>
                            <div class="col">
                                <input type="text" id="team_end_date"
                                       class="date form-control"
                                       value="{{empty($all_teams) || empty($all_teams[0]['team_end_date'])?'':date('d/m/Y',strtotime($all_teams[0]['team_end_date']))}}"
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
                                            <div class="timeline-items " id="permitted_designations">
                                                @foreach($all_teams as $key => $value)
                                                    <div class="custom-timeline-item timeline-item border-left-0 d-flex align-items-start"
                                                    style="padding-left: 15px;">
                                                    <div class="timeline-media position-relative"><i
                                                            class="fas fa-chair text-primary"></i></div>
                                                    <div class="timeline-content rounded-0 p-0 w-100"
                                                         data-layer_index="{{$value['id']}}" id="permitted_level_{{$value['id']}}">
                                                        <div
                                                            class="px-3 pt-2 pb-0 mb-0 d-flex align-items-center justify-content-between">
                                                            <h5 class="layer_text text-dark-75 text-hover-primary font-weight-bold p-2"
                                                                style="width: 20%;">{{$value['team_name']}}</h5>
                                                            <div class="d-flex align-items-center justify-content-end">
                                                                <div
                                                                    class="d-flex align-items-center justify-content-between mb-0 mt-0">
                                                                    <div class="mr-2">
                                                                        <button type="button"
                                                                                id="team_schedule_layer_btn_{{$value['id']}}"
                                                                                onclick="Load_Team_Container.loadTeamSchedule('team_schedule_list_{{$value['id']}}','{{$value['id']}}')"
                                                                                class="justify-self-end text-danger btn btn-icon btn-md">
                                                                            <i class="text-primary far fa-calendar-alt"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="dragged_data_area px-2 pt-0" id="right_drop_zone_{{$value['id']}}">
                                                            <ul class="listed_items rounded-0 list-group"
                                                                id="list_group_{{$value['id']}}">
                                                                <li class="list-group-item overflow-hidden p-1 dummy_li"></li>
                                                                @php
                                                                    $team_members = json_decode($value['team_members'],true);
                                                                @endphp

                                                                @foreach($team_members as $key => $member_info)
                                                                    @foreach($member_info as $officer_id => $member)
                                                                        @if($value['team_parent_id'] > 0)
                                                                            @if($member['team_member_role_en'] == 'teamLeader') @continue @endif
                                                                        @endif
                                                                    <li id="designtion_{{$member['designation_id']}}"
                                                                    class="list-group-item overflow-hidden p-1">
                                                                    <p data-content="{&quot;designation_id&quot;:&quot;1&quot;,&quot;designation_en&quot;:&quot;Director General&quot;,&quot;designation_bn&quot;:&quot;মহাপরিচালক&quot;,&quot;officer_name_en&quot;:&quot;Abul Kalam Azad&quot;,&quot;officer_name_bn&quot;:&quot;আবুল কালাম আজাদ&quot;,&quot;officer_mobile&quot;:&quot;01819000000&quot;,&quot;officer_email&quot;:&quot;abul@gmail.com&quot;,&quot;employee_grade&quot;:&quot;1&quot;,&quot;officer_id&quot;:&quot;1&quot;,&quot;unit_id&quot;:1,&quot;unit_name_en&quot;:&quot;Office of the Director General&quot;,&quot;unit_name_bn&quot;:&quot;মহাপরিচালক এর দপ্তর&quot;,&quot;office_id&quot;:2}"
                                                                       data-member-role="{{$member['team_member_role_en']}}" data-layer="{{$value['id']}}"
                                                                       class="assignedMember_{{$member['designation_id']}}_{{$value['id']}} p-0 mb-0 permitted_designation"
                                                                       id="permitted_{{$value['id']}}" data-id="{{$value['id']}}">
                                                                        <i class="far fa-user"></i><span
                                                                            class="ml-2 mr-2">{{$member['officer_name_bn']}}</span>
                                                                        <small>{{$member['designation_bn']}}, {{$member['unit_name_bn']}}</small>

                                                                        <button type="button" data-designation-id="{{$member['designation_id']}}"
                                                                                onclick="Load_Team_Container.memberRole($(this), '{{$value['id']}}' , 'teamLeader', '{{$member['designation_id']}}')"
                                                                                class="teamLeaderBtn btn btn-xs signatory_layer text-primary">
                                                                            <i data-value="@if($member['team_member_role_en'] == 'teamLeader') 1 @else 0 @endif"
                                                                               class="far text-primary @if($member['team_member_role_en'] == 'teamLeader') fa-check-square @else fa-square @endif "></i>দলনেতা
                                                                        </button>

                                                                        <button type="button" data-designation-id="{{$member['designation_id']}}"
                                                                                onclick="Load_Team_Container.memberRole($(this), '{{$value['id']}}' , 'subTeamLeader', '{{$member['designation_id']}}')"
                                                                                class="subTeamLeaderBtn btn btn-xs signatory_layer text-primary">
                                                                            <i data-value="@if($member['team_member_role_en'] == 'subTeamLeader') 1 @else 0 @endif"
                                                                               class="far text-primary @if($member['team_member_role_en'] == 'subTeamLeader') fa-check-square @else fa-square @endif "></i>উপ
                                                                            দলনেতা
                                                                        </button>
                                                                        <button type="button" data-designation-id="{{$member['designation_id']}}"
                                                                                onclick="Load_Team_Container.memberRole($(this), '{{$value['id']}}' , 'member', '{{$member['designation_id']}}')"
                                                                                class="memberBtn btn btn-xs signatory_layer text-primary">
                                                                            <i data-value="@if($member['team_member_role_en'] == 'member') 1 @else 0 @endif"
                                                                               class="far text-primary @if($member['team_member_role_en'] == 'member') fa-check-square @else fa-square @endif "></i>সদস্য
                                                                        </button>
                                                                        <button type="button"
                                                                                onclick="Load_Team_Container.deleteNode('designation','permitted_{{$value['id']}}', 0)"
                                                                                class="text-danger btn btn-icon btn-xs del_layer_designation">
                                                                            <i class="text-danger far fa-trash-alt"></i>
                                                                        </button>
                                                                    </p>
                                                                </li>
                                                                    @endforeach
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                        @if($value['team_schedules'])

                                                                @php
                                                                    $team_schedules = json_decode($value['team_schedules'],true);
                                                                @endphp
                                                            @foreach($team_schedules as $key => $schedule)
                                                            <div class="px-2 pt-0" id="team_schedule_list_{{$key}}">

                                                            <div class="audit_schedule_list_div">
                                                                <table id="audit_schedule_table_{{$key}}" class="audit-schedule-table table table-bordered table-striped table-hover table-condensed table-sm
                                            text-center">
                                                                    <thead>
                                                                    <tr>
                                                                        <th width="52%">
                                                                            শাখার নাম
                                                                        </th>
                                                                        <th width="30%">
                                                                            নিরীক্ষার সময়কাল
                                                                        </th>

                                                                        <th width="12%">
                                                                            কর্ম দিবস
                                                                        </th>
                                                                        <th width="6%">
                                                                            <div class="ml-1" align="left">
                                                                                <button type="button"
                                                                                        class="btn btn-icon btn-outline-danger border-0 btn-xs mr-2 remove_audit_schedule_list_div">
                                                                                    <span
                                                                                        class="fal fa-trash-alt"></span>
                                                                                </button>
                                                                            </div>
                                                                        </th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody data-tbody-id="">
                                                                    <tr class='audit_schedule_row_' data-layer-id=""
                                                                        data-audit-schedule-first-row='1_'>
                                                                        <td>
                                                                            <select id="branch_name_select__0"
                                                                                    class="form-control input-branch-name"
                                                                                    data-id="_0">
                                                                                <option value=''>--Select--</option>
                                                                                {{--                    @foreach($nominatedOffices as $key => $nominatedOffice)--}}
                                                                                {{--                        <option value="{{$nominatedOffice['office_id']}}"--}}
                                                                                {{--                                data-cost-center-id="{{$nominatedOffice['office_id']}}"--}}
                                                                                {{--                                data-cost-center-name-bn="{{$nominatedOffice['office_name_bn']}}"--}}
                                                                                {{--                                data-cost-center-name-en="{{$nominatedOffice['office_name_en']}}">{{$nominatedOffice['office_name_bn']}}</option>--}}
                                                                                {{--                    @endforeach--}}
                                                                            </select>
                                                                        </td>
                                                                        <td>
                                                                            <div class="row">
                                                                                <div class="col pr-0">
                                                                                    <input type="text" data-id="_0"
                                                                                           class="date form-control input-start-duration"
                                                                                           value="{{date('d/m/y',strtotime($schedule['team_member_start_date']))}}"
                                                                                           placeholder="শুরু"/>
                                                                                </div>
                                                                                <div class="col pl-0">
                                                                                    <input type="text" data-id="_0"
                                                                                           class="date form-control input-end-duration"
                                                                                           value="{{date('d/m/y',strtotime($schedule['team_member_end_date']))}}"
                                                                                           placeholder="শেষ"/>
                                                                                </div>
                                                                            </div>
                                                                        </td>

                                                                        <td>
                                                                            <input type="number" data-id="_0" value="0"
                                                                                   class="form-control input-total-working-day"
                                                                                   value="{{$schedule['activity_man_days']}}"
                                                                                   id="input_total_working_day__0"/>
                                                                        </td>
                                                                        <td style="display: inline-flex;">
                                                                            <button type="button"
                                                                                    onclick="Load_Team_Schedule.addAuditScheduleTblRow()"
                                                                                    class="btn btn-icon btn-outline-success border-0 btn-xs mr-2">
                                                                                <span class="fad fa-plus"></span>
                                                                            </button>
                                                                            <button type='button' data-row='row1'
                                                                                    class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2 remove-schedule-row'>
                                                                                <span class='fal fa-trash-alt'></span>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="audit_schedule_row_" data-layer-id=""
                                                                        data-schedule-second-row='1_'>
                                                                        <td width="20%">
                                                                            <input type="text" data-id="" value="{{date('d/m/y',strtotime($schedule['activity_detail_date']))}}"
                                                                                   class="date form-control input-detail-duration"/>
                                                                        </td>
                                                                        <td width="72%" colspan="2">
                                                                            <input type="text" data-id="" value="{{$schedule['activity_details']}}"
                                                                                   class="form-control input-detail"/>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                        </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
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
    all_teams = {};
    all_schedules = {};

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
        },


        editor_leader_info: '',

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
            data = {team_layer_id, annual_plan_id};
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error('No Auditable Units Chosen.');
                } else {
                    $("#" + team_schedule_list_div).append(response);
                    $("#team_schedule_layer_btn_" + team_layer_id).hide();
                }
            })
        },

        deleteNode: function (type, node_id, from_tree) {

            var parent_timeline_content = $('#' + node_id).closest('.timeline-content');
            var layer_index = parent_timeline_content.data('layer_index');

            if (type === 'layer') {
                delete team_info[0];
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

                const node = node_id.split("_");
                delete team_info[0].team_members[node[1]];
                $('#team_information_' + layer_index).val(JSON.stringify(team_info));
                // delete Load_Team_Container.selected_designation_ids[designation_id];
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
                schedule_data = Load_Team_Container.makeAuditSchedule();
                schedule = {"schedule": schedule_data}
                team_schedules = JSON.stringify(schedule);
                audit_plan_id = $('.draft_entity_audit_plan').data('audit-plan-id');
                data = {team_schedules, audit_plan_id};
                ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                    if (response.status === 'success') {
                        toastr.success(response.data);
                        $(".field_level_visited_units_and_locations").html(Load_Team_Container.insertAuditFieldVisitUnitListInBook());
                        Load_Team_Container.insertAuditScheduleListInBook();
                    } else {
                        toastr.error(response.data);
                        console.log(response)
                    }
                })
            } else {
                toastr.error('Please Make Schedule');
            }
        },

        makeAuditTeam: function () {
            layer_id = 0;
            list_group = $('[id^=list_group_]');
            team_leader = {};
            leader_info = {};
            list_group.each(function (index, value) {
                team_members = {};
                $('p[id^=permitted_]').each(function (i, v) {
                    if (layer_id != $('#' + v.id).attr('data-layer')) {
                        team_members = {};
                        team_schedule = {};
                        layer_id == $('#' + v.id).attr('data-layer');
                    }
                    role = $('#' + v.id).attr('data-member-role');
                    if (role == 'teamLeader') {
                        role_bn = 'দলনেতা';
                    } else if (role == 'subTeamLeader') {
                        role_bn = 'উপ দলনেতা';
                    } else if (role == 'member') {
                        role_bn = 'সদস্য';
                    }
                    data_content = $('#' + v.id).attr('data-content');
                    content = JSON.parse(data_content);
                    officer_id = content.officer_id;
                    layer_id = $('#' + v.id).attr('data-layer');

                    if (role in team_members == false) {
                        team_members[role] = {};
                    }

                    content['team_member_role_en'] = role;
                    content['team_member_role_bn'] = role_bn;
                    team_members[role][officer_id] = content;

                    if (layer_id in leader_info == false) {
                        leader_info[layer_id] = {};
                    }

                    team_name = $('#permitted_level_' + layer_id).find('.layer_text').html();
                    if (layer_id == 1) {
                        team_type = 'parent';
                        if (role == 'teamLeader') {
                            leader_info[layer_id] = {
                                officer_name_en: content.officer_name_en,
                                officer_name_bn: content.officer_name_bn,
                                designation_en: content.designation_en,
                                designation_bn: content.designation_bn,
                                designation_id: content.designation_id,
                                officer_id: content.officer_id,
                            };
                            team_leader = content;
                        }
                    } else {
                        team_type = 'sub';
                        if (role == 'subTeamLeader') {
                            leader_info[layer_id] = {
                                officer_name_en: content.officer_name_en,
                                officer_name_bn: content.officer_name_bn,
                                designation_en: content.designation_en,
                                designation_bn: content.designation_bn,
                                designation_id: content.designation_id,
                                officer_id: content.officer_id,
                            };
                        }
                    }
                    if ('all_teams' in all_teams == false) {
                        all_teams['all_teams'] = {};
                    }
                    if (layer_id in all_teams == false) {
                        all_teams['all_teams'][layer_id] = {};
                    }

                    all_teams['team_start_date'] = formatDate($('#team_start_date').val());
                    all_teams['team_end_date'] = formatDate($('#team_end_date').val());
                    all_teams['leader'] = team_leader;
                    all_teams['all_teams'][layer_id]['team_name'] = team_name;
                    all_teams['all_teams'][layer_id]['team_type'] = team_type;
                    all_teams['all_teams'][layer_id]['leader_designation_id'] = leader_info[layer_id]['designation_id'];
                    all_teams['all_teams'][layer_id]['leader_name_en'] = leader_info[layer_id]['officer_name_en'];
                    all_teams['all_teams'][layer_id]['leader_name_bn'] = leader_info[layer_id]['officer_name_bn'];
                    all_teams['all_teams'][layer_id]['leader_designation_en'] = leader_info[layer_id]['designation_en'];
                    all_teams['all_teams'][layer_id]['leader_designation_bn'] = leader_info[layer_id]['designation_bn'];
                    all_teams['all_teams'][layer_id]['leader_officer_id'] = leader_info[layer_id]['officer_id'];
                    all_teams['all_teams'][layer_id]['members'] = team_members;
                })
            })

            return all_teams;
        },

        makeAuditSchedule: function () {
            team_schedule = {};
            $('[id^=audit_schedule_table_]').each(function (i, v) {
                layer_id = v.id.split('_')[3]
                if ($('[id^=permitted_level_]').length == 1) {
                    leader_info = JSON.parse($('#list_group_' + layer_id + ' [data-member-role="teamLeader"]').attr('data-content'));
                } else {
                    leader_info = JSON.parse($('#list_group_' + layer_id + ' [data-member-role="subTeamLeader"]').attr('data-content'));
                }
                if (leader_info.designation_id in team_schedule == false) {
                    team_schedule[leader_info.designation_id] = {};
                }
                cost_center_id = '';
                cost_center_name_en = '';
                cost_center_name_bn = '';
                team_member_start_date = '';
                team_member_end_date = '';
                activity_man_days = '';
                activity_detail_date = '';
                activity_details = '';
                $(".audit_schedule_row_" + layer_id + " input, .audit_schedule_row_" + layer_id + " select").each(function () {
                    if ($(this).is("select")) {
                        cost_center_id = $(this).find(':selected').attr('data-cost-center-id');
                        cost_center_name_en = $(this).find(':selected').attr('data-cost-center-name-en');
                        cost_center_name_bn = $(this).find(':selected').attr('data-cost-center-name-bn');
                    }

                    if (!$(this).is('select')) {
                        if ($(this).hasClass('input-start-duration')) {
                            team_member_start_date = formatDate($(this).val());
                        }
                        if ($(this).hasClass('input-end-duration')) {
                            team_member_end_date = formatDate($(this).val());
                        }
                        if ($(this).hasClass('input-total-working-day')) {
                            activity_man_days = $(this).val();
                        }
                        if ($(this).hasClass('input-detail-duration')) {
                            activity_detail_date = $(this).val();
                        }
                        if ($(this).hasClass('input-detail')) {
                            activity_details = $(this).val();
                        }
                    }

                    schedule_data = {
                        cost_center_id,
                        cost_center_name_en,
                        cost_center_name_bn,
                        team_member_start_date,
                        team_member_end_date,
                        activity_man_days,
                        activity_detail_date,
                        activity_details,
                    };

                    if (schedule_data.cost_center_id in team_schedule[leader_info.designation_id] == false && typeof schedule_data.cost_center_id !== 'undefined') {
                        team_schedule[leader_info.designation_id][schedule_data.cost_center_id] = {};
                    }
                    if (typeof schedule_data.cost_center_id !== 'undefined') {
                        team_schedule[leader_info.designation_id][schedule_data.cost_center_id] = schedule_data;
                    }

                });
            });
            all_schedules = team_schedule;
            return all_schedules;
        },

        saveAuditTeam: function () {
            url = '{{route('audit.plan.audit.revised.plan.store-audit-team')}}';
            annual_plan_id = '{{$annual_plan_id}}';
            audit_plan_id = $('.draft_entity_audit_plan').data('audit-plan-id');
            activity_id = '{{$activity_id}}';
            fiscal_year_id = '{{$fiscal_year_id}}';
            audit_year_start = $('#audit_year_start').val();
            audit_year_end = $('#audit_year_end').val();
            teams = Load_Team_Container.makeAuditTeam();

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
            $('.audit_team_leader').html(Load_Team_Container.editor_leader_info);
            $('.audit_team_number').html($('#permitted_level_1').find('.layer_text').html());
            $('.proposed_date_commencement_audit').html($('#permitted_level_1').find('.layer_text').html());
            $('.proposed_date_completion_audit').html($('#permitted_level_1').find('.layer_text').html());
            Load_Team_Container.insertAuditTeamListInBook();
            templateArray.map(function (value, index) {
                cover = $("#pdfContent_" + value.content_id).html();
                value.content = cover;
            });
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
                $("#team_schedule_layer_btn_" + 1).hide();
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
                    $(".audit_team_schedules").append(Load_Team_Container.createAuditScheduleTable(totalTableArrayData[i][j]));
                    //console.log(totalTableArrayData[i][j]);
                }
            }
        },

        createAuditScheduleTable: function (scheduleList) {
            rowNumber = 1;
            htmlTable = `
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

                if (scheduleList[i].hasOwnProperty('team_member_activity')) {
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

        },

        //for insert audit field audit list
        insertAuditFieldVisitUnitListInBook: function () {
            unitVisitHtmlTable = `
                    <table width="100%" border="1">
                        <thead>
                        <tr>
                            <th class="text-center" width="10%">ক্রমিক নং</th>
                            <th class="text-center" width="90%">শাখার নাম</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th class="text-center">১</th>
                            <th class="text-center">২</th>
                        </tr>
                `;

            if (!$.isEmptyObject(auditSchedule)) {

                resultScheduleList = [];
                for (var scheduleData in auditSchedule) {
                    for (var key in auditSchedule[scheduleData]) {
                        resultScheduleList.push([key, auditSchedule[scheduleData][key]]);
                    }
                }

                fieldVisitUnitList = [];
                for (var startResultSchedule = 0; startResultSchedule < resultScheduleList.length; startResultSchedule++) {
                    for (var j = 1; j < resultScheduleList[startResultSchedule].length; j++) {
                        fieldVisitUnitList.push(resultScheduleList[startResultSchedule][j].cost_center_name_bn);
                    }
                }

                var uniqueFieldVisitUnitList = [];
                $.each(fieldVisitUnitList, function (i, el) {
                    if ($.inArray(el, uniqueFieldVisitUnitList) === -1) uniqueFieldVisitUnitList.push(el);
                });

                uniqueFieldVisitUnitList.forEach((unitName, index) => {
                    unitVisitHtmlTable += '<tr>' +
                        '<td class="text-center">' + BnFromEng(index + 1) + '</td>' +
                        '<td class="text-center">' + unitName + '</td>' +
                        '</tr>';
                });
            }

            unitVisitHtmlTable += ` </tbody>
            </table>`;

            return unitVisitHtmlTable;
        }
    };
</script>
