<x-title-wrapper>Role Menu Map</x-title-wrapper>

<div class="px-3 py-3" id="load_role_list"></div>

<div class="px-3" id="load_menu_module_list"></div>
<button class="btn btn-primary" onclick="PermissionAssignContainer.assignMenusToRole()"> Assign</button>
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

        loadRolesList: function (page = 1, per_page = 100) {
            let url = '{{route('settings.role-permissions.get-roles-list')}}';
            ajaxCallAsyncCallbackAPI(url, {}, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('#load_role_list').html(response);
                }
            });
        },
        assignMenusToRole: function () {
            menus = $("#menuAssignForm input:checkbox:checked").map(function () {
                if ($(this).attr('data-type') == 'menu') {
                    return $(this).val();
                }
            }).get();
            modules = $("#menuAssignForm input:checkbox:checked").map(function () {
                if ($(this).attr('data-type') == 'module') {
                    return $(this).val();
                }
            }).get();
            modules = JSON.stringify(modules);
            menus = JSON.stringify(menus);
            role_id = $('#role_id').val();

            url = '{{route('settings.role-permissions.assign-menus-to-role')}}';
            data = {modules, menus, role_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'success') {
                    toastr.success(response.data);
                } else {
                    toastr.error(response.data);
                }
            });
        },
    };

    $(function () {
        PermissionAssignContainer.loadRolesList();
        PermissionAssignContainer.loadMenuModuleLists();
    });
</script>
