@extends('layouts.master')
@section('title')
    Audit Execution
@endsection

@section('styles')
@endsection

@section('sideMenu')
    @if(session('_module_menus') != null)
        @include('layouts.partials._sidenav')
    @endif
@endsection

@section('content')

@endsection

@section('scripts')
    <script>
        $(function () {
            getCurrentLocation = window.location.href;
            getData = getCurrentLocation.split("?");
            if (getData[1]){
                getUrlData = getData[1].split("&");
                    $(".audit-universe a").click();
            }
        })
    </script>
@endsection
