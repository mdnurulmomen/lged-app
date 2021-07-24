<!--begin::Aside Menu-->
<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <x-menu-module-name>Operational Plan</x-menu-module-name>
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
         data-menu-dropdown-timeout="500">
        <ul class="menu-nav">
            <x-menu-item class="menu-item-active" href="{{route('audit.plan.operational.dashboard')}}"
                         icon="fal fa-tachometer-alt-average">Dashboard
            </x-menu-item>
            <hr>
            <x-menu-item class="" href="{{route('audit.plan.operational.activity.all')}}"
                         icon="fab fa-firstdraft">Audit Activities
            </x-menu-item>

            <x-menu-item class="" href="{{route('audit.plan.operational.calendars.index')}}" icon="far fa-calendar ">
                Audit
                Calendar
            </x-menu-item>

            <x-menu-item class="" href="{{route('audit.plan.operational.plan.all')}}"
                         icon="fas fa-bullseye-arrow">
                Operational Plan
            </x-menu-item>
        </ul>
    </div>
    <!--end::Menu Container-->
</div>
<!--end::Aside Menu-->
