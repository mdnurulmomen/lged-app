<div class="card sna-card-border mt-2 strategic_year_{{$data['strategic_plan_year']}}">
    <div class="row">
        <div class="col-12">
            <label>Project :</label>
            <table id="project_table_{{$data['strategic_plan_year']}}" class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th width="20%">Project</th>
                    <th width="20%">Location</th>
                    <th width="10%">Location No</th>
                    <th width="30%">Comment</th>
                    <th width="15%">Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($individual_strategic_plan['project_list'] as $projects)
                <tr class="strategic_row project_row_{{$projects['strategic_plan_year']}}">
                    <td>
                        <select data-strategic-year="{{$projects['strategic_plan_year']}}" data-id="{{$loop->iteration}}" class="form-control project_id_{{$projects['strategic_plan_year']}} select-select2 project-select">
                            <option selected value="">select project</option>
                            @foreach($all_project as $project)
                                <option data-project-name-en="{{$project['name_en']}}"
                                        value="{{$project['id']}}" @if($projects['project_id'] == $project['id']) selected @endif>{{$project['name_bn']}} ({{ $project['risk_score_key'] ? $project['risk_score_key'] : '--' }})</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select id="location_{{$projects['strategic_plan_year']}}_{{$loop->iteration}}" class="form-control location_id_{{$projects['strategic_plan_year']}} select-select2">
                            <option selected data-parent-office-id="{{$projects['cost_center_id']}}"
                                    data-parent-office-name-en="{{$projects['parent_office_id']}}"
                                    data-parent-office-name-bn="{{$projects['parent_office_bn']}}"
                                    data-office-name-en="{{$projects['cost_center_en']}}"
                                    data-office-name-bn="{{$projects['cost_center_bn']}}"
                                    value="{{$projects['cost_center_id']}}">{{$projects['cost_center_bn']}}</option>
                        </select>
                    </td>
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
                                    onclick="Plan_Common_Container.removeLocationRow('{{$projects['strategic_plan_year']}}','project')"
                                    class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2'>
                                <span class='fal fa-trash-alt'></span>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <label>Function :</label>
            <table id="function_table_{{$data['strategic_plan_year']}}" class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th width="20%">Function</th>
                    <th width="20%">Location</th>
                    <th width="10%">Location No</th>
                    <th width="30%">Comment</th>
                    <th width="15%">Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($individual_strategic_plan['function_list'] as $functions)
                    <tr class="strategic_row function_row_{{$functions['strategic_plan_year']}}">
                        <td>
                            <select data-strategic-year={{$functions['strategic_plan_year']}}"" data-id="{{$loop->iteration}}" class="form-control function_id_{{$functions['strategic_plan_year']}} select-select2 project-select">
                                <option selected value="">select function</option>
                                @foreach($all_function as $function)
                                    <option data-project-name-en="{{$function['name_en']}}"
                                            value="{{$function['id']}}" @if($functions['function_id'] == $function['id']) selected @endif>{{$function['name_bn']}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select id="location_{{$functions['strategic_plan_year']}}_{{$loop->iteration}}" class="form-control location_id_{{$functions['strategic_plan_year']}} select-select2">
                                <option selected data-parent-office-id="{{$functions['cost_center_id']}}"
                                        data-parent-office-name-en="{{$functions['parent_office_id']}}"
                                        data-parent-office-name-bn="{{$functions['parent_office_bn']}}"
                                        data-office-name-en="{{$functions['cost_center_en']}}"
                                        data-office-name-bn="{{$functions['cost_center_bn']}}"
                                        value="{{$functions['cost_center_id']}}">{{$functions['cost_center_bn']}}</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control location_no_{{$functions['strategic_plan_year']}}" value="{{$functions['location_no']}}">
                        </td>
                        <td>
                            <textarea style="height: 40px;" class="form-control comment_{{$functions['strategic_plan_year']}}">{{$functions['comment']}}</textarea>
                        </td>
                        <td>
                            <div style="display: flex">
                                <button type="button" title="ট্রানজিট"
                                        onclick="Plan_Common_Container.addLocationRow('{{$projects['strategic_plan_year']}}','function')"
                                        class="btn btn-icon btn-outline-warning border-0 btn-xs mr-2">
                                    <span class="fad fa-plus"></span>
                                </button>

                                <button type='button' title="বাদ দিন"
                                        data-row='row1'
                                        onclick="Plan_Common_Container.removeLocationRow('{{$projects['strategic_plan_year']}}','function')"
                                        class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2'>
                                    <span class='fal fa-trash-alt'></span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
