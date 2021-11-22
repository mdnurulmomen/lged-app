<x-title-wrapper>Employee Permission Map</x-title-wrapper>
<div class="row mt-3">
    <div class="col-md-6" style="overflow-y: scroll; height: 65vh">
        <div class="tree-demo rounded-0 office_organogram_tree jstree-init jstree-1 jstree-default">
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
        'designation_en' => htmlspecialchars($designation['designation_eng']),
        'designation_bn' => htmlspecialchars($designation['designation_bng']),
        'officer_name' => !empty($designation['employee_info']) ? $designation['employee_info']['name_eng'] : '',
        'officer_id' => !empty($designation['employee_info']) ? $designation['employee_info']['id'] : '',
        'unit_id' => $unit['office_unit_id'],
        'unit_name_en' => htmlspecialchars($unit['unit_name_eng']),
        'unit_name_bn' => htmlspecialchars($unit['unit_name_bng']),
        'office_id' => $officer_list['office_id'],
        'master_designation_id' => $designation['ref_designation_master_info_id'],
        ], JSON_UNESCAPED_UNICODE)}}"
                                            data-jstree='{ "icon" : "{{!empty($designation['employee_info']) ? "fas": "fal"}} fa-user text-warning" }'>
                                            {{$designation['employee_info']['name_eng'].','}} {{$designation['designation_eng']}}
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-md-6" style="overflow-y: scroll; height: 65vh">
        <div class="px-3 py-1" id="load_role_list"></div>
        <div id="load_menu_module_list"></div>
    </div>
</div>
<button class="btn btn-primary mb-5" onclick="IndividualPermissionAssignContainer.assignMenusToRole()"> Assign</button>
<script>
    var officer_info = '';
    $(`.jstree-init`).jstree({
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
        "plugins": ["types"]
    });

    $('.office_organogram_tree').on('select_node.jstree', function (e, data) {
        officer_info = $('#' + data.node.id).data('officer-info')
    })
    var IndividualPermissionAssignContainer = {
        loadMenuModuleLists: function (page = 1, per_page = 100) {
            let data = {page, per_page};
            let url = '{{route('settings.role-permissions.get-menu-module-lists')}}';
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('#load_menu_module_list').html(response);
                }
            });
        },
        loadRolesList: function () {
            let url = '{{route('settings.role-permissions.get-roles-list')}}';
            ajaxCallAsyncCallbackAPI(url, {}, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('#load_role_list').html(response);
                    $('#role_id').prepend('<option selected value="all"> All </option>');
                }
            });
        },

        assignMenusToRole: function () {
            menu_actions = $("#menuAssignForm input:checkbox:checked").map(function () {
                return $(this).val();
            }).get();
            menu_actions = JSON.stringify(menu_actions);
            if (officer_info !== '') {
                designation_id = officer_info.designation_id;
                master_designation_id = officer_info.master_designation_id;
                url = '{{route('settings.role-permissions.assign-menus-to-employee')}}';
                data = {menu_actions, designation_id, master_designation_id};
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'success') {
                        toastr.success(response.data);
                    } else {
                        toastr.error(response.data);
                    }
                });
            } else {
                toastr.warning('Please Choose Designated Employee.');
            }
        },
    };

    $(function () {
        // IndividualPermissionAssignContainer.loadRolesList();
        IndividualPermissionAssignContainer.loadMenuModuleLists();
    });
</script>
