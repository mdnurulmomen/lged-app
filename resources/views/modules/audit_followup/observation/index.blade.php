@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/uploader/jquery.filer.css') }}">
<link rel="stylesheet" href="{{ asset('assets/gallery/css/styles.css') }}">
<link rel="stylesheet" href="{{ asset('assets/gallery/touchTouch/touchTouch.css') }}">
@endsection

@section('sideMenu')
    @include('modules.audit_followup.partials.menu_followup_observation')
@endsection

@section('content')
    <h1 class="text-center">Followup Observation</h1>
@endsection

@section('scripts')
<script src="{{ asset('assets/uploader/jquery.filer.min.js') }}"></script>
<script src="{{ asset('assets/gallery/touchTouch/touchTouch.jquery.js') }}"></script>
<script>
$(document).ready(function() {
    $('.thumbs a').touchTouch();
});
</script>
@endsection