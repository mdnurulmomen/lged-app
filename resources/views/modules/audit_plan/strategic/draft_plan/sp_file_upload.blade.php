<x-title-wrapper>File Upload</x-title-wrapper>
<div class="col-lg-12">
    <!--begin::Advance Table Widget 4-->
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Body-->
        <div class="card-body">
            <form id="sp_file_form" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="col-form-label">
                                Duration <span class="text-danger">(*)</span>
                            </label>
                            <select class="form-control" name="duration_id">
                                @foreach($plan_durations as $plan_duration)
                                    <option value="{{$plan_duration['id']}}">
                                        {{$plan_duration['start_year'].' - '.$plan_duration['end_year']}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <label class="col-form-label">
                                Upload File <span class="text-danger">(*)</span>
                            </label>
                            <input name="file" type="file" class="form-control rounded-0" />
                        </div>
                    </div>
                </div>
                <a id="submit_form" class="btn btn-success btn-sm btn-bold btn-square btn_create_milestone">
                    <i class="far fa-plus mr-1"></i> Upload
                </a>
            </form>
        </div>
        <!--end::Body-->
    </div>
    <!--end::Advance Table Widget 4-->
</div>
<script type="text/javascript">

    //for office submit form
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#submit_form').on('click', function(e){
            e.preventDefault();

            $.ajax({
                data: new FormData(document.getElementById("sp_file_form")),
                url: "{{route('audit.plan.strategy.sp_file_store')}}",
                type: "POST",
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (responseData) {
                    if (responseData.status === 'success') {
                        toastr.success(responseData.data);
                    }
                    else {
                        if (responseData.statusCode === '422') {
                            var errors = responseData.msg;
                            $.each(errors, function (k, v) {
                                if (v !== '') {
                                    toastr.error(v);
                                }
                            });
                        }
                        else {
                            toastr.error(responseData.data);
                        }
                    }
                },
                error: function (responseData) {
                    toastr.error(responseData.msg);
                }
            });
        });
    });
</script>
