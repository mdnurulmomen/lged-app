<div class="card sna-card-border mt-2">
    <div class="col-md-12 text-right">
        <a class="btn btn-sm btn-warning btn_back btn-square mr-3">
            <i class="fad fa-arrow-alt-left"></i> Go Back
        </a>
        <button class="btn btn-sm btn-square btn-primary mr-2" onclick="Yearly_Plan_Container.updateYearlyPlan($(this))">
            <i class="fa fa-save"></i> Update
        </button>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card sna-card-border">
            <div class="row">
                <div class="col-4">
                    <select class="form-control select-select2" name="strategic_plan_year" id="strategic_plan_year">
                        <option data-strategic-plan="{{$data['yearly_plan_id']}}" value="{{$data['strategic_plan_year']}}">{{$data['strategic_plan_year']}}</option>
                        {{--  <option value="{{$data['yearly_plan_id']}}">{{$data['strategic_plan_year']}}</option>  --}}
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card sna-card-border mt-2 strategic_year_{{$data['strategic_plan_year']}}">
    <div class="row">
        <div class="col-12">
            <input type="hidden" class="form-control yearly_plan_id" value="{{$data['yearly_plan_id']}}">
            <label>Project :</label>
            <table style="table-layout: fixed" id="project_table_{{$data['strategic_plan_year']}}" class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th width="45%">Project Name</th>
                    {{--  <th width="25%">Location</th>  --}}
                    <th width="15%">Number of Location</th>
                    <th width="30%">Comment</th>
                    <th width="10%">Action</th>
                </tr>
                </thead>
                <tbody>
                @if ($individual_yearly_plan['project_list'])
                    @foreach($individual_yearly_plan['project_list'] as $projects)
                    <tr class="strategic_row project_row_{{$projects['strategic_plan_year']}}" id="location{{ $projects['id'] }}">
                        <input type="hidden" class="form-control project_location_id" value="{{$projects['id']}}">
                        <td>
                            <select data-strategic-year="{{$projects['strategic_plan_year']}}" data-id="{{$loop->iteration}}" class="form-control project_id_{{$projects['strategic_plan_year']}} select-select2 project-select">
                                <option selected value="">Select Project</option>
                                @foreach($all_project as $project)
                                    <option data-project-name-en="{{$project['name_en']}}"
                                            value="{{$project['id']}}" @if($projects['project_id'] == $project['id']) selected @endif>{{$project['name_en']}} ({{ $project['risk_score_key'] ? ucfirst($project['risk_score_key']) : '--' }})</option>
                                @endforeach
                            </select>
                        </td>
                        {{--  <td>
                            <select id="location_{{$projects['strategic_plan_year']}}_{{$loop->iteration}}" class="form-control location_id_{{$projects['strategic_plan_year']}} select-select2">
                                @if($projects['cost_center_id'])
                                <option selected data-parent-office-id="{{$projects['cost_center_id']}}"
                                        data-parent-office-name-en="{{$projects['parent_office_id']}}"
                                        data-parent-office-name-bn="{{$projects['parent_office_bn']}}"
                                        data-office-name-en="{{$projects['cost_center_en']}}"
                                        data-office-name-bn="{{$projects['cost_center_bn']}}"
                                        value="{{$projects['cost_center_id']}}">{{$projects['cost_center_bn']}}</option>
                                @else
                                    <option value="" selected> Select Cost Center </option>
                                @endif
                            </select>
                        </td>  --}}
                        <td>
                            <input type="text" class="form-control location_no_{{$projects['strategic_plan_year']}}" value="{{$projects['location_no']}}">
                        </td>
                        <td>
                            <textarea style="height: 40px;" class="form-control comment_{{$projects['strategic_plan_year']}}">{{$projects['comment']}}</textarea>
                        </td>
                        <td>
                            <div style="display: flex">
                                <button type="button" title="ট্রানজিট"
                                        onclick="Plan_Common_Container.addLocationRow('{{$projects['strategic_plan_year']}}','project')"
                                        class="btn btn-icon btn-outline-warning border-0 btn-xs mr-2">
                                    <span class="fad fa-plus"></span>
                                </button>

                                <button type='button' title="বাদ দিন"
                                        data-row='row1'
                                        data-strategic-plan-year="{{ $projects['strategic_plan_year'] }}"
                                        data-location-id="{{ $projects['id'] }}"
                                        onclick="removeLocationRow($(this))"
                                        class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2'>
                                    <span class='fal fa-trash-alt'></span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @else
                <tr class="strategic_row project_row_{{$data['strategic_plan_year']}}">
                    <input type="hidden" class="form-control function_location_id" value="null">
                    <td>
                        <select data-strategic-year="{{$data['strategic_plan_year']}}" class="form-control project_id_{{$data['strategic_plan_year']}} select-select2 project-select">
                            <option selected value="">Select Project</option>
                            @foreach($all_project as $project)
                                <option data-project-name-en="{{$project['name_en']}}"
                                        value="{{$project['id']}}">{{$project['name_en']}} ({{ $project['risk_score_key'] ? ucfirst($project['risk_score_key']) : '--' }})</option>
                            @endforeach
                        </select>
                    </td>
                    {{--  <td>
                        <select id="location_{{$projects['strategic_plan_year']}}_{{$loop->iteration}}" class="form-control location_id_{{$projects['strategic_plan_year']}} select-select2">
                            @if($projects['cost_center_id'])
                            <option selected data-parent-office-id="{{$projects['cost_center_id']}}"
                                    data-parent-office-name-en="{{$projects['parent_office_id']}}"
                                    data-parent-office-name-bn="{{$projects['parent_office_bn']}}"
                                    data-office-name-en="{{$projects['cost_center_en']}}"
                                    data-office-name-bn="{{$projects['cost_center_bn']}}"
                                    value="{{$projects['cost_center_id']}}">{{$projects['cost_center_bn']}}</option>
                            @else
                                <option value="" selected> Select Cost Center </option>
                            @endif
                        </select>
                    </td>  --}}
                    <td>
                        <input type="text" class="form-control location_no_{{$data['strategic_plan_year']}}">
                    </td>
                    <td>
                        <textarea style="height: 40px;" class="form-control comment_{{$data['strategic_plan_year']}}"></textarea>
                    </td>
                    <td>
                        <div style="display: flex">
                            <button type="button" title="ট্রানজিট"
                                    onclick="Plan_Common_Container.addLocationRow('{{$data['strategic_plan_year']}}','project')"
                                    class="btn btn-icon btn-outline-warning border-0 btn-xs mr-2">
                                <span class="fad fa-plus"></span>
                            </button>

                            <button type='button' title="বাদ দিন"
                                    data-row='row1'
                                    onclick="Plan_Common_Container.removeLocationRow($(this))"
                                    class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2'>
                                <span class='fal fa-trash-alt'></span>
                            </button>
                        </div>
                    </td>
                </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <label>Function :</label>
            <table style="table-layout: fixed" id="function_table_{{$data['strategic_plan_year']}}" class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th width="45%">Function Name</th>
                    {{--  <th width="25%">Location</th>  --}}
                    <th width="15%">Number of Location</th>
                    <th width="30%">Comment</th>
                    <th width="10%">Action</th>
                </tr>
                </thead>
                <tbody>
                    @if (!empty($individual_yearly_plan['function_list']))
                @foreach($individual_yearly_plan['function_list'] as $functions)
                    <tr class="strategic_row function_row_{{$functions['strategic_plan_year']}}" id="location{{ $functions['id'] }}">
                        <input type="hidden" class="form-control function_location_id" value="{{$functions['id']}}">
                        <td>
                            <select data-strategic-year={{$functions['strategic_plan_year']}}"" data-id="{{$loop->iteration}}" class="form-control function_id_{{$functions['strategic_plan_year']}} select-select2 project-select">
                                <option selected value="">select function</option>
                                @foreach($all_function as $function)
                                    <option data-project-name-en="{{$function['name_en']}}"
                                            value="{{$function['id']}}" @if($functions['function_id'] == $function['id']) selected @endif>{{$function['name_bn']}}</option>
                                @endforeach
                            </select>
                        </td>
                        {{--  <td>
                            <select id="location_{{$functions['strategic_plan_year']}}_{{$loop->iteration}}" class="form-control location_id_{{$functions['strategic_plan_year']}} select-select2">

                                @if($functions['cost_center_id'])
                                <option selected data-parent-office-id="{{$functions['cost_center_id']}}"
                                        data-parent-office-name-en="{{$functions['parent_office_id']}}"
                                        data-parent-office-name-bn="{{$functions['parent_office_bn']}}"
                                        data-office-name-en="{{$functions['cost_center_en']}}"
                                        data-office-name-bn="{{$functions['cost_center_bn']}}"
                                        value="{{$functions['cost_center_id']}}">{{$functions['cost_center_bn']}}</option>
                                @else
                                    <option value="" selected>Select Cost Center</option>
                                @endif
                            </select>
                        </td>  --}}
                        <td>
                            <input type="text" class="form-control location_no_{{$functions['strategic_plan_year']}}" value="{{$functions['location_no']}}">
                        </td>
                        <td>
                            <textarea style="height: 40px;" class="form-control comment_{{$functions['strategic_plan_year']}}">{{$functions['comment']}}</textarea>
                        </td>
                        <td>
                            <div style="display: flex">
                                <button type="button" title="ট্রানজিট"
                                        onclick="Plan_Common_Container.addLocationRow('{{$functions['strategic_plan_year']}}','function')"
                                        class="btn btn-icon btn-outline-warning border-0 btn-xs mr-2">
                                    <span class="fad fa-plus"></span>
                                </button>

                                <button type='button' title="বাদ দিন"
                                        data-row='row1'
                                        data-strategic-plan-year="{{ $functions['strategic_plan_year'] }}"
                                        data-location-id="{{ $functions['id'] }}"
                                        onclick="removeLocationRow($(this))"
                                        class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2'>
                                    <span class='fal fa-trash-alt'></span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                @else
                <tr class="strategic_row function_row_{{$data['strategic_plan_year']}}">
                    <input type="hidden" class="form-control function_location_id" value="null">
                    <td>
                        <select data-strategic-year="{{$data['strategic_plan_year']}}" class="form-control function_id_{{$data['strategic_plan_year']}} select-select2 project-select">
                            <option selected value="">select function</option>
                            @foreach($all_function as $function)
                                <option data-project-name-en="{{$function['name_en']}}"
                                        value="{{$function['id']}}">{{$function['name_bn']}}</option>
                            @endforeach
                        </select>
                    </td>
                    {{--  <td>
                        <select id="location_{{$data['strategic_plan_year']}}_{{$loop->iteration}}" class="form-control location_id_{{$data['strategic_plan_year']}} select-select2">

                            @if($functions['cost_center_id'])
                            <option selected data-parent-office-id="{{$functions['cost_center_id']}}"
                                    data-parent-office-name-en="{{$functions['parent_office_id']}}"
                                    data-parent-office-name-bn="{{$functions['parent_office_bn']}}"
                                    data-office-name-en="{{$functions['cost_center_en']}}"
                                    data-office-name-bn="{{$functions['cost_center_bn']}}"
                                    value="{{$functions['cost_center_id']}}">{{$functions['cost_center_bn']}}</option>
                            @else
                                <option value="" selected>Select Cost Center</option>
                            @endif
                        </select>
                    </td>  --}}
                    <td>
                        <input type="text" class="form-control location_no_{{$data['strategic_plan_year']}}">
                    </td>
                    <td>
                        <textarea style="height: 40px;" class="form-control comment_{{$data['strategic_plan_year']}}"></textarea>
                    </td>
                    <td>
                        <div style="display: flex">
                            <button type="button" title="ট্রানজিট"
                                    onclick="Plan_Common_Container.addLocationRow('{{$data['strategic_plan_year']}}','function')"
                                    class="btn btn-icon btn-outline-warning border-0 btn-xs mr-2">
                                <span class="fad fa-plus"></span>
                            </button>

                            <button type='button' title="বাদ দিন"
                                    data-row='row1'
                                    onclick="Plan_Common_Container.removeLocationRow($(this))"
                                    class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2'>
                                <span class='fal fa-trash-alt'></span>
                            </button>
                        </div>
                    </td>
                </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('modules.strategic_plan.partial.strategic_plan_common_script');
<script>
    $('.select-select2').select2({width: '100%'});
    $('.btn_back').on("click", function() {
        $('.yearly_plan_link  a').click();
    });

    function removeLocationRow(elem){
        location_id = elem.data('location-id');
        strategic_plan_year = elem.data('strategic-plan-year');
        type = 'yearly';
        let url = '{{route('audit.plan.strategy.delete-location-data')}}';
        let data = {location_id,type};
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
            loaderStop();
            if (response.status === 'error') {
                toastr.error(response.data)
            } else {
                $("#location"+location_id).remove();
                toastr.success(response.data);
                loadList(strategic_plan_year);
            }
        });
    };

</script>
