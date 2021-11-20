<script>
    var Menu_Action_Container = {
        loadTypeWiseMenuActionList: function (type, page = 1, per_page = 100) {
            let data = {type, page, per_page};
            let url = '{{route('settings.menu-actions.load-type-wise-menu-action')}}';
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('#load_menu_action_list').html(response);
                }
            });
        },

        loadMenuActionCreateForm: function () {
            url = '{{route('settings.menu-actions.create')}}';
            type = '{{$type}}';
            data = {type};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                }
                else {
                    $(".offcanvas-title").text(type.charAt(0).toUpperCase() + type.slice(1));
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

        loadMenuActionEditForm: function (elem) {
            menu_action_id = elem.data('menu-action-id')
            type = elem.data('type')
            data = {menu_action_id,type};
            url = '{{route('settings.menu-actions.edit')}}';

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                }
                else {
                    $(".offcanvas-title").text(type.charAt(0).toUpperCase() + type.slice(1)+' Edit');
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


        saveMenuAction: function (url, data, mode = 'create') {
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'success') {
                    type = '{{$type}}';
                    toastr.success('Successfully '+type+' has been saved');
                    $('#kt_quick_panel_close').click();
                    Menu_Action_Container.loadTypeWiseMenuActionList(type);
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

        storeMenuAction: function () {
            url = '{{route('settings.menu-actions.store')}}';
            data = $('#menu_action_create_form').serialize();
            Menu_Action_Container.saveMenuAction(url, data, 'create');
        },

        updateMenuAction: function () {
            url = '{{route('settings.menu-actions.update')}}';
            data = $('#menu_action_update_form').serialize();
            Menu_Action_Container.saveMenuAction(url, data, 'update');
        },
    };
</script>
