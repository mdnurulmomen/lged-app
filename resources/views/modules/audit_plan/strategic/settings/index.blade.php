<x-title-wrapper>File Upload</x-title-wrapper>
<div class="col-md-12">
    <div class="d-flex justify-content-end">
        <a class="btn btn-success btn-sm btn-bold btn-square btn_create" data-url="{{route('audit.plan.strategy.sp_file_upload')}}" href="javascript:;">
            <i class="far fa-plus mr-1"></i> Upload New file
        </a>
    </div>
</div>
<div class="col-lg-12">
    <!--begin::Advance Table Widget 4-->
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Body-->
        <div class="card-body">
            <!--begin::Table-->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>#No</th>
                            <th>Key</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($settings as $setting)
                        <tr>
                            <td><span>{{$loop->iteration}}</span></td>
                            <td><span>{{$setting['setting_key']}}</span></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!--end::Table-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Advance Table Widget 4-->
</div>

<script>
    $('.btn_create').on('click', function () {
        url = $(this).data('url')
        ajaxCallAsyncCallbackAPI(url,'', 'GET', function (response) {
            if (response.status === 'error') {
                toastr.error('Error')
            } else {
                $("#kt_content").html(response);
            }
        });
    });
</script>
