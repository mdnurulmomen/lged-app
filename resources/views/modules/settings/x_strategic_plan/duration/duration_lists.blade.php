<x-title-wrapper>Strategic Plan Duration</x-title-wrapper>
<div class="col-lg-12">
    <!--begin::Advance Table Widget 4-->
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0 py-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark"></span>
            </h3>
            <div class="card-toolbar">
                <button type="button" data-url="{{route('settings.strategic-plan.duration.store')}}" data-method="POST"
                        class="font-weight-bolder font-size-sm mr-3 btn btn-success btn-sm btn-bold btn-square btn_create_plan_duration">
                    <i class="far fa-plus mr-1"></i> Strategic Plan Duration
                </button>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-0 pb-3">
            <!--begin::Table-->
            <div
                class="table-responsive load-table-data"
                data-href="{{route('settings.strategic-plan.duration.lists')}}">
            </div>
            <!--end::Table-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Advance Table Widget 4-->
</div>

<!-- Modal-->
<x-modal id="plan_duration_modal" title="Create Strategic Plan Duration"
         url="{{route('settings.strategic-plan.duration.store')}}">
    <form id="plan_duration_form">
        <div class="form-group row">
            <label for="start_plan_duration" class="col-3 col-form-label">Start Year</label>
            <div class="col-9">
                <input placeholder="Start Year" class="form-control year-format" type="text" value=""
                       id="start_plan_duration" name="start_year"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="end_plan_duration" class="col-3 col-form-label">End Year</label>
            <div class="col-9">
                <input placeholder="End Year" class="form-control year-format" type="text" value=""
                       id="end_plan_duration" name="end_year"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="remarks" class="col-3 col-form-label">Remarks</label>
            <div class="col-9">
                <textarea placeholder="Remarks" class="form-control" type="text" id="remarks" name="remarks"/>
            </div>
        </div>
        <input type="hidden" name="plan_duration_id" id="plan_duration_id" value="">
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

    $('.btn_create_plan_duration').click(function () {
        emptyModalData('plan_duration_modal');
        $('#plan_duration_modal_title').text('Create');
        $('#btn_plan_duration_modal_save').text('Save');
        $('#btn_plan_duration_modal_save').data('url', $(this).data('url'));
        $('#btn_plan_duration_modal_save').data('method', $(this).data('method'));
        $('#plan_duration_modal').modal('show');
    });

    $('#btn_plan_duration_modal_save').click(function () {
        url = $(this).data('url');
        data = $('#plan_duration_form').serialize();
        method = $(this).data('method');
        submitModalData(url, data, method, 'plan_duration_modal')
    });

</script>
@include('scripts.script_generic')
