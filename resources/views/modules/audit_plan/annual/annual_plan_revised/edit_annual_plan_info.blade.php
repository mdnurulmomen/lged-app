<x-title-wrapper>Edit Annual Plan</x-title-wrapper>

<div class="row ml-7 mr-7 pt-4">
    <div class="col-6">
        <div class="form-row">
            <div class="col-md-6">
                <label for="activity_id">অ্যাক্টিভিটি<span class="text-danger">*</span></label>
                <select class="form-control" name="activity_id" id="activity_id">
                    <option value="">অ্যাক্টিভিটি বাছাই করুন</option>
                    @foreach($all_activity as $activity)
                        <option @if($annual_plan_info['activity_id'] == $activity['id']) selected  @endif value="{{$activity['id']}}">{{$activity['title_bn']}} </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <input style="margin-top: 35px" type="radio" name="annual_plan_type" value="thematic" @if($annual_plan_info['annual_plan_type'] == 'thematic') checked @endif> Thematic
                <input type="radio" name="annual_plan_type" value="entity_based" @if($annual_plan_info['annual_plan_type'] == 'entity_based') checked @endif> Entity Based
            </div>

            <div class="col-md-6" style="display: none">
                <label for="milestone_id">মাইলস্টোন<span class="text-danger">*</span></label>
                <select class="form-control" name="milestone_id" id="milestone_id">
                    <option value="">মাইলস্টোন বাছাই করুন</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="row ml-7 mr-7 pt-4">
    <div class="col-6">
        <div class="annual_entity_selection_area">
            <ul class="nav nav-tabs custom-tabs mb-0" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link disabled" id="calender" data-toggle="tab" href="#select_rp_parent_office"
                       aria-controls="tree">
                        <span class="nav-text">এনটিটি নির্বাচন</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="select_cost_centers" class="nav-link rounded-0 active" data-toggle="tab"
                       href="#select_entity_by_layer">
                        <span class="nav-text">কস্ট সেন্টার নির্বাচন</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="select_cost_centers" class="nav-link rounded-0" data-toggle="tab"
                       href="#select_milestone">
                        <span class="nav-text">নিরীক্ষা কাজের পর্যায়</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="rp_office_tab">
                <div class="tab-pane fade border border-top-0 p-3" id="select_rp_parent_office"
                     role="tabpanel"
                     aria-labelledby="calender-tab">
                    <div class="px-3">
                        <x-rp-parent-office-select grid="6" unit="true"/>
                    </div>
                    <h5 class="text-primary pl-3"><u>এনটিটি/প্রতিষ্ঠানের তালিকাঃ</u></h5>
                    <div class="col-md-12 rp_auditee_parent_office_tree"></div>
                </div>
                <div class="tab-pane border border-top-0 p-3 fade show active" id="select_entity_by_layer"
                     role="tabpanel" aria-labelledby="activity-tab">
                    <div class="col-md-12 rp_auditee_office_tree"></div>
                </div>
                <div class="tab-pane border border-top-0 p-3 fade" id="select_milestone"
                     role="tabpanel" aria-labelledby="activity-tab">
                    <div class="col-md-12 load_milestone">
                        @if($annual_plan_info['ap_milestones'])
                            <table class="table table-striped">
                                <thead class="thead-light">
                                <tr>
                                    <th width="5%">ক্রঃ নং</th>
                                    <th width="30%">মাইলস্টোন</th>
                                    <th width="15%">নির্ধারিত তারিখ</th>
                                    <th width="15%">শুরুর তারিখ</th>
                                    <th width="15%">শেষের তারিখ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($annual_plan_info['ap_milestones'] as $milestone)
                                    <tr class="milestone_row">
                                        <td>{{enTobn($loop->iteration)}}</td>
                                        <td>
                                            {{$milestone['milestone']['title_bn']}}
                                            <input name="milestone_id" class="milestone_id" type="hidden"
                                                   value="{{$milestone['milestone_id']}}">
                                        </td>
                                        <td>
                                            {{formatDate($milestone['milestone_target_date'],'bn','/')}}
                                            <input name="milestone_target_date" class="milestone_target_date"
                                                   type="hidden"
                                                   value="{{$milestone['milestone_target_date']}}">
                                        </td>
                                        <td>
                                            <input type="text" name="start_date"
                                                   class="form-control milestone_start_date date"
                                                   value="{{$milestone['start_date']}}">
                                        </td>
                                        <td>
                                            <input type="text" name="end_date"
                                                   class="form-control milestone_end_date date"
                                                   value="{{$milestone['end_date']}}">
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="row">
            <div class="offset-6 col-md-6 text-right p-2">
                <a
                    onclick="Annual_Plan_Container.backToAnnualPlanList()"
                    class="btn btn-sm btn-outline-warning btn_back btn-square mr-3">
                    <i class="fad fa-arrow-alt-left"></i> ফেরত যান
                </a>
                <button class="btn btn-sm btn-square btn-primary btn-hover-success mr-2"
                        onclick="Annual_Plan_Container.submitAnnualPlan($(this))"><i class="fa fa-save"></i> সংরক্ষণ
                </button>
            </div>
        </div>

        <form id="annual_plan_form">
            <input type="hidden" value="{{$annual_plan_info['id']}}" name="id">
            <div class="form-row">
                <div class="col-md-6">
                    <label for="total_unit_no">প্রতিষ্ঠানের মোট ইউনিট সংখ্যা<span class="text-danger">*</span></label>
                    <input class="form-control bijoy-bangla text-right" type="text" id="total_unit_no" name="total_unit_no" value="{{$annual_plan_info['total_unit_no']}}" readonly>
                </div>

                <div class="col-md-6">
                    <label for="total_selected_unit_no">নির্বাচিত ইউনিট সংখ্যা<span class="text-danger">*</span></label>
                    <input class="form-control bijoy-bangla text-right" type="text" id="total_selected_unit_no"  value="{{$annual_plan_info['nominated_office_counts']}}" readonly>
                </div>
            </div>

            <div class="form-row mt-2">

                <div class="col-md-6">
                    <label for="budget">প্রতিষ্ঠানের মোট বাজেট</label>
                    <input class="form-control text-right bijoy-bangla integer_type_positive" type="text" id="budget" name="budget" value="{{$annual_plan_info['budget']}}">
                </div>

                <div class="col-md-6">
                    <label for="budget">নির্বাচিত ইউনিটের মোট বাজেট</label>
                    <input class="form-control text-right bijoy-bangla integer_type_positive" type="text" id="cost_center_total_budget"
                           name="cost_center_total_budget" value="{{$annual_plan_info['cost_center_total_budget']}}">
                </div>
            </div>
            <div class="form-row mt-2">
                <div class="col-md-6">
                    <label for="subject_matter">সাবজেক্ট ম্যাটার<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="subject_matter" name="subject_matter" value="{{$annual_plan_info['subject_matter']}}">
                </div>
                <div class="col-md-6">
                    <label for="subject_matter">প্রতিষ্ঠানের শ্রেণী<span class="text-danger">*</span></label>
                    <select class="form-control" name="office_type" id="office_type">
                        <option  value="">প্রতিষ্ঠানের শ্রেণি বাছাই করুন</option>
                        <option @if($annual_plan_info['office_type'] == 'বাজেটারি সেন্ট্রাল গভর্নমেন্ট') selected @endif value="বাজেটারি সেন্ট্রাল গভর্নমেন্ট">বাজেটারি সেন্ট্রাল গভর্নমেন্ট</option>
                        <option @if($annual_plan_info['office_type'] == 'স্ট্যাটুটরি পাবলিক অথরিটিজ') selected @endif value="স্ট্যাটুটরি পাবলিক অথরিটিজ">স্ট্যাটুটরি পাবলিক অথরিটিজ</option>
                        <option @if($annual_plan_info['office_type'] == 'লোকাল অথরিটিজ') selected @endif value="লোকাল অথরিটিজ">লোকাল অথোরিটিজ </option>
                        <option @if($annual_plan_info['office_type'] == 'পাবলিক এন্টারপ্রাইজেস এন্ড কর্পোরেশন্স') selected @endif value="পাবলিক এন্টারপ্রাইজেস এন্ড কর্পোরেশন্স">পাবলিক এন্টারপ্রাইজেস এন্ড কর্পোরেশন্স</option>
                    </select>
                </div>

            </div>

            <div class="p-4 mt-4 card">
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="pl-4 selected_rp_offices">
                            <h5 class="text-primary"><u>অডিটের জন্য প্রস্তাবিত ইউনিটের তালিকাঃ</u></h5>

                            <li class="parent_office" id="selected_rp_parent_auditee_{{$annual_plan_info['parent_office_id']}}"
                                style="border: 1px solid #ebf3f2;list-style: none;margin: 5px;padding-left: 4px;cursor: move;">
                                <span class="badge badge-white">&nbsp;</span><i class="fa fa-home pr-2"></i>
                                {{$annual_plan_info['parent_office_name_bn']}}
                                <span class="ml-2 badge badge-info">এনটিটি</span>
                                <input
                                    name="parent_office"
                                    class="selected_entity"
                                    id="selected_parent_entity_{{$annual_plan_info['parent_office_id']}}"
                                    type="hidden"
                                    value="{{$parent_office_info}}">
                                <input
                                    name="controlling_office"
                                    class="controlling_office"
                                    id="controlling_office"
                                    type="hidden"
                                    value="{{$controlling_office_info}}">
                                <input
                                    name="ministry_info"
                                    class="ministry_info"
                                    id="ministry_info"
                                    type="hidden"
                                    value="{{$ministry_info}}">
                            </li>
                            @foreach($nominated_office_list as $nominated_office)
                                @php
                                   $office_info =  json_encode(
                                        [
                                            'office_id' => $nominated_office['office_id'],
                                            'office_name_en' => $nominated_office['office_name_en'],
                                            'office_name_bn' => $nominated_office['office_name_bn']
                                        ]
                                    );
                                @endphp
                                <li id="selected_rp_auditee_{{$nominated_office['office_id']}}"
                                    style="border: 1px solid #ebf3f2;list-style: none;margin: 5px;padding-left: 4px;cursor: move;"
                                    draggable="true" ondragend="dragEnd()" ondragover="dragOver(event)"
                                    ondragstart="dragStart(event)"><span class="selected_entity_sr badge badge-white pl-1">{{enTobn($loop->iteration)}}| </span><span
                                        id="btn_remove_auditee_{{$nominated_office['office_id']}}" data-auditee-id="{{$nominated_office['office_id']}}"
                                        onclick="Annual_Plan_Container.removeSelectedRPAuditee({{$nominated_office['office_id']}})"
                                        style="cursor:pointer;color:red;"><i class="fas fa-trash-alt text-danger pr-2"></i></span><i
                                        class="fa fa-home pr-2"></i>{{$nominated_office['office_name_bn']}}<input
                                        name="selected_entity[]" class="selected_entity" id="selected_entity_{{$nominated_office['office_id']}}"
                                        type="hidden"
                                        value="{{$office_info}}">
                                </li>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 mt-4 card">
                <div class="row">
                    <div class="col-md-6">
                        <span onclick="Annual_Plan_Container.addTeamSection($(this))"
                              class="btn btn-outline-primary btn-square mr-2">
                            <i class="fa fa-plus"></i> দল গঠন করুন
                        </span>
                    </div>
                </div>

                <div class="team-section">
                    @foreach($staff_list as $staff)
                        <div class="form-row pt-4 staff_row" id="team_section_{{$loop->iteration}}" data-select2-id="team_section_{{$loop->iteration}}">
                            <div class="col-md-4">
                                <label for="designation">পদবি</label>
                                <select class="form-control select-select2 staff_designation designation_{{$loop->iteration}}" name="designation[]">
                                    <option value="">--বাছাই করুন--</option>
                                    @foreach($designations as $designation)
                                        <option
                                            @if($designation['designation_eng'] == $staff['designation_en']) selected @endif
                                            data-designation-en="{{$designation['designation_eng']}}"
                                            value="{{$designation['designation_eng']}}|{{$designation['designation_bng']}}">
                                            {{$designation['designation_bng']}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3" data-select2-id="1743">
                                <label for="responsibility">দায়িত্ব</label>
                                <select class="form-control select-select2 staff_responsibility responsibility_{{$loop->iteration}}"
                                        name="responsibility">
                                    <option value="">--বাছাই করুন--</option>
                                    <option data-responsibility-en="Team Leader" @if($staff['responsibility_en'] == 'Team Leader') selected @endif value="Team Leader|দলনেতা">দলনেতা</option>
                                    <option data-responsibility-en="Sub Team Leader" @if($staff['responsibility_en'] == 'Sub Team Leader') selected @endif value="Sub Team Leade|উপদলনেতা">উপদলনেতা</option>
                                    <option data-responsibility-en="Member" @if($staff['responsibility_en'] == 'Member') selected @endif value="Member|সদস্য">সদস্য</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="staff">জন</label>
                                <input data-row-count="{{$loop->iteration}}" class="form-control staff_1 staff_number" type="number" name="staff" value="{{$staff['staff']}}">
                            </div>
                            <div class="col-md-2 mt-9">
                                <span title="যোগ করুন" onclick="Annual_Plan_Container.addTeamSection($(this))"
                                      class="btn btn-outline-primary btn-sm btn-square">
                                    <i class="fal fa-plus"></i>
                                </span>
                                <button title="মুছে ফেলুন" onclick="Annual_Plan_Container.removeTeamSection($(this))"
                                        class="btn btn-outline-danger btn-sm btn-danger btn-square">
                                    <i class="fal fa-minus"></i>
                                </button>
                            </div>
                            <input
                                type="hidden"
                                name="staff_info[]"
                                class="staff_info_1"
                                value="{{$staff['designation_en']}}|{{$staff['designation_bn']}}_{{$staff['responsibility_bn']}}|{{$staff['responsibility_en']}}_{{$staff['staff']}}">
                        </div>
                    @endforeach
                </div>
                <div class="form-row pt-4">
                    <div class="col-md-12">
                        <label for="staff_comment">টিমের বর্ণনা</label>
                        <textarea rows="1" class="form-control" name="staff_comment" id="staff_comment">{{$staff_comment}}</textarea>
                    </div>
                </div>
            </div>

            <div class="form-row pt-4">
                <div class="col-md-12">
                    <label for="comment">মন্তব্য</label>
                    <textarea class="form-control" id="comment" name="comment">{{$annual_plan_info['comment']}}</textarea>
                </div>
            </div>
{{--            <input type="hidden" name="schedule_id" value="{{$schedule_id}}">--}}
            <input type="hidden" name="op_audit_calendar_event_id" value="{{$op_audit_calendar_event_id}}">
{{--            <input type="hidden" name="activity_id" value="{{$activity_id}}">--}}
{{--            <input type="hidden" name="milestone_id" value="{{$milestone_id}}">--}}
            <input type="hidden" id="fiscal_year_id" name="fiscal_year_id" value="{{$fiscal_year_id}}">
        </form>
    </div>
</div>

@include('scripts.script_generic')
<script>
    $( function (){
        activity_id = '{{$annual_plan_info['activity_id']}}';
        milestone_id = '{{$annual_plan_info['milestone_id']}}';
        // Annual_Plan_Container.loadActivityWiseMilestone(activity_id,milestone_id);
        parent_ministry_id = '{{$annual_plan_info['ministry_id']}}';
        parent_office_id = '{{$annual_plan_info['parent_office_id']}}';
        $('#parent_ministry_id').val(parent_ministry_id);
        Annual_Plan_Container.loadEntityChildOffices(parent_office_id);
    });

//     function selectNodeByMyAttribute (AttrValue) {
//     $("#jstree").jstree().deselect_all(true);
//
//     var instance = $("#jstree").jstree(true);
//     var m = instance._model.data;
//     for (var i in m) {
//         if (m.hasOwnProperty(i) && i !== '#' && m[i].li_attr.MyAttribute && m[i].li_attr.MyAttribute === AttrValue) {
//             instance.select_node(i);
//             break;
//         }
//     }
// }


    $("select#parent_office_layer_id").change(function () {
        layer_id = $(this).val();
        ministry_id = $('#parent_ministry_id').val();
        Annual_Plan_Container.loadRPParentAuditeeOffices(ministry_id, layer_id);
    });

    $("#activity_id").change(function () {
        activity_id = $(this).val();
        Annual_Plan_Container.loadActivityWiseMilestone(activity_id);
    });

    selected = null

    function dragOver(e) {
        if (isBefore(selected, e.target)) {
            e.target.parentNode.insertBefore(selected, e.target)
        } else {
            e.target.parentNode.insertBefore(selected, e.target.nextSibling)
        }
    }

    function dragEnd() {
        selected = null
        $('.selected_entity_sr').each(function (i, v) {
            i = ++i;
            $(this).html(enTobn(i) + '|')
        })
    }

    function dragStart(e) {
        e.dataTransfer.effectAllowed = 'move'
        e.dataTransfer.setData('text/plain', null)
        selected = e.target
    }

    function isBefore(el1, el2) {
        let cur
        if (el2.parentNode === el1.parentNode) {
            for (cur = el1.previousSibling; cur; cur = cur.previousSibling) {
                if (cur === el2) return true
            }
        }
        return false;
    }

</script>




