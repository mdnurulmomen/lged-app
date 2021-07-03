<div class="topbar">
    <!--begin::Cart-->
    <div class="topbar-item">
        <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1" id="kt_quick_cart_toggle">
            <span class="svg-icon svg-icon-xl svg-icon-primary">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Cart3.svg-->
                <i class="fa fa-bell text-primary"></i>
                <!--end::Svg Icon-->
            </span>
        </div>
    </div>
    <!--end::Cart-->

    <!--begin::Languages-->
    <div class="dropdown">
        <!--begin::Toggle-->
        <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
            <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                <img class="h-20px w-20px" src="assets/media/svg/flags/226-united-states.svg" alt=""/>
            </div>
        </div>
        <!--end::Toggle-->
        <!--begin::Dropdown-->
        <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
            <!--begin::Nav-->
            <ul class="navi navi-hover py-4">
                <!--begin::Item-->
                <li class="navi-item">
                    <a href="#" class="navi-link">
                        <span class="symbol symbol-20 mr-3">
                            <img class="h-20px w-20px rounded-0" src="assets/media/svg/flags/226-united-states.svg"
                                 alt=""/>
                        </span>
                        <span class="navi-text">{{ __('ইংরেজি') }}</span>
                    </a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="navi-item active">
                    <a href="#" class="navi-link">
                        <span class="symbol symbol-20 mr-3">
                            <img src="assets/media/svg/flags/bangladesh.png"/>
                        </span>
                        <span class="navi-text">{{ __('বাংলা') }}</span>
                    </a>
                </li>
                <!--end::Item-->
            </ul>
            <!--end::Nav-->
        </div>
        <!--end::Dropdown-->
    </div>
    <!--end::Languages-->
    <!--begin::User-->
    <div class="dropdown">
        <!--begin::User-->
        @include('layouts.partials.topbar._profile')
    </div>
    <!--end::User-->
</div>
