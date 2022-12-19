@forelse($auditPlan['work_papers'] as $workPaper)
    <tr id="row_{{$workPaper['id']}}" data-row="{{$loop->iteration}}">
        <td>{{ ucfirst($workPaper['title']) }}</td>
        
        <td> 
            {{ (ucfirst($auditPlan['yearly_plan_location']['project_name_en']) ?? ucfirst($auditPlan['yearly_plan_location']['function_name_en']) ?? ucfirst($auditPlan['yearly_plan_location']['cost_center_en'])).' (Plan-'.$auditPlan['id'].')' }}
        </td>

        <td>
            <button type="button" class="btn btn-download btn-sm btn-bold btn-square ml-auto" onclick="Entity_Plan_Container.downloadAnnouncementModal(1)">
                <i class="fa fa-file" aria-hidden="true"></i>
                Download
            </button>
        </td>
    </tr>
@empty
    <tr data-row="0" class="datatable-row" style="left: 0px;">
        <td colspan="3" class="datatable-cell text-danger text-center"><span>No Workpaper Found</span></td>
    </tr>
@endforelse
    