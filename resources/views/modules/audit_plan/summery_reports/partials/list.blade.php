<table class="table table-bordered" width="100%">
    <thead class="thead-light">
    <tr>
        <th>SL</th>

        <th>Plan</th>

        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @forelse($audit_plan_list as $auditplan)
        <tr id="row_{{$auditplan['id']}}" data-row="{{$loop->iteration}}">
            <td>{{ $loop->iteration }}</td>
            <td> {{ ucfirst($auditplan['yearly_plan_location']['project_name_en']) }} </td>
            <td>
                <button href="javascript:;"
                   data-audit-plan-id="{{$auditplan['id']}}"
                   class="btn btn-sm btn-square btn-primary mr-2 view-summery">
                    <i class="fas fa-eye"></i> Finding List
                </button>

                <button href="javascript:;"
                   data-audit-plan-id="{{$auditplan['id']}}"
                   class="btn btn-sm btn-square btn-primary mr-2 view-main-body-doc">
                    <i class="fas fa-eye"></i> Finding Details
                </button>
            </td>
        </tr>
    @empty
        <tr data-row="0" class="datatable-row" style="left: 0px;">
            <td colspan="4" class="datatable-cell text-center"><span>Nothing Found</span></td>
        </tr>
    @endforelse
    </tbody>
</table>

<script>
    $('.view-summery').click(function () {

        quick_panel = $("#kt_quick_panel");
        $('.offcanvas-wrapper').html('');
        quick_panel.addClass('offcanvas-on');
        quick_panel.css('opacity', 1);
        quick_panel.css('width', '800px');
        $('.offcanvas-footer').hide();
        quick_panel.removeClass('d-none');
        $("html").addClass("side-panel-overlay");
        $('.offcanvas-title').html('Finding List');

        let audit_plan_id = $(this).data('audit-plan-id');
        let data = {audit_plan_id};

        let url = "{{ route('audit.plan.summery-reports.list') }}";

        ajaxCallAsyncCallbackAPI(url, data, 'GET', function (resp) {
            if (resp.status === 'error') {
                toastr.error('no');
                console.log(resp.data)
            } else {
                console.log(resp);
                $('.offcanvas-wrapper').html(resp);
            }
        });
    });

    $('.view-main-body-doc').click(function () {

        quick_panel = $("#kt_quick_panel");
        $('.offcanvas-wrapper').html('');
        quick_panel.addClass('offcanvas-on');
        quick_panel.css('opacity', 1);
        quick_panel.css('width', '800px');
        $('.offcanvas-footer').hide();
        quick_panel.removeClass('d-none');
        $("html").addClass("side-panel-overlay");
        $('.offcanvas-title').html('Finding Details');

        let audit_plan_id = $(this).data('audit-plan-id');
        let data = {audit_plan_id};

        let url = "{{ route('audit.plan.main-body-document.list') }}";

        ajaxCallAsyncCallbackAPI(url, data, 'GET', function (resp) {
            if (resp.status === 'error') {
                toastr.error('no');
                console.log(resp.data)
            } else {
                console.log(resp);
                $('.offcanvas-wrapper').html(resp);
            }
        });
    });

    /*
    $('.btn_edit_risk_impact').click(function () {
        quick_panel = $("#kt_quick_panel");
        $('.offcanvas-wrapper').html('');
        quick_panel.addClass('offcanvas-on');
        quick_panel.css('opacity', 1);
        quick_panel.css('width', '500px');
        $('.offcanvas-footer').hide();
        quick_panel.removeClass('d-none');
        $("html").addClass("side-panel-overlay");
        $('.offcanvas-title').html('Edit Risk Impact');

        let annual_plan_id = $(this).data('annual-plan-id');

        url = "{{ route('settings.risk-impacts.edit') }}";
        var data = {id,title_bn,title_en,impact_value};

        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (resp) {
            if (resp.status === 'error') {
                toastr.error('no');
                console.log(resp.data)
            } else {
                // $('#id').val(id);
                // $('#title_bn').text(title_bn);
                // $('#title_en').text(title_en);
                // $('#impact_value').val(impact_value);
                // $('#x_risk_factor_id').val(x_risk_factor_id);
                $('.offcanvas-wrapper').html(resp);
            }
        });
    });
    */
</script>
