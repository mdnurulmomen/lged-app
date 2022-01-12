<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <x-menu-module-name>Audit Report QC</x-menu-module-name>
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
         data-menu-dropdown-timeout="500">
        <ul class="menu-nav">
            <x-parent-menu-item icon="far fa-list" name="QAC-1">
                <x-menu-item class="qac_1_menu" href="{{url('audit-qac/qac/qac-1')}}"
                             icon="fal fa-clipboard-list"> Apotti List
                </x-menu-item>

                <x-menu-item class="audit_query_schedule_menu" href="{{url('audit-report/air/qac1')}}"
                             icon="fal fa-tanakh"> Audit Inspection Report (AIR)
                </x-menu-item>
            </x-parent-menu-item>

            <x-parent-menu-item icon="far fa-list" name="QAC-2">
                <x-menu-item class="qac_2_menu" href="{{url('audit-qac/qac/qac-2')}}"
                             icon="fal fa-clipboard-list"> Apotti List
                </x-menu-item>

                <x-menu-item class="audit_query_schedule_menu" href="{{url('audit-report/air/qac2')}}"
                             icon="fal fa-tanakh"> Audit Inspection Report (AIR)
                </x-menu-item>
            </x-parent-menu-item>

            <x-parent-menu-item icon="far fa-list" name="CQAT">
                <x-menu-item class="qac_2_menu" href="{{url('audit-qac/qac/qac-3')}}"
                             icon="fal fa-clipboard-list"> Apotti List
                </x-menu-item>

                <x-menu-item class="audit_query_schedule_menu" href="{{url('audit-report/air/cqat')}}"
                             icon="fal fa-tanakh"> Audit Inspection Report (AIR)
                </x-menu-item>
            </x-parent-menu-item>
        </ul>
    </div>
</div>
