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
        content: "Please drop officer here!"; /*\f054*/
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
        font-family: 'Font Awesome 5 Free', 'SolaimanLipi', serif;
        margin: 0 2px;
        border-radius: 5px;
    }

    .field-icon {
        float: right;
        margin-left: -25px;
        margin-right: 10px;
        margin-top: -25px;
        position: relative;
        z-index: 2;
    }

    .layer_text{
        font-size:15px;
        font-weight:bold;
        border: none;
        background: none
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
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                style="color:#3699FF !important"
                                                class="fa fa-calendar" aria-hidden="true"></i></span></div>
                                    <input type="text" id="audit_year_start"
                                           class="year-picker form-control"
                                           placeholder="নিরীক্ষাধীন অর্থ বছর শুরু"
                                           value="{{empty($all_teams) || empty($all_teams[0]['audit_year_start'])?'':$all_teams[0]['audit_year_start']}}"
                                           autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                style="color:#3699FF !important"
                                                class="fa fa-calendar" aria-hidden="true"></i></span></div>
                                    <input type="text" id="audit_year_end"
                                           class="year-picker form-control"
                                           value="{{empty($all_teams) || empty($all_teams[0]['audit_year_end'])?'':$all_teams[0]['audit_year_end']}}"
                                           placeholder="নিরীক্ষাধীন অর্থ বছর শেষ" autocomplete="off"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                style="color:#3699FF !important"
                                                class="fa fa-calendar" aria-hidden="true"></i></span></div>
                                    <input type="text" id="team_start_date"
                                           class="date form-control"
                                           value="{{empty($all_teams) || empty($all_teams[0]['team_start_date'])?'':date('d/m/Y',strtotime($all_teams[0]['team_start_date']))}}"
                                           placeholder="সম্পাদনের সময়কাল শুরু" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                style="color:#3699FF !important"
                                                class="fa fa-calendar" aria-hidden="true"></i></span></div>
                                    <input type="text" id="team_end_date"
                                           class="date form-control"
                                           value="{{empty($all_teams) || empty($all_teams[0]['team_end_date'])?'':date('d/m/Y',strtotime($all_teams[0]['team_end_date']))}}"
                                           placeholder="সম্পাদনের সময়কাল শেষ" autocomplete="off"/>
                                </div>
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
                                        <input id="officer_search" type="text" class="form-control mb-1"
                                               placeholder="অফিসার খুঁজুন">
                                        <div class="rounded-0  office_organogram_tree_div"
                                             style="overflow-y: scroll; height: 60vh">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade border border-top-0 p-3" id="set_other_office" role="tabpanel"
                                 aria-labelledby="other_office-tab">

                                <div class="row">
                                    <div class="col-md-12">
                                        <select class="form-control select-select2" id="other_office">
                                            @foreach($other_offices as $other_office)
                                                <option
                                                    value="{{$other_office['id']}}">{{$other_office['office_name_eng']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 other_officers_list_area">
                                        <input id="other_officer_search" type="text" class="form-control mb-1"
                                               placeholder="অফিসার খুঁজুন">
                                        <div class="rounded-0  other_office_organogram_tree_div"
                                             style="overflow-y: scroll; height: 60vh">
                                        </div>
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
                                                    <div
                                                        class="custom-timeline-item timeline-item border-left-0 d-flex align-items-start"
                                                        style="padding-left: 5px;">
                                                        {{--<div class="timeline-media position-relative">
                                                            <i class="fas fa-chair text-primary"></i>
                                                        </div>--}}
                                                        <div class="timeline-content rounded-0 p-0 w-100"
                                                             data-layer_index="{{$loop->iteration}}"
                                                             id="permitted_level_{{$loop->iteration}}">
                                                            <div
                                                                class="px-3 pt-2 pb-0 mb-0 d-flex align-items-center justify-content-between">

                                                                <div>
                                                                    <span class="text-primary fal fa-edit"></span>
                                                                    <input type="text" value="{{$value['team_name']}}"
                                                                           class="layer_text text-dark-75 text-hover-primary font-weight-bold p-2">
                                                                </div>

                                                                {{--<h5 class="layer_text text-dark-75 text-hover-primary font-weight-bold p-2"
                                                                    style="width: 60%;">{{$value['team_name']}}
                                                                </h5>--}}

                                                                <div
                                                                    class="d-flex align-items-center justify-content-end">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between mb-0 mt-0">
                                                                        <div class="mr-2">
                                                                            {{--                                                                            @if($value['team_parent_id'])--}}
                                                                            <button type="button"
                                                                                    id="team_schedule_layer_btn_{{$loop->iteration}}"
                                                                                    onclick="Load_Team_Container.loadTeamSchedule('team_schedule_list_{{$loop->iteration}}','{{$loop->iteration}}')"
                                                                                    class="justify-self-end text-danger btn btn-icon btn-md">
                                                                                <i class="text-primary far fa-calendar-alt"></i>
                                                                            </button>
                                                                            {{--@endif--}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="dragged_data_area px-2 pt-0"
                                                                 id="right_drop_zone_{{$loop->iteration}}">
                                                                <ul class="listed_items rounded-0 list-group"
                                                                    id="list_group_{{$loop->iteration}}">
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
                                                                                <p data-content="{{json_encode($member, JSON_UNESCAPED_UNICODE)}}"
                                                                                   data-member-role="{{$member['team_member_role_en']}}"
                                                                                   data-layer="{{$loop->parent->parent->iteration}}"
                                                                                   class="assignedMember_{{$member['designation_id']}}_{{$loop->parent->parent->iteration}} p-0 mb-0 permitted_designation"
                                                                                   id="permitted_{{$member['designation_id']}}"
                                                                                   data-id="{{$loop->parent->parent->iteration}}">
                                                                                    <i class="far fa-user"></i><span
                                                                                        class="ml-2 mr-2">{{$member['officer_name_bn']}}</span>
                                                                                    <small>{{$member['designation_bn']}}
                                                                                        , {{$member['unit_name_bn']}}</small>

                                                                                    @if(!$value['team_parent_id'])

                                                                                        <button type="button"
                                                                                                data-designation-id="{{$member['designation_id']}}"
                                                                                                onclick="Load_Team_Container.memberRole($(this), '{{$loop->parent->parent->iteration}}' , 'teamLeader', '{{$member['designation_id']}}')"
                                                                                                class="teamLeaderBtn btn btn-xs signatory_layer text-primary">
                                                                                            <i data-value="@if($member['team_member_role_en'] == 'teamLeader') 1 @else 0 @endif"
                                                                                               class="far text-primary @if($member['team_member_role_en'] == 'teamLeader') fa-dot-circle @else fa-circle @endif "></i>দলনেতা
                                                                                        </button>

                                                                                    @endif

                                                                                    <button type="button"
                                                                                            data-designation-id="{{$member['designation_id']}}"
                                                                                            onclick="Load_Team_Container.memberRole($(this), '{{$loop->parent->parent->iteration}}' , 'subTeamLeader', '{{$member['designation_id']}}')"
                                                                                            class="subTeamLeaderBtn btn btn-xs signatory_layer text-primary">
                                                                                        <i data-value="@if($member['team_member_role_en'] == 'subTeamLeader') 1 @else 0 @endif"
                                                                                           class="far text-primary @if($member['team_member_role_en'] == 'subTeamLeader') fa-dot-circle @else fa-circle @endif "></i>উপ
                                                                                        দলনেতা
                                                                                    </button>
                                                                                    <button type="button"
                                                                                            data-designation-id="{{$member['designation_id']}}"
                                                                                            onclick="Load_Team_Container.memberRole($(this), '{{$loop->parent->parent->iteration}}' , 'member', '{{$member['designation_id']}}')"
                                                                                            class="memberBtn btn btn-xs signatory_layer text-primary">
                                                                                        <i data-value="@if($member['team_member_role_en'] == 'member') 1 @else 0 @endif"
                                                                                           class="far text-primary @if($member['team_member_role_en'] == 'member') fa-dot-circle @else fa-circle @endif "></i>সদস্য
                                                                                    </button>
                                                                                    <button type="button"
                                                                                            onclick="Load_Team_Container.deleteNode('designation','permitted_{{$member['designation_id']}}', 0)"
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

                                                                <div class="audit_schedule_list_div">
                                                                    <table
                                                                        id="audit_schedule_table_{{$loop->iteration}}"
                                                                        class="audit-schedule-table table table-bordered table-striped table-hover table-condensed table-sm text-center">
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
                                                                                            onclick="removeAuditScheduleListDiv({{$loop->iteration}})"
                                                                                            class="btn btn-icon btn-outline-danger border-0 btn-xs mr-2 remove_audit_schedule_list_div">
                                                                                <span
                                                                                    class="fal fa-trash-alt"></span>
                                                                                    </button>
                                                                                </div>
                                                                            </th>
                                                                        </tr>
                                                                        </thead>

                                                                        <div class="px-2 pt-0" id="team_schedule_list_{{$loop->iteration}}">
                                                                        @foreach($team_schedules as $key => $schedule)
                                                                            @php
                                                                                $schedule_type = Arr::has($schedule, 'schedule_type') ? $schedule['schedule_type'] : 'schedule'
                                                                            @endphp

                                                                            @if($schedule_type == 'schedule')
                                                                                <tbody
                                                                                    data-tbody-id="{{$loop->parent->iteration}}_{{$loop->iteration}}"
                                                                                    data-schedule-type="{{$schedule_type}}">
                                                                                <tr class='audit_schedule_row_{{$loop->parent->iteration}}'
                                                                                    data-layer-id="{{ $loop->parent->iteration }}"
                                                                                    data-audit-schedule-first-row='{{$loop->iteration}}_{{ $loop->parent->iteration }}'>
                                                                                    <td>
                                                                                        <select
                                                                                            id="branch_name_select_{{ $loop->parent->iteration }}_{{$loop->iteration}}"
                                                                                            class="form-control select-select2 input-branch-name"
                                                                                            data-id="{{ $loop->parent->iteration }}_{{$loop->iteration}}">
                                                                                            <option value=''>
                                                                                                --Select--
                                                                                            </option>
                                                                                            @foreach($nominated_offices_list as $key => $nominatedOffice)
                                                                                                <option
                                                                                                    @if($nominatedOffice['id'] == $schedule['cost_center_id']) selected
                                                                                                    @endif value="{{$nominatedOffice['id']}}"
                                                                                                    data-cost-center-id="{{$nominatedOffice['id']}}"
                                                                                                    data-cost-center-name-bn="{{$nominatedOffice['office_name_bng']}}"
                                                                                                    data-cost-center-name-en="{{$nominatedOffice['office_name_eng']}}">{{$nominatedOffice['office_name_bng']}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="row">
                                                                                            <div class="col pr-0">
                                                                                                <input type="text"
                                                                                                       data-id="{{ $loop->parent->iteration }}_{{$loop->iteration}}"
                                                                                                       class="date form-control input-start-duration"
                                                                                                       value="{{date('d/m/Y',strtotime($schedule['team_member_start_date']))}}"
                                                                                                       placeholder="শুরু"/>
                                                                                            </div>
                                                                                            <div class="col pl-0">
                                                                                                <input type="text"
                                                                                                       data-id="{{ $loop->parent->iteration }}_{{$loop->iteration}}"
                                                                                                       class="date form-control input-end-duration"
                                                                                                       value="{{date('d/m/Y',strtotime($schedule['team_member_end_date']))}}"
                                                                                                       placeholder="শেষ"/>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>

                                                                                    <td>
                                                                                        <input type="number"
                                                                                               min="0"
                                                                                               data-id="{{ $loop->parent->iteration }}_{{$loop->iteration}}"
                                                                                               class="form-control input-total-working-day"
                                                                                               value="{{$schedule['activity_man_days']}}"
                                                                                               id="input_total_working_day_{{$loop->parent->iteration}}_{{$loop->iteration}}"/>
                                                                                    </td>
                                                                                    <td style="display: inline-flex;">
                                                                                        <button type="button" title="schedule"
                                                                                                onclick="addAuditScheduleTblRow({{$loop->parent->iteration}})"
                                                                                                class="btn btn-icon btn-outline-success border-0 btn-xs mr-2">
                                                                                            <span
                                                                                                class="fad fa-calendar-day"></span>
                                                                                        </button>

                                                                                        <button type="button" title="visit"
                                                                                                onclick="addDetailsTblRow({{ $loop->parent->iteration }})"
                                                                                                class="btn btn-icon btn-outline-warning border-0 btn-xs mr-2">
                                                                                            <span
                                                                                                class="fad fa-plus"></span>
                                                                                        </button>

                                                                                        <button type='button' title="remove"
                                                                                                data-row='row1'
                                                                                                onclick="removeScheduleRow($(this), {{ $loop->parent->iteration }})"
                                                                                                class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2'>
                                                                                        <span
                                                                                            class='fal fa-trash-alt'></span>
                                                                                        </button>
                                                                                    </td>
                                                                                </tr>
                                                                                </tbody>

                                                                            @elseif($schedule_type == 'visit')
                                                                                <tbody
                                                                                    data-tbody-id="{{ $loop->parent->iteration }}_{{$loop->iteration}}"
                                                                                    data-schedule-type="{{$schedule_type}}">
                                                                                <tr class="audit_schedule_row_{{ $loop->parent->iteration }}"
                                                                                    data-layer-id="{{ $loop->parent->iteration }}"
                                                                                    data-schedule-second-row="{{$loop->iteration}}_{{ $loop->parent->iteration }}">
                                                                                    <td>
                                                                                        <input type="text"
                                                                                               data-id="{{ $loop->parent->iteration }}_{{$loop->iteration}}"
                                                                                               value="{{$schedule['activity_details']}}"
                                                                                               class="form-control input-detail"/>
                                                                                    </td>

                                                                                    <td colspan="2">
                                                                                        <input type="text"
                                                                                               data-id="{{ $loop->parent->iteration }}_{{$loop->iteration}}"
                                                                                               value="{{$schedule['team_member_start_date'] == ""?"":formatDate($schedule['team_member_start_date'])}}"
                                                                                               class="date form-control input-detail-duration"/>
                                                                                        <span class="fal fa-calendar field-icon"></span>
                                                                                    </td>

                                                                                    <td style="display: inline-flex;">
                                                                                        <button type="button" title="schedule"
                                                                                                onclick="addAuditScheduleTblRow({{ $loop->parent->iteration }})"
                                                                                                class="btn btn-icon btn-outline-success border-0 btn-xs mr-2">
                                                                                            <span
                                                                                                class="fad fa-calendar-day"></span>
                                                                                        </button>

                                                                                        <button type="button" title="visit"
                                                                                                onclick="addDetailsTblRow({{ $loop->parent->iteration }})"
                                                                                                class="btn btn-icon btn-outline-warning border-0 btn-xs mr-2">
                                                                                            <span
                                                                                                class="fad fa-plus"></span>
                                                                                        </button>

                                                                                        <button type='button' title="remove"
                                                                                                data-row='row1'
                                                                                                onclick="removeScheduleRow($(this), {{ $loop->parent->iteration }})"
                                                                                                class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2'>
                                                                                            <span
                                                                                                class='fal fa-trash-alt'></span>
                                                                                        </button>
                                                                                    </td>
                                                                                </tr>
                                                                                </tbody>
                                                                            @endif
                                                                        @endforeach
                                                                        </div>
                                                                    </table>
                                                                </div>
                                                            @else
                                                                <div class="px-2 pt-0" id="team_schedule_list_{{$loop->iteration}}"></div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <script>
                                                        //working days
                                                        $(document).on('change', '.audit_schedule_row_{{$loop->iteration}} input', function () {
                                                            populateData(this);
                                                        });
                                                    </script>
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
                                    @if(empty($all_teams)) onclick="Load_Team_Container.saveAuditTeam('save')"
                                    @else onclick="Load_Team_Container.saveAuditTeam('update')" @endif><i
                                    class="fad fa-cloud"></i>সংরক্ষণ
                                করুন
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary btn-square"
                                    id="dismissTeamModal" onclick="$('.ki-close').click()"><i
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

    function removeScheduleRow(elem, layer_id) {
        elem.closest("tr").remove();
    }

    function removeAuditScheduleListDiv(layer_id) {
        $("#audit_schedule_table_" + layer_id).remove();
        $("#team_schedule_layer_btn_" + layer_id).show();
    }

    //working days
    function populateData(element) {
        id = $(element).data("id");
        currentInputValue = $(element).val();

        if ($(element).hasClass('input-end-duration')) {
            let startDuration = $(element).closest('tr').find('.input-start-duration').val();
            startDurationData = startDuration.split("/");
            endDurationData = currentInputValue.split("/");
            startDateFormat = startDurationData[1] + '/' + startDurationData[0] + '/' + startDurationData[2];
            endDateFormat = endDurationData[1] + '/' + endDurationData[0] + '/' + endDurationData[2];
            totalDayDifference = calcWorkingDays(startDateFormat, endDateFormat);
            $("#input_total_working_day_" + id).val(totalDayDifference);
        }
    }

    function addAuditScheduleTblRow(layer_id) {
        var totalAuditScheduleRow = $('#audit_schedule_table_' + layer_id + ' tbody').length + 1;
        var teamScheduleHtml = "<tbody data-schedule-type='schedule' data-tbody-id='" + layer_id + "_" + totalAuditScheduleRow + "'>" +
            "<tr class='audit_schedule_row_" + layer_id + "' data-layer-id='" + layer_id + "' data-audit-schedule-first-row='" + totalAuditScheduleRow + "_" + layer_id + "'>";
        teamScheduleHtml += "<td>" +
            "<select id='branch_name_select_" + layer_id + "_" + totalAuditScheduleRow + "' class='form-control select-select2 input-branch-name' data-id='" + layer_id + "_" + totalAuditScheduleRow + "'>" +
            "<option value=''>--Select--</option>" +
            @foreach($nominated_offices_list as $key => $nominatedOffice)
                "<option value='{{$nominatedOffice['id']}}' data-cost-center-id='{{$nominatedOffice['id']}}' data-cost-center-name-bn='{{$nominatedOffice['office_name_bng']}}' data-cost-center-name-en='{{$nominatedOffice['office_name_eng']}}'>{{$nominatedOffice['office_name_bng']}}</option>" +
            @endforeach
                "</select></td>";

        teamScheduleHtml += "<td><div class='row'><div class='col pr-0'><input type='text' " +
            "class='date form-control input-start-duration' data-id='" + layer_id + "_" + totalAuditScheduleRow + "' placeholder='শুরু'/></div><div class='col pl-0'>" +
            "<input type='text' class='date form-control input-end-duration' data-id='" + layer_id + "_" + totalAuditScheduleRow + "' placeholder='শেষ'/>" +
            "</div></div></td>"
        teamScheduleHtml += "<td><input type='number' min='0' value='0' class='form-control input-total-working-day' id='input_total_working_day_" + layer_id + "_" + totalAuditScheduleRow + "' data-id='" + layer_id + "_" + totalAuditScheduleRow + "'/></td>";
        teamScheduleHtml += "<td style='display: inline-flex'>" +
            "<button title='schedule' type='button' onclick='addAuditScheduleTblRow(" + layer_id + ")' class='btn btn-icon btn-outline-success border-0 btn-xs mr-2'>" +
            "<span class='fad fa-calendar-day'></span>" +
            "</button>" +
            "<button title='visit' type='button' onclick='addDetailsTblRow(" + layer_id + ")' class='btn btn-icon btn-outline-warning border-0 btn-xs mr-2'>" +
            "<span class='fad fa-plus'></span>" +
            "</button>" +
            "<button title='remove' onclick='removeScheduleRow($(this), " + layer_id + ")' type='button' " +
            "data-row='row" + totalAuditScheduleRow + "' class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2'>" +
            "<span class='fal fa-trash-alt'></span>" +
            "</button>" +
            "</td>";
        teamScheduleHtml += "</tr></tbody>";

        $('#audit_schedule_table_' + layer_id).append(teamScheduleHtml);
        $('.select-select2').select2();
    }

    function addDetailsTblRow(layer_id) {
        var totalAuditScheduleRow = $('#audit_schedule_table_' + layer_id + ' tbody').length + 1;
        var teamScheduleHtml = "<tbody data-schedule-type='visit' data-tbody-id='" + layer_id + "_" + totalAuditScheduleRow + "'>" +
            "<tr class='audit_schedule_row_" + layer_id + "' data-layer-id='" + layer_id + "' data-audit-schedule-first-row='" + totalAuditScheduleRow + "_" + layer_id + "'>";
        teamScheduleHtml += "<td><input type='text' data-id='" + layer_id + "_" + totalAuditScheduleRow + "' class='form-control input-detail'/></td>";
        teamScheduleHtml += "<td colspan='2'><div><input type='text' data-id='" + layer_id + "_" + totalAuditScheduleRow + "' class='date form-control input-detail-duration'/><span class='fal fa-calendar field-icon'></span></div></td>";
        teamScheduleHtml += "<td style='display: inline-flex'>" +
            "<button title='schedule' type='button' onclick='addAuditScheduleTblRow(" + layer_id + ")' class='btn btn-icon btn-outline-success border-0 btn-xs mr-2'>" +
            "<span class='fad fa-calendar-day'></span>" +
            "</button>" +
            "<button title='visit' type='button' onclick='addDetailsTblRow(" + layer_id + ")' class='btn btn-icon btn-outline-warning border-0 btn-xs mr-2'>" +
            "<span class='fad fa-plus'></span>" +
            "</button>" +
            "<button title='remove' onclick='removeScheduleRow($(this), " + layer_id + ")' type='button' " +
            "data-row='row" + totalAuditScheduleRow + "' class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2'>" +
            "<span class='fal fa-trash-alt'></span>" +
            "</button>" +
            "</td>";
        teamScheduleHtml += "</tr></tbody>";

        $('#audit_schedule_table_' + layer_id).append(teamScheduleHtml);
    }

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


    $('#officer_search').keyup(function () {
        $('.office_organogram_tree').jstree(true).show_all();
        $('.office_organogram_tree').jstree('search', $(this).val());
    });

    $('#other_officer_search').keyup(function () {
        $('.other_office_organogram_tree').jstree(true).show_all();
        $('.other_office_organogram_tree').jstree('search', $(this).val());
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
            if ($(data.event.target).parents('.office_organogram_tree').length) {
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
        editor_leader_info: '',
        load_level_selection_panel: 0,
        selected_designation_ids: JSON.parse('{"228237":228237,"22418":22418}'),

        loadOfficer: function (office_id, office_type) {
            tree_area_div = office_type == 'own_office' ? '.office_organogram_tree_div' : '.other_office_organogram_tree_div';
            KTApp.block(tree_area_div, {
                overlayColor: '#000',
                opacity: 0.1,
                state: 'danger',
                message: 'Loading...'
            });
            url = '{{route('audit.plan.audit.revised.plan.load-officer-lists')}}';
            data = {office_id, office_type};
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock(tree_area_div);
                if (response.status === 'error') {
                    toastr.error('Internal Serve Error');
                } else {
                    $(tree_area_div).html(response);
                }
            })
        },

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
            if (layer_index == $('[id^=permitted_level_]').first().attr('data-layer_index')) {
                node_html = node_html + `<button type="button" data-designation-id=${data_content.designation_id} onclick="Load_Team_Container.memberRole($(this), ${layer_index} , 'teamLeader', ${data_content.designation_id})" class="teamLeaderBtn btn btn-xs signatory_layer text-primary"><i data-value="0" class="far text-primary fa-circle"></i>দলনেতা</button>`;
                Load_Team_Container.editor_leader_info = data_content.officer_name_bn + ', ' + data_content.designation_bn + ', ' + data_content.unit_name_bn + '|';
            }

            node_html = node_html + `<button type="button" data-designation-id=${data_content.designation_id} onclick="Load_Team_Container.memberRole($(this), ${layer_index} , 'subTeamLeader', ${data_content.designation_id})" class="subTeamLeaderBtn btn btn-xs signatory_layer text-primary"><i data-value="0" class="far text-primary fa-circle"></i>উপ দলনেতা</button>
<button type="button" data-designation-id=${data_content.designation_id} onclick="Load_Team_Container.memberRole($(this), ${layer_index} , 'member', ${data_content.designation_id})" class="memberBtn btn btn-xs signatory_layer text-primary"><i data-value="1" class="far text-primary fa-dot-circle"></i>সদস্য</button>
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


        memberRole: function (elem, layer_index, role, designation_id) {
            $('.assignedMember_' + designation_id + '_' + layer_index).attr('data-member-role', role);
            designation_id = elem.data('designation-id');
            if (elem.find('i').hasClass('fa-circle')) {
                elem.find('i').removeClass('fa-circle').addClass('far fa-dot-circle')
                elem.find('i').attr('data-value', 1);
                elem.parent('p').attr('data-member-role', role)
            } else {
                elem.find('i').removeClass('fa-dot-circle').addClass('far fa-circle')
                elem.find('i').attr('data-value', 0);
                elem.parent('p').attr('data-member-role', '')
            }
            if (role === 'member') {
                $('.assignedMember_' + designation_id + '_' + layer_index + ' .teamLeaderBtn').find('i').removeClass('fa-dot-circle').addClass('fa-circle');
                $('.assignedMember_' + designation_id + '_' + layer_index + ' .subTeamLeaderBtn').find('i').removeClass('fa-dot-circle').addClass('fa-circle');
            } else if (role === 'teamLeader') {
                data_content = $('.assignedMember_' + designation_id + '_' + layer_index).data('content');
                Load_Team_Container.editor_leader_info = data_content.officer_name_bn + ', ' + data_content.designation_bn + ', ' + data_content.unit_name_bn + '|';
                $('.assignedMember_' + designation_id + '_' + layer_index + ' .memberBtn').find('i').removeClass('fa-dot-circle').addClass('fa-circle');
                $('.assignedMember_' + designation_id + '_' + layer_index + ' .subTeamLeaderBtn').find('i').removeClass('fa-dot-circle').addClass('fa-circle');
            } else if (role === 'subTeamLeader') {
                $('.assignedMember_' + designation_id + '_' + layer_index + ' .teamLeaderBtn').find('i').removeClass('fa-dot-circle').addClass('fa-circle');
                $('.assignedMember_' + designation_id + '_' + layer_index + ' .memberBtn').find('i').removeClass('fa-dot-circle').addClass('fa-circle');
            }
        },

        loadTeamSchedule: function (team_schedule_list_div, team_layer_id) {
            url = '{{route('audit.plan.audit.editor.load-audit-team-schedule')}}';
            annual_plan_id = '{{$annual_plan_id}}';
            parent_office_id = '{{$parent_office_id}}';
            data = {team_layer_id, annual_plan_id, parent_office_id};
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
                    // $('.office_organogram_tree').jstree(true).enable_node("#ofc_org_designation_" + $(this).data('id'));
                    // $('.office_organogram_tree').jstree(true).uncheck_node("#ofc_org_designation_" + $(this).data('id'));
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
                // $('.office_organogram_tree').jstree(true).enable_node("#ofc_org_designation_" + designation_id);
                // $('.office_organogram_tree').jstree(true).uncheck_node("#ofc_org_designation_" + designation_id);
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

                    team_name = $('#permitted_level_' + layer_id).find('.layer_text').val();
                    if (layer_id == $('[id^=permitted_level_]').first().attr('data-layer_index')) {
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
            console.log(all_teams);
            return all_teams;
        },

        makeAuditSchedule: function () {
            team_schedule = {};
            $('[id^=audit_schedule_table_]').each(function (i, v) {
                layer_id = v.id.split('_')[3]
                if ($('#list_group_' + layer_id + ' [data-member-role="teamLeader"]').length > 0 || $('[id^=permitted_level_]').length == 1) {
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
                activity_details = '';
                schedule_type = '';

                $(".audit_schedule_row_" + layer_id + " input, .audit_schedule_row_" + layer_id + " select").each(function () {
                    tbodyId = $(this).closest('tbody').data('tbody-id');
                    tbodySerialId = tbodyId.split('_');
                    //console.log(tbodyId)

                    schedule_type = $(this).closest('tbody').data('schedule-type');
                    if (schedule_type === 'visit') {
                        cost_center_id = '';
                        cost_center_name_en = '';
                        cost_center_name_bn = '';
                        activity_man_days = '0';
                    } else {
                        activity_details = '';
                    }

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
                            team_member_start_date = $(this).val() === "" ? "" : formatDate($(this).val());
                            team_member_end_date = $(this).val() === "" ? "" : formatDate($(this).val());
                        }
                        if ($(this).hasClass('input-detail')) {
                            activity_details = $(this).val();
                        }
                    }

                    sequence_level = tbodySerialId[1];

                    schedule_data = {
                        cost_center_id,
                        cost_center_name_en,
                        cost_center_name_bn,
                        team_member_start_date,
                        team_member_end_date,
                        activity_man_days,
                        activity_details,
                        sequence_level,
                        schedule_type
                    };

                    if (schedule_data.cost_center_id in team_schedule[leader_info.designation_id] == false && typeof schedule_data.cost_center_id !== 'undefined') {
                        team_schedule[leader_info.designation_id][sequence_level] = {};
                    }
                    if (typeof schedule_data.cost_center_id !== 'undefined') {
                        team_schedule[leader_info.designation_id][sequence_level] = schedule_data;
                    }
                });
            });
            all_schedules = team_schedule;
            return all_schedules;
        },

        saveAuditTeam: function (mode = 'save') {
            url = mode === 'save' ? '{{route('audit.plan.audit.revised.plan.store-audit-team')}}' : '{{route('audit.plan.audit.revised.plan.update-audit-team')}}';
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
            KTApp.block('#saveAuditTeam');
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'success') {
                    toastr.success(response.data);
                    Load_Team_Container.saveAuditTeamSchedule(mode);
                    $('.draft_entity_audit_plan').click();
                    Load_Team_Container.insertTeamDataInBook();
                    Load_Team_Container.setJsonContentFromPlanBook();
                    $('#dismissTeamModal').click()
                } else {
                    toastr.error(response.data);
                    console.log(response)
                }
                KTApp.unblock('#saveAuditTeam');
            })
        },

        saveAuditTeamSchedule: function (mode = 'save') {
            url = mode === 'save' ? '{{route('audit.plan.audit.revised.plan.store-audit-team-schedule')}}' : '{{route('audit.plan.audit.revised.plan.update-audit-team-schedule')}}';
            schedule_data = Load_Team_Container.makeAuditSchedule();
            console.log(schedule_data);
            if (!$.isEmptyObject(schedule_data)) {
                schedule = {"schedule": schedule_data}
                team_schedules = JSON.stringify(schedule);
                audit_plan_id = $('.draft_entity_audit_plan').data('audit-plan-id');
                data = {team_schedules, audit_plan_id};
                ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                    if (response.status === 'success') {
                        toastr.success(response.data);
                        //$(".field_level_visited_units_and_locations").html(Load_Team_Container.insertAuditFieldVisitUnitListInBook());
                        Load_Team_Container.insertAuditScheduleListInBook();
                        Load_Team_Container.setJsonContentFromPlanBook();
                    } else {
                        toastr.error(response.data);
                        console.log(response)
                    }
                })
            } else {
                toastr.error('Please Make Schedule');
            }
        },

        insertTeamDataInBook: function () {
            //$('.audit_team_leader').html(Load_Team_Container.editor_leader_info);
            $('.audit_team_number').html($('#permitted_level_1').find('.layer_text').val());
            //$('.proposed_date_commencement_audit').html($('#permitted_level_1').find('.layer_text').text());
            $('.proposed_date_commencement_audit').text(BnFromEng($('#team_start_date').val())+' খ্রি:');
            $('.proposed_date_completion_audit').text(BnFromEng($('#team_end_date').val())+' খ্রি:');
            $('.duration_audit_performance').text(BnFromEng($('#team_start_date').val()) + ' খ্রি. হতে ' + BnFromEng($('#team_end_date').val()) + ' খ্রি. পর্যন্ত।');
            Load_Team_Container.insertAuditTeamListInBook();
        },

        setJsonContentFromPlanBook: function () {
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
            console.log(number)
            if (number === 1) {
                team_name = 'দল ' + enTobn(number);
            } else {
                subteamNumber = number - 1;
                team_name = 'উপদল ' + enTobn(subteamNumber);
                $("#team_schedule_layer_btn_" + 1).hide();
            }
            var level_html = `
                <div class="custom-timeline-item timeline-item border-left-0 d-flex align-items-start"
style="padding-left: 5px;">
                <!--<div class="timeline-media position-relative">
                    <i class="fas fa-chair text-primary"></i>
                </div>-->
    <div class="timeline-content rounded-0 p-0 w-100" data-layer_index="${number}" id="permitted_level_${number}">
        <div class="px-3 pt-2 pb-0 mb-0 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-primary fal fa-edit"></span>
                <input type="text" value="${team_name}"
                       class="layer_text text-dark-75 text-hover-primary font-weight-bold p-2">
            </div>
            <!--<h5 class="layer_text text-dark-75 text-hover-primary font-weight-bold p-2" style="width: 20%;">${team_name}</h5>-->
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
            auditTeamLeaderInfo = '';
            auditTeamMember = '';
            auditTeamMember += `<table width="100%" border="1">
                                <thead>
                                    <tr>
                                        <th class="text-center">ক্রমিক নং</th>
                                        <th class="text-center">নাম</th>
                                        <th class="text-center">সংশোধিত</th>
                                    </tr>
                                </thead>
                                <tbody>`;
            serial = 0;
            teamName = '';
            allTeamNameInfo = '';
            $.each(all_teams.all_teams, function (key, team) {
                if (team.team_type == 'parent') {
                    teamName = team.team_name;
                }

                allTeamNameInfo += team.team_name + ', ';
                $.each(team.members, function (key, members) {
                    $.each(members, function (key, member) {
                        serial++;
                        if (serial === 1){
                            auditTeamLeaderInfo = member.officer_name_bn+','+member.designation_bn;
                        }
                        auditTeamMember += '<tr>' +
                            '<td style="text-align: center">' + enTobn(serial) +'.'+ '</td>' +
                            '<td class="text-center">' + member.officer_name_bn+','+member.designation_bn + '</td>' +
                            '<td class="text-center"></td>' +
                            '</tr>';
                    });
                });
            });


            auditTeamMember += '</tbody></table>';

            //$(".audit_team_names").html(teamName);
            $(".seniority_wise_audit_engagement_team_member").html(auditTeamMember);
            //$(".audit_team_members").html(auditTeamMember);
            $(".audit_team_names").html(allTeamNameInfo);
            $(".audit_team_leader").html(auditTeamLeaderInfo);

        },

        insertAuditScheduleListInBook: function () {
            let totalAuditScheduleRow = $('.audit_schedule_view_list tbody tr').length;

            var totalTableArrayData = [];
            for (var i in all_schedules) {
                totalTableArrayData.push([i, all_schedules[i]]);
            }

            schedule = '';
            for (var i = 0; i < totalTableArrayData.length; i++) {
                //console.log(totalTableArrayData[i]);
                for (var j = 1; j < totalTableArrayData[i].length; j++) {
                    schedule += Load_Team_Container.createAuditScheduleTable(totalTableArrayData[i][j])
                    console.log(totalTableArrayData[i][j]);
                }
            }

            i = 0;
            auditTeamMember = '';
            teamName = '';
            $.each(all_teams.all_teams, function (key, team) {
                if (team.team_type == 'sub') {
                    teamName = team.team_name;
                    auditTeamMember += '<p><b>উপদল নং- </b>' + teamName + '</p>'
                    auditTeamMember += '<p><b>উপদল দলনেতা- </b>' + team.leader_name_bn + '</p>'
                    auditTeamMember += '<p><b>সদস্য: - </b></p>'
                    $.each(team.members, function (key, members) {
                        $.each(members, function (key, member) {
                            i++
                            auditTeamMember += '<p class="text-center">' + member.officer_name_bn , member.designation_bn + '</p>';

                        });
                    });
                }
            });

            $(".team_list").html(auditTeamMember);
            $(".audit_team_schedules").html(schedule);
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
            totalActivityManDays = 0;
            for (var i in scheduleList) {
                //console.log(scheduleList[i].cost_center_id);
                totalActivityManDays = totalActivityManDays + parseInt(scheduleList[i].activity_man_days);
                if (scheduleList[i].schedule_type == 'schedule') {
                    htmlTable += '<tr>' +
                        '<td style="text-align: center">' + BnFromEng(rowNumber) + '</td>' +
                        '<td style="text-align: center">' + scheduleList[i].cost_center_name_bn + '</td>' +
                        '<td style="text-align: center">২০২০-২০২১</td>' +
                        '<td style="text-align: center">' + BnFromEng(scheduleList[i].team_member_start_date) + ' হতে ' +
                        BnFromEng(scheduleList[i].team_member_end_date) + '</td>' +
                        '<td style="text-align: center">' + BnFromEng(scheduleList[i].activity_man_days) + ' কর্ম দিবস </td>' +
                        '</tr>';
                } else {
                    htmlTable += '<tr>' +
                        '<td style="text-align: center">' + BnFromEng(rowNumber) + '</td>' +
                        '<td colspan="4" style="text-align: center">' + BnFromEng(scheduleList[i].team_member_start_date) + ' খ্রি. ' + scheduleList[i].activity_details + '</td>' +
                        '</tr>';

                }
                rowNumber++;
            }

            htmlTable += `
                <tr>
                    <th colspan="4" style="text-align: right">সর্বমোট</th>
                    <th style="text-align: center">` + BnFromEng(totalActivityManDays) + ` কর্ম দিবস</th>
                </tr>
            </tbody>
            </table>`;

            return htmlTable;

        },

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

            if (!$.isEmptyObject(all_schedules)) {

                resultScheduleList = [];
                for (var scheduleData in all_schedules) {
                    for (var key in all_schedules[scheduleData]) {
                        resultScheduleList.push([key, all_schedules[scheduleData][key]]);
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

    $(function () {
        Load_Team_Container.loadOfficer(0, 'own_office');
    });

    $("select#other_office").change(function () {
        var office_id = $(this).children("option:selected").val();
        Load_Team_Container.loadOfficer(office_id, 'other_office');
    });
</script>
