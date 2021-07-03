@extends('sideMenuLayout')
@section('content')
<div class="row m-0 page-title-wrapper d-md-flex align-items-md-center">
    <div class="col-md-6">
        <div class="title py-2">
            <h4 class="mb-0 font-weight-bold"><i class="fas fa-list mr-3"></i>Create Operations</h4>
        </div>
    </div>
</div>
<div class="mt-4 px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom gutter-b">           
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="" class="col-3 col-form-label">Fiscal Year :</label>
                                <div class="col-9">
                                    <input class="form-control rounded-0" type="date" value="date" id="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-3 col-form-label">Strategic Outcome :</label>
                                <div class="col-9">
                                    <select class="form-control rounded-0">
                                        <option>Strategic Outcome</option>
                                        <option>Strategic Outcome 01</option>
                                        <option>Strategic Outcome 02</option>
                                        <option>Strategic Outcome 03</option>
                                        <option>Strategic Outcome 04</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-3 col-form-label">Strategic Output :</label>
                                <div class="col-9">
                                    <select class="form-control rounded-0">
                                        <option>Strategic Output</option>
                                        <option>Output-01 : Quality Compliance, Financial and Performance Audit Reports Including Audit Reports on Special Areas.</option>
                                        <option>Output-02 : Increased Follow-up and Reporting on Implementation of Audit Recommendations.</option>
                                        <option>Output-03 : Improved Government Accounting Standards and Procedures.</option>
                                        <option>Output-04 : Training and Awareness building Consultation with key Stakeholders on Various PFM Issues.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-3 col-form-label">Select Activities :</label>
                                <div class="col-9">
                                <select class="form-control rounded-0">
                                    <option>Select Activity</option>
                                    <option>Activity 1.1: Preparation of Annual Audit Plan.</option>
                                    <option>Activity 1.2: Financial Audit on Budgetary Central Government.</option>
                                    <option>Activity 1.2.1: Financial Audit on Extra Budgetary Organisations.</option>
                                    <option>Activity 1.2.2: Audit on Special Purpose Financial Statements.</option>
                                    <option>Activity 1.3.1: Compliance Audit(First Half Yearly).</option>
                                    <option>Activity 1.3.2: Compliance Audit (Second Half Yearly).</option>
                                    <option>Activity 1.4: Performance Audits.</option>
                                    <option>Activity 1.5: Audits on Special Areas.</option>
                                    <option>Activity 1.6: Updating Audit Code.</option>
                                    <option>Activity 1.7: Compliance Audit Guidelines.</option>
                                    <option>Activity 1.8: Financial Audit Guidelines.</option>
                                    <option>Activity 1.9: Performance Audit Guidelines.</option>
                                    <option>Activity 1.10: Updating Office Procedure Manuals.</option>
                                    <option>Activity 1.11: Updating Subject Matter Specific Manuals.</option>
                                    <option>Activity 1.12: Using Data Analytics for Preparing Audit Plan.</option>
                                    <option>Activity 1.13: AMMS.</option>
                                    <option>Activity 1.14: Developing Terms of Reference (TOR) for Audit Quality Assurance Cell.</option>
                                    <option>Activity 2.01: Follow up Audit based on PAC Recommendations.</option>
                                    <option>Activity 2.02: Follow up Audit on Implementation of Audit Recommendations.</option>
                                    <option>Activity 2.03: Develop Archiving.</option>
                                    <option>Activity 3.01: Formulate Government Accounting Standards and Procedure..</option>
                                    <option>Activity 3.02: Updating Finance Accounts Format.</option>
                                    <option>Activity 3.03: Updating Appropriation Accounts Format.</option>
                                    <option>Activity 4.01: Conducting Training Needs Assessment.</option>
                                    <option>Activity 4.02: Develop Comprehensive Training Calendar.</option>
                                    <option>Activity 4.03: Develop Core Groups in Specialized Areas for Knowledge Sharing.</option>
                                    <option>Activity 4.04: Arrange Short-term, Medium-term and Long-term Training in Home and Abroad.</option>
                                    <option>Activity 4.05: Updating Communication Strategy.</option>
                                    <option>Activity 4.06: Developing Self-disclosure Policy.</option>
                                    <option>Activity 4.07: Developing Terms of Reference (TOR) for Research and Development Wing.</option>
                                    <option>Activity 4.08: Develop HR Policy.</option>
                                    <option>Activity 4.09: Workshop/Seminar with Stakeholders.</option>
                                    <option>Activity 4.10: Training Module for continuous Professional Development.</option>
                                </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-lg-flex d-sm-block border pt-3 border">
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label">Milestone</label>
                                <select class="form-control rounded-0">
                                    <option>Risk Assessment Completed.</option>
                                    <option>Analysis of Relevant Topics Completed.</option>
                                    <option>Annual Audit Plan Finalized and Approved.</option>
                                    <option>Planning</option>
                                    <option>Field Audit</option>
                                    <option>Reporting</option>
                                    <option>Planning First(Half Yearly)</option>
                                    <option>Field Audit (First Half Yearly)</option>
                                    <option>Reporting (First Half Yearly)</option>
                                    <option>Planning (First Half Yearly)</option>
                                    <option>Audit Code Updated</option>
                                    <option>Guidelines Updated</option>
                                    <option>Manuals Updated</option>
                                    <option>Audit Plans Prepared Using Data Analytics</option>
                                    <option>AMMS Updated</option>
                                    <option>Terms of Reference Developed</option>
                                    <option>Archiving Developed</option>
                                    <option>Government Accounting Standards Formulated.</option>
                                    <option>Finance Accounts Format Updated</option>
                                    <option>Appropriation Accounts Format Updated</option>
                                    <option>Needs Assessment Completed.</option>
                                    <option>Comprehensive Training Calendar Developed.</option>
                                    <option>Core Groups Developed.</option>
                                    <option>Training Completed.</option>
                                    <option>Communication Strategies Updated.</option>
                                    <option>Self-Disclosure Policy Developed.</option>
                                    <option>Terms of Reference (TOR) of Research and Development Wing Developed.</option>
                                    <option>HR Policy Developed.</option>
                                    <option>Workshop/Seminar with Stakeholders Conducted.</option>
                                    <option>Training Module Completed.</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label">Target Year</label>
                                <input class="form-control rounded-0" type="date" value="date" id="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label">Responsible</label>
                                <select class="form-control rounded-0">
                                    <option>Responsible</option>
                                    <option>FIMA</option>
                                    <option>OCAG FIMA</option>
                                    <option>OCAG, FIMA Audit Directorates</option>
                                    <option>OCAG</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label">Budget</label>
                                <input class="form-control rounded-0" type="text" id="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label">Assigned Staff</label>
                                <input class="form-control rounded-0" type="text" id="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label">Other Resources</label>
                                <input class="form-control rounded-0" type="text" id="">
                            </div>
                        </div>
                    </div>
                    <div class="row d-lg-flex d-sm-block pt-3 border-left border-right">
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label">Milestone</label>
                                <select class="form-control rounded-0">
                                    <option>Risk Assessment Completed.</option>
                                    <option>Analysis of Relevant Topics Completed.</option>
                                    <option>Annual Audit Plan Finalized and Approved.</option>
                                    <option>Planning</option>
                                    <option>Field Audit</option>
                                    <option>Reporting</option>
                                    <option>Planning First(Half Yearly)</option>
                                    <option>Field Audit (First Half Yearly)</option>
                                    <option>Reporting (First Half Yearly)</option>
                                    <option>Planning (First Half Yearly)</option>
                                    <option>Audit Code Updated</option>
                                    <option>Guidelines Updated</option>
                                    <option>Manuals Updated</option>
                                    <option>Audit Plans Prepared Using Data Analytics</option>
                                    <option>AMMS Updated</option>
                                    <option>Terms of Reference Developed</option>
                                    <option>Archiving Developed</option>
                                    <option>Government Accounting Standards Formulated.</option>
                                    <option>Finance Accounts Format Updated</option>
                                    <option>Appropriation Accounts Format Updated</option>
                                    <option>Needs Assessment Completed.</option>
                                    <option>Comprehensive Training Calendar Developed.</option>
                                    <option>Core Groups Developed.</option>
                                    <option>Training Completed.</option>
                                    <option>Communication Strategies Updated.</option>
                                    <option>Self-Disclosure Policy Developed.</option>
                                    <option>Terms of Reference (TOR) of Research and Development Wing Developed.</option>
                                    <option>HR Policy Developed.</option>
                                    <option>Workshop/Seminar with Stakeholders Conducted.</option>
                                    <option>Training Module Completed.</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label">Target Year</label>
                                <input class="form-control rounded-0" type="date" value="date" id="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label">Responsible</label>
                                <select class="form-control rounded-0">
                                    <option>Responsible</option>
                                    <option>FIMA</option>
                                    <option>OCAG FIMA</option>
                                    <option>OCAG, FIMA Audit Directorates</option>
                                    <option>OCAG</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label">Budget</label>
                                <input class="form-control rounded-0" type="text" id="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label">Assigned Staff</label>
                                <input class="form-control rounded-0" type="text" id="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label">Other Resources</label>
                                <input class="form-control rounded-0" type="text" id="">
                            </div>
                        </div>
                    </div>
                    <div class="row d-lg-flex d-sm-block border pt-3 border">
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label">Milestone</label>
                                <select class="form-control rounded-0">
                                    <option>Risk Assessment Completed.</option>
                                    <option>Analysis of Relevant Topics Completed.</option>
                                    <option>Annual Audit Plan Finalized and Approved.</option>
                                    <option>Planning</option>
                                    <option>Field Audit</option>
                                    <option>Reporting</option>
                                    <option>Planning First(Half Yearly)</option>
                                    <option>Field Audit (First Half Yearly)</option>
                                    <option>Reporting (First Half Yearly)</option>
                                    <option>Planning (First Half Yearly)</option>
                                    <option>Audit Code Updated</option>
                                    <option>Guidelines Updated</option>
                                    <option>Manuals Updated</option>
                                    <option>Audit Plans Prepared Using Data Analytics</option>
                                    <option>AMMS Updated</option>
                                    <option>Terms of Reference Developed</option>
                                    <option>Archiving Developed</option>
                                    <option>Government Accounting Standards Formulated.</option>
                                    <option>Finance Accounts Format Updated</option>
                                    <option>Appropriation Accounts Format Updated</option>
                                    <option>Needs Assessment Completed.</option>
                                    <option>Comprehensive Training Calendar Developed.</option>
                                    <option>Core Groups Developed.</option>
                                    <option>Training Completed.</option>
                                    <option>Communication Strategies Updated.</option>
                                    <option>Self-Disclosure Policy Developed.</option>
                                    <option>Terms of Reference (TOR) of Research and Development Wing Developed.</option>
                                    <option>HR Policy Developed.</option>
                                    <option>Workshop/Seminar with Stakeholders Conducted.</option>
                                    <option>Training Module Completed.</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label">Target Year</label>
                                <input class="form-control rounded-0" type="date" value="date" id="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label">Responsible</label>
                                <select class="form-control rounded-0">
                                    <option>Responsible</option>
                                    <option>FIMA</option>
                                    <option>OCAG FIMA</option>
                                    <option>OCAG, FIMA Audit Directorates</option>
                                    <option>OCAG</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label">Budget</label>
                                <input class="form-control rounded-0" type="text" id="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label">Assigned Staff</label>
                                <input class="form-control rounded-0" type="text" id="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label">Other Resources</label>
                                <input class="form-control rounded-0" type="text" id="">
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
@endsection