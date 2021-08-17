<x-title-wrapper>Communications</x-title-wrapper>

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
                            <th class="align-middle">Observation</th>
                            <th>Parent office</th>
                            <th>RP office</th>
                            <th>Communication Title</th>
                            <th>Communication To</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($communications['data'] as $communication)                        
                        <tr>
                            <td width="20%"><span>{{ $communication['observation']['observation_en'] }}</span></td>
                            <td><span>{{ $communication['parent_office_id'] }}</span></td>
                            <td><span>{{ $communication['rp_office_id'] }}</span></td>
                            <td width="20%"><span>{{ $communication['message_title'] }}</span></td>
                            <td><span>{{ $communication['sent_to'] }}</span></td>
                            <td>
                                <div class="btn-group">
                                    <a href="javascript:;" onclick="loadPage('{{ route('audit.followup.observation.show', $communication['id'])}}')" class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_view_audit_annual_activity">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="javascript:;" onclick="loadPage('{{ route('audit.followup.observation.edit', $communication['id'])}}')" class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="javascript:;" onclick="deleteObservation('{{ route('audit.followup.observation.delete', $communication['id'])}}')" class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-danger btn_edit_audit_annual_activity">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <td colspan="6" class="text-center"><span>No data found.</span></td>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!--end::Table-->
        </div>
    </div>
    <!--end::Advance Table Widget 4-->
</div>
<script>

    function deleteCommunication(url) {
        Swal.fire({
            title: 'Are you sure ?',
            showCancelButton: true,
            confirmButtonText: `Delete`,
        }).then((result) => {
            if (result.isConfirmed) {
                ajaxCallAsyncCallbackAPI(url, {}, 'GET', function (response) {
                    if (response.status === 'error') {
                        toastr.error('Error');
                    } else {
                        Swal.fire('Deleted!', '', 'success');
                        loadPage('{{ route('audit.followup.observation.lists') }}');
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('Canceled', '', 'info')
            }
        });
    }

    function loadPage(url){
        data = {};
        ajaxCallAsyncCallbackAPI(url, data, 'GET', function (response) {
            $('#kt_content').html(response);
        })
    }

</script>
    