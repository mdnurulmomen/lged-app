@extends('sideMenuLayout')
@section('sideMenu')
@include('pages.plan.operational.operationalMenu');
@endsection
@section('content')
<div class="row m-0 page-title-wrapper d-md-flex align-items-md-center">
    <div class="col-md-6">
        <div class="title py-2">
            <h4 class="mb-0 font-weight-bold"><i class="fas fa-list mr-3"></i>Operational Plan View</h4>
        </div>
    </div>
</div>
<div class="mt-4 px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom gutter-b">           
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="tree-view-wrapper-scroll">
                                @include('pages.plan.operational.activityTreeView')
                            </div>
                        </div>
                        <div class="col-md-8">
                            @include('pages.plan.operational.operationalActivityTable.activity_1_1')
                            @include('pages.plan.operational.operationalActivityTable.activity_1_2_1')
                            @include('pages.plan.operational.operationalActivityTable.activity_1_2_2')
                            @include('pages.plan.operational.operationalActivityTable.activity_1_2_3')
                            @include('pages.plan.operational.operationalActivityTable.activity_1_3_1')
                            @include('pages.plan.operational.operationalActivityTable.activity_1_3_2')
                            @include('pages.plan.operational.operationalActivityTable.activity_1_4_1')
                            @include('pages.plan.operational.operationalActivityTable.activity_1_5')
                            @include('pages.plan.operational.operationalActivityTable.activity_4_10')
                        </div>
                    </div>
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