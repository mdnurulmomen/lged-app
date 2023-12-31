<x-title-wrapper>Final Yearly Operational Plan</x-title-wrapper>
<div class="col-md-12">
    <div class="d-flex justify-content-end">
        <a class="btn btn-success btn-sm btn-bold btn-square" onclick='loadPage($(this))'
           data-url="{{route('audit.plan.operational.file_create')}}" href="javascript:;">
            <i class="far fa-plus mr-1"></i> Upload Operational Plan
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
                        <th>Plan For</th>
                        <th>File Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($final_plan_file_list as $final_plan_file)
                        <tr>
                            <td><span>{{$final_plan_file['fiscal_year']}}</span></td>
                            <td><span>{{$final_plan_file['user_file_name']}}</span></td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{$final_plan_file['file_url']}}" target="_blank" class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary">
                                        <i class="fal fa-eye"></i>
                                    </a>

                                    <a href="javascript:;" onclick='loadPage($(this))' data-url="{{route('audit.plan.operational.file_edit', [$final_plan_file['id']])}}" class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-info">
                                        <i class="fal fa-edit"></i>
                                    </a>
                                </div>
                            </td>
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

