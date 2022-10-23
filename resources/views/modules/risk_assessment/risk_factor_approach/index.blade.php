<x-title-wrapper>Risk Assessment Factor List</x-title-wrapper>

<div class="card sna-card-border mt-3" style="margin-bottom:15px;">
    <div class="row">
        <div class="col-md-6">
        <span style="font-size: 18px">
            <input checked id="project" onclick="Risk_Assessment_Factor_Container.laodRiskAssessmentFactor('project')"
                   type="radio" name="risk_factor_type"> Project
            <input id="function" onclick="Risk_Assessment_Factor_Container.laodRiskAssessmentFactor('function')"
                   type="radio" name="risk_factor_type"> Function
            <input id="cost_center"
                   onclick="Risk_Assessment_Factor_Container.laodRiskAssessmentFactor('unit')" type="radio"
                   name="risk_factor_type"> Unit
        </span>
        </div>
        <div class="col-md-6 text-right">
            <button class="btn btn-sm btn-info btn-square mr-1" title="বিস্তারিত দেখুন"
                    onclick='loadPage($(this))'
                    data-url="{{route('risk-assessment.factor-approach.create')}}"
            >
                <i class="fad fa-plus"></i> Create
            </button>
        </div>
    </div>
</div>

<div class="card sna-card-border mt-3" style="margin-bottom:30px;">
    <div class="table-responsive">
        <div class="load-risk-assessment-factor"></div>
    </div>
</div>


<script>
    $(function () {
        Risk_Assessment_Factor_Container.laodRiskAssessmentFactor('project');
    });
    var Risk_Assessment_Factor_Container = {
        laodRiskAssessmentFactor: function (type) {
            loaderStart('loading...');
            let url = '{{route('risk-assessment.factor-approach.load-risk-assessment-factor')}}';
            let data = {type};
            ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
                loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('.load-risk-assessment-factor').html(response);
                }
            });
        },
    };
</script>

