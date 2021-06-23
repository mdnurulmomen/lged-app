@extends('fullWidthLayout')
@section('content')
<div class="d-flex flex-row  h-100">
    <!--begin::Aside-->
    @include('pages.profile.profileMenu')
    <!--end::Aside-->
    <!--begin::Content-->
    <div class="flex-row-fluid">
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="row m-0 page-title-wrapper d-md-flex align-items-md-center">
                <div class="col-md-6">
                    <div class="title py-2">
                        <h4 class="mb-0 font-weight-bold"><i class="fas fa-list mr-3"></i>{{ __('পাসওয়ার্ড পরিবর্তন')}}</h4>
                    </div>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form class="form">
                <!--begin::Body-->
                <div class="card-body" id="kt_profile_scroll">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-alert">{{ __('বর্তমান পাসওয়ার্ড') }}</label>
                                <div class="col-lg-9 col-xl-9">
                                    <input type="password" class="form-control form-control-lg form-control-solid mb-2" placeholder="{{ __('বর্তমান পাসওয়ার্ড') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-alert">{{__('নতুন পাসওয়ার্ড')}}</label>
                                <div class="col-lg-9 col-xl-9">
                                    <input type="password" class="form-control form-control-lg form-control-solid checkPasword" placeholder="{{__('নতুন পাসওয়ার্ড')}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-alert">{{ __('পুনরায় পাসওয়ার্ড') }}</label>
                                <div class="col-lg-9 col-xl-9">
                                    <input type="password" class="form-control form-control-lg form-control-solid"placeholder="{{  __('পুনরায় নতুন পাসওয়ার্ড') }}">
                                </div>
                            </div>
                            <div class="mt-5 d-flex justify-content-end">
                                <div class="btn-group">
                                    <button class="btn btn-success btn-sm btn-square"><i class="fa fa-save"></i>{{ __('সংরক্ষণ করুন')}}</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-custom card-stretch gutter-b">
                                <!--begin::Body-->
                                <div class="card-body alert alert-custom alert-light-warning">
                                    <!--begin::Item-->
                                    <div class="">
                                        {{-- <p class="text-success align-items-center correct-text-success d-none"><i class="fas fa-check text-success mr-2"></i> {{ __('কমপক্ষে ৮টি অক্ষর')}}</p>
                                        <p class="text-success align-items-center small-letter-success d-none"><i class="fas fa-check text-success  mr-2"></i> {{ __('কমপক্ষে ১টি ছোট হাতের অক্ষর') }}</p>
                                        <p class="text-success align-items-center capital-letter-success d-none"><i class="fas fa-check text-success  mr-2"></i> {{ __('কমপক্ষে ১টি বড় হাতের অক্ষর') }}</p>
                                        <p class="text-success align-items-center number-check-success d-none"><i class="fas fa-check text-success  mr-2"></i> {{ __('কমপক্ষে ১টি সংখ্যা') }}</p>
                                        <p class="text-success align-items-center special-characters-success d-none mb-0"><i class="fas fa-check text-success  mr-2"></i> {{ __('কমপক্ষে ১টি বিশেষ অক্ষর') }}</p> --}}
                                        <!------>
                                        <p class="text-danger align-items-center correct-text"><i class="fas fa-times text-danger mr-2"></i> {{ __('কমপক্ষে ৮টি অক্ষর')}}</p>
                                        <p class="text-danger align-items-center small-letter"><i class="fas fa-times text-danger  mr-2"></i> {{ __('কমপক্ষে ১টি ছোট হাতের অক্ষর') }}</p>
                                        <p class="text-danger align-items-center capital-letter"><i class="fas fa-times text-danger  mr-2"></i> {{ __('কমপক্ষে ১টি বড় হাতের অক্ষর') }}</p>
                                        <p class="text-danger align-items-center number-check"><i class="fas fa-times text-danger  mr-2"></i> {{ __('কমপক্ষে ১টি সংখ্যা') }}</p>
                                        <p class="text-danger align-items-center special-characters mb-0"><i class="fas fa-times text-danger  mr-2"></i> {{ __('কমপক্ষে ১টি বিশেষ অক্ষর') }}</p>
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end: Card Body-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Body-->
            </form>
            <!--end::Form-->
        </div>
    </div>
    <!--end::Content-->
</div>
@endsection