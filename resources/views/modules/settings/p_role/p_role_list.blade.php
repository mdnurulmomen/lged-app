<x-title-wrapper>Role List</x-title-wrapper>

<div class="col-md-12">
    <div class="d-flex justify-content-end">
        <a class="btn btn-primary btn-sm btn-bold btn-square"
           href="javascript:;" onclick="Role_Container.loadRoleCreateForm()">
            <i class="far fa-plus mr-1"></i> Add Role
        </a>
    </div>
</div>

<div class="px-3" id="load_role_list"></div>

<script>
    var Role_Container = {
        loadRoleList: function (page = 1, per_page = 100) {
            let data = {page, per_page};
            let url = '{{route('settings.roles.lists')}}';
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('#load_role_list').html(response);
                }
            });
        },

        loadRoleCreateForm: function () {
            url = '{{route('settings.roles.create')}}';
            data = {};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('Role');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '40%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },

        editRole: function (elem) {
            role_id = elem.data('role-id');

            data = {role_id};
            url = '{{route('settings.roles.edit')}}';

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('Role Edit');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '40%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },

        saveRole: function (url, data, mode = 'create') {
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'success') {
                    toastr.success('Successfully role has been saved');
                    $('#kt_quick_panel_close').click();
                    Role_Container.loadRoleList();
                } else {
                    if (response.statusCode === '422') {
                        var errors = response.msg;
                        $.each(errors, function (k, v) {
                            if (v !== '') {
                                toastr.error(v);
                            }
                        });
                    } else {
                        toastr.error(response.data.message);
                    }
                }
            })
        },

        storeRole: function () {
            url = '{{route('settings.roles.store')}}';
            data = $('#role_create_form').serialize();
            Role_Container.saveRole(url, data, 'create');
        },

        updateRole: function () {
            url = '{{route('settings.roles.update')}}';
            data = $('#role_update_form').serialize();
            Role_Container.saveRole(url, data, 'update');
        },

        loadMasterDesignationAssignCreateForm: function (elem) {
            role_id = elem.data('role-id');
            role_name_en = elem.data('role-name-en');
            data = {role_id, role_name_en};
            url = '{{route('settings.roles.load-master-designation-role-map')}}';

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('Role Designation Map (' + role_name_en + ')');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '40%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },

        loadAssignedMasterDesignationRoleMap: function (role) {
            let data = {role};
            let url = '{{route('settings.roles.assigned-master-designation-role-map')}}';
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $("#master_designation_role_map_form input:checkbox").map(function () {
                        $(this).prop('checked', false);
                    })
                    $("#master_designation_role_map_form input:checkbox").map(function () {
                        num = parseInt($(this).val());
                        if (response.data.includes(num.toString())) {
                            $(this).prop('checked', true);
                        }
                    })
                }
            });
        },

        storeMasterDesignationRoleMap: function () {
            data = $('#master_designation_role_map_form').serializeArray();
            url = '{{route('settings.roles.store-master-designation-role-map')}}';
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'success') {

                    toastr.success('Successfully role has been saved');
                    $('#kt_quick_panel_close').click();
                    Role_Container.loadRoleList();
                } else {
                    if (response.statusCode === '422') {
                        var errors = response.msg;
                        $.each(errors, function (k, v) {
                            if (v !== '') {
                                toastr.error(v);
                            }
                        });
                    } else {
                        toastr.error(response.data.message);
                    }
                }
            })
        }
    };

    $(function () {
        Role_Container.loadRoleList();
    });
</script>
