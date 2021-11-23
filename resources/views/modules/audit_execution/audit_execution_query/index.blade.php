@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('styles')
@endsection

@section('sideMenu')
{{--    @if(session('_module_menus') != null)--}}
{{--        @include('layouts.partials._sidenav')--}}
{{--    @endif--}}
    @include('modules.audit_execution.partials.menu_audit_execution_query')
@endsection

@section('content')
    <h1 class="text-center">Audit Execution Query</h1>
@endsection

@section('scripts')
@endsection
