<x-title-wrapper>Role List</x-title-wrapper>

<div class="col-md-12">
    <div class="d-flex justify-content-end">
        <a class="btn btn-primary btn-sm btn-bold btn-square"
           href="javascript:;" onclick="Assign_Designation_Container.loadRoleCreateForm()">
            <i class="far fa-plus mr-1"></i> Assign Designation
        </a>
    </div>
</div>

<div class="px-3" id="load_role_list"></div>

<script>
    var Assign_Designation_Container = {
        loadRoleCreateForm: function () {
            url = '{{route('settings.roles.designation-role-map')}}';
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
                    $(".offcanvas-title").text('Role Designation Map');
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
            url = '{{route('settings.roles.update')}}';
            data = $('#role_create_form').serialize();
            Role_Container.saveRole(url, data, 'create');
        },

        updateRole: function () {
            url = '{{route('settings.roles.store')}}';
            data = $('#role_update_form').serialize();
            Role_Container.saveRole(url, data, 'update');
        },

    };
</script>
