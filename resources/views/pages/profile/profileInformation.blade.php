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
                        <h4 class="mb-0 font-weight-bold"><i class="fas fa-list mr-3"></i>{{ __('ব্যাক্তিগত তথ্য')}}</h4>
                    </div>
                </div>
            </div>
            <div class="border-bottom d-flex justify-content-end px-3">
                <div class="btn-group">
                    <button class="btn btn-warning btn-sm btn-square"  id="editButtons"><i class="fa fa-edit"></i>Edit Profile Information</button>
                </div>
                <div class="btn-group d-none" id="saveButtons">
                    <button class="btn btn-success btn-sm btn-square"><i class="fa fa-save"></i>Save Changes</button>
                    <button data-content="" class="btn btn-danger btn-sm btn-square"  id="cancelButtons"><i class="fad fa-book"></i> Cancel</button>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form class="form">
                <!--begin::Body-->
                <div class="card-body" id="kt_profile_scroll">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-left">{{ __('নাম (বাংলা)')}}</label>
                                <div class="col-lg-9 col-xl-9">
                                    <input class="form-control form-control-lg form-control-solid" type="text" value="{{ __('নাম (বাংলা)')}}" disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-left">{{ __('নাম (ইংরেজি)')}}</label>
                                <div class="col-lg-9 col-xl-9">
                                    <input class="form-control form-control-lg form-control-solid" type="text" value="{{ __('নাম (ইংরেজি)')}}" disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-left">{{ __('পিতার নাম (বাংলা)')}}</label>
                                <div class="col-lg-9 col-xl-9">
                                    <input class="form-control form-control-lg form-control-solid" type="text" value="{{ __('পিতার নাম (বাংলা)')}}" disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-left">{{ __('পিতার নাম (ইংরেজি)')}}</label>
                                <div class="col-lg-9 col-xl-9">
                                    <input class="form-control form-control-lg form-control-solid" type="text" value="{{ __('পিতার নাম (ইংরেজি)')}}" disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-left">{{ __('মাতার নাম (বাংলা)')}}</label>
                                <div class="col-lg-9 col-xl-9">
                                    <input class="form-control form-control-lg form-control-solid" type="text" value="{{ __('মাতার নাম (বাংলা)')}}" disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-left">{{ __('মাতার নাম (ইংরেজি)')}}</label>
                                <div class="col-lg-9 col-xl-9">
                                    <input class="form-control form-control-lg form-control-solid" type="text" value="{{ __('মাতার নাম (ইংরেজি)')}}" disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-left">{{ __('জন্ম তারিখ')}}</label>
                                <div class="col-lg-9 col-xl-9">
                                    <input type="text" class="form-control form-control-lg form-control-solid" placeholder="{{ __('জন্ম তারিখ')}}" disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-left">{{ __('লিঙ্গ')}}</label>
                                <div class="col-lg-9 col-xl-9">
                                    <select class="form-control form-control-lg form-control-solid" disabled>
                                        <option value="">{{ __('লিঙ্গ বাছাই করুন')}}</option>
                                        <option value="">{{ __('পুরুষ')}}</option>
                                        <option value="">{{ __('মহিলা')}}</option>
                                        <option value="">{{ __('অন্যান্য')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>  
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-left">{{ __('ব‍্যক্তিগত ই-মেইল') }}</label>
                                <div class="col-lg-9 col-xl-9">
                                    <input type="email" class="form-control form-control-lg form-control-solid"  placeholder="{{ __('ব‍্যক্তিগত ই-মেইল') }}" disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-left">{{ __('পরিচয়পত্র নম্বর') }}</label>
                                <div class="col-lg-9 col-xl-9">
                                    <input type="text" class="form-control form-control-lg form-control-solid"  placeholder="{{ __('পরিচয়পত্র নম্বর') }}" disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-left">{{ __('ব‍্যক্তিগত মোবাইল নম্বর') }}</label>
                                <div class="col-lg-9 col-xl-9">
                                    <input type="text" class="form-control form-control-lg form-control-solid"  placeholder="{{ __('ব‍্যক্তিগত মোবাইল নম্বর') }}" disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-left">{{ __('বিকল্প মোবাইল নম্বর') }}</label>
                                <div class="col-lg-9 col-xl-9">
                                    <input type="text" class="form-control form-control-lg form-control-solid"  placeholder="{{ __('বিকল্প মোবাইল নম্বর') }}" disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-left">{{ __('ধর্ম')}}</label>
                                <div class="col-lg-9 col-xl-9">
                                    <select class="form-control form-control-lg form-control-solid" disabled>
                                        <option value="">{{ __('ধর্ম বাছাই করুন')}}</option>
                                        <option value="">{{ __('মুসলিম')}}</option>
                                        <option value="">{{ __('হিন্দু')}}</option>
                                        <option value="">{{ __('বোদ্ধ')}}</option>
                                        <option value="">{{ __('খ্রিষ্টান')}}</option>
                                        <option value="">{{ __('অন্যান্য')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-left">{{ __('বৈবাহিক অবস্থা')}}</label>
                                <div class="col-lg-9 col-xl-9">
                                    <select class="form-control form-control-lg form-control-solid" disabled>
                                        <option value="">{{ __('বৈবাহিক অবস্থা বাছুন')}}</option>
                                        <option value="">{{ __('বিবাহিত')}}</option>
                                        <option value="">{{ __('বিবাহবিচ্ছেদ')}}</option>
                                        <option value="">{{ __('অবিবাহিত')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-left">{{ __('রক্তের গ্রুপ')}}</label>
                                <div class="col-lg-9 col-xl-9">
                                    <select class="form-control form-control-lg form-control-solid" disabled>
                                        <option value="">{{ __('রক্তের গ্রুপ বাছাই করুন')}}</option>
                                        <option value="">{{ __('এ+')}}</option>
                                        <option value="">{{ __('এ-')}}</option>
                                        <option value="">{{ __('বি+')}}</option>
                                        <option value="">{{ __('বি-')}}</option>
                                        <option value="">{{ __('এবি+')}}</option>
                                        <option value="">{{ __('ও+')}}</option>
                                        <option value="">{{ __('ও+')}}</option>
                                    </select>
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