<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--begin::Head-->
<head>
    <meta charset="utf-8"/>
    <title>AMMS 2 - @yield('title')</title>
    @include('layouts.partials.header')
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}"/>
    @yield('styles')
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed footer-fixed full-width-footer">
<!--begin::Main-->
<!--begin::Header Mobile-->
@include('layouts.partials.mobile_header')
<!--end::Header Mobile-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            <!--begin::Header-->
            <div id="kt_header" class="header header-fixed">
                <!--begin::Container-->
                <div class="container-fluid d-flex align-items-stretch justify-content-between">
                    <!--begin::Header Menu Wrapper-->
                    <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                        <!--begin::Header Logo-->
                        <div class="header-logo">
                            @include('partials.logo')
                        </div>
                        <!--end::Header Logo-->
                        <!--begin::Header Menu-->
                    @include('layouts.partials.topbar_left')
                    <!--end::Header Menu-->
                    </div>
                    <!--end::Header Menu Wrapper-->
                    <!--begin::Topbar-->
                @include('layouts.partials.topbar_right')
                <!--end::Topbar-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Header-->
            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid pt-0">
                <!-- Start Content-->
            @yield('content')
            <!-- End Content-->
            </div>
            <!--end::Content-->
            <!--begin::Footer-->
        @include('layouts.partials.footer', ['class' => 'position-relative'])
        <!--end::Footer-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Main-->
<!--begin::Chat Panel-->
@include('layouts.partials._chat')
<!--end::Chat Panel-->
<!--begin::Quick Panel-->
@include('layouts.partials._quick_panel')
<!--end::Quick Panel-->
<!--begin::Scrolltop-->
@include('layouts.partials.scroll_top')
<!--end::Scrolltop-->
@include('layouts.partials.footer_script')
@yield('scripts')
@include('scripts.layout_navigation_spa')
</html>
