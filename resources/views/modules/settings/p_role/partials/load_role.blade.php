<!--begin::Table-->
<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-light">
        <tr>
            <th class="text-left">Role Name</th>
            <th class="text-left">Role Description</th>
            <th class="text-left">User Level</th>
            <th  class="text-left" width="10%">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($allRole['data'] as $role)
            <tr>
                <td>{{$role['role_name_en']}}</td>
                <td>{{$role['description_en']}}</td>
                <td>{{$role['user_level']}}</td>
                <td>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!--end::Table-->

