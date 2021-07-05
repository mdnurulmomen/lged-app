<x-title-wrapper>Create Annual Audit Activities</x-title-wrapper>

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
                            <h3>Create Activities</h3>
                            <hr>
                            <ul id="tree2" class="tree">
                                <li>
                                    <ul>
                                        <li>
                                            <div class="d-flex align-item-center">
                                                <div class="mr-5">Output 1</div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button id="" type="reset" class="btn btn-success mr-2 btn-square"><i class="fad fa-save"></i>
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('scripts.script_audit_plan_operational_activity')
