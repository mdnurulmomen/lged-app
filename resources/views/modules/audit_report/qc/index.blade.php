@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('styles')
@endsection

@section('sideMenu')
    @include('modules.audit_report.partials.menu_audit_report_qc')
@endsection

@section('content')
    <h1 class="text-center">QC</h1>
@endsection

@section('scripts')
@endsection
