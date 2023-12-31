<!--begin::Aside Menu-->
<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <x-menu-module-name>MIS & Dashboard</x-menu-module-name>
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
         data-menu-dropdown-timeout="500">
        <!--begin::Menu Nav-->
        <ul class="menu-nav">
            <x-menu-item class="menu-item-active" href="{{route('mis_and_dashboard.rpu_list.index')}}"
                         icon="fad fa-building">RPU List
            </x-menu-item>
            <x-menu-item href="{{route('mis_and_dashboard.team_list.index')}}"
                         icon="fad fa-calendar-check">Team List
            </x-menu-item>
        </ul>
        <!--end::Menu Nav-->
    </div>
    <!--end::Menu Container-->
</div>
<!--end::Aside Menu-->
