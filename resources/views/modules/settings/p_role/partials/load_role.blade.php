<!--begin::Table-->
<div class="table-responsive">
    <table class="table table-striped" width="100%">
        <thead class="thead-light">
        <tr>
            <th width="20%" class="text-left">Role Name</th>
            <th width="50%" class="text-left">Role Description</th>
            <th width="10%" class="text-left">User Level</th>
            <th width="20%" class="text-left" width="10%">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($allRole['data'] as $role)
            <tr>
                <td>{{$role['role_name_en']}}</td>
                <td>{{$role['description_en']}}</td>
                @if($role['user_level'] == 1)
                    <td>Super Admin</td>
                @elseif($role['user_level'] == 3)
                    <td>User</td>
                @endif
                <td>
                    <div class="btn-group btn-group-sm" role="group">
                        <button title="হালনাগাদ করুন"
                                class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"
                                data-role-id="{{$role['id']}}"
                                onclick="Role_Container.editRole($(this))">
                            <i class="fad fa-edit"></i>
                        </button>

                        <button title="এসাইন করুন"
                                class="btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-warning"
                                data-role-id="{{$role['id']}}"
                                data-role-name-en="{{$role['role_name_en']}}"
                                onclick="Role_Container.loadMasterDesignationAssignCreateForm($(this))">
                            <i class="fad fa-users"></i>
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!--end::Table-->

