@extends('layouts.master')
@section('title')
    Quality Control
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
@endsection
