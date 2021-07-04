@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('styles')
@endsection

@section('sideMenu')
    @include('modules.audit_plan.partials.menu_operational_plan')
@endsection

@section('content')
    <h1 class="text-center">Operational Plan</h1>
@endsection

@section('scripts')
@endsection
