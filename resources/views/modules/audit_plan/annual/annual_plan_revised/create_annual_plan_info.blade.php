<x-title-wrapper>Annual Plan</x-title-wrapper>

<div class="row ml-7 mr-7 pt-4">
    <div class="col-6">
        <div class="form-row">
            <div class="col-md-6">
                <label for="activity_id">অ্যাক্টিভিটি<span class="text-danger">*</span></label>
                <select class="form-control" name="activity_id" id="activity_id">
                    <option value="">অ্যাক্টিভিটি বাছাই করুন</option>
                    @foreach($all_activity as $activity)
                        <option value="{{$activity['id']}}">{{$activity['title_bn']}} </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
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
<div class="row ml-7 mr-7 pt-4">
    <div class="col-6">
        <div class="annual_entity_selection_area">
            <ul class="nav nav-tabs custom-tabs mb-0" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="calender" data-toggle="tab" href="#select_rp_parent_office"
                       aria-controls="tree">
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
                    <h5 class="text-primary pl-3"><u>এনটিটি/প্রতিষ্ঠানের তালিকাঃ</u></h5>
                    <div class="col-md-12 rp_auditee_parent_office_tree"></div>
                </div>
                <div class="tab-pane border border-top-0 p-3 fade" id="select_entity_by_layer"
                     role="tabpanel" aria-labelledby="activity-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <select class="form-control select-select2" id="selected_entity">
                                <option value=""> --এনটিটি বাছাই করুন--</option>
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
                <div class="col-md-6">
                    <label for="total_unit_no">প্রতিষ্ঠানের মোট ইউনিট সংখ্যা<span class="text-danger">*</span></label>
                    <input class="form-control bijoy-bangla text-right" type="text" id="total_unit_no" name="total_unit_no">
                    <input type="hidden" id="total_unit">
                </div>

                <div class="col-md-6">
                    <label for="total_selected_unit_no">নির্বাচিত ইউনিট সংখ্যা<span class="text-danger">*</span></label>
                    <input class="form-control bijoy-bangla text-right" type="text" name="total_selected_unit_no" id="total_selected_unit_no">
                </div>
            </div>

            <div class="form-row mt-2">

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
            <div class="form-row mt-2">
                <div class="col-md-6">
                    <label for="subject_matter">সাবজেক্ট ম্যাটার<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="subject_matter" name="subject_matter">
                </div>
                <div class="col-md-6">
                    <label for="subject_matter">প্রতিষ্ঠানের ক্যাটাগরি<span class="text-danger">*</span></label>
                    <select class="form-control" name="office_type" id="office_type">
                        <option value="">প্রতিষ্ঠানের ক্যাটাগরি বাছাই করুন</option>
                        <option value="বাজেটারি সেন্ট্রাল গভর্নমেন্ট">বাজেটারি সেন্ট্রাল গভর্নমেন্ট</option>
                        <option value="স্ট্যাটুটরি পাবলিক অথরিটিজ">স্ট্যাটুটরি পাবলিক অথরিটিজ</option>
                        <option value="লোকাল অথরিটিজ">লোকাল অথরিটিজ</option>
                        <option value="পাবলিক এন্টারপ্রাইজেস এন্ড কর্পোরেশন্স">পাবলিক এন্টারপ্রাইজেস এন্ড কর্পোরেশন্স</option>
                    </select>
                </div>

            </div>

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

@include('scripts.script_generic')
<script>
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
        console.log(ministry_id)
        Annual_Plan_Container.loadRPParentAuditeeOfficesMinistryWise(ministry_id);
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

</script>




