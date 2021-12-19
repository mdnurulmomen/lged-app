<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <x-menu-module-name>Audit Report QC</x-menu-module-name>
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
         data-menu-dropdown-timeout="500">
        <ul class="menu-nav">
            <x-menu-item class="menu-item-active" href="{{route('settings.dashboard')}}"
                         icon="fal fa-tachometer-alt-average">Dashboard
            </x-menu-item>
            <hr>
            <x-menu-item class="qac_1_menu" href="{{url('audit-qac/qac/qac-1')}}"
                         icon="fal fa-calendar-alt">QAC-1
            </x-menu-item>
            <x-menu-item class="qac_2_menu" href="{{url('audit-qac/qac/qac-2')}}"
                         icon="fal fa-calendar-alt">QAC-2
            </x-menu-item>
        </ul>
    </div>
</div>
