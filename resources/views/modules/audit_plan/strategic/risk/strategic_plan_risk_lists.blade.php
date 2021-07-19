<x-title-wrapper>Plan Risks</x-title-wrapper>
<div class="col-md-12">
    <div class="d-flex justify-content-end">
        {{-- <x-toolbar-button class="btn btn-success btn-sm btn-bold btn-square btn_create_audit_activity"
                            href="{{route('audit.plan.operational.activity.create')}}" data-toggle="modal" data-target="#meetingDetails">
            <i class="far fa-plus mr-1"></i> Add Meeting Activity
        </x-toolbar-button> --}}
        <a class="btn btn-success btn-sm btn-bold btn-square riskAdd" href="#"><i class="far fa-plus mr-1"></i> Add Risk</a>
    </div>
</div>
<div class="col-lg-12">
    <!--begin::Advance Table Widget 4-->
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Body-->
        <div class="card-body">
            <!--begin::Table-->
            {{-- ক্রমিক নং	শিরোনাম	ক্যাটাগরি	অগ্রাধিকার	লেভেল	ঝুঁকি প্রতিক্রিয়া	সম্পাদন --}}
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>#No</th>
                            <th>Title</th>
                            <th>Priority</th>
                            <th>Lavel</th>
                            <th>Risk</th>
                            <th>Risk Feedback</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span>1</span></td>
                            <td><span>Title - 1</span></td>
                            <td><span>High</span></td>
                            <td><span>Medium</span></td>
                            <td><span>Political risk</span></td>
                            <td><span>Outcome</span></td>
                            <td>
                                <div class="btn-group">
                                    <a href="javascript:;" data-url="" class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_view_audit_annual_activity">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="javascript:;" data-url="" class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn_edit_audit_annual_activity">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="javascript:;" data-url="" class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-danger btn_edit_audit_annual_activity">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!--end::Table-->
        </div>
        <!--end::Body-->
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex flex-wrap mr-3">
                    <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
                        <i class="ki ki-bold-double-arrow-back icon-xs"></i>
                    </a>
                    <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
                        <i class="ki ki-bold-arrow-back icon-xs"></i>
                    </a>
                    <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">...</a>
                    <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">23</a>
                    <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary active mr-2 my-1">24</a>
                    <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">25</a>
                    <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">26</a>
                    <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">27</a>
                    <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">28</a>
                    <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">...</a>
                    <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
                        <i class="ki ki-bold-arrow-next icon-xs"></i>
                    </a>
                    <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
                        <i class="ki ki-bold-double-arrow-next icon-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--end::Advance Table Widget 4-->
</div>

<div class="modal fade" id="riskAddForm" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Meeting Add</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
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
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="col-form-label">Subject</label>
                            <input type="text" class="form-control rounded-0" placeholder="write subject">    
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Category <span class="text-danger">(*)</span></label>
                            <select class="form-control" name="category" required="">
                                <option value="Moral risk">Moral risk</option>
                                <option value="Political risk">Political risk</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Priority <span class="text-danger">(*)</span></label>
                            <select class="form-control" name="priority" required="">
                                <option value="high">High</option>
                                <option value="medium">Medium</option>
                                <option value="low">Low</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Lavel <span class="text-danger">(*)</span></label>
                            <select class="form-control" name="level" required="">
                                <option value="ফলাফল">Outcome</option>
                                <option value="Output and Capacity">Output and Capacity</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Risk response<span class="text-danger">(*)</span></label>
                            <select class="form-control" name="response" required="">
                                <option value="Avoid">Avoid</option>
                                <option value="Share">Share</option>
                                <option value="Reduce">Reduce</option>
                                <option value="Tolerate">Tolerate</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-form-label">Effect <span class="text-danger">(*)</span></label>
                            <textarea class="form-control rounded-0" rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-form-label">Mitigation <span class="text-danger">(*)</span></label>
                            <textarea class="form-control rounded-0" rows="10"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger font-weight-bold btn-square" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary font-weight-bold btn-square">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).off('click', '.riskAdd').on('click', '.riskAdd', function(e) {
        $('#riskAddForm').modal('show');
    });
</script>