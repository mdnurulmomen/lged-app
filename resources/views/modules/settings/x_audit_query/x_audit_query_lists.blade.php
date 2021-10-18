<x-title-wrapper>Audit Query</x-title-wrapper>
<div class="col-lg-12">
    <!--begin::Advance Table Widget 4-->
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0 py-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark"></span>
            </h3>
            <div class="card-toolbar">
                <button type="button" data-url="{{route('settings.audit-query.store')}}" data-method="POST"
                        class="font-weight-bolder font-size-sm mr-3 btn btn-success btn-sm btn-bold btn-square btn_create_audit_query">
                    <i class="far fa-plus mr-1"></i> Create Query
                </button>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-0 pb-3">
            <!--begin::Table-->
            <div
                class="table-responsive load-table-data"
                data-href="{{route('settings.audit-query.lists')}}">
            </div>
            <!--end::Table-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Advance Table Widget 4-->
</div>

<!-- Modal-->
<x-modal id="audit_query_modal" title="Create Fiscal Year" url="{{route('settings.audit-query.store')}}">
    <form id="audit_query_form">
        <div class="form-row pt-4">
            <div class="col-md-4">
                <select name="cost_center_type_id" id="cost_center_type_id" class="form-control select-select2">
                    <option value="">Select Cost Center Type</option>
                    @foreach($cost_center_types as $key => $type)
                        <option value="{{$type['id']}}">{{$type['name_bn']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="appendQuery">
            <div class="form-row pt-4">
                <div class="col-md-4">
                    <textarea placeholder="Query Title Bangla" class="form-control" type="text" name="query_title_bn[]"></textarea>

                </div>
                <div class="col-md-4">
                    <textarea placeholder="Query Title Bangla" class="form-control" type="text" name="query_title_en[]"></textarea>
                </div>
                <div class="col-md-2">
                <span title="যোগ করুন"
                      class="btn btn-outline-primary btn-sm btn-square btn_query_add">
                    <i class="fal fa-plus"></i>
                </span>
                </div>
            </div>
        </div>
        <input type="hidden" name="audit_query_id" id="audit_query_id" value="">
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

    $('.btn_create_audit_query').click(function () {
        emptyModalData('audit_query_modal');
        $('#audit_query_modal_title').text('Create');
        $('#btn_audit_query_modal_save').text('Save');
        $('#btn_audit_query_modal_save').data('url', $(this).data('url'));
        $('#btn_audit_query_modal_save').data('method', $(this).data('method'));
        $('#audit_query_modal').modal('show');
    });

    $('#btn_audit_query_modal_save').click(function () {
        url = $(this).data('url');
        data = $('#audit_query_form').serialize();
        method = $(this).data('method');
        submitModalData(url, data, method, 'audit_query_modal')
    });

    $('.btn_query_add').on('click', function () {
        $('.appendQuery').append(
            `<div class="form-row pt-4">
                <div class="col-md-4">
                    <textarea placeholder="Query Title Bangla" class="form-control" type="text" name="query_title_bn[]"></textarea>
                </div>
                <div class="col-md-4">
                    <textarea placeholder="Query Title Bangla" class="form-control" type="text" name="query_title_en[]"></textarea>
                </div>
                <div class="col-md-2">
                    <button title="মুছে ফেলুন" class="btn btn-outline-danger btn-sm btn-danger btn-square btn_query_remove">
                        <i class="fal fa-minus"></i>
                    </button>
                </div>
            </div>`
        );

        $('.appendQuery').on('click', '.btn_query_remove', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });

        // $('.summernote').summernote();
        // $('div.note-editable').height(150);
    });

</script>
@include('scripts.script_generic')
