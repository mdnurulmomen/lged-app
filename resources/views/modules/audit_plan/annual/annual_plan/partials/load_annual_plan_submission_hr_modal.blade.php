<x-modal title="Entity" size='xl' url="{{route('audit.plan.annual.plan.list.store.hr-modal')}}" method="post"
         id="annual_plan_submission_hr_modal">
    <div class="row">
        <div class="col-md-8">
            <div class="tree-demo rounded-0 office_organogram_tree jstree-1 jstree-default"
                 style="overflow-y: scroll; height: 60vh">
                <ul>
                    <li>
                        Office
                        <ul>
                            @foreach($officer_lists as $key => $officer_list)
                                @foreach($officer_list['units'] as $unit)
                                    <li data-jstree='{ "opened" : true }'>
                                        {{$unit['unit_name_eng']}}
                                        <ul>
                                            @foreach($unit['designations'] as $designation)
                                                <li data-officer-info="{{json_encode(
    [
        'designation_id' => $designation['designation_id'],
        'designation_en' => $designation['designation_eng'],
        'designation_bn' => $designation['designation_bng'],
        'officer_name_en' => !empty($designation['employee_info']) ? $designation['employee_info']['name_eng'] : '',
        'officer_name_bn' => !empty($designation['employee_info']) ? $designation['employee_info']['name_bng'] : '',
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
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-4 assigned_officers_to_plan_area">
            <form autocomplete="off" id="assigned_officers_to_plan_form">
                <div class="datatable datatable-default datatable-bordered datatable-loaded border">
                    <table class="datatable-bordered datatable-head-custom datatable-table assigned_officers_table"
                           id=""
                           style="display: block;">
                        <thead class="datatable-head">
                        <tr class="datatable-row" style="left: 0px;">
                            <th style="width: 2%" class="datatable-cell datatable-cell-sort">#</th>
                            <th style="width: 60%" class="datatable-cell datatable-cell-sort">Designation</th>
                            <th style="width: 38%" class="datatable-cell datatable-cell-sort">Name</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="mt-3">
                    <div class="form-group row">
                        <div class="col-md-2">Date</div>
                        <div class="col-md-10">
                            <div class="input-daterange input-group" id="kt_datepicker_5">
                                <input type="text" class="form-control" name="start">
                                <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-ellipsis-h"></i>
                                </span>
                                </div>
                                <input type="text" class="form-control" name="end">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2 mt-2">Budget</div>
                        <div class="col-md-10 mt-2"><input type="number" class="form-control" name="budget"/></div>
                    </div>
                </div>
                <input type="hidden" name="plan_responsible_party_id" value="{{$plan_responsible_party_id}}">
            </form>
        </div>
    </div>
</x-modal>

@include('scripts.script_generic')
<script>
    $(document).ready(function () {
        Annual_Plan_Container.jsTreeInit('office_organogram_tree');
        $('.office_organogram_tree').jstree('refresh');
    })
    Annual_Plan_Container.showHideHRModalSaveBtn();
    $('.office_organogram_tree').on('select_node.jstree', function (e, data) {
        if (data.node.children.length === 0) {
            var officer_info = $('#' + data.node.id).data('officer-info')
            if (officer_info.officer_name_en) {
                Annual_Plan_Container.addOfficerToAssignedList(officer_info)
            } else {
                toastr.warning('Select Valid Officer');
            }
        } else {
            data.node.children.map(child => {
                var officer_info = $('#' + child).data('officer-info')
                if (officer_info.officer_name_en) {
                    Annual_Plan_Container.addOfficerToAssignedList(officer_info)
                } else {
                    toastr.warning('Select Valid Officer');
                }
            })
        }
        Annual_Plan_Container.showHideHRModalSaveBtn();
    }).on('deselect_node.jstree', function (e, data) {
        if (data.node.children.length === 0) {
            var officer_info = $('#' + data.node.id).data('officer-info')
            $("#assigned_officers_to_plan_form #btn_remove_officer_" + officer_info.designation_id).click();
        } else {
            data.node.children.map(child => {
                var officer_info = $('#' + child).data('officer-info')
                $("#assigned_officers_to_plan_form #btn_remove_officer_" + officer_info.designation_id).click();
            })
        }
        Annual_Plan_Container.showHideHRModalSaveBtn();
    });

    $('#btn_annual_plan_submission_hr_modal_save').click(function () {
        Annual_Plan_Container.saveAnnualPlanHRAssigned($(this));
        Annual_Plan_Container.loadSelectedAuditeeEntities($('#annual_plan_core_data_form').serializeArray());
    });
</script>
