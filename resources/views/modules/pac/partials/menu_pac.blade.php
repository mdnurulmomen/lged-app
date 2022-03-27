<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <x-menu-module-name>PAC MODULE</x-menu-module-name>
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
         data-menu-dropdown-timeout="500">
        <ul class="menu-nav">
            <x-menu-item class="pac-meeting-link" href="{{url('pac/pac-meeting/meeting')}}"
                         icon="fal fa-calendar-alt">Meetings
            </x-menu-item>
            <x-menu-item class="pac-meeting-link" href="{{url('pac/pac-meeting/worksheet')}}"
                         icon="fal fa-calendar-alt">Meeting Worksheet
            </x-menu-item>
            <x-menu-item class="pac-meeting-link" href="{{url('pac/pac-meeting/minutes')}}"
                         icon="fal fa-calendar-alt">Meeting Minutes
            </x-menu-item>
        </ul>
    </div>
</div>
