<x-title-wrapper>Role Menu Map</x-title-wrapper>

<div class="px-3 py-3" id="load_role_list"></div>

<div class="px-3" id="load_menu_module_list"></div>
<button class="btn btn-primary mb-5" onclick="PermissionAssignContainer.assignMenusToRole()"> Assign</button>
<script>
    var PermissionAssignContainer = {
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
                }
            });
        },

        loadRoleWiseMenuModuleList: function (role) {
            let data = {role};
            let url = '{{route('settings.role-permissions.get-role-wise-menu-module-lists')}}';
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $("#menuAssignForm input:checkbox").map(function () {
                        num = parseInt($(this).val());
                        if (response.data.includes(num.toString())) {
                            $(this).prop('checked', true);
                        }

                    })
                }
            });
        },

        assignMenusToRole: function () {
            menu_actions = $("#menuAssignForm input:checkbox:checked").map(function () {
                return $(this).val();
            }).get();
            menu_actions = JSON.stringify(menu_actions);
            role_id = $('#role_id').val();

            url = '{{route('settings.role-permissions.assign-menus-to-role')}}';
            data = {menu_actions, role_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'success') {
                    toastr.success(response.data);
                } else {
                    toastr.error(response.data);
                }
            });
        },
    };

    $(document).on('change', 'select#role_id', function () {
        PermissionAssignContainer.loadRoleWiseMenuModuleList($(this).val());
    });

    $(function () {
        PermissionAssignContainer.loadRolesList();
        PermissionAssignContainer.loadMenuModuleLists();
        PermissionAssignContainer.loadRoleWiseMenuModuleList($('#role_id').val());
    });
</script>
