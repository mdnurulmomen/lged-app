<x-title-wrapper>Audit Activities</x-title-wrapper>
<div class="col-lg-12">
    <!--begin::Advance Table Widget 4-->
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0 py-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark"></span>
            </h3>
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
            <div class="table-responsive datatable datatable-default datatable-bordered datatable-loaded">

                <table class="datatable-bordered datatable-head-custom datatable-table"
                       id="kt_datatable"
                       style="display: block;">

                    <thead class="datatable-head">
                    <tr class="datatable-row" style="left: 0px;">
                        <th class="datatable-cell datatable-cell-sort" style="width: 10%">
                            Fiscal Year
                        </th>

                        <th class="datatable-cell datatable-cell-sort" style="width: 20%">
                            Strategic Outcome Count
                        </th>

                        <th class="datatable-cell datatable-cell-sort" style="width: 20%">
                            Strategic Output Count
                        </th>

                        <th class="datatable-cell datatable-cell-sort" style="width: 20%">
                            Activities Count
                        </th>

                        <th class="datatable-cell datatable-cell-sort" style="width: 20%">
                            Milestone Count
                        </th>

                        <th class="datatable-cell datatable-cell-sort" style="width: 5%">
                            <i class="fas fa-eye"></i></th>

                        <th class="datatable-cell datatable-cell-sort text-center" style="width: 5%">
                            <i class="fas fa-edit"></i>
                        </th>
                    </tr>
                    </thead>
                    <tbody style="" class="datatable-body">
{{--                    @forelse($activities as $activity)--}}
                        <tr data-row="0" class="datatable-row" style="left: 0px;">
                            <td class="datatable-cell" style="width: 10%"><span>FY 2021-2022</span></td>
                            <td class="datatable-cell" style="width: 20%"><span>2</span></td>
                            <td class="datatable-cell" style="width: 20%"><span>2</span></td>
                            <td class="datatable-cell" style="width: 20%"><span>32</span></td>
                            <td class="datatable-cell" style="width: 20%"><span>66</span></td>

                            <td class="datatable-cell" style="width: 5%">
                                <a href="javascript:;"
                                   data-url="{{route('audit.plan.operational.activity.single')}}"
                                   class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_view_audit_annual_activity">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                            <td class="datatable-cell" style="width: 5%">
                                <a href="javascript:;"
                                   data-url="{{route('audit.plan.operational.activity.edit')}}"
                                   class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_edit_audit_annual_activity">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
{{--                    @empty--}}
{{--                        <tr>--}}
{{--                            <td colspan="7" class="text-center"> No Data Found</td>--}}
{{--                        </tr>--}}
{{--                    @endforelse--}}

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
