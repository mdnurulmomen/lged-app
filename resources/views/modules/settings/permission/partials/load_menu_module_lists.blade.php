<form id="menuAssignForm">
    @foreach ($module_menus as $module)
        <div class="col-md-12 pl-0 text-capitalize">
            <label>
                <input name="modules[]"
                       type="checkbox"
                       data-type="module"
                       value="{{$module['id']}}"
                       class="parent_module" id="parent_{{$module['id']}}"><span
                    class="pl-2">{{$module['module_name_en']}}</span> <span class="badge badge-info p-1">Module</span>
            </label>
            @if(!empty($module['children']))
                @include('modules.settings.permission.partials.load_menu_module_child_lists',['module_children' => $module['children'], 'type' => 'module'])
            @endif
            @foreach($module['menus'] as $menu)
                <div class="col-md-12 pl-4 text-capitalize">
                    <label>
                        <input name="menus[]"
                               data-type="menu"
                               type="checkbox"
                               value="{{$menu['id']}}"
                               class="parent_menu" id="parent_{{$menu['id']}}"> <span
                            class="pl-2">{{$menu['menu_name_en']}} </span><span
                            class="badge badge-primary p-1">Menu</span>
                    </label>
                    @if(!empty($menu['children']))
                        @include('modules.settings.permission.partials.load_menu_module_child_lists',['menu_children' => $menu['children'], 'type' => 'menu'])
                    @endif
                </div>
            @endforeach
        </div>
    @endforeach
</form>
