{{-- @if($scope_editable == 1) && $current_office_id != 1 && $approval_status != 'approved' --}}
<div class="row mb-3">
    <div class="col-md-12">
        <div class="d-flex justify-content-end">
            <button onclick="PSR_Plan_Container.psrplanUpdate($(this))"
                {{-- title="প্ল্যান-{{enTobn($audit_plan_id)}} বিস্তারিত দেখুন" --}}
                {{-- data-fiscal-year-id="{{$fiscal_year_id}}" --}}
                data-annual-plan-id="{{$psr_plan_id}}"
                class="btn btn-primary btn-sm btn-bold btn-square">
                <i class="fad fa-edit text-dark-100 mr-2"></i> হালনাগাদ করুন
            </button>
        </div>
    </div>
</div>
<iframe src="{{asset('storage/psrs/'.$fileName)}}" width="100%" height="100%"></iframe>

<script>
    var PSR_Plan_Container = {
        psrplanUpdate: function (elem) {
            url = '{{route('audit.plan.annual.psr.update')}}';
            // fiscal_year_id = elem.data('fiscal-year-id')
            annual_plan_id = elem.data('annual-plan-id')

            data = {
                annual_plan_id,
            };

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                KTApp.unblock('#kt_wrapper');
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    var newDoc = document.open("text/html", "replace");
                    newDoc.write(response);
                    newDoc.close();
                }
            })
        }
    }
</script>
