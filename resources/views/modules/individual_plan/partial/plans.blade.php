<div class="card sna-card-border mt-2 strategic_year">
    <div class="row">
        <div class="col-12">
            <label>Project :</label>
            <table id="project_table" class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th width="20%">Project</th>
                    <th width="15%">Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($individual_yearly_plan['project_list'] as $project)
                <tr class="strategic_row project_row">
                    <td>
                        {{ $project['project_name_en'] }}
                    </td>
                    <td>
                        <button 
                            class="btn btn-sm btn-square btn-info btn-hover-primary plan-button" 
                            data-yearly_plan_location_id="{{ $project['id'] }}" 
                            data-sector_name="{{ $project['project_name_en'] }}"
                            data-plan_year="{{ $project['strategic_plan_year'] }}" 
                        >
                            <i class="fas fa-tasks"></i> Plan
                        </button>
                        
                        <button 
                            class="btn btn-sm btn-square btn-primary btn-hover-primary team-button" 
                            data-yearly_plan_location_id="{{ $project['id'] }}" 
                            data-id="{{ $project['project_id'] }}"
                            data-type="project" 
                        >
                            <i class="fas fa-users"></i> Team
                        </button>

                        <button 
                            class="btn btn-sm btn-square btn-warning btn-hover-warning announcement-button" 
                            data-yearly_plan_location_id="{{ $project['id'] }}" 
                            data-id="{{ $project['project_id'] }}"
                            data-type="project" 
                        >
                            <i class="fas fa-sticky-note"></i> Announcement Memo
                        </button>
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
            <table id="function_table" class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th width="20%">Function</th>
                    <th width="15%">Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($individual_yearly_plan['function_list'] as $function)
                    <tr class="strategic_row function_row">
                        <td>
                            {{ $function['function_name_en'] }}
                        </td>
                        <td>
                            <button 
                                class="btn btn-sm btn-square btn-primary btn-hover-primary plan-button" 
                                data-yearly_plan_location_id="{{ $function['id'] }}" 
                                data-sector_name="{{ $function['function_name_en'] }}"
                                data-plan_year="{{ $function['strategic_plan_year'] }}" 
                            >
                                <i class="fas fa-tasks"></i> Plan
                            </button>
                            
                            <button 
                                class="btn btn-sm btn-square btn-primary btn-hover-primary team-button" 
                                data-yearly_plan_location_id="{{ $function['id'] }}" 
                                data-id="{{ $function['function_id'] }}"
                                data-type="function" 
                            >
                                <i class="fas fa-users"></i> Team
                            </button>

                            <button 
                                class="btn btn-sm btn-square btn-warning btn-hover-warning team-button announcement-button" 
                                data-yearly_plan_location_id="{{ $function['id'] }}" 
                                data-id="{{ $function['function_id'] }}"
                                data-type="function" 
                            >
                                <i class="fas fa-sticky-note"></i> Announcement Memo
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <label>Cost Center :</label>
            <table id="project_table" class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th width="20%">Cost Center</th>
                    <th width="15%">Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($individual_yearly_plan['cost_centers'] as $costCenter)
                <tr class="strategic_row project_row">
                    <td>
                        {{ $costCenter['cost_center_en'] }}
                    </td>
                    <td>
                        <button 
                            class="btn btn-sm btn-square btn-primary btn-hover-primary plan-button"
                            data-yearly_plan_location_id="{{ $costCenter['id'] }}" 
                            data-sector_name="{{ $costCenter['cost_center_en'] }}"
                            data-plan_year="{{ $costCenter['strategic_plan_year'] }}"
                        >
                            <i class="fas fa-tasks"></i> Plan
                        </button>
                        
                        <button 
                            class="btn btn-sm btn-square btn-primary btn-hover-primary team-button"
                            data-yearly_plan_location_id="{{ $costCenter['id'] }}" 
                            data-id="{{ $costCenter['cost_center_id'] }}"
                            data-type="cost-center" 
                        >
                            <i class="fas fa-users"></i> Team
                        </button>

                        <button 
                            class="btn btn-sm btn-square btn-warning btn-hover-warning announcement-button" 
                            data-yearly_plan_location_id="{{ $costCenter['id'] }}" 
                            data-id="{{ $costCenter['cost_center_id'] }}"
                            data-type="cost-center" 
                        >
                            <i class="fas fa-sticky-note"></i> Announcement Memo
                        </button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    
<div class="load-office-wise-employee"></div>
<div class="load-announcement-memo"></div>
<div class="load-individual-plan"></div>

<script>
    $(document).ready(function(){
        $(".plan-button").on('click', function(event){
            loaderStart('Please wait...');

            let yearly_plan_location_id = $(this).data('yearly_plan_location_id'); 
            let sector_name = $(this).data('sector_name');
            let plan_year = $(this).data('plan_year');
            
            url = "{{route('audit.plan.individual.get-individual-plan')}}";
            
            data = {yearly_plan_location_id, sector_name, plan_year};
        
            KTApp.block('#kt_full_width_page', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });
        
            ajaxCallAsyncCallbackAPI(url, data, 'get', function (response) {
                loaderStop();
                KTApp.unblock('#kt_full_width_page');
        
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".load-individual-plan").html('');
                    $(".load-individual-plan").html(response);
                    $('#individualPlanModal').modal('show');
                }
            })
        });
        
        $(".team-button").on('click', function(event){
            loaderStart('Please wait...');

            let yearly_plan_location_id = $(this).data('yearly_plan_location_id'); 
            let sector_type = $(this).data('type');
            let sector_id = $(this).data('id');
            
            url = "{{route('audit.plan.individual.get-team-modal')}}";
            
            data = {yearly_plan_location_id, sector_type, sector_id};
        
            KTApp.block('#kt_full_width_page', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });
        
            ajaxCallAsyncCallbackAPI(url, data, 'get', function (response) {
                loaderStop();
                KTApp.unblock('#kt_full_width_page');
        
                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".load-office-wise-employee").html('');
                    $(".load-office-wise-employee").html(response);
                    $('#officeEmployeeModal').modal('show');
                }
            })
        });

        $(".announcement-button").on('click', function(event){
            loaderStart('Please wait...');

            let yearly_plan_location_id = $(this).data('yearly_plan_location_id'); 
            let sector_type = $(this).data('type');
            let sector_id = $(this).data('id');
            
            url = "{{route('audit.plan.individual.get-announcement-memo')}}";
            
            data = {yearly_plan_location_id, sector_type, sector_id};

            KTApp.block('#kt_full_width_page', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'get', function (response) {
                loaderStop();
                KTApp.unblock('#kt_full_width_page');

                if (response.status === 'error') {
                    toastr.error('No data found');
                } else {
                    $(".load-announcement-memo").html('');
                    $(".load-announcement-memo").html(response);
                    $('#announcementMemoModal').modal('show');
                }
            })
        });
    });
</script>
