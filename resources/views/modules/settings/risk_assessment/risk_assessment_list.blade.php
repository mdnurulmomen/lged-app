<x-title-wrapper>Risk Assessment List</x-title-wrapper>

<div class="card sna-card-border mt-3" style="margin-bottom:15px;">
    <div class="row">
        <div class="col-md-6">
            <span style="font-size: 18px" class="form-group">
                <input id="project" type="radio" name="risk_factor_type" checked onchange="Risk_Assessment_Factor_Approach_Container.setAssessmentType('project')"> Project
                <input id="function" type="radio" name="risk_factor_type" onchange="Risk_Assessment_Factor_Approach_Container.setAssessmentType('function')"> Function
                <input id="master_unit" type="radio" name="risk_factor_type" onchange="Risk_Assessment_Factor_Approach_Container.setAssessmentType('master_unit')"> Master Unit
                <input id="cost_center" type="radio" name="risk_factor_type" onchange="Risk_Assessment_Factor_Approach_Container.setAssessmentType('cost_center')"> Cost Center
            </span>
            
            <div class="project_div">
                <select   class="form-control select-select2" name="project_id" id="project_id" onchange="Risk_Assessment_Item_Container.laodItemRiskAssessments('project', this.value)">
                    <option selected>Select Project</option>
                    @foreach ($allProjects as $project)
                        <option value="{{ $project['id'] }}">{{ $project['name_en'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="function_div" style="display: none">
                <select  class="form-control select-select2" name="function_id" id="function_id" onchange="Risk_Assessment_Item_Container.laodItemRiskAssessments('function', this.value)">
                    <option selected>Select Function</option>
                    @foreach ($allFunctions as $function)
                        <option value="{{ $function['id'] }}">{{ $function['name_en'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="unit_div" style="display: none">
                <select class="form-control select-select2" name="unit_master_id" id="unit_master_id" onchange="Risk_Assessment_Item_Container.laodItemRiskAssessments('master-unit', this.value)">
                    <option selected>Select Unit</option>
                    @foreach ($allMasterUnits as $masterUnit)
                        <option value="{{ $masterUnit['id'] }}">{{ $masterUnit['name_en'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="cost_center_div" style="display: none">
                <select class="form-control select-select2" name="cost_center_id" id="cost_center_id" onchange="Risk_Assessment_Item_Container.laodItemRiskAssessments('cost-center', this.value)">
                    <option selected>Select Cost Center</option>
                    @foreach ($allCostCenters as $costCenter)
                        <option value="{{ $costCenter['id'] }}">{{ $costCenter['name_en'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6 text-right">
            <button class="btn btn-sm btn-info btn-square mr-1" 
                    title="বিস্তারিত দেখুন"
                    onclick='loadPage($(this))'
                    data-url="{{route('settings.item-risk-assessments.create')}}"
            >
                <i class="fad fa-plus"></i> Create
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
                        <th>SL</th>
                        <th>Audit Area</th>
                        <th>Inherent Risk</th>
                        <th>Impact</th>
                        <th>Likelihood</th>
                        <th>Control System</th>
                        <th>Control Effect</th>
                        <th>Residual Risk</th>
                        <th>Recommendation</th>
                        <th>Implemented By</th>
                        <th>Implemented On</th>
                    </tr>
                </thead>
            
                <tbody>
                    <tr>
                        <td colspan="11" class="datatable-cell text-center"><span>Please select entity</span></td>
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
        laodItemRiskAssessments: function (type, id) {
            loaderStart('loading...');
            let url = '{{route('settings.item-risk-assessments.list')}}';
            let data = {id,type};
            console.log(data);
            ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
                loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('.content-risk-assessments').html(response);
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

        /*
        loadProject:function (){
            loaderStart('loading...');
            let url = '{{route('settings.load_project_select')}}';
            let data = {};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#project_id').html(response);
                }
            });
        },

        loadFunction:function (){
            loaderStart('loading...');
            let url = '{{route('settings.load_function_select')}}';
            let data = {};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#function_id').html(response);
                }
            });
        },

        loadUnit:function (){
            loaderStart('loading...');
            let url = '{{route('settings.load_unit_master_select')}}';
            let data = {};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#unit_master_id').html(response);
                }
            });
        },
        */
    }
</script>