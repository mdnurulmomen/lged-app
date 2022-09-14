@if($scope_editable == 1)
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="d-flex justify-content-end">
                <button onclick="Annual_Plan_Container.psrPlanEdit($(this))"
                    data-psr-plan-id="{{$psr_plan_id}}"
                    class="btn btn-primary btn-sm btn-bold btn-square">
                    <i class="fad fa-edit text-dark-100 mr-2"></i> হালনাগাদ করুন
                </button>
            </div>
        </div>
    </div>
@endif

<iframe src="{{asset('storage/psrs/'.$fileName)}}" width="100%" height="100%"></iframe>

