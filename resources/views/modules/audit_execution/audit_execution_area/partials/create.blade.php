<form id="audit_area_form">
    <div class="form-row">
        <div class="col-sm-4 form-group">
            <input type="radio" name="sector_type" value="App\Models\Project" checked> Project
        </div>

        <div class="col-sm-4 form-group">
            <input type="radio" name="sector_type" value="App\Models\AuditFunction"> Function
        </div>
        
        <div class="col-sm-4 form-group">
            <input type="radio" name="sector_type" value="App\Models\UnitMasterInfo" > Master Unit
        </div>
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
        </div>

        <div class="col-sm-12 form-group">
            <label>Parent Area</label>
            <select class="form-control select-select2" name="parent_id" id="parent_id">
                <option value="" selected>Select Parent Area</option>
                @foreach ($allAreas as $area)
                    <option value="{{ $area['id'] }}">
                        {{ ucfirst($area['name_en']) }}
                        ({{ ucfirst($area['name_bn']) }})
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-12 form-group">
            <label for="email">Title (Bangla):</label>
            <textarea placeholder="Name Bangla" class="form-control" type="text" id="name_bn"></textarea>
        </div>
        <div class="col-md-12 form-group">
            <label for="email">Title (English):</label>
            <textarea placeholder="Name English" class="form-control" type="text" id="name_en"></textarea>
        </div>
        <div class="col-md-12 pt-4">
            <button type="button" id="btn_audit_area_modal_save" class="btn btn-primary ml-auto">Save</button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('input[type=radio][name=sector_type]').change(function() {
            if (this.value === 'App\\Models\\Project') {
                $('.project_div').show();
                $('.function_div').hide();
                $('.unit_div').hide();
            }
            else if (this.value === 'App\\Models\\AuditFunction') {
                $('.project_div').hide();
                $('.function_div').show();
                $('.unit_div').hide();
            }
            else {
                $('.project_div').hide();
                $('.function_div').hide();
                $('.unit_div').show();
            }
        });

        $('#btn_audit_area_modal_save').click(function () {
            loaderStart('Please wait...');
            
            url = "{{ route('audit.execution.areas.store') }}";
            method = 'POST';
        
            let sector_type = $('input[name="sector_type"]:checked').val();
            
            let sector_id = (sector_type==='App\\Models\\Project') ? $('#project_id').find(':selected').val() 
            : (sector_type==='App\\Models\\AuditFunction') ? $('#function_id').find(':selected').val() 
            : $('#unit_master_id').find(':selected').val();
    
            data = {
                name_bn : $('#name_bn').val(),
                name_en : $('#name_en').val(),
                parent_id : $('#parent_id').find(':selected').val(),
                sector_id,
                sector_type,
            };
            
            // console.log(data);
    
            ajaxCallAsyncCallbackAPI(url, data, method, function (response) {
                if (response.status === 'success') {
                    loadData();
                    loaderStop();
                    toastr.success('Success')
                    $('.btn-quick-panel-close').click();
                } else {
                    // toastr.error(response.data.message)
                    if (response.errors.length) {
                        $.each(response.errors, function (k, v) {
                            if (isArray(v)) {
                                $.each(v, function (n, m) {
                                    toastr.error(m)
                                })
                            } else {
                                if (v !== '') {
                                    toastr.error(v);
                                }
                            }
                        });
                    }
                }
            })
        });
    });
</script>

