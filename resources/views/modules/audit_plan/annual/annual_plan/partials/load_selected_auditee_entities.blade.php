<form id="selected_rp_auditee_form">
    <div class="datatable datatable-default datatable-bordered datatable-loaded border">
        <table class="datatable-bordered datatable-head-custom datatable-table selected_rp_auditees_table" id=""
               style="display: block;">
            <thead class="datatable-head">
            <tr class="datatable-row" style="left: 0px;">
                <th width="50%" class="datatable-cell datatable-cell-sort">Entity Name</th>
                <th width="5%" class="datatable-cell datatable-cell-sort">Staffs</th>
                <th width="30%" class="datatable-cell datatable-cell-sort">Schedule</th>
                <th width="5%" class="datatable-cell datatable-cell-sort">Budget</th>
                <th width="10%" class="datatable-cell datatable-cell-sort">Plan</th>
            </tr>
            </thead>
            <tbody style="" class="datatable-body">
            @foreach($entities as $entity)
                <tr data-row="{{$loop->iteration}}" class="datatable-row" style="left: 0px;">
                    <td width="50%" class="datatable-cell">{{$entity['party_name_en']}}</td>
                    <td width="5%" class="datatable-cell">{{$entity['staff_count']}}</td>
                    <td width="30%" class="datatable-cell">{{$entity['task_end_date_plan']}}</td>
                    <td width="5%" class="datatable-cell">{{$entity['budget']}}</td>
                    <td width="10%" class="datatable-cell">
                        <button data-plan-responsible-party-id="{{$entity['id']}}"
                                type="button"
                                class="btn btn-primary font-weight-bold btn-square"
                                onclick="Annual_Plan_Container.loadSubmissionHRModal($(this))">Plan
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <button type="button" class="btn btn-primary font-weight-bold btn-square"
            onclick="Annual_Plan_Container.submitSelectedEntities()">Save
    </button>

</form>
