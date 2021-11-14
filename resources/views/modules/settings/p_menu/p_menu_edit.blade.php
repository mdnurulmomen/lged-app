<form autocomplete="off" id="menu_create_form">
    <input type="hidden" name="menu_id" value="{{$menuInfo['id']}}">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="menu_name_en">Menu Name En<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="menu_name_en" name="menu_name_en"
                       value="{{$menuInfo['menu_name_en']}}"
                       placeholder="Enter menu name en">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="menu_name_bn">Menu Name Bn<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="menu_name_bn" name="menu_name_bn"
                       value="{{$menuInfo['menu_name_bn']}}"
                       placeholder="Enter menu name bn">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="module_menu_id">Module<span class="text-danger">*</span></label>
                <select class="form-control select-select2" name="module_menu_id">
                    <option value="">Select</option>
                    @foreach($moduleList as $module)
                        <option value="{{$module['id']}}" {{$menuInfo['module_menu_id'] == $module['id']?'selected':''}}>
                            {{$module['module_name_en']}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="parent_menu_id">Menu Parent</label>
                <select class="form-control select-select2" name="parent_menu_id">
                    <option value="">Select</option>
                    @foreach($menuList as $menu)
                        <option value="{{$menu['id']}}" {{$menuInfo['parent_menu_id'] == $menu['id']?'selected':''}}>
                            {{$menu['menu_name_en']}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="menu_class">Menu Class</label>
                <input class="form-control" type="text" id="menu_class" name="menu_class"
                       value="{{$menuInfo['menu_class']}}"
                       placeholder="Enter menu class">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="menu_link">Menu Link</label>
                <input class="form-control" type="text" id="menu_link" name="menu_link"
                       value="{{$menuInfo['menu_link']}}"
                       placeholder="Enter menu link">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="menu_icon">Menu Icon</label>
                <input class="form-control" type="text" id="menu_icon" name="menu_icon"
                       value="{{$menuInfo['menu_icon']}}"
                       placeholder="Enter menu icon">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="display_order">Display Order</label>
                <input class="form-control integer_type_positive" type="text" id="display_order" name="display_order"
                       value="{{$menuInfo['display_order']}}"
                       placeholder="Enter display order">
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <a href="javascript:;" role="button" onclick="Menu_Edit_Container.updateMenu()"
           class="btn btn-primary btn-sm btn-square btn-forward">
            <i class="fa fa-save"></i>
            Update
        </a>
    </div>
</form>

<script>
    var Menu_Edit_Container ={
        updateMenu: function () {
            url = '{{route('settings.menus.update')}}';
            data = $('#menu_create_form').serialize();
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'success') {
                    toastr.success('Successfully menu has been saved');
                    $('#kt_quick_panel_close').click();
                    Menu_Container.loadMenuList();
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
