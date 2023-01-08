 <div class="row">
     <div class="col-12">
         <label>Project :</label>
         <table id="project_table" class="table table-bordered">
             <thead class="thead-light">
                 <tr>
                     <th width="60%">Project</th>
                     <th width="40%">Action</th>
                 </tr>
             </thead>
             <tbody>

                 @foreach($individual_yearly_plan['project_list'] as $project)
                 <tr class="strategic_row project_row">
                     <td>
                         {{ $project['project_name_en'] }}
                     </td>
                     <td>
                         <button class="btn btn-sm btn-square btn-primary btn-hover-primary"
                             data-audit-plan-id="{{$project['audit_plan'] ? $project['audit_plan']['id'] : 0}}"
                             data-yearly_plan_location_id="{{ $project['id'] }}"
                             data-sector_name="{{ $project['project_name_en'] }}"
                             data-plan_year="{{ $project['strategic_plan_year'] }}"
                             onclick="Individual_Plan_Container.individualPlanCreate($(this))">
                             <!-- {{$project['audit_plan'] ? 'Plan-'.$project['audit_plan']['id'] : 'Add New Plan'}} -->
                             {{$project['audit_plan'] ? 'Plan' : 'Add New Plan'}}
                         </button>

                         @if($project['audit_plan'])

                         <button class="btn btn-sm btn-square btn-primary btn-hover-primary"
                             data-audit-plan-id="{{$project['audit_plan'] ? $project['audit_plan']['id'] : 0}}"
                             data-yearly_plan_location_id="{{ $project['id'] }}"
                             data-project-id="{{ $project['project_id'] }}"
                             data-project-name-en="{{ $project['project_name_en'] }}"
                             data-plan_year="{{ $project['strategic_plan_year'] }}"
                             onclick="Individual_Plan_Container.programCreate($(this))">
                             Program
                         </button>

                         <button class="btn btn-sm btn-square btn-primary btn-hover-primary team-button"
                             data-yearly_plan_location_id="{{ $project['id'] }}" data-id="{{ $project['project_id'] }}"
                             data-type="project">
                             <i class="fas fa-users"></i> Team
                         </button>

                         <button class="btn btn-sm btn-square btn-primary btn-hover-primary"
                             data-audit-plan-id="{{$project['audit_plan'] ? $project['audit_plan']['id'] : 0}}"
                             data-yearly_plan_location_id="{{ $project['id'] }}"
                             data-project-id="{{ $project['project_id'] }}"
                             data-project-name-en="{{ $project['project_name_en'] }}"
                             data-plan_year="{{ $project['strategic_plan_year'] }}"
                             onclick="Individual_Plan_Container.letterCreate($(this))">
                             + Create Letter
                         </button>

                         <button class="btn btn-sm btn-square btn-warning btn-hover-warning announcement-button"
                             data-audit-plan-id="{{$project['audit_plan'] ? $project['audit_plan']['id'] : 0}}"
                             data-yearly_plan_location_id="{{ $project['id'] }}" data-id="{{ $project['project_id'] }}"
                             data-type="project">
                             <i class="fas fa-sticky-note"></i> Engagement Letter
                         </button>

                         @endif

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
         <table id="function_table" class="table table-bordered">
             <thead class="thead-light">
                 <tr>
                     <th width="60%">Function</th>
                     <th width="40%">Action</th>
                 </tr>
             </thead>
             <tbody>

                 @foreach($individual_yearly_plan['function_list'] as $function)
                 <tr class="strategic_row function_row">
                     <td>
                         {{ $function['function_name_en'] }}
                     </td>
                     <td>
                         <button class="btn btn-sm btn-square btn-primary btn-hover-primary plan-button"
                             data-yearly_plan_location_id="{{ $function['id'] }}"
                             data-sector_name="{{ $function['function_name_en'] }}"
                             data-plan_year="{{ $function['strategic_plan_year'] }}">
                             <i class="fas fa-tasks"></i> Plan
                         </button>

                         <button class="btn btn-sm btn-square btn-primary btn-hover-primary team-button"
                             data-yearly_plan_location_id="{{ $function['id'] }}"
                             data-id="{{ $function['function_id'] }}" data-type="function">
                             <i class="fas fa-users"></i> Team
                         </button>

                         <button
                             class="btn btn-sm btn-square btn-warning btn-hover-warning team-button announcement-button"
                             data-yearly_plan_location_id="{{ $function['id'] }}"
                             data-id="{{ $function['function_id'] }}" data-type="function">
                             <i class="fas fa-sticky-note"></i> Engagement Letter
                         </button>
                     </td>
                 </tr>
                 @endforeach
             </tbody>
         </table>
     </div>
 </div>
 <div class="row" style="display: none">
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
                         <button class="btn btn-sm btn-square btn-primary btn-hover-primary plan-button"
                             data-yearly_plan_location_id="{{ $costCenter['id'] }}"
                             data-sector_name="{{ $costCenter['cost_center_en'] }}"
                             data-plan_year="{{ $costCenter['strategic_plan_year'] }}">
                             <i class="fas fa-tasks"></i> Plan
                         </button>

                         <button class="btn btn-sm btn-square btn-primary btn-hover-primary team-button"
                             data-yearly_plan_location_id="{{ $costCenter['id'] }}"
                             data-id="{{ $costCenter['cost_center_id'] }}" data-type="cost-center">
                             <i class="fas fa-users"></i> Team
                         </button>

                         <button class="btn btn-sm btn-square btn-warning btn-hover-warning announcement-button"
                             data-yearly_plan_location_id="{{ $costCenter['id'] }}"
                             data-id="{{ $costCenter['cost_center_id'] }}" data-type="cost-center">
                             <i class="fas fa-sticky-note"></i> Engagement Letter
                         </button>
                     </td>
                 </tr>
                 @endforeach
             </tbody>
         </table>
     </div>
 </div>

 <div class="load-office-wise-employee"></div>
 <div class="load-announcement-memo"></div>
 <div class="load-individual-plan"></div>

<script src="{{ asset('assets/js/html-docx.js') }}"></script>
<script src="{{ asset('assets/js/FileSaver.js') }}"></script>

 <script>
     var Individual_Plan_Container = {
         individualPlanCreate: function (elem) {
             let audit_plan_id = elem.data('audit-plan-id');
             let yearly_plan_location_id = elem.data('yearly_plan_location_id');
             let sector_name = elem.data('sector_name');
             let plan_year = elem.data('plan_year');

             url = "{{route('audit.plan.individual.get-individual-plan')}}";

             data = {
                 yearly_plan_location_id,
                 audit_plan_id,
                 sector_name,
                 plan_year,
             };

             KTApp.block('#kt_wrapper', {
                 opacity: 0.1,
                 state: 'primary' // a bootstrap color
             });

             ajaxCallAsyncCallbackAPI(url, data, 'get', function (response) {
                 KTApp.unblock('#kt_wrapper');
                 if (response.status === 'error') {
                     toastr.error(response.data);
                 } else {
                     $(".offcanvas-title").text('Add plan');
                     quick_panel = $("#kt_quick_panel");
                     quick_panel.addClass('offcanvas-on');
                     quick_panel.css('opacity', 1);
                     quick_panel.css('width', '85%');
                     quick_panel.removeClass('d-none');
                     $("html").addClass("side-panel-overlay");
                     $(".offcanvas-wrapper").html(response);
                 }
             });
         },

         letterCreate: function (elem) {
             let audit_plan_id = elem.data('audit-plan-id');
             let yearly_plan_location_id = elem.data('yearly_plan_location_id');

             url = "{{route('audit.plan.individual.engagement-letter-create')}}";

             data = {
                 yearly_plan_location_id,
                 audit_plan_id
             };

             KTApp.block('#kt_wrapper', {
                 opacity: 0.1,
                 state: 'primary' // a bootstrap color
             });

             ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                 KTApp.unblock('#kt_wrapper');
                 if (response.status === 'error') {
                     toastr.error(response.data);
                 } else {
                     $(".offcanvas-title").text('Create Engagement Letter');
                     quick_panel = $("#kt_quick_panel");
                     quick_panel.addClass('offcanvas-on');
                     quick_panel.css('opacity', 1);
                     quick_panel.css('width', '60%');
                     quick_panel.removeClass('d-none');
                     $("html").addClass("side-panel-overlay");
                     $(".offcanvas-wrapper").html(response);
                 }
             });
         },

        downloadAnnouncementModal: function (elem) {

             let audit_plan_id = elem.data('audit-plan-id');
             let yearly_plan_location_id = elem.data('yearly_plan_location_id');
             let sector_name = elem.data('sector_name');

             url = "{{route('audit.plan.individual.download-announcement-memo')}}";

             data = {
                 audit_plan_id,
                 yearly_plan_location_id,
                 sector_name,
             };

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                message: 'Downloading Please Wait...',
                state: 'primary' // a bootstrap color
            });

            $.ajax({
                type: 'post',
                url: url,
                data: data,
                xhrFields: {
                    responseType: 'blob'
                },
                success: function (response) {
                    KTApp.unblock('#kt_wrapper');
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "engagement_letter.pdf";
                    link.click();
                },
                error: function (blob) {
                    KTApp.unblock('#kt_wrapper');
                    toastr.error('Failed to generate PDF.')
                    console.log(blob);
                }
            });
        },

        generateEngagementLetterMSWord: function (elem) {

            let audit_plan_id = elem.data('audit-plan-id');
            let yearly_plan_location_id = elem.data('yearly_plan_location_id');
            let sector_name = elem.data('sector_name');

            url = "{{route('audit.plan.individual.download-ms-word-engagement-letter')}}";

            data = {
                audit_plan_id,
                yearly_plan_location_id,
                sector_name,
            };

            KTApp.block('#kt_wrapper', {
            opacity: 0.1,
            message: 'Downloading Please Wait...',
            state: 'primary' // a bootstrap color
            });

            $.ajax({
            type: 'post',
            url: url,
            data: data,
                success: function (response) {
                    KTApp.unblock('#kt_wrapper');
                    var converted = htmlDocx.asBlob(response);
                    saveAs(converted, 'engagement_letter.docx')
                },
                error: function (blob) {
                    toastr.error('Failed to generate Word.')
                    console.log(blob);
                }
            });
            },

         programCreate: function (elem) {
             let project_id = elem.data('project-id');
             let project_name_en = elem.data('project-name-en');
             let audit_plan_id = elem.data('audit-plan-id');
             let yearly_plan_location_id = elem.data('yearly_plan_location_id');
             let sector_name = elem.data('sector_name');
             let plan_year = elem.data('plan_year');
             let type = '';

             url = "{{route('audit.plan.programs.index')}}";

             data = {
                 yearly_plan_location_id,
                 sector_name,
                 plan_year,
                 audit_plan_id,
                 project_id,
                 project_name_en,
                 type
             };

             KTApp.block('#kt_wrapper', {
                 opacity: 0.1,
                 state: 'primary' // a bootstrap color
             });

             ajaxCallAsyncCallbackAPI(url, data, 'get', function (response) {
                 KTApp.unblock('#kt_wrapper');
                 if (response.status === 'error') {
                     toastr.error(response.data);
                 } else {
                     $("#kt_content").html(response);
                 }
             });
         },
     };

     $(document).ready(function () {
         $(".team-button").on('click', function (event) {
             loaderStart('Please wait...');

             let yearly_plan_location_id = $(this).data('yearly_plan_location_id');
             let sector_type = $(this).data('type');
             let sector_id = $(this).data('id');

             url = "{{route('audit.plan.individual.get-team-modal')}}";

             data = {
                 yearly_plan_location_id,
                 sector_type,
                 sector_id
             };

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

         $(".announcement-button").on('click', function (event) {
             loaderStart('Please wait...');

             let audit_plan_id = $(this).data('audit-plan-id');
             let yearly_plan_location_id = $(this).data('yearly_plan_location_id');
             let sector_type = $(this).data('type');
             let sector_id = $(this).data('id');

             url = "{{route('audit.plan.individual.get-announcement-memo')}}";

             data = {
                 audit_plan_id,
                 yearly_plan_location_id,
                 sector_type,
                 sector_id
             };

             KTApp.block('#kt_full_width_page', {
                 opacity: 0.1,
                 state: 'primary' // a bootstrap color
             });

             ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                 KTApp.unblock('#kt_wrapper');
                 if (response.status === 'error') {
                     toastr.error('No data found');
                 } else {
                     $(".offcanvas-title").text('Engagement Letter');
                     quick_panel = $("#kt_quick_panel");
                     quick_panel.addClass('offcanvas-on');
                     quick_panel.css('opacity', 1);
                     quick_panel.css('width', '60%');
                     quick_panel.removeClass('d-none');
                     $("html").addClass("side-panel-overlay");
                     $(".offcanvas-wrapper").html(response);
                 }
             });
         });
     });

 </script>
