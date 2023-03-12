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
                        title="বিস্তারিত দেখুন"
                        data-strategic-plan-year="{{ $plan['strategic_plan_year'] }}"
                >
                    <i class="fad fa-eye"></i> বিস্তারিত
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
</script>
