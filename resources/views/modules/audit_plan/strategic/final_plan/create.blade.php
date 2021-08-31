<x-title-wrapper>Please upload the copy of Final Strategic Plan</x-title-wrapper>
<div class="col-lg-12">
    <!--begin::Advance Table Widget 4-->
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Body-->
        <div class="card-body">
            <form id="sp_file_form" enctype="multipart/form-data">
                <input type="hidden" id="opDocumentId" name="id">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-form-label">
                                Plan For <span class="text-danger">(*)</span>
                            </label>
                            <select class="form-control" name="fiscal_year" id="fiscal_year">
                                <option value="">--Select--</option>
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
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-form-label">
                                Please select the file <span class="text-danger">(*)</span>
                            </label>
                            <input name="file" type="file" class="form-control rounded-0"
                                   accept="application/pdf" />

                            <div id="opFileName" class="mt-3"></div>
                        </div>
                    </div>
                </div>
                <a id="submit_form" class="btn btn-success btn-sm btn-bold btn-square">
                    <i class="fal fa-save"></i> Upload
                </a>
            </form>
        </div>
        <!--end::Body-->
    </div>
    <!--end::Advance Table Widget 4-->
</div>
<script type="text/javascript">

    //for exist check
    $("select#fiscal_year").change(function () {
        var fiscal_year = $(this).children("option:selected").val();
        existCheck('operational',fiscal_year);
    });

    function existCheck(document_type,fiscal_year) {
        var url = '{{route('audit.plan.strategy.is_document_exist')}}';
        var data = {document_type,fiscal_year};
        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (responseData) {
            //console.log(responseData)
            if (responseData.status === 'success'){
                if (responseData.data){
                    $("#opDocumentId").val(responseData.data.id);
                    $("#opFileName").html("<a href='"+responseData.data['file_url']+"' target='_blank' " +
                        "class='text-primary'><i class='fal fa-file-pdf'> "+responseData.data['user_file_name']+"</i></a>")
                }
                else {
                    $("#opDocumentId").val('');
                    $("#opFileName").html("");
                }
            }
        });
    }

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
                        var url = '{{route('audit.plan.strategy.sp_file_list')}}';
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
                }
            });
        });
    });
</script>
