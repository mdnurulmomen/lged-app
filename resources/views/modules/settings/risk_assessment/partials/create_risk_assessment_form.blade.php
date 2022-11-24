<div class="row m-0 mb-2 page-title-wrapper d-md-flex align-items-md-center">
    <div class="col-md-6">
        <div class="title py-2">
            <h4 class="mb-0 font-weight-bold"><i class="fas fa-list mr-3"></i>Create Item Risk Assessment</h4>
        </div>
    </div>

    <div class="col-md-6 text-right">
        <a id="go_back" class="btn btn-sm btn-warning btn_back btn-square mr-3">
            <i class="fad fa-arrow-alt-left"></i> ফেরত যান
        </a>
        <button class="btn btn-sm btn-square btn-primary mr-2" id="submit_button">
            <i class="fa fa-save"></i> সংরক্ষণ করুন
        </button>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="form-row">
                    <div class="col-sm-3 form-group">
                        <input type="radio" name="assessment_item_type" value="project" checked> Project
                    </div>
            
                    <div class="col-sm-3 form-group">
                        <input type="radio" name="assessment_item_type" value="function"> Function
                    </div>
                    
                    <div class="col-sm-3 form-group">
                        <input type="radio" name="assessment_item_type" value="master-unit" > Master Unit
                    </div>
            
                    <div class="col-sm-3 form-group">
                        <input type="radio" name="assessment_item_type" value="cost-center"> Cost Center
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="col-sm-12">
                        <div class="project_div">
                            <select   class="form-control select-select2" name="project_id" id="project_id">
                                <option selected>Select Project</option>
                                @foreach ($allProjects as $project)
                                    <option value="{{ $project['id'] }}">
                                        {{ $project['name_en'] }}
                                        ({{ $project['risk_score_key'] ? $project['risk_score_key'] : '--' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                
                        <div class="function_div" style="display: none">
                            <select  class="form-control select-select2" name="function_id" id="function_id">
                                <option selected>Select Function</option>
                                @foreach ($allFunctions as $function)
                                    <option value="{{ $function['id'] }}">
                                        {{ $function['name_en'] }}
                                        ({{ $function['risk_score_key'] ? $function['risk_score_key'] : '--' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                
                        <div class="unit_div" style="display: none">
                            <select class="form-control select-select2" name="unit_master_id" id="unit_master_id">
                                <option selected>Select Unit</option>
                                @foreach ($allMasterUnits as $masterUnit)
                                    <option value="{{ $masterUnit['id'] }}">
                                        {{ $masterUnit['name_en'] }}
                                        ({{ $masterUnit['risk_score_key'] ? $masterUnit['risk_score_key'] : '--' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                
                        <div class="cost_center_div" style="display: none">
                            <select class="form-control select-select2" name="cost_center_id" id="cost_center_id">
                                <option selected>Select Cost Center</option>
                                @foreach ($allCostCenters as $costCenter)
                                    <option value="{{ $costCenter['id'] }}">
                                        {{ $costCenter['name_en'] }}
                                        ({{ empty($costCenter['risk_score_key']) ? '--' : $costCenter['risk_score_key'] }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body pt-3 item_areas">
                <div class="form-row">
                    <div class="col-sm-12 pl-7 pr-7">
                        <div class="form-row">
                            <div class="col-sm-12 form-group">
                                <p for="area">
                                    Area:
                                </p>

                                <select class="form-control" name="x_audit_area_id" id="x_audit_area_id">
                                    <option selected>Please Select Area</option>
                                    @foreach ($allAreas as $area)
                                        <option value="{{ $area['id'] }}">{{ $area['name_en'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card item_area_risks">
                            <div class="card-header pt-1 pb-2">
                                <p class="text-center m-0 indexAreaRisk">Risk 1</p> 
                            </div>
                            <div class="card-body pt-1">
                                <div class="form-row">
                                    <div class="col-sm-4 form-group">
                                        <label for="email">Inherent Risk:</label>
                                        <input type="text" class="form-control" placeholder="Enter Inherent Risk" name="inherent_risk">
                                    </div>
                        
                                    <div class="col-sm-4 form-group">
                                        <label for="email">Impact:</label>
                                        <select class="form-control" name="x_risk_assessment_impact_id">
                                            <option selected>Please Select Impact</option>
                                            @foreach ($allImpacts as $impact)
                                                <option value="{{ $impact['id'] }}">{{ $impact['title_bn'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                        
                                    <div class="col-sm-4 form-group">
                                        <label for="email">Likelihood:</label>
                                        <select class="form-control" name="x_risk_assessment_likelihood_id">
                                            <option selected>Please Select Likelihood</option>
                                            @foreach ($allLikelihoods as $likelihood)
                                                <option value="{{ $likelihood['id'] }}">{{ $likelihood['title_en'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                        
                                    <div class="col-sm-4 form-group">
                                        <label for="email">Control System:</label>
                                        <input type="text" class="form-control" placeholder="Enter Control System" name="control_system">
                                    </div>
                        
                                    <div class="col-sm-4 form-group">
                                        <label for="email">Control Effectiveness:</label>
                                        <input type="text" class="form-control" placeholder="Enter Control Effectiveness" name="control_effectiveness">
                                    </div>
                        
                                    <div class="col-sm-4 form-group">
                                        <label for="email">Residual Risk:</label>
                                        <input type="text" class="form-control" placeholder="Enter Residual Risk" name="residual_risk">
                                    </div>
                        
                                    <div class="col-sm-4 form-group">
                                        <label for="email">Recommendation:</label>
                                        <input type="text" class="form-control" placeholder="Enter Recommendation" name="recommendation">
                                    </div>
                        
                                    <div class="col-sm-4 form-group">
                                        <label for="email">Implemented By:</label>
                                        <input type="text" class="form-control" placeholder="Enter Implemented By" name="implemented_by">
                                    </div>
                        
                                    <div class="col-sm-4 form-group">
                                        <label for="email">Implemented On:</label>
                                        <input type="text" class="form-control" placeholder="Enter Implemented On" name="implementation_period">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-sm-12 text-center">
                                <button 
                                type="button" 
                                class="btn btn-primary btn-sm float-right mb-2" 
                                id="add_risk"
                                >
                                    <i class="fa fa-plus"></i>
                                    Add
                                </button>

                                <button 
                                type="button" 
                                class="btn btn-danger btn-sm float-right mb-2 mr-2"
                                id="remove_risk"
                                >
                                    <i class="fa fa-trash"></i>
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Item_Risk_Assessment_Container.loadRiskFactorType('project');

        $('input[type=radio][name=assessment_item_type]').change(function() {
            console.log(this.value);
            if (this.value == 'project') {
                $('.project_div').show();
                $('.function_div').hide();
                $('.unit_div').hide();
                $('.cost_center_div').hide();
            }
            else if (this.value == 'function') {
                $('.project_div').hide();
                $('.function_div').show();
                $('.unit_div').hide();
                $('.cost_center_div').hide();
            }
            else if (this.value == 'master-unit') {
                $('.project_div').hide();
                $('.function_div').hide();
                $('.unit_div').show();
                $('.cost_center_div').hide();
            }
            else {
                $('.project_div').hide();
                $('.function_div').hide();
                $('.unit_div').hide();
                $('.cost_center_div').show();
            }
        });

        $('#submit_button').on('click',function () {
            console.log('submit');
            storeItemRiskAssessments();
        });

        $('#add_risk').on('click', function () {
            console.log('add');
            addRisk();
            adjustRiskIndex();
        });

        $('#remove_risk').on("click", function() {
            console.log('remove');
            removeRisk();
            adjustRiskIndex();
        });

        $('#go_back').on("click", function() {
            console.log('back');
            backToList();
        });

        function addRisk () {
            $(".item_area_risks").clone().insertAfter(".item_area_risks:last");
        }
    
        function removeRisk () {
            console.log('remove');
            $('.item_area_risks:last').remove();
        }

        function adjustRiskIndex() {
            $( ".indexAreaRisk" ).each(function( index ) {
                $(this).text('Risk '+ (index + 1))
            });
        }
    
        function backToList () {
            $('.item_risk_assessment  a').click();
        }
        
        function storeItemRiskAssessments () {
            
            loaderStart('Please wait...');
    
            let assessment_item_type = $('input[name="assessment_item_type"]:checked').val();
            
            let assessment_item_id = (assessment_item_type=='project') ? $('#project_id').find(':selected').val() 
            : (assessment_item_type=='function') ? $('#function_id').find(':selected').val() 
            : (assessment_item_type=='master-unit') ? $('#unit_master_id').find(':selected').val() 
            : $('#cost_center_id').find(':selected').val();

            let x_audit_area_id = $('#x_audit_area_id').find(':selected').val();
    
            let item_assessment = {
                assessment_item_type,
                assessment_item_id,
                x_audit_area_id,
                audit_assessment_area_risks : []
            };
      
            $('.item_area_risks').each(function(index, risk) {
                audit_assessment_area_risk = {};
                
                audit_assessment_area_risk['inherent_risk'] = $(this).find("input[name='inherent_risk']").val();
                audit_assessment_area_risk['x_risk_assessment_impact_id'] = $(this).find("select[name='x_risk_assessment_impact_id']").val();
                audit_assessment_area_risk['x_risk_assessment_likelihood_id'] = $(this).find("select[name='x_risk_assessment_likelihood_id']").val();
                audit_assessment_area_risk['control_system'] = $(this).find("input[name='control_system']").val();
                audit_assessment_area_risk['control_effectiveness'] = $(this).find("input[name='control_effectiveness']").val();
                audit_assessment_area_risk['residual_risk'] = $(this).find("input[name='residual_risk']").val();
                audit_assessment_area_risk['recommendation'] = $(this).find("input[name='recommendation']").val();
                audit_assessment_area_risk['implemented_by'] = $(this).find("input[name='implemented_by']").val();
                audit_assessment_area_risk['implementation_period'] = $(this).find("input[name='implementation_period']").val();
                
                item_assessment.audit_assessment_area_risks.push(audit_assessment_area_risk);
            });
    
            let url = "{{route('settings.item-risk-assessments.store')}}";

            ajaxCallAsyncCallbackAPI(url, item_assessment, 'POST', function (response) {
                loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    toastr.success(response.data);
                    backToList();
                }
            });
        }
    });

    // var Item_Risk_Assessment_Container = {
        // loadYearWiseStrategicPlan: function () {
        //     loaderStart('loading...');
        //     strategic_plan_year = $('#strategic_plan_year').find(':selected').text();
        //     let url = '{{route('audit.plan.yearly-plan.get-individual-strategic-plan')}}';
        //     let data = {strategic_plan_year};
        //     ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
        //         loaderStop();
        //         if (response.status === 'error') {
        //             toastr.error(response.data)
        //         } else {
        //             $('.load-year-wise-plan').html(response);
        //         }
        //     });
        // },

        // loadRiskFactorType:function (type){
        //     if(type == 'project'){
        //         $('.project_div').show();
        //         $('.function_div').hide();
        //         $('.cost_center_div').hide();
        //         $('.unit_div').hide();
        //         Item_Risk_Assessment_Container.loadProject();

        //     }else if(type == 'function'){
        //         $('.project_div').hide();
        //         $('.function_div').show();
        //         $('.cost_center_div').hide();
        //         $('.unit_div').hide();
        //         Item_Risk_Assessment_Container.loadFunction();
        //     }else if(type == 'unit'){
        //         $('.project_div').hide();
        //         $('.function_div').hide();
        //         $('.cost_center_div').hide();
        //         $('.unit_div').show();
        //         Item_Risk_Assessment_Container.loadUnit();
        //     }
        //     else if(type == 'cost_center'){
        //         $('.project_div').hide();
        //         $('.function_div').hide();
        //         $('.cost_center_div').show();
        //         $('.unit_div').hide();
        //     }
        // },

        // loadProject:function (){
        //     loaderStart('loading...');
        //     let url = '{{route('settings.load_project_select')}}';
        //     let data = {};
        //     ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
        //         loaderStop();
        //         if (response.status === 'error') {
        //             toastr.error(response.data)
        //         } else {
        //             $('#project_id').html(response);
        //         }
        //     });
        // },

        // loadFunction:function (){
        //     loaderStart('loading...');
        //     let url = '{{route('settings.load_function_select')}}';
        //     let data = {};
        //     ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
        //         loaderStop();
        //         if (response.status === 'error') {
        //             toastr.error(response.data)
        //         } else {
        //             $('#function_id').html(response);
        //         }
        //     });
        // },

        // loadUnit:function (){
        //     loaderStart('loading...');
        //     let url = '{{route('settings.load_unit_master_select')}}';
        //     let data = {};
        //     ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
        //         loaderStop();
        //         if (response.status === 'error') {
        //             toastr.error(response.data)
        //         } else {
        //             $('#unit_master_id').html(response);
        //         }
        //     });
        // },
    // };
</script>