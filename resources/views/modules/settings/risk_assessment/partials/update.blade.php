{{--<div class="row m-0 mb-2 page-title-wrapper d-md-flex align-items-md-center">--}}
{{--    <div class="col-md-6">--}}
{{--        <div class="title py-2">--}}
{{--            <h4 class="mb-0 font-weight-bold"><i class="fas fa-list mr-3"></i>Update Item Risk Assessment</h4>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="col-md-6 text-right">--}}
{{--        <a id="go_back" class="btn btn-sm btn-warning btn_back btn-square mr-3">--}}
{{--            <i class="fad fa-arrow-alt-left"></i> ফেরত যান--}}
{{--        </a>--}}
{{--        <button class="btn btn-sm btn-square btn-primary mr-2" id="submit_button">--}}
{{--            <i class="fa fa-save"></i> সংরক্ষণ করুন--}}
{{--        </button>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="form-row">
                    <div class="col-sm-12 form-group">
                        <input type="radio" name="assessment_sector_type" value="field_office" @if ($assessment_sector_type=='field_office') checked @endif> Field Office
                        <input id="project" type="radio" name="assessment_sector_type" value="project" @if ($assessment_sector_type=='project') checked @endif> Project
                        <input id="master_unit" type="radio" name="assessment_sector_type" value="master-unit" @if ($assessment_sector_type=='master-unit') checked @endif> Unit
                        <input id="function" type="radio" name="assessment_sector_type" value="function" @if ($assessment_sector_type=='function') checked @endif> Function
                    </div>


                    {{-- <div class="col-sm-3 form-group">
                        <input id="cost_center" type="radio" name="assessment_sector_type" value="cost-center" @if ($assessment_sector_type=='cost-center') checked @endif> Cost Center
                    </div> --}}
                </div>

                <div class="form-row">
                    <div class="col-sm-12">
                        <input type="hidden" id="id" value="{{ $id }}">
                    </div>
                    <div class="col-sm-6">
                        <div class="project_div" style="display : @if ($assessment_sector_type=='project') block @else none @endif">
                            <select   class="form-control select-select2 sector" name="project_id" id="project_id">
                                <option>Select Project</option>
                                @foreach ($allProjects as $project)
                                    <option
                                        value="{{ $project['id'] }}"
                                        @if ($project['id'] == $assessment_sector_id)
                                            selected
                                        @endif
                                    >
                                        {{ $project['name_en'] }}
                                        ({{ $project['risk_score_key'] ? $project['risk_score_key'] : '--' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="function_div" style="display : @if ($assessment_sector_type=='function') block @else none @endif">
                            <select  class="form-control select-select2 sector" name="function_id" id="function_id">
                                <option>Select Function</option>
                                @foreach ($allFunctions as $function)
                                    <option
                                        value="{{ $function['id'] }}"
                                        @if ($function['id'] == $assessment_sector_id)
                                            selected
                                        @endif
                                    >
                                        {{ $function['name_en'] }}
                                        ({{ $function['risk_score_key'] ? $function['risk_score_key'] : '--' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="unit_div" style="display : @if ($assessment_sector_type=='master-unit') block @else none @endif">
                            <select class="form-control select-select2 sector" name="unit_master_id" id="unit_master_id">
                                <option>Select Unit</option>
                                @foreach ($allMasterUnits as $masterUnit)
                                    <option
                                        value="{{ $masterUnit['id'] }}"
                                        @if ($masterUnit['id'] == $assessment_sector_id)
                                            selected
                                        @endif
                                    >
                                        {{ $masterUnit['name_en'] }}
                                        ({{ $masterUnit['risk_score_key'] ? $masterUnit['risk_score_key'] : '--' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- <div class="cost_center_div" style="display : @if ($assessment_sector_type=='cost-center') block @else none @endif">
                            <select class="form-control select-select2" name="cost_center_id" id="cost_center_id">
                                <option>Select Cost Center</option>
                                @foreach ($allCostCenters as $costCenter)
                                    <option
                                        value="{{ $costCenter['id'] }}"
                                        @if ($costCenter['id'] == $assessment_sector_id)
                                            selected
                                        @endif
                                    >
                                        {{ $costCenter['name_en'] }}
                                        ({{ empty($costCenter['risk_score_key']) ? '--' : $costCenter['risk_score_key'] }})
                                    </option>
                                @endforeach
                            </select>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="card-body pt-3 sector_areas">
                <div class="form-row">
                    <div class="col-sm-12 pl-7 pr-7">
                        <div class="form-row">
                            <div class="col-sm-12 form-group">
                                <label for="audit_area_id">Area:</label>
                                <select class="form-control" name="audit_area_id" id="audit_area_id">
                                    <option>Please Select Area</option>
                                    @foreach ($allAreas as $area)
                                        <option
                                            value="{{ $area['id'] }}"
                                            @if ($area['id'] == $audit_area_id)
                                                selected
                                            @endif
                                        >
                                            {{ $area['name_en'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @foreach ($audit_assessment_area_risks as $index => $audit_assessment_area_risk)
                            <div class="sector_area_risks">
                                <div class="form-row">
                                        <div class="col-sm-4 form-group">
                                            <label for="email">Inherent Risk:</label>
                                            <input type="text" class="form-control" placeholder="Enter Inherent Risk" name="inherent_risk" value="{{ $audit_assessment_area_risk['inherent_risk'] }}">
                                        </div>

                                        <div class="col-sm-4 form-group">
                                            <label for="email">Impact:</label>
                                            <select class="form-control" name="x_risk_assessment_impact_id">
                                                <option>Please Select Impact</option>
                                                @foreach ($allImpacts as $impact)
                                                    <option
                                                        value="{{ $impact['id'] }}"
                                                        @if ($impact['id'] == $audit_assessment_area_risk['x_risk_assessment_impact_id'])
                                                            selected
                                                        @endif
                                                    >
                                                        {{ $impact['title_bn'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-sm-4 form-group">
                                            <label for="email">Likelihood:</label>
                                            <select class="form-control" name="x_risk_assessment_likelihood_id">
                                                <option>Please Select Likelihood</option>
                                                @foreach ($allLikelihoods as $likelihood)
                                                    <option
                                                        value="{{ $likelihood['id'] }}"
                                                        @if ($likelihood['id'] == $audit_assessment_area_risk['x_risk_assessment_likelihood_id'])
                                                            selected
                                                        @endif
                                                    >
                                                        {{ $likelihood['title_en'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-sm-4 form-group">
                                            <label for="email">Control System:</label>
                                            <input type="text" class="form-control" placeholder="Enter Control System" name="control_system" value="{{ $audit_assessment_area_risk['control_system'] }}">
                                        </div>

                                        <div class="col-sm-4 form-group">
                                            <label for="email">Control Effectiveness:</label>
                                            <input type="text" class="form-control" placeholder="Enter Control Effectiveness" name="control_effectiveness" value="{{ $audit_assessment_area_risk['control_effectiveness'] }}">
                                        </div>

                                        <div class="col-sm-4 form-group">
                                            <label for="email">Residual Risk:</label>
                                            <input type="text" class="form-control" placeholder="Enter Residual Risk" name="residual_risk" value="{{ $audit_assessment_area_risk['residual_risk'] }}">
                                        </div>

                                        <div class="col-sm-4 form-group">
                                            <label for="email">Recommendation:</label>
                                            <input type="text" class="form-control" placeholder="Enter Recommendation" name="recommendation" value="{{ $audit_assessment_area_risk['recommendation'] }}">
                                        </div>

                                        <div class="col-sm-4 form-group">
                                            <label for="email">Implemented By:</label>
                                            <input type="text" class="form-control" placeholder="Enter Implemented By" name="implemented_by" value="{{ $audit_assessment_area_risk['implemented_by'] }}">
                                        </div>

                                        <div class="col-sm-4 form-group">
                                            <label for="email">Implemented On:</label>
                                            <input type="text" class="form-control" placeholder="Enter Implemented On" name="implementation_period" value="{{ $audit_assessment_area_risk['implementation_period'] }}">
                                        </div>
                                    </div>
                            </div>
                        @endforeach

                        <div class="form-row">
                            <div class="col-sm-12 text-center">
                                <button class="btn btn-sm btn-square btn-primary mr-2" id="submit_button">
                                    <i class="fa fa-save"></i> সংরক্ষণ করুন
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

        $('input[type=radio][name=assessment_sector_type]').change(function() {
            console.log(this.value);
            if (this.value == 'project') {
                $('.project_div').show();
                $('.function_div').hide();
                $('.cost_center_div').hide();
                $('.unit_div').hide();
            }
            else if (this.value == 'function') {
                $('.project_div').hide();
                $('.function_div').show();
                $('.cost_center_div').hide();
                $('.unit_div').hide();
            }
            else if (this.value == 'master_unit') {
                $('.project_div').hide();
                $('.function_div').hide();
                $('.cost_center_div').hide();
                $('.unit_div').show();
            }
            else {
                $('.project_div').hide();
                $('.function_div').hide();
                $('.cost_center_div').show();
                $('.unit_div').hide();
            }
        });

        $('.sector').on('change',function () {
            // console.log('sector');
            setAvailableAreas();
        });

        $('#submit_button').on('click',function () {
            updateItemRiskAssessments();
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
            $(".sector_area_risks").clone().insertAfter(".sector_area_risks:last");
        }

        function removeRisk () {
            console.log('remove');
            $('.sector_area_risks:last').remove();
        }

        function adjustRiskIndex() {
            $( ".indexAreaRisk" ).each(function( index ) {
                $(this).text('Risk '+ (index + 1))
            });
        }

        function backToList () {
            $('.sector_risk_assessment  a').click();
        }

        function setAvailableAreas () {

            // loaderStart('Please wait...');

            let assessment_sector_type = $('input[name="assessment_sector_type"]:checked').val();

            let assessment_sector_id = (assessment_sector_type=='project') ? $('#project_id').find(':selected').val()
            : (assessment_sector_type=='function') ? $('#function_id').find(':selected').val()
            : (assessment_sector_type=='master-unit') ? $('#unit_master_id').find(':selected').val()
            : $('#cost_center_id').find(':selected').val();

            let data = {assessment_sector_type, assessment_sector_id};

            let url = "{{route('settings.sector-risk-assessments.area-list')}}";

            ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
                // loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('#audit_area_id').html(response);
                }
            });

        }

        function updateItemRiskAssessments () {

            loaderStart('Please wait...');

            let assessment_sector_type = $('input[name="assessment_sector_type"]:checked').val();

            let assessment_sector_id = (assessment_sector_type=='project') ? $('#project_id').find(':selected').val()
            : (assessment_sector_type=='function') ? $('#function_id').find(':selected').val()
            : (assessment_sector_type=='master-unit') ? $('#unit_master_id').find(':selected').val()
            : $('#cost_center_id').find(':selected').val();

            let audit_area_id = $('#audit_area_id').find(':selected').val();

            let sector_assessment = {
                id : $('#id').val(),
                assessment_sector_type,
                assessment_sector_id,
                audit_area_id,
                audit_assessment_area_risks : []
            };

            $('.sector_area_risks').each(function(index, risk) {
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

                sector_assessment.audit_assessment_area_risks.push(audit_assessment_area_risk);
            });

            let url = "{{route('settings.sector-risk-assessments.update', $id)}}";

            ajaxCallAsyncCallbackAPI(url, sector_assessment, 'PUT', function (response) {
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
