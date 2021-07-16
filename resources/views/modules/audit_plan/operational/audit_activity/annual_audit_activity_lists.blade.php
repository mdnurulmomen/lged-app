<x-title-wrapper>Audit Activities</x-title-wrapper>
<div class="col-lg-12 pt-5">
    <!--begin::Advance Table Widget 4-->
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0 py-5 justify-content-end">
            <div class="card-toolbar">
                <x-toolbar-button class="btn btn-success btn-sm btn-bold btn-square btn_create_audit_activity"
                                  href="{{route('audit.plan.operational.activity.create')}}">
                    <i class="far fa-plus mr-1"></i> Create Annual Audit Activity
                </x-toolbar-button>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-0 pb-3">
            <!--begin::Table-->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center">Fiscal Year</th>
                            <th class="text-center">Strategic Outcome Count</th>
                            <th class="text-center">Strategic Output Count</th>
                            <th class="text-center">Activities Count</th>
                            <th class="text-center">Milestone Count</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
<<<<<<< HEAD
                    <tbody>
                        <tr>
                            <td class="text-center"><span>2021-2022</span></td>
                            <td class="text-center"><span>2</span></td>
                            <td class="text-center"><span>2</span></td>
                            <td class="text-center"><span>32</span></td>
                            <td class="text-center"><span>66</span></td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="javascript:;" data-url="{{route('audit.plan.operational.activity.single')}}" class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_view_audit_annual_activity">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="javascript:;" data-url="{{route('audit.plan.operational.activity.edit')}}" class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_edit_audit_annual_activity">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
=======
                    <tbody style="" class="datatable-body">
                    @forelse($activities as $activity)
                        <tr data-row="0" class="datatable-row" style="left: 0px;">
                            <td class="datatable-cell" style="width: 10%"><span>{{$activity['fiscal_year']}}</span></td>
                            <td class="datatable-cell" style="width: 20%"><span>{{$activity['outcome_count']}}</span>
                            </td>
                            <td class="datatable-cell" style="width: 20%"><span>{{$activity['output_count']}}</span>
                            </td>
                            <td class="datatable-cell" style="width: 20%"><span>{{$activity['activity_count']}}</span>
                            </td>
                            <td class="datatable-cell" style="width: 20%"><span>{{$activity['milestone_count']}}</span>
                            </td>

                            <td class="datatable-cell" style="width: 5%">
                                <a href="javascript:;"
                                   data-url="{{route('audit.plan.operational.activity.single')}}"
                                   class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_view_audit_annual_activity">
                                    <i class="fas fa-eye"></i>
                                </a>
>>>>>>> df30d91ca66d3c60e6622520815ea018216ba725
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center"><span>2021-2022</span></td>
                            <td class="text-center"><span>2</span></td>
                            <td class="text-center"><span>2</span></td>
                            <td class="text-center"><span>32</span></td>
                            <td class="text-center"><span>66</span></td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="javascript:;" data-url="{{route('audit.plan.operational.activity.single')}}" class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_view_audit_annual_activity">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="javascript:;" data-url="{{route('audit.plan.operational.activity.edit')}}" class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_edit_audit_annual_activity">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
<<<<<<< HEAD
=======
                    @empty
                        <tr>
                            <td colspan="7" class="text-center"> No Data Found</td>
                        </tr>
                    @endforelse

>>>>>>> df30d91ca66d3c60e6622520815ea018216ba725
                    </tbody>
                </table>
            </div>
            <!--end::Table-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Advance Table Widget 4-->
</div>

@include('scripts.script_audit_plan_operational_activity')
