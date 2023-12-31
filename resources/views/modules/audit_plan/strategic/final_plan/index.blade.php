<x-title-wrapper>Final Strategic Plan</x-title-wrapper>

<div class="card sna-card-border mt-3" style="margin-bottom:15px;">
    <div class="d-flex justify-content-end">
        <a class="btn btn-success btn-sm btn-bold btn-square" onclick='loadPage($(this))'
           data-url="{{route('audit.plan.strategy.sp_file_upload')}}" href="javascript:;">
            <i class="far fa-plus mr-1"></i> Upload Final Plan
        </a>
    </div>
</div>

<div class="card sna-card-border mt-3" style="margin-bottom:30px;">
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

                            <a href="javascript:;" onclick='loadPage($(this))' data-url="{{route('audit.plan.strategy.sp_file_edit', [$final_plan_file['id']])}}" class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-info">
                                <i class="fal fa-edit"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

