@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('styles')
@endsection

@section('sideMenu')
    @include('modules.audit_prepare.partials.menu_audit_prepare_data_analysis')
@endsection

@section('content')
    <h1 class="text-center">Audit Preparation Data Analysis</h1>
@endsection

@section('scripts')
@endsection
