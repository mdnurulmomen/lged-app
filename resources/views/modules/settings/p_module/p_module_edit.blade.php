<form autocomplete="off" id="module_update_form">
    <input type="hidden" name="menu_module_id" value="{{$moduleInfo['id']}}">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="module_name_en">Module Name En<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="module_name_en" name="module_name_en"
                       value="{{$moduleInfo['module_name_en']}}"
                       placeholder="Enter module name en">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="module_name_bn">Module Name Bn<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="module_name_bn" name="module_name_bn"
                       value="{{$moduleInfo['module_name_bn']}}"
                       placeholder="Enter module name bn">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="parent_module_id">Module Parent</label>
                <select class="form-control select-select2" id="parent_module_id" name="parent_module_id">
                    <option value="">Select</option>
                    @foreach($moduleList as $module)
                        <option value="{{$module['id']}}" {{$moduleInfo['parent_module_id'] == $module['id']?'selected':''}}>
                            {{$module['module_name_en']}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="module_link">Module Link</label>
                <input class="form-control" type="text" id="module_link" name="module_link"
                       value="{{$moduleInfo['module_link']}}"
                       placeholder="Enter module link">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="module_controller">Module Controller</label>
                <input class="form-control" type="text" id="module_controller" name="module_controller"
                       value="{{$moduleInfo['module_controller']}}"
                       placeholder="Enter module controller">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="module_method">Module Method</label>
                <input class="form-control" type="text" id="module_method" name="module_method"
                       value="{{$moduleInfo['module_method']}}"
                       placeholder="Enter module method">
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="module_class">Module Class</label>
                <input class="form-control" type="text" id="module_class" name="module_class"
                       value="{{$moduleInfo['module_class']}}"
                       placeholder="Enter module class">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="module_icon">Module Icon</label>
                <input class="form-control" type="text" id="module_icon" name="module_icon"
                       value="{{$moduleInfo['module_icon']}}"
                       placeholder="Enter module icon">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="display_order">Display Order<span class="text-danger">*</span></label>
                <input class="form-control integer_type_positive" type="text" id="display_order" name="display_order"
                       value="{{$moduleInfo['display_order']}}"
                       placeholder="Enter display order">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="is_other_module">Other Module</label>
                <select class="form-control select-select2" id="is_other_module" name="is_other_module">
                    <option value="1" {{$moduleInfo['is_other_module'] == 1?'selected':''}}>Yes</option>
                    <option value="0" {{$moduleInfo['is_other_module'] == 0?'selected':''}}>No</option>
                </select>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <a href="javascript:;" role="button" onclick="Module_Edit_Container.updateModule()"
           class="btn btn-primary btn-sm btn-square btn-forward">
            <i class="fa fa-save"></i>
            Update
        </a>
    </div>
</form>

<script>
    var Module_Edit_Container ={
        updateModule: function () {
            url = '{{route('settings.module-menus.update')}}';
            data = $('#module_update_form').serialize();
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'success') {
                    toastr.success('Successfully module has been updated');
                    $('#kt_quick_panel_close').click();
                    Module_Container.loadModuleList();
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
