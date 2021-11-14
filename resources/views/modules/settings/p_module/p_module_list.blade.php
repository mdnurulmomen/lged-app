<x-title-wrapper>Module List</x-title-wrapper>

<div class="col-md-12">
    <div class="d-flex justify-content-end">
        <a class="btn btn-primary btn-sm btn-bold btn-square"
           href="javascript:;" onclick="Module_Container.loadModuleCreateForm()">
            <i class="far fa-plus mr-1"></i> Add Module
        </a>
    </div>
</div>

<div class="px-3" id="load_module_list"></div>

<script>
    var Module_Container = {
        loadModuleList: function (page = 1, per_page = 100) {
            let data = {page, per_page};
            let url = '{{route('settings.module-menus.lists')}}';
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('#load_module_list').html(response);
                }
            });
        },

        loadModuleCreateForm: function () {
            url = '{{route('settings.module-menus.create')}}';
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
                    $(".offcanvas-title").text('Module');
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
        Module_Container.loadModuleList();
    });
</script>
