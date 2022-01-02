<x-title-wrapper>Add New Key</x-title-wrapper>

<div class="col-lg-12">
    <!--begin::Advance Table Widget 4-->
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Body-->
        <div class="card-body">
            <form id="key_form" autocomplete="off"
                  onsubmit="submitData(this, '{{route('audit.plan.strategy.html_view_content_key_store')}}'); return false;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-form-label">
                                Plan For <span class="text-danger">(*)</span>
                            </label>
                            <select class="form-control" name="fiscal_year" id="fiscal_year">
                                <option value="">--{{___('generic.select')}}--</option>
                                @foreach($plan_durations as $plan_duration)
                                    <option value="{{'FY '.$plan_duration['start_year'].' - '.'FY '.$plan_duration['end_year']}}">
                                        {{'FY '.$plan_duration['start_year'].' - '.'FY '.$plan_duration['end_year']}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label">
                                Title <span class="text-danger">(*)</span>
                            </label>
                            <input type="text" name="title" class="form-control" placeholder="Enter title">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label">Parent</label>
                            <select class="form-control" id="parent_id" name="parent_id">
                                <option value="0">--{{___('generic.select')}}--</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success btn-sm btn-bold btn-square">
                    <i class="fas fa-save"></i> Save
                </button>
            </form>

            {{--<div class="row mt-3">
                <div class="col-md-12">
                    <div class="card custom-card round-0 shadow-sm">
                        <div class="card-header">
                            <h5 class="mb-0">Title List</h5>
                        </div>
                        <div class="card-body" id="tree_div"></div>
                    </div>
                </div>
            </div>--}}
        </div>
        <!--end::Body-->
    </div>
    <!--end::Advance Table Widget 4-->
</div>
<script type="text/javascript">
    $("select#fiscal_year").change(function () {
        var fiscal_year = $(this).children("option:selected").val();
        getParent(fiscal_year);
        //getTree(ministry_id);
    });

    function getTree(ministry_id) {
        var url = 'load_layer_tree';
        var data = {ministry_id};
        var datatype = 'html';
        ajaxCallUnsyncCallback(url, data, datatype, 'GET', function (responseDate) {
            $("#tree_div").html(responseDate);
            KTTreeview.init();
            $(".kt_tree_21").jstree("open_all");
        });
    }

    function getParent(fiscal_year) {
        var url = '{{route('audit.plan.strategy.html_view_content_title_duration_wise')}}';
        var data = {fiscal_year};
        var datatype = 'html';
        ajaxCallUnsyncCallback(url, data, datatype, 'GET', function (responseDate) {
            $("#parent_id").html(responseDate);
        });
    }

    //submit
    function submitData(form, url) {
        var data = $(form).serialize();

        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (responseData) {
            if (responseData.status === 'success') {
                swal.fire(responseData.data);
                //loadData('',".load-educational-details-table-data");
            } else {
                if (responseData.statusCode === '422') {
                    var errors = responseData.msg;
                    $.each(errors, function (k, v) {
                        if (v !== '') {
                            toastr.error(v);
                        }
                    });
                } else {
                    toastr.error(responseData.data);
                }
            }
        });
    }
</script>
