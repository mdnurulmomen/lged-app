<x-title-wrapper>Audit Plan List</x-title-wrapper>

<div class="table-search-header-wrapper pt-3 pb-3">
    <div class="col-xl-12">
        <form>
            <div class="m-0 form-group row">
                <label for="select_fiscal_year_annual_plan" class="col-sm-1 col-form-label font-size-1-1">অর্থ বছর</label>
                <div class="col-sm-11">
                    <select class="form-control select-select2" name="fiscal_year" id="select_fiscal_year_annual_plan">
                        <option value="">--সিলেক্ট--</option>
                        @foreach($fiscal_years as $fiscal_year)
                            <option
                                value="{{$fiscal_year['id']}}" {{now()->year == $fiscal_year['start']?'selected':''}}>{{$fiscal_year['description']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card card-custom card-stretch">
    <div class="card-body p-0">
        <div class="load-office-orders"></div>
    </div>
</div>


<script>
    $(function () {
        AIR_Container.loadAuditPlanList();
    });

    $('#select_fiscal_year_annual_plan').change(function () {
        AIR_Container.loadAuditPlanList();
    });

    var AIR_Container = {
        loadAuditPlanList: function (page = 1, per_page = 200) {
            let fiscal_year_id = $('#select_fiscal_year_annual_plan').val();
            if (fiscal_year_id) {
                let url = '{{route('audit.report.qc.load-approved-plan-list')}}';
                let data = {fiscal_year_id, page, per_page};
                ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                    if (response.status === 'error') {
                        toastr.error(response.data);
                    } else {
                        $('.load-office-orders').html(response);
                    }
                });
            }
            else {
                $('.load-office-orders').html('');
            }
        },

        loadAIRCreate: function (elem) {
            url = '{{route('audit.report.qc.air-create')}}';
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
    }
</script>

