@extends('layouts.full_width_empty')
@section('title')
    Dashboard
@endsection

@section('styles')
    <style>
        .h-200px {
            height: 200px !important
        }
    </style>
@endsection

@section('content')
    <div class="row mt-25 d-flex flex-column flex-item-center mb-10">
        <h3 class="h1 text-center">{{___('generic.app_name')}}</h3>
        {{--<h4 class="h1 text-center">Welcome To AMMS 2.0</h4>--}}
    </div>
    <div class="row mb-3">
        <a style="background-color: #8B8DE6!important;" href="{{route('dashboard.index_referer',['type' => 'Compliance Audit','type_bn' => 'কমপ্লায়েন্স অডিট'])}}" class="col bg-light-warning rounded-xl mr-7 text-center h-200px">
            <img class="mt-5" width="80px" height="80px" src="{{asset('assets/images/compliance.png')}}" alt="">
            <p style="color: black" class="font-weight-bold font-size-h1 mt-5">Compliance Audit</p>
        </a>

        <a style="background-color: #FFAF28!important;" href="{{route('dashboard.index_referer',['type' => 'Performance Audit','type_bn' => 'পারফরমেন্স অডিট'])}}" class="col bg-light-danger rounded-xl mr-7 text-center h-200px">
            <img class="mt-5" width="80px" height="80px" src="{{asset('assets/images/performance.png')}}" alt="">
            <p style="color: black" class="font-weight-bold font-size-h1 mt-5">Performance Audit</p>
        </a>

        <a style="background-color: #332A7C!important;"  href="{{route('dashboard.index_referer',['type' => 'Financial Audit','type_bn' => 'ফিনান্সিয়াল অডিট'])}}" class="col bg-light-success rounded-xl mr-7 text-center h-200px">
            <img class="mt-5" width="80px" height="80px" src="{{asset('assets/images/financial.png')}}" alt="">
            <p style="color: white" class="font-weight-bold font-size-h1 mt-5">Financial Audit</p>
        </a>
    </div>
    <div class="row mb-5">
        <a style="background-color: #c38be6!important;" href="{{route('audit.execution.archive-apotti.archive-page')}}" class="col bg-light-warning rounded-xl mr-7 text-center h-200px">
            <img class="mt-5" width="80px" height="80px" src="{{asset('assets/images/repository.png')}}" alt="">
            <p style="color: black" class="font-weight-bold font-size-h1 mt-5">Audit Repository</p>
        </a>
    </div>
@endsection

@section('scripts')
@endsection
