<form autocomplete="off" id="menu_action_update_form">
    <input type="hidden" name="menu_action_id" value="{{$menuActionInfo['id']}}">
    <input type="hidden" name="type" value="{{$type}}" id="pageType">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="title_en">Name En<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="title_en" name="title_en"
                       value="{{$menuActionInfo['title_en']}}"
                       placeholder="Enter name en">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="title_bn">Name Bn<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="title_bn" name="title_bn"
                       value="{{$menuActionInfo['title_bn']}}"
                       placeholder="Enter name bn">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="link">Link</label>
                <input class="form-control" type="text" id="link" name="link"
                       value="{{$menuActionInfo['link']}}"
                       placeholder="Enter link">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="activity_type">Activity Type<span class="text-danger">*</span></label>
                <select name="activity_type" id="activity_type" class="form-control select-select2">
                    <option value="all" @if($menuActionInfo['activity_type'] == 'all') selected @endif> All </option>
                    <option value="compliance" @if($menuActionInfo['activity_type'] == 'compliance') selected @endif> Compliance </option>
                    <option value="performance" @if($menuActionInfo['activity_type'] == 'performance') selected @endif> Performance</option>
                    <option value="financial" @if($menuActionInfo['activity_type'] == 'financial') selected @endif> Financial </option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="class">Class</label>
                <input class="form-control" type="text" id="class" name="class"
                       value="{{$menuActionInfo['class']}}"
                       placeholder="Enter class">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="icon">Icon</label>
                <input class="form-control" type="text" id="icon" name="icon"
                       value="{{$menuActionInfo['icon']}}"
                       placeholder="Enter icon">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="display_order">Display Order<span class="text-danger">*</span></label>
                <input class="form-control integer_type_positive" type="text" id="display_order" name="display_order"
                       value="{{$menuActionInfo['display_order']}}"
                       placeholder="Enter display order">
            </div>
        </div>
    </div>

    @if($type == 'module')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="is_other_module">Other Module</label>
                    <select class="form-control select-select2" id="is_other_module" name="is_other_module">
                        <option value="1" {{$menuActionInfo['is_other_module'] == 1?'selected':''}}>Yes</option>
                        <option value="0" {{$menuActionInfo['is_other_module'] == 0?'selected':''}}>No</option>
                    </select>
                </div>
            </div>
        </div>
    @endif

    @if(!empty($moduleList))
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="menu_module_id">Module</label>
                    <select class="form-control select-select2" name="menu_module_id" id="menu_module_id">
                        <option value="">Select</option>
                        @foreach($moduleList as $module)
                            <option value="{{$module['id']}}"
                                {{$module['id'] == $menuActionInfo['menu_module_id']?'selected':''}}>
                                {{$module['title_bn']}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                @php $parentOrMenuId = $type == 'action'?$menuActionInfo['action_menu_id']:$menuActionInfo['parent_id']; @endphp
                <label for="parent_id">{{$type == 'action'?'Menu':'Parent'}}</label>
                <select class="form-control select-select2" name="parent_id" id="parent_id">
                    <option value="">Select</option>
                    @foreach($menuActionList as $menuAction)
                        <option value="{{$menuAction['id']}}" {{$menuAction['id']==$parentOrMenuId?'selected':''}}>
                            {{$menuAction['title_bn']}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="status" id="status"
                        {{$menuActionInfo['status'] == 1?'checked':''}}>
                    <label class="form-check-label" for="status">Status</label>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <a href="javascript:;" role="button" onclick="Menu_Action_Container.updateMenuAction()"
           class="btn btn-primary btn-sm btn-square btn-forward">
            <i class="fa fa-save"></i>
            Update
        </a>
    </div>
</form>
