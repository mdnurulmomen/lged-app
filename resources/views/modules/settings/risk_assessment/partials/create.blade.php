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
                    <div class="col-sm-2 form-group">
                        <input type="radio" name="assessment_sector_type" value="project" checked> Project
                    </div>

                    <div class="col-sm-2 form-group">
                        <input type="radio" name="assessment_sector_type" value="function"> Function
                    </div>

{{--                    <div class="col-sm-4 form-group">--}}
{{--                        <input type="radio" name="assessment_sector_type" value="master-unit" > Master Unit--}}
{{--                    </div>--}}

                    {{--
                    <div class="col-sm-3 form-group">
                        <input type="radio" name="assessment_sector_type" value="cost-center"> Cost Center
                    </div>
                    --}}
                </div>

                <div class="form-row">
                    <div class="col-sm-6">
                        <div class="project_div">
                            <select   class="form-control select-select2 sector" name="project_id" id="project_id">
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
                            <select  class="form-control select-select2 sector" name="function_id" id="function_id">
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
                            <select class="form-control select-select2 sector" name="unit_master_id" id="unit_master_id">
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
                    <div class="col-sm-6">
                        <select class="form-control audit_area_id" name="audit_area_id" id="audit_area_id">
                            <option value="" selected>Please Select Area</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body pt-3 sector_areas">
                <div class="form-row">
                    <div class="col-sm-12 pl-7 pr-7" id="risk-list">
                        <div class="card sector_area_risks risk_row_1">
                            <div class="card-header pt-1 pb-2">
                                <p class="text-center m-0 indexAreaRisk">Risk 1</p>
                            </div>
                            <div class="card-body pt-1">
                                <div class="form-row">
                                    <div class="col-sm-4 form-group">
                                        <label for="sub_area_id">Process/sub-process:</label>
                                        <select onchange="getInherentRisk($(this))"  class="form-control sub_area_id" id="sub_area_id" name="sub_area_id">
                                            <option selected>Select Process/sub-process</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-4 form-group">
                                        <label for="email">Inherent Risk:</label>
                                        <select class="form-control inherent_risk_id" name="inherent_risk_id">
                                            <option selected>Select Risk</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-4 form-group">
                                        <label for="email">Impact:</label>
                                        <select data-value=""  onchange="getRiskLevelAndPriority($(this))" class="form-control x_risk_assessment_impact_id" name="x_risk_assessment_impact_id">
                                            <option value="" selected>Please Select Impact</option>
                                            @foreach ($allImpacts as $impact)
                                                <option value="{{ $impact['id'] }}">{{ $impact['title_bn'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-4 form-group">
                                        <label for="email">Likelihood:</label>
                                        <select value="" onchange="getRiskLevelAndPriority($(this))" class="form-control x_risk_assessment_likelihood_id" name="x_risk_assessment_likelihood_id">
                                            <option selected>Please Select Likelihood</option>
                                            @foreach ($allLikelihoods as $likelihood)
                                                <option value="{{ $likelihood['id'] }}">{{ $likelihood['title_en'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-4 form-group">
                                        <label for="email">Inherent Risk Level:</label>
                                        <input type="text" value="" name="risk_level" class="form-control risk_level" readonly>
                                    </div>

                                    <div class="col-sm-4 form-group">
                                        <label for="email">Priority:</label>
                                        <input type="text" value="" name="priority" class="form-control priority" readonly>
                                    </div>

                                    <div class="col-sm-4 form-group">
                                        <label for="control_system">Existing Control:</label>
                                        <textarea type="text" class="form-control" placeholder="Enter Control System" name="control_system"></textarea>
                                    </div>

                                    <div class="col-sm-4 form-group">
                                        <label for="email">Risk Owner:</label>
                                        <select class="form-control risk_owner_id" name="risk_owner_id">
                                            <option value="0" selected>Select Risk Owner</option>
                                            @foreach($officerLists as $key => $officer_list)
                                                @foreach($officer_list['units'] as $unit)
                                                    @foreach($unit['designations'] as $designation)
                                                        @if(!empty($designation['employee_info']))
                                                            <option value="{{$designation['employee_info']['id']}}">{{!empty($designation['employee_info']) ? $designation['employee_info']['name_eng'] : ''}}</option>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-4 form-group">
                                        <label for="email">Process Owner:</label>
                                        <select class="form-control process_owner_id" name="process_owner_id">
                                            <option value="0" selected>Select Risk Owner</option>
                                            @foreach($officerLists as $key => $officer_list)
                                                @foreach($officer_list['units'] as $unit)
                                                    @foreach($unit['designations'] as $designation)
                                                        @if(!empty($designation['employee_info']))
                                                            <option value="{{$designation['employee_info']['id']}}">{{!empty($designation['employee_info']) ? $designation['employee_info']['name_eng'] : ''}}</option>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-4 form-group">
                                        <label for="email">Control Owner:</label>
                                        <select class="form-control control_owner_id" name="control_owner_id">
                                            <option value="0" selected>Select Risk Owner</option>
                                            @foreach($officerLists as $key => $officer_list)
                                                @foreach($officer_list['units'] as $unit)
                                                    @foreach($unit['designations'] as $designation)
                                                        @if(!empty($designation['employee_info']))
                                                            <option value="{{$designation['employee_info']['id']}}">{{!empty($designation['employee_info']) ? $designation['employee_info']['name_eng'] : ''}}</option>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>

                                    @if($type == 'final')
                                        <div class="col-sm-4 form-group">
                                            <label for="email">Related Issue Number:</label>
                                            <select class="form-control issue_id" name="issue_id">
                                                <option selected>Select Risk</option>
                                            </select>
                                        </div>
                                    @endif


{{--                                    <div class="col-sm-4 form-group">--}}
{{--                                        <label for="email">Control Effectiveness:</label>--}}
{{--                                        <input type="text" class="form-control" placeholder="Enter Control Effectiveness" name="control_effectiveness">--}}
{{--                                    </div>--}}

{{--                                    <div class="col-sm-4 form-group">--}}
{{--                                        <label for="email">Residual Risk:</label>--}}
{{--                                        <input type="text" class="form-control" placeholder="Enter Residual Risk" name="residual_risk">--}}
{{--                                    </div>--}}

{{--                                    <div class="col-sm-4 form-group">--}}
{{--                                        <label for="email">Recommendation:</label>--}}
{{--                                        <input type="text" class="form-control" placeholder="Enter Recommendation" name="recommendation">--}}
{{--                                    </div>--}}

{{--                                    <div class="col-sm-4 form-group">--}}
{{--                                        <label for="email">Implemented By:</label>--}}
{{--                                        <input type="text" class="form-control" placeholder="Enter Implemented By" name="implemented_by">--}}
{{--                                    </div>--}}

{{--                                    <div class="col-sm-4 form-group">--}}
{{--                                        <label for="email">Implemented On:</label>--}}
{{--                                        <input type="text" class="form-control" placeholder="Enter Implemented On" name="implementation_period">--}}
{{--                                    </div>--}}
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
        adjustRiskIndex();
    });

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

    $('.sector').on('change',function () {
        setAvailableAreas();
        setAvailableIssue();
    });

    $('#submit_button').on('click',function () {
        storeItemRiskAssessments();
    });

    $('#add_risk').on('click', function () {
        addRisk();
        adjustRiskIndex();
    });

    $('#remove_risk').on("click", function() {
        removeRisk();
        adjustRiskIndex();
    });

    $('#go_back').on("click", function() {
        backToList();
    });


    function addRisk () {
        row_count = $("#risk-list .sector_area_risks").length;
        new_row_count = row_count + 1;
        $(".sector_area_risks:last").clone().insertAfter(".sector_area_risks:last");
        $(".sector_area_risks:last").addClass("risk_row_"+new_row_count);
        $('.sector_area_risks:last').removeClass("risk_row_"+row_count);
        $('.sector_area_risks:last').find('input,textarea').val('');
        $('.sector_area_risks:last').find('[name=inherent_risk_id]').html('<option value="">Select Inherent Risk</option>');
    }

    function removeRisk () {
        if ($('.sector_area_risks').length > 1) {
            $('.sector_area_risks:last').remove();
        }
    }

    function adjustRiskIndex() {
        $( ".indexAreaRisk" ).each(function( index ) {
            $(this).text('Risk '+ (index + 1))
        });
        ra_length = $('.sector_area_risks').length;
        for(i=1; i<=ra_length; i++){
            $('.risk_row_'+i).find('input,select,textarea').each(function(){
                $(this).attr('data-risk-row-index',i)
            });
        }
    }

    function backToList () {
        $('.sector_risk_assessment  a').click();
    }

    function setAvailableAreas () {

        loaderStart('Please wait...');

        let assessment_sector_type = $('input[name="assessment_sector_type"]:checked').val();

        let assessment_sector_id = (assessment_sector_type=='project') ? $('#project_id').find(':selected').val()
            : (assessment_sector_type=='function') ? $('#function_id').find(':selected').val()
                : (assessment_sector_type=='master-unit') ? $('#unit_master_id').find(':selected').val()
                    : $('#cost_center_id').find(':selected').val();

        let data = {assessment_sector_type, assessment_sector_id};

        let url = "{{route('settings.sector-risk-assessments.area-list')}}";

        ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
            loaderStop();
            if (response.status === 'error') {
                toastr.error(response.data);
            } else {
                $('#audit_area_id').html(response);
            }
        });

    }

    function setAvailableIssue () {

        loaderStart('Please wait...');

        let assessment_sector_type = $('input[name="assessment_sector_type"]:checked').val();

        let assessment_sector_id = (assessment_sector_type=='project') ? $('#project_id').find(':selected').val()
            : (assessment_sector_type=='function') ? $('#function_id').find(':selected').val()
                : (assessment_sector_type=='master-unit') ? $('#unit_master_id').find(':selected').val()
                    : $('#cost_center_id').find(':selected').val();

        let data = {assessment_sector_type, assessment_sector_id};

        let url = "{{route('settings.get-sector-wise-issue')}}";

        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
            loaderStop();
            if (response.status === 'error') {
                toastr.error(response.data);
            } else {
                $('.issue_id').html(response);
            }
        });

    }

    function storeItemRiskAssessments () {

        loaderStart('Please wait...');

        let assessment_sector_type = $('input[name="assessment_sector_type"]:checked').val();

        let assessment_sector_id = (assessment_sector_type=='project') ? $('#project_id').find(':selected').val()
            : (assessment_sector_type=='function') ? $('#function_id').find(':selected').val()
                : (assessment_sector_type=='master-unit') ? $('#unit_master_id').find(':selected').val()
                    : $('#cost_center_id').find(':selected').val();

        let audit_area_id = $('#audit_area_id').find(':selected').val();

        let assessment_type = '{{$type}}';

        let sector_assessment = {
            assessment_sector_type,
            assessment_sector_id,
            audit_area_id,
            assessment_type,
            audit_assessment_area_risks : []
        };

        $('.sector_area_risks').each(function(index, risk) {
            audit_assessment_area_risk = {};

            audit_assessment_area_risk['inherent_risk_id'] = $(this).find(".inherent_risk_id option:selected").val();
            audit_assessment_area_risk['inherent_risk'] = $(this).find(".inherent_risk_id option:selected").text();
            audit_assessment_area_risk['sub_area_id'] = $(this).find(".sub_area_id option:selected").val();
            audit_assessment_area_risk['sub_area_name'] = $(this).find(".sub_area_id option:selected").text();
            audit_assessment_area_risk['sub_area_name_bn'] = '';
            audit_assessment_area_risk['risk_level'] = $(this).find("input[name='risk_level']").val();
            audit_assessment_area_risk['priority'] = $(this).find("input[name='priority']").val();
            audit_assessment_area_risk['x_risk_assessment_impact_id'] = $(this).find("select[name='x_risk_assessment_impact_id']").val();
            audit_assessment_area_risk['x_risk_assessment_likelihood_id'] = $(this).find("select[name='x_risk_assessment_likelihood_id']").val();
            audit_assessment_area_risk['control_system'] = $(this).find("textarea[name='control_system']").val();
            audit_assessment_area_risk['risk_owner_id'] = $(this).find(".risk_owner_id option:selected").val();
            audit_assessment_area_risk['risk_owner_name'] = $(this).find(".risk_owner_id option:selected").text();
            audit_assessment_area_risk['process_owner_id'] = $(this).find(".process_owner_id option:selected").val();
            audit_assessment_area_risk['process_owner_name'] = $(this).find(".process_owner_id option:selected").text();
            audit_assessment_area_risk['control_owner_id'] = $(this).find(".control_owner_id option:selected").val();
            audit_assessment_area_risk['control_owner_name'] = $(this).find(".control_owner_id option:selected").text();
            audit_assessment_area_risk['issue_no'] = $(this).find(".issue_id option:selected").val() ? $(this).find(".issue_id option:selected").val() : null;
            // audit_assessment_area_risk['control_effectiveness'] = $(this).find("input[name='control_effectiveness']").val();
            // audit_assessment_area_risk['residual_risk'] = $(this).find("input[name='residual_risk']").val();
            // audit_assessment_area_risk['recommendation'] = $(this).find("input[name='recommendation']").val();
            // audit_assessment_area_risk['implemented_by'] = $(this).find("input[name='implemented_by']").val();
            // audit_assessment_area_risk['implementation_period'] = $(this).find("input[name='implementation_period']").val();

            sector_assessment.audit_assessment_area_risks.push(audit_assessment_area_risk);
        });

        // console.log(sector_assessment);

        let url = "{{route('settings.sector-risk-assessments.store')}}";

        ajaxCallAsyncCallbackAPI(url, sector_assessment, 'POST', function (response) {
            loaderStop();
            if (response.status === 'error') {
                toastr.error(response.data)
            } else {
                toastr.success(response.data);
                backToList();
            }
        });
    }

    $('select[name=audit_area_id]').on('change',function () {
        setAvailableChildAreas(this.value);
    });

    function setAvailableChildAreas (parent_area_id) {

        loaderStart('Please wait...');

        let data = {parent_area_id};

        let url = "{{route('audit.plan.risk-identifications.child-area-list')}}";

        ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
            loaderStop();
            if (response.status === 'error') {
                toastr.error(response.data);
            } else {
                $('#sub_area_id').html(response);
            }
        });

    }

    function getInherentRisk(elem){
        let risk_row = $(elem).attr('data-risk-row-index')
        let audit_area_id = $('.risk_row_'+risk_row).find('[name=sub_area_id]').val();
        setAvailableInherentRisk(risk_row,audit_area_id);
    }

    function setAvailableInherentRisk(risk_row,audit_area_id){
        loaderStart('Please wait...');

        let assessment_sector_type = $('input[name="assessment_sector_type"]:checked').val();

        let parent_area_id = $('[name="audit_area_id"]').val();

        let assessment_sector_id = (assessment_sector_type=='project') ? $('#project_id').find(':selected').val()
            : (assessment_sector_type=='function') ? $('#function_id').find(':selected').val()
                : (assessment_sector_type=='master-unit') ? $('#unit_master_id').find(':selected').val()
                    : $('#cost_center_id').find(':selected').val();

        let data = {assessment_sector_type,assessment_sector_id,parent_area_id,audit_area_id};

        let url = "{{route('audit.plan.risk-identifications.child-area-risk-list')}}";

        ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
            loaderStop();
            if (response.status === 'error') {
                toastr.error(response.data);
            } else {
                $('.risk_row_'+risk_row).find('[name=inherent_risk_id]').html(response);
            }
        });
    }

    function getRiskLevelAndPriority(elem){
        let risk_row = $(elem).attr('data-risk-row-index')
        let x_risk_assessment_likelihood_id = $('.risk_row_'+risk_row).find('[name=x_risk_assessment_likelihood_id]').val();
        let x_risk_assessment_impact_id = $('.risk_row_'+risk_row).find('[name=x_risk_assessment_impact_id]').val();
        setAvailableRiskLevelAndPriority(risk_row,x_risk_assessment_likelihood_id,x_risk_assessment_impact_id);
    }

    function setAvailableRiskLevelAndPriority (risk_row,x_risk_assessment_likelihood_id,x_risk_assessment_impact_id) {

        loaderStart('Please wait...');

        let data = {x_risk_assessment_likelihood_id,x_risk_assessment_impact_id};

        let url = "{{route('risk-assessment.likelihood-impact-wise-matrix')}}";

        ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
            loaderStop();
            if (response.status === 'error') {
                toastr.error(response.data);
            } else {
                $('.risk_row_'+risk_row).find('[name=risk_level]').val(response.data.risk_level);
                $('.risk_row_'+risk_row).find('[name=priority]').val(response.data.priority);
            }
        });

    }

    function setAvailableRisk (sub_child_id) {

        loaderStart('Please wait...');

        let data = {sub_child_id};

        let url = "{{route('audit.plan.risk-identifications.child-area-list')}}";

        ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
            loaderStop();
            if (response.status === 'error') {
                toastr.error(response.data);
            } else {
                $('#sub_area_id').html(response);
            }
        });

    }
</script>
