<table class="table table-bordered" width="100%">
    <thead class="thead-light">
    <tr class="bg-hover-warning">
        <th width="7%" class="text-center">
            No
        </th>

        <th width="33%" class="text-left">
            Plan Year
        </th>

        <th width="33%" class="text-left">
            Action
        </th>
    </tr>
    </thead>

    <tbody>

    @foreach($yearly_plan_list as $plan)
        <tr class="text-center">
            <td class="text-center">
                {{$loop->iteration}}
            </td>
            <td class="text-left">
                {{$plan['strategic_plan_year']}}
            </td>
            <td class="text-left">
                <button class="mr-1 btn btn-sm btn-primary btn-square show_year_detail"
                        title="See Details"
                        data-strategic-plan-year="{{ $plan['strategic_plan_year'] }}">
                    <i class="fad fa-eye"></i> Details
                </button>
                <button class="mr-1 btn btn-sm btn-warning btn-square edit_year_detail"
                        title="Edit"
                        data-strategic-plan-year="{{ $plan['strategic_plan_year'] }}"
                        data-yearly-plan-id="{{ $plan['id'] }}">
                    <i class="fad fa-pen"></i> Edit
                </button>
                <button class="mr-1 btn btn-sm btn-danger btn-square delete_year_detail"
                        title="Delete"
                        data-strategic-plan-year="{{ $plan['strategic_plan_year'] }}"
                        data-yearly-plan-id="{{ $plan['id'] }}"
                        onclick="Yearly_Plan_Container.deleteYearlyPLan($(this))"
                    <i class="fad fa-trash"></i> Delete
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    $('.show_year_detail').click(function () {
        loaderStart('Please wait...');
        strategic_plan_year =$(this).data('strategic-plan-year');

        url = "{{ route('audit.plan.yearly-plan.get-individual-yearly-plan') }}";
        var data = {strategic_plan_year};

        ajaxCallAsyncCallbackAPI(url, data, 'GET', function (resp) {
            loaderStop();
            if (resp.status === 'error') {
                toastr.error('no');
                // console.log(resp.data)
            } else {
                quick_panel = $("#kt_quick_panel");
                quick_panel.addClass('offcanvas-on');
                quick_panel.css('opacity', 1);
                quick_panel.css('width', '800px');
                $('.offcanvas-footer').hide();
                quick_panel.removeClass('d-none');
                $("html").addClass("side-panel-overlay");
                $('.offcanvas-title').html('Annual Plan Details');
                $('.offcanvas-wrapper').html(resp);
            }
        });
    });

    $('.edit_year_detail').click(function () {
        loaderStart('loading...');
        strategic_plan_year = $(this).data('strategic-plan-year');
        yearly_plan_id = $(this).data('yearly-plan-id');
        let url = "{{ route('audit.plan.yearly-plan.edit') }}";
        let data = {strategic_plan_year,yearly_plan_id};
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
            loaderStop();
            if (response.status === 'error') {
                toastr.error(response.data)
            } else {
                $("#kt_content").html(response);
            }
        });
    });
</script>
