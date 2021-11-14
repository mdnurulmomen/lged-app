<x-title-wrapper>Menu List</x-title-wrapper>

<div class="col-md-12">
    <div class="d-flex justify-content-end">
        <a class="btn btn-primary btn-sm btn-bold btn-square"
           href="javascript:;" onclick="Menu_Container.loadMenuCreateForm()">
            <i class="far fa-plus mr-1"></i> Add Menu
        </a>
    </div>
</div>

<div class="px-3" id="load_menu_list"></div>

<script>
    var Menu_Container = {
        loadMenuList: function (page = 1, per_page = 100) {
            let data = {page, per_page};
            let url = '{{route('settings.menus.lists')}}';
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('#load_menu_list').html(response);
                }
            });
        },

        loadMenuCreateForm: function () {
            url = '{{route('settings.menus.create')}}';
            data = {};

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
                    $(".offcanvas-title").text('Menu');
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
    };

    $(function () {
        Menu_Container.loadMenuList();
    });
</script>
