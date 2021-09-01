<x-title-wrapper>Please replace the copy of Final Operational Plan</x-title-wrapper>
<div class="col-lg-12">
    <!--begin::Advance Table Widget 4-->
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Body-->
        <div class="card-body">
            <form id="sp_file_form" enctype="multipart/form-data">
                <input type="hidden" value="{{$file_info['id']}}" name="id">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-form-label">
                                Plan For <span class="text-danger">(*)</span>
                            </label>
                            <select class="form-control" name="fiscal_year">
                                <option value="">--Select--</option>
                                @foreach($plan_durations as $plan_duration)
                                    <option value="{{'FY '.$plan_duration['start'].' - '.'FY '.$plan_duration['end']}}"
                                    {{'FY '.$plan_duration['start'].' - '.'FY '.$plan_duration['end']==$file_info['fiscal_year']?'selected':''}}>
                                        {{'FY '.$plan_duration['start'].' - '.'FY '.$plan_duration['end']}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{$file_info['file_url']}}" target="_blank" class="btn btn-outline-primary btn-square">
                        <i class="fal fa-file-pdf"></i> {{$file_info['user_file_name']}}
                    </a>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-form-label">
                                Please select the file <span class="text-danger">(*)</span>
                            </label>
                            <input name="file" type="file" class="form-control rounded-0"
                                   accept="application/pdf" />
                        </div>
                    </div>
                </div>
                <a id="submit_form" class="btn btn-success btn-sm btn-bold btn-square">
                    <i class="fal fa-save"></i> Update
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
                url: "{{route('audit.plan.operational.file_update')}}",
                type: "POST",
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (responseData) {
                    if (responseData.status === 'success') {
                        toastr.success(responseData.data);
                        var url = '{{route('audit.plan.operational.file_list')}}';
                        ajaxCallAsyncCallbackAPI(url,'', 'GET', function (response) {
                            if (response.status === 'error') {
                                toastr.error('Error');
                            } else {
                                $("#kt_content").html(response);
                            }
                        });
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
                error: function (data) {
                    if (data.responseJSON.errors) {
                        $.each(data.responseJSON.errors, function (k, v) {
                            if (isArray(v)) {
                                $.each(v, function (n, m) {
                                    toastr.error(m)
                                    console.log(m,n,v);
                                })
                            } else {
                                if (v !== '') {
                                    toastr.error(v);
                                }
                            }
                        });
                    }
                    //toastr.error(responseData.msg);
                }
            });
        });
    });
</script>
