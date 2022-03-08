<x-title-wrapper>Audit Activities</x-title-wrapper>

<div class="card sna-card-border mt-3" style="margin-bottom:15px;">
    <div class="d-flex justify-content-end">
        <a href="javascript:;"
           onclick="Audit_Activities_Container.createAnnualActivity($(this))"
           class="font-weight-bolder font-size-sm mr-3 btn btn-success btn-sm btn-bold btn-square btn_create_audit_activity"
           data-url="{{route('audit.plan.operational.activity.create')}}">
            <i class="far fa-plus mr-1"></i> Create Annual Audit Activity
        </a>
    </div>
</div>

<div class="card sna-card-border mt-3" style="margin-bottom:30px;">
    <div class="table-responsive datatable datatable-default datatable-bordered datatable-loaded">

        <table class="table" id="kt_datatable"
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

                <th colspan="2" class="datatable-cell datatable-cell-sort" style="width: 5%">
                    Action
                </th>
            </tr>
            </thead>
            <tbody style="" class="">
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
                           onclick="Audit_Activities_Container.showAnnualActivity($(this))"
                           data-fiscal-year-id="{{$activity['fiscal_year_id']}}"
                           data-url="{{route('audit.plan.operational.activity.single')}}"
                           class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger
                                btn-icon-primary btn_view_audit_annual_activity">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                    <td class="datatable-cell" style="width: 5%">
                        <a href="javascript:;" onclick="Audit_Activities_Container.editAnnualActivity($(this))"
                           data-fiscal-year-id="{{$activity['fiscal_year_id']}}"
                           data-url="{{route('audit.plan.operational.activity.edit')}}"
                           class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_edit_audit_annual_activity">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center"> No Data Found</td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>
</div>


@include('scripts.script_audit_plan_operational_activity')
