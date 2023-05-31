<div class="tab-pane fade border border-top-0 p-3 show active strategic_year_{{$data['strategic_plan_year']}}" role="tabpanel" aria-labelledby="calender-tab">
    <div class="row">
        <div class="col-12">
            @if (!empty($individual_strategic_plan['project_list']))
            <table style="table-layout: fixed" class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th width="45%">Project Name</th>
                        {{--  <th width="25%">Location</th>  --}}
                        <th width="10%">Number of Location</th>
                        <th width="30%">Comment</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($individual_strategic_plan['project_list'] as $projects)
                        <tr>
                            <td>
                                {{$projects['project_name_en']}}
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
                                {{$projects['location_no']}}
                            </td>
                            <td>
                                {{$projects['comment']}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @if (!empty($individual_strategic_plan['function_list']))
            <table style="table-layout: fixed" class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th width="45%">Function Name</th>
                    {{--  <th width="25%">Location</th>  --}}
                    <th width="10%">Number of Location</th>
                    <th width="30%">Comment</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($individual_strategic_plan['function_list'] as $functions)
                        <tr>
                            <td>
                                {{$functions['function_name_bn']}}
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
                                {{$functions['location_no']}}
                            </td>
                            <td>
                                {{$functions['comment']}}
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>

