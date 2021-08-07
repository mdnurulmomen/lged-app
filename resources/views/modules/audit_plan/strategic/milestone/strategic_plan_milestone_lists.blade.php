<x-title-wrapper>Final Plan</x-title-wrapper>
<div class="col-md-12">
    <div class="d-flex justify-content-end">
        {{-- <x-toolbar-button class="btn btn-success btn-sm btn-bold btn-square btn_create_audit_activity"
                            href="{{route('audit.plan.operational.activity.create')}}" data-toggle="modal" data-target="#meetingDetails">
            <i class="far fa-plus mr-1"></i> Add Meeting Activity
        </x-toolbar-button> --}}
        <a class="btn btn-success btn-sm btn-bold btn-square btn_create_milestone" href="#"><i class="far fa-plus mr-1"></i> Add Milestone</a>
    </div>
</div>
<div class="col-lg-12">
    <!--begin::Advance Table Widget 4-->
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Body-->
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
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="select_fiscal_year" class="col-form-label">Activites <span class="text-danger">(*)</span></label>
                        <select class="form-control rounded-0">
                            <option value="">Activity 1</option>
                            <option value="">Activity 2</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" id="milestoneWrapper">
                    <div class="border w-100 p-5 mileStone position-relative mt-5">
                        <a href="#" class="btn btn-icon btn-danger btn-sm mr-2 mileStone-close">
                            <span class="svg-icon">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Call.svg-->
                                <i class="fas fa-times"></i>
                                <!--end::Svg Icon-->
                            </span>
                        </a>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="col-form-label">Subject</label>
                                    <input type="text" class="form-control rounded-0" placeholder="write subject" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Year</label>
                                    <input type="text" class="form-control rounded-0" placeholder="write year" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Responsible person</label>
                                    <input type="text" class="form-control rounded-0" placeholder="write responsible person" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Source of funds</label>
                                    <select name="quarters[]" class="form-control rounded-0">
                                        <option value="Q1">Source 01</option>
                                        <option value="Q2">Source 02</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Price</label>
                                    <input type="text" class="form-control rounded-0" placeholder="write price" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Body-->
    </div>
    <!--end::Advance Table Widget 4-->
</div>
<script type="text/javascript">
    $(document).off('click', '.mileStone-close').on('click', '.mileStone-close', function(e) {
        $(this).parent('.mileStone').remove();
    })
    $(document).off('click', '.btn_create_milestonee').on('click', '.btn_create_milestone', function(e) {
        var mileStoneHtml = '<div class="border w-100 p-5 mileStone position-relative mt-5"> <a href="#" class="btn btn-icon btn-danger btn-sm mr-2 mileStone-close"> <span class="svg-icon"> <i class="fas fa-times"></i> </span> </a> <div class="row"> <div class="col-md-8"> <div class="form-group"> <label class="col-form-label">Subject</label> <input type="text" class="form-control rounded-0" placeholder="write subject"/> </div></div><div class="col-md-4"> <div class="form-group"> <label class="col-form-label">Year</label> <input type="text" class="form-control rounded-0" placeholder="write year"/> </div></div></div><div class="row"> <div class="col-md-4"> <div class="form-group"> <label class="col-form-label">Responsible person</label> <input type="text" class="form-control rounded-0" placeholder="write responsible person"/> </div></div><div class="col-md-4"> <div class="form-group"> <label class="col-form-label">Source of funds</label> <select name="quarters[]" class="form-control rounded-0"> <option value="Q1">Source 01</option> <option value="Q2">Source 02</option> </select> </div></div><div class="col-md-4"> <div class="form-group"> <label class="col-form-label">Price</label> <input type="text" class="form-control rounded-0" placeholder="write price"/> </div></div></div></div>';
        $("#milestoneWrapper").append(mileStoneHtml);
    })
</script>
