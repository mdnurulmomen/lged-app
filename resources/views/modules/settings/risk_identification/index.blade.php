<x-title-wrapper>Risk List</x-title-wrapper>

<div class="card sna-card-border mt-3" style="margin-bottom:15px;">
    <div class="row d-flex align-items-end">
        <div class="col-md-6">
            <span style="font-size: 18px" class="form-group">
                <input id="project" type="radio" name="risk_sector_type" value="project" onchange="Risk_Assessment_Factor_Approach_Container.setAssessmentType('project')" checked> Project
                <input id="function" type="radio" name="risk_sector_type" value="function" onchange="Risk_Assessment_Factor_Approach_Container.setAssessmentType('function')"> Function
                <input id="master_unit" type="radio" name="risk_sector_type" value="master-unit" onchange="Risk_Assessment_Factor_Approach_Container.setAssessmentType('master_unit')"> Master Unit
                {{-- <input id="cost_center" type="radio" name="risk_sector_type" value="cost-center" onchange="Risk_Assessment_Factor_Approach_Container.setAssessmentType('cost_center')"> Cost Center --}}
            </span>
            
            <div class="project_div">
                <select class="form-control select-select2" name="project_id" id="project_id" onchange="Risk_Assessment_Item_Container.laodItemRiskParentAreas('project', this.value)">
                    <option selected>Select Project</option>
                    @foreach ($allProjects as $project)
                        <option value="{{ $project['id'] }}">{{ $project['name_en'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="function_div" style="display: none">
                <select class="form-control select-select2" name="function_id" id="function_id" onchange="Risk_Assessment_Item_Container.laodItemRiskParentAreas('function', this.value)">
                    <option selected>Select Function</option>
                    @foreach ($allFunctions as $function)
                        <option value="{{ $function['id'] }}">{{ $function['name_en'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="unit_div" style="display: none">
                <select class="form-control select-select2" name="unit_master_id" id="unit_master_id" onchange="Risk_Assessment_Item_Container.laodItemRiskParentAreas('master-unit', this.value)">
                    <option selected>Select Unit</option>
                    @foreach ($allMasterUnits as $masterUnit)
                        <option value="{{ $masterUnit['id'] }}">{{ $masterUnit['name_en'] }}</option>
                    @endforeach
                </select>
            </div>

            {{-- <div class="cost_center_div" style="display: none">
                <select class="form-control select-select2" name="cost_center_id" id="cost_center_id" onchange="Risk_Assessment_Item_Container.laodItemRiskIdentifications('cost-center', this.value)">
                    <option selected>Select Cost Center</option>
                    @foreach ($allCostCenters as $costCenter)
                        <option value="{{ $costCenter['id'] }}">{{ $costCenter['name_en'] }}</option>
                    @endforeach
                </select>
            </div> --}}
        </div>

        <div class="col-md-3">
            <select class="form-control select-select2 parent_area_id" name="parent_area_id" id="parent_area_id" onchange="Risk_Assessment_Item_Container.laodItemRiskIdentifications(this.value)">
                <option selected>Select Parent Area</option>
            </select>
        </div>

        <div class="col-md-3 text-right">
            <button class="btn btn-sm btn-info btn-square mr-1" 
                    title="বিস্তারিত দেখুন"
                    onclick='loadPage($(this))'
                    data-url="{{route('audit.plan.risk-identifications.create')}}"
            >
                <i class="fad fa-plus"></i> Create
            </button>
        </div>
    </div>
</div>

<div class="card sna-card-border mt-3" style="margin-bottom:30px;">
    <div class="table-responsive">
        <div class="content-risk-identifications">
            <table class="table table-bordered" width="100%">
                <thead class="thead-light">
                    <tr>
                        <th>SL</th>
                        <th>Sub-Area</th>
                        <th>Risk Name</th>
                    </tr>
                </thead>
            
                <tbody>
                    <tr>
                        <td colspan="3" class="datatable-cell text-center"><span>Please select entity</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    $(function () {
        // Risk_Assessment_Factor_Approach_Container.setAssessmentType('project');
    });

    var Risk_Assessment_Item_Container = {
        laodItemRiskParentAreas: function (assessment_sector_type, assessment_sector_id) {
            if (! assessment_sector_type || ! assessment_sector_id) {
                return false;
            }
            
            loaderStart('loading...');

            let url = '{{route('audit.plan.risk-identifications.parent-area-list')}}';
            let data = {assessment_sector_id,assessment_sector_type};

            ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
                loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('.parent_area_id').html(response);
                }
            });
        },
        
        laodItemRiskIdentifications: function (parent_area_id) {
            loaderStart('loading...');

            let assessment_sector_type = $("input[name='risk_sector_type']:checked").val();

            if (assessment_sector_type=='project' && $('#project_id option').is(':selected')) {

                var assessment_sector_id = $('#project_id').find(":selected").val();

            } else if (assessment_sector_type=='function' && $('#function_id option').is(':selected')) {
                
                var assessment_sector_id = $('#function_id').find(":selected").val();

            } else if (assessment_sector_type=='master-unit' && $('#unit_master_id option').is(':selected')) {
                
                var assessment_sector_id = $('#unit_master_id').find(":selected").val();

            } 
            /* 
            else if (assessment_sector_id=='cost-center' && $('#cost_center_id option').is(':selected')) {
                
                var id = $('#cost_center_id').find(":selected").val();
            } 
            */
            else {
                alert('Please select a sector');
                return false;
            }
            
            let data = {assessment_sector_type,assessment_sector_id,parent_area_id};
            let url = '{{route('audit.plan.risk-identifications.list')}}';

            ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
                loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('.content-risk-identifications').html(response);
                }
            });
        },
    };

    var Risk_Assessment_Factor_Approach_Container = {
        setAssessmentType:function (type){
            if(type == 'project'){
                $('.project_div').show();
                $('.function_div').hide();
                $('.cost_center_div').hide();
                $('.unit_div').hide();
                // Risk_Assessment_Factor_Approach_Container.loadProject();

            }else if(type == 'function'){
                $('.project_div').hide();
                $('.function_div').show();
                $('.cost_center_div').hide();
                $('.unit_div').hide();
                // Risk_Assessment_Factor_Approach_Container.loadFunction();
            }else if(type == 'master_unit'){
                $('.project_div').hide();
                $('.function_div').hide();
                $('.cost_center_div').hide();
                $('.unit_div').show();
                // Risk_Assessment_Factor_Approach_Container.loadUnit();
            }
            else if(type == 'cost_center'){
                $('.project_div').hide();
                $('.function_div').hide();
                $('.cost_center_div').show();
                $('.unit_div').hide();
            }
        },
    }
</script>