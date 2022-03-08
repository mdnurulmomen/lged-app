<x-title-wrapper>Annual Plan</x-title-wrapper>

<div class="card sna-card-border mt-3" style="margin-bottom:30px;">
    <div class="row">
        <div class="col-6">
            <div class="form-row">
                <div class="col-md-6">
                    <label for="activity_id">অ্যাক্টিভিটি<span class="text-danger">*</span></label>
                    <select class="form-control" name="activity_id" id="activity_id">
                        <option value="">অ্যাক্টিভিটি বাছাই করুন</option>
                        @foreach($all_activity as $activity)
                            <option data-activity-type="{{$activity['activity_type']}}" data-activity-key="{{$activity['activity_key']}}" value="{{$activity['id']}}">{{$activity['title_bn']}} </option>
                        @endforeach
                    </select>
                </div>
                {{--            @php dump(session('dashboard_audit_type')) @endphp--}}
                <div class="col-md-6 @if(session('dashboard_audit_type') == 'Performance Audit') d-none @endif">
                    <input class="annual_plan_type mt-12" type="radio" name="annual_plan_type" value="thematic"> Thematic
                    <input type="radio" name="annual_plan_type" value="entity_based" checked> Entity Based
                    <input style="display: none" class="form-control thematic_title mt-2" name="thematic_title" value="" placeholder="Thematic Title">
                </div>

                <div class="col-md-6" style="display: none">
                    <label for="activity_id">মাইলস্টোন<span class="text-danger">*</span></label>
                    <select class="form-control" name="milestone_id" id="milestone_id">
                        <option value="">মাইলস্টোন বাছাই করুন</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row pt-4">
        <div class="col-6">
            <div class="annual_entity_selection_area">
                <ul class="nav nav-tabs custom-tabs mb-0" id="myTab" role="tablist">
                    @if(session('dashboard_audit_type') == 'Performance Audit')
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#select_topic"
                           aria-controls="tree">
                            <span class="nav-text">টপিক বাছাই করুন</span>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link @if(session('dashboard_audit_type') != 'Performance Audit') active @endif" id="calender" data-toggle="tab"
                           aria-controls="tree" href="#select_rp_parent_office">
                            <span class="nav-text">এনটিটি/সংস্থা</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="select_cost_centers" class="nav-link rounded-0" data-toggle="tab"
                           href="#select_entity_by_layer">
                            <span class="nav-text">কস্ট সেন্টার/ইউনিট</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="milestone_tab" class="nav-link rounded-0" data-toggle="tab"
                           href="#select_milestone">
                            <span class="nav-text">নিরীক্ষা কাজের পর্যায়</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="rp_office_tab">
                    @if(session('dashboard_audit_type') == 'Performance Audit')
                        <div class="tab-pane fade border border-top-0 p-3 show active" id="select_topic"
                            role="tabpanel"
                            aria-labelledby="activity-tab">
                                    <div class="form-row mt-2">
                                        <div class="col-md-12">
                                            <label for="vumika">ভূমিকা <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="vumika" name="vumika">
                                        </div>
                                        <div class="row mt-2 mb-2 mx-0">
                                            <p class="col-md-12 mb-1 px-2">সাবজেক্ট ম্যাটার :</p><br>
                                            <div class="col-md-12 px-2">
                                                <label for="subject_matter">মেইন টপিক<span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" id="subject_matter" name="subject_matter">
                                            </div>
                                            <div class="col-md-12 px-2 mt-2">
                                                <label for="sub_subject_matter">সাব টপিক<span class="text-danger">*</span></label>
                                                <div class="sub_subject_matter_div">
                                                    <div>
                                                        <div class="input-group">
                                                            <input class="form-control sub_subject_matter" type="text" id="sub_subject_matter" name="sub_subject_matter">
                                                            <button type="button"  class="mt-1 ml-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-primary btn-icon-primary add_sub_topic
                                                                            list-btn-toggle"><i class="fad fa-plus-circle"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="audit_objective">অডিট অবজেকটিভ<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="audit_objective" name="audit_objective">


                                            <div id="objectiveAppendSection" class="objectiveAppendSection">
                                                <fieldset class="scheduler-border">
                                                    <legend class="scheduler-border">
                                                        সাব অবজেকটিভ
                                                        {{-- <span class="fa fa-plus-circle btn_objective_add"></span> --}}
                                                        <button class="btn btn-sm btn-square btn-outline-primary btn_objective_add float-right"
                                                                ><i class="fa fa-plus"></i> নতুন যোগ করুন
                                                        </button>
                                                    </legend>

                                                    <div class="sub_objective_row " id="sub_objective_row_1">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="input-label">সাব অবজেকটিভ<span class="text-danger">*</span></label>
                                                                    <input class="form-control sub_objective" type="text" id="sub_objective" name="sub_objective">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="line_of_enquire_row">
                                                            <div class="row">
                                                                <div class="col-md-10">
                                                                    <div class="form-group">
                                                                        <label class="input-label">লাইন অফ ইনকোয়ারি<span class="text-danger">*</span></label>

                                                                        <div class="line_of_enquire_div">
                                                                            <div>
                                                                                <div class="input-group">
                                                                                    <input class="form-control line_of_enquire" type="text" id="line_of_enquire" name="line_of_enquire">
                                                                                    <button type="button" onclick="addLineOfEnquire($(this))" class="mt-1 ml-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-primary btn-icon-primary
                                                                                    list-btn-toggle"><i class="fad fa-plus-circle"></i></button>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </fieldset>

                                                <div class="object_append_div">

                                                </div>


                                            </div>

                                        </div>
                                        <div class="col-md-12">
                                            <label for="audit_approach">অডিট অ্যাপ্রোচ<span class="text-danger">*</span></label></br>
                        {{--                    <input class="form-control d-none" type="text" id="audit_approach" name="audit_approach">--}}
                                            <input type="radio" name="audit_approach" value="Problem Oriented" checked> Problem Oriented
                                            <input type="radio" class="ml-3" name="audit_approach" value="Result Oriented"> Result Oriented
                                            <input type="radio" class="ml-3" name="audit_approach" value="System Oriented" > System Oriented

                                        </div>
                                    </div>

                        </div>
                    @endif
                    <div class="tab-pane fade border border-top-0 p-3 @if(session('dashboard_audit_type') != 'Performance Audit') show active @endif" id="select_rp_parent_office"
                         role="tabpanel"
                         aria-labelledby="calender-tab">
                        <div class="px-3">
                            <x-rp-parent-office-select grid="6" unit="true"/>
                        </div>
                        <h5 class="text-primary pl-3"><u>এনটিটি/সংস্থার তালিকাঃ</u></h5>
                        @if(session('dashboard_audit_type') != 'Performance Audit')
                            <div class="col-md-12">
                                <div class="form-group mb-1">
                                    <div class="col-form-label">
                                        <div class="radio-inline">
                                            <label for="with_assessment" class="radio radio-success">
                                                <input id="with_assessment" type="radio" name="assessment" value="with_assessment"/>
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
                        <div class="col-md-12 rp_auditee_parent_office_tree"></div>
                    </div>

                    <div class="tab-pane border border-top-0 p-3 fade" id="select_entity_by_layer"
                         role="tabpanel" aria-labelledby="activity-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <select class="form-control select-select2" id="selected_entity">
                                    <option value=""> --এনটিটি/সংস্থা বাছাই করুন--</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 rp_auditee_office_tree"></div>
                    </div>
                    <div class="tab-pane border border-top-0 p-3 fade" id="select_milestone"
                         role="tabpanel" aria-labelledby="activity-tab">
                        <div class="col-md-12 load_milestone p-0"></div>
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
                <input type="hidden" value="" name="id">
                <div class="form-row">
                    <div class="@if(session('dashboard_audit_type') == 'Performance Audit') col-md-12 @else col-md-6 @endif">
                        <label for="total_unit_no">প্রতিষ্ঠানের মোট ইউনিট সংখ্যা<span class="text-danger">*</span></label>
                        <input class="form-control bijoy-bangla text-right" type="text" id="total_unit_no" name="total_unit_no">
                        <input type="hidden" id="total_unit">
                        <input type="hidden" name="annual_plan_main_id" id="annual_plan_main_id" value="{{$annual_plan_main_id}}" >
                    </div>

                    <div class="col-md-6 @if(session('dashboard_audit_type') == 'Performance Audit') d-none @endif">
                        <label for="total_selected_unit_no">নির্বাচিত ইউনিট সংখ্যা</label>
                        <input class="form-control bijoy-bangla text-right" type="text" name="total_selected_unit_no" id="total_selected_unit_no">
                    </div>
                </div>

                <div class="form-row mt-2 @if(session('dashboard_audit_type') == 'Performance Audit') d-none @endif">

                    <div class="col-md-6">
                        <label for="budget">প্রতিষ্ঠানের মোট বাজেট</label>
                        <input class="form-control text-right bijoy-bangla integer_type_positive" type="text" id="budget" name="budget">
                    </div>

                    <div class="col-md-6">
                        <label for="budget">নির্বাচিত ইউনিটের মোট বাজেট</label>
                        <input class="form-control text-right bijoy-bangla integer_type_positive" type="text" id="cost_center_total_budget"
                               name="cost_center_total_budget">
                    </div>
                </div>
                @if(session('dashboard_audit_type') != 'Performance Audit')
                    <div class="form-row mt-2">
                        <div class="col-md-12">
                            <label for="subject_matter">সাবজেক্ট ম্যাটার<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="subject_matter" name="subject_matter">
                        </div>
                    </div>
                @endif

                <div class="p-4 mt-4 card">
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="pl-4 selected_rp_offices">
                                <h5 class="text-primary"><u>অডিটের জন্য প্রস্তাবিত ইউনিটের তালিকাঃ</u></h5>
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

                    </div>
                    <div class="form-row pt-4">
                        <div class="col-md-12">
                            <label for="staff_comment">টিমের বর্ণনা</label>
                            <textarea rows="1" class="form-control" name="staff_comment" id="staff_comment"></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-row pt-4">
                    <div class="col-md-12">
                        <label for="comment">মন্তব্য</label>
                        <textarea class="form-control" id="comment" name="comment"></textarea>
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
</div>

@include('scripts.script_generic')
<script>
    $(function () {
        @if(session('dashboard_audit_type') == 'Performance Audit')
        $('#activity_id').val(9).trigger('change');
        @endif
        // Annual_Plan_Container.loadEntityChildOffices(parent_office_id);
    });
    $("select#selected_entity").change(function () {
        ministry_id = $(this).find(':selected').attr('data-ministry-id');
        // layer_id = $(this).find(':selected').attr('data-layer-id');
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

    $("input[name$='annual_plan_type']").click(function () {
        annual_plan_type = $(this).val();
        if (annual_plan_type == 'thematic') {
            $('.thematic_title').show();
            $('.annual_plan_type').removeClass('mt-12');
        } else {
            $('.thematic_title').hide();
            $('.thematic_title').val('');
            $('.annual_plan_type').addClass('mt-12');
        }
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

    $('input[type=radio][name=assessment]').on('change', function () {
        if ($(this).val() == 'with_assessment') {
            parent_ministry_id = $('#parent_ministry_id').val();
            office_category_type = $('#office_category_type_select').val();
            activity_id = $('#activity_id').val();
            if (parent_ministry_id && activity_id) {
                Annual_Plan_Container.loadAssessmentEntity(parent_ministry_id, office_category_type, activity_id);
            } else {
                toastr.warning('Please select ministry and activity');
                $('#with_assessment').prop('checked', false);
                return;
            }
        } else {
            parent_ministry_id = $('#parent_ministry_id').val();
            $('#parent_ministry_id').val(parent_ministry_id).trigger('change');
        }
    });

    $('.add_sub_topic').on('click', function (){
        $( ".sub_subject_matter_div").append( ' <div><div class="input-group mt-2"><input class="form-control sub_subject_matter" type="text" id="sub_subject_matter" name="sub_subject_matter"><button type="button"  class="mt-1 ml-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-danger remove_sub_topic list-btn-toggle"><i class="fad fa-minus-circle"></i></button></div></div>' );

        $('.sub_subject_matter_div').on('click', '.remove_sub_topic', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });
    });

    function addLineOfEnquire(elem){
        elem.parent().parent().append( ' <div><div class="input-group mt-2"><input class="form-control line_of_enquire" type="text" id="line_of_enquire" name="line_of_enquire"><button type="button" onclick="removeLineOfEnquire($(this))" class="mt-1 ml-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-danger  list-btn-toggle"><i class="fad fa-minus-circle"></i></button></div></div>' );
    }
    function removeLineOfEnquire(ele){
        ele.parent().parent().remove();
    }

    // $('.add_line_of_enquire').on('click', function (){
    //     $(this).parent().parent().append( ' <div><div class="input-group mt-2"><input class="form-control" type="text" id="sub_objective" name="sub_objective"><button type="button"  class="mt-1 ml-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-danger remove_line_of_enquire list-btn-toggle"><i class="fad fa-minus-circle"></i></button></div></div>' );

    //     $('.line_of_enquire_div').on('click', '.remove_line_of_enquire', function(e) {
    //         e.preventDefault();
    //         $(this).parent().parent().remove();
    //     });
    // });
    ob= 2;
    $('.btn_objective_add').on('click', function (){
        $( ".object_append_div").append( '<fieldset class="scheduler-border"><legend class="scheduler-border">সাব অবজেকটিভ </legend><div class="sub_objective_row" id="sub_objective_row_'+ob+'"><div class="row"><div class="col-md-12"><div class="form-group"><label class="input-label">সাব অবজেকটিভ<span class="text-danger">*</span></label><div class="input-group"><input class="form-control sub_objective" type="text" id="sub_objective" name="sub_objective"><button type="button" class="mt-1 ml-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-danger list-btn-toggle btn_objective_remove "><i class="fad fa-minus-circle"></i></button></div></div></div></div><div class="line_of_enquire_row"><div class="row"><div class="col-md-10"><div class="form-group"><label class="input-label">লাইন অফ ইনকোয়ারি<span class="text-danger">*</span></label><div class="line_of_enquire_div"><div><div class="input-group"><input class="form-control line_of_enquire" type="text" id="line_of_enquire" name="line_of_enquire"><button type="button"  onclick="addLineOfEnquire($(this))" class="mt-1 ml-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-primary btn-icon-primary list-btn-toggle"><i class="fad fa-plus-circle"></i></button></div></div></div></div></div></div></div></div></fieldset>' );

        $('.object_append_div').on('click', '.btn_objective_remove', function(e) {
            e.preventDefault();
            $(this).closest('.scheduler-border').remove();
        });
        ob++;
    });






</script>




