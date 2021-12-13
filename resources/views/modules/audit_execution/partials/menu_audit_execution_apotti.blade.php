<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <x-menu-module-name>Annual Plan</x-menu-module-name>
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
         data-menu-dropdown-timeout="500">
        <!--begin::Menu Nav-->
        <ul class="menu-nav">
            <x-menu-item class="menu-item-active" href="#"
                         icon="fal fa-tachometer-alt-average">Dashboard
            </x-menu-item>
            <hr>
            <x-menu-item class="apotti_menue" href="{{route('audit.execution.apotti.index')}}"
                         icon="fal fa-list">Apotti
            </x-menu-item>

        </ul>
        <!--end::Menu Nav-->
    </div>
    <!--end::Menu Container-->
</div>
