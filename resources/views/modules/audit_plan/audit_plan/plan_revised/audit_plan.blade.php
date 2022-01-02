<x-title-wrapper>Audit Plan Lists</x-title-wrapper>

<div class="table-search-header-wrapper pt-3 pb-3">
    <div class="col-xl-12">
        <form>
            <div class="m-0 form-group row">
                <label for="select_fiscal_year_annual_plan" class="col-sm-1 col-form-label font-size-1-1">অডিট বছর</label>
                <div class="col-sm-11">
                    <select class="form-control select-select2" name="fiscal_year" id="select_fiscal_year_annual_plan">
                        <option value="">--সিলেক্ট--</option>
                        @foreach($fiscal_years as $fiscal_year)
                            <option
                                value="{{$fiscal_year['id']}}" {{now()->year == $fiscal_year['end']?'selected':''}}>{{$fiscal_year['description']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="card card-custom card-stretch">
    <div class="card-body p-0">
        <div id="load_auditable_plan_lists"></div>
    </div>
</div>


@include('scripts.script_generic')
<script>
    var Audit_Plan_Container = {
        loadAuditablePlanList: function (fiscal_year_id, page = 1, per_page = 100) {
            let url = '{{route('audit.plan.audit.revised.plan.load-all-lists')}}';
            let data = {fiscal_year_id, page, per_page};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#load_auditable_plan_lists').html(response);
                }
            });
        },

        loadAuditPlans: function () {
            let url = '{{route('audit.plan.audit.revised.plan.load-all-lists')}}';
            let data = {fiscal_year_id};
            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#load_auditable_plan_lists').html(response);
                }
            });
        },

        loadAuditPlanBookEditable: function (elem) {
            url = '{{route('audit.plan.audit.revised.plan.update-entity-audit-plan')}}';
            audit_plan_id = elem.data('audit-plan-id')
            fiscal_year_id = elem.data('fiscal-year-id')
            annual_plan_id = elem.data('annual-plan-id')

            data = {
                audit_plan_id,
                fiscal_year_id,
                annual_plan_id,
            };

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    var newDoc = document.open("text/html", "replace");
                    newDoc.write(response);
                    newDoc.close();
                }
            })
        },

        loadAuditPlanBookCreatable: function (elem) {
            url = '{{route('audit.plan.audit.revised.plan.create-entity-audit-plan')}}';
            annual_plan_id = elem.data('annual-plan-id')
            fiscal_year_id = elem.data('fiscal-year-id')
            activity_id = elem.data('activity-id')

            data = {
                activity_id,
                annual_plan_id,
                fiscal_year_id,
            };

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    var newDoc = document.open("text/html", "replace");
                    newDoc.write(response);
                    newDoc.close();
                }
            })
        },

        showPlanInfo: function (elem) {
            annual_plan_id = elem.data('annual-plan-id');
            data = {annual_plan_id}
            KTApp.block('#kt_content');
            let url = '{{route('audit.plan.annual.plan.revised.show_plan_info')}}'
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $(".offcanvas-title").text('বিস্তারিত');
                    quick_panel = $("#kt_quick_panel");
                    quick_panel.addClass('offcanvas-on');
                    quick_panel.css('opacity', 1);
                    quick_panel.css('width', '40%');
                    quick_panel.removeClass('d-none');
                    $("html").addClass("side-panel-overlay");
                    $(".offcanvas-wrapper").html(response);
                }
            });
        },
    };

    $(function () {
        let fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
        if (fiscal_year_id) {
            Audit_Plan_Container.loadAuditablePlanList(fiscal_year_id);
        } else {
            $('#load_auditable_plan_lists').html('');
        }
    });

    $('#select_fiscal_year_annual_plan').change(function () {
        let fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
        if (fiscal_year_id) {
            Audit_Plan_Container.loadAuditablePlanList(fiscal_year_id);
        } else {
            $('#load_auditable_plan_lists').html('');
        }
    });
</script>
