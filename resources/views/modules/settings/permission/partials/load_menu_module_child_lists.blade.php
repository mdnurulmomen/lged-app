<div class="col-md-12 pl-4 text-capitalize">
    @if($type == 'module')
        @foreach ($module_children as $module) {
        <div class="col-md-12 pl-0 text-capitalize">
            <label>
                <input data-type="module" name="modules[]"
                       type="checkbox"
                       value="{{$module['id']}}"
                       class="child_module" id="child_{{$module['id']}}"> <span
                    class="pl-2">{{$module['module_name_en']}}</span> <span class="badge badge-info p-1">Module</span>
            </label>
            @if(!empty($module['children']))
                @include('modules.settings.permission.partials.load_menu_module_child_lists',['children' => $module['children'], 'type' => 'module'])
            @endif
            @foreach($module['menus'] as $menu)
                <label>
                    <input name="menus[]"
                           data-type="menu"
                           type="checkbox"
                           value="{{$menu['id']}}"
                           class="child_menu" id="child_{{$menu['id']}}"> <span
                        class="pl-2">{{$menu['menu_name_en']}}</span> <span class="badge badge-info p-1">Menu</span>
                </label>
                @if(!empty($menu['children']))
                    @include('modules.settings.permission.partials.load_menu_module_child_lists',['children' => $menu['children'], 'type' => 'menu'])
                @endif
            @endforeach
        </div>
        @endforeach
    @endif
    @if($type == 'menu')
        @foreach($menu_children as $menu)
            <label>
                <input name="menus[]"
                       type="checkbox"
                       data-type="menu"
                       value="{{$menu['id']}}"
                       class="child_menu" id="child_{{$menu['id']}}"> <span
                    class="pl-2">{{$menu['menu_name_en']}}</span> <span class="badge badge-info p-1">Menu</span>
            </label>
            @if(!empty($menu['children']))
                @include('modules.settings.permission.partials.load_menu_module_child_lists',['children' => $menu['children'], 'type' => 'menu'])
            @endif
        @endforeach
    @endif
</div>
