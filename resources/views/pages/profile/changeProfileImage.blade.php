@extends('fullWidthLayout')
@section('content')
<div class="d-flex flex-row">
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
                        <h4 class="mb-0 font-weight-bold"><i class="fas fa-list mr-3"></i>{{ __('প্রোফাইল ফটো পরিবর্তন')}}</h4>
                    </div>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form class="form">
                <!--begin::Body-->
                <div class="card-body" id="kt_profile_scroll">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="p-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{asset('assets/images/n-photo.jpg')}}" class="my-image" alt="" />
                                    </div>
                                </div>
                            </div>
                            <div class="btn-group mt-5">
                                            <button type="button" class="btn btn-primary btn-square">{{ __('আপলোড করুন')}}</button>
                                            <button type="button" class="btn btn-info btn-square btn-result">{{ __('ফলাফল দেখুন')}}</button>
                                            <button class="btn btn-success btn-sm btn-square"><i class="fa fa-save"></i>{{ __('সংরক্ষণ করুন')}}</button>
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