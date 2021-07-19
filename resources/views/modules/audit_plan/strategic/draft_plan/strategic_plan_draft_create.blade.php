@extends('executionLayout')
@section('sidemenu')
@endsection
@section('content')
<x-title-wrapper>Create Plan</x-title-wrapper>
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
                        <div class="col-md-12">
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
