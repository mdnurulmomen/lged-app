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
            <div>
                <div class="form-row">
                    <div class="col-sm-12 form-group" style="display: none">
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
                    <div class="col-sm-6" style="display: none">
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

                        <form id="sub_area_risk_form">
                            <input type="hidden" name="id" value="{{ $sub_area_risk_info['id'] }}">
                            <input type="hidden" name="assessment_type" value="{{ $sub_area_risk_info['assessment_type'] }}">
                            <div class="sector_area_risks">
                                    <div class="form-row">
                                        <div class="col-sm-4 form-group">
                                            <label for="email">Process Owner:</label>
                                            <select class="form-control process_owner_id" name="process_owner_id">
                                                <option value="0" selected>Select Process Owner</option>
                                                @foreach($officerLists as $key => $officer_list)
                                                    @foreach($officer_list['units'] as $unit)
                                                        @foreach($unit['designations'] as $designation)
                                                            @if(!empty($designation['employee_info']))
                                                                <option @if($designation['employee_info']['id'] == $sub_area_risk_info['process_owner_id']) selected @endif value="{{$designation['employee_info']['id']}}">{{$designation['employee_info']['name_eng']}} ({{$designation['designation_eng']}})</option>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-sm-4 form-group">
                                            <label for="sub_area_id">Process/sub-process:</label>
                                            <select onchange="getInherentRisk()" class="form-control" name="sub_area_id" id="sub_area_id">
                                                <option>Please Select Process/Sub-process</option>
                                                @foreach ($allAreas as $area)
                                                    <option
                                                        value="{{ $area['id'] }}"
                                                        @if ($area['id'] == $sub_area_risk_info['sub_area_id'])
                                                        selected
                                                        @endif
                                                    >
                                                        {{ $area['name_en'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-sm-4 form-group">
                                            <label for="email">Risk Owner:</label>
                                            <select class="form-control risk_owner_id" name="risk_owner_id">
                                                <option value="0" selected>Select Risk Owner</option>
                                                @foreach($officerLists as $key => $officer_list)
                                                    @foreach($officer_list['units'] as $unit)
                                                        @foreach($unit['designations'] as $designation)
                                                            @if(!empty($designation['employee_info']))
                                                                <option @if($designation['employee_info']['id'] == $sub_area_risk_info['risk_owner_id']) selected @endif  value="{{$designation['employee_info']['id']}}">{{!empty($designation['employee_info']) ? $designation['designation_eng'] : ''}}</option>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-sm-4 form-group">
                                            <label for="email">Risk:</label>
                                            <select class="form-control inherent_risk_id" name="inherent_risk_id">
                                                <option selected>Select Risk</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-4 form-group">
                                            <label for="email">Likelihood:</label>
                                            <select onchange="getRiskLevelAndPriority($(this))" class="form-control" name="x_risk_assessment_likelihood_id">
                                                <option>Please Select Likelihood</option>
                                                @foreach ($allLikelihoods as $likelihood)
                                                    <option
                                                        value="{{ $likelihood['id'] }}"
                                                        @if ($likelihood['id'] == $sub_area_risk_info['x_risk_assessment_likelihood_id'])
                                                        selected
                                                        @endif
                                                    >
                                                        {{ $likelihood['title_en'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                            <div class="col-sm-4 form-group">
                                                <label for="email">Impact:</label>
                                                <select onchange="getRiskLevelAndPriority($(this))" class="form-control" name="x_risk_assessment_impact_id">
                                                    <option>Please Select Impact</option>
                                                    @foreach ($allImpacts as $impact)
                                                        <option
                                                            value="{{ $impact['id'] }}"
                                                            @if ($impact['id'] == $sub_area_risk_info['x_risk_assessment_impact_id'])
                                                                selected
                                                            @endif
                                                        >
                                                            {{ $impact['title_bn'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        <div class="col-sm-4 form-group">
                                            <label for="email">{{$sub_area_risk_info['assessment_type'] == 'preliminary' ? 'Inherent' : 'Residual'}} Risk Level:</label>
                                            <input type="text" value="{{$sub_area_risk_info['risk_level']}}" name="risk_level" class="form-control risk_level" readonly>
                                        </div>

                                        <div class="col-sm-4 form-group" @if($sub_area_risk_info['assessment_type'] == 'final') style="display: none" @endif>
                                            <label for="email">Priority:</label>
                                            <input type="text" value="{{$sub_area_risk_info['priority']}}" name="priority" class="form-control priority" readonly>
                                        </div>
                                        @if($sub_area_risk_info['assessment_type'] == 'final')

                                            <div class="col-sm-4 form-group">
                                                <label for="control_system">Effectiveness Of Control:</label>
                                                <select class="form-control" name="control_system">
                                                    <option value="" selected>-- Select --</option>
                                                    <option @if($sub_area_risk_info['control_system'] == 'Adequate') selected @endif value="Adequate">Adequate</option>
                                                    <option @if($sub_area_risk_info['control_system'] == 'Inadequate') selected @endif value="Inadequate">Inadequate</option>
                                                    <option @if($sub_area_risk_info['control_system'] == 'Needs Improvement') selected @endif value="Needs Improvement">Needs Improvement</option>
                                                </select>
                                                <!-- <textarea type="text" class="form-control" placeholder="Enter Control System" name="control_system"></textarea> -->
                                            </div>

                                        @else
                                            <div class="col-sm-4 form-group">
                                                <label for="control_system">Existing Control:</label>
                                                <textarea type="text" class="form-control" placeholder="Enter Control System"  name="control_system">{{$sub_area_risk_info['control_system']}}</textarea>
                                            </div>

                                            <div class="col-sm-4 form-group">
                                                <label for="email">Control Owner:</label>
                                                <select class="form-control control_owner_id" name="control_owner_id">
                                                    <option value="0" selected>Select Control Owner</option>
                                                    @foreach($officerLists as $key => $officer_list)
                                                        @foreach($officer_list['units'] as $unit)
                                                            @foreach($unit['designations'] as $designation)
                                                                @if(!empty($designation['employee_info']))
                                                                    <option @if($designation['employee_info']['id'] == $sub_area_risk_info['control_owner_id']) selected @endif value="{{$designation['employee_info']['id']}}">{{!empty($designation['employee_info']) ? $designation['employee_info']['name_eng'] : ''}}</option>
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif

                                        @if($sub_area_risk_info['assessment_type'] == 'final')
                                            <div class="col-sm-4 form-group">
                                                <label for="comments">Comments:</label>
                                                <textarea type="text" class="form-control" placeholder="Enter Comments" name="comments">{{$sub_area_risk_info['comments']}}</textarea>
                                            </div>

                                            <div class="col-sm-4 form-group">
                                                <label for="email">Related Issue Number:</label>
                                                <select class="form-control issue_id" name="issue_id">
                                                    <option selected>Select Risk</option>
                                                </select>
                                            </div>
                                        @endif
                                        </div>
                                </div>

                            <div class="form-row">
                                <div class="col-sm-12 text-left">
                                    <button type="button" class="btn btn-sm btn-square btn-primary mr-2" id="submit_button">
                                        <i class="fa fa-save"></i> Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        let audit_area_id = '{{$audit_area_id}}';
        setAvailableInherentRisk(audit_area_id);
    });
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

        function getInherentRisk(){
            let audit_area_id = $('#sub_area_id').val();
            setAvailableInherentRisk(audit_area_id);
        }

        function setAvailableInherentRisk(audit_area_id){
            loaderStart('Please wait...');

            let assessment_sector_type = '{{$assessment_sector_type}}';

            let parent_area_id = '{{$audit_area_id}}';

            let assessment_sector_id = '{{$assessment_sector_id}}';

            let data = {assessment_sector_type,assessment_sector_id,parent_area_id,audit_area_id};

            let url = "{{route('audit.plan.risk-identifications.child-area-risk-list')}}";

            ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
                loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('.inherent_risk_id').html(response);
                    let inherent_risk_id = '{{$sub_area_risk_info['inherent_risk_id']}}';
                    $('.inherent_risk_id').val(inherent_risk_id);
                }
            });
        }

        function updateItemRiskAssessments () {

            loaderStart('Please wait...');

            data = $('#sub_area_risk_form').serializeArray();

            sub_area_name = $(this).find(".sub_area_id option:selected").val() != 0 ? $(this).find(".sub_area_id option:selected").text() : '';
            inherent_risk = $(this).find(".inherent_risk_id option:selected").val() != 0 ? $(this).find(".inherent_risk_id option:selected").text() : '';
            risk_owner_name = $(this).find(".risk_owner_id option:selected").val() != 0 ? $(this).find(".risk_owner_id option:selected").text() : '';
            process_owner_name = $(this).find(".process_owner_id option:selected").val() != 0 ? $(this).find(".process_owner_id option:selected").text() : '';
            control_owner_name = $(this).find(".control_owner_id option:selected").val() != 0 ? $(this).find(".control_owner_id option:selected").text() : '';

            data.push({name: "sub_area_name", value: sub_area_name});
            data.push({name: "inherent_risk", value: inherent_risk});
            data.push({name: "risk_owner_name", value: risk_owner_name});
            data.push({name: "process_owner_name", value: process_owner_name});
            data.push({name: "control_owner_name", value: control_owner_name});

            let url = "{{route('settings.sector-risk-assessments.update', $sub_area_risk_info['id'])}}";

            ajaxCallAsyncCallbackAPI(url, data, 'PUT', function (response) {
                loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    toastr.success(response.data);
                    $('#kt_quick_panel_close').click();
                    $('#filter_project_id').trigger('change');
                }
            });
        }

    function getRiskLevelAndPriority(elem){
        let x_risk_assessment_likelihood_id = $('[name=x_risk_assessment_likelihood_id]').val();
        let x_risk_assessment_impact_id = $('[name=x_risk_assessment_impact_id]').val();
        setAvailableRiskLevelAndPriority(x_risk_assessment_likelihood_id,x_risk_assessment_impact_id);
    }

    function setAvailableRiskLevelAndPriority (x_risk_assessment_likelihood_id,x_risk_assessment_impact_id) {

        loaderStart('Please wait...');

        let data = {x_risk_assessment_likelihood_id,x_risk_assessment_impact_id};

        let url = "{{route('risk-assessment.likelihood-impact-wise-matrix')}}";

        ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
            loaderStop();
            if (response.status === 'error') {
                toastr.error(response.data);
            } else {
                $('[name=risk_level]').val(response.data.risk_level);
                $('[name=priority]').val(response.data.priority);
            }
        });

    }
</script>
