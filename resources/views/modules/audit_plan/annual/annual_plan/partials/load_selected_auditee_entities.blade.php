<form id="selected_rp_auditee_form">
    <div class="datatable datatable-default datatable-bordered datatable-loaded border">
        <table class="datatable-bordered datatable-head-custom datatable-table selected_rp_auditees_table" id=""
               style="display: block;">
            <thead class="datatable-head">
            <tr class="datatable-row" style="left: 0px;">
                <th class="datatable-cell datatable-cell-sort">Entity Name</th>
                <th class="datatable-cell datatable-cell-sort">Staffs</th>
                <th class="datatable-cell datatable-cell-sort">Schedule</th>
                <th class="datatable-cell datatable-cell-sort">Budget</th>
                <th class="datatable-cell datatable-cell-sort">Plan</th>
            </tr>
            </thead>
            <tbody style="" class="datatable-body">
            @foreach($entities as $entity)
                <tr data-row="{{$loop->iteration}}" class="datatable-row" style="left: 0px;">
                    <td class="datatable-cell">{{$entity['party_name_en']}}</td>
                    <td class="datatable-cell">{{$entity['staff_count']}}</td>
                    <td class="datatable-cell">{{$entity['task_end_date_plan']}}</td>
                    <td class="datatable-cell">{{$entity['budget']}}</td>
                    <td class="datatable-cell">
                        <button data-entity-id="{{$entity['party_id']}}"
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
