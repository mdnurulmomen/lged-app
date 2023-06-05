@forelse($working_plan_list as $workPaper)
    <tr id="row_{{$workPaper['id']}}" data-row="{{$loop->iteration}}">
        <td style="width: 38%;">
            {{ $workPaper['title_bn'] }}
        </td>

        <td style="width:38%;">
            {{ $workPaper['title_en'] }}
        </td>

        <td style="width: 14%;">
            <a target="_blank" href="{{ config('amms_bee_routes.file_url').$workPaper['attachment'] }}" class="btn btn-download btn-sm btn-bold btn-square ml-auto">
                <i class="fa fa-file" aria-hidden="true"></i>
                Download
            </a>
        </td>

        <td style="width: 10%;">
            <a href="javascript:;"
                data-audit-plan-id="{{$workPaper['audit_plan_id']}}"
                data-work-paper-id="{{$workPaper['id']}}"
                data-work-paper-title-bn="{{$workPaper['title_bn']}}"
                data-work-paper-title-en="{{$workPaper['title_en']}}"
                class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_edit_plan_work_paper">
                <i class="fas fa-edit"></i>
            </a>

            <a href="javascript:;"
                data-audit-plan-id="{{$workPaper['audit_plan_id']}}"
                data-work-paper-id="{{$workPaper['id']}}"
                class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-danger btn_delete_plan_work_paper">
                <i class="fas fa-trash"></i>
            </a>
        </td>
    </tr>
@empty
    <tr data-row="0" class="datatable-row" style="left: 0px;">
        <td colspan="4" class="datatable-cell text-danger text-center"><span>No Workpaper Found</span></td>
    </tr>
@endforelse

<script>
    $('.btn_edit_plan_work_paper').click(function () {
    
    audit_plan_id = $(this).data("audit-plan-id");
    work_paper_id = $(this).data("work-paper-id");
    title_bn = $(this).data("work-paper-title-bn");
    title_en = $(this).data("work-paper-title-en");
    url = "{{ route('audit.plan.individual.plan-work-papers.edit') }}";
    var data = {audit_plan_id, work_paper_id, title_bn, title_en};

        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (resp) {
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
                $('.offcanvas-title').html('Update Work Paper');
                $('.offcanvas-wrapper').html(resp);
            }
        });
    });

    $('.btn_delete_plan_work_paper').click(function () {
    audit_plan_id = $(this).data("audit-plan-id");
    work_paper_id = $(this).data("work-paper-id");
    url = "{{ route('audit.plan.individual.plan-work-papers.delete') }}";
    var data = {audit_plan_id, work_paper_id};

        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (resp) {
            if (resp.status === 'error') {
                toastr.error(resp.data)
            } else {
                toastr.success(resp.data);
                Risk_Assessment_Item_Container.laodPlanWorkpapers();
            }
        });
    });
</script>
