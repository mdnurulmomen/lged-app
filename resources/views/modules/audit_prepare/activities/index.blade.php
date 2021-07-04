@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('styles')
@endsection

@section('sideMenu')
    @include('modules.audit_prepare.partials.menu_audit_prepare_activities')
@endsection

@section('content')
    <h1 class="text-center">Audit Preparation Activities</h1>
@endsection

@section('scripts')
@endsection
