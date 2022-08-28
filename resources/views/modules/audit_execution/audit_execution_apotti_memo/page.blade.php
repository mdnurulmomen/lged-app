@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('styles')
@endsection

@section('sideMenu')
    @if(session('_module_menus') != null)
        @include('layouts.partials._sidenav')
    @endif
@endsection

@section('content')
    <h1 class="text-center"></h1>
@endsection

@section('scripts')
@endsection
