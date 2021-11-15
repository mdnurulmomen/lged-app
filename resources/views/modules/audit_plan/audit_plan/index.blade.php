@extends('layouts.master')
@section('title')
    Audit Plan
@endsection

@section('styles')
@endsection

@section('sideMenu')
    @if(session('_module_menus') != null)
        @include('layouts.partials._sidenav')
    @endif
    {{--@include('modules.audit_plan.partials.menu_audit_plan')--}}
@endsection

@section('content')

@endsection

@section('scripts')
@endsection
