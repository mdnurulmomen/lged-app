<x-title-wrapper>Annual Plan List</x-title-wrapper>

<div class="card sna-card-border mt-3" style="margin-bottom:15px;">
    <div class="col-md-12 text-right">
        <button class="btn btn-sm btn-info btn-square mr-1" title="বিস্তারিত দেখুন"
                onclick='loadPage($(this))'
                data-url="{{route('audit.plan.yearly-plan.create')}}"
        >
            <i class="fad fa-plus"></i> Create
        </button>
    </div>
</div>

<div class="card sna-card-border mt-3" style="margin-bottom:30px;">
    <div class="table-responsive">
        <div class="load-yearly-plan"></div>
    </div>
</div>


<script>
    $(function () {
        Yearly_Plan_Container.loadYearlyPlanList();
    });
    var Yearly_Plan_Container = {
        loadYearlyPlanList: function () {
            let url = '{{route('audit.plan.yearly-plan.get-yearly-plan-list')}}';
            let data = {};
            ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('.load-yearly-plan').html(response);
                }
            });
        },

        updateYearlyPlan: function () {
            loaderStart('Please wait...')
            strategic_plan_year =  $('#strategic_plan_year').find(':selected').val();
            strategic_plan_id =  $('#strategic_plan_year').find(':selected').attr('data-strategic-plan');
            yearly_plan_id = $('.yearly_plan_id').val();
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
                $(this).find('.project_location_id').each(function () {
                    project_location_id = $(this).val() ? $(this).val() : null;
                    item['location_id'] = project_location_id
                });
                $(this).find('.function_location_id').each(function () {
                    function_location_id = $(this).val() ? $(this).val() : null;
                    item['location_id'] = function_location_id
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

            let url = '{{route('audit.plan.yearly-plan.update')}}';
            let data = {strategic_plan_id,strategic_info,strategic_plan_year,yearly_plan_id};
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
        removeLocationRow: function (elem) {
            swal.fire({
                title: 'আপনি কি মুছে ফেলতে চান?',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'হ্যাঁ',
                cancelButtonText: 'না'
            }).then(function(result) {
                if (result.value) {
                    url = '{{route('audit.plan.yearly-plan.delete-yearly-plan-locations')}}';
                    yearly_plan_locations_id = elem.data('yearly-plan-locations-id');
                    data = {yearly_plan_locations_id};
                    ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                        if (response.status === 'error') {
                            toastr.error(response.data)
                        } else {
                            $("#location"+yearly_plan_locations_id).hide();
                            toastr.success(response.data);
                        }
                    })
                }
            });
        },
        deleteYearlyPLan: function (elem) {
            swal.fire({
                title: 'আপনি কি মুছে ফেলতে চান?',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'হ্যাঁ',
                cancelButtonText: 'না'
            }).then(function(result) {
                if (result.value) {
                    loaderStart('loading...');
                    url = '{{route('audit.plan.yearly-plan.delete-yearly-plan')}}';
                    strategic_plan_year = elem.data('strategic-plan-year');
                    yearly_plan_id = elem.data('yearly-plan-id');
                    data = {strategic_plan_year,yearly_plan_id};
                    ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                        loaderStop();
                        if (response.status === 'error') {
                            toastr.error(response.data)
                        } else {
                            toastr.success(response.data);
                            Yearly_Plan_Container.loadYearlyPlanList();
                        }
                    })
                }
            });
        },

        generatePDF: function () {
            strategic_plan_year = $('#download').data('strategic-plan-year');
            scope = 'download';
            data = {strategic_plan_year,scope};

            url = "{{ route('audit.plan.yearly-plan.get-individual-yearly-plan') }}";

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                message: 'Downloading Please Wait..',
                state: 'primary' // a bootstrap color
            });

            $.ajax({
                type: 'GET',
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
                    link.download = "annual_plan.pdf";
                    link.click();
                },
                error: function (blob) {
                    toastr.error('Failed to generate PDF.')
                    console.log(blob);
                }
            });
        },
    };
</script>

