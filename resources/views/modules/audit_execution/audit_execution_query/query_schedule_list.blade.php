<x-title-wrapper>Fiscal Years</x-title-wrapper>
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
    var auditQuerySchedule = {
        selectQuery: function () {

            quick_panel = $("#kt_quick_panel");
            quick_panel.addClass('offcanvas-on');
            quick_panel.css('opacity', 1);
            quick_panel.css('width', '800px');
            $('.offcanvas-footer').hide();
            quick_panel.removeClass('d-none');
            $("html").addClass("side-panel-overlay");
            $('.offcanvas-title').html('Send Query');
            url = '{{route('audit.execution.select-audit-query')}}';
            data = {};
            ajaxCallAsyncCallbackAPI(url, data, 'get', function (response) {
                if (response.status === 'error') {
                    toastr.warning(response.data)
                } else {
                    $('.offcanvas-wrapper').html(response);
                }
            })
        }
    }
</script>
