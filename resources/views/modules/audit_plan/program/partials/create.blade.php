<div class="row m-0 mb-2 page-title-wrapper d-md-flex align-items-md-center">
    <div class="col-md-6">
        <div class="title py-2">
            <h4 class="mb-0 font-weight-bold"><i class="fas fa-list mr-3"></i>Create Audit Program</h4>
        </div>
    </div>

    <div class="col-md-6 text-right">
        <button class="btn btn-sm btn-square btn-warning mr-2" id="go_back">
            <i class="fad fa-arrow-alt-left"></i> Go Back
        </button>
        <button class="btn btn-sm btn-square btn-primary mr-2" id="submit_button">
            <i class="fa fa-save"></i> Save
        </button>
    </div>
</div>

<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <div class="form-row" style="display: none">
                    <div class="col-sm-1 form-group">
                        <input type="radio" name="sector_type" value="project" @if($data['project_id']) checked @endif> Project
                    </div>

                    <div class="col-sm-1 form-group">
                        <input type="radio" name="sector_type" value="function"> Function
                    </div>

                    <div class="col-sm-2 form-group">
                        <input type="radio" name="sector_type" value="master-unit" > Master Unit
                    </div>

                    {{--
                    <div class="col-sm-2 form-group">
                        <input type="radio" name="sector_type" value="cost-center"> Cost Center
                    </div>
                    --}}
                </div>

                <div class="form-row">
                    <div class="col-sm-6 form-group">
                        <label>@if($data['project_id']) Project @endif:</label>
                        @if($data['project_id'])
                            <div class="project_div">
                                <select   class="form-control select-select2 sector" name="project_id" id="project_id">
                                    <option value="{{$data['project_id']}}" selected>{{$data['project_name_en']}}</option>
    {{--                                @foreach ($allProjects as $project)--}}
    {{--                                    <option value="{{ $project['id'] }}">--}}
    {{--                                        {{ $project['name_en'] }}--}}
    {{--                                        ({{ $project['risk_score_key'] ? $project['risk_score_key'] : '--' }})--}}
    {{--                                    </option>--}}
    {{--                                @endforeach--}}
                                </select>
                            </div>
                        @endif

                        <div class="function_div" style="display: none">
                            <select  class="form-control select-select2 sector" name="function_id" id="function_id">
                                <option value="" selected>Select Function</option>
{{--                                @foreach ($allFunctions as $function)--}}
{{--                                    <option value="{{ $function['id'] }}">--}}
{{--                                        {{ $function['name_en'] }}--}}
{{--                                        ({{ $function['risk_score_key'] ? $function['risk_score_key'] : '--' }})--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
                            </select>
                        </div>

                        <div class="unit_div" style="display: none">
                            <select class="form-control select-select2 sector" name="unit_master_id" id="unit_master_id">
                                <option value="" selected>Select Unit</option>
{{--                                @foreach ($allMasterUnits as $masterUnit)--}}
{{--                                    <option value="{{ $masterUnit['id'] }}">--}}
{{--                                        {{ $masterUnit['name_en'] }}--}}
{{--                                        ({{ $masterUnit['risk_score_key'] ? $masterUnit['risk_score_key'] : '--' }})--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
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
                        <label for="email">Area:</label>
                        <select class="form-control" name="audit_area_id" id="audit_area_id">
                            <option value="" selected>Please Select Area</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body pt-3">
                <div class="form-row">
                    <div class="col-sm-12 pl-7 pr-7">
                        <div class="form-row">
                            <div class="col-sm-6 form-group">
                                <label for="email">Area Index:</label>
                                <input type="number" class="form-control" placeholder="Enter Area Index" id="area_index" step=".1">
                            </div>

                            <div class="col-sm-6 form-group">
                                <label for="email">Category:</label>
                                <input type="text" class="form-control" placeholder="Enter Category" id="category">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-12 form-group">
                                <label for="email">Control Objective:</label>
                                <input type="text" class="form-control" placeholder="Enter Control Objective" id="control_objective">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div id="sector_area_procedures" class="card sector_area_procedures">
            <div class="card-header pt-1 pb-2">
                <p class="text-center m-0 indexAreaProcedure">Procedure 1</p>
            </div>
            <div class="pt-1">
                <div class="form-row">
                    <div class="col-sm-12 form-group">
                        <label for="email">Test Procedure:</label>
                        <textarea class="form-control" name="test_procedure" rows="3"></textarea>
                    </div>

                    {{--
                    <div class="col-sm-12 form-group">
                        <label for="email">Note:</label>
                        <textarea class="form-control" name="note" rows="3"></textarea>
                    </div>

                    <div class="col-sm-12 form-group">
                        <label for="email">Done By:</label>
                        <input type="text" class="form-control" placeholder="Enter Name" name="done_by">
                    </div>

                    <div class="col-sm-12 form-group">
                        <label for="email">Reference:</label>
                        <input type="text" class="form-control" placeholder="Enter Reference" name="reference">
                    </div>
                    --}}
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

<script>
    $(document).ready(function() {
        // Item_Risk_Assessment_Container.loadRiskFactorType('project');
        $('.sector').trigger('change');
    });

    $('input[type=radio][name=sector_type]').change(function() {
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
        // console.log('sector');
        setAvailableAreas();
    });

    $('#submit_button').on('click',function () {
        // console.log('submit');
        storeAuditAreaPrograms();
    });

    $('#add_risk').on('click', function () {
        // console.log('add');
        addProcedure();
        adjustProcedureIndex();
    });

    $('#remove_risk').on("click", function() {
        // console.log('remove');
        removeProcedure();
        adjustProcedureIndex();
    });

    $('#go_back').on("click", function() {
        $('.sector_area_program_menu  a').click();
    });

    function addProcedure () {
        var clone_text = $("#sector_area_procedures").clone();
        clone_text.find("textarea").val("");
        clone_text.insertAfter(".sector_area_procedures:last");
        $("#sector_area_procedures").last().val('');
    }

    function removeProcedure () {
        // console.log('remove');
        if ($('.sector_area_procedures').length > 1) {
            $('.sector_area_procedures:last').remove();
        }
    }

    function adjustProcedureIndex() {
        $( ".indexAreaProcedure" ).each(function( index ) {
            $(this).text('Procedure '+ (index + 1))
        });
    }

    function setAvailableAreas () {

        // loaderStart('Please wait...');

        let sector_type = $('input[name="sector_type"]:checked').val();

        let sector_id = (sector_type=='project') ? $('#project_id').find(':selected').val()
            : (sector_type=='function') ? $('#function_id').find(':selected').val()
                : (sector_type=='master-unit') ? $('#unit_master_id').find(':selected').val()
                    : $('#cost_center_id').find(':selected').val();

        let data = {sector_type, sector_id};

        let url = "{{route('audit.plan.programs.area-list')}}";

        ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
            // loaderStop();
            if (response.status === 'error') {
                toastr.error(response.data);
            } else {
                $('#audit_area_id').html(response);
            }
        });

    }

    function storeAuditAreaPrograms () {

        loaderStart('Please wait...');

        // let sector_type = $('input[name="sector_type"]:checked').val();

        // let sector_id = (sector_type=='project') ? $('#project_id').find(':selected').val()
        // : (sector_type=='function') ? $('#function_id').find(':selected').val()
        // : (sector_type=='master-unit') ? $('#unit_master_id').find(':selected').val()
        // : $('#cost_center_id').find(':selected').val();

        let audit_plan_id = '{{$data['audit_plan_id']}}';
        let audit_area_id = $('#audit_area_id').find(':selected').val();
        let area_index = $('#area_index').val();
        let category = $('#category').val();
        let control_objective = $('#control_objective').val();

        let sector_audit_program = {
            audit_plan_id,
            audit_area_id,
            area_index,
            category,
            control_objective,
            procedures : []
        };

        $('.sector_area_procedures').each(function(index, risk) {
            audit_area_procedure = {};

            audit_area_procedure['test_procedure'] = $(this).find("textarea[name='test_procedure']").val();
            // audit_area_procedure['note'] = $(this).find("textarea[name='note']").val();
            // audit_area_procedure['done_by'] = $(this).find("input[name='done_by']").val();
            // audit_area_procedure['reference'] = $(this).find("input[name='reference']").val();

            sector_audit_program.procedures.push(audit_area_procedure);
        });

        let url = "{{route('audit.plan.programs.store')}}";

        ajaxCallAsyncCallbackAPI(url, sector_audit_program, 'POST', function (response) {
            loaderStop();
            if (response.status === 'error') {
                toastr.error(response.data)
            } else {
                toastr.success(response.data);
                $('.sector_area_program_menu  a').click();
            }
        });
    }
</script>
