<form autocomplete="off" id="role_update_form">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="master_designation_id">Master Designation<span class="text-danger">*</span></label>
                <select class="form-control select-select2" name="master_designation_id" id="master_designation_id">
                    <option value="0">Select</option>
                    @foreach($masterDesignationList as $designation)
                        <option value="{{$designation['id']}}">{{$designation['designation_name_eng']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="role_name_en">Role Name En<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="role_name_en" name="role_name_en"
                       placeholder="Enter role name en">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="role_name_bn">Role Name Bn<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="role_name_bn" name="role_name_bn"
                       placeholder="Enter role name bn">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="description_en">Role Description Bn<span class="text-danger">*</span></label>
                <textarea class="form-control" name="description_en" id="description_en" cols="30" rows="3"></textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="description_bn">Role Description En<span class="text-danger">*</span></label>
                <textarea class="form-control" name="description_bn" id="description_bn" cols="30" rows="3"></textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="user_level">User Level<span class="text-danger">*</span></label>
                <input class="form-control integer_type_positive" type="text" id="user_level" name="user_level"
                       placeholder="Enter user level">
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <a href="javascript:;" role="button" onclick="Role_Edit_Container.updateRole()"
           class="btn btn-primary btn-sm btn-square btn-forward">
            <i class="fa fa-save"></i>
            Save
        </a>
    </div>
</form>

<script>
    var Role_Edit_Container ={
        updateRole: function () {
            url = '{{route('settings.roles.store')}}';
            data = $('#role_update_form').serialize();
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'success') {
                    toastr.success('Successfully role has been saved');
                    $('#kt_quick_panel_close').click();
                    Role_Container.loadRoleList();
                }
                else {
                    if (response.statusCode === '422') {
                        var errors = response.msg;
                        $.each(errors, function (k, v) {
                            if (v !== '') {
                                toastr.error(v);
                            }
                        });
                    }
                    else {
                        toastr.error(response.data.message);
                    }
                }
            })
        },
    };
</script>
