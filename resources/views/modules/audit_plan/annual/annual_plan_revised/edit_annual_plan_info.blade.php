<x-title-wrapper>Edit Annual Plan</x-title-wrapper>

<div class="row ml-7 mr-7 pt-4">
    <div class="col-6">
        <div class="form-row">
            <div class="col-md-6">
                <label for="activity_id">অ্যাক্টিভিটি<span class="text-danger">*</span></label>
                <select class="form-control" name="activity_id" id="activity_id">
                    <option value="">অ্যাক্টিভিটি বাছাই করুন</option>
                    @foreach($all_activity as $activity)
                        <option @if($annual_plan_info['activity_id'] == $activity['id']) selected @endif value="{{$activity['id']}}">{{$activity['title_bn']}} </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 @if(session('dashboard_audit_type') == 'Performance Audit') d-none @endif">
                <input style="margin-top: 35px" type="radio" name="annual_plan_type" value="thematic" @if($annual_plan_info['annual_plan_type'] == 'thematic') checked @endif> Thematic
                <input type="radio" name="annual_plan_type" value="entity_based" @if($annual_plan_info['annual_plan_type'] == 'entity_based') checked @endif> Entity Based
                <input @if($annual_plan_info['annual_plan_type'] == 'thematic') style="display: block" @else style="display: none" @endif class="form-control thematic_title" name="thematic_title" value="{{$annual_plan_info['thematic_title']}}" placeholder="Thematic Title">
            </div>

        </div>

        @if(session('dashboard_audit_type') == 'Performance Audit')
            <div class="form-row mt-2">
                <div class="col-md-12">
                    <label for="vumika">ভূমিকা <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="vumika" name="vumika" value="{{$annual_plan_info['vumika']}}">
                </div>
                <div class="row mt-2 mb-2">
                    <p class="col-md-12 mb-1">সাবজেক্ট ম্যাটার</p>
                    <div class="col-md-6">
                        <label for="subject_matter">মেইন টপিক<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="subject_matter" name="subject_matter" value="{{$annual_plan_info['subject_matter']}}">
                    </div>
                    <div class="col-md-6">
                        <label for="sub_subject_matter">সাব টপিক<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="sub_subject_matter" name="sub_subject_matter" value="{{$annual_plan_info['sub_subject_matter']}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="audit_objective">অডিট অবজেকটিভ<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="audit_objective" name="audit_objective" value="{{$annual_plan_info['audit_objective']}}">
                </div>
                <div class="col-md-12">
                    <label for="audit_approach">অডিট অ্যাপ্রোচ<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="audit_approach" name="audit_approach" value="{{$annual_plan_info['audit_approach']}}">
                </div>
            </div>
        @endif
    </div>
</div>
<div class="row ml-7 mr-7 pt-4">
    <div class="col-6">
        <div class="annual_entity_selection_area">
            <ul class="nav nav-tabs custom-tabs mb-0" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="calender" data-toggle="tab" href="#select_rp_parent_office"
                       aria-controls="tree">
                        <span class="nav-text">এনটিটি নির্বাচন</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="select_cost_centers" class="nav-link rounded-0" data-toggle="tab"
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
                <div class="tab-pane fade border border-top-0 p-3 show active" id="select_rp_parent_office"
                     role="tabpanel"
                     aria-labelledby="calender-tab">
                    <div class="px-3">
                        <x-rp-parent-office-select grid="6" unit="true"/>
                    </div>
                    @if(session('dashboard_audit_type') != 'Performance Audit')
                    <div class="col-md-12">
                        <div class="form-group mb-1">
                            <div class="col-form-label">
                                <div class="radio-inline">
                                    <label for="with_assessment" class="radio radio-success">
                                        <input id="with_assessment" type="radio" name="assessment" value="with_assessment" />
                                        <span></span>
                                        With Auditability Assessment
                                    </label>
                                    <label for="with_out_assessment" class="radio radio-success">
                                        <input checked id="with_out_assessment" type="radio" name="assessment" value="with_out_assessment"/>
                                        <span></span>
                                        With Out Auditability Assessment
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <h5 class="text-primary pl-3"><u>এনটিটি/প্রতিষ্ঠানের তালিকাঃ</u></h5>
                    <div class="col-md-12 rp_auditee_parent_office_tree"></div>
                </div>
                <div class="tab-pane border border-top-0 p-3 fade" id="select_entity_by_layer"
                     role="tabpanel" aria-labelledby="activity-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <select class="form-control" id="selected_entity">
                                <option value=""> --এনটিটি বাছাই করুন--</option>
                                @foreach($annual_plan_info['ap_entities'] as $entity)
                                    <option
                                        data-ministry-id="{{$entity['ministry_id']}}"
                                        data-layer-id="{{$entity['layer_id']}}"
                                        data-entity-name-en="{{$entity['entity_name_en']}}"
                                        value="{{$entity['entity_id']}}"> {{$entity['entity_name_bn']}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 rp_auditee_office_tree"></div>
                </div>
                <div class="tab-pane border border-top-0 p-3 fade" id="select_milestone"
                     role="tabpanel" aria-labelledby="activity-tab">
                    <div class="col-md-12 load_milestone p-0">
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
                                                   value="{{formatDate($milestone['milestone_target_date'],'en','/')}}">
                                        </td>
                                        <td class="pl-0 pr-0">
                                            <input type="text" name="start_date"
                                                   class="form-control milestone_start_date date"
                                                   data-target-date="{{formatDate($milestone['milestone_target_date'],'en','/')}}"
                                                   value="{{formatDate($milestone['start_date'],'en','/')}}">
                                        </td>
                                        <td class="pl-0 pr-0">
                                            <input type="text" name="end_date"
                                                   class="form-control milestone_end_date date"
                                                   data-target-date="{{formatDate($milestone['milestone_target_date'],'en','/')}}"
                                                   value="{{formatDate($milestone['end_date'],'en','/')}}">
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
                <button class="btn btn-sm btn-square btn-outline-primary mr-2"
                        onclick="Annual_Plan_Container.submitAnnualPlan($(this))"><i class="fa fa-save"></i> সংরক্ষণ
                </button>
            </div>
        </div>

        <form id="annual_plan_form">
            <input type="hidden" value="{{$annual_plan_info['id']}}" name="id">
            <div class="form-row">
                <div class="col-md-6">
                    <label for="total_unit_no">প্রতিষ্ঠানের মোট ইউনিট সংখ্যা<span class="text-danger">*</span></label>
                    <input class="form-control bijoy-bangla text-right" type="text" id="total_unit_no" name="total_unit_no" value="{{$annual_plan_info['total_unit_no']}}">
                </div>

                <div class="col-md-6">
                    <label for="total_selected_unit_no">নির্বাচিত ইউনিট সংখ্যা<span class="text-danger">*</span></label>
                    <input name="total_selected_unit_no" class="form-control bijoy-bangla text-right" type="text" id="total_selected_unit_no" value="{{$annual_plan_info['nominated_office_counts']}}">
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
            @if(session('dashboard_audit_type') != 'Performance Audit')
                <div class="form-row mt-2">
                    <div class="col-md-12">
                        <label for="subject_matter">সাবজেক্ট ম্যাটার<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="subject_matter" name="subject_matter" value="{{$annual_plan_info['subject_matter']}}">
                    </div>
                </div>
            @endif

            <div class="p-4 mt-4 card">
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="pl-4 selected_rp_offices">
                            <h5 class="text-primary"><u>অডিটের জন্য প্রস্তাবিত ইউনিটের তালিকাঃ</u></h5>
                            @foreach($annual_plan_info['ap_entities'] as $entity)
                                <li class="parent_office" data-child-count="{{$entity['entity_total_unit']}}" id="selected_rp_parent_auditee_{{$entity['entity_id']}}"
                                    style="border: 1px solid #ebf3f2;list-style: none;margin: 5px;padding-left: 4px;cursor: move;">
                                    <span id="btn_remove_auditee_{{$entity['entity_id']}}" data-auditee-id="{{$entity['entity_id']}}" onclick="Annual_Plan_Container.removeSelectedEntity({{$entity['entity_id']}},0)" style="cursor:pointer;color:red;"><i class="fas fa-trash-alt text-danger pr-2"></i></span>
                                    <span class="badge badge-white">&nbsp;</span><i class="fa fa-home pr-2"></i>
                                    {{$entity['entity_name_bn']}}
                                    <span class="ml-2 badge badge-info">এনটিটি</span>
                                    @php
                                        $entity_info =  json_encode(
                                             [
                                                 'entity_id' => $entity['entity_id'],
                                                 'entity_name_en' => $entity['entity_name_en'],
                                                 'entity_name_bn' => $entity['entity_name_bn'],
                                                 'layer_id' => $entity['layer_id'],
                                                 'ministry_id' => $entity['ministry_id'],
                                                 'ministry_name_en' => $entity['ministry_name_en'],
                                                 'ministry_name_bn' => $entity['ministry_name_bn'],
                                                 'child_count' => $entity['entity_total_unit'],
                                             ]
                                         );
                                    @endphp
                                    <input class="selected_entity" id="selected_parent_entity_{{$entity['entity_id']}}" type="hidden" value="{{$entity_info}}"/>
                                </li>
                                @foreach(json_decode($entity['nominated_offices'],true) as $nominated_office)
                                    @php
                                        $office_info =  json_encode(
                                             [
                                                 'entity_id' => $nominated_office['entity_id'],
                                                 'office_id' => $nominated_office['office_id'],
                                                 'office_name_en' => $nominated_office['office_name_en'],
                                                 'office_name_bn' => $nominated_office['office_name_bn']
                                             ]
                                         );
                                    @endphp
                                    <li class="entity_{{$entity['entity_id']}}"
                                        id="selected_rp_auditee_{{$nominated_office['office_id']}}"
                                        style="border: 1px solid #ebf3f2;list-style: none;margin: 5px;padding-left: 4px;cursor: move;"
                                        draggable="true" ondragend="dragEnd()" ondragover="dragOver(event)"
                                        ondragstart="dragStart(event)"><span
                                            class="selected_entity_sr badge badge-white pl-1">{{enTobn($loop->iteration)}}| </span><span
                                            id="btn_remove_auditee_{{$nominated_office['office_id']}}"
                                            data-auditee-id="{{$nominated_office['office_id']}}"
                                            onclick="Annual_Plan_Container.removeSelectedRPAuditee({{$nominated_office['office_id']}})"
                                            style="cursor:pointer;color:red;"><i
                                                class="fas fa-trash-alt text-danger pr-2"></i></span><i
                                            class="fa fa-home pr-2"></i>{{$nominated_office['office_name_bn']}}<input
                                            class="selected_auditee"
                                            id="selected_entity_{{$nominated_office['office_id']}}"
                                            type="hidden"
                                            value="{{$office_info}}">
                                    </li>
                                @endforeach
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
                            <i class="fa fa-plus"></i> জনবল
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
                                    <option data-responsibility-en="Sub Team Leader" @if($staff['responsibility_en'] == 'Sub Team Leader') selected @endif value="Sub Team Leader|উপদলনেতা">উপদলনেতা</option>
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
    $(function () {
        activity_id = '{{$annual_plan_info['activity_id']}}';
        milestone_id = '{{$annual_plan_info['milestone_id']}}';
        @if($annual_plan_info['ap_entities'][0])
        $('select#parent_ministry_id').val('{{$annual_plan_info['ap_entities'][0]['ministry_id']}}').trigger('change')
        @endif
        $('#office_category_type_title_en').val('{{$annual_plan_info['office_type_en']}}')
        $('#office_category_type_title_bn').val('{{$annual_plan_info['office_type']}}')
        $('#office_category_type_select').val('{{$annual_plan_info['office_type_id']}}').trigger('change')

        @if(!$annual_plan_info['ap_milestones'])
        $('#activity_id').val(activity_id).trigger('change');
        @endif
        // Annual_Plan_Container.loadEntityChildOffices(parent_office_id);
    });

    $("select#selected_entity").change(function () {
        ministry_id = $(this).find(':selected').attr('data-ministry-id');
        entity_id = $(this).val();
        entity_name_bn = $(this).text();
        entity_name_en = $(this).find(':selected').attr('data-entity-name-en');
        Annual_Plan_Container.loadEntityChildOffices(ministry_id, entity_id, entity_name_en, entity_name_bn);
    });

    $("select#parent_ministry_id").change(function () {
        ministry_id = $(this).val();
        office_category_type = $('#office_category_type_select').val();
        Annual_Plan_Container.loadRPParentAuditeeOfficesMinistryWise(ministry_id, office_category_type);
    });

    $("select#office_category_type_select").change(function () {
        ministry_id = $('#parent_ministry_id').val();
        office_category_type = $(this).val();
        Annual_Plan_Container.loadRPParentAuditeeOfficesMinistryWise(ministry_id, office_category_type);
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

    $('.milestone_start_date,.milestone_end_date').blur(function () {
        target_date = $(this).attr('data-target-date');
        target_date = formatDate(target_date);
        target_date = target_date.replaceAll('-', '/');

        date = $(this).val();
        date = date.replaceAll('-', '/');
        date = formatDate(date);
        date = date.replaceAll('-', '/');

        target_date = new Date(target_date);
        date = new Date(date);
        console.log(target_date, date);
        if (target_date < date) {
            toastr.warning('নির্ধারিত তারিখ ' + enTobn($(this).attr('data-target-date')));
            $(this).val('');
        }
    });

    $("input[name$='annual_plan_type']").click(function () {
        annual_plan_type = $(this).val();
        if (annual_plan_type == 'thematic') {
            $('.thematic_title').show();
        } else {
            $('.thematic_title').hide();
            $('.thematic_title').val('');
        }
    });

    $('input[type=radio][name=assessment]').on('change', function() {
        if($(this).val() == 'with_assessment'){
            parent_ministry_id =  $('#parent_ministry_id').val();
            office_category_type =  $('#office_category_type_select').val();
            activity_id =  $('#activity_id').val();
            if(parent_ministry_id && activity_id){
                Annual_Plan_Container.loadAssessmentEntity(parent_ministry_id,office_category_type,activity_id);
            }else{
                toastr.warning('Please select ministry and activity');
            }
        }else{
            parent_ministry_id =  $('#parent_ministry_id').val();
            $('#parent_ministry_id').val(parent_ministry_id).trigger('change');
        }
    });
</script>




