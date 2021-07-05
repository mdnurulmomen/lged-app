<x-title-wrapper-return area="#kt_content" title="Back To Lists"
                        url="{{route('audit.plan.operational.activity.all')}}">
    Edit Annual Audit Activities
</x-title-wrapper-return>

<div class="mt-4 px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="select_fiscal_year" class="col-form-label">Fiscal Year :</label>
                                <select class="form-control rounded-0 select-select2" id="select_fiscal_year"
                                        name="fiscal_year">
                                    <option>2021</option>
                                    <option>2020</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="select_strategic_outcome" class="col-form-label">Strategic Outcome :</label>
                                <select class="form-control rounded-0 select-select2" id="select_strategic_outcome"
                                        name="strategic_outcome">
                                    <option>Select Outcome</option>
                                    <option>Strategic Outcome 01</option>
                                    <option>Strategic Outcome 02</option>
                                </select>
                                <div class="mt-3">
                                    <p>Increased credibility to the SAI’s activities to the parliament and other
                                        stakeholders will facilitate the policymakers in taking appropriate measures for
                                        prudent management of scarce public resources.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="select_strategic_output" class="col-form-label">Strategic Output :</label>
                                <select name="strategic_output" id="select_strategic_output"
                                        class="form-control rounded-0 select-select2">
                                    <option>Select Output</option>
                                    <option>Output-01</option>
                                    <option>Output-02</option>
                                    <option>Output-03</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <p>Quality Compliance, Financial and Performance audit reports including audit reports
                                    on special areas.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Edit Activities</h3>
                            <hr>
                            @include('pages.plan.operational.activityTree')
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="reset" class="btn btn-success mr-2 btn-square"><i class="fad fa-save"></i> Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal-->
<div class="modal fade" id="mileStoneModal" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true">
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
                <button type="button" class="btn btn-light-primary font-weight-bold btn-square" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary font-weight-bold btn-square">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal-->
<div class="modal fade" id="responsibleModal" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true">
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
                                <option> option 1</option>
                                <option> option 2</option>
                                <option> option 3</option>
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
                <button type="button" class="btn btn-light-primary font-weight-bold btn-square" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary font-weight-bold btn-square">Save changes</button>
            </div>
        </div>
    </div>
</div>
@include('scripts.script_audit_plan_operational_activity')
