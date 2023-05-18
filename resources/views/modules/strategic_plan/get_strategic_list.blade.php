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

    @foreach($strategic_plan_list as $plan)
        <tr class="text-center">
            <td class="text-center">
                {{$loop->iteration}}
            </td>
            <td class="text-left">
                {{$plan['strategic_plan_year']}}
            </td>
            <td class="text-left">
                <button class="mr-1 btn btn-sm btn-primary btn-square show_strategic_plan_details"
                        title="See Details" 
                        data-strategic-plan-id="{{$plan['x_sp_duration_id']}}" 
                        data-strategic-plan-year="{{$plan['strategic_plan_year']}}" 
                        onclick=""
                >
                    <i class="fad fa-eye"></i> Details
                </button>
                <button class="mr-1 btn btn-sm btn-warning btn-square edit_strategic_plan"
                        title="Edit" 
                        data-strategic-plan-id="{{$plan['x_sp_duration_id']}}" 
                        data-strategic-plan-year="{{$plan['strategic_plan_year']}}" 
                        onclick=""
                >
                    <i class="fad fa-pen"></i> Edit
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>


{{--<table class="table table-bordered" width="100%">--}}
{{--    <thead class="thead-light">--}}
{{--    <tr class="bg-hover-warning">--}}
{{--        <th width="7%" class="text-center">--}}
{{--            ক্রম--}}
{{--        </th>--}}

{{--        <th width="33%" class="text-left">--}}
{{--            টপিক--}}
{{--        </th>--}}

{{--        <th width="33%" class="text-left">--}}
{{--            কার্যক্রম--}}
{{--        </th>--}}
{{--    </tr>--}}
{{--    </thead>--}}

{{--    <tbody>--}}
{{--    @forelse($psr_approval_list as $topic)--}}
{{--        <tr class="text-center">--}}
{{--            <td class="text-center">--}}
{{--                {{$loop->iteration}}--}}
{{--            </td>--}}
{{--            <td class="text-left">--}}
{{--                {{$topic['subject_matter']}}--}}
{{--            </td>--}}
{{--            <td class="text-left">--}}
{{--                <button class="mr-1 btn btn-sm btn-primary btn-square" title="বিস্তারিত দেখুন"--}}
{{--                        data-annual-plan-id="{{$topic['id']}}"--}}
{{--                        onclick="Approve_Psr_Topic_List_Container.showPlanInfo($(this))"--}}
{{--                >--}}
{{--                    <i class="fad fa-eye"></i> বিস্তারিত--}}
{{--                </button>--}}

{{--                @if($topic['status'] == 'pending')--}}
{{--                    <button class="mr-1 btn btn-sm btn-edit" title="অনুমোদন করুন"--}}
{{--                            data-annual-plan-id="{{$topic['id']}}"--}}
{{--                            data-psr-approval-type="topic"--}}
{{--                            onclick="Approve_Psr_Common_Container.loadPsrApprovalForm($(this))">--}}
{{--                        অনুমোদন করুন--}}
{{--                    </button>--}}
{{--                @else--}}
{{--                    <span class="label label-outline-success label-pill label-inline">--}}
{{--                        অনুমোদিত--}}
{{--                    </span>--}}
{{--                @endif--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--    @empty--}}
{{--        <tr data-row="0" class="datatable-row" style="left: 0px;">--}}
{{--            <td colspan="4" class="datatable-cell text-center"><span>Nothing Found</span></td>--}}
{{--        </tr>--}}
{{--    @endforelse--}}
{{--    </tbody>--}}
{{--</table>--}}

<script>
    $('.show_strategic_plan_details').click(function () {
        quick_panel = $("#kt_quick_panel");
        $('.offcanvas-wrapper').html('');
        quick_panel.addClass('offcanvas-on');
        quick_panel.css('opacity', 1);
        quick_panel.css('width', '1000px');
        $('.offcanvas-footer').hide();
        quick_panel.removeClass('d-none');
        $("html").addClass("side-panel-overlay");
        $('.offcanvas-title').html('Show Year Wise Plans');

        let strategic_plan_id = $(this).data('strategic-plan-id');
        let strategic_plan_year = $(this).data('strategic-plan-year');
        let data = {strategic_plan_id, strategic_plan_year};
        
        let url = "{{ route('audit.plan.strategy.show-year-wise-strategic-plan') }}";
        
        ajaxCallAsyncCallbackAPI(url, data, 'GET', function (resp) {
            if (resp.status === 'error') {
                toastr.error('no');
                console.log(resp.data)
            } else {
                // $('#id').val(id);
                // $('#x_risk_factor_id').val(x_risk_factor_id);
                // $('#title_bn').text(title_bn);
                // $('#title_en').text(title_en);
                $('.offcanvas-wrapper').html(resp);
            }
        });
    });

    $('.edit_strategic_plan').click(function () {
        loaderStart('loading...');
        let strategic_plan_id = $(this).data('strategic-plan-id');
        let strategic_plan_year = $(this).data('strategic-plan-year');
        let data = {strategic_plan_id, strategic_plan_year};
        let url = "{{ route('audit.plan.strategy.edit-year-wise-strategic-plan') }}";
        ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
            loaderStop();
            if (response.status === 'error') {
                toastr.error(response.data)
            } else {
                $("#kt_content").html(response);
            }
        });
    });
</script>

