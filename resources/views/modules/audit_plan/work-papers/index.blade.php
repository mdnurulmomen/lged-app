<x-title-wrapper>Audit Work-Papers</x-title-wrapper>

<div class="card sna-card-border mt-3" style="margin-bottom:15px;">
    <div class="row d-flex align-items-end">
        <div class="col-md-6">
            <label>Select Audit-Plan</label>
            <select class="form-control select-select2" name="audit_plan_id" id="audit_plan_id"
            onchange="Risk_Assessment_Item_Container.laodPlanWorkpapers(this.value)"
            >
                <option value="" disabled selected>Please Select Plan</option>
                @foreach ($auditPlans as $auditPlan)
                    <option value="{{ $auditPlan['id'] }}">
                        {{ ($auditPlan['yearly_plan_location']['project_name_en'] ?? $auditPlan['yearly_plan_location']['function_name_en'] ?? $auditPlan['yearly_plan_location']['cost_center_en']).' (Plan-'.$auditPlan['id'].')' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 text-right">
            <button
                class="btn btn-sm btn-info btn-square mr-1 create_button"
                title="Upload New Paper"
            >
                <i class="fad fa-plus"></i> New Work-Paper
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
                        <th>Title</th>
                        <th>Audit Plan</th>
                        <th>WorkPaper</th>
                    </tr>
                </thead>

                <tbody id="plan-work-papers">
                    <tr>
                        <td colspan="3" class="datatable-cell text-center"><span>Please select audit-plan</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>

    $('.create_button').click(function () {

        url = "{{ route('audit.plan.individual.plan-work-papers.create') }}";
        var data = {};

        ajaxCallAsyncCallbackAPI(url, data, 'GET', function (resp) {
            if (resp.status === 'error') {
                toastr.error('no');
                // console.log(resp.data)
            } else {
                quick_panel = $("#kt_quick_panel");
                $('.offcanvas-wrapper').html('');
                quick_panel.addClass('offcanvas-on');
                quick_panel.css('opacity', 1);
                quick_panel.css('width', '800px');
                $('.offcanvas-footer').hide();
                quick_panel.removeClass('d-none');
                $("html").addClass("side-panel-overlay");
                $('.offcanvas-title').html('Upload New Work-Paper');
                $('.offcanvas-wrapper').html(resp);
            }
        });
    });

    var Risk_Assessment_Item_Container = {
        laodPlanWorkpapers: function (audit_plan_id) {
            // loaderStart('loading...');

            let url = "{{route('audit.plan.individual.plan-work-papers.list')}}";
            let data = {audit_plan_id};

            ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
                // loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('#plan-work-papers').html(response);
                }
            });
        },

        /*
        export:function () {
            loaderStart('loading...');

            let sectorType = $("input[name='sector_type']:checked").val();

            let sectorName = sectorType == 'project' ? $('#project_id').find(':selected').text() : sectorType == 'function' ? $('#function_id').find(':selected').text() : $('#unit_master_id').find(':selected').text();

            let auditAreaName = $('#sector_area').find(':selected').text();

            let audit_area_id = $('#sector_area').find(':selected').val();

            let data = {sectorName, auditAreaName, audit_area_id};

            let url = "{{route('audit.plan.programs.export')}}";

            ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
                loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    // console.log(response);
                    const link = document.createElement('a');
                    link.setAttribute('href', response.data);
                    link.setAttribute('download', 'programs'); // Need to modify filename ...
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }
            });
        }
        */
    };
</script>
