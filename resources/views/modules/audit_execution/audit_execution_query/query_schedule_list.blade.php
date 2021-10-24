<x-title-wrapper>Audit Schedules</x-title-wrapper>
<div class="col-md-12 p-0">
    <div class="load-table-data" data-href="{{route('audit.execution.load-query-schedule-lists')}}"></div>
</div>
<script>
    $(function () {
        loadData();
    });

    function loadData() {
        url = $(".load-table-data").data('href');
        var data = {};
        ajaxCallAsyncCallbackAPI(url, data, 'GET', function (resp) {
            if (resp.status === 'error') {
                toastr.error('no');
                console.log(resp.data)
            } else {
                $(".load-table-data").html(resp);
            }
        });
    }
</script>
<script>
    var Audit_Query_Container = {
        sendQuery: function (elem) {
            cost_center_id = $('#cost_center_id').val();
            cost_center_name_en = $('#cost_center_name_en').val();
            cost_center_name_bn = $('#cost_center_name_bn').val();
            cost_center_type_id = $('#cost_center_type').val();
            queries = {};
            $(".selectQuery").each(function (i, value) {
                if ($(this).is(':checked') && !$(this).is(':disabled')) {
                    queries[$(this).val()] = {
                        query_id: $(this).attr('data-query-id'),
                        query_title_en: $(this).attr('data-query-en'),
                        query_title_bn: $(this).attr('data-query-bn'),
                    }
                }
            });

            console.log(queries);

            if (!queries) {
                toastr.warning('Please Select Query');
                return;
            }

            url = '{{route('audit.execution.send-audit-query')}}';
            data = {queries, cost_center_id, cost_center_type_id, cost_center_name_bn, cost_center_name_en};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.warning(response.data)
                } else {
                    $('#cost_center_type').trigger('change');
                    toastr.success(response.data)
                }
            })
        },

        receivedQuery: function (query_id) {
            cost_center_id = $('#cost_center_id').val();
            cost_center_name_en = $('#cost_center_name_en').val();
            cost_center_name_bn = $('#cost_center_name_bn').val();
            cost_center_type_id = $('#cost_center_type').val();

            url = '{{route('audit.execution.received-audit-query')}}';
            data = {query_id, cost_center_id, cost_center_type_id, cost_center_name_bn, cost_center_name_en};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.warning(response.data)
                } else {
                    $('#cost_center_type').trigger('change');
                    toastr.success(response.data)
                }
            })
        },

        selectQuery: function (elem) {
            quick_panel = $("#kt_quick_panel");
            $('.offcanvas-wrapper').html('');
            quick_panel.addClass('offcanvas-on');
            quick_panel.css('opacity', 1);
            quick_panel.css('width', '800px');
            $('.offcanvas-footer').hide();
            quick_panel.removeClass('d-none');
            $("html").addClass("side-panel-overlay");
            $('.offcanvas-title').html('Send Query');
            url = '{{route('audit.execution.select-audit-query')}}';
            cost_center_name_en = elem.attr('data-cost-center-name-en');
            cost_center_name_bn = elem.attr('data-cost-center-name-bn');
            cost_center_id = elem.attr('data-cost-center-id');
            cost_center_type_id = elem.attr('data-cost-center-type-id');
            data = {cost_center_id, cost_center_name_en, cost_center_name_bn, cost_center_type_id};
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.warning(response.data)
                } else {
                    $('.offcanvas-wrapper').html(response);
                }
            })
        },

        memo: function (elem) {
            schedule_id = elem.data('schedule-id');
            audit_plan_id = elem.data('audit-plan-id');
            cost_center_id = elem.data('cost-center-id');

            data = {schedule_id, audit_plan_id, cost_center_id};
            let url = '{{route('audit.execution.memo.index')}}'
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#kt_content').html(response)
                }
            });
        },
    }
</script>

