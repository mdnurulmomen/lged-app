@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('styles')
@endsection

@section('sideMenu')
    @include('modules.audit_execution.partials.menu_audit_execution_discussion')
@endsection

@section('content')
    <h1 class="text-center">Audit Execution Discussion</h1>
@endsection

@section('scripts')
@endsection
