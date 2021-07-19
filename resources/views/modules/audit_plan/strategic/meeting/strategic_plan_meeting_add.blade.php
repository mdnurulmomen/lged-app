@extends('sideMenuLayout')
@section('sideMenu')
@include('pages.plan.dashboardMenu');
@endsection
@section('content')
<x-title-wrapper>Final Plan</x-title-wrapper>
<div class="mt-4 px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="select_fiscal_year" class="col-form-label">Fiscal Year <span class="text-danger">(*)</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend w-50">
                                        <input type="text" class="form-control rounded-0" value="" placeholder="start year" required>
                                    </div>
                                    <div class="input-group-append w-50">
                                        <input type="text" class="form-control rounded-0" value="" placeholder="end year" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="dropzone dropzone-default" id="kt_dropzone_1">
                                <div class="dropzone-msg dz-message needsclick">
                                    <h3 class="dropzone-msg-title">Khosra Files upload.</h3>
                                    <span class="dropzone-msg-desc">This is just a demo dropzone. Selected files are
                                    <strong>not</strong>actually uploaded.</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 my-7">
                            <button type="button" class="btn btn-success btn-square" id="sidePanel">Select Approver From List</button>
                        </div>
                        <div class="col-md-8">
                            <div class="create_plan" id="kt_summernote_1"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-custom card-stretch gutter-b py-5">
                                <!--begin::Header-->
                                <div class="card-header border-0">
                                    <h3 class="card-title font-weight-bolder text-dark">Plans</h3>
                                    
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body pt-2">
                                    <!--begin::Item-->
                                    
                                    
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-10">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-40 symbol-light-success mr-5">
                                            <span class="symbol-label">
                                                <img src="assets/media/svg/avatars/006-girl-3.svg" class="h-75 align-self-end" alt="">
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Text-->
                                        <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                                            <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">2). document_01.png</a>
                                            <span class="text-muted">(37.42 KB)</span>
                                        </div>
                                        <!--end::Text-->
                                        <!--begin::Dropdown-->
                                        <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="" data-placement="left" data-original-title="Quick actions">
                                            <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ki ki-bold-more-hor"></i>
                                            </a>
                                            <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">
                                                <!--begin::Navigation-->
                                                <ul class="navi navi-hover">
                                                    <li class="navi-header font-weight-bold py-4">
                                                        <a href="#" class="navi-link">
                                                            <span class="navi-text">
                                                                View
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="navi-item">
                                                        <a href="#" class="navi-link">
                                                            <span class="navi-text">
                                                                Download
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <!--end::Navigation-->
                                            </div>
                                        </div>
                                        <!--end::Dropdown-->
                                    </div>
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-10">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-40 symbol-light-success mr-5">
                                            <span class="symbol-label">
                                                <img src="assets/media/svg/avatars/006-girl-3.svg" class="h-75 align-self-end" alt="">
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Text-->
                                        <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                                            <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">2). document_01.png</a>
                                            <span class="text-muted">(37.42 KB)</span>
                                        </div>
                                        <!--end::Text-->
                                        <!--begin::Dropdown-->
                                        <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="" data-placement="left" data-original-title="Quick actions">
                                            <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ki ki-bold-more-hor"></i>
                                            </a>
                                            <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">
                                                <!--begin::Navigation-->
                                                <ul class="navi navi-hover">
                                                    <li class="navi-header font-weight-bold py-4">
                                                        <a href="#" class="navi-link">
                                                            <span class="navi-text">
                                                                View
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="navi-item">
                                                        <a href="#" class="navi-link">
                                                            <span class="navi-text">
                                                                Download
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <!--end::Navigation-->
                                            </div>
                                        </div>
                                        <!--end::Dropdown-->
                                    </div>
                                </div>
                                <!--end::Body-->
                            </div>
                        </div>
                        <div class="col-md-12 mt-7">
                            <div class="create_plan" id="kt_summernote_1"></div>
                        </div>
                        
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex align-items-center justify-content-end">
                        <button class="btn-primary btn btn-square">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection