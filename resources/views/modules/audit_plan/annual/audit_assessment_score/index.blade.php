<x-title-wrapper>Auditability Assessment Score</x-title-wrapper>

<div class="row mt-3 p-2 page-title-wrapper d-md-flex align-items-md-center">
    <div class="col-md-12">
        <div class="d-flex justify-content-end">
            <a class="btn btn-primary btn-sm btn-bold btn-square"
               href="javascript:;" onclick="Assessment_Score_Container.create()">
                <i class="far fa-plus mr-1"></i> এনটিটি/সংস্থা যোগ করুন
            </a>
        </div>
    </div>
</div>

<div class="row p-2">
    <div class="col-md-12">
        <select class="form-control select-select2" id="fiscal_year_id">
            <option value="">--সিলেক্ট--</option>
            @foreach($fiscal_years as $fiscal_year)
                <option value="{{$fiscal_year['id']}}" {{$fiscal_year['id'] == 1?'selected':''}}>
                    {{$fiscal_year['description']}}
                </option>
            @endforeach
        </select>
    </div>
</div>


<div class="px-3" id="load_assessment_score_list"></div>


<script>
    $(function () {
        fiscal_year_id = $("#fiscal_year_id").val();
        Assessment_Score_Container.list(fiscal_year_id);
    });

    $('#fiscal_year_id').change(function () {
        fiscal_year_id = $("#fiscal_year_id").val();
        Assessment_Score_Container.list(fiscal_year_id);
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

        list: function (fiscal_year_id) {
            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });
            url = '{{route('audit.plan.annual.audit-assessment-score.list')}}';
            data = {fiscal_year_id};
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.warning(response.data)
                } else {
                    $('#load_assessment_score_list').html(response);
                }
            })
        },

        edit: function (elem) {
            let audit_assessment_score_id = elem.data('audit-assessment-score-id');
            url = '{{route('audit.plan.annual.audit-assessment-score.edit')}}';
            data = {audit_assessment_score_id};

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
    }
</script>
