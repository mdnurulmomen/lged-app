<div class="row m-0 mb-2 page-title-wrapper d-md-flex align-items-md-center">
    <div class="col-md-6">
        <div class="title py-2">
            <h4 class="mb-0 font-weight-bold"><i class="fas fa-list mr-3"></i>Create Audit Program</h4>
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
                    <div class="col-sm-1 form-group">
                        <input type="radio" name="sector_type" value="project" @if ($auditArea['sector_type']=='App\Models\Project') checked @endif> Project
                    </div>
            
                    <div class="col-sm-1 form-group">
                        <input type="radio" name="sector_type" value="function" @if ($auditArea['sector_type']=='App\Models\AuditFunction') checked @endif> Function
                    </div>
                    
                    <div class="col-sm-2 form-group">
                        <input type="radio" name="sector_type" value="master-unit" @if ($auditArea['sector_type']=='App\Models\UserMasterInfo') checked @endif> Master Unit
                    </div>
            
                    {{-- 
                    <div class="col-sm-3 form-group">
                        <input type="radio" name="sector_type" value="cost-center"> Cost Center
                    </div> 
                    --}}
                </div>
                
                <div class="form-row">
                    <div class="col-sm-12 form-group">
                        <div class="project_div">
                            <select   class="form-control select-select2 sector" name="project_id" id="project_id">
                                @foreach ($allProjects as $project)
                                    <option 
                                        value="{{ $project['id'] }}"
                                        @if ($auditArea['sector_type']=='App\Models\Project' && $auditArea['sector_id']==$project['id']) selected @endif
                                    >
                                        {{ $project['name_en'] }}
                                        ({{ $project['risk_score_key'] ? $project['risk_score_key'] : '--' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                
                        <div class="function_div" style="display: none">
                            <select  class="form-control select-select2 sector" name="function_id" id="function_id">
                                    
                                @foreach ($allFunctions as $function)
                                    <option 
                                        value="{{ $function['id'] }}"
                                        @if ($auditArea['sector_type']=='App\Models\AuditFunction' && $auditArea['sector_id']==$function['id']) selected @endif
                                    >
                                        {{ $function['name_en'] }}
                                        ({{ $function['risk_score_key'] ? $function['risk_score_key'] : '--' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                
                        <div class="unit_div" style="display: none">
                            <select class="form-control select-select2 sector" name="unit_master_id" id="unit_master_id">
                                @foreach ($allMasterUnits as $masterUnit)
                                    <option 
                                        value="{{ $masterUnit['id'] }}"
                                        @if ($auditArea['sector_type']=='App\Models\UnitMasterInfo' && $auditArea['sector_id']==$masterUnit['id']) selected @endif
                                    >
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

                    <div class="col-sm-12">
                        <label for="email">Area:</label>
                        <select class="form-control" name="audit_area_id" id="audit_area_id">
                            @foreach ($allAreas as $area)
                                <option 
                                    value="{{ $area['id'] }}" 
                                    @if ($area['id']==$audit_area_id)
                                        selected
                                    @endif
                                >
                                    {{ $area['name_en'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body pt-3">
                <div class="form-row">
                    <div class="col-sm-12 pl-7 pr-7">
                        <div class="form-row">
                            <div class="col-sm-4 form-group">
                                <label for="email">Area Index:</label>
                                <input type="number" value="{{ $area_index }}" class="form-control" placeholder="Enter Area Index" id="area_index" step=".1">
                            </div>

                            <div class="col-sm-4 form-group">
                                <label for="email">Category:</label>
                                <input type="text" value="{{ $category }}" class="form-control" placeholder="Enter Category" id="category">
                            </div>

                            <div class="col-sm-4 form-group">
                                <label for="email">Control Objective:</label>
                                <input type="text" value="{{ $control_objective }}" class="form-control" placeholder="Enter Control Objective" id="control_objective">
                            </div>
                        </div>

                        @foreach ($procedures as $procedureIndex => $procedure)
                            <div class="card sector_area_procedures">
                                <div class="card-header pt-1 pb-2">
                                    <p class="text-center m-0 indexAreaProcedure">Procedure {{ $procedureIndex + 1 }}</p> 
                                </div>
                                <div class="card-body pt-1">
                                    <div class="form-row">
                                        <div class="col-sm-12 form-group">
                                            <label for="email">Test Procedure:</label>
                                            <textarea class="form-control" name="test_procedure" rows="3">{{ $procedure['test_procedure'] }}</textarea>
                                        </div>

                                        {{-- 
                                        <div class="col-sm-12 form-group">
                                            <label for="email">Note:</label>
                                            <textarea class="form-control" name="note" rows="3">{{ $procedure['note'] }}</textarea>
                                        </div>

                                        <div class="col-sm-12 form-group">
                                            <label for="email">Done By:</label>
                                            <input type="text" value="{{ $procedure['done_by'] }}" class="form-control" placeholder="Enter Name" name="done_by">
                                        </div>

                                        <div class="col-sm-12 form-group">
                                            <label for="email">Reference:</label>
                                            <input type="text" value="{{ $procedure['reference'] }}" class="form-control" placeholder="Enter Reference" name="reference">
                                        </div> 
                                        --}}
                                    </div>
                                </div>
                            </div>                            
                        @endforeach

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
            // console.log('back');
            backToList();
        });

        function addProcedure () {
            $(".sector_area_procedures").clone().insertAfter(".sector_area_procedures:last");
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
    
        function backToList () {
            $('.sector_area_program_menu  a').click();
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

            let audit_area_id = $('#audit_area_id').find(':selected').val();
            let area_index = $('#area_index').val();
            let category = $('#category').val();
            let control_objective = $('#control_objective').val();
    
            let sector_audit_program = {
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
    
            let url = "{{route('audit.plan.programs.update', $id)}}";

            ajaxCallAsyncCallbackAPI(url, sector_audit_program, 'PUT', function (response) {
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