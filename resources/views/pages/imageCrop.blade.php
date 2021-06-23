@extends('sideMenuLayout')
@section('content')
<div class="row m-0 page-title-wrapper d-md-flex align-items-md-center">
    <div class="col-md-6">
        <div class="title py-2">
            <h4 class="mb-0 font-weight-bold"><i class="fas fa-list mr-3"></i>ইমেজ ক্রোপার</h4>
        </div>
    </div>
</div>
<div class="px-3 pt-3">
    <div class="row mt-5">
        <div class="col-md-4">
            <img src="{{ asset('assets/media/books/1.png') }}" id="demo-basic" class="img-fluid" />  
        </div>
    </div>
    <div class="row mt-5">
        <div class="com-md-4">
            <div class="mt-5" role="group" aria-label="First group">
                <label class="btn btn-primary btn-square mr-5 mb-0" for="imageCropFile"><i class="fas fa-upload"></i> ইমেজ আপলোড
                    <input type="file" value="" id="imageCropFile" class="hidden" style="opacity: 0; position: absolute;" />
                </label>
                <button type="button" class="btn btn-danger btn-square"><i class="fad fa-crop-alt"></i> ইমেজ ক্রোপ</button>
            </div>
        </div>
    </div>
</div>
@endsection