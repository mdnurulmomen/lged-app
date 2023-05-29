<div class="card sna-card-border mt-3">
    <div class="annual_entity_selection_area mt-4">
        <ul class="nav nav-tabs custom-tabs mb-0" id="myTab" role="tablist" style="display: inline-flex">

            @for($i=$start; $i<=$end; $i++)
                <li class="nav-item">
                    <a onclick="loadList('{{ $i }}')" id="strategic_year" class="nav-link @if($i == $start) active @endif"
                       data-toggle="tab" aria-controls="tree" data-year = "{{ $i }}" href="#strategic_year_{{$i}}" >
                        <span class="nav-text">{{$i}}</span>
                    </a>
                </li>
            @endfor
        </ul>
        <button class="btn btn-sm btn-square btn-primary mr-2 text-right" style="float: right;" onclick="storeStrategicPlan($(this))">
            <i class="fa fa-save"></i> Save
        </button>
    </div>
    <div id="rp_office_tab" class="tab-content">
        <div id="content_responce">

        </div>
    </div>
</div>

<script>
    $(function(){
        $('#myTab li:first-child a').click();
    });

     // Method to get data for the active tab
     function loadList(year) {
        loaderStart('Please wait...');
        $('#content_responce').html('');
      // Make an AJAX request to your Laravel controller endpoint
      let url = '{{route('audit.plan.strategy.get-year-wise-strategic-plan-content')}}';
      strategic_plan_year_id = "{{ $strategic_plan_year_id }}";
        let data = {year,strategic_plan_year_id};
        ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
            loaderStop();
            if (response.status === 'error') {
                toastr.error(response.data)
            } else {
                $('#content_responce').html(response);
            }
        });
    };

    $('.project-select').change(function (){
        row_no =  $(this).attr('data-id');
        project_id =  $(this).val();
        strategic_year =  $(this).attr('data-strategic-year');
        Plan_Common_Container.loadCostCenterProjectMap(project_id,row_no,strategic_year);
    });
    $('.select-select2').select2({width: '100%'});

    function storeStrategicPlan() {
        loaderStart('Please Wait...');
            strategic_plan_year =  $('#strategic_plan_year').find(':selected').text();
            strategic_plan_id = "{{ $strategic_plan_year_id }}";
            strategic_plan_year = document.getElementById('strategic_plan_year_data').value;
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

                $(this).find('.id_'+strategic_plan_year).each(function () {
                    id = $(this).val() ? $(this).val() : 0;
                    item['id'] = id
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

        let url = '{{route('audit.plan.strategy.update')}}';
        let data = {strategic_info,strategic_plan_year,strategic_plan_id};
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
            loaderStop();
            if (response.status === 'error') {
                toastr.error(response.data)
            } else {
                toastr.success(response.data)
                Strategic_Plan_Create_Container.backToList();
            }
        });
    };
    function removeLocationRow(elem){
        location_id = elem.data('location-id');
        strategic_plan_year = elem.data('strategic-plan-year');
        let url = '{{route('audit.plan.strategy.delete-location-data')}}';
        let data = {location_id};
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
            loaderStop();
            if (response.status === 'error') {
                toastr.error(response.data)
            } else {
                $("#location"+location_id).remove();
                toastr.success(response.data);
                loadList(strategic_plan_year);
            }
        });
    };
</script>
