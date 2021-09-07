@extends('layouts.full_width')
@section('styles')
@endsection
@section('content')
    <div class="row m-0 page-title-wrapper d-md-flex align-items-md-center">
        <div class="col-md-6">
            <div class="title py-2">
                <h4 class="mb-0 font-weight-bold">
                    <a href="{{route('audit.plan.revised.audit.index')}}">
                        <i title="Back To Audit Plan" class="fad fa-backward mr-3"></i>
                    </a>
                    Create Audit Plan
                </h4>
            </div>
        </div>
        <div class="col-md-6 text-right">
            <button class="btn btn-sm btn-square btn-primary btn-hover-success"
                    onclick="Create_Entity_Plan_Container.generatePDF($(this))">PDF <i class="fas fa-save"></i>
            </button>
            <button class="btn btn-sm btn-square btn-primary btn-hover-success"
                    data-yearly-plan-rp-id="{{$rp_id}}"
                    data-party-id="{{$party_id}}"
                    onclick="Create_Entity_Plan_Container.draftEntityPlan($(this))">Save <i class="fas fa-save"></i>
            </button>
        </div>
    </div>

    <div class="split" id="splitWrapper">
        <div id="split-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="p-5">
                        <div class="input-group mb-5">
                            <input class="form-control rounded-0" type="text" name="" placeholder="Add"
                                   aria-label="Recipient's " aria-describedby="my-addon">
                            <div class="input-group-append rounded-0">
                                <button class="btn btn-success btn-sm btn-square" type="button"><i
                                        class="far fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="mt-5">
                            <h3>Audit list</h3>
                        </div>
                        <!---JS tree start---->
                        <div id="createPlanJsTree" class="mt-5">
                        </div>
                        <!---JS tree end---->
                        <div class="form-group mt-5">
                            <input class="form-control rounded-0" type="text" name="" id="searchPlaneField"
                                   placeholder="Search"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="split-1">
            <div class="summernote" id="kt_summernote_1"></div>
        </div>
        <div id="split-2">
            <div id="writing-screen-wrapper" style="font-family:SolaimanLipi,serif !important;">
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('scripts.script_create_entity_audit_plan')
    <script>
        var Create_Entity_Plan_Container = {
            draftEntityPlan: function (elem) {
                url = '{{route('audit.plan.audit.revised.plan.save-draft-entity-audit-plan')}}';
                plan_description = JSON.stringify(templateArray);
                party_id = elem.data('party-id');
                yearly_plan_rp_id = elem.data('yearly-plan-rp-id');
                data = {plan_description, party_id, yearly_plan_rp_id};
                ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                    if (response.status === 'success') {
                        toastr.success('Audit Plan Saved Successfully');
                    } else {
                        toastr.error('Not Saved');
                        console.log(response)
                    }
                })
            },
            generatePDF: function (elem) {
                url = '{{route('audit.plan.audit.revised.plan.generate-audit-plan-pdf')}}';
                plan = templateArray;
                data = {plan};

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    xhrFields: {
                        responseType: 'blob'
                    },

                    success: function (response) {
                        var blob = new Blob([response]);
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = "audit_plan.pdf";
                        link.click();
                    },

                    error: function (blob) {
                        toastr.error('Failed to generate PDF.')
                        console.log(blob);
                    }

                });
            },
        };
    </script>
@endsection
