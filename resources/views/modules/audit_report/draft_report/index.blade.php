@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('styles')
@endsection

@section('sideMenu')
    @include('modules.audit_report.partials.menu_draft_report')
@endsection

@section('content')
    <h1 class="text-center">Draft Report</h1>
@endsection

@section('scripts')
@endsection
