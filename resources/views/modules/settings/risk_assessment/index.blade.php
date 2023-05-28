<x-title-wrapper>{{ucfirst($type)}} Risk</x-title-wrapper>

<div class="card sna-card-border mt-3" style="margin-bottom:15px;">
    <div class="row d-flex align-items-end">
        <div class="col-md-6">
            <span style="font-size: 18px" class="form-group">
                <input id="field_office" type="radio" name="risk_factor_type" value="field_office" onchange="Risk_Assessment_Factor_Approach_Container.setAssessmentType('field_office')"> Field Offices
                <input id="project" type="radio" name="risk_factor_type" value="project" onchange="Risk_Assessment_Factor_Approach_Container.setAssessmentType('project')"> Project
                <input id="function" type="radio" name="risk_factor_type" value="function" onchange="Risk_Assessment_Factor_Approach_Container.setAssessmentType('function')"> Function
                <input id="master_unit" type="radio" name="risk_factor_type" value="master-unit" onchange="Risk_Assessment_Factor_Approach_Container.setAssessmentType('master_unit')"> Unit
                {{-- <input id="cost_center" type="radio" name="risk_factor_type" value="cost-center" onchange="Risk_Assessment_Factor_Approach_Container.setAssessmentType('cost_center')"> Cost Center --}}
            </span>

            <div class="project_div">
                <select class="form-control select-select2"  id="filter_project_id" onchange="Risk_Assessment_Item_Container.laodItemRiskAssessments('project', this.value)">
{{--                    <option selected>Select Project</option>--}}
                    @foreach ($allProjects as $project)
                        <option value="{{ $project['id'] }}">{{ $project['name_en'] }}
                            ({{ $project['risk_score_key'] ? ucfirst($project['risk_score_key']) : '--' }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="function_div" style="display: none">
                <select class="form-control select-select2" name="function_id" id="function_id" onchange="Risk_Assessment_Item_Container.laodItemRiskAssessments('function', this.value)">
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

            {{-- <div class="cost_center_div" style="display: none">
                <select class="form-control select-select2" name="cost_center_id" id="cost_center_id" onchange="Risk_Assessment_Item_Container.laodItemRiskAssessments('cost-center', this.value)">
                    <option selected>Select Cost Center</option>
                    @foreach ($allCostCenters as $costCenter)
                        <option value="{{ $costCenter['id'] }}">{{ $costCenter['name_en'] }}</option>
                    @endforeach
                </select>
            </div> --}}
        </div>

{{--        <div class="col-md-3"></div>--}}

        <div class="col-md-6 text-right">
            <button
                title="বিস্তারিত দেখুন"
                id="summery_assessment_button"
                class="btn btn-sm btn-info btn-square mr-1"
                data-url="{{route('settings.sector-risk-assessments.summery')}}"
            >
                <i class="fad fa-eye"></i> View Summery
            </button>

            <button class="btn btn-sm btn-info btn-square mr-1"
                    title="বিস্তারিত দেখুন"
                    onclick='Risk_Assessment_Factor_Approach_Container.downloadExcel($(this))'
            >
                <i class="fad fa-download"></i> Download
            </button>

{{--            <button class="btn btn-sm btn-info btn-square mr-1"--}}
{{--                    title="বিস্তারিত দেখুন"--}}
{{--                    onclick='loadPage($(this))'--}}
{{--                    data-url="{{route('settings.sector-risk-assessments.create',['type' => $type])}}"--}}
{{--            >--}}
{{--                <i class="fad fa-plus"></i> Create--}}
{{--            </button>--}}

            <button class="btn btn-sm btn-info btn-square mr-1"
                    title="বিস্তারিত দেখুন"
                    data-risk-assessment-type="{{$type}}"
                    onclick='Risk_Assessment_Item_Container.createRiskAssessment($(this))'
            >
                <i class="fad fa-plus"></i> Add new risk assessment
            </button>
        </div>
    </div>
</div>

<div class="card sna-card-border mt-3" style="margin-bottom:30px;">
    <div class="table-responsive">
        <div class="content-risk-assessments">
{{--            <table class="table table-bordered" width="100%">--}}
{{--                <thead class="thead-light">--}}
{{--                    <tr>--}}
{{--                        <th>SL</th>--}}
{{--                        <th>Audit Area</th>--}}
{{--                        <th>Inherent Risk</th>--}}
{{--                        <th>Impact</th>--}}
{{--                        <th>Likelihood</th>--}}
{{--                        <th>Control System</th>--}}
{{--                        <th>Control Effect</th>--}}
{{--                        <th>Residual Risk</th>--}}
{{--                        <th>Recommendation</th>--}}
{{--                        <th>Implemented By</th>--}}
{{--                        <th>Implemented On</th>--}}
{{--                    </tr>--}}
{{--                </thead>--}}

{{--                <tbody>--}}
{{--                    <tr>--}}
{{--                        <td colspan="11" class="datatable-cell text-center"><span>Please select entity</span></td>--}}
{{--                    </tr>--}}
{{--                </tbody>--}}
{{--            </table>--}}
        </div>
    </div>
</div>


<script>
    $(function () {
        $('#project').click();
        // Risk_Assessment_Factor_Approach_Container.setAssessmentType('project');

        $("#summery_assessment_button").click(function() {

            let url = $(this).attr("data-url");

            let assessment_type = '{{$type}}';

            let type = $("input[name='risk_factor_type']:checked").val();

            if (type=='project' && $('#project_id option').is(':selected')) {

                var id = $('#project_id').find(":selected").val();

            } else if (type=='function' && $('#function_id option').is(':selected')) {

                var id = $('#function_id').find(":selected").val();

            } else if (type=='master-unit' && $('#unit_master_id option').is(':selected')) {

                var id = $('#unit_master_id').find(":selected").val();

            }
            // else if (type=='cost-center' && $('#cost_center_id option').is(':selected')) {

            //     var id = $('#cost_center_id').find(":selected").val();
            // }
            else {
                alert('Please select a sector');
                return false;
            }

            loaderStart('loading...');

            let data = {id, type, assessment_type};

            ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
                loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('.content-risk-assessments').html(response);
                }
            });
        });
    });

    var Risk_Assessment_Item_Container = {
        laodItemRiskAssessments: function (type, id) {
            loaderStart('loading...');
            let assessment_type = '{{$type}}';
            let url = '{{route('settings.sector-risk-assessments.list')}}';
            let data = {id,type,assessment_type};

            ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
                loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('.content-risk-assessments').html(response);
                }
            });
        },
        createRiskAssessment: function (elem){
            loaderStart('loading...');
            let project_id = $('#filter_project_id').val();
            let function_id = $('#filter_function_id').val();
            let unit_id = $('#filter_unit_id').val();
            let type = elem.data('risk-assessment-type');

            url = "{{ route('settings.sector-risk-assessments.create') }}";
            var data = {type,project_id,function_id,unit_id};

            ajaxCallAsyncCallbackAPI(url, data, 'GET', function (resp) {
                loaderStop();
                if (resp.status === 'error') {
                    toastr.error('no');
                    // console.log(resp.data)
                } else {
                    quick_panel = $("#kt_quick_panel");
                    $('.offcanvas-wrapper').html('');
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '60%');
                    $('.offcanvas-footer').hide();
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $('.offcanvas-title').html('Create '+ type + 'risk assessment');
                    $('.offcanvas-wrapper').html(resp);
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

        downloadExcel:function (elem){
            loaderStart('loading...');

            let type = $("input[name='risk_factor_type']:checked").val();

            if (type=='project' && $('#project_id option').is(':selected')) {

                var id = $('#project_id').find(":selected").val();

            } else if (type=='function' && $('#function_id option').is(':selected')) {

                var id = $('#function_id').find(":selected").val();

            } else if (type=='master-unit' && $('#unit_master_id option').is(':selected')) {

                var id = $('#unit_master_id').find(":selected").val();

            }
            let assessment_type = '{{$type}}';
            let url = '{{route('settings.sector-risk-assessments.excel-download')}}';
            let data = {id,type,assessment_type};
            let datatype = 'json';
            ajaxCallUnsyncCallback(url, data, datatype, 'POST', function (response) {
                loaderStop();
                window.open(response.full_path,'_blank' );
            });
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
