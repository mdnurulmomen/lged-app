<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-light">
            <tr>
                <th class="align-middle">Observation no</th>
                <th>Ministry</th>
                <th>Parent office</th>
                <th>Observation title</th>
                <th>Type</th>
                <th>Initiation date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($observations['data'] as $observation)                        
            <tr>
                <td><span>{{ $observation['observation_no'] }}</span></td>
                <td><span>{{ $observation['ministry_id'] }}</span></td>
                <td><span>{{ $observation['parent_office_id'] }}</span></td>
                <td><span>{{ $observation['observation_en'] }}</span></td>
                <td><span>{{ $observation['observation_type'] }}</span></td>
                <td><span>{{ $observation['initiation_date'] }}</span></td>
                <td><span>{{ $observation['status'] }}</span></td>
                <td>
                    <div class="btn-group">
                        <a href="javascript:;" onclick="loadPage('{{ route('audit.followup.observation.show', $observation['id'])}}')" class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_view_audit_annual_activity">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="javascript:;" onclick="loadPage('{{ route('audit.followup.observation.edit', $observation['id'])}}')" class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="javascript:;" onclick="deleteObservation('{{ route('audit.followup.observation.delete', $observation['id'])}}')" class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-danger btn_edit_audit_annual_activity">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <td colspan="9" class="text-center"><span>No data found.</span></td>
            @endforelse
        </tbody>
    </table>
</div>