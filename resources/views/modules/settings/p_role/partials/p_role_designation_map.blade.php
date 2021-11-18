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
