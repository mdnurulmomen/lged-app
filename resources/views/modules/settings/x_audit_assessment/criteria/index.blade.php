<x-title-wrapper>Criteria List</x-title-wrapper>

<div class="col-md-12">
    <div class="d-flex justify-content-end">
        <a class="btn btn-primary btn-sm btn-bold btn-square"
           href="javascript:;" onclick="Criteria_Container.create()">
            <i class="far fa-plus mr-1"></i> Add Criteria
        </a>
    </div>
</div>

<div class="px-3" id="load_criteria_list"></div>

<script>
    var Criteria_Container = {
        list: function (page = 1, per_page = 100) {
            let data = {page, per_page};
            let url = '{{route('settings.audit-assessment.criteria.list')}}';
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('#load_criteria_list').html(response);
                }
            });
        },

        create: function () {
            url = '{{route('settings.audit-assessment.criteria.create')}}';
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
                    $(".offcanvas-title").text('Criteria');
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

        edit: function (elem) {
            criteria_id = elem.data('criteria-id');

            data = {criteria_id};
            url = '{{route('settings.audit-assessment.criteria.edit')}}';

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".offcanvas-title").text('Criteria Edit');
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

        saveCriteria: function (url, data, mode = 'create') {
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'success') {
                    toastr.success('Successfully criteria has been saved');
                    $('#kt_quick_panel_close').click();
                    Criteria_Container.list();
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

        storeCriteria: function () {
            let category = $("#category_id");
            let category_title_en = category.find('option:selected').attr('data-category-title-en');
            let category_title_bn = category.find('option:selected').attr('data-category-title-bn');
            $("#category_title_en").val(category_title_en);
            $("#category_title_bn").val(category_title_bn);

            url = '{{route('settings.audit-assessment.criteria.store')}}';
            data = $('#criteria_create_form').serialize();
            Criteria_Container.saveCriteria(url, data, 'create');
        },

        updateCriteria: function () {
            let category = $("#category_id");
            let category_title_en = category.find('option:selected').attr('data-category-title-en');
            let category_title_bn = category.find('option:selected').attr('data-category-title-bn');
            $("#category_title_en").val(category_title_en);
            $("#category_title_bn").val(category_title_bn);

            url = '{{route('settings.audit-assessment.criteria.update')}}';
            data = $('#criteria_update_form').serialize();
            Criteria_Container.saveCriteria(url, data, 'update');
        }
    };

    $(function () {
        Criteria_Container.list();
    });
</script>
