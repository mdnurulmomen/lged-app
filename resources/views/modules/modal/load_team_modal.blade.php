<!-- Office Modal -->
<div class="modal fade" id="officeEmployeeModal" tabindex="-1" role="dialog"
     aria-labelledby="officeEmployeeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="officeEmployeeModalLabel">Add Team Leader/Member</h5>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs custom-tabs mb-0" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active rounded-0" data-toggle="tab" href="#set_own_office">
                            <span class="nav-text">Own Office</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#set_other_office" aria-controls="profile">
                            <span class="nav-text">Other Office</span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content" id="plan_office_tab">
                    <div class="tab-pane border border-top-0 p-3 fade show active" id="set_own_office" role="tabpanel"
                         aria-labelledby="own-tab">
                        <div class="row">
                            <div class="col-md-12 officers_list_area">
                                <div class="rounded-0 own_office_organogram_tree"
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
                                                                    @if(!empty($designation['employee_info']))
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
                                                                    @endif
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
                        </div>
                    </div>

                    <div class="tab-pane fade border border-top-0 p-3" id="set_other_office" role="tabpanel"
                         aria-labelledby="other_office-tab">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('.own_office_organogram_tree').jstree({
        "core": {
            "themes": {
                "responsive": true
            }
        },
        "types": {
            "default": {
                "icon": "fal fa-folder"
            },
            "person": {
                "icon": "fal fa-file "
            }
        },
        "plugins": ["types", "checkbox",]
    });
</script>
