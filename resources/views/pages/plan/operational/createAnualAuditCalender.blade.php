@extends('sideMenuLayout')
@section('sideMenu')
@include('pages.plan.operational.operationalMenu');
@endsection
@section('content')
<div class="row m-0 page-title-wrapper d-md-flex align-items-md-center">
    <div class="col-md-6">
        <div class="title py-2">
            <h4 class="mb-0 font-weight-bold"><i class="fas fa-list mr-3"></i>Create Anual Audit Calender</h4>
        </div>
    </div>
</div>
<div class="mt-4 px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom gutter-b">           
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="example-preview">
                                <ul class="nav nav-tabs custom-tabs mb-0" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active rounded-0" id="activity" data-toggle="tab" href="#set_activity">
                                            <span class="nav-text">Set Activity</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="calender" data-toggle="tab" href="#set_cadender" aria-controls="profile">
                                            <span class="nav-text">Calender View</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="print" data-toggle="tab" href="#print_view" aria-controls="contact">
                                            <span class="nav-text">Print View</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane border border-top-0 p-3 fade show active" id="set_activity" role="tabpanel" aria-labelledby="home-tab"> 
                                        @include('pages.plan.operational.activityView')
                                    </div>
                                    <div class="tab-pane fade border border-top-0 p-3" id="set_cadender" role="tabpanel" aria-labelledby="profile-tab">
                                        @include('pages.plan.operational.auditCalender')
                                    </div>
                                    <div class="tab-pane fade border border-top-0 p-3" id="print_view" role="tabpanel" aria-labelledby="contact-tab">
                                        @include('pages.plan.operational.auditPrintView')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="reset" class="btn btn-success mr-2 btn-square"><i class="fad fa-save"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal-->
<div class="modal fade" id="mileStoneModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Milestone</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control rounded-0" placeholder="Search for...">
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-square" type="button"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold btn-square" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary font-weight-bold btn-square">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal-->
<div class="modal fade" id="responsibleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Resposible Person</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label">select Person</label>
                        <div class="form-group">
                            <select class="form-control w-100">
                                <option> option 1 </option>
                                <option> option 2 </option>
                                <option> option 3 </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="form-group">
                        <label>Selected Person</label>
                        <div class="checkbox-list">
                            <label class="checkbox">
                            <input type="checkbox" name="Checkboxes1">
                            <span></span>Default</label>
                            <label class="checkbox checkbox-disabled">
                            <input type="checkbox" disabled="disabled" checked="checked" name="Checkboxes1">
                            <span></span>Disabled</label>
                            <label class="checkbox">
                            <input type="checkbox" checked="checked" name="Checkboxes1">
                            <span></span>Checked</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold btn-square" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary font-weight-bold btn-square">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection