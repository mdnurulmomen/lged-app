@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('styles')
@endsection

@section('sideMenu')
    @include('modules.audit_followup.partials.menu_followup_record')
@endsection

@section('content')
    <h1 class="text-center">Followup Record</h1>
@endsection

@section('scripts')
@endsection
