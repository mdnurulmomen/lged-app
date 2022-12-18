<div class="card sna-card-border mt-2 strategic_year">

    @if (! count($individual_yearly_plan['project_list']) && ! count($individual_yearly_plan['project_list']) && ! count($individual_yearly_plan['project_list']))
        <div class="row">
            <div class="col-sm-12">
                <table>
                    <tbody>
                        <tr class="text-danger">No Data Found</tr>
                    </tbody>
                </table>
            </div>
        </div>
        
    @elseif (count($individual_yearly_plan['project_list']))
        <div class="row">
            <div class="col-sm-12">
                <label>Project :</label>
                <table id="project_table" class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th width="20%">Project</th>
                            <th width="20%">Location</th>
                            <th width="20%">Location No</th>
                            <th width="20%">Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($individual_yearly_plan['project_list'] as $project)
                            <tr class="strategic_row project_row">
                                <td>{{ $project['project_name_en'] }}</td>
                                <td>{{ $project['cost_center_en'] }}</td>
                                <td>{{ $project['location_no'] }}</td>
                                <td>{{ $project['comment'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @elseif (count($individual_yearly_plan['function_list']))
        <div class="row">
            <div class="col-sm-12">
                <label>Function :</label>
                <table id="function_table" class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th width="20%">Function</th>
                            <th width="20%">Location</th>
                            <th width="20%">Location No</th>
                            <th width="20%">Comment</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($individual_yearly_plan['function_list'] as $function)
                            <tr class="strategic_row function_row">
                                <td>{{ $function['function_name_en'] }}</td>
                                <td>{{ $function['cost_center_en'] }}</td>
                                <td>{{ $function['location_no'] }}</td>
                                <td>{{ $function['comment'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @elseif (count($individual_yearly_plan['cost_centers']))
        <div class="row">
            <div class="col-sm-12">
                <label>Cost Center :</label>
                <table id="project_table" class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th width="20%">Cost Center</th>
                            <th width="20%">Location</th>
                            <th width="20%">Location No</th>
                            <th width="20%">Comment</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($individual_yearly_plan['cost_centers'] as $costCenter)
                            <tr class="strategic_row project_row">
                                <td>{{ $costCenter['cost_center_en'] }}</td>
                                <td>{{ $costCenter['cost_center_en'] }}</td>
                                <td>{{ $costCenter['location_no'] }}</td>
                                <td>{{ $costCenter['comment'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
