@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('styles')
@endsection

@section('sideMenu')
    @include('modules.audit_prepare.partials.menu_audit_prepare_sampling')
@endsection

@section('content')
    <h1 class="text-center">Audit Preparation Sampling</h1>
@endsection

@section('scripts')
@endsection
