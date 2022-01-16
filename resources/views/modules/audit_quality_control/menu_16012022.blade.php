@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('styles')
@endsection

@section('sideMenu')
    @include('modules.audit_quality_control.partials.menu_audit_qac')
@endsection

@section('content')
    <h1 class="text-center">Audit QAC</h1>
@endsection

@section('scripts')
@endsection
