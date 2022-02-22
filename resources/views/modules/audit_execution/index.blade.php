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
            page = getCurrentLocation.split("=");
            console.log(page[1])
            if (page[1] == 'memo'){
                $(".audit-memo a").click();
            }else if(page[1] == 'query'){
                $(".audit-query a").click();
            }
        })
    </script>
@endsection
