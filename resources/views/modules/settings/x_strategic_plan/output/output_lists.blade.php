<x-title-wrapper>Strategic Plan Output</x-title-wrapper>
<div class="col-lg-12">
    <!--begin::Advance Table Widget 4-->
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0 py-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark"></span>
            </h3>
            <div class="card-toolbar">
                <button type="button" data-url="{{route('settings.strategic-plan.output.store')}}" data-method="POST"
                        class="font-weight-bolder font-size-sm mr-3 btn btn-success btn-sm btn-bold btn-square btn_create_plan_output">
                    <i class="far fa-plus mr-1"></i> Strategic Plan Outcome
                </button>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-0 pb-3">
            <!--begin::Table-->
            <div
                class="table-responsive datatable datatable-default datatable-bordered datatable-loaded load-table-data"
                data-href="{{route('settings.strategic-plan.output.lists')}}">
            </div>
            <!--end::Table-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Advance Table Widget 4-->
</div>

<!-- Modal-->
<x-modal id="plan_output_modal" title="Create Strategic Plan Output"
         url="{{route('settings.strategic-plan.output.store')}}" method="post">
    <form id="plan_duration_form">
        <div class="form-group row">
            <label for="duration_id" class="col-3 col-form-label">Plan Duration</label>
            <div class="col-9">
                <select name="duration_id" id="duration_id" class="form-control select-select2">
                    <option value="">Choose Duration</option>
                    @forelse($plan_durations as $plan_duration)
                        <option value="{{$plan_duration['id']}}">{{$plan_duration['start_year']}}
                            - {{$plan_duration['end_year']}}</option>
                    @empty
                    @endforelse
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="outcome_id" class="col-3 col-form-label">Plan Outcome</label>
            <div class="col-9">
                <select name="outcome_id" id="outcome_id" class="form-control select-select2">
                    <option value="">Choose Outcome</option>
                    @forelse($plan_outcomes as $plan_outcome)
                        <option value="{{$plan_outcome['id']}}">{{$plan_outcome['outcome_no']}}</option>
                    @empty
                    @endforelse
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="output_no" class="col-3 col-form-label">Output No</label>
            <div class="col-9">
                <input placeholder="Output No" class="form-control" type="text" value=""
                       id="output_no" name="output_no"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="output_title_en" class="col-3 col-form-label">Output Title English</label>
            <div class="col-9">
                <input placeholder="Output Title English" class="form-control" type="text" value=""
                       id="output_title_en" name="output_title_en"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="output_title_bn" class="col-3 col-form-label">Output Title Bangla</label>
            <div class="col-9">
                <input placeholder="Output Title Bangla" class="form-control" type="text" value=""
                       id="output_title_bn" name="output_title_bn"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="remarks" class="col-3 col-form-label">Remarks</label>
            <div class="col-9">
                <textarea placeholder="Remarks" class="form-control" type="text" id="remarks" name="remarks"/>
            </div>
        </div>
        <input type="hidden" name="output_id" id="output_id" value="">
    </form>
</x-modal>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
        if ($(".load-table-data").length > 0) {
            loadData();
        }
    });

    function loadData() {
        url = $(".load-table-data").data('href');
        var data = {};
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (resp) {
            if (resp.status === 'error') {
                toastr.error('no');
                console.log(resp.data)
            } else {
                $(".load-table-data").html(resp);
            }
        });
    }

    $('.btn_create_plan_output').click(function () {
        emptyModalData('plan_output_modal');
        $('#plan_output_title').text('Create');
        $('#btn_plan_output_save').text('Save');
        $('#btn_plan_output_save').data('url', $(this).data('url'));
        $('#btn_plan_output_save').data('method', $(this).data('method'));
        $('#plan_output_modal').modal('show');
    });

    $('#btn_plan_output_modal_save').click(function () {
        url = $(this).data('url');
        data = $('#plan_duration_form').serialize();
        method = $(this).data('method');
        submitModalData(url, data, method, 'plan_output_modal')
    });

</script>
@include('scripts.script_generic')
