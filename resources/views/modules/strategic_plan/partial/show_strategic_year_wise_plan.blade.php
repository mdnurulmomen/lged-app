<div class="text-right">
    <button onclick="Strategic_Plan_Container.downloadStrategicPlanList($(this))"
            title="Download"
            data-strategic-plan-id="{{$data['strategic_plan_id']}}" 
            data-strategic-plan-year="{{$data['strategic_plan_year']}}" 
            class="btn btn-danger btn-sm btn-bold btn-square">
        <i class="far fa-file-pdf"></i> Download
    </button>
</div>
<div class="card sna-card-border mt-3">
    <div class="annual_entity_selection_area mt-4">
        <ul class="nav nav-tabs custom-tabs mb-0" id="myTab" role="tablist">
            @for ($i = $start; $i <= $end; $i++)
                <li class="nav-item">
                    <a class="nav-link @if ($i == $start) active @endif" data-toggle="tab"
                        aria-controls="tree" href="#strategic_year_{{ $i }}">
                        <span class="nav-text">{{ $i }}</span>
                    </a>
                </li>
            @endfor
        </ul>

        <div class="tab-content" id="rp_office_tab">
            @for ($i = $start; $i <= $end; $i++)
                <div class="tab-pane fade border border-top-0 p-3 strategic_year_{{ $i }} @if ($i == $start) show active @endif"
                    id="strategic_year_{{ $i }}" role="tabpanel" aria-labelledby="calender-tab">
                    
                    @php
                        // dd($strategic_plan_list['project_list']);
                        $currentProjects = collect($strategic_plan_list['project_list'])->filter(function ($project) use ($i) {
                            return $project['strategic_plan_year']==$i;
                        });
                        // dd($currentProjects->all());
                    @endphp

                    @if (! $currentProjects->isEmpty())
                        <div class="row">
                            <div class="col-12 form-group">
                                <label>Project :</label>
                                <table id="project_table_{{ $i }}" class="table table-striped table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Project</th>
                                            <th>Location</th>
                                            <th>Location No</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($currentProjects as $project)
                                            <tr class="strategic_row project_row_{{ $i }}">
                                                <td >
                                                    {{ $project['project_name_en'] }}
                                                </td>
                                                <td >
                                                    {{ $project['cost_center_en'] }}
                                                </td>
                                                <td >
                                                    {{ $project['location_no'] }}
                                                </td>
                                                <td >
                                                    {{ $project['comment'] }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    @elseif ($currentProjects->isEmpty())
                        <div class="row">
                            <div class="col-12 form-group">
                                <table id="project_table" class="table table-striped table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Sector</th>
                                            <th>Location</th>
                                            <th>Location No</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="strategic_row project_row">
                                            <td class="text-danger" colspan="4">
                                                No Data Found
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif


                    @php
                        $currentFunctions = collect($strategic_plan_list['function_list'])->filter(function ($function) use ($i) {
                            return $function['strategic_plan_year']==$i;
                        });
                    @endphp

                    @if (! $currentFunctions->isEmpty())
                        <div class="row">
                            <div class="col-12 form-group">
                                <label>Function :</label>
                                <table id="function_table_{{ $i }}"
                                    class="table table-striped table-bordered"
                                >
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Function</th>
                                            <th>Location</th>
                                            <th>Location No</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($currentFunctions as $function)
                                        <tr class="strategic_row function_row_{{ $i }}">
                                            <td >
                                                {{ $function['function_name_en'] }}
                                            </td>

                                            <td >
                                                {{ $function['cost_center_en'] }}
                                            </td>

                                            <td >
                                                {{ $function['location_no'] }}
                                            </td>

                                            <td >
                                                {{ $function['comment'] }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    @elseif ($currentFunctions->isEmpty())
                        <div class="row">
                            <div class="col-12 form-group">
                                <table id="project_table" class="table table-striped table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Sector</th>
                                            <th>Location</th>
                                            <th>Location No</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="strategic_row project_row">
                                            <td class="text-danger" colspan="4">
                                                No Data Found
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            @endfor
        </div>
    </div>
</div>
