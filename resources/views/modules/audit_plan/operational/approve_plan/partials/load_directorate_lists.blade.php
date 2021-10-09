{{--{{dd($allAuditDirectorates)}}--}}
<div class="table-responsive mb-4">
    <table class="table  table-striped">
        <thead class="bg-primary">
        <tr>
            <th class="text-light">Serial Number</th>
            <th class="text-light">Audit Directorate</th>
            <th class="text-light">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($allAuditDirectorates as $auditDirectorate)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    {{$auditDirectorate['office_name_bn']}}
                    <span class="badge badge-info text-uppercase m-1 p-1">pending</span>
                </td>
                <td>
                    <div class='btn-group btn-group-sm' role='group'>
                        <button
                            class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"
                            data-toggle="tooltip" data-placement="top" title="View Plan">
                            <i class="fad fa-eye"></i>
                        </button>

                        <button
                            class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-info"
                            onclick="Approve_Plan_List_Container.loadApproveOrRejectForm($(this))"
                            data-toggle="tooltip" data-placement="top" title="View Plan">
                            <i class="fad fa-check"></i>
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
