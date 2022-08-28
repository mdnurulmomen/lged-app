<form autocomplete="off" id="master_designation_role_map_form">
    <input type="hidden" name="role_id" value="{{$roleId}}">
    <div class="row">
        <div class="col-md-12">
            <fieldset class="scheduler-border">
                <legend class="scheduler-border">
                    Master Designation
                </legend>
                @foreach($masterDesignationList as $designation)
                    <div class="row">
                        <div class="col-md-12 pl-0 text-capitalize">
                            <label>
                                <input name="master_designation[]" type="checkbox" value="{{$designation['id']}}">
                                <span class="pl-2">{{$designation['designation_name_eng']}}</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </fieldset>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <a onclick="Role_Container.storeMasterDesignationRoleMap()" href="javascript:;" role="button"
           class="btn btn-primary btn-sm btn-square btn-forward">
            <i class="fa fa-save"></i>
            Save
        </a>
    </div>
</form>

<script>
    $(function () {
        Role_Container.loadAssignedMasterDesignationRoleMap("{{$roleId}}");
    })
</script>
