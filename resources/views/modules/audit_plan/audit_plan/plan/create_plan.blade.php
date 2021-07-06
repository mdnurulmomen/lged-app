@extends('layouts.full_width')
@section('content')
    <div class="row m-0 page-title-wrapper d-md-flex align-items-md-center">
        <div class="col-md-6">
            <div class="title py-2">
                <h4 class="mb-0 font-weight-bold">
                    <a href="{{route('audit.plan.audit.index')}}">
                        <i title="Back To Audit Plan" class="fad fa-backward mr-3"></i>
                    </a>
                    Create Audit Plan
                </h4>
            </div>
        </div>
    </div>

    <div class="split" id="splitWrapper">
        <div id="split-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="p-5">
                        <div class="input-group mb-5">
                            <input class="form-control rounded-0" type="text" name="" placeholder="Add"
                                   aria-label="Recipient's " aria-describedby="my-addon">
                            <div class="input-group-append rounded-0">
                                <button class="btn btn-success btn-sm btn-square" type="button"><i
                                        class="far fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="mt-5">
                            <h3>Audit list</h3>
                        </div>
                        <!---JS tree start---->
                        <div id="createPlanJsTree" class="mt-5">
                        </div>
                        <!---JS tree end---->
                        <div class="form-group mt-5">
                            <input class="form-control rounded-0" type="text" name="" id="searchPlaneField"
                                   placeholder="Search"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="split-1">
            <div class="summernote" id="kt_summernote_1"></div>
        </div>
        <div id="split-2">

            <div id="writing-screen-wrapper">
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('scripts.script_create_new_plan')
@endsection
