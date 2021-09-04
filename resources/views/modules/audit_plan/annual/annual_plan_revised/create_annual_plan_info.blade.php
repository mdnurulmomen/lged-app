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
                <li class="nav-item">
                    <a class="nav-link" id="calender" data-toggle="tab" href="#select_entity_by_search"
                       aria-controls="tree">
                        <span class="nav-text">Find Office</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="operational_calendar_tab">
                <div class="tab-pane border border-top-0 p-3 fade show active" id="select_entity_by_layer"
                     role="tabpanel" aria-labelledby="activity-tab">
                    <div class="px-3">
{{--                        <x-rp-office-select grid="6" unit="true"/>--}}
                        <div class="form-row">
                            <div class="col-md-6">
                                <label>মন্ত্রণালয়/বিভাগ</label>
                                <select class="form-control" name="" id="">
                                    <option value="">--মন্ত্রণালয়/বিভাগ--</option>
                                    <option value="">ministry 1</option>
                                    <option value="">ministry 2</option>
                                    <option value="">ministry 3</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label>প্রতিষ্ঠানের ধরণ</label>
                                <select class="form-control" name="" id="">
                                    <option value="">--প্রতিষ্ঠানের ধরণ--</option>
                                    <option value="">Layer 1</option>
                                    <option value="">Layer 2</option>
                                    <option value="">Layer 3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="rp_auditee_office_tree">
                        <div class="col-md-12">
                                <div class="tree-demo rounded-0 rp_auditee_offices jstree-init jstree-1 jstree-default jstree jstree-default-responsive jstree-checkbox-selection" style="overflow-y: scroll; height: 60vh" role="tree" aria-multiselectable="true" tabindex="0" aria-activedescendant="j1_1" aria-busy="false"><ul class="jstree-container-ul jstree-children" role="group"><li role="treeitem" data-rp-auditee-entity-id="1" data-entity-info="{&quot;entity_id&quot;:1,&quot;entity_name_en&quot;:&quot;Ministry of Social Welfare&quot;,&quot;entity_name_bn&quot;:&quot;\u09b8\u09ae\u09be\u099c\u0995\u09b2\u09cd\u09af\u09be\u09a3 \u09ae\u09a8\u09cd\u09a4\u09cd\u09b0\u09a3\u09be\u09b2\u09df&quot;,&quot;ministry_id&quot;:&quot;1&quot;,&quot;ministry_name_en&quot;:&quot;Ministry of Social Welfare&quot;,&quot;ministry_name_bn&quot;:&quot;\u09b8\u09ae\u09be\u099c\u0995\u09b2\u09cd\u09af\u09be\u09a3 \u09ae\u09a8\u09cd\u09a4\u09cd\u09b0\u09a3\u09be\u09b2\u09df&quot;}" data-jstree="{ &quot;opened&quot; : true }" aria-selected="false" aria-level="1" aria-labelledby="j1_1_anchor" aria-expanded="true" id="j1_1" class="jstree-node  jstree-open"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" id="j1_1_anchor"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon fal fa-folder jstree-themeicon-custom" role="presentation"></i>
                                                Office
                                            </a>
                                            <ul role="group" class="jstree-children">
                                                <li role="treeitem" data-rp-auditee-entity-id="2" data-entity-info="{&quot;entity_id&quot;:2,&quot;entity_name_en&quot;:&quot;Social Directorate&quot;,&quot;entity_name_bn&quot;:&quot;\u09b8\u09ae\u09be\u099c\u09b8\u09c7\u09ac\u09be \u0985\u09a7\u09bf\u09a6\u09ab\u09a4\u09b0&quot;,&quot;ministry_id&quot;:&quot;1&quot;,&quot;ministry_name_en&quot;:&quot;Ministry of Social Welfare&quot;,&quot;ministry_name_bn&quot;:&quot;\u09b8\u09ae\u09be\u099c\u0995\u09b2\u09cd\u09af\u09be\u09a3 \u09ae\u09a8\u09cd\u09a4\u09cd\u09b0\u09a3\u09be\u09b2\u09df&quot;}" data-jstree="{ &quot;opened&quot; : true }" aria-selected="false" aria-level="2" aria-labelledby="j1_2_anchor" aria-expanded="true" id="j1_2" class="jstree-node  jstree-open"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" id="j1_2_anchor"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon fal fa-folder jstree-themeicon-custom" role="presentation"></i>
                                                        office Sub 01
                                                    </a>
                                                    <ul role="group" class="jstree-children"><li role="treeitem" data-rp-auditee-entity-id="3" data-entity-info="{&quot;entity_id&quot;:3,&quot;entity_name_en&quot;:&quot;Social Directorate,Feni&quot;,&quot;entity_name_bn&quot;:&quot;\u099c\u09c7\u09b2\u09be \u09b8\u09ae\u09be\u099c\u09b8\u09c7\u09ac\u09be \u0995\u09be\u09b0\u09cd\u09af\u09be\u09b2\u09df,\u09ab\u09c7\u09a8\u09c0&quot;,&quot;ministry_id&quot;:&quot;1&quot;,&quot;ministry_name_en&quot;:&quot;Ministry of Social Welfare&quot;,&quot;ministry_name_bn&quot;:&quot;\u09b8\u09ae\u09be\u099c\u0995\u09b2\u09cd\u09af\u09be\u09a3 \u09ae\u09a8\u09cd\u09a4\u09cd\u09b0\u09a3\u09be\u09b2\u09df&quot;}" data-jstree="{ &quot;opened&quot; : true }" aria-selected="false" aria-level="3" aria-labelledby="j1_3_anchor" aria-expanded="true" id="j1_3" class="jstree-node  jstree-open"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" id="j1_3_anchor"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon fal fa-folder jstree-themeicon-custom" role="presentation"></i>
                                                                office Sub Sub 01
                                                            </a>
                                                        </li>
                                                        <li role="treeitem" data-rp-auditee-entity-id="5" data-entity-info="{&quot;entity_id&quot;:5,&quot;entity_name_en&quot;:&quot;district drictorate,comilla&quot;,&quot;entity_name_bn&quot;:&quot;\u099c\u09c7\u09b2\u09be \u09b8\u09ae\u09be\u099c\u09b8\u09c7\u09ac\u09be \u0995\u09be\u09b0\u09cd\u09af\u09be\u09b2\u09df,\u0995\u09c1\u09ae\u09bf\u09b2\u09cd\u09b2\u09be&quot;,&quot;ministry_id&quot;:&quot;1&quot;,&quot;ministry_name_en&quot;:&quot;Ministry of Social Welfare&quot;,&quot;ministry_name_bn&quot;:&quot;\u09b8\u09ae\u09be\u099c\u0995\u09b2\u09cd\u09af\u09be\u09a3 \u09ae\u09a8\u09cd\u09a4\u09cd\u09b0\u09a3\u09be\u09b2\u09df&quot;}" data-jstree="{ &quot;opened&quot; : true }" aria-selected="false" aria-level="3" aria-labelledby="j1_5_anchor" id="j1_5" class="jstree-node  jstree-leaf"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" id="j1_5_anchor"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon fal fa-folder jstree-themeicon-custom" role="presentation"></i>
                                                                office Sub Sub 02
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li role="treeitem" data-rp-auditee-entity-id="7" data-entity-info="{&quot;entity_id&quot;:7,&quot;entity_name_en&quot;:&quot;new office&quot;,&quot;entity_name_bn&quot;:&quot;new office&quot;,&quot;ministry_id&quot;:&quot;1&quot;,&quot;ministry_name_en&quot;:&quot;Ministry of Social Welfare&quot;,&quot;ministry_name_bn&quot;:&quot;\u09b8\u09ae\u09be\u099c\u0995\u09b2\u09cd\u09af\u09be\u09a3 \u09ae\u09a8\u09cd\u09a4\u09cd\u09b0\u09a3\u09be\u09b2\u09df&quot;}" data-jstree="{ &quot;opened&quot; : true }" aria-selected="false" aria-level="2" aria-labelledby="j1_8_anchor" id="j1_8" class="jstree-node  jstree-leaf"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" id="j1_8_anchor"><i class="jstree-icon jstree-checkbox" role="presentation"></i><i class="jstree-icon jstree-themeicon fal fa-folder jstree-themeicon-custom" role="presentation"></i>
                                                        New office
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="tab-pane fade border border-top-0 p-3" id="select_entity_by_search" role="tabpanel"
                     aria-labelledby="calender-tab">
{{--                    <x-find-office/>--}}
                    <input type="text" class="form-control">
                    <div class="rp_auditee_office_tree">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-7">
        <div class="form-row pt-10">
            <div class="col-md-6">
                <label>প্রতিষ্ঠানের মোট ইউনিটের সংখ্যা</label>
                <input class="form-control"  type="text">
            </div>

            <div class="col-md-6">
                <label>সাবজেক্ট ম্যাটার</label>
                <input class="form-control"  type="text">
            </div>
        </div>

        <div class="p-4 mt-4 card">
            <div class="form-row">
                <div class="col-md-12">
                    <div class="pl-4">
                            <li style="border: 2px solid #7addd8;list-style: none;margin: 5px;padding-left: 4px" draggable="true" ondragend="dragEnd()" ondragover="dragOver(event)" ondragstart="dragStart(event)"><i class="fa fa-home pr-2"></i>Office 1</li>
                            <li style="border: 2px solid #7addd8;list-style: none;margin: 5px;padding-left: 4px" draggable="true" ondragend="dragEnd()" ondragover="dragOver(event)" ondragstart="dragStart(event)"><i class="fa fa-home pr-2"></i>Office 2</li>
                            <li style="border: 2px solid #7addd8;list-style: none;margin: 5px;padding-left: 4px" draggable="true" ondragend="dragEnd()" ondragover="dragOver(event)" ondragstart="dragStart(event)"><i class="fa fa-home pr-2"></i>Office 3</li>
                            <li style="border: 2px solid #7addd8;list-style: none;margin: 5px;padding-left: 4px" draggable="true" ondragend="dragEnd()" ondragover="dragOver(event)" ondragstart="dragStart(event)"><i class="fa fa-home pr-2"></i>Office 4</li>
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
                            <option value="">--পপদবি--</option>
                            <option value="">Layer 1</option>
                            <option value="">Layer 2</option>
                            <option value="">Layer 3</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>দায়িত্ব</label>
                        <select class="form-control" name="" id="">
                            <option value="">--দায়িত্ব--</option>
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
                        <button onclick="Annual_Plan_Container.addTeamSection($(this))" class="btn btn-primary"><i class="fa fa-plus"></i></button>
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

{{--<form id="annual_plan_core_data_form">--}}
{{--    <input type="hidden" name="schedule_id" value="{{$schedule_id}}">--}}
{{--    <input type="hidden" name="activity_id" value="{{$activity_id}}">--}}
{{--    <input type="hidden" name="milestone_id" value="{{$milestone_id}}">--}}
{{--</form>--}}

<div id="annual_plan_submission_hr_modal_area">

</div>
@include('scripts.script_generic')
<script>
    $(document).ready(function () {
        Annual_Plan_Container.loadSelectedAuditeeEntities($('#annual_plan_core_data_form').serializeArray());
    });

    $("select#office_layer_id").change(function () {
        layer_id = $(this).val();
        ministry_id = $('#ministry_id').val();
        Annual_Plan_Container.loadRPAuditeeOffices(ministry_id, layer_id );
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




