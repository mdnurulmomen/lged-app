<div class="topbar">
    <!--begin::Cart-->
    <div class="topbar-item">
        {!! $wizardData !!}
        {{--        <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1" id="kt_quick_cart_toggle">--}}
        {{--            <span class="svg-icon svg-icon-xl svg-icon-primary">--}}
        {{--                <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Cart3.svg-->--}}
        {{--                <i class="fa fa-bell text-primary"></i>--}}
        {{--                <!--end::Svg Icon-->--}}
        {{--            </span>--}}
        {{--        </div>--}}
    </div>
    <!--end::Cart-->

    <!--begin::Languages-->
    <div class="dropdown">
        {{--        @include('layouts.partials.topbar._language')--}}
    </div>
    <!--end::Languages-->

    <!--begin::User-->
    <div class="dropdown">
        @include('layouts.partials.topbar._profile')
    </div>
    <!--end::User-->
</div>
