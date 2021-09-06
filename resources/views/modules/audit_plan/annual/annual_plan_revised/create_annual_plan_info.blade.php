<x-title-wrapper>Add Plan</x-title-wrapper>

<div class="row ml-7 mr-7 pt-4">
    <div class="col-5">
        <div class="annual_entity_selection_area">
            <ul class="nav nav-tabs custom-tabs mb-0" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active rounded-0" id="activity" data-toggle="tab"
                       href="#select_entity_by_layer">
                        <span class="nav-text">Select Office</span>
                    </a>
                </li>
                {{--                <li class="nav-item">--}}
                {{--                    <a class="nav-link" id="calender" data-toggle="tab" href="#select_entity_by_search"--}}
                {{--                       aria-controls="tree">--}}
                {{--                        <span class="nav-text">Find Office</span>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
            </ul>
            <div class="tab-content" id="operational_calendar_tab">
                <div class="tab-pane border border-top-0 p-3 fade show active" id="select_entity_by_layer"
                     role="tabpanel" aria-labelledby="activity-tab">
                    <div class="px-3">
                        <x-rp-office-select grid="6" unit="true"/>
                    </div>
                    <div class="col-md-12 rp_auditee_office_tree"></div>
                </div>
                <div class="tab-pane fade border border-top-0 p-3" id="select_entity_by_search" role="tabpanel"
                     aria-labelledby="calender-tab">
                    <input type="text" class="form-control">
                    <div class="rp_auditee_office_tree">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-7">
        <div class="row">
            <div class="offset-6 col-md-6 text-right p-2">
                <button class="btn btn-sm btn-square btn-primary btn-hover-success"
                        onclick="">Save <i class="fas fa-save"></i>
                </button>
            </div>
        </div>


        <div class="form-row">
            <div class="col-md-6">
                <label for="total_unit">প্রতিষ্ঠানের মোট ইউনিটের সংখ্যা</label>
                <input class="form-control" type="text" id="total_unit" name="total_unit">
            </div>

            <div class="col-md-6">
                <label for="subject_matter">সাবজেক্ট ম্যাটার</label>
                <input class="form-control" type="text" id="subject_matter" name="subject_matter">
            </div>
        </div>

        <div class="p-4 mt-4 card">
            <div class="form-row">
                <div class="col-md-12">
                    <div class="pl-4 selected_rp_offices">

                    </div>
                </div>
            </div>
        </div>

        <div class="p-4 mt-4 card">
            <div class="team-section">
                <div class="form-row pt-4">
                    <div class="col-md-4">
                        <label>পদবি</label>
                        <select class="form-control" name="" id="">
                            <option value="">--সিলেক্ট--</option>
                            <option value="">Layer 1</option>
                            <option value="">Layer 2</option>
                            <option value="">Layer 3</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>দায়িত্ব</label>
                        <select class="form-control" name="" id="">
                            <option value="">--সিলেক্ট--</option>
                            <option value="">Layer 1</option>
                            <option value="">Layer 2</option>
                            <option value="">Layer 3</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>জন</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="col-md-2 mt-8">
                        <button onclick="Annual_Plan_Container.addTeamSection($(this))" class="btn btn-sm btn-primary"><i
                                class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
            <div class="form-row pt-4">
                <div class="col-md-12">
                    <label>মন্তব্য</label>
                    <textarea class="form-control"></textarea>
                </div>
            </div>
        </div>

        <div class="form-row pt-4">
            <div class="col-md-12">
                <label>মন্তব্য</label>
                <textarea class="form-control"></textarea>
            </div>
        </div>
    </div>
</div>

<form id="annual_plan_core_data_form">
    <input type="hidden" name="schedule_id" value="{{$schedule_id}}">
    <input type="hidden" name="activity_id" value="{{$activity_id}}">
    <input type="hidden" name="milestone_id" value="{{$milestone_id}}">
</form>

@include('scripts.script_generic')
<script>
    $(document).ready(function () {
        Annual_Plan_Container.loadSelectedAuditeeEntities($('#annual_plan_core_data_form').serializeArray());
    });

    $("select#office_layer_id").change(function () {
        layer_id = $(this).val();
        ministry_id = $('#ministry_id').val();
        console.log('office_layer_change')
        Annual_Plan_Container.loadRPAuditeeOffices(ministry_id, layer_id);
    });

    let selected = null

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




