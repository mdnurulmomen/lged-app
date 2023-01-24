@extends('layouts.master')
@section('title')
    Audit Universe
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
            $(".audit-universe a").click();
        })
    </script>
@endsection
