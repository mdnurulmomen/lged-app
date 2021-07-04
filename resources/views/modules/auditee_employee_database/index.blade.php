@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('styles')
@endsection

@section('sideMenu')
    @include('modules.auditee_employee_database.partials.menu_auditee_employee_data')
@endsection

@section('content')
    <h1 class="text-center">Auditee Employee Database</h1>
@endsection

@section('scripts')
@endsection
