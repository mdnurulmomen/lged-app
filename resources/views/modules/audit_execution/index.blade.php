@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('styles')
@endsection

@section('sideMenu')
    @include('modules.audit_execution.partials.menu_execution_dashboard')
@endsection

@section('content')
    <h1 class="text-center">Plan</h1>
@endsection

@section('scripts')
@endsection
