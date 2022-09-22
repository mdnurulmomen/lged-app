<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--begin::Head-->
<head>
    <meta charset="utf-8"/>
    <title>LGED IA - @yield('title')</title>
    @include('layouts.partials.header')
    <link rel="shortcut icon" href="{{ asset('assets/images/logo_lged.png') }}"/>
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
            <div id="kt_header" class="header header-fixed" style="height: 85px !important;">
                <!--begin::Container-->
                <div class="container pl-0 pr-0 d-flex align-items-stretch justify-content-between">
                    <!--begin::Header Menu Wrapper-->
                    <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                        <!--begin::Header Logo-->
                        <div class="header-logo">
                            @include('partials.logo', ['area_style' => 'height: 95px !important', 'img_style' => 'width: 80px !important', 'text'=> 'Local Government Engineering Department'])
                        </div>
                        <!--end::Header Logo-->
                        <!--begin::Header Menu-->
                    {{--                    @include('layouts.partials.topbar_left')--}}
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
            <div class="content container d-flex flex-column flex-column-fluid pt-0">
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
@include('scripts.script_master')


<!--begin::Scrolltop-->
@include('layouts.partials.scroll_top')
<!--end::Scrolltop-->

@include('layouts.partials.all_modals')

@include('layouts.partials.footer_script')
@include('scripts.script_master')
@yield('scripts')
</html>
