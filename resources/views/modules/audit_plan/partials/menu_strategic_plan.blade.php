<!--begin::Aside Menu-->
<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <x-menu-module-name>Strategic Plan</x-menu-module-name>
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
         data-menu-dropdown-timeout="500">
        <ul class="menu-nav">
            <x-menu-item class="menu-item-active" href="{{route('audit.plan.strategy.dashboard')}}"
                         icon="fal fa-tachometer-alt-average">Dashboard
            </x-menu-item>
            <hr>
            {{--<x-menu-item class="" href="{{route('audit.plan.strategy.draft_plan.all')}}"
                         icon="fab fa-firstdraft">Draft Plan
            </x-menu-item>

            <x-menu-item class="" href="{{route('audit.plan.strategy.meeting.all')}}" icon="far fa-handshake">Meeting
            </x-menu-item>--}}

            {{--<x-menu-item class="" href="{{route('audit.plan.strategy.final-plan.all')}}" icon="fas fa-bullseye-arrow">
                Final
                Plan
            </x-menu-item>--}}

            <x-menu-item class="" href="{{route('audit.plan.strategy.sp_file_list')}}"
                         icon="fab fa-firstdraft">Final Strategic Plan
            </x-menu-item>

            {{--<x-menu-item class="" href="{{route('audit.plan.strategy.milestone.all')}}" icon="fal fa-bullseye-pointer">
                Milestones
            </x-menu-item>

            <x-menu-item class="" href="{{route('audit.plan.strategy.risk.all')}}" icon="fal fa-exclamation-square">
                Risk List
            </x-menu-item>--}}

            <x-menu-item class="" href="{{route('audit.plan.strategy.indicator.outcome')}}" icon="fal fa-exclamation-square">
                Outcome Indicator
            </x-menu-item>
            <x-menu-item class="" href="{{route('audit.plan.strategy.indicator.output')}}" icon="fal fa-exclamation-square">
                Output Indicator
            </x-menu-item>

            {{--<x-menu-item class="" href="{{route('audit.plan.strategy.setting_list')}}"
                         icon="fal fa-cogs">HTML View
            </x-menu-item>--}}

        </ul>
    </div>
    <!--end::Menu Container-->
</div>
<!--end::Aside Menu-->
