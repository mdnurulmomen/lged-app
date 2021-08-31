<x-title-wrapper>Settings</x-title-wrapper>
<div class="col-md-12">
    <div class="d-flex justify-content-end">
        <a class="btn btn-success btn-sm btn-bold btn-square btn_create" onclick='loadPage($(this))'
           data-url="{{route('audit.plan.strategy.setting_create')}}" href="javascript:;">
            <i class="far fa-plus mr-1"></i> Add New
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
                            <th>Key</th>
                            {{--<th>Action</th>--}}
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($settings as $setting)
                        <tr>
                            <td><span>{{$setting['setting_key']}}</span></td>
                            {{--<td>
                                <div class="btn-group">
                                    <a href="javascript:;" onclick='loadPage($(this))' data-url="{{route('audit.plan.operational.file_edit', [$setting['id']])}}" class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-info">
                                        <i class="fal fa-edit"></i>
                                    </a>
                                </div>
                            </td>--}}
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

</script>
