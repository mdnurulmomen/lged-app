<form autocomplete="off" id="role_update_form">
    <input type="hidden" name="role_id" value="{{$roleInfo['id']}}">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="role_name_en">Role Name En<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="role_name_en" name="role_name_en"
                       value="{{$roleInfo['role_name_en']}}"
                       placeholder="Enter role name en">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="role_name_bn">Role Name Bn<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="role_name_bn" name="role_name_bn"
                       value="{{$roleInfo['role_name_bn']}}"
                       placeholder="Enter role name bn">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="description_en">Role Description Bn<span class="text-danger">*</span></label>
                <textarea class="form-control" name="description_en" id="description_en" cols="30"
                          rows="3">{{$roleInfo['description_en']}}</textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="description_bn">Role Description En<span class="text-danger">*</span></label>
                <textarea class="form-control" name="description_bn" id="description_bn" cols="30"
                          rows="3">{{$roleInfo['description_bn']}}</textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="user_level">User Level<span class="text-danger">*</span></label>
                <div class="form-check form-check-inline">
                    <input @if($roleInfo['user_level'] == 1) checked @endif class="form-check-input" type="radio"
                           name="user_level" id="user_level_super_admin"
                           value="1">
                    <label class="form-check-label" for="user_level_super_admin">Super Admin</label>
                </div>
                <div class="form-check form-check-inline">
                    <input @if($roleInfo['user_level'] == 3) checked @endif class="form-check-input" type="radio"
                           name="user_level" id="user_level_user" value="3">
                    <label class="form-check-label" for="user_level_user">User</label>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <a href="javascript:;" role="button" onclick="Role_Container.updateRole()"
           class="btn btn-primary btn-sm btn-square btn-forward">
            <i class="fa fa-save"></i>
            Update
        </a>
    </div>
</form>
