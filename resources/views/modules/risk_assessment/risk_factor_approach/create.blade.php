<div class="row m-0 mb-2 page-title-wrapper d-md-flex align-items-md-center">
    <div class="col-md-6">
        <div class="title py-2">
            <h4 class="mb-0 font-weight-bold"><i class="fas fa-list mr-3"></i>Risk Assessment Factor Approach</h4>
        </div>
    </div>

    <div class="col-md-6 text-right">
        <a onclick="Risk_Assessment_Factor_Approach_Container.backToList()" class="btn btn-sm btn-warning btn_back btn-square mr-3">
            <i class="fad fa-arrow-alt-left"></i> ফেরত যান
        </a>
        <button class="btn btn-sm btn-square btn-primary mr-2" onclick="Risk_Assessment_Factor_Approach_Container.storeRiskAssessmentFactor($(this))">
            <i class="fa fa-save"></i> সংরক্ষণ করুন
        </button>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card sna-card-border">
            <div class="row">
                <div class="col-4">
                    <span style="font-size: 18px">
                        <input checked id="project" onclick="Risk_Assessment_Factor_Approach_Container.loadRiskFactorType('project')" type="radio" name="risk_factor_type"> Project
                        <input id="function" onclick="Risk_Assessment_Factor_Approach_Container.loadRiskFactorType('function')" type="radio" name="risk_factor_type"> Function
                        <input id="cost_center" onclick="Risk_Assessment_Factor_Approach_Container.loadRiskFactorType('cost_center')" type="radio" name="risk_factor_type"> Unit
                    </span>
                    <div style="display: none" class="project_div">
                        <select   class="form-control select-select2" name="project_id" id="project_id">
                            <option selected value="">select project</option>
                        </select>
                    </div>

                    <div style="display: none"  class="function_div">
                        <select  class="form-control select-select2" name="function_id" id="function_id">
                            <option selected value="">select function</option>
                        </select>
                    </div>

                    <div style="display: none"  class="cost_center_div">
                        <select class="form-control select-select2" name="cost_center_id" id="cost_center_id">
                            <option selected value="">select cost center</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2 pb-10">
    <div class="col-12">
        <div class="card sna-card-border">
            <table class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th width="30%">Risk Factor</th>
                    <th width="40%">Criteria</th>
                    <th width="30%">Risk Rating</th>
                </tr>
                </thead>
                <tbody>
                @foreach($all_risk_factor as $risk_factor)
                    <tr class="risk_factor_row">
                    <td>
                        {{$risk_factor['title_bn']}}
                        <input class="risk_factor_id" type="hidden" name="risk_factor_id" value="{{$risk_factor['id']}}">
                        <input class="risk_factor_title_en" type="hidden" name="risk_factor_title_en" value="{{$risk_factor['title_en']}}">
                        <input class="risk_factor_title_bn" type="hidden" name="risk_factor_title_bn" value="{{$risk_factor['title_bn']}}">
                        <input class="risk_factor_weight" type="hidden" name="risk_factor_weight" value="{{$risk_factor['risk_weight']}}">
                    </td>
                    <td>
                        @if($risk_factor['risk_factor_criterias'])
                            @foreach($risk_factor['risk_factor_criterias'] as $criteria)
                                <span><b>{{$loop->iteration}}. </b>{{$criteria['title_bn']}},</span>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        <select  class="form-control select-select2 risk_rating">
                            <option value="">Select Rating</option>
                            @if($risk_factor['risk_factor_ratings'])
                                @foreach($risk_factor['risk_factor_ratings'] as $risk_rating)
                                    <option value="{{$risk_rating['rating_value']}}">{{$risk_rating['title_bn']}}</option>
                                @endforeach
                            @endif
                        </select>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(function () {
        Risk_Assessment_Factor_Approach_Container.loadRiskFactorType('project');
    });

    var Risk_Assessment_Factor_Approach_Container = {
        loadYearWiseStrategicPlan: function () {
            loaderStart('loading...');
            strategic_plan_year = $('#strategic_plan_year').find(':selected').text();
            let url = '{{route('audit.plan.yearly-plan.get-individual-strategic-plan')}}';
            let data = {strategic_plan_year};
            ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
                loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('.load-year-wise-plan').html(response);
                }
            });
        },

        loadRiskFactorType:function (type){
            if(type == 'project'){
                $('.project_div').show();
                $('.function_div').hide();
                $('.cost_center_div').hide();
                Risk_Assessment_Factor_Approach_Container.loadProject();

            }else if(type == 'function'){
                $('.project_div').hide();
                $('.function_div').show();
                $('.cost_center_div').hide();
                Risk_Assessment_Factor_Approach_Container.loadFunction();
            }else if(type == 'cost_center'){
                $('.project_div').hide();
                $('.function_div').hide();
                $('.cost_center_div').show();
            }
        },

        loadProject:function (){
            loaderStart('loading...');
            let url = '{{route('settings.load_project_select')}}';
            let data = {};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#project_id').html(response);
                }
            });
        },

        loadFunction:function (){
            loaderStart('loading...');
            let url = '{{route('settings.load_function_select')}}';
            let data = {};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#function_id').html(response);
                }
            });
        },

        storeRiskAssessmentFactor: function () {
            loaderStart('Please wait...');

            risk_factor_item = {};

            risk_factor_info = {
                'project_id' : $('#project_id').find(':selected').val(),
                'project_name_bn' : $('#project_id').find(':selected').attr('data-name-bn'),
                'project_name_en' : $('#project_id').find(':selected').attr('data-name-en'),
                'function_id' : $('#function_id').find(':selected').val(),
                'function_name_bn' : $('#function_id').find(':selected').attr('data-name-bn'),
                'function_name_en' : $('#function_id').find(':selected').attr('data-name-bn'),
                'cost_center_id' : $('#cost_center_id').find(':selected').val(),
                'cost_center_name_bn' : $('#cost_center_id').find(':selected').attr('data-name-bn'),
                'cost_center_name_en' : $('#cost_center_id').find(':selected').attr('data-name-en'),
                'parent_office_id' : $('#cost_center_id').attr('data-parent-office-id'),
                'parent_office_name_en' : $('#cost_center_id').attr('data-parent-office-name-en'),
                'parent_office_name_bn' : $('#cost_center_id').attr('data-parent-office-name-bn'),
            }

            $('.risk_factor_row').each(function (j, w) {
                item = {};

                item['project_id'] = $('#project_id').find(':selected').val();
                item['function_id'] =  $('#function_id').find(':selected').val();
                item['cost_center_id'] = $('#cost_center_id').val();
                item['parent_office_id'] = $('#cost_center_id').attr('data-parent-office-id');

                item['x_risk_factor_id']  = $(this).find('.risk_factor_id').val();
                item['factor_weight']  = $(this).find('.risk_factor_weight').val();
                item['risk_factor_title_bn'] = $(this).find('.risk_factor_title_bn').val();
                item['risk_factor_title_en'] = $(this).find('.risk_factor_title_en').val();
                item['factor_rating'] = $(this).find('.risk_rating').val();

                risk_factor_item[j] = item;
            });

            let url = '{{route('risk-assessment.factor-approach.store')}}';
            let data = {risk_factor_info,risk_factor_item};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    toastr.success(response.data);
                    Risk_Assessment_Factor_Approach_Container.backToList();
                }
            });
        },
        backToList: function () {
            $('.factor_approach_link  a').click();
        }
    };
</script>
