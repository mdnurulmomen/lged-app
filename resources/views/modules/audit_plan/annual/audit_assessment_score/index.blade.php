<x-title-wrapper>Auditability Assessment Score</x-title-wrapper>

<div class="col-md-12">
    <div class="d-flex justify-content-end">
        <a class="btn btn-primary btn-sm btn-bold btn-square"
           href="javascript:;" onclick="Assessment_Score_Container.create()">
            <i class="far fa-plus mr-1"></i> Add Score
        </a>
    </div>
</div>

<div class="px-3" id="load_assessment_score_list"></div>


<script>
    $(function () {
        Assessment_Score_Container.list();
    });

    var Assessment_Score_Container = {
        create: function () {
            url = '{{route('audit.plan.annual.audit-assessment-score.create')}}';
            data = {};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error('Server Error');
                } else {
                    $(".offcanvas-title").text('Auditability Assessment Score');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '50%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },

        list: function () {
            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });
            url = '{{route('audit.plan.annual.audit-assessment-score.list')}}';
            data = {};
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.warning(response.data)
                } else {
                    $('#load_assessment_score_list').html(response);
                }
            })
        }
    }
</script>
