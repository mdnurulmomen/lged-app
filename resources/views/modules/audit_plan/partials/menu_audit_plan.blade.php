<!--begin::Aside Menu-->
<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <x-menu-module-name>Audit Plan</x-menu-module-name>
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
         data-menu-dropdown-timeout="500">
        <ul class="menu-nav">
            <x-menu-item class="menu-item-active" href="{{route('audit.plan.audit.dashboard')}}"
                         icon="fal fa-tachometer-alt-average">Dashboard
            </x-menu-item>
            <hr>
            <x-menu-item class="" href="{{route('audit.plan.audit.plan.all')}}"
                         icon="fab fa-firstdraft">Plan
            </x-menu-item>
            <x-menu-item class="" href="{{route('audit.plan.audit.plan.all')}}"
                         icon="fad fa-mail-bulk">Engagement Letter
            </x-menu-item>
            <x-menu-item class="" href="{{route('audit.plan.audit.office-orders.index')}}"
                         icon="fad fa-mailbox">Office Order
            </x-menu-item>
        </ul>
    </div>
    <!--end::Menu Container-->
</div>
<!--end::Aside Menu-->
