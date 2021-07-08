<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <x-menu-module-name>Annual Plan</x-menu-module-name>
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
         data-menu-dropdown-timeout="500">
        <ul class="menu-nav">
            <x-menu-item class="menu-item-active" href="{{route('settings.dashboard')}}"
                         icon="fal fa-tachometer-alt-average">Dashboard
            </x-menu-item>
            <hr>
            <x-menu-item class="" href="{{route('settings.fiscal-years.index')}}"
                         icon="fal fa-calendar-alt">Fiscal Year
            </x-menu-item>

            <x-menu-item class="" href="{{route('settings.strategic-plan.duration.index')}}"
                         icon="fal fa-calendar-alt">Strategic Plan Duration
            </x-menu-item>
        </ul>
    </div>
</div>
