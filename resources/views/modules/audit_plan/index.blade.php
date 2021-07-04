@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('styles')
@endsection

@section('sideMenu')
    @include('modules.audit_plan.partials.menu_plan_dashboard')
@endsection

@section('content')
    <h1 class="text-center">Audit Plan</h1>
@endsection

@section('scripts')
@endsection
