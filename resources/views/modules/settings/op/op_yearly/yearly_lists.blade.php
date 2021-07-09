<x-title-wrapper>Operation Plan Yearlies</x-title-wrapper>
<div class="col-lg-12">
    <!--begin::Advance Table Widget 4-->
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0 py-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark"></span>
            </h3>
            <div class="card-toolbar">
                <button type="button" data-url="{{route('settings.operational-plan.yearly.store')}}" data-method="POST"
                        class="font-weight-bolder font-size-sm mr-3 btn btn-success btn-sm btn-bold btn-square btn_create_fiscal_year">
                    <i class="far fa-plus mr-1"></i> Create New Operation Year
                </button>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-0 pb-3">
            <!--begin::Table-->
            <div
                class="table-responsive datatable datatable-default datatable-bordered datatable-loaded load-table-data"
                data-href="{{route('settings.operational-plan.yearly.lists')}}">
            </div>
            <!--end::Table-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Advance Table Widget 4-->
</div>

<!-- Modal-->
<x-modal id="op_yearly_modal" title="Create New Operation Year"
         url="{{route('settings.operational-plan.yearly.store')}}">
    <form id="op_yearly_form">
        <div class="form-group row">
            <label for="start_op_year" class="col-3 col-form-label">Start Year</label>
            <div class="col-9">
                <input placeholder="Start Year" class="form-control year-format" type="text" value=""
                       id="start_op_year" name="start_year"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="end_op_year" class="col-3 col-form-label">End Year</label>
            <div class="col-9">
                <input placeholder="End Year" class="form-control year-format" type="text" value=""
                       id="end_op_year" name="end_year"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-3 col-form-label">Description</label>
            <div class="col-9">
                <textarea placeholder="End Year" class="form-control" type="text" id="description" name="description"/>
            </div>
        </div>
        <input type="hidden" name="op_yearly_id" id="op_yearly_id" value="">
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

    $('.btn_create_fiscal_year').click(function () {
        emptyModalData('op_yearly_modal');
        $('#op_yearly_modal_title').text('Create New Operation Year');
        $('#btn_op_yearly_modal_save').text('Save');
        $('#btn_op_yearly_modal_save').data('url', $(this).data('url'));
        $('#btn_op_yearly_modal_save').data('method', $(this).data('method'));
        $('#op_yearly_modal').modal('show');
    });

    $('#btn_op_yearly_modal_save').click(function () {
        url = $(this).data('url');
        data = $('#op_yearly_form').serialize();
        method = $(this).data('method');
        submitModalData(url, data, method, 'op_yearly_modal')
    });

</script>
@include('scripts.script_generic')
