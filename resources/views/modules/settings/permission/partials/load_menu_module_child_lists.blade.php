<div class="col-md-12 pl-4 text-capitalize">
    @if($type == 'module')
        @foreach ($module_childrens as $module)
            <div class="col-md-12 pl-0 text-capitalize">
                <label>
                    <input data-type="module"
                           name="modules[]"
                           type="checkbox"
                           value="{{$module['id']}}"
                           class="child_module" id="child_{{$module['id']}}"> <span
                        class="pl-2">{{$module['title_en']}}</span> <span class="badge badge-info p-1">Module</span>
                </label>
                @if(!empty($module['module_childrens']))
                    @include('modules.settings.permission.partials.load_menu_module_child_lists',['module_childrens' => $module['module_childrens'], 'type' => 'module'])
                @endif
                @foreach($module['menus'] as $menu)
                    <div class="col-md-12 pl-8 text-capitalize">
                        <label>
                            <input name="menus[]"
                                   data-type="menu"
                                   type="checkbox"
                                   value="{{$menu['id']}}"
                                   class="child_menu" id="child_{{$menu['id']}}"> <span
                                class="pl-2">{{$menu['title_en']}}</span> <span
                                class="badge badge-primary p-1">Menu</span>
                        </label>
                    </div>
                    @if(!empty($menu['menu_childrens']))
                        @include('modules.settings.permission.partials.load_menu_module_child_lists',['menu_childrens' => $menu['menu_childrens'], 'type' => 'menu'])
                    @endif
                    @foreach($menu['menu_actions'] as $menu_action)
                        <div class="col-md-12 pl-10 text-capitalize">
                            <label>
                                <input name="menu_actions[]"
                                       data-type="menu_action"
                                       type="checkbox"
                                       value="{{$menu_action['id']}}"
                                       class="child_menu" id="child_{{$menu_action['id']}}"> <span
                                    class="pl-2">{{$menu_action['title_en']}}</span> <span
                                    class="badge badge-warning p-1">Action</span>
                            </label>
                        </div>
                        @if(!empty($menu_action['menu_action_childrens']))
                            @include('modules.settings.permission.partials.load_menu_module_child_lists',['menu_action_childrens' => $menu_action['menu_action_childrens'], 'type' => 'action'])
                        @endif
                    @endforeach
                @endforeach
            </div>
        @endforeach
    @endif
    @if($type == 'menu')
        @foreach($menu_childrens as $menu)
            <label>
                <input name="menus[]"
                       type="checkbox"
                       data-type="menu"
                       value="{{$menu['id']}}"
                       class="child_menu" id="child_{{$menu['id']}}"> <span
                    class="pl-2">{{$menu['title_en']}}</span> <span class="badge badge-primary p-1">Menu</span>
            </label>
            @if(!empty($menu['children']))
                @include('modules.settings.permission.partials.load_menu_module_child_lists',['menu_childrens' => $menu['children'], 'type' => 'menu'])
            @endif
            @foreach($menu['menu_actions'] as $menu_action)
                <label>
                    <input name="menu_actions[]"
                           data-type="menu_action"
                           type="checkbox"
                           value="{{$menu_action['id']}}"
                           class="child_menu" id="child_{{$menu_action['id']}}"> <span
                        class="pl-2">{{$menu_action['title_en']}}</span> <span
                        class="badge badge-warning p-1">Action</span>
                </label>
                @if(!empty($menu_action['menu_action_childrens']))
                    @include('modules.settings.permission.partials.load_menu_module_child_lists',['menu_action_childrens' => $menu_action['menu_action_childrens'], 'type' => 'action'])
                @endif
            @endforeach
        @endforeach
    @endif
    @if($type == 'action')
        @foreach($menu_action_childrens as $menu_action)
            <label>
                <input name="menu_actions[]"
                       type="checkbox"
                       data-type="menu_action"
                       value="{{$menu_action['id']}}"
                       class="child_menu" id="child_{{$menu_action['id']}}"> <span
                    class="pl-2">{{$menu_action['title_en']}}</span> <span class="badge badge-warning p-1">Action</span>
            </label>
            @if(!empty($menu_action['children']))
                @include('modules.settings.permission.partials.load_menu_module_child_lists',['menu_action_childrens' => $menu_action['children'], 'type' => 'menu'])
            @endif
        @endforeach
    @endif
</div>
