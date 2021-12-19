<!--begin::Aside Menu-->
<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <x-menu-module-name>{{session('_module_menus')['module']['title_en']}}</x-menu-module-name>
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
         data-menu-dropdown-timeout="500">
        <ul class="menu-nav">
            {{--menu-item-active--}}
            @foreach(session('_module_menus')['menus'] as $menu)
                <x-menu-item class="{{$menu['class']}}" href="{{url($menu['link'])}}"
                             icon="{{$menu['icon']}}">
                    {{$menu['title_en']}}
                </x-menu-item>
            @endforeach
        </ul>
    </div>
    <!--end::Menu Container-->
</div>
<!--end::Aside Menu-->
