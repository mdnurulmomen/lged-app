@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('styles')
@endsection

@section('sideMenu')
    @include('modules.audit_execution.partials.menu_audit_execution_review')
@endsection

@section('content')
    <h1 class="text-center">Audit Execution Review</h1>
@endsection

@section('scripts')
@endsection
