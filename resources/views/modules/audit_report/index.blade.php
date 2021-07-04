@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('styles')
@endsection

@section('sideMenu')
    @include('modules.audit_report.partials.menu_report_dashboard')
@endsection

@section('content')
    <h1 class="text-center">Audit Report</h1>
@endsection

@section('scripts')
@endsection
