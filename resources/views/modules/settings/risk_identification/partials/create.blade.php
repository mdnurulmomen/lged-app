<div class="row m-0 mb-2 page-title-wrapper d-md-flex align-items-md-center">
    <div class="col-md-6">
        <div class="title py-2">
            <h4 class="mb-0 font-weight-bold"><i class="fas fa-list mr-3"></i>Create Risk Identification</h4>
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
            <div class="card-body">
                <div class="form-row">
                    <div class="col-sm-4 form-group">
                        <input type="radio" name="assessment_sector_type" value="project" checked> Project
                    </div>
            
                    <div class="col-sm-4 form-group">
                        <input type="radio" name="assessment_sector_type" value="function"> Function
                    </div>
                    
                    <div class="col-sm-4 form-group">
                        <input type="radio" name="assessment_sector_type" value="master-unit" > Master Unit
                    </div>
            
                    {{-- 
                    <div class="col-sm-3 form-group">
                        <input type="radio" name="assessment_sector_type" value="cost-center"> Cost Center
                    </div> 
                    --}}
                </div>

                <div class="form-row">
                    <div class="col-sm-12 form-group">
                        <div class="project_div">
                            <select   class="form-control select-select2" name="project_id" id="project_id">
                                <option value="" selected>Select Project</option>
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
                                <option value="" selected>Select Function</option>
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
                                <option value="" selected>Select Unit</option>
                                @foreach ($allMasterUnits as $masterUnit)
                                    <option value="{{ $masterUnit['id'] }}">
                                        {{ $masterUnit['name_en'] }}
                                        ({{ $masterUnit['risk_score_key'] ? $masterUnit['risk_score_key'] : '--' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                
                        {{--     
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
                        --}}
                    </div>
                    
                    <div class="col-sm-12 form-group">
                        <p for="area">Parent Area:</p>
            
                        <select class="form-control" name="parent_area_id" id="parent_area_id">
                            <option value="" selected>Please Select Parent-Area</option>
                            
                            @foreach ($allAreas as $area)
                                <option value="{{ $area['id'] }}">{{ ucfirst($area['name_en']) }}</option>
                            @endforeach 
                        </select>
                    </div>
            
                    <div class="col-sm-12 form-group">
                        <p for="area">Child Area:</p>
            
                        <select class="form-control" name="audit_area_id" id="audit_area_id">
                            <option value="" selected>Please Select Child-Area</option>
                            
                            {{-- 
                            @foreach ($allAreas as $area)
                                <option value="{{ $area['id'] }}">{{ $area['name_en'] }}</option>
                            @endforeach 
                            --}}
                        </select>
                    </div>
            
                    <div class="col-sm-12 form-group">
                        <label for="email">Risk Name:</label>
                        <input type="text" class="form-control" placeholder="Enter Risk Name" name="risk_name">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Item_Risk_Assessment_Container.loadRiskFactorType('project');

        $('input[type=radio][name=assessment_sector_type]').change(function() {
            if (this.value == 'project') {
                $('.project_div').show();
                $('.function_div').hide();
                $('.unit_div').hide();
                // $('.cost_center_div').hide();
            }
            else if (this.value == 'function') {
                $('.project_div').hide();
                $('.function_div').show();
                $('.unit_div').hide();
                // $('.cost_center_div').hide();
            }
            else if (this.value == 'master-unit') {
                $('.project_div').hide();
                $('.function_div').hide();
                $('.unit_div').show();
                // $('.cost_center_div').hide();
            }
            else {
                $('.project_div').hide();
                $('.function_div').hide();
                $('.unit_div').hide();
                // $('.cost_center_div').show();
            }
        });

        $('select[name=parent_area_id]').on('change',function () {
            // console.log('sector');
            setAvailableChildAreas(this.value);
        });

        $('#submit_button').on('click',function () {
            // console.log('submit');
            storeItemRiskIdentifications();
        });

        $('#go_back').on("click", function() {
            // console.log('back');
            backToList();
        });
    
        function backToList () {
            $('.risk-identifications a').click();
        }

        function setAvailableChildAreas (parent_area_id) {

            loaderStart('Please wait...');

            /* 
            let assessment_sector_type = $('input[name="assessment_sector_type"]:checked').val();
            
            let assessment_sector_id = (assessment_sector_type=='project') ? $('#project_id').find(':selected').val() 
            : (assessment_sector_type=='function') ? $('#function_id').find(':selected').val() 
            : (assessment_sector_type=='master-unit') ? $('#unit_master_id').find(':selected').val() 
            : $('#cost_center_id').find(':selected').val(); 
            */

            let data = {parent_area_id};

            let url = "{{route('audit.plan.risk-identifications.child-area-list')}}";

            ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
                loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('#audit_area_id').html(response);
                }
            });

        }
        
        function storeItemRiskIdentifications () {
            
            loaderStart('Please wait...');
    
            let assessment_sector_type = $('input[name="assessment_sector_type"]:checked').val();
            
            let assessment_sector_id = (assessment_sector_type=='project') ? $('#project_id').find(':selected').val() 
            : (assessment_sector_type=='function') ? $('#function_id').find(':selected').val() 
            : (assessment_sector_type=='master-unit') ? $('#unit_master_id').find(':selected').val() 
            : $('#cost_center_id').find(':selected').val();

            let parent_area_id = $('#parent_area_id').find(':selected').val();
            let audit_area_id = $('#audit_area_id').find(':selected').val();

            let risk_name = $('input[name="risk_name"]').val();
    
            let risk_identification = {
                assessment_sector_type,
                assessment_sector_id,
                parent_area_id,
                audit_area_id,
                risk_name
            };
    
            let url = "{{route('audit.plan.risk-identifications.store')}}";

            ajaxCallAsyncCallbackAPI(url, risk_identification, 'POST', function (response) {
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
</script>