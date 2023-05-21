<div class="row m-0 mb-2 page-title-wrapper d-md-flex align-items-md-center">
    <div class="col-md-6">
        <div class="title py-2">
            <h4 class="mb-0 font-weight-bold"><i class="fas fa-list mr-3"></i>Create Annual Plan</h4>
        </div>
    </div>

    <div class="col-md-6 text-right">
        <a onclick="Yearly_Plan_Create_Container.backToList()" class="btn btn-sm btn-warning btn_back btn-square mr-3">
            <i class="fad fa-arrow-alt-left"></i> Go Back
        </a>
        <button class="btn btn-sm btn-square btn-primary mr-2" onclick="Yearly_Plan_Create_Container.storeYearlyPlan($(this))">
            <i class="fa fa-save"></i> Save
        </button>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card sna-card-border">
            <div class="row">
                <div class="col-4">
                    <select class="form-control select-select2" name="strategic_plan_year" id="strategic_plan_year">
                        <option selected value="">Select plan</option>
                        @foreach($individual_strategic_plan_year as $year)
                            <option data-strategic-plan="{{$year['strategic_plan_id']}}" value="{{$year['strategic_plan_year']}}">{{$year['strategic_plan_year']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-14">
    <div class="col-12">
        <div class="load-year-wise-plan"></div>
    </div>
</div>
@include('modules.strategic_plan.partial.strategic_plan_common_script')
<script>

    $('#strategic_plan_year').change(function () {
        Yearly_Plan_Create_Container.loadYearWiseStrategicPlan();
    });

    var Yearly_Plan_Create_Container = {
        loadYearWiseStrategicPlan: function (elem) {
            loaderStart('loading...');
            strategic_plan_year = $('#strategic_plan_year').find(':selected').text();
            strategic_plan_id = $('#strategic_plan_year').find(':selected').data('strategic-plan');
            let url = '{{route('audit.plan.yearly-plan.get-individual-strategic-plan')}}';
            let data = {strategic_plan_year,strategic_plan_id};
            ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
               loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('.load-year-wise-plan').html(response);
                }
            });
        },

        storeYearlyPlan: function () {
            loaderStart('Please wait...')
            strategic_plan_year =  $('#strategic_plan_year').find(':selected').val();
            strategic_plan_id =  $('#strategic_plan_year').find(':selected').attr('data-strategic-plan');

            strategic_info = {};

            $('.strategic_year_'+strategic_plan_year+' .strategic_row').each(function (j, w) {
                item = {};

                item['project_id'] = null;
                item['project_name_bn'] = null;
                item['project_name_en'] = null;

                $(this).find('.project_id_'+strategic_plan_year).each(function () {
                    item['project_id'] = $(this).val();
                    item['project_name_bn'] = $(this).find(':selected').text();
                    item['project_name_en'] = $(this).find(':selected').attr('data-project-name-en');
                });

                item['function_id'] =  null;
                item['function_name_bn'] = null;
                item['function_name_en'] = null;

                $(this).find('.function_id_'+strategic_plan_year).each(function () {
                    item['function_id'] =  $(this).val();
                    item['function_name_bn'] = $(this).find(':selected').text();
                    item['function_name_en'] = $(this).find(':selected').attr('data-function-name-en');
                });

                $(this).find('.location_id_'+strategic_plan_year).each(function () {
                    item['cost_center_id'] = $(this).val() ? $(this).val() : null;
                    item['cost_center_bn'] = $(this).find(':selected').attr('data-office-name-bn') ? $(this).find(':selected').attr('data-office-name-bn') : null;
                    item['cost_center_en'] = $(this).find(':selected').attr('data-office-name-en') ? $(this).find(':selected').attr('data-office-name-en') : null;
                    item['parent_office_id'] = $(this).find(':selected').attr('data-parent-office-id') ? $(this).find(':selected').attr('data-parent-office-id') : null;
                    item['parent_office_en'] = $(this).find(':selected').attr('data-parent-office-name-en') ? $(this).find(':selected').attr('data-parent-office-name-en') : null;
                    item['parent_office_bn'] = $(this).find(':selected').attr('data-parent-office-name-bn') ? $(this).find(':selected').attr('data-parent-office-name-bn') : null;
                });

                $(this).find('.location_no_'+strategic_plan_year).each(function () {
                    location_no = $(this).val() ? $(this).val() : 0;
                    item['location_no'] = location_no
                });

                $(this).find('.comment_'+strategic_plan_year).each(function () {
                    comment = $(this).val() ? $(this).val() : null;
                    item['comment'] = comment
                });

                item['strategic_plan_year'] = strategic_plan_year;
                item['strategic_plan_id'] = strategic_plan_id;
                item['created_by'] = 1;
                item['updated_by'] = 1;

                strategic_info[j] = item;
            });

            let url = '{{route('audit.plan.yearly-plan.store')}}';
            let data = {strategic_plan_id,strategic_info,strategic_plan_year};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                loaderStop();
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    toastr.success(response.data);
                    Yearly_Plan_Create_Container.backToList();
                }
            });
        },
        backToList: function () {
            $('.yearly_plan_link a').click();
        }
    };
</script>
