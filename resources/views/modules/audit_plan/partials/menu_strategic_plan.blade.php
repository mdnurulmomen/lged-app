<!--begin::Aside Menu-->
<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <x-menu-module-name>Strategic Plan</x-menu-module-name>
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
         data-menu-dropdown-timeout="500">
        <ul class="menu-nav">
            <x-menu-item class="menu-item-active" href="{{route('audit.plan.strategy.draft_plan.all')}}"
                         icon="fab fa-firstdraft">Draft Plan
            </x-menu-item>

            <x-menu-item class="" href="{{route('audit.plan.strategy.meeting.all')}}" icon="far fa-handshake">Meeting
            </x-menu-item>

            <x-menu-item class="" href="{{route('audit.plan.strategy.final-plan.all')}}" icon="fas fa-bullseye-arrow">
                Final
                Plan
            </x-menu-item>

            <x-menu-item class="" href="{{route('audit.plan.strategy.milestone.all')}}" icon="fal fa-bullseye-pointer">
                Milestones
            </x-menu-item>

            <x-menu-item class="" href="{{route('audit.plan.strategy.risk.all')}}" icon="fal fa-exclamation-square">
                Risk List
            </x-menu-item>

        </ul>
    </div>
    <!--end::Menu Container-->
</div>
<!--end::Aside Menu-->
