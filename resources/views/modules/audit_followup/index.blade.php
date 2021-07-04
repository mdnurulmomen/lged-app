@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('styles')
@endsection

@section('sideMenu')
    @include('modules.audit_followup.partials.menu_followup_dashboard')
@endsection

@section('content')
    <h1 class="text-center">Followup Dashboard</h1>
@endsection

@section('scripts')
@endsection
