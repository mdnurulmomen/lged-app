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
                        <input checked id="project" value="project" onclick="Risk_Assessment_Factor_Approach_Container.loadRiskFactorType('project')" type="radio" name="item_type"> Project
                        <input id="function" value="function" onclick="Risk_Assessment_Factor_Approach_Container.loadRiskFactorType('function')" type="radio" name="item_type"> Function
                        <input id="master-unit" value="master-unit" onclick="Risk_Assessment_Factor_Approach_Container.loadRiskFactorType('master-unit')" type="radio" name="item_type"> Unit
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

                    <div style="display: none"  class="unit_div">
                        <select class="form-control select-select2" name="unit_master_id" id="unit_master_id">
                            <option selected value="">Select Unit(master)</option>
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
            <table style="table-layout: fixed" class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th width="30%">Risk Factor</th>
                    <th width="30%">Criteria</th>
                    <th width="60%">Rating Details</th>
                </tr>
                </thead>
                <tbody>
                @foreach($all_risk_factors as $risk_factor)
                    <tr class="risk_factor_row">
                        <td>
                            {{$risk_factor['title_bn']}}

                            <input class="risk_factor_id" type="hidden" name="risk_factor_id" value="{{$risk_factor['id']}}">
                            <input class="risk_factor_title_en" type="hidden" name="risk_factor_title_en" value="{{$risk_factor['title_en']}}">
                            <input class="risk_factor_title_bn" type="hidden" name="risk_factor_title_bn" value="{{$risk_factor['title_bn']}}">
                            <input class="risk_factor_weight" type="hidden" name="risk_factor_weight" value="{{$risk_factor['risk_weight']}}">
                        </td>
                        <td>
                            @if($risk_factor['risk_factor_criteria'])
                                <ul class="list-group list-group-flush">
                                    @foreach($risk_factor['risk_factor_criteria'] as $criteria)
                                        <li class="list-group-item p-0"><b>{{$loop->iteration}}. </b>{{$criteria['title_bn']}},</li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                        <td>
                            <div class="form-row">
                                <div class="col-sm-12 form-group">
                                    <label for="exampleFormControlSelect1">Rating</label>

                                    <select  class="form-control select-select2 risk_rating">
                                        <option value="">Select Rating</option>
                                        @if($risk_factor['risk_factor_ratings'])
                                            @foreach($risk_factor['risk_factor_ratings'] as $risk_rating)
                                                <option value="{{$risk_rating['rating_value']}}">{{$risk_rating['rating_value'].'-'.$risk_rating['title_bn']}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col-sm-12 form-group">
                                    <label for="exampleFormControlSelect1">Comment</label>
                                    <textarea class="form-control" name="comment" rows="5"></textarea>
                                </div>

                                <div class="col-sm-12 form-group">
                                    <label for="exampleFormControlSelect1">Attachment</label>
                                    <input type="file" class="form-control-file" name="attachment">
                                </div>
                            </div>
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
                $('.unit_div').hide();
                Risk_Assessment_Factor_Approach_Container.loadProject();

            }else if(type == 'function'){
                $('.project_div').hide();
                $('.function_div').show();
                $('.cost_center_div').hide();
                $('.unit_div').hide();
                Risk_Assessment_Factor_Approach_Container.loadFunction();
            }else if(type == 'master-unit'){
                $('.project_div').hide();
                $('.function_div').hide();
                $('.cost_center_div').hide();
                $('.unit_div').show();
                Risk_Assessment_Factor_Approach_Container.loadUnit();
            }
            else if(type == 'cost_center'){
                $('.project_div').hide();
                $('.function_div').hide();
                $('.cost_center_div').show();
                $('.unit_div').hide();
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

        loadUnit:function (){
            loaderStart('loading...');
            let url = '{{route('settings.load_unit_master_select')}}';
            let data = {};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#unit_master_id').html(response);
                }
            });
        },

        storeRiskAssessmentFactor: function () {
            loaderStart('Please wait...');

            var formData = new FormData();

            // let risk_factor_info = {};
            // let risk_factor_items = [];

            let item_type = $('input[name="item_type"]:checked').val();

            // formData.append('risk_factor_info', risk_factor_info);

            if (item_type=='project') {

                formData.append('risk_factor_info[item_id]', $('#project_id').find(':selected').val());
                formData.append('risk_factor_info[item_name_bn]', $('#project_id').find(':selected').attr('data-name-bn'));
                formData.append('risk_factor_info[item_name_en]', $('#project_id').find(':selected').attr('data-name-en'));
                formData.append('risk_factor_info[item_type]', item_type);

            } else if (item_type=='function') {

                formData.append('risk_factor_info[item_id]', $('#function_id').find(':selected').val());
                formData.append('risk_factor_info[item_name_bn]', $('#function_id').find(':selected').attr('data-name-bn'));
                formData.append('risk_factor_info[item_name_en]', $('#function_id').find(':selected').attr('data-name-en'));
                formData.append('risk_factor_info[item_type]', item_type);

            } else if (item_type=='master-unit') {

                formData.append('risk_factor_info[item_id]', $('#unit_master_id').find(':selected').val());
                formData.append('risk_factor_info[item_name_bn]', $('#unit_master_id').find(':selected').attr('data-name-bn'));
                formData.append('risk_factor_info[item_name_en]', $('#unit_master_id').find(':selected').attr('data-name-en'));
                formData.append('risk_factor_info[item_type]', item_type);

            } else if (item_type=='cost_center') {

                formData.append('risk_factor_info[item_id]', $('#cost_center_id').find(':selected').val());
                formData.append('risk_factor_info[item_name_bn]', $('#cost_center_id').find(':selected').attr('data-name-bn'));
                formData.append('risk_factor_info[item_name_en]', $('#cost_center_id').find(':selected').attr('data-name-en'));
                formData.append('risk_factor_info[item_type]', item_type);

                formData.append('risk_factor_info[parent_office_id]', $('#cost_center_id').attr('data-parent-office-id'));
                formData.append('risk_factor_info[parent_office_name_en]', $('#cost_center_id').attr('data-parent-office-name-en'));
                formData.append('risk_factor_info[parent_office_name_bn]', $('#cost_center_id').attr('data-parent-office-name-bn'));

            }

            $('.risk_factor_row').each(function (index, value) {
                formData.append('risk_factor_items[' + index + '][x_risk_factor_id]', $(this).find('.risk_factor_id').val());
                formData.append('risk_factor_items[' + index + '][risk_factor_title_bn]', $(this).find('.risk_factor_title_bn').val());
                formData.append('risk_factor_items[' + index + '][risk_factor_title_en]', $(this).find('.risk_factor_title_en').val());
                formData.append('risk_factor_items[' + index + '][factor_weight]', $(this).find('.risk_factor_weight').val());
                formData.append('risk_factor_items[' + index + '][factor_rating]', $(this).find('.risk_rating').val());
                formData.append('risk_factor_items[' + index + '][comment]', $(this).find('textarea[name="comment"]').val());

                // if ($(this).find('input[type=file]')[0].files.length) {
                    formData.append('risk_factor_items[' + index + '][attachment]', $(this).find('input[type=file]')[0].files[0] ? $(this).find('input[type=file]')[0].files[0] : null);
                // }
            });

            let url = '{{route('risk-assessment.factor-approach.store')}}';

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                async: true,
                type: 'POST',
                url: url,
                data: formData,
                cache: false,
                contentType: false,
                processData : false,
            })
            .done(function(response) {
                toastr.success(response.data);
                Risk_Assessment_Factor_Approach_Container.backToList();
            })
            .fail(function(response) {
                toastr.error(response.data)
            })
            .always(function() {
                loaderStop();
            });
        },
        backToList: function () {
            $('.factor_approach_link  a').click();
        }
    };
</script>
