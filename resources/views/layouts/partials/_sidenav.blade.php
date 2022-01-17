<!--begin::Aside Menu-->
<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <x-menu-module-name>{{session('_module_menus')['module']['title_en']}}</x-menu-module-name>
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
         data-menu-dropdown-timeout="500">
        <ul class="menu-nav">
            {{--menu-item-active--}}

            @foreach(session('_module_menus')['menus'] as $menu)
                @if($menu['link'])
                    <x-menu-item class="{{$menu['class']}}" href="{{ url($menu['link'])}}"
                                 icon="{{$menu['icon']}}">
                        {{$menu['title_en']}}
                    </x-menu-item>
                @else
                    <x-parent-menu-item icon="{{$menu['icon']}}" name="{{$menu['title_en']}}">
                        @foreach($menu['menu_childrens'] as $menu_child)
                            <x-menu-item class="{{$menu_child['class']}}" href="{{ url($menu_child['link'])}}"
                                         icon="{{$menu_child['icon']}}">
                                {{$menu_child['title_en']}}
                            </x-menu-item>
                        @endforeach
                    </x-parent-menu-item>
                @endif
            @endforeach
        </ul>
    </div>
    <!--end::Menu Container-->
</div>
<!--end::Aside Menu-->
