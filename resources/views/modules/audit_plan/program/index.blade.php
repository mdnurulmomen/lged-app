<x-title-wrapper>Sector Program List</x-title-wrapper>

<div class="card sna-card-border mt-3" style="margin-bottom:15px;">
    <div class="row d-flex align-items-end">
        <div class="col-md-6">
            <span style="font-size: 18px" class="form-group">
                <input id="project" type="radio" name="sector_type" value="project" onchange="Risk_Assessment_Factor_Approach_Container.setAssessmentType('project')"> Project
                <input id="function" type="radio" name="sector_type" value="function" onchange="Risk_Assessment_Factor_Approach_Container.setAssessmentType('function')"> Function
                <input id="master_unit" type="radio" name="sector_type" value="master-unit" onchange="Risk_Assessment_Factor_Approach_Container.setAssessmentType('master_unit')"> Master Unit
                {{-- <input id="cost_center" type="radio" value="cost-center" onchange="Risk_Assessment_Factor_Approach_Container.setAssessmentType('cost_center')"> Cost Center --}}
            </span>
            
            <div class="project_div" style="display: none">
                <select class="form-control select-select2" name="project_id" id="project_id" onchange="Risk_Assessment_Item_Container.laodSectorAreas('project', this.value)">
                    <option selected>Select Project</option>
                    @foreach ($allProjects as $project)
                        <option value="{{ $project['id'] }}">{{ $project['name_en'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="function_div" style="display: none">
                <select class="form-control select-select2" name="function_id" id="function_id" onchange="Risk_Assessment_Item_Container.laodSectorAreas('function', this.value)">
                    <option selected>Select Function</option>
                    @foreach ($allFunctions as $function)
                        <option value="{{ $function['id'] }}">{{ $function['name_en'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="unit_div" style="display: none">
                <select class="form-control select-select2" name="unit_master_id" id="unit_master_id" onchange="Risk_Assessment_Item_Container.laodSectorAreas('master-unit', this.value)">
                    <option selected>Select Unit</option>
                    @foreach ($allMasterUnits as $masterUnit)
                        <option value="{{ $masterUnit['id'] }}">{{ $masterUnit['name_en'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="area_div">
                <select class="form-control select-select2" name="sector_area" id="sector_area" onchange="Risk_Assessment_Item_Container.laodAreaPrograms(this.value)">
                    <option selected>Select Area</option>
                </select>
            </div>
        </div>

        <div class="col-md-1">
            <button class="btn btn-sm btn-info btn-square mr-1" 
                    title="Download" 
                    onclick='Risk_Assessment_Item_Container.export($(this))'
            >
                <i class="fad fa-download"></i>
            </button>
        </div>

        <div class="col-md-2 text-right">
            <button class="btn btn-sm btn-info btn-square mr-1" 
                    title="বিস্তারিত দেখুন"
                    onclick='loadPage($(this))'
                    data-url="{{route('audit.plan.programs.create')}}"
            >
                <i class="fad fa-plus"></i> Create Program
            </button>
        </div>
    </div>
</div>

<div class="card sna-card-border mt-3" style="margin-bottom:30px;">
    <div class="table-responsive">
        <div class="content-risk-assessments">
            <table class="table table-bordered" width="100%">
                <thead class="thead-light">
                    <tr>
                        <th>Area</th>
                        <th>Category</th>
                        <th>Control Objective</th>
                        <th>Test Procedure</th>
                        <th>Notes</th>
                        <th>Done By</th>
                        <th>W/P Ref.</th>
                    </tr>
                </thead>
            
                <tbody>
                    <tr>
                        <td colspan="7" class="datatable-cell text-center"><span>Please select entity & area</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    var Risk_Assessment_Item_Container = {
        laodSectorAreas: function (sector_type, sector_id) {
            // loaderStart('loading...');

            let url = "{{route('audit.plan.programs.area-list')}}";
            let data = {sector_id, sector_type};

            ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
                // loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('#sector_area').html(response);
                }
            });
        },

        laodAreaPrograms: function (audit_area_id) {
            // console.log(audit_area_id);
            loaderStart('loading...');

            let url = "{{route('audit.plan.programs.list')}}";
            let data = {audit_area_id};

            ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
                loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('.content-risk-assessments').html(response);
                }
            });
        },

        export:function () {
            loaderStart('loading...');

            let sectorType = $("input[name='sector_type']:checked").val();

            let sectorName = sectorType == 'project' ? $('#project_id').find(':selected').text() : sectorType == 'function' ? $('#function_id').find(':selected').text() : $('#unit_master_id').find(':selected').text();
            
            let auditAreaName = $('#sector_area').find(':selected').text();

            let audit_area_id = $('#sector_area').find(':selected').val();

            let data = {sectorName, auditAreaName, audit_area_id};
            
            let url = "{{route('audit.plan.programs.export')}}";

            ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
                loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    // console.log(response);
                    const link = document.createElement('a');
                    link.setAttribute('href', response.data);
                    link.setAttribute('download', 'programs'); // Need to modify filename ...
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }
            });
        }
    };

    var Risk_Assessment_Factor_Approach_Container = {
        setAssessmentType:function (type){
            if(type == 'project'){
                $('.project_div').show();
                $('.function_div').hide();
                $('.cost_center_div').hide();
                $('.unit_div').hide();
                $('.content-risk-assessments').html('');

            }else if(type == 'function'){
                $('.project_div').hide();
                $('.function_div').show();
                $('.cost_center_div').hide();
                $('.unit_div').hide();
                $('.content-risk-assessments').html('');
            }else if(type == 'master_unit'){
                $('.project_div').hide();
                $('.function_div').hide();
                $('.cost_center_div').hide();
                $('.unit_div').show();
                $('.content-risk-assessments').html('');
            }
            else if(type == 'cost_center'){
                $('.project_div').hide();
                $('.function_div').hide();
                $('.cost_center_div').show();
                $('.unit_div').hide();
                $('.content-risk-assessments').html('');
            }
        },
    }
</script>