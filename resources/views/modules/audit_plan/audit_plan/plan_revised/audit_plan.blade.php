<x-title-wrapper>Annual Plan Lists</x-title-wrapper>
<form>
    <div class="form-row">
        <div class="col-md-2 d-md-flex align-items-md-center">
            <p class="mb-0">Fiscal Year</p>
        </div>
        <div class="col-md-4 ">
            <select class="form-control select-select2" name="fiscal_year" id="select_fiscal_year_annual_plan">
                <option value="">Choose Fiscal Year</option>
                @foreach($fiscal_years as $fiscal_year)
                    <option
                        value="{{$fiscal_year['id']}}" {{now()->year == $fiscal_year['start']?'selected':''}}>{{$fiscal_year['description']}}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>

<div class="px-3" id="load_auditable_plan_lists">

</div>

@include('scripts.script_generic')
<script>
    var Audit_Plan_Container = {
        loadAuditablePlanList: function (fiscal_year_id, page = 1, per_page = 20) {
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

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (res) {
                //var newDoc = document.open("text/html", "replace");
                var newDoc = document.open("about:blank");
                newDoc.write(res);
                newDoc.close();
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
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (res) {
                KTApp.unblock('#kt_content');
                var newDoc = document.open("text/html", "replace");
                newDoc.write(res);
                newDoc.close();
            })
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
