<x-title-wrapper>Annual Plan</x-title-wrapper>

<div class="row ml-7 mr-7 pt-4">
    <div class="col-5">
        <div class="annual_entity_selection_area">
            <ul class="nav nav-tabs custom-tabs mb-0" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="calender" data-toggle="tab" href="#select_rp_parent_office"
                       aria-controls="tree">
                        <span class="nav-text">ইউনিট/গ্রুপ নির্বাচন</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-0" id="activity" data-toggle="tab"
                       href="#select_entity_by_layer">
                        <span class="nav-text">অফিস নির্বাচন</span>
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
                    <div class="col-md-12 rp_auditee_parent_office_tree"></div>
                </div>
                <div class="tab-pane border border-top-0 p-3 fade" id="select_entity_by_layer"
                     role="tabpanel" aria-labelledby="activity-tab">
                    <div class="px-3">
                        <x-rp-office-select grid="6" unit="true"/>
                    </div>
                    <div class="col-md-12 rp_auditee_office_tree"></div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-7">
        <div class="row">
            <div class="offset-6 col-md-6 text-right p-2">
                <button class="btn btn-sm btn-square btn-primary btn-hover-success mr-2"
                        onclick="Annual_Plan_Container.submitAnnualPlan($(this))"><i class="fa fa-save"></i> সংরক্ষণ
                </button>
            </div>
        </div>

        <form id="annual_plan_form">
            <div class="form-row">
                <div class="col-md-4">
                    <label for="total_unit_no">প্রতিষ্ঠানের মোট ইউনিটের সংখ্যা<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="total_unit_no" name="total_unit_no">
                </div>

                <div class="col-md-4">
                    <label for="subject_matter">সাবজেক্ট ম্যাটার<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="subject_matter" name="subject_matter">
                </div>

                <div class="col-md-4">
                    <label for="budget">বাজেট</label>
                    <input class="form-control" type="text" id="budget" name="budget">
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
                            <i class="fa fa-plus"></i> টিম গঠন করুন
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
            <input type="hidden" name="schedule_id" value="{{$schedule_id}}">
            <input type="hidden" name="op_audit_calendar_event_id" value="{{$op_audit_calendar_event_id}}">
            <input type="hidden" name="activity_id" value="{{$activity_id}}">
            <input type="hidden" name="milestone_id" value="{{$milestone_id}}">
            <input type="hidden" name="fiscal_year_id" value="{{$fiscal_year_id}}">
        </form>
    </div>
</div>

@include('scripts.script_generic')
<script>
    $("select#office_layer_id").change(function () {
        layer_id = $(this).val();
        ministry_id = $('#ministry_id').val();
        Annual_Plan_Container.loadRPAuditeeOffices(ministry_id, layer_id);
    });

    $("select#parent_office_layer_id").change(function () {
        layer_id = $(this).val();
        ministry_id = $('#parent_ministry_id').val();
        Annual_Plan_Container.loadRPParentAuditeeOffices(ministry_id, layer_id);
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




