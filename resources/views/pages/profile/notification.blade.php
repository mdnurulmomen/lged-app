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
                        <h4 class="mb-0 font-weight-bold"><i class="fas fa-list mr-3"></i>{{ __('নোটিফিকেশন')}}</h4>
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
                            <div class="mb-3 font-weight-bold-700 font-size-h4 solaimanLipi">{{ __('প্রোফাইল ফটো পরিবর্তন')}}</div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">{{ __('ইমেইল')}}</label>
                                <div class="col-3">
                                    <span class="switch switch-icon">
                                        <label>
                                            <input type="checkbox" checked="checked" name="select">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                                <label class="col-3 col-form-label">{{ __('এস এম এস')}}</label>
                                <div class="col-3">
                                    <span class="switch switch-icon">
                                        <label>
                                            <input type="checkbox" checked="checked" name="select">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>
                            <hr />
                            <div class="mb-3 font-weight-bold-700 font-size-h4">{{ __('পাসওয়ার্ড পরিবর্তন')}}</div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">{{ __('ইমেইল')}}</label>
                                <div class="col-3">
                                    <span class="switch switch-icon">
                                        <label>
                                            <input type="checkbox" checked="checked" name="select">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                                <label class="col-3 col-form-label">{{ __('এস এম এস')}}</label>
                                <div class="col-3">
                                    <span class="switch switch-icon">
                                        <label>
                                            <input type="checkbox" checked="checked" name="select">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>
                            <hr />
                            <div class="mb-3 font-weight-bold-700 font-size-h4">{{ __('স্বাক্ষর পরিবর্তন')}}</div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">{{ __('ইমেইল')}}</label>
                                <div class="col-3">
                                    <span class="switch switch-icon">
                                        <label>
                                            <input type="checkbox" checked="checked" name="select">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                                <label class="col-3 col-form-label">{{ __('এস এম এস')}}</label>
                                <div class="col-3">
                                    <span class="switch switch-icon">
                                        <label>
                                            <input type="checkbox" checked="checked" name="select">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>
                            <hr />
                            <div class="mt-5 d-flex justify-content-end">
                                <div class="btn-group">
                                    <button class="btn btn-success btn-sm btn-square"><i class="fa fa-save"></i>{{ __('সংরক্ষণ করুন')}}</button>
                                </div>
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