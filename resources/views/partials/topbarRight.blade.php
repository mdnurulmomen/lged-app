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
                <img class="h-20px w-20px" src="assets/media/svg/flags/226-united-states.svg" alt="" />
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
                            <img class="h-20px w-20px rounded-0" src="assets/media/svg/flags/226-united-states.svg" alt="" />
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
        <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
            <div class="btn btn-dropdown w-auto btn-clean d-flex align-items-center btn-square px-2 h-100">
                <div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-2">
                        <img src="{{ asset('assets/media/users/blank.png') }}" class="img-responsive" alt="">
                </div>
                <span class="font-weight-normal font-size-base d-none d-md-inline mr-3 text-violate">
                    {{ __('ইউজার নাম') }}
                </span>
                <span>
                    <i class="fa fa-chevron-down"></i>
                </span>
            </div>
            
        </div>
        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
            <!--begin: Head -->
            <div class="shadow">
                <h4 class="ant-typography px-2 bg-white py-2 border-bottom">{{ __('পদবি নির্বাচন করুন') }}</h4>
                <ul class="pl-0" role="menu">
                    <li class="d-flex align-items-start overflow-hidden " role="menuitem" style="padding-left: 10px;">
                        <span class="pr-3 pt-1">
                            <i class="fas fa-id-card fa-1x a2i-color-purple"></i>
                        </span>
                        <a href="#" class="btn-switch-designation flex-fill overflow-hidden" >
                            <span>{{ __('পদবি') }}, </span><span class="test text-truncate">{{ __('অফিসার নাম') }}</span>
                        </a>
                        <div class="d-flex pl-2">
                            <a href="#" class="btn-switch-designation">
                                <span class="badge badge-success rounded-0"><span>{{ __('৫') }}</span> {{ __('টাইটেল') }}</span>
                            </a>
                            <a href="#" class="btn-switch-designation">
                                <span class="badge badge-warning rounded-0 text-light"><span>{{ __('৫') }}</span> {{ __('টাইটেল') }}</span>
                            </a>
                        </div>
                    </li>
                </ul>
                <div class="btn-group w-100 d-flex justify-content-between" role="group" aria-label="User Profile Management">
                    <a href="/profile" data-toggle="popover" data-placement="bottom" data-content="{{ __('প্রোফাইল') }}" class="btn btn-primary font-weight-bold text-white btn-profile btn-square">
                        <i class="fa fa-user"></i><span class="ml-2">{{ __('প্রোফাইল') }} </span>
                    </a>
                    <a href="#" data-content="{{ __('হেল্প ডেস্ক') }}" data-toggle="popover" data-placement="bottom" class="btn btn-success font-weight-bold text-white btn-square">
                        <i class="fad fa-user-headset"></i><span class="ml-2">{{ __('হেল্প ডেস্ক') }}</span>
                    </a>
                    <a href="#" class="btn btn-danger font-weight-bold text-white btn-square" data-toggle="popover" data-placement="bottom" data-content="{{ __('লগ আউট') }}" data-original-title="" title="">
                        <i class="fas fa-sign-out-alt"></i><span class="ml-2">{{ __('লগ আউট') }} </span>
                    </a>
                </div>
            </div>
            <!--end: Navigation -->
        </div>
    </div>
    <!--end::User-->
</div>