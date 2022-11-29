<div class="card sna-card-border mt-3">
    <div class="annual_entity_selection_area mt-4">
        <ul class="nav nav-tabs custom-tabs mb-0" id="myTab" role="tablist">

            @for($i=$start; $i<=$end; $i++)
                <li class="nav-item">
                    <a class="nav-link @if($i == $start) active @endif"
                       data-toggle="tab" aria-controls="tree" href="#strategic_year_{{$i}}">
                        <span class="nav-text">{{$i}}</span>
                    </a>
                </li>
            @endfor
        </ul>

        <div class="tab-content" id="rp_office_tab">
            @for($i=$start; $i<=$end; $i++)
                <div class="tab-pane fade border border-top-0 p-3 strategic_year_{{$i}} @if($i == $start) show active @endif"
                     id="strategic_year_{{$i}}" role="tabpanel" aria-labelledby="calender-tab">
                    <div class="row">
                        <div class="col-12">
                            <label>Project :</label>
                            <table id="project_table_{{$i}}" class="table table-responsive table-striped">
                                <thead class="thead-light">
                                <tr class="d-flex">
                                    <th class="col-4">Project</th>
                                    <th class="col-2">Location</th>
                                    <th class="col-2">Location No</th>
                                    <th class="col-2">Comment</th>
                                    <th class="col-2">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="strategic_row project_row_{{$i}} d-flex">
                                    <td class="col-4">
                                        <select data-strategic-year="{{$i}}" data-id="1" class="form-control project_id_{{$i}} select-select2 project-select">
                                            <option selected value="">select project</option>
                                            @foreach($all_project as $project)
                                                <option data-project-name-en="{{$project['name_en']}}"
                                                        value="{{$project['id']}}">{{$project['name_bn']}} ({{ $project['risk_score_key'] ? $project['risk_score_key'] : '--' }})</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="col-2">
                                        <select id="location_{{$i}}_1" class="form-control location_id_{{$i}} select-select2">
                                            <option selected value="">select location</option>
                                        </select>
                                    </td>
                                    <td class="col-2">
                                        <input type="text" class="form-control location_no_{{$i}}">
                                    </td>
                                    <td class="col-2">
                                        <textarea style="height: 40px;" class="form-control comment_{{$i}}"></textarea>
                                    </td>
                                    <td class="col-2">
                                        <div style="display: flex">
                                            <button type="button" title="ট্রানজিট"
                                                    onclick="Plan_Common_Container.addLocationRow('{{$i}}','project')"
                                                    class="btn btn-icon btn-outline-warning border-0 btn-xs mr-2">
                                                <span class="fad fa-plus"></span>
                                            </button>

                                            <button type='button' title="বাদ দিন"
                                                    data-row='row1'
                                                    onclick="Plan_Common_Container.removeLocationRow('{{$i}}','project')"
                                                    class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2'>
                                                <span class='fal fa-trash-alt'></span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label>Function :</label>
                            <table id="function_table_{{$i}}" class="table table-responsive table-striped">
                                <thead class="thead-light">
                                <tr class="d-flex">
                                    <th class="col-4">Function</th>
                                    <th class="col-2">Location</th>
                                    <th class="col-2">Location No</th>
                                    <th class="col-2">Comment</th>
                                    <th class="col-2">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="strategic_row function_row_{{$i}} d-flex">
                                    <td class="col-4">
                                        <select class="form-control function_id_{{$i}} select-select2">
                                            <option selected value="">select function</option>
                                            @foreach($all_function as $function)
                                                <option value="{{$function['id']}}" data-function-name-en="{{$function['name_bn']}}">{{$function['name_bn']}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="col-2">
                                        <select class="form-control location_id_{{$i}} select-select2">
                                            <option selected value="">select location</option>
                                            <option data-parent-office-id="1"
                                                    data-parent-office-name-en="sdfasdf"
                                                    data-parent-office-name-bn="asdfasd"
                                                    data-office-name-en="cost center 1"
                                                    data-office-name-bn="cost center 1"
                                                    value="1">cost center</option>
                                        </select>
                                    </td>
                                    <td class="col-2">
                                       <input type="text" class="form-control location_no_{{$i}}">
                                    </td>
                                    <td class="col-2">
                                        <textarea style="height: 40px;" class="form-control comment_{{$i}}"></textarea>
                                    </td>
                                    <td class="col-2">
                                        <div style="display: flex">
                                            <button type="button" title="ট্রানজিট"
                                                    onclick="Plan_Common_Container.addLocationRow('{{$i}}','function')"
                                                    class="btn btn-icon btn-outline-warning border-0 btn-xs mr-2">
                                                <span class="fad fa-plus"></span>
                                            </button>

                                            <button type='button' title="বাদ দিন"
                                                    data-row='row1'
                                                    onclick="Plan_Common_Container.removeLocationRow('{{$i}}','function')"
                                                    class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2'>
                                                <span class='fal fa-trash-alt'></span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>

<script>
    $('.project-select').change(function (){
        row_no =  $(this).attr('data-id');
        project_id =  $(this).val();
        strategic_year =  $(this).attr('data-strategic-year');
        Plan_Common_Container.loadCostCenterProjectMap(project_id,row_no,strategic_year);
    });
</script>
