@extends('sideMenuLayout')
@section('sideMenu')
@include('pages.plan.operational.operationalMenu');
@endsection
@section('content')
<div class="row m-0 page-title-wrapper d-md-flex align-items-md-center">
    <div class="col-md-6">
        <div class="title py-2">
            <h4 class="mb-0 font-weight-bold"><i class="fas fa-list mr-3"></i>Create Anual Audit Activites</h4>
        </div>
    </div>
</div>
<div class="mt-4 px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom gutter-b">           
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="" class="col-form-label">Fiscal Year :</label>
                                <input class="form-control rounded-0" type="date" value="date" id="">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="" class="col-form-label">Strategic Outcome :</label>
                                <select class="form-control rounded-0" id="mySelect2">
                                    <option>Select Outcome</option>
                                    <option>Strategic Outcome 01</option>
                                    <option>Strategic Outcome 02</option>
                                </select>
                                <div class="mt-3">
                                    <p>Increased credibility to the SAI’s activities to the parliament and other stakeholders will facilitate the policymakers in taking appropriate measures for prudent management of scarce public resources.</p>
                                    <p class="d-none">Improved public financial management resulting in beneficial change to the public sector.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="" class="col-form-label">Strategic Output :</label>
                                <select class="form-control rounded-0">
                                    <option>Select Output</option>
                                    <option>Output-01</option>
                                    <option>Output-02</option>
                                    <option>Output-03</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <p>Quality Compliance, Financial and Performance audit reports including audit reports on special areas.</p>
                                <p class="d-none">Increased Follow-up and reporting on implementation of audit recommendations.</p>
                                <p class="d-none">Improved Government Accounting Standards and Procedures.</p>
                            </div>
                            <div class="form-group d-none">
                                <label for="" class="col-form-label">Strategic Output :</label>
                                <select class="form-control rounded-0">
                                    <option>Output-04 : Training and Awareness building Consultation with key Stakeholders on Various PFM Issues.</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Create Activities</h3>
                            <hr>
                            <ul id="tree2">
                                <li><a href="#">TECH</a>
                                  <ul>
                                    <li>
                                        <div class="d-flex align-item-center">
                                            <div class="mr-5">Company Maintenance</div>
                                            <div class="btn-group mr-5" role="group" aria-label="First group">
                                                <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#mileStoneModal"><i class="fas fa-flag-checkered"></i></button>
                                                <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#responsibleModal"><i class="fas fa-user"></i></button>
                                                <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </li>
                                    <li>Employees
                                      <ul>
                                        <li>Reports
                                          <ul>
                                            <li>
                                                <div class="d-flex align-item-center">
                                                    <div class="mr-5">Company Maintenance</div>
                                                    <div class="btn-group mr-5" role="group" aria-label="First group">
                                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#mileStoneModal"><i class="fas fa-flag-checkered"></i></button>
                                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#responsibleModal"><i class="fas fa-user"></i></button>
                                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex align-item-center">
                                                    <div class="mr-5">Company Maintenance</div>
                                                    <div class="btn-group mr-5" role="group" aria-label="First group">
                                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#mileStoneModal"><i class="fas fa-flag-checkered"></i></button>
                                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#responsibleModal"><i class="fas fa-user"></i></button>
                                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex align-item-center">
                                                    <div class="mr-5">Company Maintenance</div>
                                                    <div class="btn-group mr-5" role="group" aria-label="First group">
                                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#mileStoneModal"><i class="fas fa-flag-checkered"></i></button>
                                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#responsibleModal"><i class="fas fa-user"></i></button>
                                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </li>
                                          </ul>
                                        </li>
                                        <li>
                                            <div class="d-flex align-item-center">
                                                <div class="mr-5">Company Maintenance</div>
                                                <div class="btn-group mr-5" role="group" aria-label="First group">
                                                    <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#mileStoneModal"><i class="fas fa-flag-checkered"></i></button>
                                                    <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#responsibleModal"><i class="fas fa-user"></i></button>
                                                    <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </li>
                                      </ul>
                                    </li>
                                    <li>
                                        <div class="d-flex align-item-center">
                                            <div class="mr-5">Company Maintenance</div>
                                            <div class="btn-group mr-5" role="group" aria-label="First group">
                                                <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#mileStoneModal"><i class="fas fa-flag-checkered"></i></button>
                                                <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#responsibleModal"><i class="fas fa-user"></i></button>
                                                <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </li>
                                  </ul>
                                </li>
                                <li>XRP
                                  <ul>
                                    <li>
                                        <div class="d-flex align-item-center">
                                            <div class="mr-5">Company Maintenance</div>
                                            <div class="btn-group mr-5" role="group" aria-label="First group">
                                                <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#mileStoneModal"><i class="fas fa-flag-checkered"></i></button>
                                                <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#responsibleModal"><i class="fas fa-user"></i></button>
                                                <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </li>
                                    <li>Employees
                                      <ul>
                                        <li>Reports
                                          <ul>
                                            <li>
                                                <div class="d-flex align-item-center">
                                                    <div class="mr-5">Company Maintenance</div>
                                                    <div class="btn-group mr-5" role="group" aria-label="First group">
                                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#mileStoneModal"><i class="fas fa-flag-checkered"></i></button>
                                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#responsibleModal"><i class="fas fa-user"></i></button>
                                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex align-item-center">
                                                    <div class="mr-5">Company Maintenance</div>
                                                    <div class="btn-group mr-5" role="group" aria-label="First group">
                                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#mileStoneModal"><i class="fas fa-flag-checkered"></i></button>
                                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#responsibleModal"><i class="fas fa-user"></i></button>
                                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex align-item-center">
                                                    <div class="mr-5">Company Maintenance</div>
                                                    <div class="btn-group mr-5" role="group" aria-label="First group">
                                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#mileStoneModal"><i class="fas fa-flag-checkered"></i></button>
                                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#responsibleModal"><i class="fas fa-user"></i></button>
                                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </li>
                                          </ul>
                                        </li>
                                        <li>
                                            <div class="d-flex align-item-center">
                                                <div class="mr-5">Company Maintenance</div>
                                                <div class="btn-group mr-5" role="group" aria-label="First group">
                                                    <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#mileStoneModal"><i class="fas fa-flag-checkered"></i></button>
                                                    <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#responsibleModal"><i class="fas fa-user"></i></button>
                                                    <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </li>
                                      </ul>
                                    </li>
                                    <li>
                                        <div class="d-flex align-item-center">
                                            <div class="mr-5">Company Maintenance</div>
                                            <div class="btn-group mr-5" role="group" aria-label="First group">
                                                <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#mileStoneModal"><i class="fas fa-flag-checkered"></i></button>
                                                <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#responsibleModal"><i class="fas fa-user"></i></button>
                                                <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </li>
                                  </ul>
                                </li>
                              </ul>
                            <ul id="tree1" class="tree p-0 d-none">
                                <li class="d-flex align-item-center">
                                    <div class="mr-5">Company Maintenance</div>
                                    <div class="btn-group mr-5" role="group" aria-label="First group">
                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#mileStoneModal"><i class="fas fa-flag-checkered"></i></button>
                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#responsibleModal"><i class="fas fa-user"></i></button>
                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure"><i class="fa fa-plus"></i></button>
                                    </div>
                                </li>
                                <li class="d-flex align-item-center">
                                    <div class="mr-5">Company Maintenance</div>
                                    <div class="btn-group mr-5" role="group" aria-label="First group">
                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#mileStoneModal"><i class="fas fa-flag-checkered"></i></button>
                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure"  data-toggle="modal" data-target="#responsibleModal"><i class="fas fa-user"></i></button>
                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure"><i class="fa fa-plus"></i></button>
                                    </div>
                                </li>
                                <li>Employees
                                    <ul>
                                        <li>Reports
                                            <ul>
                                                <li class="d-flex align-item-center">
                                                    <div class="mr-5">Company Maintenance</div>
                                                    <div class="btn-group mr-5" role="group" aria-label="First group">
                                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#mileStoneModal"><i class="fas fa-flag-checkered"></i></button>
                                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure"  data-toggle="modal" data-target="#responsibleModal"><i class="fas fa-user"></i></button>
                                                    </div>
                                                </li>
                                                <li class="d-flex align-item-center">
                                                    <div class="mr-5">Company Maintenance</div>
                                                    <div class="btn-group mr-5" role="group" aria-label="First group">
                                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure data-toggle="modal" data-target="#mileStoneModal""><i class="fas fa-flag-checkered"></i></button>
                                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure"  data-toggle="modal" data-target="#responsibleModal"><i class="fas fa-user"></i></button>
                                                    </div>
                                                </li>
                                                <li class="d-flex align-item-center">
                                                    <div class="mr-5">Company Maintenance</div>
                                                    <div class="btn-group mr-5" role="group" aria-label="First group">
                                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure data-toggle="modal" data-target="#mileStoneModal""><i class="fas fa-flag-checkered"></i></button>
                                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure"  data-toggle="modal" data-target="#responsibleModal"><i class="fas fa-user"></i></button>
                                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="d-flex align-item-center">
                                            <div class="mr-5">Company Maintenance</div>
                                            <div class="btn-group mr-5" role="group" aria-label="First group">
                                                <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="modal" data-target="#mileStoneModal"><i class="fas fa-flag-checkered"></i></button>
                                                <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure"  data-toggle="modal" data-target="#responsibleModal"><i class="fas fa-user"></i></button>
                                                <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="d-flex align-item-center">
                                    <div class="mr-5">Company Maintenance</div>
                                    <div class="btn-group mr-5" role="group" aria-label="First group">
                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure" data-toggle="tooltip" title="Some amazing content!"><i class="fas fa-flag-checkered"></i></button>
                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure"  data-toggle="modal" data-target="#responsibleModal"><i class="fas fa-user"></i></button>
                                        <button type="button" class="btn btn-outline-secondary btn-icon  btn-sqaure"><i class="fa fa-plus"></i></button>
                                    </div>
                                </li>
                            </ul>
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