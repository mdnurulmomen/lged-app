<form id="audit_area_form_update">
    <div class="form-row">
        <div class="col-sm-4 form-group">
            <input type="radio" name="sector_type" value="App\Models\Project" @if ($sector_type=="App\Models\Project") checked @endif> Project
        </div>

        <div class="col-sm-4 form-group">
            <input type="radio" name="sector_type" value="App\Models\AuditFunction" @if ($sector_type=="App\Models\AuditFunction") checked @endif> Function
        </div>
        
        <div class="col-sm-4 form-group">
            <input type="radio" name="sector_type" value="App\Models\UnitMasterInfo" @if ($sector_type=="App\Models\UnitMasterInfo") checked @endif> Master Unit
        </div>
    </div>
    
    <div class="form-row">
        <div class="col-sm-12 form-group">
            <div class="project_div" @if($sector_type=="App\Models\Project") style="display:block" @else style="display:none" @endif>
                <select   class="form-control select-select2" name="project_id" id="project_id">
                    <option value="" selected>Select Project</option>
                    @foreach ($allProjects as $project)
                        <option value="{{ $project['id'] }}"
                            @if ($sector_type=="App\Models\Project" && $sector_id==$project['id']) selected @endif
                        >
                            {{ $project['name_en'] }}
                            ({{ $project['risk_score_key'] ? $project['risk_score_key'] : '--' }})
                        </option>
                    @endforeach
                </select>
            </div>
    
            <div class="function_div" @if($sector_type=="App\Models\AuditFunction") style="display:block" @else style="display:none" @endif>
                <select  class="form-control select-select2" name="function_id" id="function_id">
                    <option value="" selected>Select Function</option>
                    @foreach ($allFunctions as $function)
                        <option 
                            value="{{ $function['id'] }}"
                            @if ($sector_type=="App\Models\AuditFunction" && $sector_id==$function['id']) selected @endif
                        >
                            {{ $function['name_en'] }}
                            ({{ $function['risk_score_key'] ? $function['risk_score_key'] : '--' }})
                        </option>
                    @endforeach
                </select>
            </div>
    
            <div class="unit_div" @if($sector_type=="App\Models\UnitMasterInfo") style="display:block" @else style="display:none" @endif>
                <select class="form-control select-select2" name="unit_master_id" id="unit_master_id">
                    <option value="" selected>Select Unit</option>
                    @foreach ($allMasterUnits as $masterUnit)
                        <option 
                            value="{{ $masterUnit['id'] }}"
                            @if ($sector_type=="App\Models\UnitMasterInfo" && $sector_id==$masterUnit['id']) selected @endif
                        >
                            {{ $masterUnit['name_en'] }}
                            ({{ $masterUnit['risk_score_key'] ? $masterUnit['risk_score_key'] : '--' }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="form-row">
        <input type="hidden" id="id" value="{{ $id }}">
        <div class="col-md-12 form-group">
            <label for="email">Title (Bangla):</label>
            <textarea placeholder="Name Bangla" class="form-control" type="text" id="name_bn">{{ $name_bn }}</textarea>
        </div>
        <div class="col-md-12 form-group">
            <label for="email">Title (English):</label>
            <textarea placeholder="Name English" class="form-control" type="text" id="name_en">{{ $name_en }}</textarea>
        </div>
        <div class="col-md-12 pt-4">
            <button type="button" class="btn btn-primary btn_update_audit_area pt-4 ml-1">Update</button>
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
    
        $('.btn_update_audit_area').click(function () {
            loaderStart('Please wait...');

            url = "{{ route('audit.execution.areas.update', $id) }}";
    
            let sector_type = $('input[name="sector_type"]:checked').val();
            
            let sector_id = (sector_type==='App\\Models\\Project') ? $('#project_id').find(':selected').val() 
            : (sector_type==='App\\Models\\AuditFunction') ? $('#function_id').find(':selected').val() 
            : $('#unit_master_id').find(':selected').val();
    
            let data = {
                id : $('#id').val(),
                name_bn : $('#name_bn').val(),
                name_en : $('#name_en').val(),
                sector_id,
                sector_type,
            };

            console.log(data);
    
            ajaxCallAsyncCallbackAPI(url, data, 'PUT', function (response) {
                loadData();
                loaderStop();
                if (response.status === 'success') {
                    toastr.success(response.data);
                    // loadData();
                    $('.ki-close').click();
                    $('.x_audit_area a').click();
                } else {
                    toastr.error(response.data.message)
                    if (response.data.errors) {
                        $.each(response.data.errors, function (k, v) {
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
                    
                    // console.log(response.data)
                }
            });
        });
    });
</script>
