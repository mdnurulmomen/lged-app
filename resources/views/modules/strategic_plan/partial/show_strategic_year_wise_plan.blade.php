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

        <div id="rp_office_tab" class="tab-content">
            <div id="content_responce">

            </div>
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
        let url = '{{route('audit.plan.strategy.get-year-wise-strategic-plan-content')}}';
        strategic_plan_year_id = "{{ $strategic_plan_id }}";
        scope = 'show'
        let data = {year,strategic_plan_year_id,scope};
        ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
            loaderStop();
            if (response.status === 'error') {
                toastr.error(response.data)
            } else {
                $('#content_responce').html(response);
            }
        });
    };

</script>
